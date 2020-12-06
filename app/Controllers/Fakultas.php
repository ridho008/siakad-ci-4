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
		$data = [
			'title' => 'Fakultas',
			'fakultas' => $this->fakultasModel->findAll(),
			'validation' => \Config\Services::validation()
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
		return redirect()->to('/fakultas');
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
