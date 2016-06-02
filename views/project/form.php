
<!-- Page Heading -->
<div class="row">
	<div class="col-lg-12">
		<h1 class="page-header"><?php echo $this->title; ?></h1>
		<ol class="breadcrumb">
			<li><a href="<?php echo URL; ?>">Home</a></li>
			<li><a href="<?php echo URL; ?>project"><?php echo $this->title; ?></a></li>
			<li class="active"><?php echo $this->title; ?></li>
		</ol>
	</div>
</div>
<!-- /.row -->

<form id="form1" name="form1" method="post" action="<?php echo URL;?>project/<?php echo $this->action;?>/" class="form-horizontal">

<div class="row">

<div class="col-md-6 col-sm-6 col-lg-6">
<input type="hidden" name="idProject" value="<?=$this->obj->getId_project()?>" />

<div class="form-group">
	<label for="title" class="col-sm-2 control-label">Title</label> 
	<div class="col-sm-10"> 
		<input type="text" name="title" id="title"  class="form-control" required="required" value="<?=$this->obj->getTitle()?>" />
	</div>
</div>

<div class="form-group">
	<label for="website" class="col-sm-2 control-label">Website</label> 
	<div class="col-sm-10"> 
		<input type="text" name="website" id="website"  class="form-control" required="required" value="<?=$this->obj->getWebsite()?>" />
	</div>
</div>

<div class="form-group">
	<label for="link_image" class="col-sm-2 control-label">Link_image</label> 
	<div class="col-sm-10"> 
		<input type="text" name="link_image" id="link_image"  class="form-control" required="required" value="<?=$this->obj->getLink_image()?>" />
	</div>
</div>

<div class="form-group">
	<label for="content" class="col-sm-2 control-label">Content</label> 
	<div class="col-sm-10"> 
		<input type="text" name="content" id="content"  class="form-control" required="required" value="<?=$this->obj->getContent()?>" />
	</div>
</div>

<div class="form-group">
	<label for="level" class="col-sm-2 control-label">Level</label> 
	<div class="col-sm-10"> 
		<input type="text" name="level" id="level"  class="form-control" required="required" value="<?=$this->obj->getLevel()?>" />
	</div>
</div>

<div class="form-group">
	<div class="col-sm-10  col-sm-offset-2">
		<input type="submit" name="salvar" id="salvar" value="Salvar" class="btn btn-success" />
		<a href="<?php echo URL; ?>project/lista" class="btn btn-info">Cancelar</a>
	</div>
</div>


</div>
</div>

</form>