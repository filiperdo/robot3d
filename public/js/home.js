$(document).ready(function(){
	
	//var URL = 'http://localhost/vitrinekar/';
	//var URL = 'http://www.vitrinekar.com.br/';
	
	$('.link-status-modal').click(function(){
		$('#myModalLabel').html( 'Finalizar O.S. ' + $(this).attr('id') );
		$('#id_os').val( $(this).attr('id') );
	})
	
	
	
});