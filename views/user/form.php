<div class="hl">
	<ul class="ca qo anx">
		<li class="qf b aml row">
			<ol class="breadcrumb">
			  <li><a href="<?php echo URL?>">Home</a></li>
			  <li><a href="<?php echo URL?>user/dashboard/<?php echo base64_encode( Session::get('userid') );?>">Dashboard</a></li>
			  <li>Editar perfil</li>
			</ol>

			<div class="row">
				<div class="col-md-12">
					<?php if (isset($_GET["st"])) { $objAlert = new Alerta($_GET["st"]); } ?>

					<div class="row">
						<form id="form1" name="form1" method="post" action="<?php echo URL;?>user/<?php echo $this->action;?>/" class="form-horizontal">
							<div class="col-md-6">

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
										<input type="text" name="login" id="login"  class="form-control" disabled="disabled" value="<?=$this->obj->getLogin()?>" />
									</div>
								</div>

								<div class="form-group">
									<label for="login" class="col-sm-2 control-label">Senha</label>
									<div class="col-sm-6">
										<input type="password" name="password" id="password"  class="form-control" disabled="disabled" value="<?=$this->obj->getPassword()?>" />
									</div>
									<div class="col-sm-3">
										<a id="btn-editar-senha" class="btn btn-warning">Alterar senha</a>
									</div>
								</div>

								<div class="form-group">
									<label for="email" class="col-sm-2 control-label">Email</label>
									<div class="col-sm-10">
										<input type="text" name="email" id="email"  class="form-control" required="required" value="<?=$this->obj->getEmail()?>" />
									</div>
								</div>

								<div class="form-group">
									<label for="bio" class="col-sm-2 control-label">Bio</label>
									<div class="col-sm-10">
										<textarea rows="3" name="bio" class="form-control" cols=""><?=$this->obj->getBio()?></textarea>
									</div>
								</div>

								<div class="form-group">
									<label for="linguage" class="col-sm-2 control-label">Linguage</label>
									<div class="col-sm-10">

										<select name="linguage" class="form-control">
											<option value="PT" <?php if( $this->obj->getLinguage() == 'PT' ) { ?> selected="selected" <?php } ?>>PT</option>
											<option value="EN" <?php if( $this->obj->getLinguage() == 'EN' ) { ?> selected="selected" <?php } ?>>EN</option>
										</select>

									</div>
								</div>

								<div class="form-group">
									<div class="col-sm-10  col-sm-offset-2">
										<input type="submit" name="salvar" id="salvar" value="Salvar" class="btn btn-success" />
										<a href="<?php echo URL; ?>user/dashboard/<?php echo base64_encode( Session::get('userid') );?>" class="btn btn-info">Cancelar</a>
									</div>
								</div>

							</div><!-- col-md-6 -->

							<div class="col-md-6">

								<fieldset>
									<legend>Minhas redes sociais</legend>
									<div class="form-group">
										<label for="website" class="col-sm-2 control-label">Website</label>
										<div class="col-sm-10">
											<input type="text" name="website" id="website"  class="form-control"  value="<?=$this->obj->getWebsite()?>" />
										</div>
									</div>

									<div class="form-group">
										<label for="github" class="col-sm-2 control-label">GitHub</label>
										<div class="col-sm-10">
											<input type="text" name="github" id="github"  class="form-control"  value="<?=$this->obj->getGithub()?>" />
										</div>
									</div>

									<div class="form-group">
										<label for="facebook" class="col-sm-2 control-label">Facebook</label>
										<div class="col-md-10 col-sm-10 col-xs-12">
											<input type="text" name="facebook" id="facebook"  class="form-control" value="<?=$this->obj->getFacebook()?>" />
										</div>
									</div>

									<div class="form-group">
										<label for="twitter" class="col-sm-2 control-label">Twitter</label>
										<div class="col-md-10 col-sm-10 col-xs-12">
											<input type="text" name="twitter" id="twitter"  class="form-control"  value="<?=$this->obj->getTwitter()?>" />
										</div>
									</div>

									<div class="form-group">
										<label for="youtube" class="col-sm-2 control-label">Youtube</label>
										<div class="col-md-10 col-sm-10 col-xs-12">
											<input type="text" name="youtube" id="youtube"  class="form-control" value="<?=$this->obj->getYoutube()?>" />
										</div>
									</div>
								</fieldset>
							</div><!-- col-md-6 -->
						</form>
					</div><!-- row -->

					<div class="row">
						<div class="col-md-12">
							<fieldset>
								<legend>Foto do perfil</legend>
								<form name="upimage" id="upimage" method="POST" enctype="multipart/form-data" >

									<!-- O Nome do elemento input determina o nome da array $_FILES -->
									<input name="fileUpload[]" id="fileUpload" multiple="multiple" type="file" required="required" />

									<button class="btn btn-success" type="submit" id="bt-upload" style="margin: 12px 0">Enviar foto</button>
									<a href="<?php echo URL?>/user/delete_fotoperfil" class="btn btn-danger"><i class="glyphicon glyphicon-trash"></i> Deletar</a>
									<!-- <input type="submit" value="Enviar arquivo" /> -->

								</form>

								<div id="output-files">

									<div class="row" style="margin-bottom: 12px">
										<div class="col-md-4"><img alt="" src="<?php echo Data::getPhotoUser( Session::get('userid') ); ?>" width="100%"></div>
										<div class="col-md-6">

										</div>
									</div>

								</div>
							</fieldset>
						</div>

					</div>



				</div>
			</div>
		</li>
	</ul>
</div>

<script src="http://malsup.github.com/jquery.form.js"></script>

<script>

	if( window.location.hostname == 'localhost' )
	{
		var URL = 'http://localhost/robot3d/';
	}
	else
	{
		var URL = 'http://www.robo3d.com.br/';
	}

	// alteracao de senha
	$("#btn-editar-senha").on('click', function(){
		$('#password').removeAttr('disabled');
	});

	var options = {
        //target:        '#output-files',   // target element(s) to be updated with server response
        //beforeSubmit:  showRequest,  // pre-submit callback
        success : showResponse,  // post-submit callback
        url  	: URL + 'user/upload_fotoperfil',
		type 	: 'POST'
        // other available options:
        //dataType:  null        // 'xml', 'script', or 'json' (expected server response type)
        //clearForm: true        // clear all form fields after successful submit
        //resetForm: true        // reset the form after successful submit

        // $.ajax options can be used here too, for example:
        //timeout:   3000
    };

	$("#bt-upload").click( function(){

		$('#upimage').ajaxSubmit(options);

	});

	function showResponse()
	{
		//$("#output-files").html(responseText);
		alert('ok');
		//$('#output-files').load('http://localhost/robot3d/post/teste');
	}

</script>
