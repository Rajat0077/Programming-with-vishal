@extends('admin/layout')
@section('page_title' , 'Manage Product')
@section('container')

<br>
<a href="{{ route('admin/product') }}">
<button class="au-btn au-btn-icon au-btn--blue">
<i class="zmdi zmdi-plus"></i>Back
</button> 
</a>
<br><br>
<div>


@if(session()->has('sku_error'))

<div class="sufee-alert alert with-close alert-danger alert-dismissible fade show">
 {{ session('sku_error') }}
<button type="button" class="close" data-dismiss="alert" aria-label="Close">
<span aria-hidden="true">×</span>
</button>
</div>

@endif

<!-- Showing Error for Image In Array Format Start -->
@error('attr_image.*')

<div class="sufee-alert alert with-close alert-danger alert-dismissible fade show">
 {{ $message }}
<button type="button" class="close" data-dismiss="alert" aria-label="Close">
<span aria-hidden="true">×</span>
</button>
</div>

@enderror
<!-- Showing Error for Image In Array Format End -->


<!-- Showing Error for Image In Array Format Start -->
@error('images.*')

<div class="sufee-alert alert with-close alert-danger alert-dismissible fade show">
 {{ $message }}
<button type="button" class="close" data-dismiss="alert" aria-label="Close">
<span aria-hidden="true">×</span>
</button>
</div>

@enderror
<!-- Showing Error for Image In Array Format End -->

<form action="{{route('admin/product/manage_product_process')}}" method="post" novalidate="novalidate" enctype="multipart/form-data">

<div class="card">
<div class="card-body">
<div class="card-title">
<h3 class="text-center title-2">Manage Product</h3>
</div>
<hr>

	
@if($id > 0)
	@php 
		$image_required = "";
	@endphp
@else
	@php 
		$image_required = "required";
	@endphp	
@endif	

<div class="form-group">
	{{ csrf_field() }}
<label for="cc-payment" class="control-label mb-1">name </label>
<input id="cc-pament" name="name" value="{{ $name }}" type="text" class="form-control" aria-required="true" aria-invalid="false" >

@error('name')
	<div class="alert alert-danger" role="alert">
	{{ $message}}
	</div>
@enderror

</div>


<div class="form-group">

<label for="cc-payment" class="control-label mb-1">Category </label>



<select name="category_id" type="text" class="form-control" aria-required="true" aria-invalid="false">
	<option value=""> Select Category</option>
	@foreach($category as $list)
		@if($list->id == $category_id)
			<option selected="" value="{{ $list -> id }}"> {{ $list -> category_name }}</option>
		@else
			<option value="{{ $list -> id }}"> {{ $list -> category_name }}</option>
	@endif	
	@endforeach
</select>

@error('category_id')
	<div class="alert alert-danger" role="alert">
	{{ $message}}
	</div>
@enderror

</div>

<div class="form-group">
	
<label for="cc-payment" class="control-label mb-1">Image </label>
<input id="image" name="image" type="file" class="form-control" aria-required="true" aria-invalid="false" {{$image_required}}>

@if($id > 0)
	<img src="{{asset('storage/media/' . $image)}}" width="120px" height="120px">
@endif


@error('image')
	<div class="alert alert-danger" role="alert">
	{{ $message}}
	</div>
@enderror

</div>



<div class="form-group">

<label for="cc-payment" class="control-label mb-1">Slug </label>
<input id="cc-pament" name="slug" value="{{ $slug }}" type="text" class="form-control" aria-required="true" aria-invalid="false" >

@error('slug')
	<div class="alert alert-danger" role="alert">
	{{ $message}}
	</div>
@enderror

</div>


<div class="form-group">

<label for="cc-payment" class="control-label mb-1">Brand </label>
<input id="cc-pament" name="brand" value="{{ $brand }}" type="text" class="form-control" aria-required="true" aria-invalid="false" >

@error('brand')
	<div class="alert alert-danger" role="alert">
	{{ $message }}
	</div>
@enderror

</div>


<div class="form-group">

<label for="cc-payment" class="control-label mb-1">model </label>
<input id="cc-pament" name="model" value="{{ $model }}" type="text" class="form-control" aria-required="true" aria-invalid="false" >

@error('model')
	<div class="alert alert-danger" role="alert">
	{{ $message}}
	</div>
@enderror

</div>



<div class="form-group">

<label for="cc-payment" class="control-label mb-1">short_desc </label>
<input id="cc-pament" name="short_desc" value="{{ $short_desc }}" type="text" class="form-control" aria-required="true" aria-invalid="false" >

@error('short_desc')
	<div class="alert alert-danger" role="alert">
	{{ $message}}
	</div>
@enderror

</div>



<div class="form-group">

<label for="cc-payment" class="control-label mb-1">desc </label>
<input id="cc-pament" name="desc" value="{{ $desc }}" type="text" class="form-control" aria-required="true" aria-invalid="false" >

@error('desc')
	<div class="alert alert-danger" role="alert">
	{{ $message}}
	</div>
@enderror

</div>


<div class="form-group">

<label for="cc-payment" class="control-label mb-1">keywords </label>
<input id="cc-pament" name="keywords" value="{{ $keywords }}" type="text" class="form-control" aria-required="true" aria-invalid="false" >

@error('keywords')
	<div class="alert alert-danger" role="alert">
	{{ $message}}
	</div>
@enderror

</div>

<div class="form-group">

<label for="cc-payment" class="control-label mb-1">technical_specification </label>
<input id="cc-pament" name="technical_specification" value="{{ $technical_specification }}" type="text" class="form-control" aria-required="true" aria-invalid="false" >

@error('desc')
	<div class="alert alert-danger" role="alert">
	{{ $message}}
	</div>
@enderror

</div>

<div class="form-group">

<label for="cc-payment" class="control-label mb-1">uses </label>
<input id="cc-pament" name="uses" value="{{ $uses }}" type="text" class="form-control" aria-required="true" aria-invalid="false" >

@error('uses')
	<div class="alert alert-danger" role="alert">
	{{ $message}}
	</div>
@enderror

</div>


<div class="form-group">

<label for="cc-payment" class="control-label mb-1">warranty </label>
<input id="cc-pament" name="warranty" value="{{ $warranty }}" type="text" class="form-control" aria-required="true" aria-invalid="false" >

@error('warranty')
	<div class="alert alert-danger" role="alert">
	{{ $message}}
	</div>
@enderror

</div>

<input type="hidden" name="id" value="{{ $id }}">
<br>
</div>
</div>

<!--Product Images start-->
<div class="card-title">
<h3 class="text-center title-2"> <i> <u> Product Images </u> </i></h3>
</div>

<div>
<div class="card" >

<div class="row" id="product_images_box">

@php
	$loop_count_num = 1;	
@endphp

@foreach($productImagesArr as $key => $val)
	
<?php 
	$loop_count_prev = $loop_count_num;
	$pIArr = (array)$val;  // $pIArr Stands for Product Image Array
?>

<div class="col-md-4 product_images_{{$loop_count_num++}}" >

<input id="piid" name="piid[]" type="hidden" value="{{$pIArr['id']}}" class="form-control">
<label for="cc-payment" class="control-label mb-1">Image Upload </label>
<input id="cc-pament" name="images[]"  type="file" class="form-control" aria-	required="true" aria-invalid="false" >

@if($pIArr['images'] != "")
	<a href="{{asset('storage/media/' . $pIArr['images'])}}" target="_blank">
		<img src="{{asset('storage/media/' . $pIArr['images'])}}" width="80px" height="80px"> 
	</a>
@endif

</div>

<div class="col-md-2">


@if($loop_count_num == 2)
<div class="col-md-2">

<!-- <label for="cc-payment" class="control-label mb-1">  &nbsp;&nbsp; </label> -->
<button type="button" class="btn btn-success btn-md" style="margin-top: 35px;" onclick="add_image_more()">
<i class="fa fa-plus" > </i>Add
</button>

</div>
@else

<a href="{{url('admin/product/product_images_delete')}}/{{$pIArr['id']}}/{{$id}}">
	<button type="button" class="btn btn-danger btn-md" style="margin-top: 35px;" onclick="remove_more({{$loop_count_prev}})">
	<i class="fa fa-minus" > </i>Remove
	</button>
	</a>

@endif


</div>
@endforeach
</div>



</div>
</div>

<!--Product Images End-->







<!--Product Attr start-->

<div class="card-title">
<h3 class="text-center title-2"> <i> <u> Product Attribute </u> </i></h3>
</div>


<div id="product_attr_box">

	@php
		$loop_count_num = 1;
	
	@endphp

@foreach($productAttrAttr as $key => $val)
	
	<?php 

		$loop_count_prev = $loop_count_num;
		$pAArr = (array)$val; // Here using Type Casting
		// echo "<pre>";
		// print_r($pAArr);
	?>

<div class="card" id="product_attr_{{$loop_count_num++}}">

<div class="card-body">
<div class="col-lg-12">
<div class="form-group">
<div class="row">

<input id="cc-pament" name="paid[]"  type="hidden" value="{{$pAArr['id']}}" class="form-control"  >


<div class="col-md-2">
<label for="cc-payment" class="control-label mb-1">Sku </label>
<input id="cc-pament" name="sku[]"  type="text" value="{{$pAArr['sku']}}" class="form-control" aria-	required="true" aria-invalid="false" >
</div>

<div class="col-md-2">
<label for="cc-payment" class="control-label mb-1">Mrp </label>
<input id="cc-pament" name="mrp[]"  type="text" value="{{$pAArr['mrp']}}"  class="form-control" aria-	required="true" aria-invalid="false" >
</div>

<div class="col-md-2">
<label for="cc-payment" class="control-label mb-1">Price </label>
<input id="cc-pament" name="price[]"  type="text" value="{{$pAArr['price']}}"  class="form-control" aria-	required="true" aria-invalid="false" >
</div>

<div class="col-md-2">
<label for="cc-payment" class="control-label mb-1">Qty </label>
<input id="cc-pament" name="qty[]"  type="text" value="{{$pAArr['qty']}}"  class="form-control" aria-	required="true" aria-invalid="false" >
</div>


<div class="col-md-2">
<label for="cc-payment" class="control-label mb-1">Size </label>

<select name="size_id[]" type="text" class="form-control" aria-required="true" aria-invalid="false">
<option value=""> Select </option>
@foreach($size as $list)
	@if($list -> id == $pAArr['size_id'])
<option selected value="{{ $list -> id }}"> {{ $list -> size }}</option>
	@else
<option value="{{ $list -> id }}"> {{ $list -> size }}</option>
	@endif	
@endforeach
</select>

</div>


<div class="col-md-2">
<label for="cc-payment" class="control-label mb-1">Color </label>
<select name="color_id[]" type="text" class="form-control" aria-required="true" aria-invalid="false">
<option value=""> Select </option>

@foreach($color as $list)
	@if($list -> id == $pAArr['color_id'])
<option selected value="{{ $list -> id }}"> {{ $list -> color }}</option>
	@else
<option value="{{ $list -> id }}"> {{ $list -> color }}</option>
	@endif
@endforeach
</select>
</div>

<div class="col-md-5"><br>
<label for="cc-payment" class="control-label mb-1">Image Upload </label>
<input id="cc-pament" name="attr_image[]"  type="file" class="form-control" aria-	required="true" aria-invalid="false" >

@if($pAArr['attr_image'] != "")
<img src="{{asset('storage/media/' . $pAArr['attr_image'])}}" width="80px" height="80px"> 
@endif
</div>



@if($loop_count_num > 2)
	<div class="col-md-5"><br>
	<label for="cc-payment" class="control-label mb-1">  &nbsp;&nbsp; </label>
	
	<a href="{{url('admin/product/product_attr_delete')}}/{{$pAArr['id']}}/{{$id}}">
	<button type="button" class="btn btn-danger btn-md" style="margin-top: 35px;" onclick="remove_more({{$loop_count_prev}})">
	<i class="fa fa-minus" > </i>Remove
	</button>
	</a>

	</div>

@else

	<div class="col-md-5"><br>
	<label for="cc-payment" class="control-label mb-1">  &nbsp;&nbsp; </label>
	<button type="button" class="btn btn-success btn-md" style="margin-top: 35px;" onclick="add_more()">
	<i class="fa fa-plus" > </i>Add
	</button>
	</div>


@endif
</div>		
</div>
<hr>
</div>

</div>
</div>
@endforeach
</div>

<!--Product Attr end-->





<div>
<button id="payment-button" type="submit" class="btn btn-lg btn-info btn-block">
<i class="fa fa-unlock fa-lg"></i>&nbsp;
<span id="payment-button-amount">ADD</span>
</button>
</div>

</form>
</div>


<script type="text/javascript">

	var loop_count = 1;
	function add_more(){
	  loop_count++;
		var html ='<input id="paid" name="paid[]"  type="hidden"  class="form-control"  ><div class="card" id="product_attr_'+loop_count+'"><div class="card-body"><div class="col-lg-12"><div class="form-group"><div class="row">';

			html+= '<div class="col-md-2"><label for="cc-payment" class="control-label mb-1">Sku </label><input id="cc-pament" name="sku[]"  type="text" class="form-control" aria-	required="true" aria-invalid="false" ></div>';

			html+= '<div class="col-md-2"><label for="cc-payment" class="control-label mb-1">Mrp </label><input id="cc-pament" name="mrp[]"  type="text" class="form-control" aria-	required="true" aria-invalid="false" ></div>';

			html+= '<div class="col-md-2"><label for="cc-payment" class="control-label mb-1">Price </label><input id="cc-pament" name="price[]"  type="text" class="form-control" aria-	required="true" aria-invalid="false" ></div>';

			html+= '<div class="col-md-2"><label for="cc-payment" class="control-label mb-1">Qty </label><input id="cc-pament" name="qty[]"  type="text" class="form-control" aria-	required="true" aria-invalid="false" ></div>';

			html+= '<div class="col-md-2"><label for="cc-payment" class="control-label mb-1">Size </label><select name="size_id[]" type="text" class="form-control" aria-invalid="false"><option value=""> Select </option>@foreach($size as $list)<option value="{{ $list -> id }}"> {{ $list -> size }}</option>@endforeach</select></div>';

			html+= '<div class="col-md-2"><label for="cc-payment" class="control-label mb-1">Color </label><select name="color_id[]" type="text" class="form-control" aria-invalid="false"><option value=""> Select </option>@foreach($color as $list)<option value="{{ $list -> id }}"> {{ $list -> color }}</option>@endforeach</select></div>';

			html+= '<div class="col-md-5"><br><label for="cc-payment" class="control-label mb-1">Image Upload </label><input id="cc-pament" name="attr_image[]"  type="file" class="form-control" aria-	required="true" aria-invalid="false" ></div>';

			html+='<div class="col-md-5"><br><label for="cc-payment" class="control-label mb-1">  &nbsp;&nbsp; </label><button type="button" class="btn btn-danger btn-md" style="margin-top: 35px;" onclick="remove_more('+loop_count+')"><i class="fa fa-minus" > </i>&nbsp;Remove</button></div>';

			html+= '</div></div></div></div></div>';

			jQuery('#product_attr_box').append(html);
	}


	function remove_more(loop_count){
		jQuery('#product_attr_'+loop_count).remove(); 
	}

	var loop_image_count=1;

	function add_image_more(){

		// alert('Add More Image');
		loop_image_count++;
		var html= '<input id="cc-pament" id="piid" name="piid[]"  type="hidden" class="form-control"><div class="col-md-4 product_images_'+loop_image_count+'" ><label for="cc-payment" class="control-label mb-1">Images Upload </label><input id="cc-pament" name="images[]"  type="file" class="form-control" aria-	required="true" aria-invalid="false" ></div>';		
		
		html+='<div class="col-md-2 product_images_'+loop_image_count+'""><button type="button" class="btn btn-danger btn-md" style="margin-top: 35px;" onclick="remove_image_more('+loop_image_count+')"><i class="fa fa-minus" > </i>&nbsp;Remove</button></div>';
		
		jQuery('#product_images_box').append(html);
	}

		function remove_image_more(loop_count){
		jQuery('.product_images_'+loop_count).remove(); 
		}

</script>
@endsection