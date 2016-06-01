
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

<form id="form1" name="form1" method="post" action="<?php echo URL;?>item/<?php echo $this->action;?>/" class="form-horizontal">

<div class="row">

<div class="col-md-6 col-sm-6 col-lg-6">
<input type="hidden" name="idItem" value="<?=$this->obj->getId_item()?>" />

<div class="form-group">
	<label for="views" class="col-sm-2 control-label">Views</label> 
	<div class="col-sm-10"> 
		<input type="text" name="views" id="views"  class="form-control" required="required" value="<?=$this->obj->getViews()?>" />
	</div>
</div>

<div class="form-group">
	<label for="content" class="col-sm-2 control-label">Content</label> 
	<div class="col-sm-10"> 
		<input type="text" name="content" id="content"  class="form-control" required="required" value="<?=$this->obj->getContent()?>" />
	</div>
</div>

<div class="form-group">
	<label for="date" class="col-sm-2 control-label">Date</label> 
	<div class="col-sm-10"> 
		<input type="text" name="date" id="date"  class="form-control" required="required" value="<?=$this->obj->getDate()?>" />
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
	<label for="id_topic" class="col-sm-2 control-label">Id_topic</label> 
	<div class="col-sm-10"> 
	<select name="id_topic" id="id_topic"  class="form-control" required="required">
		<option value=""></option>
	</select>
	</div>
</div>

<div class="form-group">
	<div class="col-sm-10  col-sm-offset-2">
		<input type="submit" name="salvar" id="salvar" value="Salvar" class="btn btn-success" />
		<a href="<?php echo URL; ?>item" class="btn btn-info">Cancelar</a>
	</div>
</div>


</div>
</div>

</form>