<!DOCTYPE html>
<html>
	<head>
		<!-- START META SECTION -->
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		<title><?=isset($title) ? $title . ' | ' : ''?>Agência FOTEC</title>
		<meta name="description" content="">
		<meta name="viewport" content="width=device-width, user-scalable=0, initial-scale=1.0">
		<link rel="icon" href="<?=base_url('assets/cpanel')?>/favicon_cp.ico" type="image/x-icon" />
		<!--/ END META SECTION -->

		<!-- Stylesheet(Application) -->
		<link rel="stylesheet" href="<?=base_url('assets/cpanel')?>/css/style.css">
		<link rel="stylesheet" href="<?=base_url('assets/cpanel')?>/assets/dropzone/css/dropzone.css">
		<!--/ Stylesheet(Application) -->

		<!-- Javascript(Modernizr) -->
		<script src="<?=base_url('assets/cpanel')?>/assets/modernizr/js/modernizr-2.6.2.min.js"></script>
		<!--/ Javascript(Modernizr) -->
	</head>
	<body>
		<!-- START Template Wrapper -->
		<div id="wrapper">
			<!-- START Template Canvas -->
			<div id="canvas">
				<!-- START Template Header -->
				<header id="header">
					<!-- START Logo -->
					<div class="logo hidden-phone hidden-tablet">
						<?=anchor('admin','<img src="'.base_url('assets/cpanel').'/img/logo-white.png" alt="">')?>
						<small class="version"></small>
					</div>
					<!--/ END Logo -->

					<!-- START Mobile Sidebar Toggler -->
					<a href="#" class="toggler" data-toggle="sidebar"><span class="icon icone-reorder"></span></a>
					<!--/ END Mobile Sidebar Toggler -->

					<!-- START Toolbar -->
					<ul class="toolbar" id="toolbar">
						<!-- START Profile -->
						<li class="profile">
							<a href="#" data-toggle="dropdown">
								<span class="avatar"><img src="http://gravatar.org/avatar/<?=md5($session_user->email)?>.jpg" alt=""></span>
								<span class="text hidden-phone"><?=$session_user->name?><span class="role">Admin</span></span>
								<span class="arrow icone-caret-down"></span>
							</a>
							<!-- START Dropdown Menu -->
							<div class="dropdown-menu" role="menu">
								<header>
									Alterar sua conta 
									<ul class="toolbar">
										<li><?=anchor('admin/profile','<span class="icon icone-cog"></span>',attr('class:btn btn-small'))?></li>
									</ul>
								</header>
								<footer>
									<?=anchor('admin/auth/logout', '<span class="icon icone-off"></span> Sign Off', attr('class:text')) ?>
								</footer>
							</div>
							<!--/ END Dropdown Menu -->
						</li>
						<!--/ END Profile -->
					</ul>
					<!--/ END Toolbar -->
				</header>
				<!--/ END Template Header -->

				<!-- START Template Sidebar -->
				<aside id="sidebar">
					<!-- START Sidebar Content -->
					<div class="sidebar-content">
						<!-- START Tab Content -->
						<div class="tab-content">
							<!-- START Tab Pane(menu) -->
							<div class="tab-pane active" id="tab-menu">
								<!-- START Sidebar Menu -->
								<nav id="nav" class="accordion">
									<ul id="navigation">
										<!-- START Menu Divider -->
										<li class="divider">MENU PRINCIPAL</li>
										<!--/ END Menu Divider -->

										<!-- START Menu -->
										<li class="accordion-group<?=($nav==0)?' active':''?>">
											<?=anchor('admin',
													  '<span class="icon icone-dashboard"></span>'.
													  '<span class="text">Dashboard</span>'
													  )?>
										</li>
										<!--/ END Menu -->

										<!-- START Menu -->
										<li class="accordion-group<?=($nav==1)?' active':''?>">
											<?=anchor('admin/users',
													  '<span class="icon icone-user-md"></span>'.
													  '<span class="text">Usuários</span>'
													  )?>
										</li>
										<!--/ END Menu -->

										<!-- START Menu -->
										<li class="accordion-group<?=($nav==2)?' active':''?>">
											<?=anchor('admin/profile',
													  '<span class="icon icone-cog"></span>'.
													  '<span class="text">Minha Conta</span>'
													  )?>
										</li>
										<!--/ END Menu -->
										
										<!-- START Menu Divider -->
										<li class="divider">CONTEÚDO</li>
										<!--/ END Menu Divider -->

										<!-- START Menu -->
										<?php if (user_is('revisor')) : ?>
										<li class="accordion-group<?=($nav==3)?' active':''?>">
											<?=anchor('admin/categories',
													  '<span class="icon icone-folder-open"></span>'.
													  '<span class="text">Editoriais</span>'
													  )?>
										</li>
										<?php endif; ?>
										<!--/ END Menu -->

										<!-- START Menu -->
										<li class="accordion-group<?=($nav==4)?' active':''?>">
											<?=anchor('admin/news',
													  '<span class="icon icone-file"></span>'.
													  '<span class="text">Notícias</span>'
													  )?>
										</li>
										<!--/ END Menu -->

										<!-- START Menu -->
										<li class="accordion-group<?=($nav==5)?' active':''?>">
											<?=anchor('admin/podcasts',
													  '<span class="icon icone-music"></span>'.
													  '<span class="text">Podcasts</span>'
													  )?>
										</li>
										<!--/ END Menu -->
									</ul>
								</nav>
								<!--/ END Sidebar Menu -->
							</div>
							<!--/ END Tab Pane(menu) -->
						</div>
						<!--/ END Tab Content -->
					</div>
					<!--/ END Sidebar Content -->
				</aside>
				<!--/ END Template Sidebar -->

				<!-- START Template Main Content -->
				<section id="main">
					<?=$contents?>
				</section>
				<!--/ END Template Main Content -->

				<!-- START Template Footer -->
				<footer id="footer">
					<p>Proudly crafted by baldtheme</p>

					<!-- START To Top Scroller -->
					<a href="#" class="totop"><span class="icon icone-angle-up"></span></a>
					<!--/ END To Top Scroller -->
				</footer>
				<!--/ END Template Footer -->
			</div>
			<!--/ END Template Canvas -->
		</div>
		<!--/ END Template Wrapper -->

		<!-- Javascript(Vendors) -->
		<script src="<?=base_url('assets/cpanel')?>/assets/jquery/js/jquery-1.10.1.min.js"></script>
		<script src="<?=base_url('assets/cpanel')?>/assets/jui/js/jquery-ui-1.10.3.min.js"></script>
		<!--/ Javascript(Vendors) -->

		<!-- Javascript(Plugins) -->
		<!--[if IE 8]><script src="<?=base_url('assets/cpanel')?>//assets/respond/js/respond.min.js"></script><![endif]-->
		<script src="<?=base_url('assets/cpanel')?>/assets/autosize/js/jquery.autosize.min.js"></script>
		<script src="<?=base_url('assets/cpanel')?>/assets/bootstrap/js/bootstrap.min.js"></script>
		<script src="<?=base_url('assets/cpanel')?>/assets/datatable/js/jquery.dataTables.min.js"></script>
		<script src="<?=base_url('assets/cpanel')?>/assets/datatable/js/dataTables-bootstrap.min.js"></script>
		<script src="<?=base_url('assets/cpanel')?>/assets/daterangepicker/js/daterangepicker.min.js"></script>
		<script src="<?=base_url('assets/cpanel')?>/assets/easypiechart/js/jquery.easypiechart.min.js"></script>
		<script src="<?=base_url('assets/cpanel')?>/assets/bootstrap-fileupload/js/bootstrap-fileupload.min.js"></script>
		<script src="<?=base_url('assets/cpanel')?>/assets/formwizard/js/jquery.formwizard.min.js"></script>
		<script src="<?=base_url('assets/cpanel')?>/assets/fullcalendar/js/fullcalendar.min.js"></script>
		<script src="<?=base_url('assets/cpanel')?>/assets/icheck/js/jquery.icheck.min.js"></script>
		<script src="<?=base_url('assets/cpanel')?>/assets/ie-placeholder/js/jquery.placeholder.min.js"></script>
		<script src="<?=base_url('assets/cpanel')?>/assets/inputmask/js/jquery.inputmask.min.js"></script>
		<script src="<?=base_url('assets/cpanel')?>/assets/minicolor/js/jquery.minicolors.min.js"></script>
		<script src="<?=base_url('assets/cpanel')?>/assets/moment/js/moment.min.js"></script>
		<script src="<?=base_url('assets/cpanel')?>/assets/mousewheel/js/jquery.mousewheel.min.js"></script>
		<script src="<?=base_url('assets/cpanel')?>/assets/prettyphoto/js/jquery.prettyphoto.min.js"></script>
		<script src="<?=base_url('assets/cpanel')?>/assets/scrollbar/js/perfect-scrollbar.min.js"></script>
		<script src="<?=base_url('assets/cpanel')?>/assets/select2/js/select2.min.js"></script>
		<script src="<?=base_url('assets/cpanel')?>/assets/shuffle/js/jquery.shuffle.min.js"></script>
		<script src="<?=base_url('assets/cpanel')?>/assets/snippet/js/jquery.snippet.min.js"></script>
		<script src="<?=base_url('assets/cpanel')?>/assets/sparkline/js/jquery.sparkline.min.js"></script>
		<script src="<?=base_url('assets/cpanel')?>/assets/switch/js/bootstrapSwitch.min.js"></script>
		<script src="<?=base_url('assets/cpanel')?>/assets/tagit/js/tag-it.min.js"></script>
		<script src="<?=base_url('assets/cpanel')?>/assets/timepicker/js/jquery-ui-timepicker.min.js"></script>
		<script src="<?=base_url('assets/cpanel')?>/assets/touchpunch/js/jquery.ui.touch-punch.min.js"></script>
		<script src="<?=base_url('assets/cpanel')?>/assets/wysiwyg/ckeditor/ckeditor.js"></script>
		<script src="<?=base_url('assets/cpanel')?>/assets/wysiwyg/CLEditor/js/jquery.cleditor.min.js"></script>
		<script src="<?=base_url('assets/cpanel')?>/assets/gritter/js/jquery.gritter.min.js"></script>
		<script src="<?=base_url('assets/cpanel')?>/assets/themer/js/jquery.themer.min.js"></script>
		<script src="<?=base_url('assets/cpanel')?>/assets/resize/js/jquery.ba-resize.min.js"></script>

		<!-- Form Validation -->
		<script src="<?=base_url('assets/cpanel')?>/assets/formvalidation/bassistance/js/jquery.validate.min.js"></script>
		<script src="<?=base_url('assets/cpanel')?>/assets/formvalidation/validationengine/js/lang/jquery.validationEngine-en.min.js"></script>
		<script src="<?=base_url('assets/cpanel')?>/assets/formvalidation/validationengine/js/jquery.validationEngine.min.js"></script>
		<!--/ Form Validation -->

		<!-- Chart -->
		<script src="<?=base_url('assets/cpanel')?>/assets/flot/jquery.flot.min.js"></script>
		<script src="<?=base_url('assets/cpanel')?>/assets/flot/jquery.flot.pie.min.js"></script>
		<script src="<?=base_url('assets/cpanel')?>/assets/flot/jquery.flot.categories.min.js"></script>
		<script src="<?=base_url('assets/cpanel')?>/assets/flot/jquery.flot.tooltip.min.js"></script>
		<script src="<?=base_url('assets/cpanel')?>/assets/flot/jquery.flot.resize.min.js"></script>
		<script src="<?=base_url('assets/cpanel')?>/assets/flot/excanvas.min.js"></script>
		<!--/ Javascript(Plugins) -->

		<!-- Others -->
		<script src="<?=base_url('assets/cpanel')?>/assets/dropzone/dropzone.min.js"></script>
		<script src="<?=base_url('assets/cpanel')?>/assets/masonry/js/masonry.pckg.min.js"></script>
		<script src="<?=base_url('assets/cpanel')?>/assets/filedrop/js/jquery.filedrop.js"></script>
		<!--/ Javascript(Plugins) -->

		<!-- Javascript (Application) -->
		<script src="<?=base_url('assets/cpanel')?>/js/plugins.js"></script>
		<script src="<?=base_url('assets/cpanel')?>/js/application.js"></script>
		<script src="<?=base_url('assets/cpanel')?>/js/flot.sample.js"></script>
		<script src="<?=base_url('assets/cpanel')?>/js/sparkline.sample.js"></script>
		<script src="<?=base_url('assets/cpanel')?>/js/easypiechart.sample.js"></script>
		<script src="<?=base_url('assets/cpanel')?>/js/delete.request.js"></script>
		<script src="<?=base_url('assets/cpanel')?>/js/pretty.date.js"></script>
		<script src="<?=base_url('assets/cpanel')?>/js/json2.js"></script>
		<script src="<?=base_url('assets/cpanel')?>/js/details.handler.js"></script>
		<script src="<?=base_url('assets/cpanel')?>/js/cidades-estados-1.2-utf8.js"></script>
		<!--/ Javascript (Application) -->
	</body>
</html>