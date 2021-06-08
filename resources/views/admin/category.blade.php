@extends('admin/layout')
@section('site_title' , 'Category')
@section('page_title' , 'Category Section')
@section('container')

<br>

<a href="{{ route('admin/category/manage_category')}}">
<button class="au-btn au-btn-icon au-btn--green">
<i class="zmdi zmdi-plus"></i> <b style="color:black;">Add Category </b> 
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
<th>Category Name</th>
<th>Category Slug</th>
<th>Action</th>
</tr>
</thead>
<tbody>


@foreach($data as $list)
<tr>
<td> {{ $list -> category_name }} </td>
<td> {{ $list -> category_slug }} </td>

<td> 

	<a href="{{URL::to('admin/category/manage_category/'. $list->id) }}"">
	<button type="button" class="btn btn-primary btn-sm">Edit</button>
	</a> 

	<a href="{{URL::to('admin/delete/'. $list->id) }}">
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