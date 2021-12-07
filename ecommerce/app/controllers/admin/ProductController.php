<?php
namespace app\controllers\admin;

use app\classes\CSRFToken;
use app\classes\Request;
use app\classes\Session;
use app\models\Category;
use app\models\SubCategory;
use app\classes\ValidateRequest;
use app\classes\Redirect;

class ProductController
{

    public $table_name = 'categories';

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
        if (Request::has('post')) {
            $request = Request::get('post');

            if (CSRFToken::verifyCSRFToken($request->token)) {
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
                if ($validate->hasError()) {
                    $errors = $validate->getErrorMsgs();
                    return view('admin/products/categories', [
                        'categories' => $this->categories,
                        'links' => $this->links,
                        'errors' => $errors,
                        'subcategories' => $this->subcategories,
                        'subcategories_links' => $this->subcategories_links
                        
                    ]);
                }

                // process form data
                Category::Create([
                    'name' => $request->name,
                    'slug' => slug($request->name)
                ]);
                $total = Category::all()->count();
                $subtotal = SubCategory::all()->count();
                list ($this->categories, $this->links) = paginate(5, $total, $this->table_name, new Category());
                list ($this->subcategories, $this->subcategories_links) = paginate(5, $subtotal, 'sub_categories', new SubCategory);

                return view('admin/products/categories', [
                    'categories' => $this->categories,
                    'links' => $this->links,
                    'success' => 'Category Created',
                    'subcategories' => $this->subcategories,
                    'subcategories_links' => $this->subcategories_links
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


