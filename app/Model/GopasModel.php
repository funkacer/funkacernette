<?php

namespace App\Models;

use \Nette\Neon\Neon;

//use Nette\Neon\Neon;

/**
 * Description of StatusModel
 *
 * @author garret
 */
final class GopasModel {

    use \Nette\SmartObject;

	private \Nette\Database\Explorer $database;

	public function __construct(\Nette\Database\Explorer $database)
	{
		$this->database = $database;
	}

	public function getAllData()
	{
		return $this->database
			->table('Day5_priklad4_json_data');
			//->where('created_at < ', new \DateTime)
			//->order('id ASC');
	}

}
