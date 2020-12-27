<?php namespace App\Controllers\Mahasiswa;

use App\Controllers\BaseController;
use App\Models\JadwalKuliahModel;
use App\Models\KrsModel;
use App\Models\MahasiswaModel;

class Mahasiswa extends BaseController
{
   protected $jadwalKuliahModel;
   protected $krsModel;
   protected $mhsModel;

   public function __construct()
   {
      $this->jadwalKuliahModel = new JadwalKuliahModel();
      $this->krsModel = new KrsModel();
      $this->mhsModel = new MahasiswaModel();
   }

   public function index()
   {
      $data = [
         'title' => 'Dashboard',
         'tahunAka' => $this->jadwalKuliahModel->tahunAktif(),
         'mahasiswa' => $this->krsModel->dataMhs(),
         'validation' => \Config\Services::validation()
      ];
      return view('mahasiswa/index', $data);
   }

   public function absensi()
   {
      $mhs = $this->krsModel->getMhsById();
      $ta = $this->jadwalKuliahModel->tahunAktif();
      $data = [
         'title' => 'Absensi Mahasiswa',
         'validation' => \Config\Services::validation(),
         'tahunAka' => $this->jadwalKuliahModel->tahunAktif(),
         'mhs' => $this->krsModel->dataMhs(),
         'matkulMhs' => $this->krsModel->dataKrs($mhs['id_mhs'], $ta['id_ta'])
      ];
      return view('mahasiswa/absen/index', $data);
   }

   // fungsi upload foto profil
   public function upload()
   {
      if(!$this->validate([
         'foto' => [
            'rules' => 'uploaded[foto]|max_size[foto,1024]|mime_in[foto,image/png,image/jpg,image/jpeg]|is_image[foto]|ext_in[foto,png,jpg,gif]'
         ]
      ])) {
         return redirect()->to('/mahasiswa')->withInput();
      }

      $foto = $this->request->getFile('foto');
      // acak foto
      $acakFoto = $foto->getRandomName();
      // pindahkan ke folder img
      $foto->move('img/mahasiswa', $acakFoto);
      // hapus foto lama
      unlink('img/mahasiswa/' . $this->request->getVar('fotoLama'));

      $this->mhsModel->updateFoto($acakFoto);
      session()->setFlashdata('pesan', 'Foto Profil Berhasil Diubah.');
      return redirect()->to('/mahasiswa');
   }

   //--------------------------------------------------------------------

}
