<div class="navbar navbar-static-top">
	<div class="navbar-inner">
		<!-- Breadcrumb -->
		<ul class="breadcrumb">
			<li><?= anchor('admin/users', 'Usuários'); ?> <span class="divider"></span></li>
			<li class="active">Adicionar</li>
		</ul>
		<!--/ Breadcrumb -->
	</div>
</div>

<div class="container-fluid">
	<div class="row-fluid">
		<div class="span12">
			<div class="page-header line1">
				<h4>Adicionar Usuário <small>Todos os campos com * são obrigatórios</small></h4>
			</div>
		</div>
	</div>

	<div class="row-fluid">
		<?= form_open('admin/users/add', attr('class:span12 widget dark form-horizontal bordered')) ?>
			<header>
				<h4 class="title">
					<span class="icon icone-user-md"></span>
					Dados do Usuário
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
						<?= form_label('Nome Completo *', 'name', attr('class:control-label')) ?>
						<div class="controls">
							<?= form_input(attr('name:name', 'placeholder:Apenas para identificação', 'class:span12', 'value:'.$post['name'])) ?>
						</div>
					</div>

					<div class="control-group">
						<?= form_label('Tipo *', 'type', attr('class:control-label')) ?>
						<div class="controls">
							<?= form_dropdown('type', user_types(), ($post) ? $post['type'] : array(), attr('class:span12 select2', 'placeholder:Nível de Acesso')) ?>
						</div>
					</div>

					<div class="control-group">
						<?= form_label('E-mail *', 'email', attr('class:control-label')) ?>
						<div class="controls">
							<?= form_input(attr('name:email', 'placeholder:Insira um e-mail válido', 'type:email', 'class:span12', 'value:'.$post['email'])) ?>
						</div>
					</div>

					<div class="control-group">
						<?= form_label('Senha *', 'password', attr('class:control-label')) ?>
						<div class="controls">
							<div class="row-fluid">
								<div class="span6">
									<?= form_password(attr('name:password', 'placeholder:Deve ter entre 8 e 32 caracteres', 'class:span12', 'value:'.$post['password'])) ?>
								</div>
								<div class="span6">
									<?= form_password(attr('name:confirmation', 'placeholder:Confirme a senha','class:span12', 'value:'.$post['confirmation'])) ?>
								</div>
							</div>
						</div>
					</div>
				</div>

				<div class="form-actions">
					<?= form_button(attr('class:btn btn-primary', 'content:Criar', 'type:submit')) ?>
					<?= anchor('admin/users', 'Cancelar', attr('class:btn', 'type:button')) ?>
				</div>
			</section>
		<?= form_close() ?>
	</div>
</div>