<?php

namespace App\Controllers;
use App\Models\KegiatanPelatihanModel;
class KegiatanPelatihan extends BaseController
{
    public function index()
    {
      $model = new KegiatanPelatihanModel();
     
      $data_model =  $model->get()->getResult();
      $session = session();
      $datas = $session->get();
          $array = [
              [
                  'nama_pelatihan' => 'junior_web_programming',
                  'pelatihan' => 'Junior Web Programming'
              ],
              [
                  'nama_pelatihan' => 'poa',
                  'pelatihan' => 'Practical Office in Advance'
              ],
              [
                  'nama_pelatihan' => 'tata_rias',
                  'pelatihan' => 'Tata Rias'
              ],
              [
                  'nama_pelatihan' => 'las_smaw',
                  'pelatihan' => 'Las SMAW'
              ],
              [
                  'nama_pelatihan' => 'listrik',
                  'pelatihan' => 'listrik'
              ],
              [
                  'nama_pelatihan' => 'ac',
                  'pelatihan' => 'AC'
              ],
              [
                  'nama_pelatihan' => 'menjahit',
                  'pelatihan' => 'Menjahit'
              ],
              [
                  'nama_pelatihan' => 'roti_kue',
                  'pelatihan' => 'Roti Kue'
              ],
              [
                  'nama_pelatihan' => 'sepeda_motor',
                  'pelatihan' => 'Sepeda Motor'
              ],
              [
                  'nama_pelatihan' => 'desain_grafis',
                  'pelatihan' => 'Desain Grafis'
              ]
          ];

          
        $data = [
          'title' => 'BLK - Kegiatan Pelatihan',
          'content_title' => 'Kegiatan Pelatihan ',
          'name' => $datas['name'],
          'id_user' => $datas['id_user'],
          'data' => $data_model,
          'option' => $array

        ];
        return view('pages/kegiatan_pelatihan/index',$data);
    }

    public function store()
    {
      $validation = \Config\Services::validation();
      $model = new KegiatanPelatihanModel();
      $validation->setRules([
          'kegiatan_pelatihan' => [
              'rules' => 'required',
              'errors' => [
                    'required' => 'kegiatan pelatihan tidak boleh kosong !'
              ],
          ],
          'gambar' => [
            'rules' => 'uploaded[gambar]|max_length[10]|max_size[gambar,1024]|is_image[gambar]|mime_in[gambar,image/jpg,image/jpeg,image/jpeg,image/png]',
            'errors' => [
                'uploaded' => 'gambar tidak boleh kosong',
                'max_size' => 'Maaf ukuran gambar terlalu besar !',
                'is_image' => 'Maaf yang anda pilih bukan gambar !',
                'mine_in'  => 'Maaf yang anda pilih bukan gambar !',
            ],
        ],
      ]);
        $kegiatan_pelatihan = $this->request->getVar('kegiatan_pelatihan');
        $check = $model->where('nama_pelatihan',$kegiatan_pelatihan)->first();
      if(is_null($check)){
      if ($validation->withRequest($this->request)->run()) {
        $id = $this->request->getVar('id');
        $user_id = $this->request->getVar('user_id');
        $kegiatan_pelatihan = $this->request->getVar('kegiatan_pelatihan');
        $file = $this->request->getFile('gambar');
        $file->move('img/kegiatan_pelatihan');
        $nama_file = $file->getName();
        // print_r($nama_file);
        // die;
        $leng = strlen($nama_file);
        if($leng <= 20){
          $data = array(
            'nama_pelatihan' => $kegiatan_pelatihan,	
            'gambar' => $nama_file,	
            'user_id' => $user_id
          );
          $model = new KegiatanPelatihanModel();
          $id = $this->request->getVar('id');
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
    }else{
      return $this->response->setJSON(['status' => 'error_data', 'errors' => 'Data sudah ada !']);
    }
  }





    public function edit($id)
    {
      $model = new KegiatanPelatihanModel();
      $data_model = $model->where('id',$id)->first();
     
      $session = session();
      $datas = $session->get();
        $data = [
          'title' => 'BLK - Kegiatan Pelatihan',
          'content_title' => 'Kegiatan Pelatihan ',
          'name' => $datas['name'],
          'id_user' => $datas['id_user'],
          'data' => $data_model,

        ];
        return view('pages/kegiatan_pelatihan/edit',$data);
    }

    public function update()
    {
      $validation = \Config\Services::validation();

      $validation->setRules([
          'kegiatan_pelatihan' => [
              'rules' => 'required',
              'errors' => [
                    'required' => 'kegiatan pelatihan tidak boleh kosong !'
              ],
          ],
          'gambar' => [
            'rules' => 'max_length[8]|max_size[gambar,1024]|is_image[gambar]|mime_in[gambar,image/jpg,image/jpeg,image/jpeg,image/png]',
            'errors' => [
                'max_size' => 'Maaf ukuran gambar terlalu besar !',
                'is_image' => 'Maaf yang anda pilih bukan gambar !',
                'mine_in'  => 'Maaf yang anda pilih bukan gambar !',
            ],
        ],
      ]);
      

      if ($validation->withRequest($this->request)->run()) {
        $id = $this->request->getVar('id');
        $user_id = $this->request->getVar('user_id');
        $kegiatan_pelatihan = $this->request->getVar('kegiatan_pelatihan');
        $file = $this->request->getFile('gambar');
        $nama_file = $file->getName();

        if($file->getError() == 4){
          $nama_file = $this->request->getVar('old_gambar');
      }else{
          $file->move('img/kegiatan_pelatihan');
          $nama_file = $file->getName();
           unlink('img/kegiatan_pelatihan/' . $this->request->getVar('old_gambar'));
       }

       $data = array(
        'nama_pelatihan' => $kegiatan_pelatihan,	
        'gambar' => $nama_file,	
        'user_id' => $user_id
       );
      $model = new KegiatanPelatihanModel();
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

     $model = new KegiatanPelatihanModel();
     $ids = $this->request->getVar('ids');

     foreach ($ids as $key => $id) {
         $data = $model->where('id', $id)->first();
         $model->where('id',$id)->delete();
         unlink('img/kegiatan_pelatihan/' . $data['gambar']);
     }

     return $this->response->setJSON(['status' => 'success', 'message' => 'Data berhasil di hapus']);
    }
}
