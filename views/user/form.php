
<!-- Page Heading -->
<div class="row">
	<div class="col-lg-12">
		<h1 class="page-header"><?php echo $this->title; ?></h1>
		<ol class="breadcrumb">
			<li><a href="<?php echo URL; ?>">Home</a></li>
			<li><a href="<?php echo URL; ?>user"><?php echo $this->title; ?></a></li>
			<li class="active"><?php echo $this->title; ?></li>
		</ol>
	</div>
</div>
<!-- /.row -->

<form id="form1" name="form1" method="post" action="<?php echo URL;?>user/<?php echo $this->action;?>/" class="form-horizontal">

<div class="row">

<div class="col-md-6 col-sm-6 col-lg-6">
<input type="hidden" name="idUser" value="<?=$this->obj->getId_user()?>" />

<div class="form-group">
	<label for="name" class="col-sm-2 control-label">Name</label> 
	<div class="col-sm-10"> 
		<input type="text" name="name" id="name"  class="form-control" required="required" value="<?=$this->obj->getName()?>" />
	</div>
</div>

<div class="form-group">
	<label for="login" class="col-sm-2 control-label">Login</label> 
	<div class="col-sm-10"> 
		<input type="text" name="login" id="login"  class="form-control" required="required" value="<?=$this->obj->getLogin()?>" />
	</div>
</div>

<div class="form-group">
	<label for="password" class="col-sm-2 control-label">Password</label> 
	<div class="col-sm-10"> 
		<input type="text" name="password" id="password"  class="form-control" required="required" value="<?=$this->obj->getPassword()?>" />
	</div>
</div>

<div class="form-group">
	<label for="email" class="col-sm-2 control-label">Email</label> 
	<div class="col-sm-10"> 
		<input type="text" name="email" id="email"  class="form-control" required="required" value="<?=$this->obj->getEmail()?>" />
	</div>
</div>

<div class="form-group">
	<label for="website" class="col-sm-2 control-label">Website</label> 
	<div class="col-sm-10"> 
		<input type="text" name="website" id="website"  class="form-control" required="required" value="<?=$this->obj->getWebsite()?>" />
	</div>
</div>

<div class="form-group">
	<label for="bio" class="col-sm-2 control-label">Bio</label> 
	<div class="col-sm-10"> 
		<input type="text" name="bio" id="bio"  class="form-control" required="required" value="<?=$this->obj->getBio()?>" />
	</div>
</div>

<div class="form-group">
	<label for="numlogin" class="col-sm-2 control-label">Numlogin</label> 
	<div class="col-sm-10"> 
		<input type="text" name="numlogin" id="numlogin"  class="form-control" required="required" value="<?=$this->obj->getNumlogin()?>" />
	</div>
</div>

<div class="form-group">
	<label for="date" class="col-sm-2 control-label">Date</label> 
	<div class="col-sm-10"> 
		<input type="text" name="date" id="date"  class="form-control" required="required" value="<?=$this->obj->getDate()?>" />
	</div>
</div>

<div class="form-group">
	<label for="linguage" class="col-sm-2 control-label">Linguage</label> 
	<div class="col-sm-10"> 
		<input type="text" name="linguage" id="linguage"  class="form-control" required="required" value="<?=$this->obj->getLinguage()?>" />
	</div>
</div>

<div class="form-group">
	<label for="id_typeuser" class="col-sm-2 control-label">Id_typeuser</label> 
	<div class="col-sm-10"> 
	<select name="id_typeuser" id="id_typeuser"  class="form-control" required="required">
		<option value=""></option>
	</select>
	</div>
</div>

<div class="form-group">
	<label for="lastlogin" class="col-sm-2 control-label">Lastlogin</label> 
	<div class="col-sm-10"> 
		<input type="text" name="lastlogin" id="lastlogin"  class="form-control" required="required" value="<?=$this->obj->getLastlogin()?>" />
	</div>
</div>

<div class="form-group">
	<label for="status" class="col-sm-2 control-label">Status</label> 
	<div class="col-sm-10"> 
		<input type="text" name="status" id="status"  class="form-control" required="required" value="<?=$this->obj->getStatus()?>" />
	</div>
</div>

<div class="form-group">
	<div class="col-sm-10  col-sm-offset-2">
		<input type="submit" name="salvar" id="salvar" value="Salvar" class="btn btn-success" />
		<a href="<?php echo URL; ?>user" class="btn btn-info">Cancelar</a>
	</div>
</div>


</div>
</div>

</form>