<?php

namespace App\Controllers;
use App\Models\KerjasamaMitraModel;
class KerjasamaMitra extends BaseController
{
    public function index()
    {
      $model = new KerjasamaMitraModel();
      $data_model = $model->get()->getResult();

       $lol = [];
      foreach ($data_model as  $value) {
        $color = '';
        if($value->status == 'di_terima') {
            $color = '#28a745'; // hijau
        }else{
             $color = '#FFC107'; // kuning
        }
        $array = [
            'nama_mitra' => $value->nama_mitra,
            'bidang_usaha' => $value->bidang_usaha,
            'email' => $value->email,
            'alamat' => $value->alamat,
            'status' => $value->status,
            'id' => $value->id,
            'color' => $color
        ];
         array_push($lol,$array);
      }
      
    
      $session = session();
      $datas = $session->get();
        $data = [
        'title' => 'BLK - Kerjasama Mitra',
          'content_title' => 'Kerjasama Mitra',
          'name' => $datas['name'],
          'id_user' => $datas['id_user'],
          'data' => $lol
        ];


        return view('pages/kerjasama/index',$data);
    }

    public function store()
    {
        $model = new KerjasamaMitraModel();
        $validation = \Config\Services::validation();
        $validation->setRules([
          'nama_mitra' => [
              'rules' => 'required',
              'errors' => [
                    'required' => 'Nama Mitra tidak boleh kosong !'
              ],
          ],
          'bidang_usaha' => [
            'rules' => 'required',
            'errors' => [
                  'required' => 'Bidang Usaha tidak boleh kosong !'
            ],
          ],
            'email' => [
              'rules' => 'required',
              'errors' => [
                    'required' => 'Email tidak boleh kosong !'
              ],
          ],
            'alamat' => [
              'rules' => 'required',
              'errors' => [
                    'required' => 'Alamat tidak boleh kosong !'
            ],
           ],
        ]);

        
        if ($validation->withRequest($this->request)->run()) {
              $nama_mitra = $this->request->getVar('nama_mitra');
              $bidang_usaha = $this->request->getVar('bidang_usaha');
              $email = $this->request->getVar('email');
              $alamat = $this->request->getVar('alamat');
              $status = 'pending';
           
            $data = array(
              'nama_mitra' => $nama_mitra,	
              'bidang_usaha' => $bidang_usaha,	
              'email' => $email,
              'alamat' => $alamat,
              'status' => $status
            );

            $model = new KerjasamaMitraModel();
            if ($model->insert($data)){
              return $this->response->setJSON(['status' => 'success', 'message' => 'Data berhasil di tambah']);
            } else {
              return $this->response->setJSON(['status' => 'error', 'message' => 'Data gagal di tambah']);
            }
        }else{  
           return $this->response->setJSON(['status' => 'error', 'errors' => $validation->getErrors()]);
        }
    }


    public function update()
    {
          $model = new KerjasamaMitraModel();
          $validation = \Config\Services::validation();
          $validation->setRules([
            'nama_mitra' => [
                'rules' => 'required',
                'errors' => [
                      'required' => 'Nama Mitra tidak boleh kosong !'
                ],
            ],
            'bidang_usaha' => [
              'rules' => 'required',
              'errors' => [
                    'required' => 'Bidang Usaha tidak boleh kosong !'
              ],
            ],
              'email' => [
                'rules' => 'required',
                'errors' => [
                      'required' => 'Email tidak boleh kosong !'
                ],
            ],
              'alamat' => [
                'rules' => 'required',
                'errors' => [
                      'required' => 'Alamat tidak boleh kosong !'
              ],
             ],
          ]);

         

          if ($validation->withRequest($this->request)->run()) {
            
            $nama_mitra = $this->request->getVar('nama_mitra');
            $bidang_usaha = $this->request->getVar('bidang_usaha');
            $email = $this->request->getVar('email');
            $alamat = $this->request->getVar('alamat');
            $status = 'pending';
           
            $data = array(
              'nama_mitra' => $nama_mitra,	
              'bidang_usaha' => $bidang_usaha,	
              'email' => $email,
              'alamat' => $alamat,
              'status' => $status
            );

          $model = new KerjasamaMitraModel();
           $id = explode('data', $this->request->getVar('id'));

            if ($model->update($id[1],$data)) {
              return $this->response->setJSON(['status' => 'success', 'data' => $data ,'message' => 'Data berhasil di update']);
            } else {
              return $this->response->setJSON(['status' => 'error', 'message' => 'Data gagal di update']);
            }
    
          }else{  
            return $this->response->setJSON(['status' => 'error', 'errors' => $validation->getErrors()]);
          }
    }

    public function delete()
    {
      $model = new KerjasamaMitraModel();
       $ids = $this->request->getVar('ids');

     foreach ($ids as $key => $id) {
         $data = $model->where('id', $id)->first();
         $model->where('id',$id)->delete();
     }

     return $this->response->setJSON(['status' => 'success', 'message' => 'Data berhasil di hapus']);
    }

    public function statusUpdate(){
        $model = new KerjasamaMitraModel();
        $status =  $this->request->getVar('status');
        $id = explode('data', $this->request->getVar('id'));
        $data = [
          'status' => $status,
          'id' => $id
        ];
           
        if($model->update($id,$data)) {
          return $this->response->setJSON(['status' => 'success','data' => $data , 'message' => 'Data berhasil di update']);
        } else {
          return $this->response->setJSON(['status' => 'error', 'message' => 'Data gagal di update']);
        }
    } 

 
}
