<?php
namespace App\Controller;

use Cake\ORM\TableRegistry;
use Cake\Error\Debugger;
use App\Model\Entity\Customer;
use App\Model\Table\CustomersTable;
use Cake\ORM\ResultSet;

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
	 * index 画面表示
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
		$convertCustomers = $this->_convertCustomers($customers);
		$this->set("customers", $convertCustomers);
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

	/**
	 * entry 画面表示
	 *
	 */
	public function entry() {

		// 都道府県を取得してセット
		$states = $this->_getCities();
		$this->set("states", $states);

		// 新規顧客情報をセット
		$customer = $this->Customers->newEntity();
		if ($this->request->getParam('customer')) {
			$customer = $this->request->getParam('customer');
		}
		$customer->set("id", "new");
		$this->set("customer", $customer);

		// 税区分をセット
		$this->set("taxTypes", $this->taxTypes);
		// 丸め方法をセット
		$this->set("roundingTypes", $this->roundingTypes);
		// 締め日をセット
		$this->set("closingDays", $this->closingDays);
	}

	/**
	 * バリデーションチェック リダイレクト
	 * @return \Cake\Http\Response|NULL
	 */
	public function clearOrError() {

		$this->autoRender = false;

		$customer = $this->Customers->newEntity();
		$customer->set('id', $this->request->getData('id'));
		$customer->set('name', $this->request->getData('name'));
		$customer->set('kana', $this->request->getData('kana'));
		$customer->set('postal_code', $this->request->getData('postal_code'));
		$customer->set('address1', $this->request->getData('address1'));
		$customer->set('address2', $this->request->getData('address2'));
		$customer->set('tax_type', $this->request->getData('tax_type'));
		$customer->set('rounding_type', $this->request->getData('rounding_type'));
		$customer->set('closing_day', $this->request->getData('closing_day'));

		// FIXME バリデーション効いてない
		echo $customer->errors();

		// バリデーションエラーがなかった場合
		if(empty($customer->errors())) {
			return $this->redirect(['controller' => 'Customers', 'action' => '/check/' . $customer->get("id")]);
		} else {
			// 登録でバリデーションエラーがあった場合
			if ($id === 'new') {
				return $this->redirect(['controller' => 'Customers', 'action' => '/entry', 'customer' => $customer]);

			// 編集でバリデーションエラーがあった場合
			} else {
				return $this->redirect(['controller' => 'Customers', 'action' => '/edit/' . $customer->get("id")]);
			}
		}
	}

	/**
	 * check 画面表示
	 */
	public function check() {

		echo 'check page';
		// 顧客情報をセット
// 		$customer = $this->request->getData('customer');
// 		$customer->set("id", "new");
// 		$this->set("customer", $customer);
	}

	/**
	 * 顧客情報変換メソッド
	 * @param Customer $customer
	 */
	private function _convertCustomer(Customer $customer) {

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
				$customer->rounding_type = '明細行';
				break;
			case 2:
				$customer->rounding_type = '請求書';
				break;
		}

		// 登録日時
		$customer->created = $customer->created->i18nFormat('yyyy年MM月dd日 kk時mm分');

		// 更新日時
		$customer->updated = $customer->updated->i18nFormat('yyyy年MM月dd日 kk時mm分');
	}

	/**
	 * まとめて顧客情報変換メソッド
	 * @param ResultSet $customers
	 * @return \Cake\ORM\ResultSet
	 */
	private function _convertCustomers(ResultSet $customers) {

		foreach ($customers as $customer) {
			$this->_convertCustomer($customer);
		}
		return $customers;
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

	// 税区分
	private $taxTypes = [
		'1' => '切捨て',
		'2' => '四捨五入',
		'3' => '切上げ'
	];

	// 丸め方法
	private $roundingTypes = [
		'1' => '明細行',
		'2' => '請求書'
	];

	// 締め日
	private $closingDays = [
		'5' => '5日',
		'10' => '10日',
		'15' => '15日',
		'20' => '20日',
		'25' => '25日',
		'31' => '31日',
	];
}