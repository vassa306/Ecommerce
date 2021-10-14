<?php
namespace app\controllers\admin;

use app\classes\Request;
use app\classes\Session;
use app\controllers\BaseController;

class DashboardController extends BaseController
{

    public function show()
    {
        Session::add('admin', 'You are welcome Admin');

        if (Session::has('admin')) {
            $msg = Session::get('admin');
        } else {
            $msg = 'not defined';
        }
        return view('admin/dashboard', [
            'admin' => $msg
        ]);
    }

    /**
     * get specific request type
     */
    public function get()
    {
        Request::refresh();
        $data = Request::old('post', 'product');
        var_dump($data);
    }
}

