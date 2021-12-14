<?php
namespace app\controllers\admin;

use app\classes\CSRFToken;
use app\classes\Request;
use app\classes\Session;
use app\models\Category;
use app\models\SubCategory;
use app\classes\ValidateRequest;
use app\classes\Redirect;
use app\classes\UploadFile;
use app\models\Product;
use app\controllers\BaseController;

class ProductController extends BaseController
{

    public $table_name = 'products';
    
    public $products;

    public $categories;

    public $links;

    public $subcategories;
    
    public $subcategories_links;
    
    public function __construct()
    {
        $this->categories = Category::all();
        
      //  list ($this->categories, $this->links) = paginate(5, $total, $this->table_name, $object);
      //   list ($this->subcategories, $this->subcategories_links) = paginate(5, $subtotal, 'sub_categories', new SubCategory);
    }

    public function showCreateProductForm()
    {
        $categories = $this->categories;
        return view('admin/products/create', compact('categories'));
    }
    public function store()
    {
        if (Request::has('post')){
            $request = Request::get('post');
            $file_error = [];
            
            if (CSRFToken::verifyCSRFToken($request->token)){
                $rules = [
                    
                    'name' => [
                        'required' => true,
                        'minLength' => 3,
                        'maxLength' => 70,
                        'mixed'  => true,
                        'unique' => $this->table_name
                    ],
                    
                    'price' => [
                        'required' => true,
                        'minLength' => 2,
                        'number' => true
                    ],
                    
                    'quantity'=>[
                        'required' => true
                    ],
                    
                    'category'=>[
                        'required' => true
                    ],
                    
                    'subcategory'=>[
                        'required' => true
                    ],
                    
                    'description'=>[
                        'required' => true,
                        'mixed' => true,
                        'minLength' => 4,
                        'maxLength' => 500,
                    ]
                ];
                
                
                $validate = new ValidateRequest;
                $validate->abide($_POST, $rules);
                
                $file = Request::get('file');
                isset($file->productImage->name)? $filename = $file->productImage->name : $filename = '';
                
                if (empty($filename)) {
                    $file_error['productImage']=['The product image is required'];
                }else if (!UploadFile::isImage($filename)){
                    $file_error['productImage']=['The image has an invalid format, please try again'];
                }
                
                if ($validate->hasError()) {
                    $response = $validate->getErrorMsgs();
                    count($file_error) ? $errors = array_merge($response,$file_error) : $errors = $response;
                    return view('admin/products/create', [
                        'categories' => $this->categories,
                        'errors' => $errors,
                    ]);
                }
                $ds = DIRECTORY_SEPARATOR;
                $temp_file = $file->productImage->tmp_name;
                $image_path =UploadFile::move($temp_file,"images{$ds}uploads{$ds}products",$filename)->path();
                // process form data
                Product::Create([
                    'name' => $request->name,
                    'description' =>  $request->description,
                    'price' => $request->price,
                    'category_id' => $request->category,
                    'sub_category_id' => $request->subcategory,
                    'quantity' => $request->quantity,
                    'image_path' => $image_path,
                ]);
                
                Request::refresh();
                
                
                return view('admin/products/create', [
                    'categories' => $this->categories,
                    'success' => 'Product created successfully' ,
                    
                ]);
            }
            
            throw new \Exception('Token Mismatch');
        }
        return null;
    }
    
    
   
    public function edit($id)
    {//var_dump($id);
        if (Request::has('post')) {
            $request = Request::get('post');
            $extra_errors = [];
//             echo json_encode([
//                 'success' => 'OK '.__LINE__." category: ".$id//print_r([$validate->hasError() , $duplicate_subcategory , $category],true)
//             ]);exit;
            
            if (CSRFToken::verifyCSRFToken($request->token, false)) {
                $rules = [
                    'name' => [
                        'required' => true,
                        'minLength' => 3,
                        'string' => true,
                        'unique' => 'categories'
                    ]
                ];
                $validate = new ValidateRequest();
                $validate->abide($_POST, $rules);
                /*get id from array*/
                
                $category = Category::where('id', $id)->exists();
                if (! $category) {
                    $extra_errors['name'] = array(
                        'Invalid Product Category'
                    );
                }
                
                
                if ($validate->hasError() || !$category) {
                    $errors = $validate->getErrorMsgs();
                    count($extra_errors) ? $response = array_merge($errors, $extra_errors) : $response = $errors;
                    header('HTTP/1.1 422 Unprocessable Entity', true, 422);
                    echo json_encode($response);
                    exit();
                }
                
                Category::where('id', $id)->update([
                    'name' => $request->name
                ]);
                echo json_encode([
                    'success' => 'Record Updated Sucessfully'
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
                Category::destroy($id);
                $subcategories = SubCategory::where('category_id',$id)->get();            
                if (count($subcategories)) {
                    foreach ($subcategories as $subcategory){
                        $subcategory->delete();
                    }
                    
                }
                Session::add('success', 'Category has been deleted');
                Redirect::to('/admin/products/categories');
            }
            throw new \Exception('Token Mismatch');
        }
        return null;
    }
    
    public function getSubcategories($id){
        $subcategories = SubCategory::where('category_id',$id)->get();
        echo json_encode($subcategories);
        exit;
    }
}


