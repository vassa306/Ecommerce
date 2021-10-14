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