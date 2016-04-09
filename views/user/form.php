
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
<form id="form1" name="form1" method="post" action="<?php echo URL;?>user/<?php echo $this->action;?>/">

<div class="row">

<div class="col-md-6 col-sm-6 col-lg-6">
<input type="hidden" name="idUser" value="<?=$this->obj->getId_user()?>" />

<div class="form-group">
	<label for="id_user">Id_user</label> 
		<input type="text" name="id_user" id="id_user"  class="form-control" required="required" value="<?=$this->obj->getId_user()?>" />
</div>

<div class="form-group">
	<label for="name">Name</label> 
		<input type="text" name="name" id="name"  class="form-control" required="required" value="<?=$this->obj->getName()?>" />
</div>

<div class="form-group">
	<label for="login">Login</label> 
		<input type="text" name="login" id="login"  class="form-control" required="required" value="<?=$this->obj->getLogin()?>" />
</div>

<div class="form-group">
	<label for="password">Password</label> 
		<input type="text" name="password" id="password"  class="form-control" required="required" value="<?=$this->obj->getPassword()?>" />
</div>

<div class="form-group">
	<label for="email">Email</label> 
		<input type="text" name="email" id="email"  class="form-control" required="required" value="<?=$this->obj->getEmail()?>" />
</div>

<div class="form-group">
	<label for="website">Website</label> 
		<input type="text" name="website" id="website"  class="form-control" required="required" value="<?=$this->obj->getWebsite()?>" />
</div>

<div class="form-group">
	<label for="bio">Bio</label> 
		<input type="text" name="bio" id="bio"  class="form-control" required="required" value="<?=$this->obj->getBio()?>" />
</div>

<div class="form-group">
	<label for="num_login">Num_login</label> 
		<input type="text" name="num_login" id="num_login"  class="form-control" required="required" value="<?=$this->obj->getNum_login()?>" />
</div>

<div class="form-group">
	<label for="date">Date</label> 
		<input type="text" name="date" id="date"  class="form-control" required="required" value="<?=$this->obj->getDate()?>" />
</div>

<div class="form-group">
	<label for="linguage">Linguage</label> 
		<input type="text" name="linguage" id="linguage"  class="form-control" required="required" value="<?=$this->obj->getLinguage()?>" />
</div>

<div class="form-group">
	<input type="submit" name="salvar" id="salvar" value="Salvar" class="btn btn-success" />
	<a href="<?php echo URL; ?>user" class="btn btn-info">Cancelar</a>
</div>


</div>
</div>

</form>