<div class="hh">

	<ol class="breadcrumb bread-border">
	  <li><a href="<?php echo URL?>">Home</a></li>
	  <li><a href="<?php echo URL?>project">Blog</a></li>
	  <li><?=$this->obj->getTitle()?></li>
	</ol>

	<?php if( !empty( $this->obj->getMainpicture() ) ) { ?>
	<div class="qv rc aog alu">
		<div class="qx" style="background: url(<?php echo URL . $this->obj->getMainpicture(); ?>) center center; height: 250px;"></div>
	</div>
	<?php } ?>

	<ul class="ca qo anx">
		<li class="qf b aml">
	        <div class="qw dj">
	        	<h3 ><?=$this->obj->getTitle()?></h3>
	        	<p class="alu"><small><?=Data::formatDateShort($this->obj->getDate())?></small></p>
				<p><?=$this->obj->getContent()?></p>
			</div>
		</li>
		
		<li class="qf b aml">
			<div class="any" data-grid="images">
            <?php foreach( glob('public/img/post/'. $this->obj->getId_post() .'/*.jpg') as $imagem ){ ?>
            <?php list($width, $height, $type, $attr) = getimagesize( $imagem ); ?>
              <div style="display: none">
                <img data-action="zoom" data-width="<?php echo $width; ?>" data-height="<?php echo $height; ?>" src="<?php echo URL . $imagem; ?>">
              </div>
			<?php } ?>
            </div>
		</li>
		
		<li class="qf b aml">
		
		<h5 class="page-header">Comentários (<?php echo $this->objComment->getTotalComment( 'post', $this->obj->getId_post() ); ?>)</h5>
		
		<ul class="qo alm">
		<?php if( Session::get('loggedIn' ) ) { ?>
            <li class="qf">
                <a class="qj" href="#">
                  <img class="qh cu" src="<?php echo Data::getPhotoUser( Session::get('userid') ); ?>">
                </a>
                <div class="qg">
                  <strong><?php echo Session::get('user_login'); ?>: </strong>
                  
                  <input type="hidden" id="comment_type-<?php echo $this->obj->getId_post() ?>" name="comment_type" value="post">
                  
                  <div class="row">
					<div class="col-md-9"><input type="text" class="form-control" name="content" id="content-<?php echo $this->obj->getId_post() ?>" placeholder="Escrava um comentário" style="margin-bottom: 5px"></div>
					
					<div class="col-md-3"><a class="cg ts fx bt-sub-form" id="<?php echo $this->obj->getId_post() ?>"><span class="h aah"></span> Publicar</a></div>
				  </div>
                </div>
            </li>
            <?php } ?>
            
            <li class="qf" id="result-<?php echo $this->obj->getId_post(); ?>" style="display: none"><img alt="Carregando..." src="<?php echo URL?>public/img/loader.gif"> Carregando...</li>
        
            <?php foreach( $this->objComment->listCommentByType( 'post', $this->obj->getId_post() ) as $comment ) { ?>
              <li class="qf">
                <a class="qj" href="#">
                  <img class="qh cu" src="<?php echo Data::getPhotoUser( $comment->getUser()->getId_user() ); ?>">
                </a>
                <div class="qg">
                  <strong><a href="<?php echo URL . 'user/dashboard/'. base64_encode( $comment->getUser()->getId_user() )?>"><?php echo $comment->getUser()->getLogin()?>: </a></strong>
                  <?php echo $comment->getContent();?>
                </div>
              </li>
            <?php } ?>
		</ul>
		</li>
	</ul>

</div>

	<div class="gr"><!-- gn Coluna direita -->

		<div class="qv rc alu">
	        <div class="qw">
	        
	        <h4 class="page-header">Posts relacionados</h4>
	        
	        <ul class="qo anx">
	          
	          <?php foreach( $this->listPostRelated as $post ) { ?>
	          <li class="qf alm">
	            <a class="qj" href="#">
	              <img class="qh cu" src="<?php echo Data::getPhotoUser( 3 ) ?>">
	            </a>
	            <div class="qg">
	              <a href="<?php echo URL?>blog/index/<?php echo $post->getId_post();?>">
	              	<strong><?php echo $post->getTitle(); ?> </strong> 
	              </a>
	              <p><small><?php echo Data::timeAgo( $post->getDate() );?> | <?php echo $post->getViews(); ?> Views</small></p>
	            </div>
	          </li>
	          <?php } ?>
	          
	        </ul>
	        
	        </div>
	        
	      </div>
		  
	      <div class="row" style="margin-bottom: 20px;">
	      	<div class="col-md-12">
	      	
	      		<a href="#" class="cg ts fx"><i class="h aau"></i> </a>
	      		<a href="#" class="cg ts fx"><i class="h ajo"></i> </a>
	      		<a href="#" class="cg ts fx"><i class="h adr"></i> </a>
	      		<a href="#" class="cg ts fx"><i class="h abx"></i> </a>
	      	</div>
	      </div>
	      
	      <div class="qv rc aok">
	        <div class="qw">
	          <h4 class="page-header">Categorias</h4>
	          <?php foreach( $this->listCategory as $categori ){?>
	          <ul>
	          	<li>
		          <a href="#">
		              <?php echo $categori->getName();?>
		          </a>
	          </li>
	          </ul>
	          <?php } ?>
	          
	        </div>
	      </div>

    </div><!-- .gn Coluna direita -->


<script>

	$(function () {
	  $('.ttp').tooltip();

	  $('.ppv').popover();
	});

</script>
    
