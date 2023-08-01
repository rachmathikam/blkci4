<?php

namespace App\Controllers;
use App\Models\HeroContentModel;
use App\Models\SocialMediaModel;
use App\Models\KontakModel;
use CodeIgniter\API\ResponseTrait;


class HeroContent extends BaseController
{
    use ResponseTrait;
    public function __construct()
    {
        // Load the Form Validation library
        $this->validation = \Config\Services::validation();
    }

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
        // dd($firstDataHeroContent['background']);
        
        
        if(!is_null($firstDataHeroContent) OR !is_null($firstDataHeroContent)){
            $data = [
                'title' => 'BLK - Hero Content',
                'content_title' => 'Hero Content',
                'id_user' => session()->get('id_user'),
                'name' => session()->get('name'),
                'validation' => \Config\Services::validation(),
                'result' => $result,
                'data_kontak' => $firstDataKontak,
                'data_profile' =>$firstDataHeroContent
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
        if($this->request->getVar('create') == true){      
            $validation->setRules([
                'title_pertama' => 'required',
                'title_kedua' => 'required',
                'title_ketiga' => 'required',
                'deskripsi' => 'required',
                'background' => [
                    'rules' => 'uploaded[background]|max_size[background,1024]|is_image[background]|mime_in[background,image/jpg,image/jpeg,image/jpeg,image/png]',
                    'errors' => [
                        'uploaded' => 'Gambar tidak boleh kosong !',
                        'max_size' => 'Maaf ukuran gambar terlalu besar !',
                        'is_image' => 'Maaf yang anda pilih bukan gambar !',
                        'mine_in'  => 'Maaf yang anda pilih bukan gambar !',
                    ],
                ],
            ]);
        }else{
            $validation->setRules([
                'title_pertama' => 'required',
                'title_kedua' => 'required',
                'title_ketiga' => 'required',
                'deskripsi' => 'required',
                'background' => [
                    'rules' => 'max_size[background,1024]|is_image[background]|mime_in[background,image/jpg,image/jpeg,image/jpeg,image/png]',
                    'errors' => [
                        'max_size' => 'Maaf ukuran gambar terlalu besar !',
                        'is_image' => 'Maaf yang anda pilih bukan gambar !',
                        'mine_in'  => 'Maaf yang anda pilih bukan gambar !',
                    ],
                ],
            ]);
        }
        
       
   
        $file = $this->request->getFile('background');
        $nama_file = $file->getName();
        

       if ($validation->withRequest($this->request)->run()) {
         $model = new HeroContentModel();
         
         $data = array(
             '1st_title' => $this->request->getVar('title_pertama'),	
             '2nd_title' => $this->request->getVar('title_kedua'),	
             '3rd_title' => $this->request->getVar('title_ketiga'),	
             'deskripsi' => $this->request->getVar('deskripsi'),	
             'background' => $nama_file,	
             'user_id' => $this->request->getVar('user_id')
            );

        if($this->request->getVar('create') != null){
            if ($model->insert($data)) {
              $file->move('img/profile');
                return $this->response->setJSON(['status' => 'success', 'message' => 'Data berhasil di tambah']);
            } else {
                return $this->response->setJSON(['status' => 'error', 'message' => 'Data gagal di tambah']);
            }
        }else{
            if($file->getError() == 4){
                $nama_file = $this->request->getVar('old_background');
            }else{
                $nama_file = $file->getName();
                 $file->move('img/profile');
                unlink('img/profile/' . $this->request->getVar('old_background'));
            }
                $nama = $nama_file;
            $data = array(
                '1st_title' => $this->request->getVar('title_pertama'),	
                '2nd_title' => $this->request->getVar('title_kedua'),	
                '3rd_title' => $this->request->getVar('title_ketiga'),	
                'deskripsi' => $this->request->getVar('deskripsi'),	
                'background' => $nama,	
                'user_id' => $this->request->getVar('user_id')
               );
             
            $model = new HeroContentModel();
            $id = $this->request->getVar('id');
            
            if ($model->update($id,$data)) {
                return $this->response->setJSON(['status' => 'success', 'message' => 'Data berhasil di update']);
            } else {
                return $this->response->setJSON(['status' => 'error', 'message' => 'Data gagal di update']);
            }
        }
    } else {
        
        return $this->response->setJSON(['status' => 'error', 'errors' => $validation->getErrors('background')]);
    }

    
  }

  public function storeSocialMedia()
{
    
        $validation = \Config\Services::validation();
        $validation->setRules([
            'title_pertama' => 'required',
            'title_kedua' => 'required',
            'title_ketiga' => 'required',
            'deskripsi' => 'required',
        ]);
       
       if ($validation->withRequest($this->request)->run()) {
         $model = new HeroContentModel();
         $data = array(
            '1st_title' => $this->request->getVar('title_pertama'),	
            '1nd_title' => $this->request->getVar('title_kedua'),	
            '3rd_title' => $this->request->getVar('title_ketiga'),	
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
