<?php
namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Validation\Validator;

class CustomersTable extends Table {

	public function initialize(array $config) {

		$this->setTable('customer');
	}

	public function validationDefault(Validator $validator) {

		$validator
			->notEmpty('name')
			->maxLength('name', 40, '40文字以下で入力してください。');

		$validator
			->notEmpty('kana')
			->maxLength('kana', 40, '40文字以下で入力してください。');

		$validator
			->numeric('postal_code', '半角数字のみを入力してください。')
			->maxLength('postal_code', 7, '半角数字のみを入力してください。');

		$validator
			->maxLength('address2', 100, '100文字以下で入力してください。');

		$validator
			->numeric('tel', '半角数字のみを入力してください。')
			->maxLength('tel', 14, '14文字以下で入力してください。');

		$validator
			->numeric('fax', '半角数字のみを入力してください。')
			->maxLength('fax', 14, '14文字以下で入力してください。');

		$validator
			->notEmpty('tax_type');

		$validator
			->notEmpty('rounding_type');

		$validator
			->notEmpty('closing_day');

		return $validator;
	}
}