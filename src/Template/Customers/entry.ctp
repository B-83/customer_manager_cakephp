<!-- script取り込み漏れの確認 -->




<main class="col-sm-9 offset-sm-3 col-md-10 offset-md-2 pt-3">
<!-- テーブル -->
    <h5>新規登録</h5><span class="explain">入力終了後「確認」をクリックしてください。</span>
    <form id="entry" method="post" action="/customer/redirect/check">
    <button type="submit" form="entry" class="btn btn-info btn-right btn-margin-left btn-margin-bottom">確認</button>
    <button type="button" class="btn btn-secondary btn-right btn-margin-bottom" onclick="location.href='/customer/search/page=1'">戻る</button>
    <div class="table">
      <table class="table table-bordered table-sm table-hover table-list">
      	<tbody>
          <tr>
          	<th>名称</th>
            <td><?=$this->Form->text('name', ['default' => $customer['name'], 'id' => 'name', 'class' => 'width-650']) ?>
            	<span th:if="${#fields.hasErrors('name')}" th:errors="*{name}" style="color: red; margin-left: 10px;">必須項目です。</span>
            </td>
          </tr>
          <tr>
         	<th>かな</th>
            <td><?=$this->Form->text('kana', ['default' => $customer['kana'], 'id' => 'kana', 'class' => 'width-650']) ?>
            	<span th:if="${#fields.hasErrors('kana')}" th:errors="*{kana}" style="color: red; margin-left: 10px;">必須項目です。</span>
            </td>
          </tr>
          <tr>
          	<th>郵便番号<small>&emsp;※半角数字</small></th>
            <td><?=$this->Form->text('postal_code', ['default' => $customer['postal_code'], 'id' => 'postal_code', 'class' => 'width-100']) ?>
            	<button class="btn auto-insert" id="auto_address" type="button">住所自動入力</button>
            	<span th:if="${postalError}" id="postal-code-error" style="color: red; margin-left: 10px;">正しい郵便番号を入力してください。</span>
            </td>
          </tr>
          <tr>
          	<th>住所1</th>
            <td><?=$this->Form->select('address1', $states, ['empty' => '都道府県選択', 'default' => $customer['address1'], 'id' => 'address1', 'class' => 'table-form-select']) ?></td>
          </tr>
          <tr>
            <th>住所2</th>
            <td><?=$this->Form->text('address2', ['default' => $customer['address2'], 'id' => 'address2', 'class' => \7]) ?>
            <input name="address2" th:value="*{address2}" maxlength="100" id="address2" class="input-width-max" form="entry" type="text" /></td>
          </tr>
          <tr>
            <th>電話番号<small>&emsp;※半角数字</small></th>
            <td><input name="tel" th:value="*{tel}" maxlength="14" id="tel" class="width-150" form="entry" type="text" />
				<span th:if="${#fields.hasErrors('tel')}" th:errors="*{tel}" style="color: red; margin-left: 10px;">正しい電話番号を入力してください。</span>
				</td>
          </tr>
          <tr>
            <th>FAX番号<small>&emsp;※半角数字</small></th>
            <td><input name="fax" th:value="*{fax}" maxlength="14" id="fax" class="width-150" form="entry" type="text" />
				<span th:if="${#fields.hasErrors('fax')}" th:errors="*{fax}" style="color: red; margin-left: 10px;">正しいFAX番号を入力してください。</span>
				</td>
          </tr>
          <tr>
            <th>税区分</th>
            <td><select name="taxType" id="tax_type" class="table-form-select" form="entry">
		    	<option th:value="1" th:selected="*{taxType} == 1">切捨て</option>
		    	<option th:value="2" th:selected="*{taxType} == 2">四捨五入</option>
		    	<option th:value="3" th:selected="*{taxType} == 3">切り上げ</option>
				</select></td>
          </tr>
          <tr>
            <th>丸め方法</th>
            <td><select name="roundingType" id="rounding_type" class="table-form-select" form="entry">
		    	<option value="1" th:selected="*{roundingType} == 1">明細行</option>
		    	<option value="2" th:selected="*{roundingType} == 2">請求書</option>
				</select></td>
          </tr>
          <tr>
            <th>締め日</th>
            <td><select name="closingDay" id="closing_day" class="table-form-select" form="entry">
		    	<option th:value="5" th:selected="*{closingDay} == 5">5日</option>
		    	<option th:value="10" th:selected="*{closingDay} == 10">10日</option>
		    	<option th:value="15" th:selected="*{closingDay} == 15">15日</option>
		    	<option th:value="20" th:selected="*{closingDay} == 20">20日</option>
		    	<option th:value="25" th:selected="*{closingDay} == 25">25日</option>
		    	<option th:value="31" th:selected="*{closingDay} == 31">31日</option>
				</select></td>
          </tr>
        </tbody>
      </table>
    </div>
    </form>
</main>