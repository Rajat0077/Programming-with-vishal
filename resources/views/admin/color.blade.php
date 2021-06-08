@extends('admin/layout')
@section('site_title' , 'Color')
@section('page_title' , 'Color Section')
@section('container')

<br>

<a href="{{ route('admin/color/manage_color')}}">
<button class="au-btn au-btn-icon au-btn--green">
<i class="zmdi zmdi-plus"></i> <b style="color:black;">Add Color </b> 
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
<th>Color Name</th>
<th>Action</th>
</tr>
</thead>
<tbody>


@foreach($data as $list)
<tr>
<td> {{$list->color}}  </td>

<td> 

	<a href="{{URL::to('admin/color/manage_color/' . $list->id) }}">
	<button type="button" class="btn btn-primary btn-sm">Edit</button>
	</a> 

	<a href="{{URL::to('admin/color/delete/' . $list->id) }}">
		<button type="button" class="btn btn-danger btn-sm">DELETE</button>
	</a> 

	@if($list->status == 1)
	<a href="{{ URL::to('admin/color/status/0/' . $list->id) }}">
	<button type="button" class="btn btn-success btn-sm">Active</button>
	</a>
	@elseif($list->status == 0)
	&nbsp;
	<a href="{{ URL::to('admin/color/status/1/' . $list->id) }}">
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