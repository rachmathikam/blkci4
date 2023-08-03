<?php

namespace App\Controllers;
use App\Models\PejabatModel;
class Pejabat extends BaseController
{
    public function index()
    {
      $model = new PejabatModel();
      $jabatan = [
        [
            'jabatan' => 'Kepala UPT BLK Sumenep',
        ],
        [
            'jabatan' => 'Kasubag Tata Usaha',
        ],
        [
            'jabatan' => 'Kasi Pelatihan dan Sertifikasi',
        ],
        [
            'jabatan' => 'Kasi Pengembangan dan Pemasaran',
        ],
      ];
      $pejabat = [
            [
                'nama_pejabat' => 'BAHTIAR SANTOSO, S.Sos.,M.M'
            ],
            [
                'nama_pejabat' => 'PARIJA, S.Sos'
            ],
            [
                'nama_pejabat' => 'MARUB, SE., M.Si.'
            ],
            [
                'nama_pejabat' => 'OCTANO WIHARTO, S.H'
            ],
        ];
      $data_jabatan = $model->get()->getResult();
      $session = session();
      $datas = $session->get();
        $data = [
          'title' => 'BLK - pejabat',
          'content_title' => 'Pejabat',
          'name' => $datas['name'],
          'id_user' => $datas['id_user'],
          'data' => $data_jabatan,
          'jabatan' => $jabatan,
          'pejabat' => $pejabat,
        ];
        return view('pages/pejabat/index',$data);
    }
    public function store()
    {
        $model = new PejabatModel();
        $validation = \Config\Services::validation();
        $validation->setRules([
          'nama_pejabat' => [
              'rules' => 'required|is_unique[pejabat.nama_pejabat]',
              'errors' => [
                    'required' => 'Nama pejabat tidak boleh kosong !',
                    'is_unique' => 'Pejabat yang anda pilih sudah ada !'
              ],
          ],
          'jabatan' => [
            'rules' => 'required|is_unique[pejabat.jabatan]',
            'errors' => [
                  'required' => 'Jabatan tidak boleh kosong !',
                  'is_unique' => 'Jabatan sudah terkait dengan nama pejabat sebelumnnya !',
            ],
           ],
          'gambar_pejabat' => [
            'rules' => 'uploaded[gambar_pejabat]|max_size[gambar_pejabat,1024]|is_image[gambar_pejabat]|mime_in[gambar_pejabat,image/jpg,image/jpeg,image/jpeg,image/png]',
            'errors' => [
                'uploaded' => 'Gambar pejabat tidak boleh kosong',
                'max_size' => 'Maaf ukuran gambar terlalu besar !',
                'is_image' => 'Maaf yang anda pilih bukan gambar !',
                'mine_in'  => 'Maaf yang anda pilih bukan gambar !',
            ],
          ],
        ]);

        $user_id = $this->request->getVar('user_id');
        $nama_pejabat = $this->request->getVar('nama_pejabat');
        $jabatan = $this->request->getVar('jabatan');

        if ($validation->withRequest($this->request)->run()) {

            $user_id = $this->request->getVar('user_id');
            $nama_pejabat = $this->request->getVar('nama_pejabat');
            $jabatan = $this->request->getVar('jabatan');

            $file = $this->request->getFile('gambar_pejabat');
            $file->move('img/pejabat');
            $nama_file = $file->getName();
            $leng = strlen($nama_file);

          if($leng <= 20){
            $data = array(
              'nama_pejabat' => $nama_pejabat,	
              'jabatan' => $jabatan,
              'gambar_pejabat' => $nama_file,	
              'user_id' => $user_id
            );
            $model = new PejabatModel();
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
        $model = new PejabatModel();
        $data1 = $model->find($id);
        $session = session();
        $datas = $session->get();
        $data = [
          'title' => 'BLK - pejabat',
          'content_title' => 'Pejabat',
          'name' => $datas['name'],
          'id_user' => $datas['id_user'],
          'data' => $data1,
        ];
        return view('pages/pejabat/edit',$data);
    }

    public function update()
    {
          $model = new PejabatModel();
          $validation = \Config\Services::validation();
          $validation->setRules([
            'nama_pejabat' => [
                'rules' => 'required',
                'errors' => [
                      'required' => 'Nama Pejabat tidak boleh kosong !'
                ],
            ],
            'jabatan' => [
              'rules' => 'required',
              'errors' => [
                    'required' => 'jabatan tidak boleh kosong !'
              ],
             ],
            'gambar_pejabat' => [
              'rules' => 'max_size[gambar_pejabat,1024]|is_image[gambar_pejabat]|mime_in[gambar_pejabat,image/jpg,image/jpeg,image/jpeg,image/png]',
              'errors' => [
                  // 'uploaded' => 'Gambar pejabat tidak boleh kosong',
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
            $nama_pejabat = $this->request->getVar('nama_pejabat');
            $jabatan = $this->request->getVar('jabatan');

            $file = $this->request->getFile('gambar_pejabat');
            $nama_file = $file->getName();
    
            if($file->getError() == 4){
              $nama_file = $this->request->getVar('old_gambar');
          }else{
              $file->move('img/pejabat');
              $nama_file = $file->getName();
               unlink('img/pejabat/' . $this->request->getVar('old_gambar'));
           }
    
           $data = array(
              'nama_pejabat' => $nama_pejabat,	
              'jabatan' => $jabatan,
              'gambar_pejabat' => $nama_file,	
              'user_id' => $user_id
           );
          $model = new PejabatModel();
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
      $model = new PejabatModel();
       $ids = $this->request->getVar('ids');

     foreach ($ids as $key => $id) {
         $data = $model->where('id', $id)->first();
         $model->where('id',$id)->delete();
         unlink('img/pejabat/' . $data['gambar_pejabat']);
     }

     return $this->response->setJSON(['status' => 'success', 'message' => 'Data berhasil di hapus']);
    }
}
