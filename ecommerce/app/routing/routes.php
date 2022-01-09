<?php
$router = new AltoRouter();
$router->map('GET', '/', 'app\Controllers\IndexController@show', 'home');

$router->map('GET', '/admin', 'app\controllers\admin\DashboardController@show', 'admin_dashboard');
$router->map('POST', '/admin', 'app\controllers\admin\DashboardController@get', 'admin_form');

/* product management */
$router->map('GET', '/admin/products/categories', 'app\controllers\admin\ProductCategoryController@show', 'product_category');
$router->map('POST', '/admin/products/categories', 'app\controllers\admin\ProductCategoryController@store', 'create_product_category');
/* router for edit form */
$router->map('POST', '/admin/products/categories/[i:id]/edit', 'app\controllers\admin\ProductCategoryController@edit', 'edit_product_category');
/* router form */
$router->map('POST', '/admin/products/categories/[i:id]/delete', 'app\controllers\admin\ProductCategoryController@delete', 'delete_product_category');
/* router for subcategory */
$router->map('POST', '/admin/products/subcategory/create', 'app\controllers\admin\SubCategoryController@store', 'create_subcategory');
//edit subcategory routes
$router->map('POST', '/admin/products/subcategories/[i:id]/edit', 'app\controllers\admin\SubCategoryController@edit', 'edit_subcategory');

$router->map('POST', '/admin/products/subcategories/[i:id]/delete', 'app\controllers\admin\SubCategoryController@delete', 'delete_subcategory');

//Products
$router->map('GET', '/admin/category/[i:id]/selected', 'app\controllers\admin\ProductController@getSubcategories', 'selected_category');

$router->map('GET', '/admin/products/create', 'app\controllers\admin\ProductController@showCreateProductForm', 'create_product_form');

$router->map('POST', '/admin/products/create', 'app\controllers\admin\ProductController@store', 'create_product');
// router for show products 
$router->map('GET', '/admin/products', 'app\controllers\admin\ProductController@show', 'show_products');

//router for edit products
$router->map('GET', '/admin/products/[i:id]/edit', 'app\controllers\admin\ProductController@showEditProductForm', 'edit_product_form');

$router->map('POST', '/admin/products/edit', 'app\controllers\admin\ProductController@edit', 'edit_product');