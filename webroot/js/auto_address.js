/**
 * 住所自動入力
 */

$(function () {
	
	$('#auto_address').click( function () {
		
		var postalCode = $('#postal_code').val();
    	
    	if (postal_code != null) {
			$.ajax({
		       	  type: 'GET',
		       	  url: '/getAddress',
		       	  dataType: 'json',
		       	  data: {postalCode},
		       	  
			      success: function (res) {
			    	if (res) {
			    		$('#address1').val(res.state);
			    		$('#address2').val(res.city);
			    		$('#postal-code-error').attr('style', 'display: none;');
			    	}
			      }
			});
    	}
	});
})