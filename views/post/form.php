<!-- blueimp Gallery styles -->
<link rel="stylesheet" href="//blueimp.github.io/Gallery/css/blueimp-gallery.min.css">
<!-- CSS to style the file input field as button and adjust the Bootstrap progress bars -->
<link rel="stylesheet" href="<?php echo URL; ?>util/jquery-file-upload/jquery.fileupload.css">
<link rel="stylesheet" href="<?php echo URL; ?>util/jquery-file-upload/jquery.fileupload-ui.css">
<!-- CSS adjustments for browsers with JavaScript disabled -->
<noscript><link rel="stylesheet" href="<?php echo URL; ?>util/jquery-file-upload/jquery.fileupload-noscript.css"></noscript>
<noscript><link rel="stylesheet" href="<?php echo URL; ?>util/jquery-file-upload/jquery.fileupload-ui-noscript.css"></noscript>
<style>
/* Hide Angular JS elements before initializing */
.ng-cloak {
    display: none;
}
</style>

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
<!-- The file upload form used as target for the file upload widget -->
<form id="fileupload" action="//jquery-file-upload.appspot.com/" method="POST" enctype="multipart/form-data" data-ng-app="demo" data-ng-controller="DemoFileUploadController" data-file-upload="options" data-ng-class="{'fileupload-processing': processing() || loadingFiles}">
	<h3 class="page-header">Fotos</h3>
	<!-- Redirect browsers with JavaScript disabled to the origin page -->
        <noscript><input type="hidden" name="redirect" value="https://blueimp.github.io/jQuery-File-Upload/"></noscript>
        
        <!-- The fileupload-buttonbar contains buttons to add/delete files and start/cancel the upload -->
        <div class="row fileupload-buttonbar">
            <div class="col-lg-12">
                <!-- The fileinput-button span is used to style the file input field as button -->
                <span class="btn btn-success fileinput-button " ng-class="{disabled: disabled}">
                    <i class="glyphicon glyphicon-plus"></i>
                    <span>Adicionar foto</span>
                    <input type="file" name="files" multiple="multiple" ng-disabled="disabled">
                </span>
                <button type="button" class="btn btn-primary start" data-ng-click="submit()">
                    <i class="glyphicon glyphicon-upload"></i>
                    <span>Iniciar upload</span>
                </button> 
                <button type="button" class="btn btn-warning cancel" data-ng-click="cancel()">
                    <i class="glyphicon glyphicon-ban-circle"></i>
                    <span>Cancelar</span>
                </button>
                <!-- The global file processing state -->
                <span class="fileupload-process"></span>
            </div>
            <!-- The global progress state -->
            <div class="col-lg-5 fade" data-ng-class="{in: active()}">
                <!-- The global progress bar -->
                <div class="progress progress-striped active" data-file-upload-progress="progress()"><div class="progress-bar progress-bar-success" data-ng-style="{width: num + '%'}"></div></div>
                <!-- The extended global progress state -->
                <div class="progress-extended">&nbsp;</div>
            </div>
        </div>
        <!-- The table listing the files available for upload/download -->
        <table class="table table-striped files ng-cloak">
            <tr data-ng-repeat="file in queue" data-ng-class="{'processing': file.$processing()}">
                <td data-ng-switch data-on="!!file.thumbnailUrl">
                    <div class="preview" data-ng-switch-when="true">
                        <a data-ng-href="{{file.url}}" title="{{file.name}}" download="{{file.name}}" data-gallery>
                        	<img data-ng-src="{{file.thumbnailUrl}}" alt="">
                        </a>
                    </div>
                    <div class="preview" data-ng-switch-default data-file-upload-preview="file"></div>
                </td>
                <td>
                    <p class="name" data-ng-switch data-on="!!file.url">
                        <span data-ng-switch-when="true" data-ng-switch data-on="!!file.thumbnailUrl">
                            {{file.name}}
                            <!-- <a data-ng-switch-default data-ng-href="{{file.url}}" title="{{file.name}}" download="{{file.name}}">{{file.name}}</a> -->
                        </span>
                        <span data-ng-switch-default>{{file.name}}</span>
                    </p>
                    <strong data-ng-show="file.error" class="error text-danger">{{file.error}}</strong>
                </td>
                <td>
                    <p class="size">{{file.size | formatFileSize}}</p>
                    <div class="progress progress-striped active fade" data-ng-class="{pending: 'in'}[file.$state()]" data-file-upload-progress="file.$progress()"><div class="progress-bar progress-bar-success" data-ng-style="{width: num + '%'}"></div></div>
                </td>
                <td>
                    <button type="button" class="btn btn-primary start" data-ng-click="file.$submit()" data-ng-hide="!file.$submit || options.autoUpload" data-ng-disabled="file.$state() == 'pending' || file.$state() == 'rejected'">
                        <i class="glyphicon glyphicon-upload"></i>
                        
                    </button>
                    <button type="button" class="btn btn-warning cancel" data-ng-click="file.$cancel()" data-ng-hide="!file.$cancel">
                        <i class="glyphicon glyphicon-ban-circle"></i>
                        
                    </button>
                    <button data-ng-controller="FileDestroyController" type="button" class="btn btn-danger destroy" data-ng-click="file.$destroy()" data-ng-hide="!file.$destroy">
                        <i class="glyphicon glyphicon-trash"></i>
                        
                    </button>
                </td>
            </tr>
        </table>
</form>
</div><!-- col-md-4 -->

</div>

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

<script src="<?php echo URL?>util/jquery-file-upload/angular.min.js"></script>
<script src="<?php echo URL?>util/jquery-file-upload/main.js"></script>
<!-- The jQuery UI widget factory, can be omitted if jQuery UI is already included -->
<script src="<?php echo URL?>util/jquery-file-upload/jquery.ui.widget.js"></script>
<!-- The Load Image plugin is included for the preview images and image resizing functionality -->
<script src="<?php echo URL?>util/jquery-file-upload/load-image.all.min.js"></script>
<!-- The Canvas to Blob plugin is included for image resizing functionality -->
<script src="<?php echo URL?>util/jquery-file-upload/canvas-to-blob.min.js"></script>

<!-- blueimp Gallery script -->
<script src="<?php echo URL?>util/jquery-file-upload/jquery.blueimp-gallery.min.js"></script>
<!-- The Iframe Transport is required for browsers without support for XHR file uploads -->
<script src="<?php echo URL?>util/jquery-file-upload/jquery.iframe-transport.js"></script>
<!-- The basic File Upload plugin -->
<script src="<?php echo URL?>util/jquery-file-upload/jquery.fileupload.js"></script>
<!-- The File Upload processing plugin -->
<script src="<?php echo URL?>util/jquery-file-upload/jquery.fileupload-process.js"></script>
<!-- The File Upload image preview & resize plugin -->
<script src="<?php echo URL?>util/jquery-file-upload/jquery.fileupload-image.js"></script>
<!-- The File Upload audio preview plugin -->
<script src="<?php echo URL?>util/jquery-file-upload/jquery.fileupload-audio.js"></script>
<!-- The File Upload video preview plugin -->
<script src="<?php echo URL?>util/jquery-file-upload/jquery.fileupload-video.js"></script>
<!-- The File Upload validation plugin -->
<script src="<?php echo URL?>util/jquery-file-upload/jquery.fileupload-validate.js"></script>
<!-- The File Upload Angular JS module -->
<script src="<?php echo URL?>util/jquery-file-upload/jquery.fileupload-angular.js"></script>
<!-- The main application script -->
<script src="<?php echo URL?>util/jquery-file-upload/app.js"></script>