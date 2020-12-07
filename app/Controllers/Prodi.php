<?php namespace App\Controllers;

use App\Models\ProdiModel;

class Prodi extends BaseController
{
	protected $prodiModel;

	public function __construct()
	{
		$this->prodiModel = new ProdiModel();
	}

	public function index()
	{
		$data = [
			'title' => 'Program Studi',
			'prodi' => $this->prodiModel->joinProdiFakultas()
		];
		return view('admin/prodi/index', $data);
	}

	public function create()
	{
		$data = [
			'title' => 'Tambah Program Studi',
			'validation' => \Config\Services::validation(),
			'fakultas' => $this->prodiModel->getTable('fakultas')->get()->getResultArray()
		];
		return view('admin/prodi/create', $data);
	}

	public function save()
	{
		if(!$this->validate([
			'id_fakultas' => [
				'rules' => 'required',
				'errors' => [
					'required' => '{field} wajib di isi.'
				]
			],
			'kode_prodi' => [
				'rules' => 'required|is_unique[prodi.kode_prodi]',
				'errors' => [
					'required' => '{field} wajib di isi.',
					'is_unique' => '{field} sudah terdaftar, coba kode lain.'
				]
			],
			'prodi' => [
				'rules' => 'required',
				'errors' => [
					'required' => '{field} wajib di isi.'
				]
			]
		])) {
			return redirect()->to('/prodi/create')->withInput();
		}

		$this->prodiModel->save([
			'id_fakultas' => $this->request->getVar('id_fakultas'),
			'kode_prodi' => $this->request->getVar('kode_prodi'),
			'prodi' => $this->request->getVar('prodi')
		]);

		session()->setFlashdata('success', 'Data Prodi Berhasil Ditambahkan.');
		return redirect()->to('/prodi');
	}

	public function edit($id)
	{
		$data = [
			'title' => 'Edit Data Prodi',
			'validation' => \Config\Services::validation(),
			'prodi' => $this->prodiModel->find($id),
			'fakultas' => $this->prodiModel->getTable('fakultas')->get()->getResultArray()
		];
		return view('admin/prodi/edit', $data);
	}

	public function update($id)
	{
		if(!$this->validate([
			'id_fakultas' => [
				'rules' => 'required',
				'errors' => [
					'required' => '{field} wajib di isi.'
				]
			],
			'kode_prodi' => [
				'rules' => 'required',
				'errors' => [
					'required' => '{field} wajib di isi.'
				]
			],
			'prodi' => [
				'rules' => 'required',
				'errors' => [
					'required' => '{field} wajib di isi.'
				]
			]
		])) {
			return redirect()->to('/prodi/edit/' . $id)->withInput();
		}

		$this->prodiModel->save([
			'id_prodi' => $this->request->getVar('id_prodi'),
			'id_fakultas' => $this->request->getVar('id_fakultas'),
			'kode_prodi' => $this->request->getVar('kode_prodi'),
			'prodi' => $this->request->getVar('prodi')
		]);

		session()->setFlashdata('success', 'Data Prodi Berhasil Diedit.');
		return redirect()->to('/prodi');
	}

	public function destroy($id)
	{
		$this->prodiModel->delete($id);

		session()->setFlashdata('success', 'Data Prodi Berhasil Dihapus.');
		return redirect()->to('/prodi');
	}

	//--------------------------------------------------------------------

}
