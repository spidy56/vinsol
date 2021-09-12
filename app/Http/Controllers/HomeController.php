<?php

namespace App\Http\Controllers;

use App\Http\Middleware\Authenticate;
use App\Model\sale_product;
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
            if($user->role == 1){
                // return view('admin.');

                return redirect(route('makeSale'));
    
            }else{
                // return view('home');
                return redirect(route('getSale'));

            }
            // return redirect(RouteServiceProvider::HOME);
        }
    }

    public function getSale(Request $request){
        $user = Auth::user();
        $currentDate = date('Y-m-d');
        $saleProduct = sale_product::whereDate('publish_date',$currentDate)->first();
        // dd($saleProduct);
        return view('home',compact('saleProduct'));


    }
}
