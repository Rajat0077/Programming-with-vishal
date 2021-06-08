@extends('admin/layout')
@section('site_title' , 'Size')
@section('page_title' , 'Size Section')
@section('container')

<br>

<a href="{{ route('admin/size/manage_size')}}">
<button class="au-btn au-btn-icon au-btn--green">
<i class="zmdi zmdi-plus"></i> <b style="color:black;">Add Size </b> 
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
<th>Size Name</th>

<th>Action</th>
</tr>
</thead>
<tbody>


@foreach($data as $list)
<tr>
<td> {{$list->size}} </td>


<td> 

	<a href="{{URL::to('admin/size/manage_size/' . $list->id ) }}"">
	<button type="button" class="btn btn-primary btn-sm">Edit</button>
	</a> 

	<a href="{{URL::to('admin/size/delete/' . $list->id) }}">
		<button type="button" class="btn btn-danger btn-sm">DELETE</button>
	</a> 

	@if($list->status == 1)	
	<a href="{{ URL::to('admin/size/status/0/' . $list->id) }}">
	<button type="button" class="btn btn-success btn-sm">Active</button>
	@elseif($list->status == 0)	
	&nbsp;

	<a href="{{ URL::to('admin/size/status/1/' . $list->id) }}">
	<button type="button" class="btn btn-warning btn-sm">DeActive</button>
	</a> 
	@endif


</td>
</tr>
@endforeach


</tbody>
</table>
</div>

@endsection