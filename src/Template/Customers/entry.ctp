<main class="col-sm-9 offset-sm-3 col-md-10 offset-md-2 pt-3">
<!-- テーブル -->
    <h5>新規登録</h5><span class="explain">入力終了後「確認」をクリックしてください。</span>
    <form id="entry" method="post" action="/customers/clear_or_error">
    <?=$this->Form->hidden('id', ['value' => $customer['id']]) ?>
    <button type="submit" form="entry" class="btn btn-info btn-right btn-margin-left btn-margin-bottom">確認</button>
    <button type="button" class="btn btn-secondary btn-right btn-margin-bottom" onclick="location.href='/customers'">戻る</button>
    <div class="table">
      <table class="table table-bordered table-sm table-hover table-list">
      	<tbody>
          <tr>
          	<th>名称</th>
            <td><?=$this->Form->text('name', ['default' => $customer['name'], 'id' => 'name', 'class' => 'width-650']) ?>
            	<span style="color: red; margin-left: 10px;"><?=$this->Form->error('name') ?></span>
            </td>
          </tr>
          <tr>
         	<th>かな</th>
            <td><?=$this->Form->text('kana', ['default' => $customer['kana'], 'id' => 'kana', 'class' => 'width-650']) ?>
            	<span style="color: red; margin-left: 10px;"><?=$this->Form->error('kana') ?></span>
            </td>
          </tr>
          <tr>
          	<th>郵便番号<small>&emsp;※半角数字</small></th>
            <td><?=$this->Form->text('postal_code', ['default' => $customer['postal_code'], 'id' => 'postal_code', 'class' => 'width-100']) ?>
            	<button class="btn auto-insert" id="auto_address" type="button">住所自動入力</button>
            	<span style="color: red; margin-left: 10px;"><?=$this->Form->error('postal_code') ?></span>
            </td>
          </tr>
          <tr>
          	<th>住所1</th>
            <td><?=$this->Form->select('address1', $states, ['empty' => '都道府県選択', 'default' => $customer['address1'], 'id' => 'address1', 'class' => 'table-form-select']) ?></td>
          </tr>
          <tr>
            <th>住所2</th>
            <td><?=$this->Form->text('address2', ['default' => $customer['address2'], 'id' => 'address2', 'class' => 'input-width-max']) ?></td>
          </tr>
          <tr>
            <th>電話番号<small>&emsp;※半角数字</small></th>
            <td><?=$this->Form->text('tel', ['default' => $customer['tel'], 'id' => 'tel', 'class' => 'width-150']) ?>
				<span style="color: red; margin-left: 10px;"><?=$this->Form->error('tel') ?></span>
			</td>
          </tr>
          <tr>
            <th>FAX番号<small>&emsp;※半角数字</small></th>
            <td><?=$this->Form->text('fax', ['default' => $customer['fax'], 'id' => 'fax', 'class' => 'width-150']) ?>
				<span style="color: red; margin-left: 10px;"><?=$this->Form->error('fax') ?></span>
			</td>
          </tr>
          <tr>
            <th>税区分</th>
            <td><?=$this->Form->select('tax_type', $taxTypes, ['default' => $customer['tax_type'], 'id' => 'tax_type', 'class' => 'table-form-select']) ?>
            	<span style="color: red; margin-left: 10px;"><?=$this->Form->error('tax_type') ?></span>
            </td>
          </tr>
          <tr>
            <th>丸め方法</th>
            <td><?=$this->Form->select('rounding_type', $roundingTypes, ['default' => $customer['rounding_type'], 'id' => 'rounding_type', 'class' => 'table-form-select']) ?>
            	<span style="color: red; margin-left: 10px;"><?=$this->Form->error('rounding_type') ?></span>
            </td>
          </tr>
          <tr>
            <th>締め日</th>
            <td><?=$this->Form->select('closing_day', $closingDays, ['default' => $customer['closing_day'], 'id' => 'closing_day', 'class' => 'table-form-select']) ?>
            	<span style="color: red; margin-left: 10px;"><?=$this->Form->error('closing_day') ?></span>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
    </form>
</main>

<?php
	echo $this->Html->script('auto_address');
?>