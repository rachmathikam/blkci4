<?php

namespace App\Controllers;

class Berita extends BaseController
{
    public function index()
    {
      $session = session();
      $datas = $session->get();
        $data = [
          'title' => 'BLK - Berita',
          'content_title' => 'Berita',
          'name' => $datas['name'],
          'id_user' => $datas['id_user']

        ];


        return view('pages/berita/index',$data);

    }
}
