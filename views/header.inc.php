<?php Session::init(); ?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="iso-8859-1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href='<?php echo URL; ?>public/img/ico.ico' rel='shortcut icon' type='image/x-icon'>
    <meta name="description" content="">
    <meta name="keywords" content="">
    <meta name="author" content="">

    <title><?=(isset($this->title)) ? $this->title : SYSTEM_NAME; ?></title>

    <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,600' rel='stylesheet' type='text/css'>
    <link href="<?php echo URL; ?>public/css/toolkit.css" rel="stylesheet">
    
    <link href="<?php echo URL; ?>public/css/application.css" rel="stylesheet">

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
    </style>

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
        <img src="public/img/logo-robo3d.png" alt="brand">
      </a>
    </div>
    <div class="f collapse" id="navbar-collapse-main">

        <ul class="nav navbar-nav ss">

          <?php foreach( $this->menu as $menu ) { ?>
          <li><!-- class="active" -->
            <a <?php echo $menu['toggle']; ?> href="<?php echo $menu['link']; ?>"><?php echo $menu['label']; ?></a>
          </li>
          <?php } ?>
        </ul>

        <ul class="nav navbar-nav og ale ss">
          <li>
            <a class="g" href="notifications/index.html">
              <span class="h ws"></span>
            </a>
          </li>
          <li>
            <button class="cg fm ox anl" data-toggle="popover">
              <img class="cu" src="<?php echo URL; ?>public/img/avatar-dhg.png">
            </button>
          </li>
        </ul>

        <form class="ow og i" role="search">
          <div class="et">
            <input type="text" class="form-control" data-action="grow" placeholder="Search">
          </div>
        </form>

        <ul class="nav navbar-nav st su sv">
          <?php foreach( $this->menu as $menu ) { ?>
          <li><!-- class="active" -->
            <a <?php echo $menu['toggle']; ?> href="<?php echo $menu['link']; ?>"><?php echo $menu['label']; ?></a>
          </li>
          <?php } ?>
          
          <li><a href="#" data-action="growl">Growl</a></li>
          <li><a href="#">Logout</a></li>
        </ul>
        <ul class="nav navbar-nav hidden">
          <li><a href="#" data-action="growl">Growl</a></li>
          <li><a href="#">Logout</a></li>
        </ul>
      </div>
  </div>
</nav>

<div class="cd fade" id="msgModal" tabindex="-1" role="dialog" aria-labelledby="msgModal" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="d">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <button type="button" class="cg fx fp eg k js-newMsg">New message</button>
        <h4 class="modal-title">Messages</h4>
      </div>

      <div class="modal-body amf js-modalBody">
        <div class="uq">
          <div class="qo cj ca js-msgGroup">
            <a href="#" class="b">
              <div class="qf">
                <span class="qj">
                <img class="cu qh" src="<?php echo URL; ?>public/img/avatar-fat.jpg">
                </span>
                <div class="qg">
                  <strong>Jacob Thornton</strong> and <strong>1 other</strong>
                  <div class="aof">
                    Aenean eu leo quam. Pellentesque ornare sem lacinia quam &hellip;
                  </div>
                </div>
              </div>
            </a>
            <a href="#" class="b">
              <div class="qf">
                <span class="qj">
                  <img class="cu qh" src="<?php echo URL; ?>public/img/avatar-mdo.png">
                </span>
                <div class="qg">
                  <strong>Mark Otto</strong> and <strong>3 others</strong>
                  <div class="aof">
                    Brunch sustainable placeat vegan bicycle rights yeah…
                  </div>
                </div>
              </div>
            </a>
            <a href="#" class="b">
              <div class="qf">
                <span class="qj">
                  <img class="cu qh" src="<?php echo URL; ?>public/img/avatar-dhg.png">
                </span>
                <div class="qg">
                  <strong>Dave Gamache</strong>
                  <div class="aof">
                    Brunch sustainable placeat vegan bicycle rights yeah…
                  </div>
                </div>
              </div>
            </a>
            <a href="#" class="b">
              <div class="qf">
                <span class="qj">
                  <img class="cu qh" src="<?php echo URL; ?>public/img/avatar-fat.jpg">
                </span>
                <div class="qg">
                  <strong>Jacob Thornton</strong> and <strong>1 other</strong>
                  <div class="aof">
                    Aenean eu leo quam. Pellentesque ornare sem lacinia quam &hellip;
                  </div>
                </div>
              </div>
            </a>
            <a href="#" class="b">
              <div class="qf">
                <span class="qj">
                  <img class="cu qh" src="<?php echo URL; ?>public/img/avatar-mdo.png">
                </span>
                <div class="qg">
                  <strong>Mark Otto</strong> and <strong>3 others</strong>
                  <div class="aof">
                    Brunch sustainable placeat vegan bicycle rights yeah…
                  </div>
                </div>
              </div>
            </a>
            <a href="#" class="b">
              <div class="qf">
                <span class="qj">
                  <img class="cu qh" src="<?php echo URL; ?>public/img/avatar-dhg.png">
                </span>
                <div class="qg">
                  <strong>Dave Gamache</strong>
                  <div class="aof">
                    Brunch sustainable placeat vegan bicycle rights yeah…
                  </div>
                </div>
              </div>
            </a>
            <a href="#" class="b">
              <div class="qf">
                <span class="qj">
                  <img class="cu qh" src="<?php echo URL; ?>public/img/avatar-fat.jpg">
                </span>
                <div class="qg">
                  <strong>Jacob Thornton</strong> and <strong>1 other</strong>
                  <div class="aof">
                    Aenean eu leo quam. Pellentesque ornare sem lacinia quam &hellip;
                  </div>
                </div>
              </div>
            </a>
            <a href="#" class="b">
              <div class="qf">
                <span class="qj">
                  <img class="cu qh" src="<?php echo URL; ?>public/img/avatar-mdo.png">
                </span>
                <div class="qg">
                  <strong>Mark Otto</strong> and <strong>3 others</strong>
                  <div class="aof">
                    Brunch sustainable placeat vegan bicycle rights yeah…
                  </div>
                </div>
              </div>
            </a>
            <a href="#" class="b">
              <div class="qf">
                <span class="qj">
                  <img class="cu qh" src="<?php echo URL; ?>public/img/avatar-dhg.png">
                </span>
                <div class="qg">
                  <strong>Dave Gamache</strong>
                  <div class="aof">
                    Brunch sustainable placeat vegan bicycle rights yeah…
                  </div>
                </div>
              </div>
            </a>
          </div>

          <div class="hide alj js-conversation">
            <ul class="qo aob">
              <li class="qf aoe alu">
                <div class="qg">
                  <div class="aoc">
                    Aenean eu leo quam. Pellentesque ornare sem lacinia quam venenatis vestibulum. Nulla vitae elit libero, a pharetra augue. Maecenas sed diam eget risus varius blandit sit amet non magna. Morbi leo risus, porta ac consectetur ac, vestibulum at eros. Sed posuere consectetur est at lobortis.
                  </div>
                  <div class="aod">
                    <small class="dp">
                      <a href="#">Dave Gamache</a> at 4:20PM
                    </small>
                  </div>
                </div>
                <a class="qi" href="#">
                  <img class="cu qh" src="<?php echo URL; ?>public/img/avatar-dhg.png">
                </a>
              </li>

              <li class="qf alu">
                <a class="qj" href="#">
                  <img class="cu qh" src="<?php echo URL; ?>public/img/avatar-fat.jpg">
                </a>
                <div class="qg">
                  <div class="aoc">
                   Cras justo odio, dapibus ac facilisis in, egestas eget quam. Duis mollis, est non commodo luctus, nisi erat porttitor ligula, eget lacinia odio sem nec elit. Praesent commodo cursus magna, vel scelerisque nisl consectetur et.
                  </div>
                  <div class="aoc">
                   Vestibulum id ligula porta felis euismod semper. Aenean lacinia bibendum nulla sed consectetur. Cras justo odio, dapibus ac facilisis in, egestas eget quam. Morbi leo risus, porta ac consectetur ac, vestibulum at eros. Praesent commodo cursus magna, vel scelerisque nisl consectetur et. Nullam quis risus eget urna mollis ornare vel eu leo. Morbi leo risus, porta ac consectetur ac, vestibulum at eros.
                  </div>
                  <div class="aoc">
                   Cras mattis consectetur purus sit amet fermentum. Donec sed odio dui. Integer posuere erat a ante venenatis dapibus posuere velit aliquet. Nulla vitae elit libero, a pharetra augue. Donec id elit non mi porta gravida at eget metus.
                  </div>
                  <div class="aod">
                    <small class="dp">
                      <a href="#">Fat</a> at 4:28PM
                    </small>
                  </div>
                </div>
              </li>

              <li class="qf alu">
                <a class="qj" href="#">
                  <img class="cu qh" src="<?php echo URL; ?>public/img/avatar-mdo.png">
                </a>
                <div class="qg">
                  <div class="aoc">
                   Etiam porta sem malesuada magna mollis euismod. Donec id elit non mi porta gravida at eget metus. Praesent commodo cursus magna, vel scelerisque nisl consectetur et. Etiam porta sem malesuada magna mollis euismod. Morbi leo risus, porta ac consectetur ac, vestibulum at eros. Aenean lacinia bibendum nulla sed consectetur.
                  </div>
                  <div class="aoc">
                   Curabitur blandit tempus porttitor. Integer posuere erat a ante venenatis dapibus posuere velit aliquet. Duis mollis, est non commodo luctus, nisi erat porttitor ligula, eget lacinia odio sem nec elit.
                  </div>
                  <div class="aod">
                    <small class="dp">
                      <a href="#">Mark Otto</a> at 4:20PM
                    </small>
                  </div>
                </div>
              </li>

              <li class="qf aoe alu">
                <div class="qg">
                  <div class="aoc">
                    Aenean eu leo quam. Pellentesque ornare sem lacinia quam venenatis vestibulum. Nulla vitae elit libero, a pharetra augue. Maecenas sed diam eget risus varius blandit sit amet non magna. Morbi leo risus, porta ac consectetur ac, vestibulum at eros. Sed posuere consectetur est at lobortis.
                  </div>
                  <div class="aod">
                    <small class="dp">
                      <a href="#">Dave Gamache</a> at 4:20PM
                    </small>
                  </div>
                </div>
                <a class="qi" href="#">
                  <img class="cu qh" src="<?php echo URL; ?>public/img/avatar-dhg.png">
                </a>
              </li>

              <li class="qf alu">
                <a class="qj" href="#">
                  <img class="cu qh" src="<?php echo URL; ?>public/img/avatar-fat.jpg">
                </a>
                <div class="qg">
                  <div class="aoc">
                   Cras justo odio, dapibus ac facilisis in, egestas eget quam. Duis mollis, est non commodo luctus, nisi erat porttitor ligula, eget lacinia odio sem nec elit. Praesent commodo cursus magna, vel scelerisque nisl consectetur et.
                  </div>
                  <div class="aoc">
                   Vestibulum id ligula porta felis euismod semper. Aenean lacinia bibendum nulla sed consectetur. Cras justo odio, dapibus ac facilisis in, egestas eget quam. Morbi leo risus, porta ac consectetur ac, vestibulum at eros. Praesent commodo cursus magna, vel scelerisque nisl consectetur et. Nullam quis risus eget urna mollis ornare vel eu leo. Morbi leo risus, porta ac consectetur ac, vestibulum at eros.
                  </div>
                  <div class="aoc">
                   Cras mattis consectetur purus sit amet fermentum. Donec sed odio dui. Integer posuere erat a ante venenatis dapibus posuere velit aliquet. Nulla vitae elit libero, a pharetra augue. Donec id elit non mi porta gravida at eget metus.
                  </div>
                  <div class="aod">
                    <small class="dp">
                      <a href="#">Fat</a> at 4:28PM
                    </small>
                  </div>
                </div>
              </li>

              <li class="qf alm">
                <a class="qj" href="#">
                  <img class="cu qh" src="<?php echo URL; ?>public/img/avatar-mdo.png">
                </a>
                <div class="qg">
                  <div class="aoc">
                   Etiam porta sem malesuada magna mollis euismod. Donec id elit non mi porta gravida at eget metus. Praesent commodo cursus magna, vel scelerisque nisl consectetur et. Etiam porta sem malesuada magna mollis euismod. Morbi leo risus, porta ac consectetur ac, vestibulum at eros. Aenean lacinia bibendum nulla sed consectetur.
                  </div>
                  <div class="aoc">
                   Curabitur blandit tempus porttitor. Integer posuere erat a ante venenatis dapibus posuere velit aliquet. Duis mollis, est non commodo luctus, nisi erat porttitor ligula, eget lacinia odio sem nec elit.
                  </div>
                  <div class="aod">
                    <small class="dp">
                      <a href="#">Mark Otto</a> at 4:20PM
                    </small>
                  </div>
                </div>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>





<div class="cd fade" id="userModal" tabindex="-1" role="dialog" aria-labelledby="userModal" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="d">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title">Users</h4>
      </div>

      <div class="modal-body amf">
        <div class="uq">
          <ul class="qo cj ca">
            <li class="b">
              <div class="qf">
                <a class="qj" href="#">
                  <img class="qh cu" src="<?php echo URL; ?>public/img/avatar-fat.jpg">
                </a>
                <div class="qg">
                  <button class="cg fm fx eg">
                    <span class="c aol"></span> Follow
                  </button>
                  <strong>Jacob Thornton</strong>
                  <p>@fat - San Francisco</p>
                </div>
              </div>
            </li>
            <li class="b">
              <div class="qf">
                <a class="qj" href="#">
                  <img class="qh cu" src="<?php echo URL; ?>public/img/avatar-dhg.png">
                </a>
                <div class="qg">
                  <button class="cg fm fx eg">
                    <span class="c aol"></span> Follow
                  </button>
                  <strong>Dave Gamache</strong>
                  <p>@dhg - Palo Alto</p>
                </div>
              </div>
            </li>
            <li class="b">
              <div class="qf">
                <a class="qj" href="#">
                  <img class="qh cu" src="<?php echo URL; ?>public/img/avatar-mdo.png">
                </a>
                <div class="qg">
                  <button class="cg fm fx eg">
                    <span class="c aol"></span> Follow
                  </button>
                  <strong>Mark Otto</strong>
                  <p>@mdo - San Francisco</p>
                </div>
              </div>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </div>
</div>