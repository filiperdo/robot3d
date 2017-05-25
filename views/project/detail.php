


<div class="hh">

	<ol class="breadcrumb bread-border">
	  <li><a href="<?php echo URL?>">Home</a></li>
	  <li><a href="<?php echo URL?>project">Projetos</a></li>
	  <li><?=$this->obj->getTitle()?></li>
	</ol>

	<div class="qv rc aog alu">
		<div class="qx" style="background: url(<?php echo URL .'public/img/project/'.$this->obj->getPath().'/'.$this->obj->getMainpicture() ; ?>) center center; background-size:100%; height: 350px;"></div>
	</div>

	<ul class="ca qo anx">
		<li class="qf b aml">
	        <div class="qw project-content">
	        	<h5 class="qy"><?=$this->obj->getTitle()?></h5>
				<p class="alu"><?=$this->obj->getContent()?></p>
			</div>
		</li>

		<li class="qf b aml">
			<div class="any" data-grid="images">
            <?php foreach( glob('public/img/project/'. $this->obj->getId_project() .'/*.jpg') as $imagem ){ ?>
            <?php list($width, $height, $type, $attr) = getimagesize( $imagem ); ?>
              <div style="display: none">
                <img data-action="zoom" data-width="<?php echo $width; ?>" data-height="<?php echo $height; ?>" src="<?php echo URL . $imagem; ?>">
              </div>
			<?php } ?>

            </div>
		</li>
	</ul>

</div>

	<div class="gr"><!-- gn Coluna direita -->

		<div class="qv rc alu">
	        <div class="qw">

	        <h4 class="page-header"><?php echo $this->obj->getTitle();?></h4>

	        <ul class="qo anx">
	          <li class="qf alm">
	            <a class="qj" href="#">
	              <img class="qh cu" src="<?php echo Data::getPhotoUser( $this->obj->getUser()->getId_user() ) ?>">
	            </a>
	            <div class="qg">
	              <a href="<?php echo URL . 'user/dashboard/' . $this->obj->getUser()->getLogin(); ?>">
	              	<strong><?php echo $this->obj->getUser()->getName();?> </strong> @<?php echo $this->obj->getUser()->getLogin();?>
	              </a>
	              <p><small><?php echo $this->obj->getTotalProjectByUser( $this->obj->getUser()->getId_user() );?> Projetos | <?php echo $this->follow->countFollowers($this->obj->getUser()->getId_user()); ?> Seguidores</small></p>
	              <div class="aoa">
	                <button class="cg ts fx"><span class="h vc"></span> Seguir</button>
	              </div>
	            </div>
	          </li>
	        </ul>

	        </div>
	        <div class="qz">
	          Publicado em <?php echo Data::formatDateShort( $this->obj->getDate() );?>
	        </div>
	      </div>

		<div class="qv rc aok">
	        <div class="qw">
	          <h4 class="page-header">Membros do projeto</h4>
	          <?php for( $i=0; $i<5; $i++ ){?>
	          <ul class="ano" style="display: inline-block;">
	          	<li class="anp" style="margin: 0 4px">
		          <a class="ttp" data-toggle="tooltip" data-placement="top" title="Name User">
		              <img class="cu" src="<?php echo URL; ?>public/img/avatar-fat.jpg">
		          </a>
	          	</li>
	          </ul>
	          <?php } ?>
	        </div>
	      </div>

		  <div class="row" style="margin-bottom: 20px; margin-top: 20px;">
	      	<div class="col-md-12">
				<a href="#" class="fb-xfbml-parse-ignore cg ts fx" title="Compartilhar via Facebook" alt="Compartilhar via Facebook" onclick='open_social_popup(600,300,"facebook","https://www.facebook.com/sharer/sharer.php?u=http%3A%2F%2Fwww.robo3d.com.br/project/detail/<?php echo $this->obj->getId_project();?>%2F&amp;src=sdkpreparse%3Futm_source%3Dfacebook%26utm_medium%3Dsocial%26utm_campaign")' >
					<i class="h aau" style="font-size: 22px"></i>
				</a>
				<a href="#" class="cg ts fx " title="Compartilhar via Twitter" alt="Compartilhar via Twitter" onclick='open_social_popup(700,300,"twitter","https://twitter.com/intent/tweet?url=http://www.robo3d.com.br/project/detail/<?php echo $this->obj->getId_project();?>%3Futm_source%3Dtwitter%26utm_medium%3Dsocial%26utm_campaign")'>
					<i class="h ajo" style="font-size: 22px"></i>
				</a>
	      		<a href="#" title="Compartilhar via LinkedIn" alt="Compartilhar via LinkedIn" onclick='open_social_popup(490,300,"linkedin","https://www.linkedin.com/shareArticle?url=http://www.robo3d.com.br/project/detail/<?php echo $this->obj->getId_project();?>")' class="cg ts fx">
					<i class="h adr" style="font-size: 22px"></i>
				</a>
	      		<a href="#" class="cg ts fx" title="Compartilhar via Google+" alt="Compartilhar via Google+" onclick='open_social_popup(490,300,"googleplus","http://plus.google.com/share?url=http://www.robo3d.com.br/project/detail/<?php echo $this->obj->getId_project();?>")'>
					<i class="h abx" style="font-size: 22px"></i>
				</a>
	      	</div>
	      </div>



	      <div class="qv rc aok">
	        <div class="qw">
	          <h4 class="page-header">Componentes</h4>
	          <?php foreach( $this->objComponent->listComponentByProject( $this->obj->getId_project() ) as $component ){?>

		          <small><span class="glyphicon glyphicon-cog"></span></small> <?php echo $component->getAmount() .' '. $component->getName();?>
				  <?php if( $component->getLink() != '' ){ ?>
					  ( <a href="http://<?php echo $component->getLink(); ?>" target="_blank"><span class="glyphicon glyphicon-shopping-cart"></span> </a> )
				  <?php } ?>
				  <br>
	          <?php } ?>

	        </div>
	      </div>


	      <!--<div class="row" style="margin-bottom: 20px;">
	      	<div class="col-md-12">

	      		<div class="row">
		      		<div class="col-md-12">
						<div class="x_content">

						  <h4>Sua avaliação <small>Passe o mouse sobre as estrelas</small></h4>
						  <div>
							<div id="stars" class="starrr lead"></div>
							Atribua uma nota de 0 a 5 estrelas
						  </div>

						</div>
		      		</div>
	      		</div>


	      	</div>
		</div>-->

    </div><!-- .gn Coluna direita -->

<script>
$(document).ready(function(){
	// Ajusta as imagens do conteudo dos posts
    $('div.project-content img').attr('data-action', 'zoom');
    $('div.project-content img').removeAttr('height');
    //$('div.project-content img').removeAttr('width');
    $('div.project-content img').css('max-width', '80%');
	$('div.project-content img').css('padding-top', '20px');
	$('div.project-content img').css('padding-bottom', '20px');



	$(function () {
	  $('.ttp').tooltip();

	  //$('.ppv').popover();

	  $('.btshare').popover({ html: true, trigger: 'focus', placement: 'top', content: $('#pshare').html() });

	});
});

</script>

<script>

	function open_social_popup(width,height,social_name,social_url)
    {
        var left,top;
        left=window.screen.width/2-(width/2+10);
        top=window.screen.height/2-(height/2+50);
        parameters="status=no,height="+height+",width="+width+",resizable=yes,left="+left+",top="+top+",screenX="+left+",screenY="+top+",toolbar=no,menubar=no,scrollbars=no,location=no,directories=no";
        t=document.title;
        window.open(social_url,"sharer",parameters);
        return false
    }

</script>


<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/pt_BR/sdk.js#xfbml=1&version=v2.8";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
