<?php
namespace App\Controller;

use Cake\ORM\TableRegistry;
use Cake\Error\Debugger;

class CustomersController extends AppController {

	public $name = 'Customers';

	public $paginate = [
		'limit' => 20,
		'order' => ['id' => 'DESC'],
	];

	/**
	 * 初期処理
	 * {@inheritDoc}
	 * @see \App\Controller\AppController::initialize()
	 */
	public function initialize() {

		parent::initialize();
		$this->loadComponent('Paginator');
		// レイアウトの適用
		$this->viewBuilder()->autoLayout(true);
		$this->viewBuilder()->layout('Customer');
	}

	/**
	 * index method
	 *
	 */
	public function index() {

		// 都道府県を取得、反映
		$this->loadModel('Areas');
		$query = $this->Areas->find('all', ['order'=>['id ASC']])->select(['state'])->distinct(['state']);
		$states = [];
		foreach ($query as $state) {
			array_push($states, $state->state);
		}
		$this->set("states", $states);

		// 検索条件を反映
// 			$customers = $this->Customers->find('all', [
// 				'conditions'=>[
// 					$this->request->data['name'] ? ['name LIKE'=>'%' . $this->request->data['name'] . '%'] : null,
// 					$this->request->data['kana'] ? ['kana LIKE'=>'%' . $this->request->data['kana'] . '%'] : null,
// 					$this->request->data['postal_code'] ? ['postal_code'=>$this->request->data['postal_code']] : null,
// 					$this->request->data['address1'] ? ['address1'=>$this->request->data['address1']] : null,
// 					$this->request->data['address2'] ? ['address2 LIKE'=>'%' . $this->request->data['address2'] . '%'] : null,
// 					$this->request->data['tel'] ? ['tel'=>$this->request->data['tel']] : null,
// 					$this->request->data['fax'] ? ['fax'=>$this->request->data['fax']] : null,
// 				]
// 			]);

// 		$customers = $this->Customers->find('all', [
// 			'conditions'=>['postal_code LIKE'=>'%' . $this->request->data['postal_code'] . '%']
// 		]);

// 		$conditions = $this->Customers->newEntity();
// 		$this->set("conditions", $conditions);

// 		$this->request->getQuery('postal_code')
		echo $this->request->getData['postal_code'];
		echo $this->request->getQuery['postal_code'];

		// 顧客を取得、反映
		$customers = $this->Customers->find()->where(['deleted IS'=>null]);
		$customers = $this->paginate($customers);
		$this->set("customers", $customers);
	}


	public function detail() {

	}


	public function entry() {

	}


	public function edit() {

	}


	public function check() {

	}
}