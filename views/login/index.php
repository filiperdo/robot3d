
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
              <i class="cg fm">
                <span class="glyphicon glyphicon-asterisk"></span>
              </i>
            </div>
            <input type="password" name="password" class="form-control" placeholder="Senha" required="required">
            
          </div>
          
          <div style="margin:10px 0"><?php if (isset($_GET['st'])) { $objAlerta = new Alerta($_GET['st']); } ?></div>
          
          <div class="form-group" >
              <button type="submit" class="cg fp"><i class="h aak"></i> Login</button>
              
              <a href="<?php echo URL?>login/register" class="cg tu"><i class="h aju"></i> Cadastrar</a>
              
              <a href="#recover-pass" class="aku" data-toggle="modal" style="float: right;"><small><i class="h aam"></i> Esquici minha senha</small></a>
          </div>
           
          </form>
          
        </li>
        
      </ul>
    </div><!-- .gz Coluna do meio -->
    
    
<div class="cd fade" id="recover-pass" tabindex="-1" role="dialog" aria-labelledby="userModal" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="d">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title">Recuperar senha</h4>
      </div>

      <div class="modal-body amf">
        <div class="uq">
          <ul class="qo cj ca">
            <li class="b">
				
				<form name="form-login" id="form-login" method="post" action="<?php echo URL?>login/recover"  >
        		
		          <label>E-mail</label>
		          <div class="input-group">
		          	<div class="fj">
		              <button type="button" class="cg fm">
		                <span class="glyphicon glyphicon-envelope"></span>
		              </button>
		            </div>
		            <input type="text" class="form-control" name="email" placeholder="email" required="required" value="">
		            
		          </div>
		         
		          <div class="form-group" style="margin-top: 15px">
		              <button type="submit" class="cg fp"><i class="h aju"></i> Enviar</button>
		          </div>
		          <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
		       </form>              

            </li>
            
          </ul>
        </div>
      </div>
    </div>
  </div>
</div>
    
