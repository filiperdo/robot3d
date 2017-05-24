
<!-- Styles -->
<link href="<?php echo URL?>util/jqueryfiler/css/jquery.filer.css" rel="stylesheet">
<link href="<?php echo URL?>util/jqueryfiler/css/themes/jquery.filer-dragdropbox-theme.css" rel="stylesheet">

<!-- Jvascript -->
<script src="<?php echo URL?>util/jqueryfiler/js/jquery.filer.min.js" type="text/javascript"></script>
<script src="<?php echo URL?>util/jqueryfiler/js/custom.js" type="text/javascript"></script>

<!-- Page Heading -->
<div class="row">
	<div class="col-md-12 col-sm-12 col-xs-12">
		<div class="x_panel">
			<div class="x_title">
				<h2 class="page-header"><?php echo $this->title; ?></h2>
				<div class="clearfix"></div>
				<ol class="breadcrumb">
					<li><a href="<?php echo URL; ?>">Home</a></li>
					<li><a href="<?php echo URL; ?>post">Listar Post</a></li>
					<li class="active"><?php echo $this->title; ?></li>
				</ol>
			</div>

			<div class="col-md-8 col-sm-8 col-lg-8 col-xs-12">
				<form id="form1" name="form1" method="post" action="<?php echo URL;?>post/<?php echo $this->action;?>" class="form-horizontal" enctype="multipart/form-data">
				<input type="hidden" name="idPost" value="<?=$this->obj->getId_post()?>" />
				<input type="hidden" name="path" value="<?=$this->path?>" />

				<div class="form-group">
					<label for="title" class="col-md-2 col-sm-2 col-xs-12 control-label">Title</label>
					<div class="col-md-10 col-sm-10 col-xs-12">
						<input type="text" name="title" id="title"  class="form-control col-md-7 col-xs-12" required="required" value="<?=$this->obj->getTitle()?>" />
					</div>
				</div>

				<div class="form-group">
					<label for="status" class="col-md-2 col-sm-2 col-xs-12 control-label">Status</label>
					<div class="col-sm-3 col-sm-3 col-xs-12">
						<select name="status" class="form-control">
							<option value="DRAFT" <?php if( $this->obj->getStatus() == 'DRAFT' ){?>selected="selected"<?php }?>>Rascunho</option>
							<option value="PUBLISHED" <?php if( $this->obj->getStatus() == 'PUBLISHED' ){?>selected="selected"<?php }?>>Publicado</option>
						</select>
					</div>

					<div class="col-sm-7 col-sm-7 col-xs-12">

						<div class="input-group">
						  <span class="input-group-addon" id="basic-addon1"><i class="glyphicon glyphicon-calendar"></i></span>
						  <input type="text" name="date" placeholder="Data da notícia" class="form-control calendary" value="<?php echo Data::formataDataRetiraHora($this->obj->getDate()); ?>" />
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
						<label style="margin: 10px 10px 10px 0" class="text-uppercase">
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
				<input type="hidden" name="mainpicture" id="mainpicture" value="<?=$this->obj->getMainpicture()?>">
				</form>
			</div><!-- .col-md-8 -->

			<div class="col-md-4 col-sm-4 col-lg-4 col-xs-12">

				<!-- debug<form name="form5" action="http://localhost/robot3d/post/wideimage_ajax/" method="post" enctype="multipart/form-data" >
					<input type="file" name="files[]"  multiple="multiple" >
					<input type="submit">
				</form>-->

				<input type="hidden" name="action_post" id="action_post" value="<?php echo $this->method_upload; ?>">
				<input type="file" name="files[]" id="filer_input2" multiple="multiple">

				<div id="output-files">
				<div class="jFiler-items-list jFiler-items-grid" >

					<?php if( $this->path != '' ) { ?>
					<?php foreach ( Data::getImgPost('post', $this->path, true ) as $img ) { ?>

					<?php
					// pega o nome da imagem
					$array_img = explode('/', $img); $nome_img = end($array_img);
					?>

					<div class="jFiler-item" id="<?php echo 'id-'.base64_encode($nome_img);?>">
						<div class="jFiler-item-container">
							<div class="jFiler-item-inner">
								<div class="jFiler-item-thumb"><img alt="" src="<?=URL.$img?>" ></div>
								<div class="jFiler-item-assets jFiler-row" style="text-align:center">

									<ul class="list-inline pull-right">
										<?php $link_img = str_replace('/thumb/', '/', $img);?>
										<li>
											<button class="bt-copy btn btn-info btn-xs" data-clipboard-action="copy" data-clipboard-text="<?='../../'.$link_img?>"><i class="glyphicon glyphicon-link"></i></button>
											<a rel="<?php echo base64_encode($this->obj->getPath());?>" name="<?php echo base64_encode($nome_img); ?>" href="#" class="btn delete btn-danger btn-xs"><i class="icon-jfi-trash jFiler-item-trash-action"></i> Deletar</a>
										</li>

									</ul><br>
									<label>

										<?php $checked = $this->obj->getMainpicture() == $nome_img ? 'checked="checked"' : ''; ?>
										<input type="radio" class="radio-mainpicture" <?php echo $checked; ?> name="rd-mainpicture" value="<?php echo $nome_img; ?>">
										Destaque
									</label>
								</div>
							</div>
						</div>
					</div>
					<?php } // end foreach?>
					<?php } // end if ?>
				</div>
				</div>

			</div><!-- col-md-4 -->

		</div>

	</div>
</div>

<!-- /.row -->

<script>

	var clipboard = new Clipboard('.bt-copy');

	$(document).ready(function(){

		if( window.location.hostname == 'localhost' )
		{
			var URL = 'http://localhost/robot3d/';
		}
		else
		{
			var URL = 'http://www.robo3d.com.br/';
		}

		$(".delete").click(function(){

			$target = $(this);
			$liImg = '#id-' + $(this).attr('name');
			//alert('Nome: ' + $liImg);
			$($target).html('Deletando...');
			$.post(URL+'post/delete_img/'+$(this).attr('rel'), function(data){

				$($liImg).fadeOut( "slow", function() { $($liImg).remove(); });
				//alert(data);
			});
		});

		$('.radio-mainpicture').on('click',function(){
			$('#mainpicture').val($(this).val());
		})

	});
</script>

<script src='<?php echo URL?>util/tinymce/tinymce.min.js'></script>
<script>

  tinymce.init({
	  selector: '#content',
	  theme: 'modern',
	  menubar:false,
	  image_prepend_url: "<?php echo URL?>",
	  plugins: [
	    'advlist autolink lists link image charmap print preview hr anchor pagebreak',
	    'searchreplace wordcount visualblocks visualchars code fullscreen',
	    'insertdatetime media nonbreaking save table contextmenu directionality',
	    'emoticons template paste textcolor colorpicker textpattern imagetools'
	  ],
	  toolbar1: ' bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image | print preview media | forecolor backcolor source code',
  });

</script>
