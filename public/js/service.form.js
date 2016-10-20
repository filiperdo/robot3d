$(document).ready(function(){
	

	if( window.location.hostname == 'localhost' )
	{
		var URL = 'http://localhost/vitrinekar/';
	}
	else
	{
		var URL = 'http://www.vitrinekar.com.br/';
	}

	
	$('.bt-edit-item').click(function(){
		
		$.getJSON( URL + 'item/obterItem/'+$(this).attr('id'), function(data){
			
			if( data.id_item != 'undefined' )
			{
				$('#note-item').val( data.note );
				$('#price').val( data.price );
				$('#amount').val( data.amount );
				$('#form-item').attr('action', URL + 'item/edit/' + data.id_item );

	            $('#typeitem option[value="' + data.typeitem + '"]').attr({ selected : "selected" });
				
			}
		});
	});
	
	// Limpa os campos do formulario
	$('#bt-add-service').click(function(){
		$('#form-item').attr('action', URL + 'item/create');
		$('#note-item').val( '' );
		$('#price').val( '' );
		$('#amount').val( '' );
	})
	
	
	
});