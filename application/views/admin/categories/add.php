<div class="navbar navbar-static-top">
	<div class="navbar-inner">
		<!-- Breadcrumb -->
		<ul class="breadcrumb">
			<li><?= anchor('admin/categories', 'Editoriais'); ?> <span class="divider"></span></li>
			<li class="active">Adicionar</li>
		</ul>
		<!--/ Breadcrumb -->
	</div>
</div>

<div class="container-fluid">
	<div class="row-fluid">
		<div class="span12">
			<div class="page-header line1">
				<h4>Adicionar Editorial <small>Todos os campos com * são obrigatórios</small></h4>
			</div>
		</div>
	</div>

	<div class="row-fluid">
		<?= form_open('admin/categories/add', attr('class:span12 widget dark form-horizontal bordered')) ?>
			<header>
				<h4 class="title">
					<span class="icon icone-folder-open"></span>
					Dados do Editorial
				</h4>
			</header>
			<section class="body">
				<div class="body-inner">
					<?php if ($errors OR $messages) : ?>
					<div class="control-group">
						<?php if ($errors) : ?>
						<div class="alert alert-danger">
							<?php foreach ($errors as $error) : ?>
							<?= $error ?>
							<?php endforeach; ?>
						</div>
						<?php endif; ?>
						<?php if ($messages) : ?>
						<div class="alert alert-success">
							<?php foreach ($messages as $message) : ?>
							<?= $message ?>
							<?php endforeach; ?>
						</div>
						<?php endif; ?>
					</div>
					<?php endif; ?>

					<div class="control-group">
						<?= form_label('Nome *', 'name', attr('class:control-label')) ?>
						<div class="controls">
							<?= form_input(attr('name:name', 'placeholder:Apenas para identificação', 'class:span12', 'value:'.$post['name'])) ?>
						</div>
					</div>
				</div>

				<div class="form-actions">
					<?= form_button(attr('class:btn btn-primary', 'content:Criar', 'type:submit')) ?>
					<?= anchor('admin/categories', 'Cancelar', attr('class:btn', 'type:button')) ?>
				</div>
			</section>
		<?= form_close() ?>
	</div>
</div>