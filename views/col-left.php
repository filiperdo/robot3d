<?php
if( Session::get('loggedIn') ) {
	include_once 'models/user_model.php';
	$objUser = new User_Model();
	$objUser->obterUser( Session::get('userid') );

	include_once 'models/project_model.php';
	$objProject = new Project_Model();

	include_once 'models/item_model.php';
	$objItem = new Item_Model();

	include_once 'models/follow_model.php';
	$objFollow = new Follow_Model();
}
?>

	<div class="gn"><!-- gn Coluna da esquerda -->
      <div class="qv rc aog alu">
        <div class="qx" style="background-image: url(<?php echo URL; ?>public/img/iceland.jpg);"></div>
        <div class="qw dj">

        <?php if( Session::get('loggedIn') ) { ?>

          <a href="#">
            <a href="<?php echo URL . 'user/dashboard/' . Session::get('user_login')?>"><img class="aoh" src="<?php echo Data::getPhotoUser( Session::get('userid') ); ?>"></a>
          </a>

          <h5 class="qy">
            <a class="aku" href="<?php echo URL . 'user/dashboard/' . Session::get('user_login')?>"> <?php echo Session::get('user_name');?></a>
          </h5>
          <p class="alu"><?php echo $objUser->getBio(); ?></p>

		  <p><a href="<?php echo URL?>user/form/<?php echo base64_encode(Session::get('userid')); ?>" class="cg ts fx"><span class="h aah"></span> Editar perfil</a></p>

          <ul class="aoi">
            <li class="aoj">
              <a href="#userModal" class="aku" data-toggle="modal">
                Seguindo
                <h5 class="ali"><?php echo $objFollow->countFollowing(Session::get('userid')); ?></h5>
              </a>
            </li>

            <li class="aoj">
              <a href="#userModal" class="aku" data-toggle="modal">
                Seguidores
                <h5 class="ali"><?php echo $objFollow->countFollowers(Session::get('userid')); ?></h5>
              </a>
            </li>
          </ul>

        <?php } else { ?>

        <h4>O que é o Robo 3D?</h4>
        <p>Robô 3D é uma comunidade com o objetivo de compartilhar conhecimento na área de Robótica e Impressão 3D.<p>

        <h5 class="ald"><small> <a href="<?php echo URL?>about">Saiba mais</a></small></h5>

        <?php } ?>
        </div>
      </div>


	<?php if( Session::get('loggedIn') ) { ?>

      <div class="qv rc sm sp">
        <div class="qw">
          <h5 class="ald">Sobre mim <small></small></h5>
          <ul class="eb tb">
            <!-- <li><span class="dp h xh all"></span>Went to <a href="#">Oh, Canada</a> -->
            <!--<li><span class="dp h ajw all"></span>Se tornou amigo <a href="#"> Lorem ipsum </a>-->
			<?php if(!empty($objUser->getWebsite())){ ?><li><span class="dp h add all"></span><a href="<?php echo $objUser->getWebsite(); ?>" target="_blank">Website </a><?php } ?>
			<?php if(!empty($objUser->getGithub())){ ?><li><span class="dp h abu all"></span><a href="<?php echo $objUser->getGithub(); ?>" target="_blank">Github </a><?php } ?>
			<?php if(!empty($objUser->getFacebook())){ ?><li><span class="dp h aau all"></span><a href="<?php echo $objUser->getFacebook(); ?>" target="_blank">Facebook </a><?php } ?>
			<?php if(!empty($objUser->getTwitter())){ ?><li><span class="dp h ajo all"></span><a href="<?php echo $objUser->getTwitter(); ?>" target="_blank">Twitter </a><?php } ?>
			<?php if(!empty($objUser->getYoutube())){ ?><li><span class="dp h akt all"></span><a href="<?php echo $objUser->getYoutube(); ?>" target="_blank">Youtube </a><?php } ?>
            <!--<li><span class="dp h ack all"></span>Mora em <a href="#">Lorem ipsum, SP</a>-->
            <li><span class="dp h wi all"></span>Posts <strong><?php echo $objItem->countItemByUser(Session::get('userid')); ?></strong>
			<li><span class="dp h abk all"></span>Projetos <strong><?php echo $objProject->getTotalProjectByUser(Session::get('userid')); ?></strong>
          </ul>
        </div>
      </div>

	<?php } ?>

       <div class="qv rc sm sp">
        <div class="qw">
          <h5 class="ald">Ultimos projetos <small> - <a href="<?php echo URL?>project">Ver todos</a></small></h5>

          <?php
          include_once 'models/project_model.php';
          $objProject = new Project_Model();
          ?>

          <ul class="qo anx"><!-- listar os ultimos 5 projetos ou os mais curtidos -->
          <?php foreach( $objProject->listarProject( 4 ) as $project ) {?>
          <li class="qf alm" style="height:45px">
          	<div class="" style="float:left; margin-right:10px; width:80px; background: url(<?php echo URL .'public/img/project/'.$project->getPath().'/'. $project->getMainpicture(); ?>) center center no-repeat #000; background-size: 100%; overflow: hidden; height:50px"></div>
            <div class="qg">
              <strong><a href="<?php echo URL . 'project/detail/' . $project->getId_project(); ?>"><?php echo $project->getTitle(); ?></a> </strong>
			  <small>| <a href="<?php echo URL . 'user/dashboard/' . $project->getUser()->getLogin();?>"><?php echo $project->getUser()->getLogin(); ?></a></small>
            </div>
          </li>
		  <hr>
          <?php } ?>
        </ul>

        </div>
      </div>
    </div><!-- .gn Coluna da esquerda -->
