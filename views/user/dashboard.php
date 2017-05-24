

<?php

include_once 'models/project_model.php';
$objProject = new Project_Model();

include_once 'models/item_model.php';
$objItem = new Item_Model();

include_once 'models/follow_model.php';
$objFollow = new Follow_Model();

?>

	<div class="gn"><!-- gn Coluna da esquerda -->
      <div class="qv rc aog alu">
        <div class="qx" style="background-image: url(<?php echo URL; ?>public/img/iceland.jpg);"></div>
        <div class="qw dj">

          <a href="#"><img class="aoh" src="<?php echo Data::getPhotoUser( $this->obj->getId_user() ); ?>"></a>

          <h5 class="qy"><?php echo $this->obj->getName() != '' ? $this->obj->getName() : $this->obj->getLogin();?></h5>

          <p class="alu"><?php echo $this->obj->getBio(); ?></p>

		  <?php if( Session::get('loggedIn') && Session::get('userid') == $this->obj->getId_user()  ) { ?>
		  <p><a href="<?php echo URL?>user/form/<?php echo base64_encode(Session::get('userid')); ?>" class="cg ts fx"><span class="h aah"></span> Editar perfil</a></p>
		  <?php } else { ?>
		  <p><a href="<?php echo URL?>" class="cg ts fx"><span class="h vc"></span> Seguir</a></p>
		  <?php } ?>

          <ul class="aoi">
            <li class="aoj">
              <a href="#userModal" class="aku" data-toggle="modal">
                Seguindo
                <h5 class="ali"><?php echo $objFollow->countFollowing($this->obj->getId_user()); ?></h5>
              </a>
            </li>

            <li class="aoj">
              <a href="#userModal" class="aku" data-toggle="modal">
                Seguidores
                <h5 class="ali"><?php echo $objFollow->countFollowers($this->obj->getId_user()); ?></h5>
              </a>
            </li>
          </ul>


        </div>
      </div>




      <div class="qv rc sm sp">
        <div class="qw">
          <h5 class="ald">Sobre mim <small></small></h5>
          <ul class="eb tb">
            <!-- <li><span class="dp h xh all"></span>Went to <a href="#">Oh, Canada</a> -->
            <!--<li><span class="dp h ajw all"></span>Se tornou amigo <a href="#"> Lorem ipsum </a>-->
			<?php if(!empty($this->obj->getWebsite())){ ?><li><span class="dp h add all"></span><a href="<?php echo $this->obj->getWebsite(); ?>" target="_blank">Website </a><?php } ?>
			<?php if(!empty($this->obj->getGithub())){ ?><li><span class="dp h abu all"></span><a href="<?php echo $this->obj->getGithub(); ?>" target="_blank">Github </a><?php } ?>
			<?php if(!empty($this->obj->getFacebook())){ ?><li><span class="dp h aau all"></span><a href="<?php echo $this->obj->getFacebook(); ?>" target="_blank">Facebook </a><?php } ?>
			<?php if(!empty($this->obj->getTwitter())){ ?><li><span class="dp h ajo all"></span><a href="<?php echo $this->obj->getTwitter(); ?>" target="_blank">Twitter </a><?php } ?>
			<?php if(!empty($this->obj->getYoutube())){ ?><li><span class="dp h akt all"></span><a href="<?php echo $this->obj->getYoutube(); ?>" target="_blank">Youtube </a><?php } ?>
            <!--<li><span class="dp h ack all"></span>Mora em <a href="#">Lorem ipsum, SP</a>-->
            <li><span class="dp h wi all"></span>Posts <strong><?php echo $objItem->countItemByUser($this->obj->getId_user()); ?></strong>
			<li><span class="dp h abk all"></span>Projetos <strong><?php echo $objProject->getTotalProjectByUser($this->obj->getId_user()); ?></strong>
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
                    <div class="qx" style="background: url(<?php echo URL.'public/img/project/'.$project->getPath().'/'.$project->getMainpicture(); ?>) center center no-repeat #000; background-size: 100%; overflow: hidden; height:150px"></div>
                    <div class="qw dj">
						<div class="row" style="padding: 0 20px; height:130px">
							<h5 class="qy"><a href="<?php echo URL?>project/detail/<?php echo $project->getId_project(); ?>"><?php echo $project->getTitle(); ?></a></h5>
							<p class="alu">
								<span style="font-size: 80%"><?php echo Data::formatDateShort( $project->getDate() ) ?></span><br>
								<?php echo substr( $project->getSummary(), 0, 90).'...'; ?>
							</p>
						</div>
						<div class="row">
							<div class="col-md-4 col-xs-4"><small><strong><?php echo $this->datalog->countDataLog($project->getId_project(), 'project')?></strong><br>Views</small></div>
							<div class="col-md-4 col-xs-4"><small><strong><?php echo $this->comment->getTotalComment('project', $project->getId_project());?></strong><br>Comments</small></div>
							<div class="col-md-4 col-xs-4"><small><strong>0</strong><br>Likes</small></div>
						</div>
						<?php if( Session::get('userid') == $project->getUser()->getId_user() ) { ?>
						<div class="row">
						<hr>
						<a href="<?=URL?>project/form/<?=$project->getId_project()?>" class="btn btn-default"> <i class="glyphicon glyphicon-pencil"></i> Editar</a>
						</div>
						<?php } ?>
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
              <strong>Seguidores</strong> <small>(<?php echo $this->follow->countFollowers($this->obj->getId_user()); ?>)</small>
            </div>
            <ul class="ano">
            <?php foreach( $this->follow->listFollowers($this->obj->getId_user()) as $followers ){?>
              <li class="anp">
				 <a href="<?=URL?>user/dashboard/<?=$followers->getFollower()->getLogin()?>"><img class="cu" src="<?php echo Data::getPhotoUser($followers->getFollower()->getId_user());?>"></a>
			  </li>
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
              <strong>Seguindo</strong> <small> (<?php echo $this->follow->countFollowing($this->obj->getId_user()); ?>)</small>
            </div>
            <ul class="ano">
            <?php foreach( $this->follow->listFollowing($this->obj->getId_user()) as $following ){?>
              <li class="anp">
				  <a href="<?=URL?>user/dashboard/<?=$following->getUser()->getLogin()?>">
					  <img class="cu" src="<?php echo Data::getPhotoUser($following->getUser()->getId_user());?>">
				  </a>
			  </li>
            <?php } ?>
            </ul>
          </div>
        </li>

		<li class="b aml">
          <h3 class="alc page-header">Projetos de seu interesse</h3>

          <div data-grid="images" data-target-height="150" style="margin-top: 20px">
            <!--<div>
              <img data-width="640" data-height="640" data-action="zoom" src="<?php echo URL; ?>public/img/instagram_5.jpg">
		  </div>-->
          </div>
        </li>



        <!--<li class="b qf aml">
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
	  </li>-->

      </ul>
    </div>
