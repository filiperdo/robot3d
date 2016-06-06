<div class="hl">
	
	<ol class="breadcrumb bread-border">
	  <li><a href="<?php echo URL?>">Home</a></li>
	  <li>Forum</li>
	  
	</ol>
	
	<?php foreach ( $this->listarSubject as $subject ) { ?>
	
	<div class="panel panel-default">
	
	  <div class="panel-heading">
	    <h3 class="panel-title"><?php echo $subject->getName(); ?></h3>
	  </div>
	  
	  <div class="panel-body">
	  	
		    <?php foreach( $this->objTopic->listarTopicBySubject( $subject->getId_subject() ) as $topic ) { ?>
		    <div class="row" style="padding: 10px 0; border-bottom: 1px #ccc solid;">
		    	<div class="col-md-10">
		    		<a href="<?php echo URL . 'forum/item/' . $topic->getId_topic(); ?>">
				    	<strong><?php echo $topic->getName(); ?></strong><br>
				    	<?php echo $topic->getDescription(); ?>
			    	</a>
		    	</div>
		    	<div class="col-md-1" style="text-align: center"><small>posts<br>345</small></div>
		    	<div class="col-md-1" style="text-align: center"><small>topics	<br>3456</small></div>
		    </div>
		    <?php } ?>
	  	
	  </div>
	  
	</div>
	
	<?php } ?> 
	
</div>