<div class="hh">

	<ol class="breadcrumb bread-border">
	  <li><a href="<?php echo URL?>">Home</a></li>
	  <li>Blog</li>
	</ol>
	
        <div class="qv rc aog alu">
        	<?php foreach( $this->listarPost as $post ) { ?>
				<div class="row" style="padding: 25px">
					<div class="col-md-4">
						<?php if( !empty( $post->getMainpicture() ) ){?>
						<div class="" style="background: url(<?php echo URL . $post->getMainpicture(); ?>) center center no-repeat #000; background-size: 140%; overflow: hidden; height:150px"></div>
						<?php } else { ?>
						<?php $array_img = Data::getImgPost( 'post', $post->getPath() ); ?>
						<div class="" style="background: url(<?php echo URL . $array_img[0]; ?>) center center no-repeat #000; background-size: 140%; overflow: hidden; height:150px"></div>
						<?php } ?>
					</div>
					<div class="col-md-8" style="">
						<p>
							<span class="title-post text-uppercase"><a href="<?php echo URL . 'blog/post/' . $post->getId_post(); ?>">
							<?php echo $post->getTitle(); ?></a></span><br>
							<small><?php echo Data::formatDateShort( $post->getDate() );?> | <?php echo $this->comment->getTotalComment('post',$post->getId_post());?> comentários</small>
						</p>
						<p style="color:#666"><?php echo substr(strip_tags( $post->getContent() ), 0, 300)."..."; ?></p>
						
					</div>
				</div>
				<div class="row" style="border-bottom: 1px solid #eaeaea; margin: 0 25px"></div>
        	<?php } ?>
        	
        </div>
		
</div>

	<div class="gr"><!-- gn Coluna direita -->

		<div class="qv rc alu">
	        <div class="qw">
	        
			  <h4 class="page-header">Mais lidas</h4>  
	          <?php foreach( $this->listTopPost as $post ) { ?>
	         
	          <div class="row" >
	            <div class="col-md-3 col-sm-3 col-xs-3 ">
	            <?php if( !empty( $post->getMainpicture() ) ){?>
	            	<div class="" style="background: url(<?php echo URL . $post->getMainpicture(); ?>) center center no-repeat #000; background-size: 210%; overflow: hidden; height:60px"></div>
	            <?php } else { ?>
	            <?php $array_img = Data::getImgPost( 'post', $post->getPath() ); ?>
	            	<div class="" style="background: url(<?php echo URL . $array_img[0]; ?>) center center no-repeat #000; background-size: 210%; overflow: hidden; height:60px"></div>
	            <?php } ?>
	            </div>
	            <div class="col-md-9 col-sm-9 col-xs-9">
	              <a href="<?php echo URL?>blog/post/<?php echo $post->getId_post();?>">
	              	<span class="text-uppercase"><strong><?php echo $post->getTitle(); ?> </strong></span> 
	              </a>
	              <p><small><?php echo Data::formatDateShort( $post->getDate() );?> | <?php echo $this->comment->getTotalComment('post',$post->getId_post());?> comentários </small></p>
	              <!-- <p><?php echo substr(strip_tags( $post->getContent() ), 0, 80)."..."; ?></p> -->
	            </div>
	          </div>
	          
	          <div class="row" style="border-bottom: 1px solid #eaeaea; margin: 8px 0"></div>
	          <?php } ?>
			
	        </div>
	        
	      </div>
		  
	      <div class="qv rc aok">
	        <div class="qw">
	          <h4 class="page-header">Categorias</h4>
	          <?php foreach( $this->listCategory as $categori ){?>
	          <ul>
	          	<li>
		          <a href="#" class="text-capitalize">
		              <?php echo strtolower($categori->getName());?>
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
    
