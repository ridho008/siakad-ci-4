<?php namespace App\Controllers\Mahasiswa;

use App\Controllers\BaseController;
use App\Models\JadwalKuliahModel;
use App\Models\KrsModel;

class Krs extends BaseController
{
   protected $jadwalKuliahModel;
   protected $krsModel;

   public function __construct()
   {
      $this->jadwalKuliahModel = new JadwalKuliahModel();
      $this->krsModel = new KrsModel();
   }

   public function index()
   {
      $data = [
         'title' => 'Kartu Rencana Studi',
         'tahunAka' => $this->jadwalKuliahModel->tahunAktif(),
         'mhs' => $this->krsModel->dataMhs()
      ];
      return view('mahasiswa/krs/index', $data);
   }

   //--------------------------------------------------------------------

}
