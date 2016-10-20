$(document).ready(function(){
	
	if( window.location.hostname == 'localhost' )
	{
		var URL = 'http://localhost/vitrinekar/';
	}
	else
	{
		var URL = 'http://www.vitrinekar.com.br/';
	}
	
	$('#cep-search').click(function(){
		
		$.post( URL + 'util/cep.php', { cep: $('#cep').val() }, function(data){
			var retorno = JSON.parse( data );
			$('#adress').val( retorno.tipo_logradouro + ' ' + retorno.logradouro + ', ' + retorno.bairro + ', ' + retorno.cidade + ' - ' + retorno.uf );
		});
		
	});
	
	// Configurações iniciais
	$('.btn-clear-search').css('display','none');
	$('.btn-add-user').css('display','none');
	
	$('#cpf-search').click(function(){
		
		$.getJSON( URL + 'user/searchUser/'+$('#cpf').val(), function(data){
			
			if( data.name != 'undefined' )
			{
				$('.form-control').attr('disabled','disabled');
				$('#salvar').addClass('disabled');
				
				$('.btn-clear-search').css('display','');
				$('.btn-add-user').css('display','');
				$('#salvar').css('display','none');
				
				$('#name').val( data.name );
				$('#email').val( data.email );
				$('#fone1').val( data.fone1 );
				$('#fone2').val( data.fone2 );
				$('#cep').val( data.cep );
				$('#adress').val( data.adress );
				
				$('#form-user').attr('action', URL + 'user/addCustomerInWorkshop/' + data.id_user );
			}
			
		});
		
	});
	
	$('#clear-search').click(function(){
		
		$('.form-control').removeAttr('disabled','disabled');
		$('.form-control').val('');
		$('#salvar').removeClass('disabled');
		$('.btn-clear-search').css('display','none');
		$('.btn-add-user').css('display','none');
		$('#salvar').css('display','');
		
		$('#form-user').attr('action', URL + 'user/create' );
	});
	
});