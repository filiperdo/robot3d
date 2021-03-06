
<!-- Page Heading -->
<div class="row">
	<div class="col-lg-12">
		<h1 class="page-header"><?php echo $this->title; ?></h1>
		<ol class="breadcrumb">
			<li><a href="<?php echo URL; ?>">Home</a></li>
			<li><a href="<?php echo URL; ?>topic"><?php echo $this->title; ?></a></li>
			<li class="active"><?php echo $this->title; ?></li>
		</ol>
	</div>
</div>
<!-- /.row -->

<form id="form1" name="form1" method="post" action="<?php echo URL;?>topic/<?php echo $this->action;?>/" class="form-horizontal">

<div class="row">

<div class="col-md-6 col-sm-6 col-lg-6">
<input type="hidden" name="idTopic" value="<?=$this->obj->getId_topic()?>" />

<div class="form-group">
	<label for="name" class="col-sm-2 control-label">Name</label> 
	<div class="col-sm-10"> 
		<input type="text" name="name" id="name"  class="form-control" required="required" value="<?=$this->obj->getName()?>" />
	</div>
</div>

<div class="form-group">
	<label for="description" class="col-sm-2 control-label">Description</label> 
	<div class="col-sm-10"> 
		<input type="text" name="description" id="description"  class="form-control" required="required" value="<?=$this->obj->getDescription()?>" />
	</div>
</div>

<div class="form-group">
	<label for="id_subject" class="col-sm-2 control-label">Id_subject</label> 
	<div class="col-sm-10"> 
	<select name="id_subject" id="id_subject"  class="form-control" required="required">
		<option value=""></option>
	</select>
	</div>
</div>

<div class="form-group">
	<div class="col-sm-10  col-sm-offset-2">
		<input type="submit" name="salvar" id="salvar" value="Salvar" class="btn btn-success" />
		<a href="<?php echo URL; ?>topic" class="btn btn-info">Cancelar</a>
	</div>
</div>


</div>
</div>

</form>