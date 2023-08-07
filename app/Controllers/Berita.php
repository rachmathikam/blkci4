<?php

namespace App\Controllers;
use App\Models\BeritaModel;

class Berita extends BaseController
{
  public function index()
  {
      $model = new BeritaModel();
      $data_berita = $model->get()->getResult();
      $session = session();
      $datas = $session->get();

        $data = [
          'title' => 'BLK - Berita',
          'content_title' => 'Berita',
          'name' => $datas['name'],
          'id_user' => $datas['id_user'],
          'data' => $data_berita
        ];


        return view('pages/berita/index',$data);

    }
    public function create()
    {
      $session = session();
      $datas = $session->get();
      $data = [
        'title' => 'BLK - Berita',
        'content_title' => 'Berita',
        'name' => $datas['name'],
        'id_user' => $datas['id_user'],
      
      ];
        return view('pages/berita/create',$data);
    }
    public function store()
    {
      $validation = \Config\Services::validation();
      $model = new BeritaModel();
      $validation->setRules([
          'slug' => [
              'rules' => 'required',
              'errors' => [
                    'required' => 'Judul Berita tidak boleh kosong !'
              ],
          ],
          'isi_berita' => [
            'rules' => 'required',
            'errors' => [
                  'required' => 'Isi Berita tidak boleh kosong !'
            ],
        ],
          'gambar_berita' => [
            'rules' => 'uploaded[gambar_berita]|max_length[10]|max_size[gambar_berita,1024]|is_image[gambar_berita]|mime_in[gambar_berita,image/jpg,image/jpeg,image/jpeg,image/png]',
            'errors' => [
                'uploaded' => 'gambar tidak boleh kosong',
                'max_size' => 'Maaf ukuran gambar terlalu besar !',
                'is_image' => 'Maaf yang anda pilih bukan gambar !',
                'mine_in'  => 'Maaf yang anda pilih bukan gambar !',
            ],
        ],
      ]);
        
      if ($validation->withRequest($this->request)->run()) {
        $id = $this->request->getVar('id');
        $user_id = $this->request->getVar('user_id');
        $slug = $this->request->getVar('slug');
        $isi_berita = $this->request->getVar('isi_berita');
        $slug = str_replace(' ', '-', $slug);

        $file = $this->request->getFile('gambar_berita');
        $file->move('img/berita');
        $nama_file = $file->getName();
        // print_r($nama_file);
        // die;
        $created_at = date("Y-m-d H:i:s");
        
        $leng = strlen($nama_file);
        if($leng <= 20){
          $data = array(
            'slug' => $slug,	
            'isi_berita' => $isi_berita,	
            'gambar_berita' => $nama_file,	
            'user_id' => $user_id,
            'created_at' => $created_at
          );
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
     $model = new BeritaModel();
     $data_berita = $model->find($id);
     $session = session();
     $datas = $session->get();
     $data = [
      'title' => 'BLK - Berita',
      'content_title' => 'Berita',
      'name' => $datas['name'],
      'id_user' => $datas['id_user'],
      'data' => $data_berita
    ];

    return view('pages/berita/edit',$data);
  }

  public function update()
  {
    $validation = \Config\Services::validation();
    $model = new BeritaModel();
    $validation->setRules([
        'slug' => [
            'rules' => 'required',
            'errors' => [
                  'required' => 'Judul Berita tidak boleh kosong !'
            ],
        ],
        'isi_berita' => [
          'rules' => 'required',
          'errors' => [
                'required' => 'Isi Berita tidak boleh kosong !'
          ],
      ],
        'gambar_berita' => [
          'rules' => 'max_length[10]|max_size[gambar_berita,1024]|is_image[gambar_berita]|mime_in[gambar_berita,image/jpg,image/jpeg,image/jpeg,image/png]',
          'errors' => [
              // 'uploaded' => 'gambar tidak boleh kosong',
              'max_size' => 'Maaf ukuran gambar terlalu besar !',
              'is_image' => 'Maaf yang anda pilih bukan gambar !',
              'mine_in'  => 'Maaf yang anda pilih bukan gambar !',
          ],
      ],
    ]);

    if ($validation->withRequest($this->request)->run()) {
      $id = $this->request->getVar('id');
      $user_id = $this->request->getVar('user_id');
      $slug = $this->request->getVar('slug');
      $isi_berita = $this->request->getVar('isi_berita');
      $slug = str_replace(' ', '-', $slug);
      
      
      
      $created_at = date("Y-m-d H:i:s");
      
      $file = $this->request->getFile('gambar_berita');
  
      if($file->getError() == 4){
          $nama_file = $this->request->getVar('old_gambar');
      }else{
          $file->move('img/berita');
          $nama_file = $file->getName();
          if(!empty($this->request->getVar('old_gambar'))){
            unlink('img/berita/' . $this->request->getVar('old_gambar'));
          }
       }
       $leng = strlen($nama_file);
      if($leng <= 20){
        $data = array(
        'slug' => $slug,	
        'isi_berita' => $isi_berita,	
        'gambar_berita' => $nama_file,	
        'user_id' => $user_id,
        'created_at' => $created_at
      );

        if ($model->update($id,$data)){
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

  public function delete()
  {
     $model = new BeritaModel();
     $ids = $this->request->getVar('ids');

     $check = $model->countAll();
     
    if($check == 1){
      $files = glob('img/berita/*');
      foreach($files as $file){ // iterate files
        if(is_file($file)) {
          unlink($file); // delete file
        }
      }
      $model->delete($ids);
    }else{
     $data =  $model->orderby('id', 'DESC')->limit(1)->get()->getResult();
     $array = json_decode(json_encode($data), true);
     $as = '';
     foreach ($data as $value){
       $as = $value->id;
     }
      foreach ($ids as $id) {
        if ($id == $as) {
            continue; 
        }
        $data =  $model->find($id);
        $model->delete($id);
        unlink('img/berita/' . $data['gambar_berita']);
    }
      
    }
     return $this->response->setJSON(['status' => 'success','message' => 'data berhasil di hapus']);
  }

  public function uploadGambar(){
      if ($this->request->getFile('file')) {
        $dataFile = $this->request->getFile('file');
        $fileName = $dataFile->getName();
        $dataFile->move("img/berita/", $fileName);
        echo base_url("img/berita/$fileName");
    }    
  }

  function deleteGambar()
  {
      $src = $this->request->getVar('src');
      if ($src) {
          $file_name = str_replace(base_url(), "", $src);
          if (unlink($file_name)) {
              echo "Delete file berhasil";
          }
      }
  }

  function listGambar()
  {
      $files = array_filter(glob('img/berita/*'), 'is_file');
      $response = [];
      foreach ($files as $file) {
          if (strpos($file, "index.html")) {
              continue;
          }
          $response[] = basename($file);
      }
      header("Content-Type:application/json");
      echo json_encode($response);
      die();
  }

}
