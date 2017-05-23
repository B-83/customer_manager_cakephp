<main class="col-sm-9 offset-sm-3 col-md-10 offset-md-2 pt-3">

<!-- テーブル -->
    <h5>顧客情報詳細</h5>
    <button type="button" class="btn btn-danger btn-right btn-margin-left btn-margin-bottom" data-toggle="modal" data-target="#customer-delete-check" data-whatever="1">削除</button>
    <button type="button" class="btn btn-success btn-right btn-margin-left" onclick="location.href='/customer/edit'">編集</button>
    <div class="table">
      <table class="table table-bordered table-sm table-hover table-list">
      	<tbody th:object="${customer}">
          <tr>
            <th>ID</th>
            <td th:text="*{customer.id}">ID</td>
          </tr>
          <tr>
          	<th>名称</th>
            <td th:text="*{customer.name}">名称</td>
          </tr>
          <tr>
         		<th>かな</th>
            <td th:text="*{customer.kana}">かな</td>
          </tr>
          <tr>
          	<th>郵便番号</th>
            <td th:text="*{postalCode}">郵便番号</td>
          </tr>
          <tr>
          	<th>住所</th>
            <td th:text="*{address1} + *{address2}">住所1 + 住所2</td>
          </tr>
          <tr>
            <th>電話番号</th>
            <td th:text="*{customer.tel}">電話番号</td>
          </tr>
          <tr>
            <th>FAX番号</th>
            <td th:text="*{customer.fax}">FAX番号</td>
          </tr>
          <tr>
            <th>税区分</th>
            <td th:text="*{taxType}">切捨て</td>
          </tr>
          <tr>
            <th>丸め方法</th>
            <td th:text="*{roundingType}">明細行</td>
          </tr>
          <tr>
            <th>締め日</th>
            <td th:text="*{customer.closingDay} + '日'">締め日</td>
          </tr>
          <tr>
            <th>登録日時</th>
            <td th:text="*{created}">登録日時</td>
          </tr>
          <tr>
            <th>更新日時</th>
            <td th:text="*{updated}">更新日時</td>
          </tr>
        </tbody>
      </table>
    </div>
    <button class="btn btn-secondary btn-margin-bottom" onclick="location.href='/customer/search/page=1'">顧客データ一覧へ</button>
    <button class="btn btn-info btn-right btn-margin-left" onclick="location.href='/slip/search'">伝票一覧へ</button>
    <button class="btn btn-info btn-right" onclick="location.href='/payment/search'">入金一覧へ</button>
    <span class="customer-button-explain">この顧客の</span>
</main>

<!-- 登録・編集完了ダイアログ -->
<div class="modal fade" id="customer-entry-edit-finish" tabindex="-1" role="dialog" aria-labelledby="customerEntryEditFinishLabel" aria-hidden="true">
 	<div class="modal-dialog" role="document">
   	<div class="modal-content">
   		<div class="modal-header">
   			<h5 class="modal-title" id="customerEntryEditFinishLabel">保存完了</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
   		</div>
     	<div class="modal-body modal-body-admin">
     		<span class="modal-middle">保存しました。</span>
     	</div>
     	<div class="modal-footer">
     		<button type="button" class="btn btn-primary" data-dismiss="modal">OK</button>
     	</div>
  	</div>
 	</div>
</div>

<!-- 削除確認ダイアログ -->
<div class="modal fade" id="customer-delete-check" tabindex="-1" role="dialog" aria-labelledby="customerDeleteChecklLabel" aria-hidden="true">
 	<div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="customerDeleteCheckLabel">削除してよろしいですか？</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body modal-body-admin">
        <form class="modal-middle">
          <div class="form-group">
            	<p><span class="customer-span">顧客ID</span> : 1</p>
            	<p><span class="customer-span">名称</span> : 顧客データ</p>
            	<input type="hidden" value="1" />
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">キャンセル</button>
        <button type="button" class="btn btn-primary" data-dismiss="modal" data-toggle="modal" data-target="#customer-delete-finish">OK</button>
      </div>
    </div>
  </div>
</div>

<!-- 削除完了ダイアログ -->
<div class="modal fade" id="customer-delete-finish" tabindex="-1" role="dialog" aria-labelledby="customerDeleteFinishLabel" aria-hidden="true" data-backdrop="static">
 	<div class="modal-dialog" role="document">
   	<div class="modal-content">
   		<div class="modal-header">
   			<h5 class="modal-title" id="customerDeleteFinishLabel">削除完了</h5>
   		</div>
     	<div class="modal-body modal-body-admin">
     		<span class="modal-middle">削除しました。</span>
     	</div>
     	<div class="modal-footer">
     		<button type="button" class="btn btn-primary" onclick="location.href='/'">OK</button>
     	</div>
  	</div>
 	</div>
</div>

<?php
	echo $this->Html->script('saved_catch');
?>