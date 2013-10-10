<div class="navbar navbar-static-top">
	<div class="navbar-inner">
		<ul class="breadcrumb">
			<li><?= anchor('admin/news', 'Notícias'); ?> <span class="divider"></span></li>
			<li class="active">Index</li>
		</ul>
	</div>
</div>

<div class="container-fluid">
	<div class="row-fluid">
		<div class="span12">
			<div class="page-header line1">
				<h4>Notícias <small>Lista de notícias registrados</small></h4>
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
				<h4 class="title">Notícias Publicadas</h4>
				<?= anchor('admin/news/add', 'add', attr('class:badge')) ?>
			</header>
			<section class="body">
				<div class="body-inner no-padding">
					<?php if ($news) : ?>
					<table class="table datatable actives">
						<thead>
							<tr>
								<th>Título</th>
								<th>Editorial</th>
								<th>Última Atualização</th>
								<th class="span2">Ações</th>
							</tr>
						</thead>
						<tbody>
							<?php foreach($news as $item) : ?>
							<tr>
								<td><?= $item->title ?></td>
								<td><?= $item->category ?></td>
								<td class="humanize" title="<?= $item->updated_at ?>"></td>
								<td>
									<?= ((user_is('revisor'))?anchor('admin/news/edit/'. $item->id, '<i class="icon-pencil"></i>', attr('class:btn btn-small')):'') ?>
									<?= anchor('admin/news/delete/'. $item->id, '<i class="icon-trash"></i>', attr('class:btn btn-small async','data-identity:'.$item->id)) ?>
								</td>
							</tr>
							<?php endforeach; ?>
						</tbody>
					</table>
					<?php else : ?>
					<p class="well">Não há notícias publicadas</p>
					<?php endif; ?>
				</div>
			</section>
		</div>
	</div>

	<div class="row-fluid">
		<div class="span12 widget green">
			<header>
				<h4 class="title">Notícias Aguardando Revisão</h4>
			</header>
			<section class="body">
				<div class="body-inner no-padding">
					<?php if ($unpublished_news) : ?>
					<table class="table datatable inactives">
						<thead>
							<tr>
								<th>Nome</th>
								<th>Editorial</th>
								<th>Data de Criação</th>
								<th class="span2">Ações</th>
							</tr>
						</thead>
						<tbody>
							<?php foreach($unpublished_news as $item) : ?>
							<tr>
								<td><?= $item->title ?></td>
								<td><?= $item->category ?></td>
								<td class="humanize" title="<?= $item->created_at ?>"></td>
								<td>
									<?= ((user_is('revisor'))?anchor('admin/news/edit/'. $item->id, '<i class="icon-pencil"></i>', attr('class:btn btn-small')):'') ?>
									<?= anchor('admin/news/delete/'. $item->id, '<i class="icon-trash"></i>', attr('class:btn btn-small async','data-identity:'.$item->id)) ?>
								</td>
							</tr>
							<?php endforeach; ?>
						</tbody>
					</table>
					<?php else : ?>
					<p class="well">Não há notícias aguardando revisão</p>
					<?php endif; ?>
				</div>
			</section>
		</div>
	</div>

	<div class="row-fluid">
		<div class="span12 widget red">
			<header>
				<h4 class="title">Notícias Inativas</h4>
			</header>
			<section class="body">
				<div class="body-inner no-padding">
					<?php if ($disabled_news) : ?>
					<table class="table datatable inactives">
						<thead>
							<tr>
								<th>Nome</th>
								<th>Editorial</th>
								<th>Data de Exclusão</th>
								<th class="span2">Ações</th>
							</tr>
						</thead>
						<tbody>
							<?php foreach($disabled_news as $item) : ?>
							<tr>
								<td><?= $item->title ?></td>
								<td><?= $item->category ?></td>
								<td class="humanize" title="<?= $item->deleted_at ?>"></td>
								<td>
									<?= anchor('admin/news/activate/'. $item->id, '<i class="icon-check"></i>', attr('class:btn btn-small async','data-identity:'.$item->id)) ?>
									<?= anchor('admin/news/hard_delete/'. $item->id, '<i class="icon-remove"></i>', attr('class:btn btn-small async','data-identity:'.$item->id)) ?>
								</td>
							</tr>
							<?php endforeach; ?>
						</tbody>
					</table>
					<?php else : ?>
					<p class="well">Não há notícias inativas</p>
					<?php endif; ?>
				</div>
			</section>
		</div>
	</div>
</div>