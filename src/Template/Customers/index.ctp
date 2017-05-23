<main class="col-sm-9 offset-sm-3 col-md-10 offset-md-2 pt-3">
<!-- 検索欄 -->
  <div id="accordion" role="tablist" aria-multiselectable="true">
	<div class="card">
	  <div class="card-header-sm" role="tab" id="heading">
		<h5 class="mb-0">
		  <a data-toggle="collapse" data-parent="#accordion" href="#collapse" aria-expanded="true" aria-controls="collapse" class="search-area">
			検索条件の設定
		  </a>
		</h5>
	  </div>

	  <div id="collapse" class="collapse show search-list" role="tabpanel" aria-labelledby="heading">
		<div class="card-block-sm">
		<form id="form-search" class="form-scroll" action="/customers" method="get">
		  <div class="form-group-sm row">
			<label for="name" class="col-2 col-form-label">顧客名称</label>
			<div class="col-10">
			  <?=$this->Form->text('name', ['default'=>$conditions['name'], 'id' => 'name', 'class' => 'form-control']) ?>
			  <div id="name_suggest" class="suggest" style="display: none;"></div>
			</div>
		  </div>
		  <div class="form-group-sm row">
			<label for="kana" class="col-2 col-form-label">顧客名称（かな）</label>
			<div class="col-10">
			  <?=$this->Form->text('kana', ['default' => $conditions['kana'], 'id' => 'kana', 'class' => 'form-control']) ?>
			  <div id="kana_suggest" class="suggest" style="display: none;"></div>
			</div>
		  </div>
		  <div class="form-group-sm row">
			<label for="postalCode" class="col-2 col-form-label">郵便番号<small>&emsp;※半角数字</small></label>
			<div class="col-2">
			  <?=$this->Form->text('postal_code', ['default' => $conditions['postal_code'], 'id' => 'postal_code', 'class' => 'form-control']) ?>
			</div>
		  </div>
		  <div class="form-group-sm row">
			<label for="address1" class="col-2 col-form-label">住所1</label>
			<div class="col-2">
			  <?=$this->Form->select('address1', $states, ['empty' => '都道府県選択', 'default' => $conditions['address1'], 'id' => 'address1', 'class' => 'search-select']) ?>
			</div>
			<div class="col-1"></div>
			<label for="address2" class="col-2 col-form-label">住所2</label>
			<div class="col-5">
			  <?=$this->Form->text('address2', ['default' => $conditions['address2'], 'id' => 'address2', 'class' => 'form-control']) ?>
			</div>
		  </div>
		  <div class="form-group-sm row">
			<label for="tel" class="col-2 col-form-label">電話番号<small>&emsp;※半角数字</small></label>
			<div class="col-2">
			  <?=$this->Form->text('tel', ['default' => $conditions['tel'], 'id' => 'tel', 'class' => 'form-control']) ?>
			</div>
			<div class="col-1"></div>
			<label for="fax" class="col-2 col-form-label">FAX番号<small>&emsp;※半角数字</small></label>
			<div class="col-2">
			  <?=$this->Form->text('fax', ['default' => $conditions['fax'], 'id' => 'fax', 'class' => 'form-control']) ?>
			</div>
		  </div>
		</form>
<hr />
		  <button type="submit" id="searchBtn" form="form-search" class="btn btn-primary btn-right btn-margin-left">検　索</button>
		  <input type="button" id="conditionDelete" form="form-search" value="検索条件リセット" class="btn btn-secondary btn-search btn-right" />
		</div>
	  </div>
	</div>
  </div>

<h5>顧客データ</h5>

<button form="entry" type="button" onclick="location.href='/customers/entry'" class="btn btn-success btn-right btn-margin-bottom margin-right">新規登録</button>

<!-- データテーブル -->
	<div class="table-responsive">
	  <table class="table table-striped table-bordered table-sm table-hover">
		<thead>
		  <?=$this->Html->tableHeaders(
			['ID', '名称', 'かな', '郵便番号', '住所', '電話番号',
			'FAX番号', '税区分', '丸め方法', '締め日', '登録日時', '更新日時']
		  ) ?>
		</thead>
		<tbody>
    	  <?php foreach ($customers as $customer): ?>
			<?=$this->Html->tableCells([$customer->id,
			  $this->Html->link($customer->name, '/customers/detail?id='.$customer->id),
			  $customer->kana, $customer->postal_code, $customer->address1.$customer->address2,
			  $customer->tel, $customer->fax, $customer->tax_type, $customer->rounding_type,
			  $customer->closing_day . '日', $customer->created, $customer->updated]); ?>
			<?php endforeach; ?>
    	</tbody>
	  </table>
	</div>

<!-- ページネーション -->
    <div>
	  <ul class="pagination justify-content-center">
		<!-- 最初へ / 前へ -->
		<?=$this->Paginator->first('<<') ?>
		<?=$this->Paginator->prev('<') ?>

		<!-- ページ番号 -->
		<?=$this->Paginator->numbers(); ?>

		<!-- 次へ / 最後へ -->
		<?=$this->Paginator->next('>') ?>
		<?=$this->Paginator->last('>>') ?>
	  </ul>
	</div>
</main>