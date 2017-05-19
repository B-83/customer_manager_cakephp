<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

class Area extends Entity {

	protected $_accessible = [
		'*' => true,
		'id' => false
	];
}