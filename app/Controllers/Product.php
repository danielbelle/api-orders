<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\ProductModel;

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

        $data = [
            'title' => $this->request->getVar('txtProductTitle'),
            'price'  => $this->request->getVar('txtProductPrice'),
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
        $model = new ProductModel();

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

        $model = new ProductModel();

        $id = $this->request->getVar('hdnProductId');

        $data = [
            'title' => $this->request->getVar('txtProductTitle'),
            'price'  => $this->request->getVar('txtProductPrice'),
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
        $model = new ProductModel();
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
