<div class="hl">
	
	<ol class="breadcrumb bread-border">
	  <li><a href="<?php echo URL?>">Home</a></li>
	  <li>Forum</li>
	  
	</ol>
	
	<?php foreach ( $this->listarSubject as $subject ) { ?>
	
	<div class="panel panel-default">
	
	  <div class="panel-heading" style="background: #583F7E; color: #fff; ">
	    <h3 class="panel-title"><?php echo $subject->getName(); ?></h3>
	  </div>
	  
	  <div class="panel-body">
	  		<?php $total_linha = count( $this->objTopic->listarTopicBySubject( $subject->getId_subject() ) );?>
		    <?php foreach( $this->objTopic->listarTopicBySubject( $subject->getId_subject() ) as $key => $topic ) { ?>
		    <?php $class_border = $key < ($total_linha-1) ? 'border-bottom: 1px #ccc dashed;' : ''; ?>
		    <div class="row" style="padding: 10px 0; <?php echo $class_border; ?>">
		    	<div class="col-md-10">
		    		<a href="<?php echo URL . 'forum/item/' . $topic->getId_topic(); ?>">
				    	<strong><?php echo $topic->getName(); ?></strong>
				    </a><br>
				    <?php echo $topic->getDescription(); ?>
			    	
		    	</div>
		    	<div class="col-md-1" style="text-align: center"><small>posts<br>345</small></div>
		    	<div class="col-md-1" style="text-align: center"><small>topics	<br>3456</small></div>
		    </div>
		    
		    <?php } ?>
	  	
	  </div>
	  
	</div>
	
	<?php } ?> 
	
</div>