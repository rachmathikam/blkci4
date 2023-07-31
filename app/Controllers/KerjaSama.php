<?php

namespace App\Controllers;

class KerjaSama extends BaseController
{
    public function index()
    {
      $session = session();
      $datas = $session->get();
        $data = [
        'title' => 'BLK - kerja sama',
          'content_title' => 'Kerja Sama',
          'name' => $datas['name'],
          'id_user' => $datas['id_user']

        ];


        return view('pages/kerja_sama/index',compact('data'));
    }
}
