<?php

namespace App\Controllers;
use App\Models\TestimoniModel;
class Testimonial extends BaseController
{
    public function index()
    {
      $model = new TestimoniModel();
      $data_testimoni = $model->get()->getResult();
      $session = session();
      $datas = $session->get();
        $data = [
          'title' => 'BLK - Testimonial',
          'content_title' => 'Testimonial Pendaftar',
          'name' => $datas['name'],
          'id_user' => $datas['id_user'],
          'data' => $data_testimoni,
        ];
        return view('pages/testimonial/index',$data);
    }
    public function store()
    {
        $model = new TestimoniModel();
        $validation = \Config\Services::validation();
        $validation->setRules([
          'nama_pendaftar' => [
              'rules' => 'required',
              'errors' => [
                    'required' => 'Nama Pendaftar tidak boleh kosong !'
              ],
          ],
          'testimoni' => [
            'rules' => 'required',
            'errors' => [
                  'required' => 'testimoni tidak boleh kosong !'
            ],
           ],
          'gambar_pendaftar' => [
            'rules' => 'uploaded[gambar_pendaftar]|max_size[gambar_pendaftar,1024]|is_image[gambar_pendaftar]|mime_in[gambar_pendaftar,image/jpg,image/jpeg,image/jpeg,image/png]',
            'errors' => [
                'uploaded' => 'Gambar Pendaftar tidak boleh kosong',
                'max_size' => 'Maaf ukuran gambar terlalu besar !',
                'is_image' => 'Maaf yang anda pilih bukan gambar !',
                'mine_in'  => 'Maaf yang anda pilih bukan gambar !',
            ],
          ],
        ]);

        $user_id = $this->request->getVar('user_id');
        $nama_pendaftar = $this->request->getVar('nama_pendaftar');
        $testimoni = $this->request->getVar('testimoni');

        if ($validation->withRequest($this->request)->run()) {

            $user_id = $this->request->getVar('user_id');
            $nama_pendaftar = $this->request->getVar('nama_pendaftar');
            $testimoni = $this->request->getVar('testimoni');

            $file = $this->request->getFile('gambar_pendaftar');
            $file->move('img/testimonial');
            $nama_file = $file->getName();
            $leng = strlen($nama_file);

          if($leng <= 20){
            $data = array(
              'nama_pendaftar' => $nama_pendaftar,	
              'testimoni' => $testimoni,
              'gambar_pendaftar' => $nama_file,	
              'user_id' => $user_id
            );
            $model = new TestimoniModel();
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
        $model = new TestimoniModel();
        $data1 = $model->find($id);
        $session = session();
        $datas = $session->get();
        $data = [
          'title' => 'BLK - Testimonial',
          'content_title' => 'Testimonial Pendaftar',
          'name' => $datas['name'],
          'id_user' => $datas['id_user'],
          'data' => $data1,
        ];
        return view('pages/testimonial/edit',$data);
    }

    public function update()
    {
          $model = new TestimoniModel();
          $validation = \Config\Services::validation();
          $validation->setRules([
            'nama_pendaftar' => [
                'rules' => 'required',
                'errors' => [
                      'required' => 'Nama Pendaftar tidak boleh kosong !'
                ],
            ],
            'testimoni' => [
              'rules' => 'required',
              'errors' => [
                    'required' => 'testimoni tidak boleh kosong !'
              ],
             ],
            'gambar_pendaftar' => [
              'rules' => 'max_size[gambar_pendaftar,1024]|is_image[gambar_pendaftar]|mime_in[gambar_pendaftar,image/jpg,image/jpeg,image/jpeg,image/png]',
              'errors' => [
                  // 'uploaded' => 'Gambar Pendaftar tidak boleh kosong',
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
            $nama_pendaftar = $this->request->getVar('nama_pendaftar');
            $testimoni = $this->request->getVar('testimoni');

            $file = $this->request->getFile('gambar_pendaftar');
            $nama_file = $file->getName();
    
            if($file->getError() == 4){
              $nama_file = $this->request->getVar('old_gambar');
          }else{
              $file->move('img/testimonial');
              $nama_file = $file->getName();
               unlink('img/testimonial/' . $this->request->getVar('old_gambar'));
           }
    
           $data = array(
              'nama_pendaftar' => $nama_pendaftar,	
              'testimoni' => $testimoni,
              'gambar_pendaftar' => $nama_file,	
              'user_id' => $user_id
           );
          $model = new TestimoniModel();
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
      $model = new TestimoniModel();
       $ids = $this->request->getVar('ids');

     foreach ($ids as $key => $id) {
         $data = $model->where('id', $id)->first();
         $model->where('id',$id)->delete();
         unlink('img/testimonial/' . $data['gambar_pendaftar']);
     }

     return $this->response->setJSON(['status' => 'success', 'message' => 'Data berhasil di hapus']);
    }
}
