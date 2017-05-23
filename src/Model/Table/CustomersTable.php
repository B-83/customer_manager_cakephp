<?php
namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Validation\Validator;

class CustomersTable extends Table {

	public function initialize(array $config) {

		$this->setTable('customer');
	}

	public function validationDefault(Validator $validator) {

		$validator->notEmpty('name');
		$validator->notEmpty('kana');
		$validator->notEmpty('tax_type');
		$validator->notEmpty('rounding_type');
		$validator->notEmpty('closing_day');
		return $validator;
	}
}