<?php
namespace App\Controller;

use Cake\ORM\TableRegistry;
use Cake\Error\Debugger;
use App\Model\Entity\Customer;

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
		$this->loadComponent('RequestHandler'); // あとでAppのほうに書き換える
		// レイアウトの適用
		$this->viewBuilder()->autoLayout(true);
		$this->viewBuilder()->layout('Customer');
	}

	/**
	 * index method
	 *
	 */
	public function index() {

		// 都道府県を取得してセット
		$states = $this->_getCities();
		$this->set("states", $states);

		// 検索条件をセット
		$conditions = $this->Customers->newEntity();
		if (!empty($this->request->getQueryParams())) {
			if ($this->request->getQuery('name')) { $conditions['name'] = $this->request->getQuery('name');}
			if ($this->request->getQuery('kana')) { $conditions['kana'] = $this->request->getQuery('kana');}
			if ($this->request->getQuery('postal_code')) { $conditions['postal_code'] = $this->request->getQuery('postal_code');}
			if ($this->request->getQuery('address1')) { $conditions['address1'] = $this->request->getQuery('address1');}
			if ($this->request->getQuery('address2')) { $conditions['address2'] = $this->request->getQuery('address2');}
			if ($this->request->getQuery('tel')) { $conditions['tel'] = $this->request->getQuery('tel');}
			if ($this->request->getQuery('fax')) { $conditions['fax'] = $this->request->getQuery('fax');}
		}
		$this->set("conditions", $conditions);

		// 検索条件から顧客を検索
		$customers = $this->Customers->find()->where(['deleted IS' => null]);
		if ($this->request->getQuery('name')) { $customers->where(['name LIKE' => '%' . $this->request->getQuery('name') . '%']); }
		if ($this->request->getQuery('kana')) { $customers->where(['kana LIKE' => '%' . $this->request->getQuery('kana'). '%']); }
		if ($this->request->getQuery('postal_code')) { $customers->where(['postal_code' => $this->request->getQuery('postal_code')]); }
		if ($this->request->getQuery('address1')) { $customers->where(['address1' => $this->request->getQuery('address1')]); }
		if ($this->request->getQuery('address2')) { $customers->where(['address2 LIKE' => '%' . $this->request->getQuery('address2'). '%']); }
		if ($this->request->getQuery('tel')) { $customers->where(['tel' => $this->request->getQuery('tel')]); }
		if ($this->request->getQuery('fax')) { $customers->where(['fax' => $this->request->getQuery('fax')]); }
		// ページネーション
		$customers = $this->paginate($customers);

		// 顧客情報を表示用に変換してセット
		foreach ($customers as $customer) {
			$this->_customerConvert($customer);
		}
		$this->set("customers", $customers);
	}

	/**
	 * 顧客名称サジェスト
	 *
	 */
	public function suggestName() {

		$this->viewClass = 'Json';
		$this->autoRender = false;

		$query = $this->Customers->find()
			->select('name')
			->where(['name LIKE' => '%' . $this->request->getQuery('name') . '%'])
			->limit(10);
		echo json_encode($query);

		// ajax通信かどうか判定
// 		if($this->request->is('ajax')) {

// 		}
	}

	/**
	 * 顧客かなサジェスト
	 *
	 */
	public function suggestKana() {

		$this->viewClass = 'Json';
		$this->autoRender = false;

		$query = $this->Customers->find()
		->select('kana')
		->where(['kana LIKE' => '%' . $this->request->getQuery('kana') . '%'])
		->limit(10);
		echo json_encode($query);
	}

	public function detail() {

	}


	public function entry() {

		// 都道府県を取得してセット
		$states = $this->_getCities();
		$this->set("states", $states);

		// 新規顧客情報をセット
		$customer = $this->Customers->newEntity();
		$this->set("customer", $customer);
	}

	// TODO やらないといけないこと
	// FIXME 注意的なイメージ
	public function edit() {

	}


	public function check() {

	}


	/**
	 * 顧客情報変換メソッド
	 * @param Customer $customer
	 */
	private function _customerConvert(Customer $customer) {

		// 郵便番号
		if ($customer->postal_code) {
			$customer->postal_code = substr_replace($customer->postal_code, '-', 3, 0);
		}

		// 税区分
		switch ($customer->tax_type) {
			case 1:
				$customer->tax_type = '切捨て';
				break;
			case 2:
				$customer->tax_type = '四捨五入';
				break;
			case 3:
				$customer->tax_type = '切上げ';
				break;
		}

		// 丸め方法
		switch ($customer->rounding_type) {
			case 1:
				$customer->rounding_type = '領収書';
				break;
			case 2:
				$customer->rounding_type = '明細行';
				break;
		}

		// 登録日時
		$customer->created = $customer->created->i18nFormat('yyyy年MM月dd日 kk時mm分');

		// 更新日時
		$customer->updated = $customer->updated->i18nFormat('yyyy年MM月dd日 kk時mm分');
	}

	/**
	 * 都道府県取得メソッド
	 * @return NULL[]
	 */
	private function _getCities() {

		$this->loadModel('Areas');
		$query = $this->Areas->find('all', ['order' => ['id ASC']])->select(['state'])->distinct(['state']);
		$states = [];
		foreach ($query as $state) {
			$states[] = $state->state;
		}
		return $states;
	}
}