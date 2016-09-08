
  
    <div class="gz"><!-- gz Coluna do meio -->
      <ul class="ca qo anx">
		<?php foreach( $this->listarHome as $key => $list ){?>
        <li class="qf b aml">
          <!-- <a class="qj" href="#">
            <img class="qh cu" src="<?php echo URL; ?>public/img/avatar-dhg.png">
          </a> -->
          <div class="qg">
            <div class="qn">
           
              <small class="eg dp"><?php echo Data::timeAgo( $list['date'] ) ?></small>
              <h4 class="title-post-home" style="text-transform: uppercase;">
              	<?php if( $list['tipo'] == 'post' ) { ?>
              	<?php $link = URL . 'blog/post/' . $list['id'];?>
              		<a href="<?php echo $link; ?>"><?php echo strtoupper($list['title']); ?></a>
              	<?php } else { ?>
              	<?php $link = URL . 'project/detail/' . $list['id'];?>
              		<a href="<?php echo $link; ?>"><?php echo strtoupper($list['title']); ?></a>
              	<?php } ?>
              	
              </h4>
            </div>
            
			<?php if( !empty( $list['mainpicture'] ) ) { ?>
	            <?php $mainpicture = URL . $list['mainpicture']; ?>
	            <?php list( $width, $height, $type, $attr ) = getimagesize( $mainpicture ); ?>
				<div class="any" data-grid="images">
		            <div style="display: none">
		            	<img data-action="zoom" data-width="<?php echo $width; ?>" data-height="<?php echo $height?>" src="<?php echo $mainpicture; ?>">
		            </div>
            	</div>
			<?php } ?>
			
            <p><?php echo substr(strip_tags( $list['content'] ), 0,300)."...  - <small><a href='{$link}'>veja mais</a></small>"; ?></p>
			
            <div class="any" data-grid="images">
            <?php $array_img = Data::getImgPost( $list['tipo'], $list['path'] ); ?>
            
            <?php foreach( $array_img as $key => $img ){ ?>
            
            <?php if( $key < 2 && $img != $list['mainpicture'] ) { ?>
            <?php list($width, $height, $type, $attr) = getimagesize( $img ); ?>
              <div style="display: none">
                <img data-action="zoom" data-width="<?php echo $width; ?>" data-height="<?php echo $height; ?>" src="<?php echo $img; ?>">
              </div>
			<?php } // fim if ?>
			<?php } // fim foreach ?>
            </div>
			
			<p class="page-header"><?php echo $this->objComment->getTotalComment( $list['tipo'], $list['id'] ); ?> <small>Comentátios</small> <i class="glyphicon glyphicon-comment"></i></p>
			
            <ul class="qo alm">
            <?php if( Session::get('loggedIn' ) ) { ?>
            <li class="qf">
                <a class="qj" href="#">
                  <img class="qh cu" src="<?php echo Data::getPhotoUser( Session::get('userid') ); ?>">
                </a>
                <div class="qg">
                  <strong><?php echo Session::get('user_login'); ?>: </strong>
                  
                  <input type="hidden" id="comment_type-<?php echo $list['id'] ?>" name="comment_type" value="<?php echo $list['tipo'] ?>">
                  <input type="hidden" id="" name="id_item" value="<?php echo $list['id'] ?>">
                  <div class="row">
					<div class="col-md-9"><input type="text" class="form-control" name="content" id="content-<?php echo $list['id'] ?>" placeholder="Escrava um comentário" style="margin-bottom: 5px"></div>
					
					<div class="col-md-3"><a class="cg ts fx bt-sub-form" id="<?php echo $list['id'] ?>"><span class="h aah"></span> Publicar</a></div>
				  </div>
                </div>
            </li>
            <?php } ?>
            
            <li class="qf" id="result-<?php echo $list['id']; ?>" style="display: none"><img alt="Carregando..." src="<?php echo URL?>public/img/loader.gif"> Carregando...</li>
        
            <?php foreach( $this->objComment->listCommentByType( $list['tipo'], $list['id'], 3 ) as $comment ) { ?>
              <li class="qf">
                <a class="qj" href="#">
                  <img class="qh cu" src="<?php echo Data::getPhotoUser( $comment->getUser()->getId_user() ); ?>">
                </a>
                <div class="qg">
                  <strong><a href="<?php echo URL . 'user/dashboard/'. base64_encode( $comment->getUser()->getId_user() )?>"><?php echo $comment->getUser()->getLogin()?> </a></strong>
                  <small>(<?php echo Data::formatDateShort( $comment->getDate() ); ?>)</small>:
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
    