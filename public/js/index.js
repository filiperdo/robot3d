$(document).ready(function(){

	if( window.location.hostname == 'localhost' )
	{
		var URL = 'http://localhost/robot3d/';
	}
	else
	{
		var URL = 'http://www.robo3d.com.br/';
	}

	// Ajusta as imagens do conteudo dos posts
	$('div.post-content img').attr('data-action', 'zoom');
	$('div.post-content img').removeAttr('height');
	$('div.post-content img').removeAttr('width');
	$('div.post-content img').css('max-width', '100%');

	$('#indexTest').on('click', '.bt-sub-form', function(){
		
		var id = $(this).attr('id');

		$( "#result-"+id ).css('display','');

		$.post( URL + "comment/create", { content: $('#content-'+id).val(), comment_type: $('#comment_type-'+id).val(), id_item: id }, function( data ) {

			$( data ).insertAfter( "#result-"+id );
			$('#content-'+id).val('');
			$( "#result-"+id ).css('display','none');

		});

	});

});
