<div class="hh">

	<ol class="breadcrumb bread-border">
	  <li><a href="<?php echo URL?>">Home</a></li>
	  <li><a href="<?php echo URL?>project">Projetos</a></li>
	  <li><?=$this->obj->getTitle()?></li>
	</ol>

	<div class="qv rc aog alu">
		<div class="qx" style="background: url(<?php echo URL . $this->obj->getMainpicture() ; ?>) center center; background-size:100%; height: 350px;"></div>
	</div>

	<ul class="ca qo anx">
		<li class="qf b aml">
	        <div class="qw dj">
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
	              <a href="<?php echo URL . 'user/dashboard/' . base64_encode( $this->obj->getUser()->getId_user() ); ?>">
	              	<strong><?php echo $this->obj->getUser()->getName();?> </strong> @<?php echo $this->obj->getUser()->getLogin();?>
	              </a>
	              <p><small><a href="#"><?php echo $this->obj->getTotalProjectByUser( $this->obj->getUser()->getId_user() );?> Projetos</a> | <a href="#">34 Seguidores</a></small></p>
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
	      
	      <div class="row" style="margin-bottom: 20px;">
	      	<div class="col-md-12">
	      		<!--<a class="cg ts fx ppv" tabindex="0" role="button" data-toggle="popover2" data-placement="top" data-trigger="focus" title="Titulo" data-content=" 1 - 2 - 3 - 4 - 5 ">
	      			<i class="h aiw"></i> Gostei
	      		</a>-->
	      		<a href="#" class="cg ts fx btshare"><i class="h ahf "></i> Compartilhar</a>&ensp;
	      		<a href="#" class="cg ts fx"><i class="h aja"></i> Eu fiz um</a>
	      	</div>
	      </div>
	      
	      <div class="qv rc aok">
	        <div class="qw">
	          <h4 class="page-header">Componentes</h4>
	          <?php foreach( $this->objComponent->listComponentByProject( $this->obj->getId_project() ) as $component ){?>
	          <ul>
	          	<li>
		          <a href="#">
		              <?php echo $component->getName();?>
		          </a>
	          </li>
	          </ul>
	          <?php } ?>
	          
	        </div>
	      </div>


	      <div class="row" style="margin-bottom: 20px;">
	      	<div class="col-md-12">
	      		
	      		<div class="row">
	      			<div class="col-md-12">
	      				<strong>Sua avaliação</strong>
	      			</div>
		      		<div class="col-md-12">
			      		<div class="star-box first">
				      		<a href="#">
				      			<i class="glyphicon glyphicon-star-empty"></i>
				      		</a>
			      		</div>

			      		<div class="star-box meio">				      		
				      		<a href="#">
				      			<i class="glyphicon glyphicon-star-empty"></i>
				      			<i class="glyphicon glyphicon-star-empty"></i>
				      		</a>
			      		</div>

			      		<div class="star-box meio">
				      		<a href="#">
				      			<i class="glyphicon glyphicon-star-empty"></i>
				      			<i class="glyphicon glyphicon-star-empty"></i>
				      			<i class="glyphicon glyphicon-star-empty"></i>
				      		</a>
			      		</div>

			      		<div class="star-box meio">
			      			<a href="#">
			      				<i class="glyphicon glyphicon-star-empty"></i>
			      				<i class="glyphicon glyphicon-star-empty"></i>
			      				<i class="glyphicon glyphicon-star-empty"></i>
			      				<i class="glyphicon glyphicon-star-empty"></i>
			      			</a>
			      		</div>

			      		<div class="star-box last">
			      			<a href="#">
			      				<i class="glyphicon glyphicon-star-empty"></i>
			      				<i class="glyphicon glyphicon-star-empty"></i>
			      				<i class="glyphicon glyphicon-star-empty"></i>
			      				<i class="glyphicon glyphicon-star-empty"></i>
			      				<i class="glyphicon glyphicon-star-empty"></i>
			      			</a>
			      		</div>
		      		</div>
	      		</div>
	      	
	      		
	      	</div>
	      </div>

    </div><!-- .gn Coluna direita -->

<script>

	$(function () {
	  $('.ttp').tooltip();

	  //$('.ppv').popover();

	  $('.btshare').popover({ html: true, trigger: 'focus', placement: 'top', content: $('#pshare').html() }); 
	  
	});

</script>


<div id="pshare" style="display: none">
	<a href=""><i class="h aau" style="font-size: 22px"></i></a>&ensp;
	<a href=""><i class="h ajo" style="font-size: 22px"></i></a>&ensp;
	<a href=""><i class="h aft" style="font-size: 22px"></i></a>&ensp;
	<a href=""><i class="h abx" style="font-size: 22px"></i></a>
</div>

    
