if( window.location.hostname == 'localhost' )
{
	var URL = 'http://localhost/robot3d/';
}
else
{
	var URL = 'http://www.robo3d.com.br/';
}

var pagina = 1;
	
function carrega(){
	
	$.getJSON(URL + 'user/listTest',{page:pagina},function(data){
		$.each(data,function(){
			
			html = '<li class="qf b aml">\
					<a class="qj" href="#"><img class="qh cu" src="' + URL + 'public/img/user/1/'+this['path']+'"></a>\
					<div class="qg"><div class="qn">\
					<strong>' + this['login'] + '</strong> <br> ' + this['name'] + ' \
					</div></div></li>';
			
			$('#lista').append(html);
			$('#bt-load-follow').html('Carregar mais');
		})
	})
}

$('#bt-load-follow').live('click', function(){
	$(this).html('Garregando...');
	pagina += 1;
	carrega();
})

$(document).ready(function(){
	
	carrega();
	
});

   
