<?php

namespace App\Controllers;
use App\Models\VisiMisiModel;

class VisiMisi extends BaseController
{
    
    public function index()
    {
      $session = session();
      $datas = $session->get();
      $model = new VisiMisiModel();
      $dataVisiMisi = $model->orderBy('kategori', 'DESC')->get()->getResult();
      
      $check = $model->where('kategori','visi')->first();
  
        $data = [
          'title' => 'BLK - visi - misi',
          'content_title' => 'Visi Misi',
          'name' => $datas['name'],
          'id_user' => $datas['id_user'],
          'data' => $dataVisiMisi,
          'check' => $check
        ];

        return view('pages/visi_misi/index',$data);
    }
      public function storeVisi(){
       $visi = $this->request->getVar('visi');
       $deskripsi = $this->request->getVar('deskripsi');
       $user_id = $this->request->getVar('user_id');
       $allowedTags='<p><strong><em><u><h1><h2><h3><h4><h5><h6><img>';
       $allowedTags.='<li><ol><ul><span><div><br><ins><del>';  
       
       $ciss =  strip_tags(stripslashes($_POST['deskripsi']),$allowedTags);
       
       $model = new VisiMisiModel();
       $check = $model->where('kategori','visi')->first();
      
      if(!is_null($check)){
        $data =[
          'user_id' =>$user_id,
          'kategori' => $visi,
          'deskripsi' => $ciss,
       ];

       $id = $this->request->getVar('id');
       if($model->update($id,$data)) {
            return $this->response->setJSON(['status' => 'success', 'message' => 'Data berhasil di update']);
        } else {
            return $this->response->setJSON(['status' => 'error', 'message' => 'Data gagal di update']);
        }
      }else{
          $data = [
            'kategori' => 'visi',
            'deskripsi' => $ciss,
          ];
          if ($model->insert($data)) {
            return $this->response->setJSON(['status' => 'success', 'message' => 'Data berhasil di tambah']);
        } else {
            return $this->response->setJSON(['status' => 'error', 'message' => 'Data gagal di tambah']);
        }
      }
      
    }
   
    public function storeMisi(){
       $misi = $this->request->getVar('misi');
       $model = new VisiMisiModel();
       $array = [];
       foreach ($misi as  $misis) {
            $value = [
                'user_id' => $this->request->getVar('user_id'),
                'kategori' => 'misi',
                'deskripsi' => $misis,
            ];
            $model->insert($value);
       }
       return $this->response->setJSON(['status' => 'success', 'message' => 'Data berhasil di tambah']);
        
    }

    public function edit()
      {

       $model = new VisiMisiModel();
       $ids = $this->request->getVar('id');
       $user_id = $this->request->getVar('user_id');
       $kategori = $this->request->getVar('kategori');
       $deskripsi = $this->request->getVar('deskripsi');

       $id = explode('data',$ids);
       
       $data =[
        'user_id' =>$user_id,
        'kategori' => $kategori,
        'deskripsi' => $deskripsi,
     ];
    if($model->update($id,$data)){
      return $this->response->setJSON(['status' => 'success','data' => $data, 'message' => 'Data berhasil di edit']);
    }
      
      }

      public function delete()
      {

       $model = new VisiMisiModel();
       $ids = $this->request->getVar('ids');

       foreach ($ids as $key => $id) {
           $model->where('id',$id)->delete();
       }

       return $this->response->setJSON(['status' => 'success', 'message' => 'Data berhasil di hapus']);
      }
}
