/**
 * suggest.jsを使って検索条件のAjaxサジェスト
 */

$(function(){
	
	var size = $('#customer_name').parent().width() - 1;

	// 名称
	new Suggest.Local(
      "customer_name",	// アクションに送るデータ
      "name_suggest",	// アクションから受け取ったデータを表示する場所
      [],
      {
    	highlight: true,	// 一致する文字列をハイライト
        hookBeforeSearch: function(nameSearchData) {

        	var self = this,
        	suggestArea = $(self.suggestArea);

	        suggestArea.width(size);
	         
	        $self = $(this);
	        $self.width(size); 
	        
	        $.ajax({
	       	  type: 'GET',
	       	  url: '/name/search',
	       	  dataType: 'json',
	       	  data: {nameSearchData},
	       	  
		      success: function (res) {
		    	  self.clearSuggestArea();
	              self.candidateList = res;
	              var resultList = self._search(nameSearchData);
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
     "customer_kana",	// アクションに送るデータ
     "kana_suggest",	// アクションから受け取ったデータを表示する場所
     [],
     {
       highlight: true,	// 一致する文字列をハイライト
       hookBeforeSearch: function(kanaSearchData) {
    	   var self = this,
       	   suggestArea = $(self.suggestArea);

	       suggestArea.width(size);
	         
	       $self = $(this);
	       $self.width(size);
    
	       $.ajax({
    	     type: 'GET',
       	     url: '/kana/search',
       	     dataType: 'json',
       	     data: {kanaSearchData},
       	  
       	     success: function (res) {
       	    	self.clearSuggestArea();
	            self.candidateList = res;
	            var resultList = self._search(kanaSearchData);
	            if (resultList.length != 0){
	                self.createSuggestArea(resultList);
	            }
       	     }	  
       	   });
       }
     }
   );
});

//$(function () {
//	
//  // 候補リストに表示するデータを配列で準備
//  var kana_list = [
//    'こきゃくでーた',
//    'かぶしきがいしゃうぃず',
//    'てすとでーたさん',
//    'てすとでーたよん'
//  ];
//	  
//	
////  // オートコンプリート機能を適用
////  $('#customer_name').autocomplete({
////    source: name_list,
////    autoFocus: true,
////    delay: 300,
////    minLength: 2
////  });
////	  
////  $('#customer_kana').autocomplete({
////    source: kana_list,
////    autoFocus: true,
////    delay: 300,
////    minLength: 3
////  });
//  
//  $('input[name="name"]').keypress(function () {
//	var nameSearchData = $(this).val();
//	
//	$.ajax({
//	  type: 'POST',
//	  url: '/name/search',
//	  dataType: 'json',
//	  data: {nameSearchData},
//	  
//	  success: function (res) {
//		  console.log(res);
//		  var name_list = res;
//		  $('#customer_name').autocomplete({
//			source: name_list,
//			autoFocus: true,
//			minLength: 1
//		  });
//	  }	  
//	});
//  });
//});