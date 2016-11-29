


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
              <a href="#"><strong>Seguidores</strong></a> <!-- <small>(3 novos)</small> -->
            </div>
            <ul class="ano">
            <?php foreach( $this->follow->listFollowers($this->obj->getId_user()) as $followers ){?>
              <li class="anp"><img class="cu" src="<?php echo Data::getPhotoUser($followers->getFollower()->getId_user());?>"></li>
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
            <?php foreach( $this->follow->listFollowing($this->obj->getId_user()) as $following ){?>
              <li class="anp"><img class="cu" src="<?php echo Data::getPhotoUser($following->getUser()->getId_user());?>"></li>
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
