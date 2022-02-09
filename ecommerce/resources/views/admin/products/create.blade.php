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
		<form method="post" action="/admin/products/create" enctype="multipart/form-data">
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
					  		<select name ="category" id="product-category">
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
					  	<label>Product Quantity:
					  		<select name = "quantity">
					  			<option value="{{ \app\classes\Request::old('post','quantity')?:" "}}">
					  			 	{{ \app\classes\Request::old('post','quantity')?:"Select Quantity" }}
					  			</option>
					  			@for($i=1; $i <= 50; $i++)
					  				<option value="{{ $i }}">{{ $i }}</option>
					  			@endfor	
					  		</select>
					  	</label>
					</div>
			
					<div class="small-12 medium-6 column">
					  	<label>Product SubCategory:
					  		<select name = "subcategory" id="product-subcategory">
					  			<option value="{{ \app\classes\Request::old('post','subcategory')?:"" }}">
					  			 	{{ \app\classes\Request::old('post','subcategory')?:"Select subcategory" }}
					  			</option>
					  		</select>
					  	</label>
					</div>
				
			
			<div class="small-12 medium-6 column">
			</br>
			<div class="input-group">
                       <span class="input-group-label">Product Image:</span>
                       <input type="file" name="productImage" class="input-group-field">
                 </div>
              </div>	
            <div class="small-12 column">
            <label>Description:
            <textarea name="description" placeholder="Description">{{\app\classes\Request::old('post','description')}}</textarea> 
            </label>
            <input type="hidden" name="token" value="{{\app\classes\CSRFToken::_token()}}">
            <button class="button alert"  type="reset">Reset</button>
            <input class="button success float-right" type="submit" value="Save Product">
            </div>
          </div>   
		</form>
	</div>

	@include('includes.delete-modal') 
@endsection