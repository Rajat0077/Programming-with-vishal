@extends('admin/layout')
@section('site_title' , 'Product')
@section('page_title' , 'Product Section')
@section('container')

<br>

<a href="{{ route('admin/product/manage_product')}}">
<button class="au-btn au-btn-icon au-btn--green">
<i class="zmdi zmdi-plus"></i> <b style="color:black;">Add Product </b> 
</button> 
</a>

 <br><br>

<div class="alert alert-primary" role="alert">
{{ session('message')}}	
</div>


<div class="table-responsive m-b-40">
<table class="table table-borderless table-data3">
<thead>
<tr>
<th> Name  </th>
<th> Brand  </th>
<th> Image </th>
<th> Action </th>
</tr>
</thead>
<tbody>


@foreach($data as $list)
<tr>
<td> {{ $list-> name}} </td>
<td> {{ $list-> brand}}</td>

<td> <img src="{{asset('storage/media/' . $list->image)}}" width="80px" height="80px"> </td>

<td> 

	<a href="{{URL::to('admin/product/manage_product/' . $list->id) }}">
	<button type="button" class="btn btn-primary btn-sm">Edit</button>
	</a> 

	<a href="{{URL::to('admin/product/delete/' . $list->id) }}">
		<button type="button" class="btn btn-danger btn-sm">DELETE</button>
	</a> 

	
	<a href="">
	<button type="button" class="btn btn-success btn-sm">Active</button>
	&nbsp;
	<a href="">
	<button type="button" class="btn btn-warning btn-sm">DeActive</button>
	</a> 

</td>
</tr>
@endforeach


</tbody>
</table>
</div>

@endsection