

	<div class="gn"><!-- gn Coluna direita -->

      <!-- <div class="alert pv alert-dismissible ss" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <a class="pr" href="profile/index.html">Visit your profile!</a> Check your self, you aren't looking too good.
      </div> -->

      <div class="qv rc alu ss">
        <div class="qw">

		<div id="fb-root"></div>
		<script>(function(d, s, id) {
		  var js, fjs = d.getElementsByTagName(s)[0];
		  if (d.getElementById(id)) return;
		  js = d.createElement(s); js.id = id;
		  js.src = "//connect.facebook.net/pt_BR/sdk.js#xfbml=1&version=v2.7";
		  fjs.parentNode.insertBefore(js, fjs);
		}(document, 'script', 'facebook-jssdk'));</script>

		<div class="fb-page" data-href="https://www.facebook.com/robo3doficial/" data-tabs="timeline" data-small-header="false" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true"><blockquote cite="https://www.facebook.com/robo3doficial/" class="fb-xfbml-parse-ignore"><a href="https://www.facebook.com/robo3doficial/">Robô 3D</a></blockquote></div>

          <!-- <h5 class="ald">Titulo</h5>
          <div data-grid="images" data-target-height="150">
            <img class="qh" data-width="640" data-height="640" data-action="zoom" src="<?php echo URL; ?>public/img/instagram_2.jpg">
          </div>
          <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam.</p>
          <button class="cg ts fx">Loren ipsum</button> -->
        </div>
      </div>
<?php
require_once 'models/user_model.php';
$objUserModel = new User_Model();
?>
      <div class="qv rc alu ss">
        <div class="qw">
        <h5 class="ald">Quem seguir? <small> <a href="<?php echo URL?>user/whotofollow">Ver todos</a></small></h5>
        <ul class="qo anx">
	        <?php foreach ($objUserModel->listTopWhoToFollow(3) as $user) {?>
			<li class="qf alm" id="li-user-<?php echo $user->getId_user(); ?>">
				<a class="qj" href="<?php echo URL . 'user/dashboard/'. base64_encode( $user->getId_user() )?>">
					<img class="qh cu" src="<?php echo Data::getPhotoUser( $user->getId_user() ); ?>">
				</a>
				<div class="qg">
					<strong><a href="<?php echo URL . 'user/dashboard/'. base64_encode( $user->getId_user() )?>"><?php echo $user->getLogin()?></a></strong>
					<div class="aoa">
						<?php if( Session::get( 'loggedIn' ) ){?>
						<button class="cg ts fx bt-seguir" id="<?php echo $user->getId_user(); ?>"><span class="h vc"></span> Seguir</button>
						<?php } else { ?>
						<button class="cg ts fx disabled" ><span class="h vc"></span> Seguir</button>
						<?php } ?>
					</div>
					<div id="result"></div>
				</div>
			</li>
			<?php } ?>

        </ul>
        </div>
        <!-- <div class="qz">
          Lorem ipsum dolor sit amet, consectetur adipiscing elit,
        </div> -->
      </div>


	<?php
		require_once 'models/category_model.php';
		$objCategoryModel = new Category_Model();
	?>
      <div class="qv rc aok">
        <div class="qw">
          <?php echo date('Y');?> Robo3D

		  <?php foreach( $objCategoryModel->listarCategory(15) as $category ){?>
          <a href="#" class="text-lowercase"><?php echo $category->getName();?></a>
          <?php } ?>

        </div>
      </div>
    </div><!-- .gn Coluna direita -->

	<script>
	$(document).ready(function(){

		if( window.location.hostname == 'localhost' )
		{
			var URL = 'http://localhost/robot3d/';
		}
		else
		{
			var URL = 'http://www.robo3d.com.br/';
		}

		/*carrega(3);

		function carrega( $limit ){

			$.getJSON(URL + 'user/listTopWhoToFollow',{limit:$limit},function(data){
				$.each(data,function(){

					html = '<li class="qf alm">\
							<img class="qh cu" src="' + URL + 'public/img/user/1/'+this['path']+'">\
							<div class="qg" style="float:left">\
								<strong><a href="'+ URL + 'user/dashboard/' + this['id_user'] + '">' + this['login'] + '</a></strong>\
								<div class="aoa">\
									<button class="cg ts fx bt-seguir" id="'+this['id_user']+'"><span class="h vc"></span> Seguir</button>\
								</div>\
							</div>\
							</li>';

					$(html).appendTo('#ul_wotofollow');
				})
			})
		}*/

		$(".bt-seguir").click(function(){
			$target = $(this);
			$liUser = '#li-user-' + $(this).attr('id');
			$($target).html('Seguindo...');
			$.post(URL+'follow/followUser/'+$(this).attr('id'), function(data){
				$($target).addClass('active');
				$($target).html(data);
				$($liUser).fadeOut( "slow", function() {
			    	$(this).remove();
			  	});
				//carrega(3);
			});
		});

	});
	</script>
