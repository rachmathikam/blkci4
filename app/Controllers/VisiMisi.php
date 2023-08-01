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
      $dataVisiMisi = $model->get()->getResult();
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

    public function edit(){
        var_dump($this->request->getVar('kategori'));
    }
}
