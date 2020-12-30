<?php namespace App\Controllers\Mahasiswa;

use App\Controllers\BaseController;
use App\Models\JadwalKuliahModel;
use App\Models\KrsModel;

class Khs extends BaseController
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
      $mhs = $this->krsModel->getMhsById();
      $ta = $this->jadwalKuliahModel->tahunAktif();
      $data = [
         'title' => 'Kartu Rencana Studi',
         'validation' => \Config\Services::validation(),
         'tahunAka' => $this->jadwalKuliahModel->tahunAktif(),
         'mhs' => $this->krsModel->dataMhs(),
         'jadwalMatkul' => $this->krsModel->daftarMatkul($ta['id_ta'], $mhs['id_prodi']),
         'matkulMhs' => $this->krsModel->dataKrs($mhs['id_mhs'], $ta['id_ta'])
      ];
      return view('mahasiswa/khs/index', $data);
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

   public function destroy()
   {
      $this->krsModel->delete($this->request->getVar('id_krs'));
      session()->setFlashdata('success', 'Data Matkul Berhasil Dihapus');
      return redirect()->to('/mahasiswa/krs');
   }

   public function print()
   {
      $mhs = $this->krsModel->getMhsById();
      $ta = $this->jadwalKuliahModel->tahunAktif();
      $data = [
         'title' => 'Print KRS',
         'tahunAka' => $this->jadwalKuliahModel->tahunAktif(),
         'mhs' => $this->krsModel->dataMhs(),
         'matkulMhs' => $this->krsModel->dataKrs($mhs['id_mhs'], $ta['id_ta'])
      ];
      return view('mahasiswa/krs/print_krs', $data);
   }

   //--------------------------------------------------------------------

}
