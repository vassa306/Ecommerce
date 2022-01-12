@extends('admin.layout.base') @section('title','Dashboard')

@section('content')
<div class="dashboard">
	<div class="row expanded">
		<h2>Dashboard</h2>
		{{$admin}} <br>
		<!--      {!! \app\classes\CSRFToken::_token() !!}
		{!!\app\classes\Session::get('token')!!}
		{{$_SERVER['REQUEST_URI']}} -->
		<form action="/admin" method="post" enctype="multipart/form-data">
			<input name="product" value="testing"> <input type="file"
				name="image"> <input type="submit" value="go" name="submit">
		</form>
	   <!-- \app\classes\Request::all()-->  
		</div>
</div>
@endsection
