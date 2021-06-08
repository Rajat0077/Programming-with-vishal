<?php

namespace App\Http\Controllers;

use App\Models\Coupon;
use Illuminate\Http\Request;

class CouponController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        // admin/coupon

        $result['data'] = Coupon::all();
        return view('admin/coupon' , $result);

    }

    public function manage_coupon($id=""){
        
        if($id > 0){
            
            $arr = Coupon::where('id' , $id) -> get(); 
            $coupon['title'] = $arr['0'] ->title;
            $coupon['code'] = $arr['0']->code;
            $coupon['value'] = $arr['0'] ->value;
            $coupon['id'] = $arr['0'] ->id;

            return view('admin/manage_coupon' , $coupon ); 

        }else{

           $coupon['title'] = "";
           $coupon['code'] = "";
           $coupon['value'] = "";
           $coupon['id'] = "";

           return view('admin/manage_coupon' , $coupon );     
        }   
        //return view('admin/manage_coupon' );
    }

    public function manage_coupon_process(Request $request){
        
        $request->validate(['title'=>'required' , 
                            'code'=>'required|unique:coupons,code,'.$request->post('id') , 
                            'value'=>'required' ]);

        if($request->post('id')){
            // $model = Coupon::where('id' , $request->post('id')); // Not Work
            $model = Coupon::find($request->post('id'));
            $msg = "Coupon Updated";
        }else{
            $model = new Coupon();
            $msg = "Coupon Data Inserted";
        }

        $model->title = $request->post('title');
        $model->code = $request->post('code');
        $model->value = $request->post('value');
        $model->save();
        session()->flash('message' , $msg);
        return redirect('admin/coupon');

    }

    public function delete($id){
        $result = Coupon::find($id) -> delete();
        return redirect('admin/coupon');
    }

}
