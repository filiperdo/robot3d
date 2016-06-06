<div class="hl">


<ul class="ca qo anx">

<li class="qf b aml row">

	<ol class="breadcrumb">
	  <li><a href="<?php echo URL?>">Home</a></li>
	  <li>Projetos</li>
	  
	</ol>
	
	<div class="row">
	<?php foreach( $this->listarProject as $project ) { ?>
	<div class="col-md-4">
      <div class="qv rc aog alu">
        <div class="qx" style="background-image: url(<?php echo URL; ?>public/img/unsplash_1.jpg);"></div>
        
        <div class="qw dj">
			
			<div class="row">
				<div class="col-md-12">
		        	<h5 class="qy">
		        		<a class="aku" href="<?php echo URL?>project/item/<?php echo $project->getId_project(); ?>"> <?php echo $project->getTitle(); ?></a>
		        	</h5>
	
	        		<p class="alu"><?php echo $project->getContent(); ?></p>
        		</div>
			</div>
			
			<div class="row">
				<div class="col-md-4 col-xs-4"><small><strong>456</strong><br>Views</small></div>
				<div class="col-md-4 col-xs-4"><small><strong>34</strong><br>Comments</small></div>
				<div class="col-md-4 col-xs-4"><small><strong>100</strong><br>Likes</small></div>
			</div>
			
        </div>
      
      </div>
	
	</div><!-- .col-md-4 -->
	
	<?php } ?> 
	</div>
	
</li>

</ul>
</div>
