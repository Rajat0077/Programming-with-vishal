<?php

namespace App\Http\Controllers;

use App\Models\Color;
use Illuminate\Http\Request;

class ColorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $color['data'] = Color::all();
        return view('admin/color' , $color);
    }

    public function manage_color($id=""){
        if($id > 0){

            $data = Color::where('id' , $id) -> get();
            $data['color'] = $data['0'] ->color;
            $data['id'] = $data['0'] ->id;

            return view('admin/manage_color' , $data);  

        }else{

            $data['color']  = "";
            $data['id']  = "";

            return view('admin/manage_color' , $data
        );   
    }
         
  }
     

    public function manage_color_process(Request $request){

        $request->validate(['color'=>'required|unique:colors,color,' . $request->post('id'), ]);

        if($request->post('id')){
            $data = Color::find($request->post('id'));
        }else{
            $data = new Color();    
        }

        $data['color'] = $request->color;
        $data->save();

        return redirect('admin/color');
    }

    public function delete($id){
        $data = Color::where('id' , $id) -> delete(); 
        return redirect('admin/color');
    }

    public function status($status , $id){        
        $data = Color::where('id' , $id) -> update(['status' => $status]);
        return redirect('admin/color');
    }

}
