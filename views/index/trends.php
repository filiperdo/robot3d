<link href="<?php echo URL?>public/css/bootstrap.min.css" rel="stylesheet">

<body >

  <div class="container body">


    <div class="main_container">

<table class="table table-striped sortable table-condensed">
	<thead>
	<tr>
		<th>Nome </th>
        <th>Preço</th>
		<th>Condição </th>
        <th>Vendidos </th>
		<th>Região</th>
	</tr>
	</thead>
	<tbody>
	<?php foreach( $this->json as $json ) { ?>
	<tr>
 		<td>
            <?php if( $json->href != '' ) { ?>
            <a href="<?php echo $json->href; ?>" target="_blank"><?php echo $json->descricao; ?></a>
            <?php } else { ?>
            <?php echo $json->descricao; ?>
            <?php } ?>
        </td>
        <td><?php echo $json->preco; ?></td>
		<td><?php echo $json->condicao; ?></td>
        <td><?php echo $json->vendidos; ?></td>
		<td><?php echo $json->regiao; ?></td>

		</tr>
	<?php } ?>
	</tbody>
</table>


</div>
</div>
</body>
