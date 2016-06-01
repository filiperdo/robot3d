
<!-- Page Heading -->
<div class="row">
	<div class="col-lg-12">
		<h1 class="page-header"><?php echo $this->title; ?></h1>
		<ol class="breadcrumb">
			<li><a href="<?php echo URL; ?>">Home</a></li>
			<li><a href="<?php echo URL; ?>datalog"><?php echo $this->title; ?></a></li>
			<li class="active"><?php echo $this->title; ?></li>
		</ol>
	</div>
</div>
<!-- /.row -->

<form id="form1" name="form1" method="post" action="<?php echo URL;?>datalog/<?php echo $this->action;?>/" class="form-horizontal">

<div class="row">

<div class="col-md-6 col-sm-6 col-lg-6">
<input type="hidden" name="idDatalog" value="<?=$this->obj->getId_datalog()?>" />

<div class="form-group">
	<label for="date" class="col-sm-2 control-label">Date</label> 
	<div class="col-sm-10"> 
		<input type="text" name="date" id="date"  class="form-control" required="required" value="<?=$this->obj->getDate()?>" />
	</div>
</div>

<div class="form-group">
	<label for="user_id_user" class="col-sm-2 control-label">User_id_user</label> 
	<div class="col-sm-10"> 
		<input type="text" name="user_id_user" id="user_id_user"  class="form-control" required="required" value="<?=$this->obj->getUser_id_user()?>" />
	</div>
</div>

<div class="form-group">
	<label for="id_post" class="col-sm-2 control-label">Id_post</label> 
	<div class="col-sm-10"> 
	<select name="id_post" id="id_post"  class="form-control" required="required">
		<option value=""></option>
	</select>
	</div>
</div>

<div class="form-group">
	<label for="id_project" class="col-sm-2 control-label">Id_project</label> 
	<div class="col-sm-10"> 
	<select name="id_project" id="id_project"  class="form-control" required="required">
		<option value=""></option>
	</select>
	</div>
</div>

<div class="form-group">
	<label for="id_item" class="col-sm-2 control-label">Id_item</label> 
	<div class="col-sm-10"> 
	<select name="id_item" id="id_item"  class="form-control" required="required">
		<option value=""></option>
	</select>
	</div>
</div>

<div class="form-group">
	<div class="col-sm-10  col-sm-offset-2">
		<input type="submit" name="salvar" id="salvar" value="Salvar" class="btn btn-success" />
		<a href="<?php echo URL; ?>datalog" class="btn btn-info">Cancelar</a>
	</div>
</div>


</div>
</div>

</form>