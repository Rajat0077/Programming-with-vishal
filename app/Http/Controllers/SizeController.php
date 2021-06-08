<?php

namespace App\Http\Controllers;

use App\Models\Size;
use Illuminate\Http\Request;

class SizeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $result['data'] = Size::all();
        return view('admin/size' , $result);
    }

    public function manage_size($id=""){

        if($id > 0){
            //echo "Id";

            $arr = Size::where('id' , $id) -> get();
            $result['size'] = $arr['0']->size;
            $result['id'] = $arr['0'] ->id;
            return view('admin/manage_size' , $result);

        }else{
            $result['size'] = "";
            $result['id'] = "";
            return view('admin/manage_size' , $result);
        }        
    }

    public function manage_size_process(Request $request){        
        

        $request->validate(['size'=>'required|unique:sizes,size,'. $request->post('id'),
         ]);

        if($request->post('id')){
            $data = Size::find($request->post('id'));
        }else{
            $data = new Size(); // Create An Object
        }

        $data['size'] = $request->post('size');
        $data->save();
        return redirect('admin/size');

    }

    public function delete($id){
        // return $id;
        // die();
        $data = Size::find($id) -> delete();
        return redirect('admin/size');
    }

    public function status($status , $id){
        
        $data = Size::where('id' , $id) -> update(['status' => $status]);
        return redirect('admin/size');
    }
}
