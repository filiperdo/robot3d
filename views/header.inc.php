<?php Session::init(); ?>
<?php include_once 'menu.php';?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href='<?php echo URL; ?>public/img/ico.ico' rel='shortcut icon' type='image/x-icon'>
    <meta name="description" content="">
    <meta name="keywords" content="">
    <meta name="author" content="">

    <title><?=(isset($this->title)) ? $this->title : SYSTEM_NAME; ?></title>

    <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,600' rel='stylesheet' type='text/css'>
    <link href="<?php echo URL; ?>public/css/bootstrap.css" rel="stylesheet">
    <link href="<?php echo URL; ?>public/css/toolkit.css" rel="stylesheet">
    <link href="<?php echo URL; ?>public/css/style.css" rel="stylesheet">
    <link href="<?php echo URL; ?>public/css/application.css" rel="stylesheet">
	<script src="<?php echo URL; ?>public/js/config.js"></script>
	<script src="<?php echo URL; ?>public/js/jquery.min.js"></script>
	
	<?php
    if (isset($this->js)) 
    {
        foreach ($this->js as $js)
        {
            echo '<script type="text/javascript" src="'.URL.'public/js/'.$js.'"></script>';
        }
    }
    ?>

    <style>
      /* note: this is a hack for ios iframe for bootstrap themes shopify page */
      /* this chunk of css is not part of the toolkit :) */
      body {
        width: 1px;
        min-width: 100%;
        *width: 100%;
      }
      .teste{
      	border:1px solid #f00;
      }
    </style>
    
	<script src='https://www.google.com/recaptcha/api.js'></script>
	
  </head>

<body class="ang">

<div class="anq" id="app-growl"></div>

<nav class="ck pc os app-navbar">
  <div class="by">
    <div class="or">
      <button type="button" class="ou collapsed" data-toggle="collapse" data-target="#navbar-collapse-main">
        <span class="cv">Toggle navigation</span>
        <span class="ov"></span>
        <span class="ov"></span>
        <span class="ov"></span>
      </button>
      <a class="e" href="<?php echo URL; ?>index">
        <img src="<?php echo URL?>public/img/logo-robo3d.png" alt="brand">
      </a>
    </div>
    <div class="f collapse" id="navbar-collapse-main">

        <ul class="nav navbar-nav ss">

          <?php foreach( $menu_base as $menu ) { ?>
          <li><!-- class="active" -->
            <a <?php echo $menu['toggle']; ?> href="<?php echo URL . $menu['link']; ?>"><?php echo $menu['label']; ?></a>
          </li>
          <?php } ?>
          
        </ul>

        <ul class="nav navbar-nav og ale ss">
        
        <?php if( Session::get( 'loggedIn' ) ){?>
        
          <li>
            <a class="g" href="index">
              <span class="h ws"></span>
            </a>
          </li>
          
          <li>
            <button class="cg fm ox anl" data-toggle="popover">
              <img class="cu" src="<?php echo Data::getPhotoUser( Session::get('userid') ); ?>">
            </button>
          </li>
          
         <?php } else { ?> 
         
          <li><a href="<?php echo URL; ?>login">Login</a></li>
          <li><a href="<?php echo URL?>login/register">Cadastrar</a></li>
          
         <?php } ?>
         
        </ul>

        <form class="ow og i" role="search">
          <div class="et">
            <input type="text" class="form-control" data-action="grow" placeholder="Search">
          </div>
        </form>

        <ul class="nav navbar-nav st su sv">
          <?php foreach( $menu_base as $menu ) { ?>
          <li><!-- class="active" -->
            <a <?php echo $menu['toggle']; ?> href="<?php echo URL . $menu['link']; ?>"><?php echo $menu['label']; ?></a>
          </li>
          <?php } ?>
          <?php if( Session::get( 'loggedIn' ) ){?>
          <li><a href="<?php echo URL?>user/form/<?php echo base64_encode(Session::get('userid')); ?>"><i class="glyphicon glyphicon-pencil"></i> Editar Perfil</a></li>
          <li><a href="<?php echo URL?>login/logout"><i class="glyphicon glyphicon-off"></i> Logout</a></li>          
          <?php } else { ?>
          <li><a href="<?php echo URL; ?>login">Login</a></li>
          <li><a href="<?php echo URL?>login/register">Cadastrar</a></li>
          <?php } ?>
        </ul>
        
        <ul class="nav navbar-nav hidden"> 
          <!-- <li><a href="#" data-action="growl">Growl</a></li> -->
          <li><a href="<?php echo URL?>user/form/<?php echo base64_encode(Session::get('userid')); ?>"><i class="glyphicon glyphicon-pencil"></i> Editar Perfil</a></li>
          <li><a href="<?php echo URL?>login/logout"><i class="glyphicon glyphicon-off"></i> Logout</a></li>          
        </ul>
        
      </div>
  </div>
</nav>

<div class="by amt ">
  <div class="gc">