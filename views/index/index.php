
  
    <div class="gz"><!-- gz Coluna do meio -->
      <ul class="ca qo anx">
		<?php foreach( $this->list as $key => $list ){?>
        <li class="qf b aml">
          <!-- <a class="qj" href="#">
            <img class="qh cu" src="<?php echo URL; ?>public/img/avatar-dhg.png">
          </a> -->
          <div class="qg">
            <div class="qn">
           
              <small class="eg dp"><?php echo Data::timeAgo( $list['date'] ) ?></small>
              <h4 class="page-header">
              	<?php if( $list['type'] == 'post' ) { ?>
              		<a href="<?php echo URL . 'blog/index/' . $list['id'];?>"><?php echo $list['title']; ?></a>
              	<?php } else { ?>
              		<a href="<?php echo URL . 'project/detail/' . $list['id'];?>"><?php echo $list['title']; ?></a>
              	<?php } ?>
              	
              </h4> 
            </div>

            <p><?php echo $list['content']; ?></p>
			
            <div class="any" data-grid="images">
            <?php $array_img = Data::getImgPost( $list['type'], $list['id'] ); ?>
            <?php for(  $i = 0; $i<2; $i++ ){ ?>
            <?php list($width, $height, $type, $attr) = getimagesize( $array_img[$i] ); ?>
              <div style="display: none">
                <img data-action="zoom" data-width="<?php echo $width; ?>" data-height="<?php echo $height; ?>" src="<?php echo $array_img[$i]; ?>">
              </div>
			<?php } ?>
			<?php //echo count( $array_img ) - 2 . ' Fotos '; ?>
            </div>
			
			<h5 class="page-header">Comentários (<?php echo $this->objComment->getTotalComment( $list['type'], $list['id'] ); ?>) </h5>
			
            <ul class="qo alm">
            <?php if( Session::get('loggedIn' ) ) { ?>
            <li class="qf">
                <a class="qj" href="#">
                  <img class="qh cu" src="<?php echo Data::getPhotoUser( Session::get('userid') ); ?>">
                </a>
                <div class="qg">
                  <strong><?php echo Session::get('user_login'); ?>: </strong>
                  
                  <input type="hidden" id="comment_type-<?php echo $list['id'] ?>" name="comment_type" value="<?php echo $list['type'] ?>">
                  <input type="hidden" id="" name="id_item" value="<?php echo $list['id'] ?>">
                  <div class="row">
					<div class="col-md-9"><input type="text" class="form-control" name="content" id="content-<?php echo $list['id'] ?>" placeholder="Escrava um comentário" style="margin-bottom: 5px"></div>
					
					<div class="col-md-3"><a class="cg ts fx bt-sub-form" id="<?php echo $list['id'] ?>"><span class="h aah"></span> Publicar</a></div>
				  </div>
                </div>
            </li>
            <?php } ?>
            
            <li class="qf" id="result-<?php echo $list['id']; ?>" style="display: none"><img alt="Carregando..." src="<?php echo URL?>public/img/loader.gif"> Carregando...</li>
        
            <?php foreach( $this->objComment->listCommentByType( $list['type'], $list['id'], 3 ) as $comment ) { ?>
              <li class="qf">
                <a class="qj" href="#">
                  <img class="qh cu" src="<?php echo Data::getPhotoUser( $comment->getUser()->getId_user() ); ?>">
                </a>
                <div class="qg">
                  <strong><a href="<?php echo URL . 'user/dashboard/'. base64_encode( $comment->getUser()->getId_user() )?>"><?php echo $comment->getUser()->getLogin()?> </a></strong>
                  <small>(<?php echo Data::timeAgo( $comment->getDate() ); ?>)</small>:
                  <?php echo $comment->getContent();?>
                </div>
              </li>
            <?php } ?>
          
            </ul>
            
          </div>
        </li>
        <?php } ?>
		
      </ul>
    </div><!-- .gz Coluna do meio -->
    