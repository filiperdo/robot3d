
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
              <h5><?php echo $list['title']; ?></h5> 
            </div>

            <p><?php echo $list['content']; ?></p>

            <div class="any" data-grid="images">
            <?php foreach( glob('public/img/'. $list['type'] .'/'. $list['id'] .'/*.jpg') as $imagem ){ ?>
            <?php list($width, $height, $type, $attr) = getimagesize( $imagem ); ?>
              <div style="display: none">
                <img data-action="zoom" data-width="<?php echo $width; ?>" data-height="<?php echo $height; ?>" src="<?php echo $imagem; ?>">
              </div>
			<?php } ?>
				
            </div>
			
            <ul class="qo alm">
              <li class="qf">
                <a class="qj" href="#">
                  <img class="qh cu" src="<?php echo Data::getPhotoUser(3); ?>">
                </a>
                <div class="qg">
                  <strong>Jacon Thornton: </strong>
                  Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit .
                  
                </div>
              </li>
            </ul>
            
          </div>
        </li>
        <?php } ?>
		
      </ul>
    </div><!-- .gz Coluna do meio -->
    
    
    
    
