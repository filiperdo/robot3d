
<!-- Page Heading -->
<div class="row">
<div class="col-lg-12">
<h1 class="page-header"><?php echo $this->title; ?></h1>
<ol class="breadcrumb">
<li><a href="<?php echo URL; ?>">Home</a></li>
<li><a href="<?php echo URL; ?>ftopic"><?php echo $this->title; ?></a></li>
<li class="active"><?php echo $this->title; ?></li>
</ol>
</div>
</div>
<!-- /.row -->
<form id="form1" name="form1" method="post" action="<?php echo URL;?>ftopic/<?php echo $this->action;?>/">

<div class="row">

<div class="col-md-6 col-sm-6 col-lg-6">
<input type="hidden" name="idFtopic" value="<?=$this->obj->getId_ftopic()?>" />

<div class="form-group">
	<label for="id_ftopic">Id_ftopic</label> 
		<input type="text" name="id_ftopic" id="id_ftopic"  class="form-control" required="required" value="<?=$this->obj->getId_ftopic()?>" />
</div>

<div class="form-group">
	<label for="name">Name</label> 
		<input type="text" name="name" id="name"  class="form-control" required="required" value="<?=$this->obj->getName()?>" />
</div>

<div class="form-group">
	<label for="description">Description</label> 
		<input type="text" name="description" id="description"  class="form-control" required="required" value="<?=$this->obj->getDescription()?>" />
</div>

<div class="form-group">
	<label for="id_fcategory">Id_fcategory</label> 
		<input type="text" name="id_fcategory" id="id_fcategory"  class="form-control" required="required" value="<?=$this->obj->getId_fcategory()?>" />
</div>

<div class="form-group">
	<input type="submit" name="salvar" id="salvar" value="Salvar" class="btn btn-success" />
	<a href="<?php echo URL; ?>ftopic" class="btn btn-info">Cancelar</a>
</div>


</div>
</div>

</form>