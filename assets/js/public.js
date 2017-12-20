$ = new jQuery.noConflict();

$( document ).ready(function() {
	$( '#ajax_form' ).submit( function( event ){
		event.preventDefault()
		// var ajax_form = $(this).serialize();
		var name 	= $( '#name' ).val()
		var email 	= $( '#email' ).val()
		var phone 	= $( '#phone' ).val()
		var address = $( '#address' ).val()

		//ajax
		$.ajax({
			type: 'POST',
			url: ajaxurl,
			data: {
				action: 'im_ajax_form',
				name: name,
				email: email,
				phone: phone,
				address: address,
			},
			success: function( data ){
				alert( 'Success' )
			},
			error: function(){
				alert('error')
			}
		})
	} )
} )