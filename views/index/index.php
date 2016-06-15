
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
            <?php foreach( glob('public/img/'. $list['type'] .'/'. $list['id'] .'/*.jpg' ) as $imagem ){ ?>
            <?php list($width, $height, $type, $attr) = getimagesize( $imagem ); ?>
              <div style="display: none">
                <img data-action="zoom" data-width="<?php echo $width; ?>" data-height="<?php echo $height; ?>" src="<?php echo $imagem; ?>">
              </div>
			<?php } ?>
				
            </div>
			
            <ul class="qo alm">
            <?php for($i=0; $i<2; $i++){?>
              <li class="qf">
                <a class="qj" href="#">
                  <img class="qh cu" src="<?php echo Data::getPhotoUser(3); ?>">
                </a>
                <div class="qg">
                  <strong>Name user: </strong>
                  Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
                </div>
              </li>
            <?php } ?>
            </ul>
            
          </div>
        </li>
        <?php } ?>
		
      </ul>
    </div><!-- .gz Coluna do meio -->
    
    
    
    
