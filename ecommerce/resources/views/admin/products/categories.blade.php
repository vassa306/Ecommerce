use @extends('admin.layout.base') @section('title','Product Categories')
@section('data-page-id','adminCategories') @section('content')
<div class="category">
	<div class="row expanded column">
		<h2>Categories</h2>
	</div>
	@include('includes.message')
	<!-- at first use isset - test if variable exists in page -->

	<div class="category">
		<div class="row expanded column">
			<h2>Product Categories</h2>
			
		</div>

		@include('includes.message')

		<div class="row expanded">
			<div class="small-12 medium-6 column">
				<form action="" method="post">
					<div class="input-group">
						<input type="text" class="input-group-field"
							placeholder="Search by name">
						<div class="input-group-button">
							<input type="submit" class="button" value="Search">
						</div>
					</div>
				</form>
			</div>

			<div class="small-12 medium-5 end column">
				<form action="/admin/products/categories" method="post">
					<div class="input-group">
						<input type="text" class="input-group-field" name="name"
							placeholder="Category Name"> <input type="hidden" name="token"
							value="{{ \app\classes\CSRFToken::_token() }}">
						<div class="input-group-button">
							<input type="submit" class="button" value="Create">
						</div>
					</div>
				</form>
			</div>
		</div>



		<!-- Delete Category -->
		<div class="row expanded">
			<div class="small-12 medium-11 column">
				@if(count($categories))
				<table class="hover unstriped" data-form="deleteForm">
					<thead>
				 		<tr>
							<th>Name</th>
							<th>Slug</th>
							<th>Date Created</th>
							<th>Action</th>
				 		</tr>
					</thead>
					<tbody>
						@foreach($categories as $category)
						<tr>
							<td>{{$category['name']}}</td>
							<td>{{$category['slug']}}</td>
							<td>{{$category['added']}}</td>
							<td width="100" class="text-right"><span data-tooltip
								aria-haspopup="true" class="has-tip top"
								data-disable-hover="false" tabindex="1" title="Add Sub Category">
									<a data-open="add-subcategory-{{$category['id']}}"><i
										class="fa fa-plus"></i> </a>
							</span> <span data-tooltip aria-haspopup="true"
								class="has-tip top" data-disable-hover="false" tabindex="1"
								title="Edit Category"> <a data-open="item-{{$category['id']}}"><i
										class="fa fa-edit"></i> </a>
							</span> <span> <span style="display: inline-block" data-tooltip
									aria-haspopup="true" class="has-tip top"
									data-disable-hover="false" tabindex="1" title="Delete Category">
										<form method="post"
											action="/admin/products/categories/{{$category['id']}}/delete"
											class="delete-item">
											<input type="hidden" name="token"
												value="{{\app\classes\CSRFToken::_token()}}">
											<button type="submit">
												<i class="fa fa-times delete"></i>
											</button>
										</form>
								</span> <!-- Edit Category Modal  -->
									<div class="reveal" id="item-{{$category['id']}}" data-reveal
										data-close-on-click="false" data-close-on-esc="false">
										<div class="notification callout primary"></div>
										<h3>Edit Category</h3>
										<form>
											<div class="input-group">
												<label>Category Name <input type="text"
													id="item-name-{{$category['id']}}" name="name"
													value="{{$category['name']}}">
												</label>

												<div>
													<input type="submit" class="button update-category"
														id="submit-item-{{$category['id']}}" name="token"
														data-token="{{\app\classes\CSRFToken::_token()}}"
														data-category-id="{{$category['id']}}" value="Update">
												</div>
											</div>
										</form>
										<a href="/admin/products/categories" class="close-button"
											aria-label="Close modal" type="button"> <span
											aria-hidden="true">&times;</span>
										</a>

									</div> <!--Add Subcategory-->
									<div class="reveal" id="add-subcategory-{{$category['id']}}"
										data-reveal data-close-on-click="false"
										data-close-on-esc="false">
										<div class="notification callout primary"></div>
										<h3>Add Subcategory</h3>
										<form>
											<div class="input-group">
												<input type="text" id="subcategory-name-{{$category['id']}}">
												<div>
													<input type="submit" class="button add-subcategory"
														id="{{$category['id']}}" name="token"
														data-token="{{\app\classes\CSRFToken::_token()}}"
														value="Create">
												</div>
											</div>
										</form>
										<a href="/admin/products/categories" class="close-button"
											aria-label="Close modal" type="button"> <span
											aria-hidden="true">&times;</span>
										</a>
									</div></td>
						</tr>
						@endforeach
					</tbody>
				</table>
				{!! $links !!} @else
				<h3>You have not any category</h3>
				@endif
			</div>
		</div>
	</div>
	




	<div class="subcategory">
		<div class="row expanded column">
			<h2>Sub Categories</h2>

		</div>

		<!-- at first use isset - test if variable exists in page -->

		<div class="row expanded"></div>


		<!-- Delete Category -->
		<div class="row expanded">
			<div class="small-12 medium-11 column">
				@if(count($subcategories))
				<table class="hover unstriped" data-form="deleteForm">
				<thead>
				 <tr>
					<th>Name</th>
					<th>Slug</th>
					<th>Date Created</th>
					<th>Action</th>
				 </tr>
				</thead>
					<tbody>
						@foreach($subcategories as $subcategory)
						<tr>
							<td>{{$subcategory['name']}}</td>
							<td>{{$subcategory['slug']}}</td>
							<td>{{$subcategory['added']}}</td>
							<td width="100" class="text-right"><span data-tooltip
								aria-haspopup="true" class="has-tip top"
								data-disable-hover="false" tabindex="1" title="Edit SubCategory">
									<a data-open="item-subcategory-{{$subcategory['id']}}"><i
										class="fa fa-edit"></i> </a>
							</span>  
							<span style="display: inline-block" data-tooltip
									aria-haspopup="true" class="has-tip top"
									data-disable-hover="false" tabindex="1"
									title="Delete SubCategory">
										<form method="post"
											action="/admin/products/subcategories/{{$subcategory['id']}}/delete"
											class="delete-item">
											<input type="hidden" name="token"
												value="{{\app\classes\CSRFToken::_token()}}">
											<button type="submit">
												<i class="fa fa-times delete"></i>
											</button>
										</form>
										
								</span> <!-- Edit SubCategory Modal  aa-->
									<div class="reveal"
										id="item-subcategory-{{$subcategory['id']}}" data-reveal
										data-close-on-click="false" data-close-on-esc="false">
										<div class="notification callout primary"></div>
										<h3>Edit SubCategory</h3>
										<form>
											<div class="input-group">
												<label>Category Name <input type="text"
													id="item-name-subcategory-{{$subcategory['id']}}"
													value="{{$subcategory['name']}}">
												</label>
												<label>Change Category
												  <select id="item-category-{{ $subcategory['category_id'] }}">
                                                        @foreach(\app\models\Category::all() as $category)
                                                            @if($category->id == $subcategory['category_id'])
                                                                <option selected="selected" value="{{ $category->id }}">
                                                                    {{ $category->name }}
                                                                </option>
                                                            @endif
                                                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                                                        @endforeach
                                                    </select>
												</label>

												<div>
													<input type="submit" class="button update-subcategory"
														id="submit-item-{{$category['id']}}" name="token"
														data-token="{{\app\classes\CSRFToken::_token()}}"
														data-subcategory-id="{{$subcategory['id']}}"
														data-category-id="{{$subcategory['category_id']}}" value="Update">
												</div>
											</div>
										</form>
										<a href="/admin/products/categories" class="close-button"
											aria-label="Close modal" type="button"> <span
											aria-hidden="true">&times;</span>
										</a>

									</div> <!--Add Subcategory modal--></td>
						</tr>
						@endforeach
					</tbody>
				</table>
				{!! $subcategories_links !!} @else
				<h3>You have not any subcategory</h3>
				@endif

			</div>
		</div>

	@include('includes.delete-modal') 
@endsection@endsection