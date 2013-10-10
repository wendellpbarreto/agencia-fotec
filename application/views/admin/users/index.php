<div class="navbar navbar-static-top">
	<div class="navbar-inner">
		<ul class="breadcrumb">
			<li><?= anchor('admin/users', 'Usuários'); ?> <span class="divider"></span></li>
			<li class="active">Index</li>
		</ul>
	</div>
</div>

<div class="container-fluid">
	<div class="row-fluid">
		<div class="span12">
			<div class="page-header line1">
				<h4>Usuários <small>Lista de usuários registrados</small></h4>
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
				<h4 class="title">Usuários Ativos</h4>
				<?= anchor('admin/users/add', 'add', attr('class:badge')) ?>
			</header>
			<section class="body">
				<div class="body-inner no-padding">
					<?php if ($users) : ?>
					<table class="table datatable actives">
						<thead>
							<tr>
								<th>Nome</th>
								<th>Cargo</th>
								<th>E-mail</th>
								<th>Última Atualização</th>
								<th class="span2">Ações</th>
							</tr>
						</thead>
						<tbody>
							<?php foreach($users as $user) : ?>
							<tr>
								<td><?= $user->name ?></td>
								<td><?= user_types()[$user->type] ?></td>
								<td><?= $user->email ?></td>
								<td class="humanize" title="<?= $user->updated_at ?>"></td>
								<td>
									<?= anchor('admin/users/edit/'. $user->id, '<i class="icon-pencil"></i>', attr('class:btn btn-small')) ?>
									<?= anchor('admin/users/delete/'. $user->id, '<i class="icon-trash"></i>', attr('class:btn btn-small async','data-identity:'.$user->id)) ?>
								</td>
							</tr>
							<?php endforeach; ?>
						</tbody>
					</table>
					<?php else : ?>
					<p class="well">Não há usuários ativos</p>
					<?php endif; ?>
				</div>
			</section>
		</div>
	</div>

	<div class="row-fluid">
		<div class="span12 widget red">
			<header>
				<h4 class="title">Usuários Inativos</h4>
			</header>
			<section class="body">
				<div class="body-inner no-padding">
					<?php if ($disabled_users) : ?>
					<table class="table datatable inactives">
						<thead>
							<tr>
								<th>Nome</th>
								<th>Cargo</th>
								<th>E-mail</th>
								<th>Data de Exclusão</th>
								<th class="span2">Ações</th>
							</tr>
						</thead>
						<tbody>
							<?php foreach($disabled_users as $user) : ?>
							<tr>
								<td><?= $user->name ?></td>
								<td><?= user_types()[$user->type] ?></td>
								<td><?= $user->email ?></td>
								<td class="humanize" title="<?= $user->deleted_at ?>"></td>
								<td>
									<?= anchor('admin/users/activate/'. $user->id, '<i class="icon-check"></i>', attr('class:btn btn-small async','data-identity:'.$user->id)) ?>
									<?= anchor('admin/users/hard_delete/'. $user->id, '<i class="icon-remove"></i>', attr('class:btn btn-small async','data-identity:'.$user->id)) ?>
								</td>
							</tr>
							<?php endforeach; ?>
						</tbody>
					</table>
					<?php else : ?>
					<p class="well">Não há usuários inativos</p>
					<?php endif; ?>
				</div>
			</section>
		</div>
	</div>
</div>