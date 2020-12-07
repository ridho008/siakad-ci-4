<?php namespace App\Controllers;

use App\Models\RuanganModel;

class Ruangan extends BaseController
{
	protected $ruanganModel;

	public function __construct()
	{
		$this->ruanganModel = new RuanganModel();
	}

	public function index()
	{
		$data = [
			'title' => 'Ruangan',
			'ruangan' => $this->ruanganModel->get_join()
		];
		return view('admin/ruangan/index', $data);
	}

	public function create()
	{
		$data = [
			'title' => 'Tambah Data Ruangan',
			'validation' => \Config\Services::validation(),
			'gedung' => $this->ruanganModel->getTable('gedung')->get()->getResultArray()
		];
		return view('admin/ruangan/create', $data);
	}

	public function save()
	{
		if(!$this->validate([
			'gedung' => [
				'rules' => 'required',
				'errors' => [
					'required' => '{field} wajib di isi.'
				]
			],
			'ruangan' => [
				'rules' => 'required',
				'errors' => [
					'required' => '{field} wajib di isi.'
				]
			]
		])) {
			return redirect()->to('/ruangan/create')->withInput();
		}

		$this->ruanganModel->save([
			'id_gedung' => $this->request->getVar('gedung'),
			'ruangan' => $this->request->getVar('ruangan')
		]);

		session()->setFlashdata('success', 'Data Ruangan Berhasil Ditambahkan.');
		return redirect()->to('/ruangan');
	}

	public function edit($id)
	{
		$data = [
			'title' => 'Edit Data Ruangan',
			'validation' => \Config\Services::validation(),
			'ruangan' => $this->ruanganModel->find($id),
			'gedung' => $this->ruanganModel->getTable('gedung')->get()->getResultArray()
		];
		return view('admin/ruangan/edit', $data);
	}

	public function update($id)
	{
		if(!$this->validate([
			'gedung' => [
				'rules' => 'required',
				'errors' => [
					'required' => '{field} wajib di isi.'
				]
			],
			'ruangan' => [
				'rules' => 'required',
				'errors' => [
					'required' => '{field} wajib di isi.'
				]
			]
		])) {
			return redirect()->to('/ruangan/edit/' . $id)->withInput();
		}

		$this->ruanganModel->save([
			'id_ruangan' => $this->request->getVar('id_ruangan'),
			'id_gedung' => $this->request->getVar('gedung'),
			'ruangan' => $this->request->getVar('ruangan')
		]);

		session()->setFlashdata('success', 'Data Ruangan Berhasil Diedit.');
		return redirect()->to('/ruangan');
	}

	public function destroy($id)
	{
		$this->ruanganModel->delete($id);

		session()->setFlashdata('success', 'Data Ruangan Berhasil Dihapus.');
		return redirect()->to('/ruangan');
	}

	//--------------------------------------------------------------------

}
