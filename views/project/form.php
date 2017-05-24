
<!-- Styles -->
<link href="<?php echo URL?>util/jqueryfiler/css/jquery.filer.css" rel="stylesheet">
<link href="<?php echo URL?>util/jqueryfiler/css/themes/jquery.filer-dragdropbox-theme.css" rel="stylesheet">

<!-- Jvascript -->
<script src="<?php echo URL?>util/jqueryfiler/js/jquery.filer.min.js" type="text/javascript"></script>
<script src="<?php echo URL?>util/jqueryfiler/js/custom-project.js" type="text/javascript"></script>


<link href="<?php echo URL; ?>public/css/wizard.css" rel="stylesheet">

<div class="hl">
  <ul class="ca qo anx">
	<li class="b qf aml">
	  <div class="qg">
		<div class="alk">

		  <h3 class="alc page-header">Publicar Projeto</h3>

		  <div class="row" style="margin-top: 20px">
              <div class="col-md-12 col-sm-12 col-xs-12">



                    <div class="" role="tabpanel" data-example-id="togglable-tabs">

                        <ul id="myTab" class="nav nav-tabs bar_tabs" role="tablist">
                            <li role="presentation" class="active"><a href="#tab_content1" id="tab1" role="tab" data-toggle="tab" aria-expanded="true">Dados basicos</a></li>
                            <?php if( $this->action == 'create' ){ ?>
                                <li role="presentation" class="disabled"><a href="" role="tab" id="tab2" data-toggle="tab" aria-expanded="false">O projeto</a></li>
                                <!--<li role="presentation" class="disabled"><a href="" role="tab" id="tab3" data-toggle="tab" aria-expanded="false">Equipe</a></li>-->
                                <li role="presentation" class="disabled"><a href="" role="tab" id="tab4" data-toggle="tab" aria-expanded="false">Hardware</a></li>
                                <li role="presentation" class="disabled"><a href="" role="tab" id="tab5" data-toggle="tab" aria-expanded="false">Software</a></li>
                            <?php } else { ?>
                                <li role="presentation" class=""><a href="#tab_content2" role="tab" id="tab2" data-toggle="tab" aria-expanded="false">O projeto</a></li>
                                <!--<li role="presentation" class=""><a href="#tab_content3" role="tab" id="tab3" data-toggle="tab" aria-expanded="false">Equipe</a></li>-->
                                <li role="presentation" class=""><a href="#tab_content4" role="tab" id="tab4" data-toggle="tab" aria-expanded="false">Hardware</a></li>
                                <li role="presentation" class=""><a href="#tab_content5" role="tab" id="tab5" data-toggle="tab" aria-expanded="false">Software</a></li>
                            <?php } ?>
                        </ul>

                        <form id="form1" name="form1" method="post" action="<?php echo URL;?>project/<?php echo $this->action;?>/" class="form-horizontal" enctype="multipart/form-data">
                        <input type="hidden" name="idProject" value="<?=$this->obj->getId_project()?>" />
                        <input type="hidden" name="idTab" id="tab_id" value="<?=$this->idtab?>" />

                        <div id="myTabContent" class="tab-content">

                            <div role="tabpanel" class="tab-pane fade active in" id="tab_content1" aria-labelledby="home-tab">
                                <div class="col-md-12 col-sm-12 col-xs-12">

                                    <h3 class="StepTitle">Dados básicos</h3>
                                    <div class="form-group">
                  						  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="title">Nome do projeto <span class="required">*</span>
                  						  </label>
                  						  <div class="col-md-6 col-sm-6 col-xs-12">
                  						  	<input type="text" id="title" name="title" required="required" class="form-control col-md-7 col-xs-12" value="<?=$this->obj->getTitle()?>">
                  						  </div>
                  					  </div>

                                        <div class="form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="photo_project">Foto <span class="required">*</span></label>

                                            <div class="col-md-6 col-sm-6 col-xs-12">

                                                <?php if( file_exists('public/img/project/'.$this->obj->getPath().'/'.$this->obj->getMainpicture()) ) { ?>
                                                    <p><img src="<?=URL?>public/img/project/<?=$this->obj->getPath().'/'.$this->obj->getMainpicture()?>" alt="" class="img-responsive" width="250px"></p>
                                                    <p><a href="<?=URL?>project/deleteimg/<?=$this->obj->getId_project().'/'.$this->obj->getPath().'/'.$this->obj->getMainpicture()?>" class="delete btn btn-danger btn-sm"><i class="glyphicon glyphicon-trash"></i> Deletar</a></p>
                                                <?php } else { ?>
                                                    <input type="file" name="photo_project" required="required">
                                                    <p>Selecione a melhor foto do projeto. Esta será a foto de capa.</p>
                                                <?php } ?>

                                            </div>
                                        </div>

                  					  <div class="form-group">
                  						  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="summary">Resumo <span class="required">*</span>
                  						  </label>
                  						  <div class="col-md-6 col-sm-6 col-xs-12">
                                                <textarea name="summary" rows="4" cols="80" required="required" class="form-control col-md-6 col-sm-6 col-xs-12" placeholder="Breve descrição do projeto"><?=$this->obj->getSummary()?></textarea>
                  						  </div>
                  					  </div>

                  					  <div class="form-group">
                  						  <label for="level" class="control-label col-md-3 col-sm-3 col-xs-12">Level</label>
                  						  <div class="col-md-6 col-sm-6 col-xs-12">
                                              <select class="form-control col-md-6 col-sm-6 col-xs-12" name="level" id="level">
                                                  <option value="1" <?php echo $this->obj->getLevel() == 1 ? 'selected="selected"' : ''; ?>>Iniciante</option>
                                                  <option value="2" <?php echo $this->obj->getLevel() == 2 ? 'selected="selected"' : ''; ?>>Intermediário</option>
                                                  <option value="3" <?php echo $this->obj->getLevel() == 3 ? 'selected="selected"' : ''; ?>>Avançado</option>
                                                  <option value="4" <?php echo $this->obj->getLevel() == 4 ? 'selected="selected"' : ''; ?>>Especialista</option>
                                              </select>
                                              <p>Qual o conhecimento necessário para replicar este projeto?</p>
                  						  </div>
                  					  </div>

                  					  <div class="form-group">
                  						  <label class="control-label col-md-3 col-sm-3 col-xs-12">Tags<span class="required">*</span>
                  						  </label>
                  						  <div class="col-md-6 col-sm-6 col-xs-12">
                  						  	<input id="birthday" name="tags" class="date-picker form-control col-md-7 col-xs-12" required="required" type="text" value="<?=$this->obj->getTags()?>">
                                              <p>Selecione até três tags para categorizar seu projeto.</p>
                  						  </div>
                  					  </div>

                                      <div class="form-group">
                  						  <label class="control-label col-md-3 col-sm-3 col-xs-12">
                  						  </label>
                  						  <div class="col-md-6 col-sm-6 col-xs-12">
                  						  	<button type="submit" class="btn btn-default" name="button"><i class="glyphicon glyphicon-floppy-disk"></i> Salvar</button>
                  						  </div>
                  					  </div>

                              </div><!-- col-md-12 col-sm-12 col-xs-12 -->
                            </div><!-- tab_content1 -->


                            <div role="tabpanel" class="tab-pane fade" id="tab_content2" aria-labelledby="profile-tab">

                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <h3 class="StepTitle">O projeto</h3>
                                    <p>O que é seu projeto? Por que você fez? Como funciona? Mostre-nos com imagens e vídeos!</p>

                                    <!--<form name="form5" action="http://localhost/robot3d/project/wideimage_ajax/" method="post" enctype="multipart/form-data" >
                                        <input type="file" name="files[]"  multiple="multiple" >
                                        <input type="submit">
                                    </form>-->

                                    <input type="hidden" name="action_post" id="action_post" value="<?php echo $this->method_upload; ?>">
                                    <input type="file" name="files[]" id="filer_input2" multiple="multiple">

                                    <div id="output-files">
                                    <div class="jFiler-items-list jFiler-items-grid" >

                                        <?php if( $this->path != '' ) { ?>
                                        <?php foreach ( Data::getImgPost('project', $this->path, true ) as $img ) { ?>

                                        <?php
                                        // pega o nome da imagem
                                        $array_img = explode('/', $img); $nome_img = end($array_img);
                                        ?>

                                        <div class="jFiler-item" id="<?php echo 'id-'.base64_encode($nome_img);?>">
                                            <div class="jFiler-item-container">
                                                <div class="jFiler-item-inner">
                                                    <div class="jFiler-item-thumb"><img alt="" src="<?=URL.$img?>" ></div>
                                                    <div class="jFiler-item-assets jFiler-row" style="text-align:center">
                                                        <ul class="list-inline pull-right">
                                                            <?php $link_img = str_replace('/thumb/', '/', $img);?>
                                                            <li>
                                                                <button class="bt-copy btn btn-info btn-xs" data-clipboard-action="copy" data-clipboard-text="<?='../../'.$link_img?>"><i class="glyphicon glyphicon-link"></i></button>
                                                                <a rel="<?php echo base64_encode($this->obj->getPath());?>" name="<?php echo base64_encode($nome_img); ?>" href="#" class="btn delete btn-danger btn-xs"><i class="icon-jfi-trash jFiler-item-trash-action"></i> Deletar</a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <?php } // end foreach?>
                                        <?php } // end if ?>
                                    </div>
                                    </div>
                                    <p><textarea class="form-control" id="content" name="content" rows="53"><?=$this->obj->getContent()?></textarea></p>

                                    <div class="form-group">

                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                          <button type="submit" class="btn btn-default" name="button"><i class="glyphicon glyphicon-floppy-disk"></i> Salvar</button>
                                        </div>
                                    </div>

                                </div>
                            </div><!-- tab_content2 -->


                            <!--<div role="tabpanel" class="tab-pane fade" id="tab_content3" aria-labelledby="profile-tab">
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <h3 class="StepTitle">Equipe</h3>
                  					  <p>
                  					  do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu
                  					  fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                  					  </p>
                  					  <p>
                  					  Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor
                  					  in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                  					  </p>
                                      <div class="form-group">
                                          <div class="col-md-6 col-sm-6 col-xs-12">
                                            <button type="submit" class="btn btn-default" name="button"><i class="glyphicon glyphicon-floppy-disk"></i> Salvar</button>
                                          </div>
                                      </div>
                                </div>
                            </div>--> <!-- tab_content3 -->

                            <div role="tabpanel" class="tab-pane fade" id="tab_content4" aria-labelledby="profile-tab">
                                <div class="col-md-12 col-sm-12 col-xs-12">
              					  <h3 class="StepTitle">Hardware</h3>
              					  <p>Quais são os componentes que você está usando neste projeto? Onde são encontrados?</p>

                                    <div class="group-component">
                                        <div class="form-group">
                  						  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="title">Componente <span class="required">*</span>
                  						  </label>
                  						  <div class="col-md-6 col-sm-6 col-xs-9">
                  						  	<input type="text" name="name_component" id="name_component" class="form-control col-md-7 col-xs-10">
                  						  </div>
                                            <div class="col-md-2 col-sm-2 col-xs-3">
                  						  	<input type="number" name="amount_component" id="amount_component" class="form-control col-md-7 col-xs-2" value="1">
                  						  </div>
                  					  </div>
                                        <div class="form-group">
                  						  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="title">Link <span class="required">(Opcional)</span>
                  						  </label>
                  						  <div class="col-md-8 col-sm-8 col-xs-12">
                  						  	<input type="text" name="link_component" id="link_component" class="form-control col-md-7 col-xs-12">
                  						  </div>
                  					  </div>
                                    </div>

                                    <div class="form-group" style="text-align:center">
                                        <button type="submit" name="button" class="btn btn-success add-comp">Adicionar Component</button>
                                    </div>

                                    <div class="component-added">
                                        <?php if( $this->action != 'create' ) { ?>
                                        <table id="datatable-responsive" class="table table-condensed" cellspacing="0" width="100%">
                                        	<thead>
                                        	<tr>
                                        		<th>Nome </th>
                                        		<th>Qtde</th>
                                                <th></th>
                                        	</tr>
                                        	</thead>
                                        	<tbody>
                                        	<?php foreach ($this->component->listComponentByProject($this->obj->getId_project()) as $component) { ?>
                                        	<tr>
                                        		<td><?php echo $component->getName(); ?></td>
                                                <td><?php echo $component->getAmount(); ?></td>
                                                <td align="right">
                                                    <a href="#" class="btn btn-default disabled btn-sm"> <i class="glyphicon glyphicon-shopping-cart"></i> Comprar</a>
                                                    <a href="<?=URL?>component/delete/<?=$component->getId_component()?>/?idProj=<?=$this->obj->getId_project()?>&idTab=4" class="btn btn-danger btn-sm"> <i class="glyphicon glyphicon-trash"></i></a>
                                                </td>
                                        	</tr>
                                        	<?php } ?>
                                        	</tbody>
                                        </table>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div><!-- tab_content4 -->

                            <div role="tabpanel" class="tab-pane fade" id="tab_content5" aria-labelledby="profile-tab">
                                <div class="col-md-12 col-sm-12 col-xs-12">
              					  <h3 class="StepTitle">Software</h3>
                                  <p>Qual é o código que impulsiona este projeto? Quais aplicativos ou serviços on-line você está usando?</p>
                                </div>
                            </div><!-- tab_content5 -->

                        </div><!-- myTabContent -->
                        </form>
                    </div>

		       </div>
           </div>
		</div>
	  </div>
	</li>

  </ul>
</div>

<!-- pace -->

<script src="<?=URL?>public/js/pace/pace.min.js"></script>
<script type="text/javascript">
$(document).ready(function() {

    $('.bar_tabs a').on('click', function(){
        $('#tab_id').val( $(this).attr('id').substring(3,4) );
    });

    $('#myTab a[href="#tab_content<?=$this->idtab?>"]').tab('show');

});

</script>

<script>

	var clipboard = new Clipboard('.bt-copy');

</script>

<script src='<?php echo URL?>util/tinymce/tinymce.min.js'></script>
<script>

  tinymce.init({
	  selector: '#content',
	  theme: 'modern',
	  menubar:false,
	  image_prepend_url: "<?php echo URL?>",
	  plugins: [
	    'advlist autolink lists link image charmap print preview hr anchor pagebreak',
	    'searchreplace wordcount visualblocks visualchars code fullscreen',
	    'insertdatetime media nonbreaking save table contextmenu directionality',
	    'emoticons template paste textcolor colorpicker textpattern imagetools'
	  ],
	  toolbar1: ' bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image | print preview media | forecolor backcolor source code',
  });

</script>
