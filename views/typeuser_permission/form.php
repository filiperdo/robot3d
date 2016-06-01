
<!-- Page Heading -->
<div class="row">
	<div class="col-lg-12">
		<h1 class="page-header"><?php echo $this->title; ?></h1>
		<ol class="breadcrumb">
			<li><a href="<?php echo URL; ?>">Home</a></li>
			<li><a href="<?php echo URL; ?>typeuser_permission"><?php echo $this->title; ?></a></li>
			<li class="active"><?php echo $this->title; ?></li>
		</ol>
	</div>
</div>
<!-- /.row -->

<form id="form1" name="form1" method="post" action="<?php echo URL;?>typeuser_permission/<?php echo $this->action;?>/" class="form-horizontal">

<div class="row">

<div class="col-md-6 col-sm-6 col-lg-6">
<input type="hidden" name="idTypeuser_permission" value="<?=$this->obj->getId_typeuser_permission()?>" />

<div class="form-group">
	<label for="id_typeuser" class="col-sm-2 control-label">Id_typeuser</label> 
	<div class="col-sm-10"> 
	<select name="id_typeuser" id="id_typeuser"  class="form-control" required="required">
		<option value=""></option>
	</select>
	</div>
</div>

<div class="form-group">
	<label for="id_permission" class="col-sm-2 control-label">Id_permission</label> 
	<div class="col-sm-10"> 
	<select name="id_permission" id="id_permission"  class="form-control" required="required">
		<option value=""></option>
	</select>
	</div>
</div>

<div class="form-group">
	<div class="col-sm-10  col-sm-offset-2">
		<input type="submit" name="salvar" id="salvar" value="Salvar" class="btn btn-success" />
		<a href="<?php echo URL; ?>typeuser_permission" class="btn btn-info">Cancelar</a>
	</div>
</div>


</div>
</div>

</form>