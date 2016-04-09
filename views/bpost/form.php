
<!-- Page Heading -->
<div class="row">
<div class="col-lg-12">
<h1 class="page-header"><?php echo $this->title; ?></h1>
<ol class="breadcrumb">
<li><a href="<?php echo URL; ?>">Home</a></li>
<li><a href="<?php echo URL; ?>bpost"><?php echo $this->title; ?></a></li>
<li class="active"><?php echo $this->title; ?></li>
</ol>
</div>
</div>
<!-- /.row -->
<form id="form1" name="form1" method="post" action="<?php echo URL;?>bpost/<?php echo $this->action;?>/">

<div class="row">

<div class="col-md-6 col-sm-6 col-lg-6">
<input type="hidden" name="idBpost" value="<?=$this->obj->getId_bpost()?>" />

<div class="form-group">
	<label for="id_bpost">Id_bpost</label> 
		<input type="text" name="id_bpost" id="id_bpost"  class="form-control" required="required" value="<?=$this->obj->getId_bpost()?>" />
</div>

<div class="form-group">
	<label for="title">Title</label> 
		<input type="text" name="title" id="title"  class="form-control" required="required" value="<?=$this->obj->getTitle()?>" />
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
	<label for="views">Views</label> 
		<input type="text" name="views" id="views"  class="form-control" required="required" value="<?=$this->obj->getViews()?>" />
</div>

<div class="form-group">
	<label for="status">Status</label> 
		<input type="text" name="status" id="status"  class="form-control" required="required" value="<?=$this->obj->getStatus()?>" />
</div>

<div class="form-group">
	<label for="id_bcomment">Id_bcomment</label> 
		<input type="text" name="id_bcomment" id="id_bcomment"  class="form-control" required="required" value="<?=$this->obj->getId_bcomment()?>" />
</div>

<div class="form-group">
	<label for="id_bcategory">Id_bcategory</label> 
		<input type="text" name="id_bcategory" id="id_bcategory"  class="form-control" required="required" value="<?=$this->obj->getId_bcategory()?>" />
</div>

<div class="form-group">
	<input type="submit" name="salvar" id="salvar" value="Salvar" class="btn btn-success" />
	<a href="<?php echo URL; ?>bpost" class="btn btn-info">Cancelar</a>
</div>


</div>
</div>

</form>