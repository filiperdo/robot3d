
<!-- Page Heading -->
<div class="row">
	<div class="col-lg-12">
		<h1 class="page-header"><?php echo $this->title; ?></h1>
		<ol class="breadcrumb">
			<li><a href="<?php echo URL; ?>">Home</a></li>
			<li><a href="<?php echo URL; ?>project_category"><?php echo $this->title; ?></a></li>
			<li class="active"><?php echo $this->title; ?></li>
		</ol>
	</div>
</div>
<!-- /.row -->

<form id="form1" name="form1" method="post" action="<?php echo URL;?>project_category/<?php echo $this->action;?>/" class="form-horizontal">

<div class="row">

<div class="col-md-6 col-sm-6 col-lg-6">
<input type="hidden" name="idProject_category" value="<?=$this->obj->getId_project_category()?>" />

<div class="form-group">
	<label for="id_project" class="col-sm-2 control-label">Id_project</label> 
	<div class="col-sm-10"> 
	<select name="id_project" id="id_project"  class="form-control" required="required">
		<option value=""></option>
	</select>
	</div>
</div>

<div class="form-group">
	<label for="id_category" class="col-sm-2 control-label">Id_category</label> 
	<div class="col-sm-10"> 
	<select name="id_category" id="id_category"  class="form-control" required="required">
		<option value=""></option>
	</select>
	</div>
</div>

<div class="form-group">
	<div class="col-sm-10  col-sm-offset-2">
		<input type="submit" name="salvar" id="salvar" value="Salvar" class="btn btn-success" />
		<a href="<?php echo URL; ?>project_category" class="btn btn-info">Cancelar</a>
	</div>
</div>


</div>
</div>

</form>