<?php

namespace App\Models;

use CodeIgniter\Model;

class ProdiModel extends Model
{
	protected $table = 'prodi';
	protected $primaryKey = 'id_prodi';
	protected $allowedFields = ['id_fakultas', 'kode_prodi', 'prodi'];

	public function joinProdiFakultas()
	{
		return $this->db->table('prodi')
				->join('fakultas', 'fakultas.id_fakultas = prodi.id_fakultas')
				->get()->getResultArray();
	}

	public function getTable($table)
	{
		return $this->db->table($table);
	}
}