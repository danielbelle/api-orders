<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\OrderModel;

class Order extends Controller
{

    public function index()
    {
        $model = new OrderModel();

        $data['orders_detail'] = $model->orderBy('id', 'DESC')->findAll();

        return view('list_order', $data);
    }


    public function store()
    {
        helper(['form', 'url']);

        $model = new OrderModel();

        $data = [
            'customer_id' => $this->request->getVar('txtOrderCustomerId'),
            'product_id'  => $this->request->getVar('txtOrderProductId'),
            'status'  => $this->request->getVar('txtOrderStatus'),
        ];
        $save = $model->insert($data);

        if ($save != false) {
            $data = $model->where('id', $save)->first();
            echo json_encode(array("status" => true, 'data' => $data));
        } else {
            echo json_encode(array("status" => false, 'data' => $data));
        }
    }

    public function edit($id = null)
    {

        $model = new OrderModel();

        $data = $model->where('id', $id)->first();

        if ($data) {
            echo json_encode(array("status" => true, 'data' => $data));
        } else {
            echo json_encode(array("status" => false));
        }
    }

    public function update()
    {

        helper(['form', 'url']);

        $model = new OrderModel();

        $id = $this->request->getVar('hdnOrderId');

        $data = [
            'customer_id' => $this->request->getVar('txtOrderCustomerId'),
            'product_id'  => $this->request->getVar('txtOrderProductId'),
            'status'  => $this->request->getVar('txtOrderStatus'),
        ];

        $update = $model->update($id, $data);
        if ($update != false) {
            $data = $model->where('id', $id)->first();
            echo json_encode(array("status" => true, 'data' => $data));
        } else {
            echo json_encode(array("status" => false, 'data' => $data));
        }
    }

    public function delete($id = null)
    {
        $model = new OrderModel();
        $delete = $model->where('id', $id)->delete();
        if ($delete) {
            echo json_encode(array("status" => true));
        } else {
            echo json_encode(array("status" => false));
        }
    }
}
