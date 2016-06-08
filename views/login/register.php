
    <div class="gz"><!-- gz Coluna do meio -->
      <ul class="ca qo anx">

        <li class="qf b aml">
        
        <h3 class="page-header">Cadastrar</h3>
        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. </p>
        <form name="form-login" method="post" action="<?php echo URL?>user/create"  >
        
          <label>E-mail</label>
          <div class="input-group">
          	<div class="fj">
              <button type="button" class="cg fm">
                <span class="glyphicon glyphicon-envelope"></span>
              </button>
            </div>
            <input type="text" class="form-control" name="email" placeholder="email" required="required">
            
          </div>
          
          <label>Login</label>
          <div class="input-group">
          	<div class="fj">
              <button type="button" class="cg fm">
                <span class="glyphicon glyphicon-user"></span>
              </button>
            </div>
            <input type="text" class="form-control" name="login" placeholder="Login" required="required">
            
          </div>
          
          <label>Senha</label>
          <div class="input-group">
          	<div class="fj">
              <i  class="cg fm">
                <span class="glyphicon glyphicon-asterisk"></span>
              </i>
            </div>
            <input type="password" name="password" class="form-control" placeholder="Senha" required="required">
            
          </div>
          
          <label>Repetir a Senha</label>
          <div class="input-group">
          	<div class="fj">
              <i  class="cg fm">
                <span class="glyphicon glyphicon-asterisk"></span>
              </i>
            </div>
            <input type="password" name="password" class="form-control" placeholder="Senha" required="required">
          </div>
          
          <div style="margin:10px 0"><?php if (isset($_GET['st'])) { $objAlerta = new Alerta($_GET['st']); } ?></div>
          
          <div class="form-group" >
              <button type="submit" class="cg fp"><i class="h aju"></i> Cadastrar</button>
              <a href="<?php echo URL?>login" class="cg tu"><i class="h aak"></i> Login</a>
              
          </div>
           
          </form>
          
        </li>
        
      </ul>
    </div><!-- .gz Coluna do meio -->
    
    
    
    
