<div class="hl">

<ul class="ca qo anx">

	<li class="qf b aml row">
	
		<ol class="breadcrumb">
		  <li><a href="<?php echo URL?>">Home</a></li>
		  <li><a href="<?php echo URL?>forum">Forum</a></li>
		  <li class="active"><?php echo $this->objTopic->getName();?></li>
		</ol>
		
		<div class="row" style="margin-bottom: 10px">
			<div class="col-md-12">
				<a href="<?php echo URL; ?>forum/write/<?php echo $this->objTopic->getId_topic(); ?>" class="cg ts fx"><i class="glyphicon glyphicon-plus"></i> Novo topico</a>
			</div>
		</div>
		
		<table class="table table-striped sortable table-condensed">
			<thead>
			<tr>
				<th>Assunto </th>
				<th>Date </th>
				<th>User </th>
				<th></th>
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
				<td><?php echo Data::formataDataRetiraHora( $item->getDate() ); ?></td>
				<td><?php echo $item->getUser()->getLogin(); ?></td>
				<td align="center"><small><strong><?php echo "23"; ?></strong> Respostas <br> <strong><?php echo "87"; ?></strong> Visualizacoes</small></td>
			</tr>
			<?php } ?>
			</tbody>
		</table>
	</li>

</ul>
</div>