

<!-- Page Heading -->
<div class="row">
	<div class="col-lg-12">
		<h1 class="page-header"><?php echo $this->title; ?></h1>
		<ol class="breadcrumb">
			<li><a href="<?php echo URL; ?>">Home</a></li>
			<li><a href="<?php echo URL; ?>post">Blog</a></li>
			<li class="active"><?php echo $this->title; ?></li>
		</ol>
	</div>
</div>
<!-- /.row -->

<div class="row">

<div class="col-md-8">
<form id="form1" name="form1" method="post" action="<?php echo URL;?>post/<?php echo $this->action;?>" class="form-horizontal" enctype="multipart/form-data">
<input type="hidden" name="idPost" value="<?=$this->obj->getId_post()?>" />
<input type="hidden" name="path" value="<?=$this->path?>" />

<div class="form-group">
	<label for="title" class="col-sm-2 control-label">Title</label> 
	<div class="col-sm-10"> 
		<input type="text" name="title" id="title"  class="form-control" required="required" value="<?=$this->obj->getTitle()?>" />
	</div>
</div>

<div class="form-group">
	<label for="status" class="col-sm-2 control-label">Status</label> 
	<div class="col-sm-3"> 
		<select name="status" class="form-control">
			<option value="DRAFT" <?php if( $this->obj->getStatus() == 'DRAFT' ){?>selected="selected"<?php }?>>Rascunho</option>
			<option value="PUBLISHED" <?php if( $this->obj->getStatus() == 'PUBLISHED' ){?>selected="selected"<?php }?>>Publicado</option>
		</select>
	</div>
	
	<div class="col-sm-7"> 
		
		<div class="input-group">
		  <span class="input-group-addon" id="basic-addon1"><i class="glyphicon glyphicon-picture"></i></span>
		  
		  <input type="text" name="mainpicture" id="mainpicture" placeholder="Link da imagem de capa" class="form-control" value="<?php echo $this->obj->getMainpicture(); ?>" />
		</div>
	
	</div>
</div>

<div class="form-group">
	<label for="status" class="col-sm-2 control-label">Autor</label> 
	<div class="col-sm-3"> 
		<input type="text" name="author" class="form-control" value="<?php echo $this->obj->getAuthor(); ?>" />
	</div>
	
	<div class="col-sm-7"> 
		
		<div class="input-group">
		  <span class="input-group-addon" id="basic-addon1"><i class="glyphicon glyphicon-link"></i></span>
		  <input type="text" name="source" id="source" placeholder="Link de origem" class="form-control" value="<?php echo $this->obj->getSource(); ?>" />
		</div>
	
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

	<form name="upimage" id="upimage" method="POST" enctype="multipart/form-data" >
	    
	    <!-- O Nome do elemento input determina o nome da array $_FILES -->
	    <input name="fileUpload[]" id="fileUpload" multiple="multiple" type="file" required="required" />
	    
	    <button class="btn btn-success" type="submit" id="bt-upload" style="margin: 12px 0">Enviar arquivo(s)</button>
	    <!-- <input type="submit" value="Enviar arquivo" /> -->
	    
	</form>
	
	<div id="output-files">
		<?php if( $this->path != '' ) { ?>
		<?php foreach ( Data::getImgPost('post', $this->path, true ) as $img ) { ?>
			<div class="row" style="margin-bottom: 12px">
				<div class="col-md-4"><img alt="" src="<?=URL.$img?>" width="100px"></div>
				<div class="col-md-6">
					<?php $link_img = str_replace('/thumb/', '/', $img);?>
					<button class="bt-copy btn btn-primary btn-sm" data-clipboard-action="copy" data-clipboard-text="<?='../../'.$link_img?>"><i class="glyphicon glyphicon-link"></i> Copy</button>
					<a href="" class="btn btn-danger btn-sm"><i class="glyphicon glyphicon-trash"></i> Deletar</a>
				</div>
			</div>
		<?php } // end foreach?>
		<?php } // end if ?>
	</div>

</div><!-- col-md-4 -->

</div>


<script src="http://malsup.github.com/jquery.form.js"></script>

<script>

	if( window.location.hostname == 'localhost' )
	{
		var URL = 'http://localhost/robot3d/';
	}
	else
	{
		var URL = 'http://www.robo3d.com.br/';
	}

	var options = {
        //target:        '#output-files',   // target element(s) to be updated with server response 
        //beforeSubmit:  showRequest,  // pre-submit callback 
        success : showResponse,  // post-submit callback 
        url  	: URL + 'post/wideimage_ajax',
		type 	: 'POST'
        // other available options: 
        //dataType:  null        // 'xml', 'script', or 'json' (expected server response type) 
        //clearForm: true        // clear all form fields after successful submit 
        //resetForm: true        // reset the form after successful submit
 
        // $.ajax options can be used here too, for example: 
        //timeout:   3000 
    };

	$("#bt-upload").click( function(){
		
		$('#upimage').ajaxSubmit(options);
		
	});

	function showResponse()
	{
		//$("#output-files").html(responseText);
		alert('ok');
		//$('#output-files').load('http://localhost/robot3d/post/teste');
	}

	var clipboard = new Clipboard('.bt-copy');

    clipboard.on('success', function(e) {
        console.log(e);
    });

    clipboard.on('error', function(e) {
        console.log(e);
    });
	
</script>

<script src='<?php echo URL?>util/tinymce/tinymce.min.js'></script>
<script>

  tinymce.init({
	  selector: '#content',
	  theme: 'modern',
	  menubar:false,
	  image_prepend_url: "http://localhost/robot3d/",
	  plugins: [
	    'advlist autolink lists link image charmap print preview hr anchor pagebreak',
	    'searchreplace wordcount visualblocks visualchars code fullscreen',
	    'insertdatetime media nonbreaking save table contextmenu directionality',
	    'emoticons template paste textcolor colorpicker textpattern imagetools'
	  ],
	  toolbar1: ' bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image | print preview media | forecolor backcolor source code',
  });

</script>
