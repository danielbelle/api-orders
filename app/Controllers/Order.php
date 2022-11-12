<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\OrderModel;
use App\Models\CustomerModel;
use App\Models\ProductModel;

class Order extends Controller
{

    public function index()
    {
        $order_model = new OrderModel();
        $customer_model = new CustomerModel();
        $product_model = new ProductModel();

        $data['orders_detail'] = $order_model->orderBy('id', 'DESC')->findAll();
        $data_direcionador_db = array();
        foreach ($data['orders_detail'] as $key => $datas) {

            $data_direcionador_db['orders_detail'][$key] =
                [
                    'id' => $datas['id'],
                    'customer_id' => implode($customer_model->select('name')->where('id', $datas['customer_id'])->first()),
                    'product_id' => implode($product_model->select('title')->where('id', $datas['product_id'])->first()),
                    'status' => $datas['status']
                ];
        }
        return view('list_order', $data_direcionador_db);
    }


    public function store()
    {
        helper(['form', 'url']);

        $order_model = new OrderModel();
        $customer_model = new CustomerModel();
        $product_model = new ProductModel();

        $data = [
            'customer_id' => $this->request->getVar('txtOrderCustomerId'),
            'product_id'  => $this->request->getVar('txtOrderProductId'),
            'status'  => $this->request->getVar('txtOrderStatus'),
        ];

        $data_direcionador_db=
            [
                'customer_id' => implode($customer_model->select('id')->where('name', $data['customer_id'])->first()),
                'product_id' => implode($product_model->select('id')->where('title', $data['product_id'])->first()),
                'status' => $data['status']
            ];

        $save = $order_model->insert($data_direcionador_db);

        if ($save != false) {
            $data_direcionador_db = $order_model->where('id', $save)->first();
            echo json_encode(array("status" => true, 'data' => $data_direcionador_db));
        } else {
            echo json_encode(array("status" => false, 'data' => $data_direcionador_db));
        }
    }

    public function edit($id = null)
    {

        $order_model = new OrderModel();

        $data = $order_model->where('id', $id)->first();

        if ($data) {
            echo json_encode(array("status" => true, 'data' => $data));
        } else {
            echo json_encode(array("status" => false));
        }
    }

    public function update()
    {

        helper(['form', 'url']);

        $order_model = new OrderModel();

        $id = $this->request->getVar('hdnOrderId');

        $data = [
            'customer_id' => $this->request->getVar('txtOrderCustomerId'),
            'product_id'  => $this->request->getVar('txtOrderProductId'),
            'status'  => $this->request->getVar('txtOrderStatus'),
        ];

        $update = $order_model->update($id, $data);
        if ($update != false) {
            $data = $order_model->where('id', $id)->first();
            echo json_encode(array("status" => true, 'data' => $data));
        } else {
            echo json_encode(array("status" => false, 'data' => $data));
        }
    }

    public function delete($id = null)
    {
        $order_model = new OrderModel();
        $delete = $order_model->where('id', $id)->delete();
        if ($delete) {
            echo json_encode(array("status" => true));
        } else {
            echo json_encode(array("status" => false));
        }
    }
}
