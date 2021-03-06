<?php

namespace App\Models;

use CodeIgniter\Model;

class MatkulModel extends Model
{
	protected $table = 'matkul';
	protected $primaryKey = 'id_matkul';
	protected $allowedFields = ['kode_matkul', 'matkul', 'sks', 'kategori', 'smt', 'semester', 'id_prodi'];

	public function joinTable()
	{
		return $this->table('matkul')
				->join('prodi', 'prodi.id_prodi = matkul.id_prodi');
	}

  public function getWhereIdProdi($id)
  {
    return $this->table('matkul')
            ->where('id_prodi', $id)
            ->orderBy('smt', 'asc')
            ->get()->getResultArray();
  }
}