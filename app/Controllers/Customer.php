<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\CustomerModel;

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

        $data = [
            'name'  => $this->request->getVar('txtCustomerName'),
            'document'  => $this->request->getVar('txtCustomerDocument'),
        ];

        $save = $model->insert($data);
        
        if ($save) {
            $data = $model->where('id', $save)->first();
        }

        $status = 200;
        $mensagem = 'foi';

        $response = [
            "cabecalho" => [
                "status" => $status,
                "mensagem" => $mensagem,
            ],
            "retorno" => [$data]
        ];
        echo json_encode(array('response' => $response));
    }

    public function edit($id = null)
    {
        $model = new CustomerModel();

        $data = $model->where('id', $id)->first();

        $status = 200;
        $mensagem = 'foi';

        $response = [
            "cabecalho" => [
                "status" => $status,
                "mensagem" => $mensagem,
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

        $data = [
            'name'  => $this->request->getVar('txtCustomerName'),
            'document'  => $this->request->getVar('txtCustomerDocument'),
        ];

        $update = $model->update($id, $data);
        if ($update) {
            $data = $model->where('id', $id)->first();
        }

        $status = 200;
        $mensagem = 'foi';

        $response = [
            "cabecalho" => [
                "status" => $status,
                "mensagem" => $mensagem,
            ],
            "retorno" => [$data]
        ];

        echo json_encode(array('response' => $response));
    }

    public function delete($id = null)
    {
        $model = new CustomerModel();
        
        $delete = $model->where('id', $id)->delete();

        $data = '';
        $status = 200;
        $mensagem = 'foi';

        $response = [
            "cabecalho" => [
                "status" => $status,
                "mensagem" => $mensagem,
            ],
            "retorno" => [$data]
        ];

        echo json_encode(array('response' => $response));
    }
}
