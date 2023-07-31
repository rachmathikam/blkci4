<?php

namespace App\Controllers;

class Dashboard extends BaseController
{
    public function index()
    {
      $session = session();
      $datas = $session->get();
        $data = [
          'title' => 'BLK | Dashboard',
          'content_title' => 'Dashboard',
          'name' => $datas['name'],
        ];


        return view('pages/dashboard/index',$data);
    }
}
