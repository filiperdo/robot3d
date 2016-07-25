
    <div class="gz"><!-- gz Coluna do meio -->
      <ul class="ca qo anx">

        <li class="qf b aml">
        
        <h3 class="page-header">Cadastrar</h3>
        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. </p>
        
        <?php if (isset($_GET['st'])) { $objAlerta = new Alerta($_GET['st']); } ?>
        
        <form name="form-login" id="form-login" method="post" action="<?php echo URL?>user/create"  >
        
          <label>E-mail</label>
          <div class="input-group">
          	<div class="fj">
              <button type="button" class="cg fm">
                <span class="glyphicon glyphicon-envelope"></span>
              </button>
            </div>
            <input type="text" class="form-control" name="email" placeholder="email" required="required" value="<?php echo $this->email?>">
            
          </div>
          
          <label>Login</label>
          <div class="input-group">
          	<div class="fj">
              <button type="button" class="cg fm">
                <span class="glyphicon glyphicon-user"></span>
              </button>
            </div>
            <input type="text" class="form-control" name="login" placeholder="Login" required="required" value="<?php echo $this->login?>">
            
          </div>
          
          <!-- <div class="form-group has-error has-feedback">
			  <label class="control-label" for="inputError2">Input with error</label>
			  <input type="text" class="form-control" id="inputError2" aria-describedby="inputError2Status">
			  <span class="glyphicon glyphicon-remove form-control-feedback" aria-hidden="true"></span>
			  <span id="inputError2Status" class="sr-only">(error)</span>
		  </div> -->
          
          <label>Senha</label>
          <div class="input-group">
          	<div class="fj">
              <i class="cg fm">
                <span class="glyphicon glyphicon-asterisk"></span>
              </i>
            </div>
            <input type="password" name="password" id="pass" class="form-control" placeholder="Senha" required="required">
            
          </div>
          
          
          <div class="input-group" style="margin-top: 10px">
          	
            <div class="g-recaptcha" data-sitekey="6LfdryUTAAAAAIldRHtQbtNtc4GFGfJYLPj8w1rG"></div>
            
          </div>
          
          
          <div class="form-group" style="margin-top: 15px">
              <button type="submit" class="cg fp"><i class="h aju"></i> Cadastrar</button>
              <a href="<?php echo URL?>login" class="cg tu"><i class="h aak"></i> Login</a>
          </div>
          
          </form>
          
        </li>
        
      </ul>
    </div><!-- .gz Coluna do meio -->
    
