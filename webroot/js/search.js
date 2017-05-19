/**
 * 検索フォームの送信
 */
$(function() {

	// ページネーションのURL設定
	var query = $(location).attr('search');
	var pageElements = $('.pagination').find('a');

	pageElements.each (function () {
		var url = $(this).attr('href');
		$(this).attr('href', url + query);
	});


	// 検索フォームsubmit時
	$('#form-search').submit(function() {
		// submit処理をキャンセル
		event.preventDefault();

		// クエリを取得
		var query = $(this).serialize();

		// クエリの整理
		query = cleanQuery(query);

		if (query == '') {
			// クエリが空の場合、customer/search/page=1に遷移
			location.href = this.action;

		} else {
			// クエリが空でない場合、customer/search/page=1?+クエリに遷移
			location.href = this.action + '?' + query;
		}
	})
})

/**
 * 空のパラメータを検索条件から削除
 * @param query
 * @returns
 */
function cleanQuery(query) {
  var arr = [];
  // 「&」で区切ることができれば繰り返し処理
  $.each(query.split('&'), function(i, param) {
	// 「=」で区切り、配列の[1]番目に文字列が存在すればパラメータを追加する
    if (param.split('=')[1]) { arr.push(param); }
  });
  return arr.join('&');
}