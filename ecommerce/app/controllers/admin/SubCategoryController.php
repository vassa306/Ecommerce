<?php
namespace app\controllers\admin;

use app\classes\CSRFToken;
use app\classes\Request;
use app\classes\Session;
use app\models\Category;
use app\classes\ValidateRequest;
use app\classes\Redirect;
use app\controllers\BaseController;
use app\models\SubCategory;


class SubCategoryController extends BaseController
{
    
    public function store()
    {
        if (Request::has('post')) {
            $request = Request::get('post');
            $extra_errors = [];
            
            if (CSRFToken::verifyCSRFToken($request->token, false)) {
                $rules = [
                    'name' => [
                        'required' => true,
                        'minLength' => 3,
                        'string' => true
                    ],
                    'category_id' => [
                        'required' => true
                    ]
                ];
                $validate = new ValidateRequest();
                $validate->abide($_POST, $rules);
                
                $duplicate_subcategory = SubCategory::where('name', $request->name)->where('category_id', $request->category_id)->exists();
                if ($duplicate_subcategory) {
                    $extra_errors['name'] = array(
                        'Subcategory already exists'
                    );
                }
                
                $category = Category::where('id', $request->category_id)->exists();
                if (! $category) {
                    $extra_errors['name'] = array(
                        'Invalid Product Category'
                    );
                }
                
                if ($validate->hasError() || $duplicate_subcategory || !$category) {
                    $errors = $validate->getErrorMsgs();
                    // array_merge: merge two array into just one
                    count($extra_errors) ? $response = array_merge($errors, $extra_errors) : $response = $errors;
                    header('HTTP/1.1 422 Unprocessable Entity', true, 422);
                    echo json_encode($response);
                    exit();
                }
                
                //             echo json_encode([
                //                 'success' => 'OK '.__LINE__." category: ".$category//print_r([$validate->hasError() , $duplicate_subcategory , $category],true)
                //             ]);exit;
                // process form data
                SubCategory::Create([
                    'name' => $request->name,
                    'slug' => slug($request->name),
                    'category_id' => $request->category_id
                ]);
                echo json_encode([
                    'success' => 'Subcategory Created Successfully'
                ]);
                exit;
            }
            
            throw new \Exception('Token Mismatch');
        }
        return null;
    }
    
    public function edit($id)
    {
        if (Request::has('post')) {
            $request = Request::get('post');
            $extra_errors = [];
            
            if (CSRFToken::verifyCSRFToken($request->token, false)) {
                $rules = [
                    'name' => [
                        'required' => true,
                        'minLength' => 3,
                        'string' => true
                    ],
                    'category_id' => [
                        'required' => true
                    ]
                ];
                
                $validate = new ValidateRequest();
                $validate->abide($_POST, $rules);
                $duplicate_subcategory = SubCategory::where('name', $request->name)->where('category_id', $request->category_id)->exists();
                if ($duplicate_subcategory) {
                    $extra_errors['name'] = array(
                        'You have not any changes'
                    );
                }
                $category = Category::where('id', $request->category_id)->exists();
                if (! $category) {
                    $extra_errors['name'] = array(
                        'Invalid Product Category'
                    );
                }
                
                if ($validate->hasError() || $duplicate_subcategory || !$category) {
                    $errors = $validate->getErrorMsgs();
                    // array_merge: merge two array into just one
                    count($extra_errors) ? $response = array_merge($errors, $extra_errors) : $response = $errors;
                    header('HTTP/1.1 422 Unprocessable Entity', true, 422);
                    echo json_encode($response);
                    exit;
                }
                SubCategory::where('id', $id)->update([
                    'name' => $request->name, 'category_id' =>$request->category_id
                ]);
                echo json_encode([
                    'success' => 'Subcategory Updated Sucessfully'
                ]);
                exit();
                
                // process form data
            }
            
            throw new \Exception('Token Mismatch');
        }
        return null;
    }
    
    public function delete($id)
    {
        if (Request::has('post')) {
            $request = Request::get('post');
            if (CSRFToken::verifyCSRFToken($request->token)) {
                SubCategory::destroy($id);
                Session::add('success', 'SubCategory has been deleted');
                Redirect::to('/admin/products/categories');
                
            }
            throw new \Exception('Token Mismatch');
        }
        return null;
    }
}
