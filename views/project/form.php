
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
<form id="form1" name="form1" method="post" action="<?php echo URL;?>project/<?php echo $this->action;?>/">

<div class="row">

<div class="col-md-6 col-sm-6 col-lg-6">
<input type="hidden" name="idProject" value="<?=$this->obj->getId_project()?>" />

<div class="form-group">
	<label for="id_project">Id_project</label> 
		<input type="text" name="id_project" id="id_project"  class="form-control" required="required" value="<?=$this->obj->getId_project()?>" />
</div>

<div class="form-group">
	<label for="name">Name</label> 
		<input type="text" name="name" id="name"  class="form-control" required="required" value="<?=$this->obj->getName()?>" />
</div>

<div class="form-group">
	<label for="website">Website</label> 
		<input type="text" name="website" id="website"  class="form-control" required="required" value="<?=$this->obj->getWebsite()?>" />
</div>

<div class="form-group">
	<label for="link_image">Link_image</label> 
		<input type="text" name="link_image" id="link_image"  class="form-control" required="required" value="<?=$this->obj->getLink_image()?>" />
</div>

<div class="form-group">
	<label for="description">Description</label> 
		<input type="text" name="description" id="description"  class="form-control" required="required" value="<?=$this->obj->getDescription()?>" />
</div>

<div class="form-group">
	<label for="level">Level</label> 
		<input type="text" name="level" id="level"  class="form-control" required="required" value="<?=$this->obj->getLevel()?>" />
</div>

<div class="form-group">
	<label for="date">Date</label> 
		<input type="text" name="date" id="date"  class="form-control" required="required" value="<?=$this->obj->getDate()?>" />
</div>

<div class="form-group">
	<label for="id_user">Id_user</label> 
		<input type="text" name="id_user" id="id_user"  class="form-control" required="required" value="<?=$this->obj->getId_user()?>" />
</div>

<div class="form-group">
	<input type="submit" name="salvar" id="salvar" value="Salvar" class="btn btn-success" />
	<a href="<?php echo URL; ?>project" class="btn btn-info">Cancelar</a>
</div>


</div>
</div>

</form>