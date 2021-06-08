<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {


        if($request-> session()->has('ADMIN_LOGIN')){ 
             
             return redirect::to('admin/dashboard');
        }
        else
        {
            return view('admin.login');
    }
            return view('admin.login');

}

    // public function auth(Request $request){
        
    //     //return $request->post();
    //     // return $request->all(); // We Can use this Method Also

    //     $email = $request->post('email');
    //     $password = $request->post('password');

    //     $result =Admin::where(['email' => $email, 'password' => $password]) -> get();
        
    //     // echo "<pre>";
    //     // print_r($result);
    //     // die();
        
    //     if(isset($result['0'] ->id)){  // Line Description One Line Below
    //                                    // $result['0'] -> id , Shows that particular data is there ...
           
    //         $request->session()->put('ADMIN_LOGIN',true);
    //         $request->session()->put('ADMIN_ID' , $result['0'] ->id);
            
    //         return redirect('admin/dashboard'); // this will GOES in route file i.e. web.php file ...
    //     }
    //     else
    //     {
    //         $request->session()->flash('error','Email Or Password Is Incorrect !!!');
    //         return redirect::to('admin');
    //     }

    // }

        public function auth(Request $request){
        
   
        $email = $request->post('email');
        $password = $request->post('password');

        $result =Admin::where(['email' => $email]) -> first();

        if($result){  
           if(Hash::check($password , $result->password))
           {
            $request->session()->put('ADMIN_LOGIN',true);
            $request->session()->put('ADMIN_ID' , $result ->id);
            
            return redirect('admin/dashboard');
           }
           else
           {
            $request->session()->flash('error','Incorrect Password !!!');
            return redirect::to('admin');
           }            
        }
        else
        {
            $request->session()->flash('error','Email Or Password Is Incorrect !!!');
            return redirect::to('admin');
        }

    }

    public function dashboard(){
        return view('admin/dashboard');
    }

    public function category(){
        return "Category Page Is Here";
    }

    public function updatePassword(){ // For Making Password Encrypt
        $r = Admin::find(1);
        $r->password=Hash::make('123');
        $r->save();
    }  

    public function logout(){
        return "Logout Page";


    } 

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function show(Admin $admin)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function edit(Admin $admin)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Admin $admin)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function destroy(Admin $admin)
    {
        //
    }
}
