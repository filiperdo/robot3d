<div class="hl">

	<ul class="ca qo anx">
	
		<li class="qf b aml row">
			<ol class="breadcrumb">
			  <li><a href="<?php echo URL?>">Home</a><span class="h abe"></span></li>
			  <li><a href="<?php echo URL?>forum">Forum</a></li>
			  <li><a href="<?php echo URL . 'forum/item/' . $this->objTopic->getId_topic(); ?>"><?php echo $this->objTopic->getName();?></a></li>
			  <li class="active"><?php echo $this->objTopic->getName(); ?></li>
			</ol>
		
			<div class="row" style="margin-bottom: 10px">
				<div class="col-md-12" >
					<h4 class="page-header">Iniciar um novo topico</h4>
				</div>
			</div>
		
			<div class="row forum-item-detail" style="margin-bottom: 10px">
				
				<div class="col-md-12">
					<form id="form1" name="form1" method="post" role="form" action="">
					
						<div class="form-group">
							<label>Titulo</label> 
							<input class="form-control" name="materiais" id="materiais" required="required" value="">
						</div>
						<div class="form-group">
							<textarea class="form-control" id="write_topic" name="write-topic" rows="10"></textarea>
						</div>
						<div class="form-group">
							<label>Anexo</label>
							<input type="file" name="img"/>
						</div>
						<div class="form-group">
							
							<input type="submit" name="salvar" id="salvar" value="Publicar" class="btn btn-success" />
							
						</div>
					</form>
				</div>
			</div>
			
		</li>
	
	</ul>

</div>

<script src='<?php echo URL?>util/tinymce/tinymce.min.js'></script>
<script>

  tinymce.init({
	  selector: '#write_topic',
	  theme: 'modern',
	  menubar:false,
	  plugins: [
	    'advlist autolink lists link image charmap print preview hr anchor pagebreak',
	    'searchreplace wordcount visualblocks visualchars code fullscreen',
	    'insertdatetime media nonbreaking save table contextmenu directionality',
	    'emoticons template paste textcolor colorpicker textpattern imagetools'
	  ],
	  toolbar1: 'insertfile undo redo | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image | print preview media | forecolor backcolor source code',
  });

</script>