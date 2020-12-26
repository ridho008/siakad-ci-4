<?php namespace App\Controllers;

use App\Models\FakultasModel;

class Fakultas extends BaseController
{
	protected $fakultasModel;

	public function __construct()
	{
		$this->fakultasModel = new FakultasModel();
	}

	public function index()
	{
		// mengambil url pagination
		$current_page = $this->request->getVar('page_fakultas') ? $this->request->getVar('page_fakultas') : 1;

		$keyword = $this->request->getVar('keyword');
		if($keyword) {
			$fakultas = $this->fakultasModel->search($keyword);
		} else {
			$fakultas = $this->fakultasModel;
		}

		$data = [
			'title' => 'Fakultas',
			// 'fakultas' => $this->fakultasModel->findAll(),
			'fakultas' => $fakultas->paginate(2, 'fakultas'),
			'pager' => $this->fakultasModel->pager,
			'validation' => \Config\Services::validation(),
			'currentPage' => $current_page
		];
		return view('admin/fakultas/index', $data);
	}

	public function save()
	{
		if(!$this->validate([
			'fakultas' => [
				'rules' => 'required',
				'errors' => [
					'required' => '{field} wajib di isi.'
				]
			]
		])) {
			return redirect()->to('/fakultas')->withInput();
		}

		$this->fakultasModel->save([
			'fakultas' => $this->request->getVar('fakultas')
		]);

		session()->setFlashdata('success', 'DataFakultas Berhasil Ditambahkan.');
		return redirect()->to('/admin/fakultas');
	}

	public function update($id)
	{
		if(!$this->validate([
			'fakultas' => [
				'rules' => 'required',
				'errors' => [
					'required' => '{field} wajib di isi.'
				]
			]
		])) {
			return redirect()->to('/fakultas')->withInput();
		}

		$this->fakultasModel->save([
			'id_fakultas' => $this->request->getVar('id_fakultas'),
			'fakultas' => $this->request->getVar('fakultas')
		]);

		session()->setFlashdata('success', 'Data Fakultas Berhasil Diedit.');
		return redirect()->to('/fakultas');
	}

	public function delete($id)
	{
		$this->fakultasModel->delete($id);
		session()->setFlashdata('success', 'Data Fakultas Berhasil Dihapus.');
		return redirect()->to('/fakultas');
	}

	//--------------------------------------------------------------------

}
