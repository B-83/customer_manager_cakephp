<!-- script取り込み漏れの確認 -->




<main class="col-sm-9 offset-sm-3 col-md-10 offset-md-2 pt-3">

<!-- テーブル -->
    <h5>編集</h5><span class="explain">入力終了後、「確認」をクリックしてください。</span>
    <form id="edit" method="post" th:object="${customer}" action="/customer/redirect/check">
    <button type="submit" form="edit" class="btn btn-info btn-right btn-margin-left btn-margin-bottom">確認</button>
    <button type="button" class="btn btn-secondary btn-right btn-margin-bottom" th:onclick="location.href='/customer/' + *{id} + '/detail'">戻る</button>
    <div class="table">
      <table class="table table-bordered table-sm table-hover table-list">
      	<tbody>
          <tr>
          	<th>名称</th>
            <td><input name="name" th:value="*{name}" id="name" class="width-650" maxlength="40" form="edit" type="text" />
            <span th:if="${#fields.hasErrors('name')}" th:errors="*{name}" style="color: red; margin-left: 10px;">必須項目です。</span>
            </td>
          </tr>
          <tr>
         		<th>かな</th>
            <td><input name="kana" th:value="*{kana}" id="kana" class="width-650" form="edit" type="text" />
            <span th:if="${#fields.hasErrors('kana')}" th:errors="*{kana}" style="color: red; margin-left: 10px;">必須項目です。</span>
            </td>
          </tr>
          <tr>
          	<th>郵便番号<small>&emsp;※半角数字</small></th>
            <td><input name="postalCode" th:value="*{postalCode}" maxlength="7" id="postal_code" class="width-100" form="edit" type="text" />
            <button class="btn auto-insert" id="auto_address">住所自動入力</button>
            <span th:if="${postalError}" id="postal-code-error" style="color: red; margin-left: 10px;">正しい郵便番号を入力してください。</span>
            </td>
          </tr>
          <tr>
          	<th>住所1</th>
            <td><select name="address1" id="address1" class="table-form-select" form="edit">
				    	<option value="">都道府県選択</option>
				    	<option th:each="area: ${area_list}" th:text="${area}" th:value="${area}" th:selected="${area} == *{address1}"></option>
						</select></td>
          </tr>
          <tr>
            <th>住所2</th>
            <td><input name="address2" th:value="*{address2}" maxlength="100" id="address2" class="input-width-max" form="edit" type="text" /></td>
          </tr>
          <tr>
            <th>電話番号<small>&emsp;※半角数字</small></th>
            <td><input name="tel" th:value="*{tel}" maxlength="14" id="tel" class="width-150" form="edit" type="text" />
						<span th:if="${#fields.hasErrors('tel')}" th:errors="*{tel}" style="color: red; margin-left: 10px;">正しい電話番号を入力してください。</span>
						</td>
          </tr>
          <tr>
            <th>FAX番号<small>&emsp;※半角数字</small></th>
            <td><input name="fax" th:value="*{fax}" maxlength="14" id="fax" class="width-150" form="edit" type="text" />
						<span th:if="${#fields.hasErrors('fax')}" th:errors="*{fax}" style="color: red; margin-left: 10px;">正しいFAX番号を入力してください。</span>
						</td>
          </tr>
          <tr>
            <th>税区分</th>
            <td><select name="taxType" id="tax_type" class="table-form-select" form="edit">
				    	<option th:value="1" th:selected="*{taxType} == 1">切捨て</option>
				    	<option th:value="2" th:selected="*{taxType} == 2">四捨五入</option>
				    	<option th:value="3" th:selected="*{taxType} == 3">切り上げ</option>
						</select></td>
          </tr>
          <tr>
            <th>丸め方法</th>
            <td><select name="roundingType" id="rounding_type" class="table-form-select" form="edit">
				    	<option value="1" th:selected="*{roundingType} == 1">明細行</option>
				    	<option value="2" th:selected="*{roundingType} == 2">請求書</option>
						</select></td>
          </tr>
          <tr>
            <th>締め日</th>
            <td><select name="closingDay" id="closing_day" class="table-form-select" form="edit">
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