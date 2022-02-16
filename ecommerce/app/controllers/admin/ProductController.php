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
        $total = Product::all()->count();
        
        list ($this->products, $this->links) = paginate(5, $total, $this->table_name, New Product);
      //   list ($this->subcategories, $this->subcategories_links) = paginate(5, $subtotal, 'sub_categories', new SubCategory);
    }
    
    public function show(){
        $products = $this->products;
        $links = $this->links;
        return view('admin/products/inventory', compact('products','links'));
    }
    
    public function showEditProductForm($id){
        $categories = $this->categories;
        $product = Product::where('id',$id)->with(['category','subCategory'])->first();
        return view('admin/products/edit', compact('product','categories'));
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
    
    
   
    public function edit()
    {//var_dump($id);
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
                        
                    ],
                    
                    'price' => [
                        'required' => true,
                        'minLength' => 1,
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
                
                
                if (isset($file->productImage->name) && !UploadFile::isImage($filename)){
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
                
                $product = Product::findorFail($request->product_id);
                /* the same as where('id',$request->product_id)->first();
                if(!$product){
                    throw new \Exception('Invalid Product ID');*/
                $product->name =$request->name;
                $product->description =$request->description;
                $product->price =$request->price;
                $product->category_id =$request->category;
                $product->sub_category_id =$request->subcategory;
                
                if ($filename) {
                    $ds = DIRECTORY_SEPARATOR;
                    $old_image_path = BASE_PATH."{$ds}public{$ds}$product->image_path";
                    $temp_file = $file->productImage->tmp_name;
                    $image_path =UploadFile::move($temp_file,"images{$ds}uploads{$ds}products",$filename)->path();
                    unlink($old_image_path);
                    //save new product image into databse
                    $product->image_path = $image_path;
                }
                $product->save();
                Session::add('success', 'Record Updated');
                Redirect::to('/admin/products');
                // process form data
               
                Request::refresh();
                
                
                return view('admin/products/create', [
                    'categories' => $this->categories,
                    'success' => 'Product edited successfully' ,
                    
                ]);
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
                Product::destroy($id);
                
                Session::add('success', 'Product has been deleted');
                Redirect::to('/admin/products');
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


