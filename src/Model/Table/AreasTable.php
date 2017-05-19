<?php
namespace App\Model\Table;

use Cake\ORM\Table;

class AreasTable extends Table {

	public function initialize(array $config) {

		$this->setTable('area');
	}
}