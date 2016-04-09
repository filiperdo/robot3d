<!-- Page Heading -->
<div class="row">
	<div class="col-lg-12">
		<h1 class="page-header"><?php echo $this->title; ?></h1>
		<div class="row">
			<div class="col-lg-6 col-md-6">
				<ol class="breadcrumb">
					<li><a href="index.php">Home</a></li>
					<li class="active"><a href="<?php echo URL;?>fpost"><?php echo $this->title; ?></a></li>
				</ol>
			</div>
			<div class="col-lg-4 col-md-3">
			<form name="form-search" action="<?php echo URL;?>fpost" method="post">
				<div class="form-group input-group">
					<input type="text" class="form-control" required="required" name="like" id="busca">
					<span class="input-group-btn">
						<button class="btn btn-default" type="submit">
								<i class="glyphicon glyphicon-search"></i>
						</button>
					</span>
				</div>
				</form>
			</div>
			<div class="col-lg-2 col-md-2">
				<a href="<?php echo URL;?>fpost/form" class="btn btn-success">Cadastrar <?php echo $this->title; ?></a>
			</div>
		</div>
	</div>
</div>
<!-- /.row -->

<?php if (isset($_GET["st"])) { $objAlert = new Alerta($_GET["st"]); } ?>

<table class="table table-striped sortable table-condensed">
	<thead>
	<tr>
		<th>Id_fpost </th>
		<th>Views </th>
		<th>Content </th>
		<th>Date </th>
		<th>Id_user </th>
		<th>Id_ftopic </th>
		<th></th>
	</tr>
	</thead>
	<tbody>
	<?php foreach( $this->listarFpost as $fpost ) { ?>
	<tr>
 		<td><?php echo $fpost->getId_fpost(); ?></td>
		<td><?php echo $fpost->getViews(); ?></td>
		<td><?php echo $fpost->getContent(); ?></td>
		<td><?php echo $fpost->getDate(); ?></td>
		<td><?php echo $fpost->getId_user(); ?></td>
		<td><?php echo $fpost->getId_ftopic(); ?></td>
		<td align="right">
			<a href="<?php echo URL;?>fpost/form/<?php echo $fpost->getId_fpost();?>" class="btn btn-info btn-sm"><i class="glyphicon glyphicon-pencil"></i></a>
			<a href="<?php echo URL;?>fpost/delete/<?php echo $fpost->getId_fpost();?>" class="delete btn btn-danger btn-sm"><i class="glyphicon glyphicon-trash"></i></a>
		</td>
		</tr>
	<?php } ?>
	</tbody>
</table>


<script>
$(function() {
	$(".delete").click(function(e) {
		var c = confirm("Deseja realmente deletar este registro?");
		if (c == false) return false;
	}); 
 });
</script>