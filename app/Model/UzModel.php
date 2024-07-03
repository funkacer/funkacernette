<?php

namespace App\Models;

use \Nette\Neon\Neon;

//use Nette\Neon\Neon;

/**
 * Description of StatusModel
 *
 * @author garret
 */
final class UzModel {

    use \Nette\SmartObject;

	private \Nette\Database\Explorer $database;

	public function __construct(\Nette\Database\Explorer $database)
	{
		$this->database = $database;
	}

	public function getAllData()
	{
		return $this->database
			->table('uz')
			//->where('created_at < ', new \DateTime)
			->order('id ASC');
	}

}
