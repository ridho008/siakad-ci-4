<?php namespace App\Controllers;

use App\Models\GedungModel;
use App\Models\RuanganModel;
use App\Models\ProdiModel;
use App\Models\MahasiswaModel;

class Dashboard extends BaseController
{
   protected $gedungModel;
   protected $ruanganModel;
   protected $prodiModel;
   protected $mahasiswaModel;

   public function __construct()
   {
      $this->gedungModel = new GedungModel();
      $this->ruanganModel = new RuanganModel();
      $this->prodiModel = new ProdiModel();
      $this->mahasiswaModel = new MahasiswaModel();
   }

	public function index()
	{
		$data = [
			'title' => 'Dashboard',
         'gedung' => $this->gedungModel->countGedung(),
         'ruangan' => $this->ruanganModel->countRuangan(),
         'prodi' => $this->prodiModel->countProdi(),
         'mahasiswa' => $this->mahasiswaModel->countMhs()
		];
		return view('admin/dashboard', $data);
	}

	//--------------------------------------------------------------------

}
