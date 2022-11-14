<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\ProductModel;
use Exception;

class Product extends Controller
{

    public function index()
    {
        $model = new ProductModel();

        $data['products_detail'] = $model->orderBy('id', 'DESC')->findAll();

        return view('list_product', $data);
    }


    public function store()
    {
        helper(['form', 'url']);

        $model = new ProductModel();

        $response_http = (array) service('response');

        $data = [
            'title' => $this->request->getVar('txtProductTitle'),
            'price'  => $this->request->getVar('txtProductPrice'),
        ];

        $response_http = (array) service('response');

        $exception = '';

        try {
            $save = $model->insert($data);

            if ($save) {
                $data = $model->where('id', $save)->first();
            }
        } catch (Exception $e) {
            $exception = $e;
        }

        $status = $response_http["\0*\0statusCode"];
        $mensagem = $response_http["\0*\0reason"];

        $response = [
            "cabecalho" => [
                "status" => $status,
                "mensagem" => [$mensagem, $exception],
            ],
            "retorno" => [$data]
        ];

        echo json_encode(array('response' => $response));
    }

    public function edit($id = null)
    {
        $model = new ProductModel();

        $response_http = (array) service('response');
        $exception = '';

        try {
            $data = $model->where('id', $id)->first();
        } catch (Exception $e) {
            $exception = $e;
        }

        $status = $response_http["\0*\0statusCode"];
        $mensagem = $response_http["\0*\0reason"];

        $response = [
            "cabecalho" => [
                "status" => $status,
                "mensagem" => [$mensagem, $exception],
            ],
            "retorno" => [$data]
        ];

        echo json_encode(array('response' => $response));
    }

    public function update()
    {
        helper(['form', 'url']);

        $model = new ProductModel();

        $id = $this->request->getVar('hdnProductId');

        $response_http = (array) service('response');

        $data = [
            'title' => $this->request->getVar('txtProductTitle'),
            'price'  => $this->request->getVar('txtProductPrice'),
        ];

        $exception = '';

        try {
            $update = $model->update($id, $data);
            if ($update) {
                $data = $model->where('id', $id)->first();
            }
        } catch (Exception $e) {
            $exception = $e;
        }

        $status = $response_http["\0*\0statusCode"];
        $mensagem = $response_http["\0*\0reason"];

        $response = [
            "cabecalho" => [
                "status" => $status,
                "mensagem" => [$mensagem, $exception],
            ],
            "retorno" => [$data]
        ];

        echo json_encode(array('response' => $response));
    }

    public function delete($id = null)
    {
        $model = new ProductModel();
        $exception = '';

        try {
            $delete = $model->where('id', $id)->delete();
        } catch (Exception $e) {
            $exception = $e;
        }

        $response_http = (array) service('response');

        $data = '';
        $status = $response_http["\0*\0statusCode"];
        $mensagem = $response_http["\0*\0reason"];

        $response = [
            "cabecalho" => [
                "status" => $status,
                "mensagem" => [$mensagem, $exception],
            ],
            "retorno" => [$data]
        ];

        echo json_encode(array('response' => $response));
    }
}
