<?php namespace App\Controllers;

use App\Models\TahunAkaModel;

class TahunAka extends BaseController
{
	protected $tahunAkaModel;

	public function __construct()
	{
		$this->tahunAkaModel = new TahunAkaModel();
	}

	public function index()
	{
		// mengambil url pagination
		$current_page = $this->request->getVar('page_tahun_akademik') ? $this->request->getVar('page_tahun_akademik') : 1;

		$keyword = $this->request->getVar('keyword');
		if($keyword) {
			$tahun = $this->tahunAkaModel->search($keyword);
		} else {
			$tahun = $this->tahunAkaModel;
		}

		$data = [
			'title' => 'Tahun Akademik',
			'tahun' => $tahun->paginate(2, 'tahun_akademik'),
			'validation' => \Config\Services::validation(),
			'pager' => $this->tahunAkaModel->pager,
			'currentPage' => $current_page
		];
		return view('admin/tahun_akademik/index', $data);
	}

	public function save()
	{
		if(!$this->validate([
			'tahun' => [
				'rules' => 'required',
				'errors' => [
					'required' => '{field} wajib di isi.'
				]
			],
			'semester' => [
				'rules' => 'required',
				'errors' => [
					'required' => '{field} wajib di isi.'
				]
			]
		])) {
			return redirect()->to('/admin/tahunaka')->withInput();
		}

		$this->tahunAkaModel->save([
			'tahun_aka' => $this->request->getVar('tahun'),
			'semester' => $this->request->getVar('semester')
		]);

		session()->setFlashdata('success', 'Data Tahun Akademik Berhasil Ditambahkan.');
		return redirect()->to('/admin/tahunaka');
	}

	public function update($id)
	{
		if(!$this->validate([
			'tahun' => [
				'rules' => 'required',
				'errors' => [
					'required' => '{field} wajib di isi.'
				]
			],
			'semester' => [
				'rules' => 'required',
				'errors' => [
					'required' => '{field} wajib di isi.'
				]
			]
		])) {
			return redirect()->to('/admin/tahunaka')->withInput();
		}

		$this->tahunAkaModel->save([
			'id_ta' => $this->request->getVar('id_ta'),
			'tahun_aka' => $this->request->getVar('tahun'),
			'semester' => $this->request->getVar('semester')
		]);

		session()->setFlashdata('success', 'Data Tahun Akademik Berhasil Diedit.');
		return redirect()->to('/admin/tahunaka');
	}

	public function destroy($id)
	{
		$this->tahunAkaModel->delete($id);

		session()->setFlashdata('success', 'Data Tahun Akademik Berhasil Dihapus.');
		return redirect()->to('/admin/tahunaka');
	}

	//--------------------------------------------------------------------

}
