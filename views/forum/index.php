<div class="hl">
	
	<!-- <ol class="breadcrumb bread-border">
	  <li><a href="<?php echo URL?>">Home</a></li>
	  <li>Fórum</li>
	  
	</ol> -->
	
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
				    <strong><?php echo $topic->getDescription(); ?></strong><br>
				    <?php $objItem = $this->objItem->getLastItemByTopic( $topic->getId_topic() ); ?>
				    <?php if( $objItem != false ){?>
			    	<small>Último post: <?php echo Data::timeAgo( $objItem->getDate() );?> | por <?php echo $objItem->getUser()->getLogin();?> </small>
			    	<?php } ?>
		    	</div>
		    	<div class="col-md-1" style="text-align: center"><small>posts<br><?php echo $this->objReplie->countReplieByTopic( $topic->getId_topic() )?></small></div>
		    	<div class="col-md-1" style="text-align: center"><small>topics	<br><?php echo $this->objItem->countItemByTopic( $topic->getId_topic() )?></small></div>
		    </div>
		    
		    <?php } ?>
	  	
	  </div>
	  
	</div>
	
	<?php } ?> 
	
</div>