<?php

namespace App\Http\Controllers;

use App\Http\Requests\Admin\MakeSaleRequest;
use App\Model\sale_product;
use Illuminate\Http\Request;
use File,Session;

class SaleController extends Controller
{
    public function makeSaleProcess(MakeSaleRequest $request){
        $data = $request->toArray();
        if($request->hasfile('sale_image'))
        {
            $profile_pic = $request->file('sale_image');
            $input['imagename'] = 'SaleImage'.time().'.'.$profile_pic->getClientOriginalExtension();

            $path = public_path('uploads/images');
            File::makeDirectory($path, $mode = 0777, true, true);

            $destinationPath = 'uploads/images'.'/';
            if($profile_pic->move($destinationPath, $input['imagename']))
            {
                // $file_url=asset($destinationPath.$input['imagename']);
                $data['sale_image']=$input['imagename'];

            }else{
                $error_file_not_required[]="Sale Image Have Some Issue";
                unset($data['sale_image']);
            }

        }else{
            unset($data['sale_image']);
        }
        $data['created_at'] = now(); 
        $data['updated_at'] = now(); 
        unset($data['_token']);


        $makeSale = sale_product::insert($data);
        $msg = "Sale Saved Successfully ";
        Session::flash('message', $msg);

        return redirect()->back();
        // dd($data);

    }

    public function getSaleList(Request $request)
    {
        $saleList = sale_product::orderBy('created_at','DESC')->paginate(20);
        // dd($saleList);
        return view('admin/getSaleList',compact('saleList'));
        # code...
    }

    public function makeSale(Request $request)
    {
        // $saleList = sale_product::orderBy('created_at','DESC')->paginate(20);
        // dd($saleList);
        return view('admin/makeSale');
        # code...
    }
}
