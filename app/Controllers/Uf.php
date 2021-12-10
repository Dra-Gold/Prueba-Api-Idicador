<?php 
namespace App\Controllers;

use App\Models\UfModel;
use CodeIgniter\Controller;

class Uf extends Controller
{

    public function index(){
        return view('uf/indice');
    }

    public function ufTodo()
    {
        $ufModel= new UfModel();
        $data = $ufModel->findAll();
        return json_encode(array("status" => $data));
    }

 
    // insert data
    public function store() {
        
        $ufModel= new UfModel();
        $data = [
            'UF_FECHA' => $this->request->getVar('UF_FECHA'),
            'UF_VALOR'  => $this->request->getVar('UF_VALOR'),
        ];
        $ufModel->insert($data);
        echo json_encode(array("status" => TRUE));
    }

    // show single user
    public function editarUf($id = null){
        $ufModel = new UfModel();
        $data = $ufModel->where('UF_ID', $id)->first();
        return json_encode(array("status" => $data));
    }

    // update user data
    public function update(){
        $ufModel = new UfModel();
        $id = $this->request->getVar('UF_ID');
        $data = [
            'UF_FECHA' => $this->request->getVar('UF_FECHA'),
            'UF_VALOR'  => $this->request->getVar('UF_VALOR'),
        ];
        $ufModel->update($id, $data);
        echo json_encode(array("status" => TRUE));
    }
 
    // delete user
    public function delete($id = null){
        $ufModel= new UfModel();
        $data['user'] = $ufModel->where('UF_ID', $id)->delete($id);
        echo json_encode(array("status" => TRUE));
    }    
}