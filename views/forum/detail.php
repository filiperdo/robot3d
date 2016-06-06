<div class="hl">

	<ul class="ca qo anx">
	
		<li class="qf b aml row">
		
			<ol class="breadcrumb">
			  <li><a href="<?php echo URL?>">Home</a></li>
			  <li><a href="<?php echo URL?>forum">Forum</a></li>
			  <li><a href="<?php echo URL . 'forum/item/' . $this->objItem->getTopic()->getId_topic(); ?>"><?php echo $this->objItem->getTopic()->getName();?></a></li>
			  <li class="active"><?php echo $this->objItem->getTitle(); ?></li>
			</ol>
		
			<div class="row" style="margin-bottom: 10px">
				<div class="col-md-12" style="text-align: right;">
					<a href="#" class="cg ts fx"><i class="glyphicon glyphicon-pencil"></i> Responder</a>
				</div>
			</div>
		
			<div class="row forum-item-detail" style="margin-bottom: 10px">
				<div class="col-md-2">
					<a href="#" ><?php echo $this->objItem->getUser()->getLogin(); ?></a>
				</div>
				<div class="col-md-10">
					<h4><?php echo $this->objItem->getTitle();?></h4>
					<?php echo $this->objItem->getContent(); ?>
				</div>
			</div>
			
		</li>
	
	</ul>
	
	<?php for($i=0;$i<3;$i++){?>
	<ul class="ca qo anx forum-ul-resposta">
	
		<li class="qf b aml row">
			Resposta
		</li>
		
	</ul>
	<?php } ?>
	
	<!-- Verificar se esta logado -->
	<ul class="ca qo anx forum-ul-resposta">
	
		<li class="qf b aml row">
		formulario de reposta
		</li>
		
	</ul>

</div>

<script src='<?php echo URL; ?>util/tinymce/tinymce.min.js'></script>
<script>

  tinymce.init({
	  selector: '#mediacoes, #desdobramentos',
	  theme: 'modern',
	  menubar:true,
	  plugins: [
	    'advlist autolink lists link image charmap print preview hr anchor pagebreak',
	    'searchreplace wordcount visualblocks visualchars code fullscreen',
	    'insertdatetime media nonbreaking save table contextmenu directionality',
	    'emoticons template paste textcolor colorpicker textpattern imagetools'
	  ],
	  toolbar1: 'insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image | print preview media | forecolor backcolor source code',
  });
 
</script>