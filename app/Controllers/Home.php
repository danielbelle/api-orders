<?php

namespace App\Controllers;

use Firebase\JWT\JWT;

class Home extends BaseController
{
    public function index()
    {
        $orders_detail='';
        return view('list_order',array($orders_detail));
    }

}
