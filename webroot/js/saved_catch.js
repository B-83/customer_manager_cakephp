/**
 * 顧客の登録・編集→確認後、詳細画面に遷移してダイアログ表示
 */

/* クエリを取得してダイアログの表示 */
$(function(){
	
	if (location.search != '') {
		
		var customerSth = location.search.match(/saved=(.*?)(&|$)/)[1];
		if  (customerSth) {
			$('#customer-entry-edit-finish').modal();
		}
	}
	
});


