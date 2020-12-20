<?php namespace App\Controllers\Mahasiswa;

use App\Controllers\BaseController;

class Mahasiswa extends BaseController
{

   public function index()
   {
      $data = [
         'title' => 'Dashboard Mahasiswa'
      ];
      return view('mahasiswa/index', $data);
   }

   //--------------------------------------------------------------------

}
