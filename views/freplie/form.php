
<!-- Page Heading -->
<div class="row">
<div class="col-lg-12">
<h1 class="page-header"><?php echo $this->title; ?></h1>
<ol class="breadcrumb">
<li><a href="<?php echo URL; ?>">Home</a></li>
<li><a href="<?php echo URL; ?>freplie"><?php echo $this->title; ?></a></li>
<li class="active"><?php echo $this->title; ?></li>
</ol>
</div>
</div>
<!-- /.row -->
<form id="form1" name="form1" method="post" action="<?php echo URL;?>freplie/<?php echo $this->action;?>/">

<div class="row">

<div class="col-md-6 col-sm-6 col-lg-6">
<input type="hidden" name="idFreplie" value="<?=$this->obj->getId_freplie()?>" />

<div class="form-group">
	<label for="id_freplie">Id_freplie</label> 
		<input type="text" name="id_freplie" id="id_freplie"  class="form-control" required="required" value="<?=$this->obj->getId_freplie()?>" />
</div>

<div class="form-group">
	<label for="content">Content</label> 
		<input type="text" name="content" id="content"  class="form-control" required="required" value="<?=$this->obj->getContent()?>" />
</div>

<div class="form-group">
	<label for="id_fpost">Id_fpost</label> 
		<input type="text" name="id_fpost" id="id_fpost"  class="form-control" required="required" value="<?=$this->obj->getId_fpost()?>" />
</div>

<div class="form-group">
	<label for="freplie_id_freplie">Freplie_id_freplie</label> 
		<input type="text" name="freplie_id_freplie" id="freplie_id_freplie"  class="form-control" required="required" value="<?=$this->obj->getFreplie_id_freplie()?>" />
</div>

<div class="form-group">
	<input type="submit" name="salvar" id="salvar" value="Salvar" class="btn btn-success" />
	<a href="<?php echo URL; ?>freplie" class="btn btn-info">Cancelar</a>
</div>


</div>
</div>

</form>