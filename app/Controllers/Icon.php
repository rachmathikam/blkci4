<?php

namespace App\Controllers;
use App\Models\IconModel;
use CodeIgniter\API\ResponseTrait;

class Icon extends BaseController
{
    use ResponseTrait;
    
    protected $iconModel;

    public function __construct()
    {
      $this->iconModel = new IconModel();
    }

    public function index()
    {
      
      $icon = $this->iconModel->findAll();

      $session  = session();
      $datas    = $session->get();
      $data = [
        'title'   => 'BLK - icon',
        'content_title' => 'icon',
        'name'          => $datas['name'],
        'id_user'       => $datas['id_user'],
        'icon'          => $icon
      ];
        return view('pages/icon/index',$data);
    }
    public function create(){
      $session  = session();
      $datas    = $session->get();
      $data = [
        'title'   => 'BLK - Icon - Careta',
        'content_title' => 'icon',
        'name'          => $datas['name'],
        'id_user'       => $datas['id_user']
      ];
    }
    public function store()
    {

        $validation = \Config\Services::validation();

        $validation->setRules([
            'icon_name'  => 'required',
            'unicode'      => 'required'
        ]);
        

        if ($validation->withRequest($this->request)->run()) {
          $model = new IconModel();
          $data = array(
              'icon_name' => $this->request->getVar('icon_name'),	
              'unicode'   => $this->request->getVar('unicode'),		
              'user_id'   => $this->request->getVar('user_id'),	
          );
          
              if ($model->insert($data)) {
                  return $this->response->setJSON(['status' => 'success', 'message' => 'Data berhasil di tambah']);
              } else {
                  return $this->response->setJSON(['status' => 'error', 'message' => 'Data gagal di tambah']);
              }
      } else {
          // Send a validation error response
          return $this->response->setJSON(['status' => 'error', 'errors' => $validation->getErrors()]);
      }

    
    } 
    public function edit(){
      $ids = explode('data',$this->request->getVar('id'));
      $id = $ids[1];
      // dd($id);
      $validation = \Config\Services::validation();

        $validation->setRules([
            'icon_name'  => 'required',
            'unicode'      => 'required'
        ]);
        
        if ($validation->withRequest($this->request)->run()) {
          $model = new IconModel();
          $data = array(
              'icon_name' => $this->request->getVar('icon_name'),	
              'unicode'   => $this->request->getVar('unicode'),		
              'user_id'   => $this->request->getVar('user_id'),	
          );
          
              if ($model->update($id, $data)) {
                  return $this->response->setJSON(['status' => 'success','data'=> $data, 'message' => 'Data berhasil di tambah']);
              } else {
                  return $this->response->setJSON(['status' => 'error', 'message' => 'Data gagal di tambah']);
              }
      } else {
          // Send a validation error response
          return $this->response->setJSON(['status' => 'error', 'errors' => $validation->getErrors()]);
      }
    }
    public function delete(){
      $model = new IconModel();
      $ids = $this->request->getVar('ids');
      foreach ($ids as $id) {
        $model->delete($id);
      }	
      
    }

}
