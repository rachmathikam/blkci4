<?php

namespace App\Controllers;
use App\Models\HeroContentModel;
use App\Models\SocialMediaModel;
use App\Models\KontakModel;
use CodeIgniter\API\ResponseTrait;


class HeroContent extends BaseController
{
    use ResponseTrait;

    public function index()
    {
        $db      = \Config\Database::connect();
        session();
        $query = $db->table('social_media')->join('icon','icon.id_icon=social_media.icon_id');
        $query->select('*');
        $result = $query->get();

        // data pertama kontak
        $model = new KontakModel();
        $firstDataKontak = $model->first();

        //data pertama 
        $model = new HeroContentModel();
        $firstDataHeroContent = $model->first();
        
        
        if(!is_null($firstDataKontak)){
            $data = [
                'title' => 'BLK - Hero Content',
                'content_title' => 'Hero Content',
                'id_user' => session()->get('id_user'),
                'name' => session()->get('name'),
                'validation' => \Config\Services::validation(),
                'result' => $result,
                'data_kontak' => $firstDataKontak
            ];
        }else{
            $data = [
                'title' => 'BLK - Hero Content',
                'content_title' => 'Hero Content',
                'id_user' => session()->get('id_user'),
                'name' => session()->get('name'),
                'validation' => \Config\Services::validation(),
                'result' => $result,
            ];
        }
        return view('pages/hero_content/index',$data);
    }

public function storeKontak()
{

        $validation = \Config\Services::validation();

        $validation->setRules([
            'phone_number' => 'required|is_natural|min_length[11]|max_length[13]',
            'email' => 'required|valid_email|',
            'lokasi' => 'required'
        ]);
       

       if ($validation->withRequest($this->request)->run()) {
         $model = new KontakModel();
         $data = array(
            'email' => $this->request->getVar('email'),	
            'phone_number' => $this->request->getVar('phone_number'),	
            'lokasi' => $this->request->getVar('lokasi'),	
            'user_id' => $this->request->getVar('user_id'),	
        );
        if($this->request->getVar('create') != null){
            if ($model->insert($data)) {
                return $this->response->setJSON(['status' => 'success', 'message' => 'Data berhasil di tambah']);
            } else {
                return $this->response->setJSON(['status' => 'error', 'message' => 'Data gagal di tambah']);
            }
        }else{
            $model = new KontakModel();
            $id = $this->request->getVar('id');
            if ($model->update($id,$data)) {
                return $this->response->setJSON(['status' => 'success', 'message' => 'Data berhasil di update']);
            } else {
                return $this->response->setJSON(['status' => 'error', 'message' => 'Data gagal di update']);
            }
        }
    } else {
        // Send a validation error response
        return $this->response->setJSON(['status' => 'error', 'errors' => $validation->getErrors()]);
    }

    
  }


  public function storeHeroContent()
{
    
        $validation = \Config\Services::validation();
        $validation->setRules([
            '1st_title' => 'required',
            '1nd_title' => 'required',
            '3rd_title' => 'required',
            'deskripsi' => 'required'
        ]);
       
       if ($validation->withRequest($this->request)->run()) {
         $model = new HeroContentModel();
         $data = array(
            '1st_title' => $this->request->getVar('1st_title'),	
            '1nd_title' => $this->request->getVar('1nd_title'),	
            '3rd_title' => $this->request->getVar('3rd_title'),	
            'deskripsi' => $this->request->getVar('deskripsi'),	
            'user_id' => $this->request->getVar('user_id')
        );
        if($this->request->getVar('create') != null){
            if ($model->insert($data)) {
                return $this->response->setJSON(['status' => 'success', 'message' => 'Data berhasil di tambah']);
            } else {
                return $this->response->setJSON(['status' => 'error', 'message' => 'Data gagal di tambah']);
            }
        }else{
            $model = new HeroContentModel();
            $id = $this->request->getVar('id');
            if ($model->update($id,$data)) {
                return $this->response->setJSON(['status' => 'success', 'message' => 'Data berhasil di update']);
            } else {
                return $this->response->setJSON(['status' => 'error', 'message' => 'Data gagal di update']);
            }
        }
    } else {
        // Send a validation error response
        return $this->response->setJSON(['status' => 'error', 'errors' => $validation->getErrors()]);
    }

    
  }

}
