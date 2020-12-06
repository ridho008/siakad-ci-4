<?php

namespace App\Models;

use CodeIgniter\Model;

class FakultasModel extends Model
{
	protected $table = 'fakultas';
	protected $primaryKey = 'id_fakultas';
	protected $allowedFields = ['fakultas'];
}