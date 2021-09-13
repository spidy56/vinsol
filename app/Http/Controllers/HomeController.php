<?php

namespace App\Http\Controllers;

use App\Http\Middleware\Authenticate;
use App\Model\sale_product;
use App\Model\order;
use Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user = Auth::user();
        // dd($user);a
        if (Auth::check()) {
            if ($user->role == 1) {
                // return view('admin.');

                return redirect(route('makeSale'));
            } else {
                // return view('home');
                return redirect(route('getSale'));
            }
            // return redirect(RouteServiceProvider::HOME);
        }
    }

    public function getSale(Request $request)
    {
        $user = Auth::user();
        $currentDate = date('Y-m-d');
        $currentTime= date('H');
        if($currentTime >= 10){

            $saleProduct = sale_product::whereDate('publish_date', $currentDate)->first();
            $sale_check = order::where('sale_id', ($saleProduct->id ?? -1))->where('payment_status', 1);
            // dd($sale_check->count());
            $saleProduct->quantity = $saleProduct->quantity - $sale_check->count();
            $sale_check_user = order::where('sale_id', ($saleProduct->id ?? -1))->where('payment_status', 1)->where('user_id', $user->id);
            if ($sale_check_user->count() != 0) {
                $saleProduct->product_check = 1;
            } else {
                $saleProduct->product_check = 0;
            }
        }else{
            $saleProduct =null; 
        }
        // dd($saleProduct);
        return view('home', compact('saleProduct'));
    }

    public function buyNow(Request $request, $id)
    {
        // dd($id);
        $user = Auth::user();
        $currentDate = date('Y-m-d');
        $saleProduct = sale_product::whereDate('publish_date', $currentDate)->where('id', $id)->first();
        $sale_check = order::where('sale_id', $saleProduct->id)->where('payment_status', 1);
        $sale_check_user = order::where('sale_id', $saleProduct->id)->where('payment_status', 1)->where('user_id', $user->id);
        $sale_check_user_all_order = order::where('payment_status', 1)->where('user_id', $user->id);
        // dd($sale_check->count());
        if ($sale_check->count() > $saleProduct->qauntity) {
            $msg = "Already Sold !";
            Session::flash('message', $msg);

            return redirect()->back();
        }

        if ($sale_check_user->count() != 0) {
            $msg = "User Already Purchased !";
            Session::flash('message', $msg);

            return redirect()->back();
        }

        if (empty($saleProduct)) {
            $msg = "Invalid Sale ";
            Session::flash('message', $msg);

            return redirect()->back();
        }
        $saleProduct->discount = 0;
        if ($sale_check_user_all_order->count() == 0) {
            $saleProduct->discount = 0;
        } elseif ($sale_check_user_all_order->count() == 1) {
            $saleProduct->discount = 1;
        } elseif ($sale_check_user_all_order->count() == 2) {
            $saleProduct->discount = 2;
        } elseif ($sale_check_user_all_order->count() == 3) {
            $saleProduct->discount = 3;
        } elseif ($sale_check_user_all_order->count() == 4) {
            $saleProduct->discount = 4;
        } else {
            $saleProduct->discount = 4;
        }
        $saleProduct->discounted_price = $saleProduct->discounted_price - round((($saleProduct->discount) / 100) * $saleProduct->discounted_price, 2);

        // dd($saleProduct);
        return view('checkOut', compact('saleProduct', 'id'));
    }

    public function makePayment(Request $request, $id)
    {
        // dd($id);
        $user = Auth::user();
        $currentDate = date('Y-m-d');
        $saleProduct = sale_product::whereDate('publish_date', $currentDate)->where('id', $id)->first();
        $sale_check = order::where('sale_id', $saleProduct->id)->where('payment_status', 1);
        $sale_check_user = order::where('sale_id', $saleProduct->id)->where('payment_status', 1)->where('user_id', $user->id);
        $sale_check_user_all_order = order::where('payment_status', 1)->where('user_id', $user->id);
        
        // dd($sale_check->count());
        if ($sale_check->count() > $saleProduct->qauntity) {
            $msg = "Already Sold !";
            Session::flash('message', $msg);

            return redirect()->back();
        }

        if ($sale_check_user->count() != 0) {
            $msg = "User Already Purchased !";
            Session::flash('message', $msg);

            return redirect()->back();
        }

        if (empty($saleProduct)) {
            $msg = "Invalid Sale ";
            Session::flash('message', $msg);

            return redirect()->back();
        }
        $saleProduct->discount = 0;
        if ($sale_check_user_all_order->count() == 0) {
            $saleProduct->discount = 0;
        } elseif ($sale_check_user_all_order->count() == 1) {
            $saleProduct->discount = 1;
        } elseif ($sale_check_user_all_order->count() == 2) {
            $saleProduct->discount = 2;
        } elseif ($sale_check_user_all_order->count() == 3) {
            $saleProduct->discount = 3;
        } elseif ($sale_check_user_all_order->count() == 4) {
            $saleProduct->discount = 4;
        } else {
            $saleProduct->discount = 4;
        }
        $saleProduct->discounted_price = $saleProduct->discounted_price - round((($saleProduct->discount) / 100) * $saleProduct->discounted_price, 2);

        $sale_order_array = [
            'user_id' => $user->id,
            'sale_id' => $saleProduct->id,
            'quantity' => 1,
            'total' =>$saleProduct->discounted_price ?? 0,
            'payment_status' => 1,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $sale_make_id = order::insertGetId($sale_order_array);
        // dd($saleProduct);\
        return redirect(route('orderConfirm'));
        // return view('orderConfirm', compact('saleProduct', 'id','sale_make_id'));
    }

    public function orderConfirm(Request $request)
    {
        return view('orderConfirm');
    }
}
