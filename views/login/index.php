
    <div class="gz"><!-- gz Coluna do meio -->
      <ul class="ca qo anx">

        <li class="qf b aml">
        
        <form name="form-login" method="post" action="<?php echo URL?>login/run"  >
        
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
          
          <div style="margin:10px 0"><?php if (isset($_GET['st'])) { $objAlerta = new Alerta($_GET['st']); } ?></div>
          
          <div class="form-group" >
              <button type="submit" class="cg fp"><i class="h aak"></i> Login</button>
              
              <a href="<?php echo URL?>login/register" class="cg tu"><i class="h aju"></i> Cadastrar</a>
              
              <a href="" style="float: right;"><small><i class="h aam"></i> Esquici minha senha</small></a>
          </div>
           
          </form>
          
        </li>
        
      </ul>
    </div><!-- .gz Coluna do meio -->
    
    
    
    
