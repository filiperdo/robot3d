
<!-- Page Heading -->
<div class="row">
<div class="col-lg-12">
<h1 class="page-header"><?php echo $this->title; ?></h1>
<ol class="breadcrumb">
<li><a href="<?php echo URL; ?>">Home</a></li>
<li><a href="<?php echo URL; ?>post_category"><?php echo $this->title; ?></a></li>
<li class="active"><?php echo $this->title; ?></li>
</ol>
</div>
</div>
<!-- /.row -->
<form id="form1" name="form1" method="post" action="<?php echo URL;?>post_category/<?php echo $this->action;?>/">

<div class="row">

<div class="col-md-6 col-sm-6 col-lg-6">
<input type="hidden" name="idPost_category" value="<?=$this->obj->getId_post_category()?>" />

<div class="form-group">
	<label for="id_post">Id_post</label> 
		<input type="text" name="id_post" id="id_post"  class="form-control" required="required" value="<?=$this->obj->getId_post()?>" />
</div>

<div class="form-group">
	<label for="id_category">Id_category</label> 
		<input type="text" name="id_category" id="id_category"  class="form-control" required="required" value="<?=$this->obj->getId_category()?>" />
</div>

<div class="form-group">
	<input type="submit" name="salvar" id="salvar" value="Salvar" class="btn btn-success" />
	<a href="<?php echo URL; ?>post_category" class="btn btn-info">Cancelar</a>
</div>


</div>
</div>

</form>