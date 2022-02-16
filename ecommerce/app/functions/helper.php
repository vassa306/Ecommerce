<?php
use Philo\Blade\Blade;
use voku\helper\Paginator;
use Illuminate\Database\Capsule\Manager as Capsule;

function view($path, array $data = [])
{
    $view = __DIR__ . '/../../resources/views';
    $cache = __DIR__ . '/../../bootstrap/cache';
    $blade = new Blade($view, $cache);
    echo $blade->view()
        ->make($path, $data)
        ->render();
}

function make($filename, $data)
{
    extract($data);
    // ob start includes data into internal buffer not display in the page
    ob_start();
    // include template from views/emails
    include (__DIR__ . '/../../resources/views/emails/' . $filename . '.php');

    $content = ob_get_contents();

    ob_end_clean();

    return $content;
}

function slug($value)
{
    // remove all characters not in this list letters,numbers,whitespaces,
    $value = preg_replace('![^' . preg_quote('_') . '\pL\pN\s]+!u', '', mb_strtolower($value));

    // $value = preg_replace('![^'.preg_quote('_').'s]+!u', '',$value);

    return str_replace(' ', '-', trim($value));
}

function paginate($num_of_records, $total_record, $table_name, $object)
{
    $pages = new Paginator($num_of_records, 'p');
    $pages->set_total($total_record);

    $data = Capsule::select("Select * From $table_name WHERE deleted_at is null 
                    Order by created_at DESC" . $pages->get_limit());
    $categories = $object->transform($data);

    return [
        $categories,
        $pages->page_links()
    ];
}

        
    
  
   
    




