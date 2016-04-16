
<!-- Page Heading -->
<div class="row">
<div class="col-lg-12">
<h1 class="page-header"><?php echo $this->title; ?></h1>
<ol class="breadcrumb">
<li><a href="<?php echo URL; ?>">Home</a></li>
<li><a href="<?php echo URL; ?>item"><?php echo $this->title; ?></a></li>
<li class="active"><?php echo $this->title; ?></li>
</ol>
</div>
</div>
<!-- /.row -->
<form id="form1" name="form1" method="post" action="<?php echo URL;?>item/<?php echo $this->action;?>/">

<div class="row">

<div class="col-md-6 col-sm-6 col-lg-6">
<input type="hidden" name="idItem" value="<?=$this->obj->getId_item()?>" />

<div class="form-group">
	<label for="id_item">Id_item</label> 
		<input type="text" name="id_item" id="id_item"  class="form-control" required="required" value="<?=$this->obj->getId_item()?>" />
</div>

<div class="form-group">
	<label for="views">Views</label> 
		<input type="text" name="views" id="views"  class="form-control" required="required" value="<?=$this->obj->getViews()?>" />
</div>

<div class="form-group">
	<label for="content">Content</label> 
		<input type="text" name="content" id="content"  class="form-control" required="required" value="<?=$this->obj->getContent()?>" />
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
	<label for="id_topic">Id_topic</label> 
		<input type="text" name="id_topic" id="id_topic"  class="form-control" required="required" value="<?=$this->obj->getId_topic()?>" />
</div>

<div class="form-group">
	<input type="submit" name="salvar" id="salvar" value="Salvar" class="btn btn-success" />
	<a href="<?php echo URL; ?>item" class="btn btn-info">Cancelar</a>
</div>


</div>
</div>

</form>