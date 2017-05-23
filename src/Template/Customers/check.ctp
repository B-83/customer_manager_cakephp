<main class="col-sm-9 offset-sm-3 col-md-10 offset-md-2 pt-3">

<!-- テーブル -->
    <h5>この内容でよろしいですか？</h5>
    <form id="save" method="post" action="/customer/save" style="display: none;">
    	<?=$this->Form->hidden('id', [$customer['id']]) ?>
    	<?=$this->Form->hidden('name', [$customer['name']]) ?>
    	<?=$this->Form->hidden('kana', [$customer['kana']]) ?>
    	<?=$this->Form->hidden('postal_code', [$customer['postal_code']]) ?>
    	<?=$this->Form->hidden('address1', [$customer['address1']]) ?>
    	<?=$this->Form->hidden('address2', [$customer['address2']]) ?>
    	<?=$this->Form->hidden('tel', [$customer['tel']]) ?>
    	<?=$this->Form->hidden('fax', [$customer['fax']]) ?>
    	<?=$this->Form->hidden('tax_type', [$customer['tax_type']]) ?>
    	<?=$this->Form->hidden('rounding_type', [$customer['rounding_type']]) ?>
    	<?=$this->Form->hidden('closing_day', [$customer['closing_day']]) ?>
    </form>
    	<button form="save" class="btn btn-info btn-right btn-margin-left btn-margin-bottom" id="customer-finish-btn" type="submit">OK</button>
    <form id="fix" method="get" style="display: none;">
    	<?=$this->Form->hidden('id', [$customer['id']]) ?>
    	<?=$this->Form->hidden('name', [$customer['name']]) ?>
    	<?=$this->Form->hidden('kana', [$customer['kana']]) ?>
    	<?=$this->Form->hidden('postal_code', [$customer['postal_code']]) ?>
    	<?=$this->Form->hidden('address1', [$customer['address1']]) ?>
    	<?=$this->Form->hidden('address2', [$customer['address2']]) ?>
    	<?=$this->Form->hidden('tel', [$customer['tel']]) ?>
    	<?=$this->Form->hidden('fax', [$customer['fax']]) ?>
    	<?=$this->Form->hidden('tax_type', [$customer['tax_type']]) ?>
    	<?=$this->Form->hidden('rounding_type', [$customer['rounding_type']]) ?>
    	<?=$this->Form->hidden('closing_day', [$customer['closing_day']]) ?>
    </form>
	    <button th:if="${customer.id} == null" data-action="/customer/new/entry/fix" form="fix" class="back btn btn-secondary btn-right btn-margin-bottom" type="submit">戻る</button>
	    <button th:if="${customer.id} != null" th:data-action="'/customer/' + *{id} + '/edit'" form="fix" class="back btn btn-secondary btn-right btn-margin-bottom" type="submit">戻る</button>
    <div class="table">
      <table class="table table-bordered table-sm table-hover table-list">
      	<tbody>
          <tr>
          	<th>名称</th>
            <td><?=$customer['name'] ?></td>
          </tr>
          <tr>
         	<th>かな</th>
            <td><?=$customer['kana'] ?></td>
          </tr>
          <tr>
          	<th>郵便番号</th>
            <td><?=$customer['postal_code'] ?></td>
          </tr>
          <tr>
          	<th>住所1</th>
            <td><?=$customer['address1'] ?></td>
          </tr>
          <tr>
            <th>住所2</th>
            <td><?=$customer['address2'] ?></td>
          </tr>
          <tr>
            <th>電話番号</th>
            <td><?=$customer['tel'] ?></td>
          </tr>
          <tr>
            <th>FAX番号</th>
            <td><?=$customer['fax'] ?></td>
          </tr>
          <tr>
            <th>税区分</th>
            <td><?php
            switch ($customer['tax_type']) {
            	case 1:
            		echo '切捨て';
            		break;
            	case 2:
            		echo '四捨五入';
            		break;
            	case 3:
            		echo '切り上げ';
            		break;
            }
            ?></td>
          </tr>
          <tr>
            <th>丸め方法</th>
            <td><?php
            switch ($customer['tax_type']) {
            	case 1:
					echo '切捨て';
            		break;
            	case 2:
            		echo '四捨五入';
            		break;
            }
            ?></td>
          </tr>
          <tr>
            <th>締め日</th>
            <td><?=$customer['closing_day'] . '日' ?></td>
          </tr>
        </tbody>
      </table>
    </div>
</main>

<?php
echo $this->Html->script('form_action_change');
?>