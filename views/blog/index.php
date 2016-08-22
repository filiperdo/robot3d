<div class="hh">

	<ol class="breadcrumb bread-border">
	  <li><a href="<?php echo URL?>">Home</a></li>
	  <li>Blog</li>
	</ol>
	
        <div class="qv rc aog alu">
        	<?php foreach( $this->listarPost as $post ) { ?>
				<div class="row" style="padding: 25px">
					<div class="col-md-4" ><img data-action="zoom" alt="" src="<?php echo URL . $post->getMainpicture();?>" width="100%"></div>
					<div class="col-md-8" style="">
						<p>
							<span class="title-post"><a href="<?php echo URL . 'blog/post/' . $post->getId_post(); ?>">
							<?php echo strtoupper( $post->getTitle() ); ?></a></span><br>
							<small><?php echo Data::formatDateShort( $post->getDate() );?> | <?php echo $post->getViews(); ?> Views | 0 comentários</small>
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
	          <?php foreach( $this->listarPost as $post ) { ?>
	         
	          <div class="row" >
	            <div class="col-md-3" style="padding-left: 15px; padding-right: 0">
	              <img data-action="zoom" alt="" src="<?php echo URL . $post->getMainpicture();?>" width="100%" height="70px">
	            </div>
	            <div class="col-md-9">
	              <a href="<?php echo URL?>blog/post/<?php echo $post->getId_post();?>">
	              	<strong><?php echo strtoupper( $post->getTitle() ); ?> </strong> 
	              </a>
	              <p><small><?php echo Data::formatDateShort( $post->getDate() );?> </small></p>
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
    
