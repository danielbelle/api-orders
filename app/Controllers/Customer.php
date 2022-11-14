<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\CustomerModel;
use Exception;

class Customer extends Controller
{

    public function index()
    {
        $model = new CustomerModel();

        $data['customers_detail'] = $model->orderBy('id', 'DESC')->findAll();

        return view('list_customer', $data);
    }


    public function store()
    {
        helper(['form', 'url']);

        $model = new CustomerModel();

        $response_http = (array) service('response');

        $data = [
            'name'  => $this->request->getVar('txtCustomerName'),
            'document'  => $this->request->getVar('txtCustomerDocument'),
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
        $model = new CustomerModel();

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

        $model = new CustomerModel();

        $id = $this->request->getVar('hdnCustomerId');

        $response_http = (array) service('response');

        $data = [
            'name'  => $this->request->getVar('txtCustomerName'),
            'document'  => $this->request->getVar('txtCustomerDocument'),
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
        $model = new CustomerModel();
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
