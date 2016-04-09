<!-- Page Heading -->
<div class="row">
	<div class="col-lg-12">
		<h1 class="page-header"><?php echo $this->title; ?></h1>
		<div class="row">
			<div class="col-lg-6 col-md-6">
				<ol class="breadcrumb">
					<li><a href="index.php">Home</a></li>
					<li class="active"><a href="<?php echo URL;?>project"><?php echo $this->title; ?></a></li>
				</ol>
			</div>
			<div class="col-lg-4 col-md-3">
			<form name="form-search" action="<?php echo URL;?>project" method="post">
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
				<a href="<?php echo URL;?>project/form" class="btn btn-success">Cadastrar <?php echo $this->title; ?></a>
			</div>
		</div>
	</div>
</div>
<!-- /.row -->

<?php if (isset($_GET["st"])) { $objAlert = new Alerta($_GET["st"]); } ?>

<table class="table table-striped sortable table-condensed">
	<thead>
	<tr>
		<th>Id_project </th>
		<th>Name </th>
		<th>Website </th>
		<th>Link_image </th>
		<th>Description </th>
		<th>Date </th>
		<th>Id_user </th>
		<th></th>
	</tr>
	</thead>
	<tbody>
	<?php foreach( $this->listarProject as $project ) { ?>
	<tr>
 		<td><?php echo $project->getId_project(); ?></td>
		<td><?php echo $project->getName(); ?></td>
		<td><?php echo $project->getWebsite(); ?></td>
		<td><?php echo $project->getLink_image(); ?></td>
		<td><?php echo $project->getDescription(); ?></td>
		<td><?php echo $project->getDate(); ?></td>
		<td><?php echo $project->getId_user(); ?></td>
		<td align="right">
			<a href="<?php echo URL;?>project/form/<?php echo $project->getId_project();?>" class="btn btn-info btn-sm"><i class="glyphicon glyphicon-pencil"></i></a>
			<a href="<?php echo URL;?>project/delete/<?php echo $project->getId_project();?>" class="delete btn btn-danger btn-sm"><i class="glyphicon glyphicon-trash"></i></a>
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