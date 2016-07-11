<div class="hl">

	<ul class="ca qo anx">
	
		<li class="qf b aml row">
		
			<ol class="breadcrumb">
			  <li><a href="<?php echo URL?>">Home</a></li>
			  <li><a href="<?php echo URL?>forum">Forum</a></li>
			  <li><a href="<?php echo URL . 'forum/item/' . $this->objItem->getTopic()->getId_topic(); ?>"><?php echo $this->objItem->getTopic()->getName();?></a></li>
			  <li class="active"><?php echo $this->objItem->getTitle(); ?></li>
			</ol>
			
			<?php if( Session::get('loggedIn') ) { ?>
			<div class="row" style="margin-bottom: 10px">
				<div class="col-md-12" style="text-align: right;">
					<a href="#repl" class="cg ts fx"><i class="glyphicon glyphicon-pencil"></i> Responder</a>
				</div>
			</div>
			<?php } ?>
			
			<div class="forum-item-detail" style="margin-bottom: 10px">
				<div class="col-md-2">
					<div class="row">
						<a href="#"><strong><?php echo $this->objItem->getUser()->getLogin(); ?></strong></a>
					</div>
					<div class="row" style="margin-top: 10px">
						<div style="float: left; width: 66px">
							<a class="qj" href="#">
			                  <img class="qh cu" src="<?php echo Data::getPhotoUser( $this->objItem->getUser()->getId_user() ); ?>">
			                </a>
			            </div>
			            <div style="float: left">
		                	<small><small>Posts <?php echo $this->objItem->countItemByUser( $this->objItem->getUser()->getId_user() )?></small></small><br>
							<small><small>Respostas <?php echo $this->objReplie->countReplieByUser( $this->objItem->getUser()->getId_user() );?></small></small><br>
		                </div>
					</div>
					
				</div>
				<div class="col-md-10">
					<p class="page-header"><strong><?php echo $this->objItem->getTitle();?></strong><span style="float: right;"><small><?php echo Data::timeAgo( $this->objItem->getDate() );?></small></span></p>
					<?php echo $this->objItem->getContent(); ?>
				</div>
			</div>
			
		</li>
	
	</ul>
	
	<?php foreach( $this->objReplie->listReplieByItem( $this->objItem->getId_item() ) as $replie ) {?>
	<ul class="ca qo anx forum-ul-resposta">
	
		<li class="qf b aml row">
			<div class="forum-item-detail" style="margin-bottom: 10px">
				<div class="col-md-2">
					<div class="row">
						<a href="<?php echo URL?>user/dashboard/<?php echo base64_encode( $replie->getUser()->getId_user() );?>"> <?php echo $replie->getUser()->getLogin(); ?></a>
					</div>
					<div class="row" style="margin-top: 10px">
						<div style="float: left; width: 66px">
							<a class="qj" href="#">
			                  <img class="qh cu" src="<?php echo Data::getPhotoUser( $replie->getUser()->getId_user() ); ?>">
			                </a>
		                </div>
		                <div style="float: left">
		                	<small><small>Posts <?php echo $this->objItem->countItemByUser( $replie->getUser()->getId_user() )?></small></small><br>
							<small><small>Respostas <?php echo $this->objReplie->countReplieByUser( $replie->getUser()->getId_user() );?></small></small><br>
		                </div>
					</div>
				</div>
				<div class="col-md-10">
					<small><strong><?php echo Data::timeAgo( $replie->getDate() );?></strong></small><br>
					<small><?php echo 'Re: ' . $this->objItem->getTitle();?></small><hr>
					<?php echo $replie->getContent(); ?>
				</div>
			</div>
		</li>
		
	</ul>
	<?php } ?>
	
	<!-- Verificar se esta logado -->
	<?php if( Session::get('loggedIn') ) { ?>
	<ul class="ca qo anx forum-ul-resposta">
	
		<li class="qf b aml row">
		
			<?php if (isset($_GET["st"])) { $objAlert = new Alerta($_GET["st"]); } ?>
			
			<h5 class="page-header">Responder tópico: <?php echo $this->objItem->getTitle();?></h5><a name="repl"></a>
			<form name="form-replie" method="post" action="<?php echo URL?>replie/create">
			<input type="hidden" name="id_item" value="<?php echo $this->objItem->getId_item(); ?>">
				<div class="form-group">
					<textarea name="content" id="replie" rows="8"></textarea>
				</div>
				
				<div class="form-group">
					<button type="submit" class="cg ts fx"><i class="glyphicon glyphicon-pencil"></i> Publicar</button>
				</div>
				
			</form>
			
		</li>
		
	</ul>
	<?php } ?>
	
</div>

<script src='<?php echo URL; ?>util/tinymce/tinymce.min.js'></script>
<script>

  tinymce.init({
	  selector: '#replie',
	  theme: 'modern',
	  menubar: false,
	  plugins: [
	    'advlist autolink lists link image charmap print preview hr anchor pagebreak',
	    'searchreplace wordcount visualblocks visualchars code fullscreen',
	    'insertdatetime media nonbreaking save table contextmenu directionality',
	    'emoticons template paste textcolor colorpicker textpattern imagetools'
	  ],
	  toolbar1: 'bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image | print preview media | forecolor backcolor source code',
  });
 
</script>