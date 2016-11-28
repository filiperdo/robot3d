<div class="gz"><!-- gz Coluna do meio -->
  <ul class="ca qo anx" id="indexTest">

  </ul>
 <div class="loader-index"><img alt="Carregando..." src="<?php echo URL?>public/img/loader.gif" > Carregando...</div>
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

var pagina = 1;
$('#bt-load-index').click(function(){
	pagina += 1;
	loadIndex(pagina);
});

function loadIndex(pg)
{
    $.ajax({
        url:URL + 'index/indexTest/' + pg,
        dataType:"html",
        type:'POST',
        beforeSend: function(){
            $('.loader-index').fadeIn();
        },
        success:function(result){
            $("#indexTest").append(result);
            $('.loader-index').fadeOut();
        },
    });
}

$(window).scroll(function(){
    if ($(window).scrollTop() + $(window).height() >= $(document).height()) {
        pagina += 1;
    	loadIndex(pagina);
    }
});

$(document).ready(function(){
    loadIndex(pagina);

    // Ajusta as imagens do conteudo dos posts
    $('div.post-content img').attr('data-action', 'zoom');
    $('div.post-content img').removeAttr('height');
    $('div.post-content img').removeAttr('width');
    $('div.post-content img').css('max-width', '100%');

});
</script>
