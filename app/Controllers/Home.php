<?php

namespace App\Controllers;

use Firebase\JWT\JWT;

class Home extends BaseController
{
    public function index()
    {
        return view('token');
    }

    public function getKey()
    {
        return "QWERTYASDFGH";
    }

    public function login()
    {
        $iat = time();
        $nbf = $iat + 5;  // não pode usar o token antes de
        $exp = $iat + 600; // token expira

        $payload = [
            "iat" => $iat,
            "nbf" => $nbf,
            "exp" => $exp,
            "userdata" => 'informações do usuário'
        ];

        $token = JWT::encode($payload, $this->getKey(), 'HS256');

        header('Token', $token);

        $authorization = apache_request_headers();
        $res = $this->request->getServer('HTTP_AUTHORIZATION');
        $response_http = service('response');

        return view('login');
    }
}
