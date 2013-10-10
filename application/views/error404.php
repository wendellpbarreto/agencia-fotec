<!DOCTYPE html>
<html>
	<head>
	    <!-- START META SECTION -->
	    <meta charset="utf-8">
	    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	    <title>Cleanizr</title>
	    <meta name="description" content="">
	    <meta name="viewport" content="width=device-width, user-scalable=0, initial-scale=1.0">
	    <!--/ END META SECTION -->

		<!-- Stylesheet(Application) -->
		<link rel="stylesheet" href="<?=base_url('assets/cpanel')?>/css/style.css">
		<!--/ Stylesheet(Application) -->

		<!-- Javascript(Modernizr) -->
		<script src="<?=base_url('assets/cpanel')?>/assets/modernizr/js/modernizr-2.6.2.min.js"></script>
		<!--/ Javascript(Modernizr) -->
	</head>
	<body>
	    
	    <!-- Start Error Page Wrapper -->
	    <div id="error-page-wrapper">
	        <div class="error-code">404</div>
	        <div class="error-text">Not Found.</div>
	        <div class="error-text-help">The requested resource could not be found but may be available again in the future. Go <?= anchor('/admin/', 'back to home') ?>.</div>
	    </div>
	    <!-- End Error Page Wrapper -->
	</body>
</html>