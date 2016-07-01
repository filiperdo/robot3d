
<!-- Page Heading -->
<div class="row">
	<div class="col-lg-12">
		<h1 class="page-header"><?php echo $this->title; ?></h1>
		<ol class="breadcrumb">
			<li><a href="<?php echo URL; ?>">Home</a></li>
			<li><a href="<?php echo URL; ?>alert"><?php echo $this->title; ?></a></li>
			<li class="active"><?php echo $this->title; ?></li>
		</ol>
	</div>
</div>
<!-- /.row -->

<form id="form1" name="form1" method="post" action="<?php echo URL;?>alert/<?php echo $this->action;?>/" class="form-horizontal">

<div class="row">

<div class="col-md-6 col-sm-6 col-lg-6">
<input type="hidden" name="idAlert" value="<?=$this->obj->getId_alert()?>" />

<div class="form-group">
	<label for="id_notify" class="col-sm-2 control-label">Id_notify</label> 
	<div class="col-sm-10"> 
	<select name="id_notify" id="id_notify"  class="form-control" required="required">
		<option value=""></option>
	</select>
	</div>
</div>

<div class="form-group">
	<label for="id_user" class="col-sm-2 control-label">Id_user</label> 
	<div class="col-sm-10"> 
	<select name="id_user" id="id_user"  class="form-control" required="required">
		<option value=""></option>
	</select>
	</div>
</div>

<div class="form-group">
	<label for="read" class="col-sm-2 control-label">Read</label> 
	<div class="col-sm-10"> 
		<input type="text" name="read" id="read"  class="form-control" required="required" value="<?=$this->obj->getRead()?>" />
	</div>
</div>

<div class="form-group">
	<label for="date" class="col-sm-2 control-label">Date</label> 
	<div class="col-sm-10"> 
		<input type="text" name="date" id="date"  class="form-control" required="required" value="<?=$this->obj->getDate()?>" />
	</div>
</div>

<div class="form-group">
	<div class="col-sm-10  col-sm-offset-2">
		<input type="submit" name="salvar" id="salvar" value="Salvar" class="btn btn-success" />
		<a href="<?php echo URL; ?>alert" class="btn btn-info">Cancelar</a>
	</div>
</div>


</div>
</div>

</form>