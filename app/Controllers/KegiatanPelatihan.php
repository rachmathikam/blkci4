<?php

namespace App\Controllers;

class KegiatanPelatihan extends BaseController
{
    public function index()
    {
      $session = session();
      $datas = $session->get();
        $data = [
          'title' => 'BLK - Kegiatan Pelatihan',
          'content_title' => 'Kegiatan Pelatihan ',
          'name' => $datas['name'],
          'id_user' => $datas['id_user']

        ];
        return view('pages/kegiatan_pelatihan/index',compact('data'));
    }
}
