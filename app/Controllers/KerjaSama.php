<?php

namespace App\Controllers;
use App\Models\KerjaSamaModel;
class KerjaSama extends BaseController
{
    public function index()
    {
      $model = new KerjaSamaModel();
      $data_model = $model->get()->getResult();
      $session = session();
      $datas = $session->get();
        $data = [
        'title' => 'BLK - kerja sama',
          'content_title' => 'Kerja Sama',
          'name' => $datas['name'],
          'id_user' => $datas['id_user'],
          'data' => $data_model
        ];


        return view('pages/kerja_sama/index',$data);
    }

    public function store()
    {
        $model = new KerjaSamaModel();
        $validation = \Config\Services::validation();
        $validation->setRules([
          'nama_perusahaan' => [
              'rules' => 'required',
              'errors' => [
                    'required' => 'Nama Perusahaan tidak boleh kosong !'
              ],
          ],
          'logo_perusahaan' => [
            'rules' => 'uploaded[logo_perusahaan]|max_size[logo_perusahaan,1024]|is_image[logo_perusahaan]|mime_in[logo_perusahaan,image/jpg,image/jpeg,image/jpeg,image/png]',
            'errors' => [
                'uploaded' => 'Logo Perusahaan tidak boleh kosong',
                'max_size' => 'Maaf ukuran gambar terlalu besar !',
                'is_image' => 'Maaf yang anda pilih bukan gambar !',
                'mine_in'  => 'Maaf yang anda pilih bukan gambar !',
            ],
          ],
        ]);

        $user_id = $this->request->getVar('user_id');
        $nama_perusahaan = $this->request->getVar('nama_perusahaan');
       

        if ($validation->withRequest($this->request)->run()) {

            $user_id = $this->request->getVar('user_id');
            $nama_perusahaan = $this->request->getVar('nama_perusahaan');
           

            $file = $this->request->getFile('logo_perusahaan');
            $file->move('img/kerjasama');
            $nama_file = $file->getName();
            $leng = strlen($nama_file);

          if($leng <= 20){
            $data = array(
              'nama_perusahaan' => $nama_perusahaan,	
              'logo_perusahaan' => $nama_file,	
              'user_id' => $user_id
            );
            $model = new KerjaSamaModel();
            if ($model->insert($data)){
              return $this->response->setJSON(['status' => 'success', 'message' => 'Data berhasil di tambah']);
            } else {
                return $this->response->setJSON(['status' => 'error', 'message' => 'Data gagal di update']);
            }
          }else{
            return $this->response->setJSON(['status' => 'error_length', 'errors' => 'Mohon maaf nama gambar terlalu panjang !']);
          }
        }else{  
          return $this->response->setJSON(['status' => 'error', 'errors' => $validation->getErrors()]);
        }
    }

    public function edit($id)
    {
        $model = new KerjaSamaModel();
        $data1 = $model->find($id);
        $session = session();
        $datas = $session->get();
        $data = [
          'title' => 'BLK - kerja sama',
          'content_title' => 'kerj asama Mitra',
          'name' => $datas['name'],
          'id_user' => $datas['id_user'],
          'data' => $data1,
        ];
        return view('pages/kerja_sama/edit',$data);
    }

    public function update()
    {
          $model = new KerjaSamaModel();
          $validation = \Config\Services::validation();
          $validation->setRules([
            'nama_perusahaan' => [
                'rules' => 'required',
                'errors' => [
                      'required' => 'Nama Mitra tidak boleh kosong !'
                ],
            ],
            'logo_perusahaan' => [
              'rules' => 'max_size[logo_perusahaan,1024]|is_image[logo_perusahaan]|mime_in[logo_perusahaan,image/jpg,image/jpeg,image/jpeg,image/png]',
              'errors' => [
                  'max_size' => 'Maaf ukuran gambar terlalu besar !',
                  'is_image' => 'Maaf yang anda pilih bukan gambar !',
                  'mine_in'  => 'Maaf yang anda pilih bukan gambar !',
              ],
            ],
          ]);

          $id = $this->request->getVar('id');

          if ($validation->withRequest($this->request)->run()) {
            $id = $this->request->getVar('id');
            $user_id = $this->request->getVar('user_id');
            $nama_perusahaan = $this->request->getVar('nama_perusahaan');
           

            $file = $this->request->getFile('logo_perusahaan');
            $nama_file = $file->getName();
    
            if($file->getError() == 4){
              $nama_file = $this->request->getVar('old_gambar');
          }else{
              $file->move('img/kerjasama');
              $nama_file = $file->getName();
               unlink('img/kerjasama/' . $this->request->getVar('old_gambar'));
           }
    
           $data = array(
              'nama_perusahaan' => $nama_perusahaan,	
              'logo_perusahaan' => $nama_file,	
              'user_id' => $user_id
           );
          $model = new KerjaSamaModel();
          $id = $this->request->getVar('id');
            if ($model->update($id,$data)) {
              return $this->response->setJSON(['status' => 'success', 'message' => 'Data berhasil di update']);
            } else {
                return $this->response->setJSON(['status' => 'error', 'message' => 'Data gagal di update']);
            }
    
          }else{  
            return $this->response->setJSON(['status' => 'error', 'errors' => $validation->getErrors()]);
          }
    }

    public function delete()
    {
      $model = new KerjaSamaModel();
       $ids = $this->request->getVar('ids');

     foreach ($ids as $key => $id) {
         $data = $model->where('id', $id)->first();
         $model->where('id',$id)->delete();
         unlink('img/kerjasama/' . $data['logo_perusahaan']);
     }

     return $this->response->setJSON(['status' => 'success', 'message' => 'Data berhasil di hapus']);
    }
}
