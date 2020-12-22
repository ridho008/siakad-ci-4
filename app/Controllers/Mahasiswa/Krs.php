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
         'validation' => \Config\Services::validation(),
         'tahunAka' => $this->jadwalKuliahModel->tahunAktif(),
         'mhs' => $this->krsModel->dataMhs(),
         'jadwalMatkul' => $this->krsModel->daftarMatkul(),
         'matkulMhs' => $this->krsModel->dataKrs()
      ];
      return view('mahasiswa/krs/index', $data);
   }

   public function tambahmatkul()
   {
      // dd($this->request->getVar('id_jadwal'));
      $tahunAktif = $this->jadwalKuliahModel->tahunAktif();
      $idMhs = $this->krsModel->getMhsById();
      $this->krsModel->save([
         'id_jadwal' => $this->request->getVar('id_jadwal'),
         'id_mhs' => $idMhs['id_mhs'],
         'id_ta' => $tahunAktif['id_ta']
      ]);
      session()->setFlashdata('success', 'Anda Berhasil Menambahkan Mata Kuliah');
      return redirect()->to('/mahasiswa/krs');
   }

   //--------------------------------------------------------------------

}
