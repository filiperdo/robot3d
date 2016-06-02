	<div class="gn"><!-- gn Coluna da esquerda -->
      <div class="qv rc aog alu">
        <div class="qx" style="background-image: url(<?php echo URL; ?>public/img/iceland.jpg);"></div>
        <div class="qw dj">
        
        <?php if( Session::get('loggedIn') ) { ?>
        
          <a href="profile/index.html">
            <img class="aoh" src="<?php echo URL; ?>public/img/avatar-dhg.png">
          </a>

          <h5 class="qy">
            <a class="aku" href="profile/index.html"> Filipe Rodrigues</a>
          </h5>

          <p class="alu">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt.</p>

          <ul class="aoi">
            <li class="aoj">
              <a href="#userModal" class="aku" data-toggle="modal">
                Seguindo
                <h5 class="ali">12</h5>
              </a>
            </li>

            <li class="aoj">
              <a href="#userModal" class="aku" data-toggle="modal">
                Seguidores
                <h5 class="ali">132</h5>
              </a>
            </li>
          </ul>
          
        <?php } else { ?>
        
        <h4>O que é o Robo 3D?</h4>
        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt. <br>
        Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt.<p>
        
        <h5 class="ald"><small> <a href="#">Saiba mais</a></small></h5>
        
        <?php } ?>
        </div>
      </div>


	<?php if( Session::get('loggedIn') ) { ?>
    
      <div class="qv rc sm sp">
        <div class="qw">
          <h5 class="ald">Sobre mim <small> <a href="#">Editar</a></small></h5>
          <ul class="eb tb">
            <!-- <li><span class="dp h xh all"></span>Went to <a href="#">Oh, Canada</a> -->
            <li><span class="dp h ajw all"></span>Se tornou amigo <a href="#"> Lorem ipsum </a>
            <li><span class="dp h abu all"></span>Projetos <a href="#">Github</a>
            <li><span class="dp h ack all"></span>Mora em <a href="#">Santo André, SP</a>
            <li><span class="dp h adt all"></span>Posts <a href="#">145</a>
          </ul>
        </div>
      </div>
	
	<?php } ?>
	
       <div class="qv rc sm sp">
        <div class="qw">
          <h5 class="ald">Últimos projetos <small> - <a href="<?php echo URL?>project">Ver todos</a></small></h5>
          
          <ul class="qo anx"><!-- listar os ultimos 5 projetos ou os mais curtidos -->
          <?php for( $i=0; $i<5; $i++ ) {?>
          <li class="qf alm">
            <a class="qj" href="#">
              <img class="qh cu" src="<?php echo URL; ?>public/img/instagram_10.jpg">
            </a>
            <div class="qg">
              <strong>Lorem ipsum </strong> #nameuser
              <div class="aoa ">
                <p><small>Lorem ipsum dolor sit amet, consectetur adipiscing elit</small></p>
              </div>
            </div>
          </li>
           <?php } ?>
        </ul>
        
        
          <!--  
          <div data-grid="images" data-target-height="150">
            <div>
              <img data-width="640" data-height="640" data-action="zoom" src="<?php echo URL; ?>public/img/instagram_5.jpg">
            </div>

            <div>
              <img data-width="640" data-height="640" data-action="zoom" src="<?php echo URL; ?>public/img/instagram_6.jpg">
            </div>

            <div>
              <img data-width="640" data-height="640" data-action="zoom" src="<?php echo URL; ?>public/img/instagram_7.jpg">
            </div>

            <div>
              <img data-width="640" data-height="640" data-action="zoom" src="<?php echo URL; ?>public/img/instagram_8.jpg">
            </div>

            <div>
              <img data-width="640" data-height="640" data-action="zoom" src="<?php echo URL; ?>public/img/instagram_9.jpg">
            </div>

            <div>
              <img data-width="640" data-height="640" data-action="zoom" src="<?php echo URL; ?>public/img/instagram_10.jpg">
            </div>
          </div>
          -->
          
          
        </div>
      </div>
    </div><!-- .gn Coluna da esquerda -->