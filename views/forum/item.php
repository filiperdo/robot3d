<div class="hl">

<ul class="ca qo anx">

	<li class="qf b aml row">
	
		<ol class="breadcrumb">
		  <li><a href="<?php echo URL?>">Home</a></li>
		  <li><a href="<?php echo URL?>forum">Forum</a></li>
		  <li class="active"><?php echo $this->objTopic->getName();?></li>
		</ol>
		
		<div class="row" style="margin-bottom: 10px">
			<div class="col-md-12" style="text-align: right;">
				<a href="<?php echo URL; ?>forum/write/<?php echo $this->objTopic->getId_topic(); ?>" class="cg ts fx"><i class="glyphicon glyphicon-plus"></i> Novo topico</a>
				<a href="" class="cg ts fx"><i class="glyphicon glyphicon-tag"></i> Não receber alertas</a>
			</div>
		</div>
		
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