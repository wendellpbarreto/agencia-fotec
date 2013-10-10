<div class="navbar navbar-static-top">
	<div class="navbar-inner">
		<ul class="breadcrumb">
			<li><?= anchor('admin/categories', 'Editoriais'); ?> <span class="divider"></span></li>
			<li class="active">Index</li>
		</ul>
	</div>
</div>

<div class="container-fluid">
	<div class="row-fluid">
		<div class="span12">
			<div class="page-header line1">
				<h4>Editoriais <small>Lista de editoriais registrados</small></h4>
			</div>
		</div>
	</div>

	<?php if ($messages) : ?>
	<div class="row-fluid">
		<div class="span12">
			<div class="alert alert-success">
				<?php foreach ($messages as $message) : ?>
				<?= $message ?>
				<?php endforeach; ?>
			</div>
		</div>
	</div>
	<?php endif; ?>

	<?php if ($errors) : ?>
	<div class="row-fluid">
		<div class="span12">
			<div class="alert alert-danger">
				<?php foreach ($errors as $error) : ?>
				<?= $error ?>
				<?php endforeach; ?>
			</div>
		</div>
	</div>
	<?php endif; ?>

	<div class="row-fluid">
		<div class="span12 widget dark">
			<header>
				<h4 class="title">Editoriais Ativos</h4>
				<?= anchor('admin/categories/add', 'add', attr('class:badge')) ?>
			</header>
			<section class="body">
				<div class="body-inner no-padding">
					<?php if ($categories) : ?>
					<table class="table datatable actives">
						<thead>
							<tr>
								<th>Nome</th>
								<th>Última Atualização</th>
								<th class="span2">Ações</th>
							</tr>
						</thead>
						<tbody>
							<?php foreach($categories as $category) : ?>
							<tr>
								<td><?= $category->name ?></td>
								<td class="humanize" title="<?= $category->updated_at ?>"></td>
								<td>
									<?= anchor('admin/categories/edit/'. $category->id, '<i class="icon-pencil"></i>', attr('class:btn btn-small')) ?>
									<?= anchor('admin/categories/delete/'. $category->id, '<i class="icon-trash"></i>', attr('class:btn btn-small async','data-identity:'.$category->id)) ?>
								</td>
							</tr>
							<?php endforeach; ?>
						</tbody>
					</table>
					<?php else : ?>
					<p class="well">Não há editoriais ativos</p>
					<?php endif; ?>
				</div>
			</section>
		</div>
	</div>

	<div class="row-fluid">
		<div class="span12 widget red">
			<header>
				<h4 class="title">Editoriais Inativos</h4>
			</header>
			<section class="body">
				<div class="body-inner no-padding">
					<?php if ($disabled_categories) : ?>
					<table class="table datatable inactives">
						<thead>
							<tr>
								<th>Nome</th>
								<th>Data de Exclusão</th>
								<th class="span2">Ações</th>
							</tr>
						</thead>
						<tbody>
							<?php foreach($disabled_categories as $category) : ?>
							<tr>
								<td><?= $category->name ?></td>
								<td class="humanize" title="<?= $category->deleted_at ?>"></td>
								<td>
									<?= anchor('admin/categories/activate/'. $category->id, '<i class="icon-check"></i>', attr('class:btn btn-small async','data-identity:'.$category->id)) ?>
									<?= anchor('admin/categories/hard_delete/'. $category->id, '<i class="icon-remove"></i>', attr('class:btn btn-small async','data-identity:'.$category->id)) ?>
								</td>
							</tr>
							<?php endforeach; ?>
						</tbody>
					</table>
					<?php else : ?>
					<p class="well">Não há editoriais inativos</p>
					<?php endif; ?>
				</div>
			</section>
		</div>
	</div>
</div>