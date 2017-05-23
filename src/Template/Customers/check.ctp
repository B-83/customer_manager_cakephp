<main class="col-sm-9 offset-sm-3 col-md-10 offset-md-2 pt-3">

<!-- テーブル -->
    <h5>この内容でよろしいですか？</h5>
    <form id="save" method="post" action="/customer/save" th:object="${customer}" style="display: none;">
    	<input name="name" th:value="*{name}" type="hidden" />
    	<input name="kana" th:value="*{kana}" type="hidden" />
    	<input name="postalCode" th:value="*{postalCode}" type="hidden" />
    	<input name="address1" th:value="*{address1}" type="hidden" />
    	<input name="address2" th:value="*{address2}" type="hidden" />
    	<input name="tel" th:value="*{tel}" type="hidden" />
    	<input name="fax" th:value="*{fax}" type="hidden" />
    	<input name="taxType" th:value="*{taxType}" type="hidden" />
    	<input name="roundingType" th:value="*{roundingType}" type="hidden" />
    	<input name="closingDay" th:value="*{closingDay}" type="hidden" />
    </form>
    	<button form="save" class="btn btn-info btn-right btn-margin-left btn-margin-bottom" id="customer-finish-btn" type="submit">OK</button>
    <form id="fix" method="get" th:object="${customer}" style="display: none;">
    	<input name="name" th:value="*{name}" type="hidden" />
    	<input name="kana" th:value="*{kana}" type="hidden" />
    	<input name="postalCode" th:value="*{postalCode}" type="hidden" />
    	<input name="address1" th:value="*{address1}" type="hidden" />
    	<input name="address2" th:value="*{address2}" type="hidden" />
    	<input name="tel" th:value="*{tel}" type="hidden" />
    	<input name="fax" th:value="*{fax}" type="hidden" />
    	<input name="taxType" th:value="*{taxType}" type="hidden" />
    	<input name="roundingType" th:value="*{roundingType}" type="hidden" />
    	<input name="closingDay" th:value="*{closingDay}" type="hidden" />
    </form>
	    <button th:if="${customer.id} == null" data-action="/customer/new/entry/fix" form="fix" class="back btn btn-secondary btn-right btn-margin-bottom" type="submit">戻る</button>
	    <button th:if="${customer.id} != null" th:data-action="'/customer/' + *{id} + '/edit'" form="fix" class="back btn btn-secondary btn-right btn-margin-bottom" type="submit">戻る</button>
    <div class="table">
      <table class="table table-bordered table-sm table-hover table-list">
      	<tbody th:object="${customer}">
          <tr>
          	<th>名称</th>
            <td th:text="*{name}">名称</td>
          </tr>
          <tr>
         		<th>かな</th>
            <td th:text="*{kana}">かな</td>
          </tr>
          <tr>
          	<th>郵便番号</th>
            <td th:text="*{postalCode}">郵便番号</td>
          </tr>
          <tr>
          	<th>住所1</th>
            <td th:text="*{address1}">住所1</td>
          </tr>
          <tr>
            <th>住所2</th>
            <td th:text="*{address2}">住所2</td>
          </tr>
          <tr>
            <th>電話番号</th>
            <td th:text="*{tel}">電話番号</td>
          </tr>
          <tr>
            <th>FAX番号</th>
            <td th:text="*{fax}">FAX番号</td>
          </tr>
          <tr>
            <th>税区分</th>
            <th:block th:switch="*{taxType}">
		          <td th:case="1">切捨て</td>
		          <td th:case="2">四捨五入</td>
		          <td th:case="3">切上げ</td>
            </th:block>
          </tr>
          <tr>
            <th>丸め方法</th>
            <th:block th:switch="*{roundingType}">
	            <td th:case="1">明細行</td>
	            <td th:case="2">請求書</td>
            </th:block>
          </tr>
          <tr>
            <th>締め日</th>
            <td th:text="*{closingDay} + '日'">締め日</td>
          </tr>
        </tbody>
      </table>
    </div>
</main>

<?php
echo $this->Html->script('form_action_change');
?>