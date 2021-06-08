@extends('admin/layout')
@section('page_title' , 'Manage Color')
@section('container')

<br>
<a href="{{ route('admin/color') }}">
<button class="au-btn au-btn-icon au-btn--blue">
<i class="zmdi zmdi-plus"></i>Back
</button> 
</a>

<br><br>

<div class="card">
<div class="card-header"></div>
<div class="card-body">
<div class="card-title">
<h3 class="text-center title-2"><b> Manage Color </b> </h3>
</div>
<hr>
<form action="{{route('color/manage_color_process')}}" method="post" novalidate="novalidate">


<div class="form-group">
	{{ csrf_field() }}
<label for="cc-payment" class="control-label mb-1">Color </label>
<input id="cc-pament" name="color" value="{{$color}}" type="text" class="form-control" aria-required="true" aria-invalid="false" >

@error('color')

	<div class="alert alert-danger" role="alert">
	{{ $message}}
	</div>

@enderror

</div>


<input type="hidden" name="id" value="{{ $id }}">

<br>
<div>
<button id="payment-button" type="submit" class="btn btn-lg btn-info btn-block">
<i class="fa fa-unlock fa-lg"></i>&nbsp;
<span id="payment-button-amount">ADD</span>
</button>
</div>

</form>
</div>
</div>

@endsection