$(document).ready(function(){
	
	var URL = 'http://localhost/robot3d/';
	
	$('.notify').css('cursor','pointer');
	
	$( ".bt-notify" ).load( URL + "notify/loadNotify", { "id_topic": $('#id_topic').val() } );

	$('.notify').live('click', function(){
		
		$('.ico-notify').html('');
		$('#ico-' + $(this).attr('id') ).html('<i class="glyphicon glyphicon-ok"></i>');
		$('.bt-notify').html( '<i class="glyphicon glyphicon-tag"></i> ' + $(this).attr('title') );
		
		$.post( URL + "notify/create", { id_topic: $('#id_topic').val(), type: $(this).attr('id') }).done(function( data ) {
			//alert( "Data Loaded: " + data );
			$('.popover').fadeOut();
		});
		
	});
	
	$('.bt-notify').popover({ html: true, trigger: 'click', placement: 'bottom', title: 'Notificações para este tópico!', content: $('#p-notify').html() }); //
	
});