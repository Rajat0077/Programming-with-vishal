<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use DB;


class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $result['data'] = Product::all();
        return view('admin/product' , $result);
    }

    public function manage_product($id="")
    {

        if($id > 0){
        //    return "ID";
        $arr = Product::where('id' , $id) -> get();

        $result['name'] = $arr['0'] ->name;
        $result['category_id'] = $arr['0'] ->category_id;
        $result['image'] = $arr['0'] ->image;
        $result['slug'] = $arr['0'] ->slug;
        $result['brand'] = $arr['0'] ->brand;
        $result['model'] = $arr['0'] ->model;
        $result['short_desc'] = $arr['0'] ->short_desc;
        $result['desc'] = $arr['0'] ->desc;
        $result['keywords'] = $arr['0'] ->keywords;
        $result['technical_specification'] = $arr['0'] ->technical_specification;
        $result['uses'] = $arr['0'] ->uses;
        $result['warranty'] = $arr['0'] ->warranty;
        $result['id'] = $arr['0'] ->id;

        $result['category'] = DB::table('categories')
                             -> where('status' , '1') 
                             -> get();

        $result['size'] = DB::table('sizes')->get();

        $result['color'] = DB::table('colors') -> get();   

        $result['productAttrAttr'] = DB::table('products_attr')
                                    -> where('products_id' , $id )
                                    -> get();

        
        $productImagesArr = DB::table('product_images')
                                    -> where(['products_id'=> $id])
                                    -> get();
        
        if(!isset($productImagesArr[0])){
        $result['productImagesArr']['0']['id'] = '';
        $result['productImagesArr']['0']['images'] = '';
        }
        else{
        $result['productImagesArr'] = $productImagesArr;    
        }                          

        // echo "<pre>";
        // print_r($result['productAttrAttr']);
        // die();   

        // Below For Product Image 
        // echo "<pre>";
        // print_r($result['productImageArr']);
        // die();   



        return view('admin/manage_product' , $result);

        }
        else
        {

        //return "No Id";
        $result['name'] = "";
        $result['category_id'] = "";
        $result['image'] = "";
        $result['slug'] = "";
        $result['brand'] = "";
        $result['model'] = "";
        $result['short_desc'] = "";
        $result['desc'] = "";
        $result['keywords'] = "";
        $result['technical_specification'] = "";
        $result['uses'] = "";
        $result['warranty'] = "";
        $result['id'] = "";

        $result['category'] = DB::table('categories')
                     -> where('status' , '1') 
                     -> get();

        $result['size'] = DB::table('sizes')->get();

        $result['color'] = DB::table('colors') -> get();

        $result['productAttrAttr']['0']['id'] = '';
        $result['productAttrAttr']['0']['products_id'] = '';
        $result['productAttrAttr']['0']['sku'] = '';
        $result['productAttrAttr']['0']['attr_image'] = '';
        $result['productAttrAttr']['0']['mrp'] = '';
        $result['productAttrAttr']['0']['price'] = '';
        $result['productAttrAttr']['0']['qty'] = '';
        $result['productAttrAttr']['0']['size_id'] = '';
        $result['productAttrAttr']['0']['color_id'] = '';

        $result['productImagesArr']['0']['id'] = '';
        $result['productImagesArr']['0']['images'] = '';

        
        // echo "<pre>";
        // print_r($result['productAttrAttr']);
        // die();

        // Below For Product Image 
        // echo "<pre>";
        // print_r($result['productImageArr']);
        //  die();  

        return view('admin/manage_product' , $result);

        }

           

        // $result['category'] = DB::table('categories')
        //                      -> where('status' , '1') 
        //                      -> get();
        // return view('admin/manage_product' , $result);

    }

    public function manage_product_process(Request $request){

        // echo "<pre>";
        // print_r($request->post());
        // echo "</pre>";
        // die();

        if($request->post('id') > 0){
            $image_validation = "mimes:jpeg,jpg,png";
        }else{
            $image_validation = "required|mimes:jpeg,jpg,png";
        }

        $request->validate(['name'=>'required', 
                            'image' => $image_validation,
                            'slug' => 'required|unique:products,slug,'. $request->id ,
                            'attr_image.*' => 'mimes:jpg,jpeg,png',
                            'images.*' => 'mimes:jpg,jpeg,png'
                            ]);

        $paidArr = $request->post('paid');
        $skuArr = $request->post('sku');
        $mrpArr = $request->post('mrp');
        $priceArr = $request->post('price');
        $qtyArr = $request->post('qty');
        $size_idArr = $request->post('size_id');
        $color_idArr = $request->post('color_id');

        foreach($skuArr as $key => $val){ // $skuArr is Number of Entry Comes into ...
            $check = DB::table('products_attr')
                    -> where('sku' , '=' , $skuArr[$key])
                    -> where('id' , '!=' , $paidArr[$key]) // mtlb is 'id' ke correspond kisi aur id me value hogi toh wo hume bta do
                    -> get();

            if(isset($check[0])){
                $request->session()->flash('sku_error' , $skuArr[$key] . ' SKU Already Used');
                return redirect(request()->headers->get('referer'));
            }        
        }



        if($request->id > 0){
            $model =  Product::find($request->post('id'));
            $msg = "Product Updated";
        }else{
            $model = new Product();
            $msg = "Product Inserted";    
        }
        
        $model->category_id = $request->post('category_id');
        $model->name = $request->post('name');
        
        // Insert Image Code Starts
        if($request->hasfile('image')){
            $image = $request->file('image');
            $ext = $image->extension();
            $image_name = time(). "." . $ext; 
            $image ->storeAs('/public/media/' , $image_name);
            $model->image = $image_name;
        }
        // Insert Image Code Ends

        $model->slug = $request->post('slug');
        $model->brand = $request->post('brand');
        $model->model = $request->post('model');
        $model->short_desc = $request->post('short_desc');
        $model->desc = $request->post('desc');
        $model->keywords = $request->post('keywords');
        $model->technical_specification = $request->post('technical_specification');        
        $model->uses = $request->post('uses');
        $model->warranty = $request->post('warranty');        
        $model->save();
        $pid = $model->id;

        /* Product Attr Start */

        // $paidArr = $request->post('paid');
        // $skuArr = $request->post('sku');
        // $mrpArr = $request->post('mrp');
        // $priceArr = $request->post('price');
        // $qtyArr = $request->post('qty');
        // $size_idArr = $request->post('size_id');
        // $color_idArr = $request->post('color_id');

        foreach($skuArr as $key => $val){

            $productAttrArr['products_id'] = $pid;
            $productAttrArr['sku'] = $skuArr[$key]; // Here We use key Value means we are saving value of keys ... Means [$key] => [$value] , means Value of key will be stored in database ...

            // $productAttrArr['attr_image'] = 'test';
            $productAttrArr['mrp'] = $mrpArr[$key] ;
            $productAttrArr['price'] = $priceArr[$key];
            $productAttrArr['qty'] = $qtyArr[$key];
            
            if($size_idArr[$key] == ""){
                $productAttrArr['size_id'] = 0;    
            }else{
                $productAttrArr['size_id'] = $size_idArr[$key];        
            }
            
            if($color_idArr[$key] == ""){
                $productAttrArr['color_id'] = 0;
            }else{
                $productAttrArr['color_id'] = $color_idArr[$key];    
            }
            

            // Condition For Image Store In Array Format Start
            
            if($request->hasFile("attr_image.$key")){

                $rand = rand('111111111' , '999999999');
                $attr_image = $request->file("attr_image.$key");
                $ext = $attr_image-> extension();
                $image_name = $rand . "." . $ext;
                $request->file("attr_image.$key")->storeAs('/public/media/' , $image_name);
                $productAttrArr['attr_image'] = $image_name;
            }



            if($paidArr[$key] != ""){
                DB::table('products_attr') 
                        -> where(['id' => $paidArr[$key] ])
                        -> update($productAttrArr);    
            }
            else
            {
                DB::table('products_attr') -> insert($productAttrArr);
            }

        }

        /* Product Attr End */


        /* Product Image Start */
        $piidArr = $request->post('piid');

    foreach($piidArr as $key => $val){
        $productImagesArr['products_id'] = $pid;
        if($request->hasFile("images.$key")){

            $rand = rand('111111111' , '999999999');
            $images = $request->file("images.$key");
            $ext = $images-> extension();
            $image_name = $rand . "." . $ext;
            $request->file("images.$key")->storeAs('/public/media/' , $image_name);
            $productImagesArr['images'] = $image_name;
                        
            }
         
            if($piidArr[$key] != ""){
                DB::table('product_images') 
                        -> where(['id' => $piidArr[$key] ])
                        -> update($productImagesArr);    
            }
            else
            {
                DB::table('product_images') -> insert($productImagesArr);
            }
        }

        /* Product Image End */


        $request->session()->flash('message' , $msg);
        return redirect('admin/product');

    }


    public function delete($id){
        $deleteProduct = Product::find($id) -> delete();
        session()->flash('message' , 'Product Deleted');
        return redirect('admin/product');
    }

    public function product_attr_delete($paid , $pid){
        
        DB::table('products_attr') -> Where(['id' => $paid]) -> delete();
        return redirect('admin/product/manage_product/' . $pid );
    }

    

    public function product_images_delete($paid , $pid){
    
    DB::table('product_images') -> Where(['id' => $paid]) -> delete();
    return redirect('admin/product/manage_product/' . $pid );
    }

}
