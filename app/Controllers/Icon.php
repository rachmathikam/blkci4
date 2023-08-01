<?php

namespace App\Controllers;

class Icon extends BaseController
{
    public function index()
    {
      $session = session();
      $datas = $session->get();
        $data = [
          'title' => 'BLK - icon',
          'content_title' => 'icon',
          'name' => $datas['name'],
          'id_user' => $datas['id_user']

        ];


        return view('pages/icon/index',$data);
    }
}
