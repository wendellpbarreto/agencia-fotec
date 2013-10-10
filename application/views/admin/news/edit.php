<div class="navbar navbar-static-top">
	<div class="navbar-inner">
		<!-- Breadcrumb -->
		<ul class="breadcrumb">
			<li><?= anchor('admin/news', 'Notícias'); ?> <span class="divider"></span></li>
			<li class="active">Editar (<?= $data->title?>)</li>
		</ul>
		<!--/ Breadcrumb -->
	</div>
</div>

<div class="container-fluid">
	<div class="row-fluid">
		<div class="span12">
			<div class="page-header line1">
				<h4>Editar Notícia <small>Todos os campos com * são obrigatórios</small></h4>
			</div>
		</div>
	</div>

	<div class="row-fluid">
		<?= form_open_multipart('admin/news/edit/'.$data->id, attr('class:span12 widget dark form-horizontal bordered')) ?>
			<header>
				<h4 class="title">
					<span class="icon icone-building"></span>
					Dados da Notícia
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
						<?= form_label('Título *', 'title', attr('class:control-label')) ?>
						<div class="controls">
							<?= form_input(attr('name:title', 'placeholder:Título da Notícia', 'class:span12', 'value:'.(($post)?$post['title']:$data->title))) ?>
							<p></p>
							<p><span class="help-block"><?= form_checkbox('featured', '1', (($post) ? (bool)$post['featured'] : (bool)$data->featured)) ?> Exibir notícia na página inicial</span></p>
							<?php if (user_is('revisor')) : ?>
							<p><span class="help-block"><?= form_checkbox('revised', '1', (($post) ? (bool)$post['revised'] : (bool)$data->revised)) ?> Publicar notícia imediatamente</span></p>
							<?php endif; ?>
						</div>
					</div>

					<div class="control-group">
						<?= form_label('Subtítulo *', 'subtitle', attr('class:control-label')) ?>
						<div class="controls">
							<?= form_input(attr('name:subtitle', 'placeholder:Chamada da Notícia', 'class:span12', 'value:'.(($post)?$post['subtitle']:$data->subtitle))) ?>
						</div>
					</div>

					<div class="control-group">
						<?= form_label('Conteúdo *', 'content', attr('class:control-label')) ?>
						<div class="controls">
							<?= form_textarea(attr('name:content', 'placeholder:Conteúdo da Notícia, utilize o editor de texto oferecido no Guia de Postagem.', 'class:span12', 'value:'.(($post)?$post['content']:$data->content))) ?>
							<span class="help-block">Veja o <?= anchor('admin/news/guide', 'Guia de Postagem', attr('target:_blank')) ?></span>
						</div>
					</div>

					<div class="control-group">
						<?= form_label('Editorial *', 'category_id', attr('class:control-label')) ?>
						<div class="controls">
							<?= form_dropdown_std($categories, attr('name:category_id', 'class:span12 select2', 'placeholder:Nome do Editorial'), 'name', (($post)?$post['category_id']:$data->category_id), FALSE) ?>
						</div>
					</div>

					<div class="control-group">
						<?= form_label('Capa *', 'cover', attr('class:control-label')) ?>
						<div class="controls">
							<?php if (file_exists(FCPATH.'storage/covers/cover-'.$data->id.'.'.$data->extension)) : ?>
								<a href="<?= base_url('storage/covers')?>/cover-<?= $data->id ?>.<?= $data->extension ?>" target="_blank">
									<img src="<?= base_url('storage/covers')?>/cover-<?= $data->id ?>.<?= $data->extension ?>?time=<?= time() ?>" class="img-polaroid img-limit" />
								</a>
							<?php endif; ?>
							<?= form_file(attr('name:cover')) ?>
						</div>
					</div>
					
					<?php if (user_is('revisor')) : ?>
					<div class="control-group">
						<?= form_label('Autor *', 'user_id', attr('class:control-label')) ?>
						<div class="controls">
							<?= form_dropdown_std($users, attr('name:user_id', 'class:span12 select2', 'placeholder:Autor da Notícia'), 'name', (($post)?$post['user_id']:$data->user_id), FALSE) ?>
						</div>
					</div>
					<?php endif; ?>
				</div>

				<div class="form-actions">
					<?= form_button(attr('class:btn btn-primary', 'content:Salvar', 'type:submit')) ?>
					<?= anchor('admin/news', 'Cancelar', attr('class:btn', 'type:button')) ?>
				</div>
			</section>
		<?= form_close() ?>
	</div>
</div>