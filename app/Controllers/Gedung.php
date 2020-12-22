<?php namespace App\Controllers;

use App\Models\GedungModel;

class Gedung extends BaseController
{
	protected $gedungModel;

	public function __construct()
	{
		$this->gedungModel = new GedungModel();
	}

	public function index()
	{
		// mengambil url pagination
		$current_page = $this->request->getVar('page_gedung') ? $this->request->getVar('page_gedung') : 1;

		$keyword = $this->request->getVar('keyword');
		if($keyword) {
			$gedung = $this->gedungModel->search($keyword);
		} else {
			$gedung = $this->gedungModel;
		}

		$data = [
			'title' => 'Gedung',
			// 'fakultas' => $this->fakultasModel->findAll(),
			'gedung' => $gedung->paginate(2, 'gedung'),
			'pager' => $this->gedungModel->pager,
			'validation' => \Config\Services::validation(),
			'currentPage' => $current_page
		];
		return view('admin/gedung/index', $data);
	}

	public function save()
	{
		if(!$this->validate([
			'gedung' => [
				'rules' => 'required',
				'errors' => [
					'required' => '{field} wajib di isi.'
				]
			]
		])) {
			return redirect()->to('/gedung')->withInput();
		}

		$this->gedungModel->save([
			'gedung' => $this->request->getVar('gedung')
		]);

		session()->setFlashdata('success', 'Data Gedung Berhasil Ditambahkan.');
		return redirect()->to('/admin/gedung');
	}

	public function update($id)
	{
		if(!$this->validate([
			'gedung' => [
				'rules' => 'required',
				'errors' => [
					'required' => '{field} wajib di isi.'
				]
			]
		])) {
			return redirect()->to('/gedung')->withInput();
		}

		$this->gedungModel->save([
			'id_gedung' => $this->request->getVar('id_gedung'),
			'gedung' => $this->request->getVar('gedung')
		]);

		session()->setFlashdata('success', 'Data Gedung Berhasil Diedit.');
		return redirect()->to('/admin/gedung');
	}

	public function delete($id)
	{
		$this->gedungModel->delete($id);
		session()->setFlashdata('success', 'Data Gedung Berhasil Dihapus.');
		return redirect()->to('/gedung');
	}

	//--------------------------------------------------------------------

}
