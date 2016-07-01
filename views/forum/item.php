<div class="hl">

<ul class="ca qo anx">

	<li class="qf b aml row">
	
		<ol class="breadcrumb">
		  <li><a href="<?php echo URL?>">Home</a></li>
		  <li><a href="<?php echo URL?>forum">Forum</a></li>
		  <li class="active"><?php echo $this->objTopic->getName();?></li>
		</ol>
		
		<div class="row" style="margin-bottom: 15px">
			<div class="col-md-12" style="text-align: right;">
				<a href="<?php echo URL; ?>forum/write/<?php echo $this->objTopic->getId_topic(); ?>" class="cg ts fx"><i class="glyphicon glyphicon-plus"></i> Novo tópico</a>
				
				<button type="button" class="cg ts fx bt-notify" >
				  <i class="glyphicon glyphicon-tag"></i> Não receber alertas ou e-mail
				</button>
				
			</div>
		</div>
		
		<div class="row" style="margin-bottom: 15px">
			<div class="col-md-12">
				<div style="background: #583F7E; color: #fff; padding: 10px; border-radius:4px" id="tes">
					<?php echo $this->objTopic->getName();?>
				</div>
			</div>
		</div>
		
		<?php if (isset($_GET["st"])) { $objAlert = new Alerta($_GET["st"]); } ?>
		
		<table class="table table-striped sortable table-condensed">
			<thead>
			<tr>
				<th>Assunto </th>
				<th>Membro </th>
				<th></th>
				<th>Último post</th>
			</tr>
			</thead>
			<tbody>
			<?php foreach( $this->objItem->listarItemByTopic( $this->objTopic->getId_topic() ) as $item ) { ?>
			<tr>
				<td>
					<a href="<?php echo URL . 'forum/detail/' . $item->getId_item(); ?>">
						<?php echo $item->getTitle(); ?>
					</a>
					
					<?php if( Session::get('userid') == $item->getUser()->getId_user() ) {?>
					<a href="<?php echo URL . 'forum/write/'. $this->objTopic->getId_topic() .'/' . $item->getId_item() ?>">[ <i class="glyphicon glyphicon-pencil"></i> ]</a>
					<?php } ?>
					
				</td>
				
				<td><?php echo $item->getUser()->getLogin(); ?></td>
				<td align="center">
					<div class="col-md-6"><small><strong><?php echo "23"; ?></strong><br>Respostas</small></div>
					<div class="col-md-6"><small><strong><?php echo "87"; ?></strong><br>Visualizações</small></div>
				</td>
				<td><a href="">4 de Jun, 2016<br><small>por @user_name</small></a></td>
			</tr>
			<?php } ?>
			</tbody>
		</table>
	</li>

</ul>
</div>

<style>
.popover{
	width: 550px;
}
</style>

<div id="p-notify" style="display:none; font-size: 80%">

	<p>
		<a href="">
			<strong>Não receber alertas ou e-mails</strong><br>
			<small>Você não receberá nenhum e-mails ou alertas</small>
		</a>
	</p>
	
	<p>
		<a href="">
			<strong>Receber alertas</strong><br>
			<small>Você receberá alertas para este tópico.</small>
		</a>
	</p>
	
	<p>
		<a href="">
			<strong>Receber e-mails</strong><br>
			<small>Você receberá e-mails para este tópico.</small>
		</a>
	</p>
	
	<p>
		<a href="">
			<strong>Receber e-mails e alertas</strong><br>
			<small>Você receberá ambos os alertas e e-mails para este tópico.</small>
		</a>
	</p>

</div>