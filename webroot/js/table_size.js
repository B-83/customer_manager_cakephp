/**
 * テーブルサイズの変更
 */

/* テーブルのサイズをウィンドウサイズに合わせて変更 */
$(window).on('load resize', function(){
	
	// 検索エリアあり
	if ($(".table-responsive").length) {
		$(".table-responsive").height(window.innerHeight - 475);
	}
		
	// 検索エリアなし
	if ($(".table-cover").length) {
		$(".table-cover").height(window.innerHeight - 163);
	}
});


/* テーブルのサイズを検索エリアに合わせて変更 */

$(function() {
	var tableSth = false;
	
	$('.search-area').click( function() {
		
		if (tableSth) {
			/* 検索エリアが開いているとき */
			$(".table-responsive").height(window.innerHeight - 475);
			tableSth = false;
		} else {
			/* 検索エリアが閉じているとき */
			$(".table-responsive").height(window.innerHeight - 220);
			tableSth = true;
		}
	} );
})
