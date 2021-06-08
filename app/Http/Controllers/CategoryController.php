<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // For Fetching Data from Database,
        $result['data'] = Category::all();
        return view('admin/category' , $result);
    }

    public function manage_category(Request $request , $id='')
    {
        //return view('admin/manage_category');

        if($id > 0){

        $arr = Category::where('id' , $id)->get();    
        $result['category_name'] = $arr['0'] ->category_name;
        $result['category_slug'] = $arr['0'] ->category_slug;
        $result['id'] = $arr['0'] ->id;

        return view('admin/manage_category' , $result);

        }else{
        $result['category_name'] = "";    
        $result['category_slug'] = "";
        $result['id'] = "";

        return view('admin/manage_category' , $result);

        }
    }


    public function manage_category_process(Request $request){

        $request->validate(['category_name' => 'required',
                            'category_slug' => 'required|unique:categories,category_slug,' . $request->post('id'),
                        ]);

        if($request->post('id')){
            $model = Category::find($request->post('id')); // Check For Id Available
            $msg = "Category Updated";
        }else{
            $model = new Category();     
            $msg = "Category Inserted";
        }

        $model->category_name = $request->post('category_name');
        $model->category_slug = $request->post('category_slug');
        $model->save();

        $request->session()->flash('message' , $msg);
        return redirect::to('admin/category');


        // For Learning Purpose ...


        // $request->validate(['category_name' => 'required',
        //                     'category_slug' => 'required|unique:categories',   
        //                 ]);

        // $model = new Category(); // Here Model name i.e. database name in laravel is    'Category()' and in xampp server database name is 'categories'

        // // While Create Model Using Command Prompt , We Write Category , and In         
        // // Database the Database table will be categories

        // $model->category_name = $request->post('category_name');
        // $model->category_slug = $request->post('category_slug');
        // $model->save();

        // $request->session()->flash('message' , 'Category Added');
        // return redirect::to('admin/category');

    }

    public function delete($id){

        $model = Category::find($id);
        $model->delete();
        session()->flash('message' , 'Category Deleted');
        return redirect::to('admin/category');
    }
}
