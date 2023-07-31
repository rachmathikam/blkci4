<?php

namespace App\Controllers;

class VisiMisi extends BaseController
{
    public function index()
    {
      $session = session();
      $datas = $session->get();
        $data = [
          'title' => 'BLK - visi - misi',
          'content_title' => 'Visi Misi',
          'name' => $datas['name'],
          'id_user' => $datas['id_user']

        ];


        return view('pages/visi_misi/index',compact('data'));
    }
}
