/**
 * suggest.jsを使って検索条件のAjaxサジェスト
 */

$(function(){

	var size = $('#name').parent().width() - 1;

	// 名称
	new Suggest.Local(
      "name",	// アクションに送るデータ
      "name_suggest",	// アクションから受け取ったデータを表示する場所
      [],
      {
    	highlight: true,	// 一致する文字列をハイライト
        hookBeforeSearch: function(name) {

        	var self = this,
        	suggestArea = $(self.suggestArea);

	        suggestArea.width(size);

	        $self = $(this);
	        $self.width(size);

	        $.ajax({
	       	  type: 'GET',
	       	  url: '/customers/suggestName',
	       	  dataType: 'json',
	       	  data: {name},

		      success: function (res) {
		    	  var nameList = [];
		    	  for (var i = 0; i < res.length; i++) {
		    		  nameList.push(res[i].name);
		    	  }
		    	  self.clearSuggestArea();
	              self.candidateList = nameList;
	              var resultList = self._search(name);
	              if (resultList.length != 0){
	                  self.createSuggestArea(resultList);
	              }
		      }
	        });
        }
      }
   );

   // かな
	new Suggest.Local(
      "kana",	// アクションに送るデータ
      "kana_suggest",	// アクションから受け取ったデータを表示する場所
      [],
      {
    	highlight: true,	// 一致する文字列をハイライト
        hookBeforeSearch: function(kana) {

        	var self = this,
        	suggestArea = $(self.suggestArea);

	        suggestArea.width(size);

	        $self = $(this);
	        $self.width(size);

	        $.ajax({
	       	  type: 'GET',
	       	  url: '/customers/suggestkana',
	       	  dataType: 'json',
	       	  data: {kana},

		      success: function (res) {
		    	  var kanaList = [];
		    	  for (var i = 0; i < res.length; i++) {
		    		  kanaList.push(res[i].kana);
		    	  }
		    	  self.clearSuggestArea();
	              self.candidateList = kanaList;
	              var resultList = self._search(kana);
	              if (resultList.length != 0){
	                  self.createSuggestArea(resultList);
	              }
		      }
	        });
        }
      }
   );
});