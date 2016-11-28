

<div class="gz"><!-- gz Coluna do meio -->
  <ul class="ca qo anx" id="lista">
  	<li class="qf b aml"><h5>Siga mais pessoas, deixamos abaixo algumas sugestões para você.</h5></li>

  </ul>
  <ul class="ca qo anx" >
  	<li class="qf b aml"><button id="bt-load-follow" class="cg ts fx">Carregar mais</button></li>

  </ul>
</div><!-- .gz Coluna do meio -->


<script type="text/javascript">
if( window.location.hostname == 'localhost' )
{
    var URL = 'http://localhost/robot3d/';
}
else
{
    var URL = 'http://www.robo3d.com.br/';
}

$(".qj").on('click',function(){
    alert('oi');
    /*$target = $(this);
      $liUser = '#li-user-' + $(this).attr('id');
      $($target).html('Seguindo...');
      $.post(URL+'follow/followUser/'+$(this).attr('id'), function(data){
          $($target).addClass('active');
          $($target).html(data);
          $($liUser).fadeOut( "slow", function() {
              $(this).remove();
          });
      });*/

});


$(document).ready(function(){

    carrega();
    //$.getScript(URL + 'public/js/whotofollow.js');
    $('#bt-load-follow').click( function(){
        $(this).html('Garregando...');
        pagina += 1;
        carrega();
    });

});

var pagina = 1;

function carrega(){
 
    $.getJSON(URL + 'user/listTest',{page:pagina},function(data){
        $.each(data,function(){

            html = '<li class="qf b aml">\
                    <a class="qj" href="#"><img class="qh cu" src="' + URL + 'public/img/user/'+this['id_user']+'/'+this['path']+'"></a>\
                    <div class="qg "><div class="qn">\
                    <strong>' + this['login'] + '</strong> <br> ' + this['name'] + ' \
                    <div style="float:right"><button class="cg ts fx bseguir" id="'+this['id_user']+'"><span class="h vc"></span> Seguir</button></div>\
                    </div></div></li>';

            $('#lista').append(html);
            $('#bt-load-follow').html('Carregar mais');
        })
    });

}

</script>
