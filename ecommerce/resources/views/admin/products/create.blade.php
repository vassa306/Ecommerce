@extends('admin.layout.base') 
@section('title','Create Product')
@section('data-page-id','adminProducts') 

<!-- at first use isset - test if variable exists in page -->
@section('content')
	<div class="add-product">
		<div class="row expanded">
		   <div class="column medium-11">
				<h2>Add Inventory Item</h2>
			</div>
		</div>

		@include('includes.message')
		<form method="post" action="/admin/products/create">
			<div class ="small-12 medium-11">
				<div class="row expanded">
					<div class="small-12 medium-6 column">
					  	<label>Product Name:
					  		<input type="text" name="name" placeholder="Product Name" 
					  		value="{{ \app\classes\Request::old('post','name') }}">
					  	</label>
					</div>
			
									
			
					<div class="small-12 medium-6 column">
					  	<label>Product Price:
					  		<input type="text" name="price" placeholder="Product Price" 
					  		value="{{ \app\classes\Request::old('post','price') }}">
					  	</label>
					</div>
				</div>
			</div>
			
			<div class ="small-12 medium-11">
				<div class="row expanded">
					<div class="small-12 medium-6 column">
					  	<label>Product Category:
					  		<select name = "category" id="product-category">
					  			<option value="{{ \app\classes\Request::old('post','category')?:"" }}">
					  			 	{{ \app\classes\Request::old('post','category')?:"Select Category" }}
					  			</option>
					  			 @foreach ($categories as $category)
					  			 	<option value="{{ $category->id }}"> {{ $category->name }}</option>
					  			 @endforeach
					  		</select>
					  	</label>
					</div>
			
					<div class="small-12 medium-6 column">
					  	<label>Product SubCategory:
					  		<input type="text" name="price" placeholder="Product Subcategory" 
					  		value="{{ \app\classes\Request::old('post','price') }}">
					  	</label>
					</div>
				</div>
			</div>			
			
		</form>

	@include('includes.delete-modal') 
@endsection