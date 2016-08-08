		<div class="gn"><!-- gn Coluna da esquerda -->
      <div class="qv rc aog alu">
        <div class="qx" style="background-image: url(<?php echo URL; ?>public/img/iceland.jpg);"></div>
        <div class="qw dj">
        
          <img class="aoh" src="<?php echo Data::getPhotoUser( $this->obj->getId_user() ); ?>">

          <h5 class="qy">
            <a class="aku" href="profile/index.html"> <?php echo $this->obj->getName();?></a>
          </h5>

          <p><?php echo $this->obj->getBio(); ?></p>

          <div class="aoa">
          	<?php if( Session::get('loggedIn') ) { ?>
	          	<?php if( Session::get('userid') == $this->obj->getId_user() ) {?>
	          		<a href="<?php echo URL?>user/form/<?php echo base64_encode(Session::get('userid')); ?>" class="cg ts fx"><span class="h aah"></span> Editar perfil</a>
	          	<?php } else {?>
	          		<button class="cg ts fx"><span class="h vc"></span> Seguir</button>
	          	<?php } ?>
          	<?php } ?>
          	
          </div>
        
        </div>
      </div>
    
      <div class="qv rc sm sp">
        <div class="qw">
          <h5 class="ald">Sobre </h5>
          <ul class="eb tb">
            <!-- <li><span class="dp h xh all"></span>Went to <a href="#">Oh, Canada</a> -->
            <li><span class="dp h ajw all"></span>Se tornou amigo <a href="#"> Lorem ipsum </a></li>
            <li><span class="dp h abu all"></span>Projetos <a href="#">Github</a></li>
            <li><span class="dp h ack all"></span>Mora em <a href="#">Santo André, SP</a></li>
            <li><span class="dp h adt all"></span>Posts <a href="#">145</a></li>
            <li><span class="dp h adt all"></span>Site <a href="#">site.com.br</a></li>
          </ul>
        </div>
      </div>
	
       <div class="qv rc sm sp">
        <div class="qw">
          <h5 class="ald">Ultimos projetos <small> - <a href="<?php echo URL?>project">Ver todos</a></small></h5>
          
          <?php 
          include_once 'models/project_model.php';
          $objProject = new Project_Model();
          ?>
          
          <ul class="qo anx"><!-- listar os ultimos 5 projetos ou os mais curtidos -->
          <?php foreach( $objProject->listarProject( 4 ) as $project ) {?>
          <li class="qf alm">
            <a class="qj" href="<?php echo URL . 'project/detail/' . $project->getId_project(); ?>">
              <img class="qh cu" src="<?php echo URL; ?>public/img/instagram_10.jpg">
            </a>
            <div class="qg">
              <strong><a href="<?php echo URL . 'project/detail/' . $project->getId_project(); ?>"><?php echo $project->getTitle(); ?></a> </strong> @<?php echo $project->getUser()->getLogin(); ?>
              <div class="aoa ">
                <p><small><?php echo substr($project->getContent(), 0,50); ?></small></p>
              </div>
            </div>
          </li>
           <?php } ?>
        </ul>
        
        </div>
      </div>
      
    </div><!-- .gn Coluna da esquerda -->
    
    
	<div class="hl">
      <ul class="ca qo anx">
        
		<li class="b qf aml">
          <!-- <div class="qj">
            <span class="h ajv dp"></span>
          </div> -->

          <div class="qg">
            <!-- <small class="eg dp">30 min</small>
            <div class="qn">
              You followed <a href="#"><strong>Jacob Thornton</strong></a> and <a href="#"><strong>1 other</strong></a>
            </div> -->

            <div class="alk">
              
              <h3 class="alc page-header">Projetos publicados</h3>
              
              <div class="row" style="margin-top: 20px">
              <?php foreach( $this->listProject as $project ){?>
                <div class="col-md-4">
                  <div class="qv rc aog">
                    <div class="qx" style="background: url(<?php echo URL . $project->getMainpicture() ; ?>) center center; background-size:100%; "></div>
                    <div class="qw dj">

                      <h5 class="qy"><a href="<?php echo URL?>project/detail/<?php echo $project->getId_project(); ?>"><?php echo $project->getTitle(); ?></a></h5>
                      <p class="alu"><?php echo $project->getContent(); ?></p>

                      <div class="row">
						<div class="col-md-4 col-xs-4"><small><strong>456</strong><br>Views</small></div>
						<div class="col-md-4 col-xs-4"><small><strong>34</strong><br>Comments</small></div>
						<div class="col-md-4 col-xs-4"><small><strong>100</strong><br>Likes</small></div>
					</div>
                    </div>
                  </div>
                </div>
				<?php } ?>
                </div>
                
                
              
            </div>
          </div>
        </li>
        
        <li class="b qf aml">
          <div class="qj">
            <span class="h ajv dp"></span>
          </div>

          <div class="qg">
            
            <div class="qn">
              <a href="#"><strong>Seguidores</strong></a> <small>(3 novos)</small>
            </div>
            <ul class="ano">
            <?php for( $i=0; $i<7; $i++ ){?>
              <li class="anp"><img class="cu" src="<?php echo Data::getPhotoUser($i);?>"></li>
            <?php } ?>
            </ul>
          </div>
        </li>
        
        <li class="b qf aml">
          <div class="qj">
            <span class="h ajv dp"></span>
          </div>

          <div class="qg">
            
            <div class="qn">
              <a href="#"><strong>Seguindo</strong></a>
            </div>
            <ul class="ano">
            <?php for( $i=0; $i<17; $i++ ){?>
              <li class="anp"><img class="cu" src="<?php echo Data::getPhotoUser($i);?>"></li>
            <?php } ?>
            </ul>
          </div>
        </li>

		<li class="b aml">
          <h3 class="alc page-header">Projetos de seu interesse</h3>
          
          <div data-grid="images" data-target-height="150" style="margin-top: 20px">
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
        </li>

        

        <li class="b qf aml">
          <div class="qj">
            <span class="h aax dp"></span>
          </div>

          <div class="qg">
            <small class="eg dp">3 min</small>
            <div class="qn">
              <a href="#"><strong>Mark Otto</strong></a> flagged your post
            </div>

            <div class="qv rc alk">
              <div class="qw">
                <div class="qf">
                  <a class="qj" href="#">
                    <img class="qh cu" src="../assets/img/avatar-fat.jpg">
                  </a>
                  <div class="qg">
                    <div class="aoc">
                      <div class="qn">
                        <small class="eg dp">1 hr</small>
                        <h5 class="alf">Jacob Thornton</h5>
                      </div>
                      Donec id elit non mi porta gravida at eget metus. Integer posuere erat a ante venenatis dapibus posuere velit aliquet. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Morbi leo risus, porta ac consectetur ac, vestibulum at eros. Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </li>

      </ul>
    </div>
    
    
   