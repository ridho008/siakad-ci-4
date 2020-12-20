<?php namespace App\Controllers\Dosen;

use App\Controllers\BaseController;

class Dosen extends BaseController
{

   public function index()
   {
      $data = [
         'title' => 'Dashboard Dosen'
      ];
      return view('dosen/index', $data);
   }

   //--------------------------------------------------------------------

}
