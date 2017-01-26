

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

$(document).ready(function(){

    carrega();

    $('#bt-load-follow').on('click', function(){
        $(this).html('Garregando...');
        pagina += 1;
        carrega();
    });

    $('#lista').on('click', ".bseguir", function(){
        $target = $(this);
        $liUser = '#li-user-' + $(this).attr('id');
        $($target).html('Seguindo...');
        $.post(URL+'follow/followUser/'+$(this).attr('id'), function(data){
            $($target).addClass('active');
            $($target).html(data);
            $($liUser).fadeOut( "slow", function() {
                $(this).remove();
            });
        });
    });
});

var pagina = 1;

function carrega(){
 
    $.getJSON(URL + 'user/listTest',{page:pagina},function(data){

        $.each(data,function(){

            if( this['path'] != '' )
                var $path = URL + this['path']+'foto-perfil.jpg';
            else
                var $path = URL + 'public/img/user/avatar-fat.jpg';

            html = '<li class="qf b aml" id="li-user-'+this['id_user']+'">\
                    <a class="qj" href="#"><img class="qh cu" src="' + $path + '"></a>\
                    <div class="qg "><div class="qn"><strong>\
                    <a href="'+URL+'user/dashboard/'+this['login']+'">' + this['login'] + '</a>\
                    </strong> <br> ' + this['name'] + '<div style="float:right">\
                    <?php if( Session::get( 'loggedIn' ) ){?>\
                    <button class="cg ts fx bseguir" id="'+this['id_user']+'"><span class="h vc"></span> Seguir</button>\
                    <?php } else { ?>\
                    <button class="cg ts fx disabled" ><span class="h vc"></span> Seguir</button>\
                    <?php } ?>\
                    </div></div></div></li>';

            $('#lista').append(html);
            $('#bt-load-follow').html('Carregar mais');
        })
    });

}

</script>
