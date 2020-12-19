<?php

namespace App\Models;

use CodeIgniter\Model;

class ProdiModel extends Model
{
	protected $table = 'prodi';
	protected $primaryKey = 'id_prodi';
	protected $allowedFields = ['id_fakultas', 'kode_prodi', 'prodi', 'jenjang', 'ketua_prodi'];

	public function joinProdiFakultas()
	{
		return $this->db->table('prodi')
				->join('fakultas', 'fakultas.id_fakultas = prodi.id_fakultas')
				->get()->getResultArray();
	}

	public function joinProdiFakultasWhereId($id)
	{
		return $this->db->table('prodi')
				->join('fakultas', 'fakultas.id_fakultas = prodi.id_fakultas')
				->where('id_prodi', $id)
				->get()->getRowArray();
	}

	public function getTable($table)
	{
		return $this->db->table($table);
	}

	public function countProdi()
   {
      return $this->db->table('prodi')
               ->countAllResults();
   }
}