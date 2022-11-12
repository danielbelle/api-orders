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
        if($save != false)
        {
            $data = $model->where('id', $save)->first();
            echo json_encode(array("status" => true , 'data' => $data));
        }
        else{
            echo json_encode(array("status" => false , 'data' => $data));
        }
    }
   
    public function edit($id = null)
    {
        
     $model = new CustomerModel();
      
     $data = $model->where('id', $id)->first();
       
    if($data){
            echo json_encode(array("status" => true , 'data' => $data));
        }else{
            echo json_encode(array("status" => false));
        }
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
  
        $update = $model->update($id,$data);
        if($update != false)
        {
            $data = $model->where('id', $id)->first();
            echo json_encode(array("status" => true , 'data' => $data));
        }
        else{
            echo json_encode(array("status" => false , 'data' => $data));
        }
    }
   
    public function delete($id = null){
        $model = new CustomerModel();
        $delete = $model->where('id', $id)->delete();
        if($delete)
        {
           echo json_encode(array("status" => true));
        }else{
           echo json_encode(array("status" => false));
        }
    }
}
  
?>