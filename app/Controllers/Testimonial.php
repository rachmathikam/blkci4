<?php

namespace App\Controllers;

class Testimonial extends BaseController
{
    public function index()
    {
      $session = session();
      $datas = $session->get();
        $data = [
          'title' => 'BLK - Testimonial',
          'content_title' => 'Testimonial Pendaftar',
          'name' => $datas['name'],
          'id_user' => $datas['id_user']

        ];
        return view('pages/testimonial/index',compact('data'));
    }
}
