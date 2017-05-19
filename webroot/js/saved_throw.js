/**
 * 顧客の登録・編集→確認後、詳細画面に遷移してダイアログ表示
 */

/* クエリを渡す */
$(function(){
	
	$('#customer-finish-btn').click(function() {	
		
		location.href = '/customer/detail.html?saved=true';
	})
});