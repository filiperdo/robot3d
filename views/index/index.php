
    <div class="gz"><!-- gz Coluna do meio -->
      <ul class="ca qo anx">
		<?php foreach( $this->list as $key => $list ){?>
        <li class="qf b aml">
          <!-- <a class="qj" href="#">
            <img class="qh cu" src="<?php echo URL; ?>public/img/avatar-dhg.png">
          </a> -->
          <div class="qg">
            <div class="qn">
              <small class="eg dp">4 min</small>
              <h4 class="page-header">
              	<?php if( $list['type'] == 'post' ) { ?>
              		<a href="<?php echo URL . 'blog/post/' . $list['id'];?>"><?php echo $list['title']; ?></a>
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
			+ <?php echo count( $array_img ) - 2 . ' Fotos '; ?>
            </div>
			
            <ul class="qo alm">
            <?php if( Session::get('loggedIn' ) ) { ?>
            <li class="qf">
                <a class="qj" href="#">
                  <img class="qh cu" src="<?php echo Data::getPhotoUser( Session::get('userid') ); ?>">
                </a>
                <div class="qg">
                  <strong><?php echo Session::get('user_login'); ?>: </strong>
                  
                  <form method="post" name="form-comment" >
	                  <input type="hidden" id="comment_type-<?php echo $list['id'] ?>" name="comment_type" value="<?php echo $list['type'] ?>">
	                  <input type="hidden" id="" name="id_item" value="<?php echo $list['id'] ?>">
	                  
	                  <div class="input-group">
	                  	
						<input type="text" class="form-control" name="content" id="content-<?php echo $list['id'] ?>" placeholder="Escrava um comentário">
						<span class="input-group-btn">
							<a class="btn btn-default bt-sub-form" id="<?php echo $list['id'] ?>">Enviar</a>
				      	</span>
				      	
					</div>
	                  
                  </form>
                  
                </div>
            </li>
            <?php } ?>
              
              
            <li class="qf" id="result-<?php echo $list['id']; ?>" style="display: none">
                <img alt="Carregando..." src="<?php echo URL?>public/img/loader.gif"> Carregando...
            </li>
              
            <?php foreach( $this->objComment->listCommentByType( $list['type'], $list['id'], 3 ) as $comment ) { ?>
              <li class="qf">
                <a class="qj" href="#">
                  <img class="qh cu" src="<?php echo Data::getPhotoUser( $comment->getUser()->getId_user() ); ?>">
                </a>
                <div class="qg">
                  <strong><?php echo $comment->getUser()->getName()?>: </strong>
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
    
    
    
    
