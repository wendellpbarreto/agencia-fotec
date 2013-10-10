<!DOCTYPE html>
<html>
    <head>
        <!-- START META SECTION -->
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title>Agência FOTEC</title>
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
        <!-- START Template Wrapper -->
        <!-- If you want to enable the fixed header, just add `.fixed-header` class to the `#wrapper` div below -->
        <div id="wrapper">
            <!-- START Template Canvas -->
            <div id="canvas">
                <!-- START Content -->
                <div class="container-fluid">
                    <!-- START Row -->
                    <div class="row-fluid">
                        <!-- START Login Widget Form -->
                        <p>&nbsp;</p>
                        <?= form_open('admin/auth', attr('class:widget stacked teal widget-login')) ?>
                            <section class="body">
                                <div class="body-inner">
                                    <!-- START Logo -->
                                    <div class="logo" align="center">
                                        <a href="#"><img src="<?=base_url('assets/cpanel')?>/img/logo-dark.png"></a>
                                    </div>
                                    <!--/ END Logo -->

                                    <!-- Username -->
                                    <div class="control-group">
                                        <div class="controls">
                                            <?= form_input(attr('name:email','placeholder:E-mail','class:span12')) ?>
                                            <i class="icon-user input-icon"></i>
                                        </div>
                                    </div><!--/ Username -->

                                    <!-- Password -->
                                    <div class="control-group">
                                        <div class="controls">
                                            <?= form_password(attr('name:password','placeholder:Password','class:span12')) ?>
                                            <i class="icon-lock input-icon"></i>
                                        </div>
                                    </div><!--/ Password -->

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
                                <!-- Form Action -->
                                <!-- Place out form `.body-inner` -->
                                <div class="form-actions">
                                    <button type="submit" class="btn btn-primary">Login</button>
                                    <button type="button" class="btn">Cancel</button>
                                </div>
                                <!--/ Form Action -->
                            </section>
                        <?= form_close() ?>
                        <!--/ END Login Widget Form -->
                    </div>
                    <!--/ END Row -->
                </div>
                <!--/ END Content -->
                
            </div>
            <!--/ END Template Canvas -->
        </div>
        <!--/ END Template Wrapper -->

        <!-- Javascript(Vendors) -->
        <script src="<?=base_url('assets/cpanel')?>/assets/jquery/js/jquery-1.10.1.min.js"></script>
        <script src="<?=base_url('assets/cpanel')?>/assets/jui/js/jquery-ui-1.10.3.min.js"></script>
        <script src="<?=base_url('assets/cpanel')?>/assets/jquery/js/jquery-migrate-1.2.1.min.js"></script>
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

        <!-- Chart -->
        <script src="<?=base_url('assets/cpanel')?>/assets/flot/jquery.flot.min.js"></script>
        <script src="<?=base_url('assets/cpanel')?>/assets/flot/jquery.flot.pie.min.js"></script>
        <script src="<?=base_url('assets/cpanel')?>/assets/flot/jquery.flot.categories.min.js"></script>
        <script src="<?=base_url('assets/cpanel')?>/assets/flot/jquery.flot.tooltip.min.js"></script>
        <script src="<?=base_url('assets/cpanel')?>/assets/flot/jquery.flot.resize.min.js"></script>
        <script src="<?=base_url('assets/cpanel')?>/assets/flot/excanvas.min.js"></script>
        <!--/ Javascript(Plugins) -->

        <!-- Javascript (Application) -->
        <script src="<?=base_url('assets/cpanel')?>/js/plugins.js"></script>
        <script src="<?=base_url('assets/cpanel')?>/js/application.js"></script>
        <script src="<?=base_url('assets/cpanel')?>/js/flot.sample.js"></script>
        <script src="<?=base_url('assets/cpanel')?>/js/sparkline.sample.js"></script>
        <script src="<?=base_url('assets/cpanel')?>/js/easypiechart.sample.js"></script>
        <!--/ Javascript (Application) -->
    </body>
</html>