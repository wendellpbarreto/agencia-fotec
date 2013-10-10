<!doctype html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<title>Database Migrations</title>
		<!-- Stylesheet -->
		<link rel="stylesheet" href="<?=base_url('assets/util')?>/css/bootstrap-legacy.min.css">
		<link rel="stylesheet" href="<?=base_url('assets/util')?>/css/flatui.min.css">
	</head>
	<body>
		<div class="container-fluid narrow">
			<div class="row-fluid">
				<div class="span12">
					<div class="page-header text-center">
						<h1>Migrate Controller<br><small>manage your database migrations</small></h1>
					</div>
				</div>
			</div>
			<?php if (ENVIRONMENT == 'production') : ?>
				<div class="alert text-center">This page shouldn't be enabled on production evironment.</div>
			<?php endif; ?>
			<div class="row-fluid">
				<div class="span12 text-center">
					<?php if ( ! $database) : ?>
						<p>Your database is at <strong>version 0</strong>, this means that you never ran a migration before, you may want to try running one of the avaiable migrations.</p>
					<?php elseif ($database < $latest) : ?>
						<p>Your database is at <strong>version <?=$database?></strong>, this means that it's not in the last version avaiable, you may want to update your database.</p>
					<?php else : ?>
						<p>Your database is <strong>up-to-date</strong>, this means you ran the last migration. You can rollback to previous versions at anytime.</p>
					<?php endif; ?>
				</div>
			</div>
			<hr>
			<div class="row-fluid">
				<div class="span12">
					<div class="row-fluid">
						<p class="span6"><?=anchor('migrate/to/'.$config, 'Run Default (set in config file)', array('class'=>'input-block-level btn btn-inverse tip','title'=>'Version '.$config))?></p>
						<p class="span6"><?=anchor('migrate/to/0', 'Rollback to Beginning', array('class'=>'input-block-level btn btn-danger'))?></p>
					</div>
					<?php foreach ($migrations as $migration) : ?>
						<?php $version = (int)substr(basename($migration), 0, 3); ?>
						<?php $class = ($version == $database) ? 'primary' : 'info'; ?>

						<p><?=anchor('migrate/to/'.$version, $migration, array('class'=>'input-block-level btn btn-'.$class))?></p>
					<?php endforeach; ?>
				</div>
			</div>
			<div class="row-fluid">
				<div class="span12">
					<h3>Legend</h3>
					<p><span class="badge palette-peter-river">&nbsp;</span> are avaiable migrations.</p>
					<p><span class="badge palette-turquoise">&nbsp;</span> is the current version.</p>
				</div>
			</div>
		</div>

		<!-- Load JS here for greater good =============================-->
		<script src="<?=base_url('assets/util')?>/js/flatui.min.js"></script>
		<script>$('.tip').tooltip();</script>
	</body>
</html>