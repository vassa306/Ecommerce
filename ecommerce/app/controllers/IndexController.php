<?php
namespace app\controllers;

use app\Classes\Mail;

class IndexController extends BaseController
{

    public function show()
    {
        // echo "Inside Homepage from controller class";
        $mail = new Mail();
        $data = [
            'to' => 'vassa306@gmail.com',
            'subject' => 'Welcome to Acme Store Eshop',
            'view' => 'welcome',
            'name' => 'vassa306',
            'body' => "testing of my Email template"
        ];
        if ($mail->send($data)) {
            echo "email sent sucessfully";
        } else {
            echo "Email sending failed";
        }
    }
}

?>