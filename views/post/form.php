

<!-- Page Heading -->
<div class="row">
	<div class="col-lg-12">
		<h1 class="page-header"><?php echo $this->title; ?></h1>
		<ol class="breadcrumb">
			<li><a href="<?php echo URL; ?>">Home</a></li>
			<li><a href="<?php echo URL; ?>post"><?php echo $this->title; ?></a></li>
			<li class="active"><?php echo $this->title; ?></li>
		</ol>
	</div>
</div>
<!-- /.row -->

<div class="row">

<div class="col-md-8">
<form id="form1" name="form1" method="post" action="<?php echo URL;?>post/<?php echo $this->action;?>/" class="form-horizontal">
<input type="hidden" name="idPost" value="<?=$this->obj->getId_post()?>" />

<div class="form-group">
	<label for="title" class="col-sm-2 control-label">Title</label> 
	<div class="col-sm-10"> 
		<input type="text" name="title" id="title"  class="form-control" required="required" value="<?=$this->obj->getTitle()?>" />
	</div>
</div>

<div class="form-group">
	<label for="status" class="col-sm-2 control-label">Status</label> 
	<div class="col-sm-10"> 
		<select name="status" class="form-control">
			<option value="DRAFT" <?php if( $this->obj->getStatus() == 'DRAFT' ){?>selected="selected"<?php }?>>Rascunho</option>
			<option value="PUBLISHED" <?php if( $this->obj->getStatus() == 'PUBLISHED' ){?>selected="selected"<?php }?>>Publicado</option>
		</select>
	</div>
</div>

<div class="form-group">
	<label for="content" class="col-sm-2 control-label">Content</label> 
	<div class="col-sm-10"> 
		<textarea class="form-control" id="content" name="content" rows="13"><?=$this->obj->getContent()?></textarea>
	</div>
</div>

<div class="checkbox">
	<label class="col-sm-2 control-label">Categorias</label> 
	<div class="col-sm-10 ">
		<?php foreach( $this->listCategory as $category ) { ?>
		<label style="margin: 10px 20px 20px 0">
			<input type="checkbox" value="<?php echo $category->getId_category(); ?>" name="categoria[]" <?php if( in_array($category->getId_category(), $this->array_category ) ){?>checked="checked"<?php } ?>> 
			<?php echo $category->getName(); ?>
		</label>
		<?php } ?>
	</div>
</div>

<div class="form-group">
	<div class="col-sm-10  col-sm-offset-2">
		<input type="submit" name="salvar" id="salvar" value="Salvar" class="btn btn-success" />
		<a href="<?php echo URL; ?>post" class="btn btn-info">Cancelar</a>
	</div>
</div>

</form>
</div><!-- .col-md-8 -->

<div class="col-md-4">
<form enctype="multipart/form-data" action="<?php echo URL?>post/wideimage_ajax" method="POST">
    <!-- MAX_FILE_SIZE deve preceder o campo input -->
    <input type="hidden" name="MAX_FILE_SIZE" value="30000" />
    <!-- O Nome do elemento input determina o nome da array $_FILES -->
    Enviar esse arquivo: <input name="fileUpload[]" id="fileUpload" multiple="multiple" type="file" />
    <input type="submit" value="Enviar arquivo" />
</form>
</div><!-- col-md-4 -->

</div>

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7/jquery.js"></script> 
<script src="http://malsup.github.com/jquery.form.js"></script>

<script>
      /*
      function saveImages()
      {
         $('#formImage').ajaxSubmit({
            url  : 'http://localhost/robot3d/post/wideimage_ajax',
            type : 'POST'
         });
      }*/
</script>

<script src='<?php echo URL?>util/tinymce/tinymce.min.js'></script>
<script>

  tinymce.init({
	  selector: '#content',
	  theme: 'modern',
	  menubar:false,
	  plugins: [
	    'advlist autolink lists link image charmap print preview hr anchor pagebreak',
	    'searchreplace wordcount visualblocks visualchars code fullscreen',
	    'insertdatetime media nonbreaking save table contextmenu directionality',
	    'emoticons template paste textcolor colorpicker textpattern imagetools'
	  ],
	  toolbar1: ' bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image | print preview media | forecolor backcolor source code',
  });

</script>
