<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Payroll</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="<?php echo $this->config->base_url(); ?>template/bootstrap/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo $this->config->base_url(); ?>template/fonts/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="<?php echo $this->config->base_url(); ?>template/fonts/ionicons.min.css">
   <!-- Select2 -->
  <link rel="stylesheet" href="<?php echo $this->config->base_url(); ?>template/plugins/select2/select2.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo $this->config->base_url(); ?>template/dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="<?php echo $this->config->base_url(); ?>template/dist/css/skins/_all-skins.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="<?php echo $this->config->base_url(); ?>template/plugins/iCheck/flat/blue.css">
  <!-- Morris chart -->
  <link rel="stylesheet" href="<?php echo $this->config->base_url(); ?>template/plugins/morris/morris.css">
  <!-- jvectormap -->
  <link rel="stylesheet" href="<?php echo $this->config->base_url(); ?>template/plugins/jvectormap/jquery-jvectormap-1.2.2.css">
  <!-- Date Picker -->
  <link rel="stylesheet" href="<?php echo $this->config->base_url(); ?>template/plugins/datepicker/datepicker3.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="<?php echo $this->config->base_url(); ?>template/plugins/daterangepicker/daterangepicker.css">
  <!-- bootstrap wysihtml5 - text editor -->
  <link rel="stylesheet" href="<?php echo $this->config->base_url(); ?>template/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->


<!-- jQuery 2.2.3 -->
 <script src="<?php echo $this->config->base_url(); ?>template/plugins/jQuery/jquery-2.2.3.min.js"></script>

<!-- jQuery UI 1.11.4 -->
<script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
    $.widget.bridge('uibutton', $.ui.button);
</script>
<!-- Bootstrap 3.3.6 -->
 <script src="<?php echo $this->config->base_url(); ?>template/bootstrap/js/bootstrap.min.js"></script>

<!-- Select2 -->
 <script src="<?php echo $this->config->base_url(); ?>template/plugins/select2/select2.full.min.js"></script>

<!-- InputMask -->
 <script src="<?php echo $this->config->base_url(); ?>template/plugins/input-mask/jquery.inputmask.js"></script>

 <script src="<?php echo $this->config->base_url(); ?>template/plugins/input-mask/jquery.inputmask.date.extensions.js"></script>

 <script src="<?php echo $this->config->base_url(); ?>template/plugins/input-mask/jquery.inputmask.extensions.js"></script>

<!-- Morris.js charts -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
<script src="<?php echo $this->config->base_url(); ?>template/plugins/morris/morris.min.js"></script>

<!-- Sparkline -->
<script src="<?php echo $this->config->base_url(); ?>template/plugins/sparkline/jquery.sparkline.min.js"></script>

<!-- jvectormap -->
<script src="<?php echo $this->config->base_url(); ?>template/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>

<script src="<?php echo $this->config->base_url(); ?>template/plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>

<!-- jQuery Knob Chart -->
<script src="/template/plugins/knob/jquery.knob.js"></script>

<!-- daterangepicker -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.11.2/moment.min.js"></script>
<script src="<?php echo $this->config->base_url(); ?>template/plugins/daterangepicker/daterangepicker.js"></script>

<!-- datepicker -->
<script src="<?php echo $this->config->base_url(); ?>template/plugins/datepicker/bootstrap-datepicker.js"></script>

<!-- Bootstrap WYSIHTML5 -->
<script src="<?php echo $this->config->base_url(); ?>template/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>

<!-- Slimscroll -->
<script src="<?php echo $this->config->base_url(); ?>template/plugins/slimScroll/jquery.slimscroll.min.js"></script>

<!-- FastClick -->
<script src="<?php echo $this->config->base_url(); ?>template/plugins/fastclick/fastclick.js"></script>

<!-- AdminLTE App -->
<script src="<?php echo $this->config->base_url(); ?>template/dist/js/app.min.js"></script>

<!-- AdminLTE for demo purposes -->
<script src="<?php echo $this->config->base_url(); ?>template/dist/js/demo.js"></script>


<script  type="text/javascript">
    $(function () {

        //customized form serialization
        (function ($) {
            $.fn.serializeByID = function (options) {
                return $.param(this.serializeArrayByID(options));
            };

            $.fn.serializeArrayByID = function (options) {
                var o = $.extend({
                    checkboxesAsBools: false
                }, options || {});

                var rselectTextarea = /select|textarea/i;
                var rinput = /text|hidden|password|search/i;

                return this.map(function () {
                    return this.elements ? $.makeArray(this.elements) : this;
                })
         .filter(function () {
             // return this.name && !this.disabled &&
             return $(this).attr('id') && !this.disabled &&
                 (this.checked
                 || (o.checkboxesAsBools && this.type === 'checkbox')
                 || rselectTextarea.test(this.nodeName)
                 || rinput.test(this.type));
         })
             .map(function (i, elem) {
                 var val = $(this).val();
                 var id = $(this).attr('id');
                 return val == null ?
                 null :
                 $.isArray(val) ?
                 $.map(val, function (val, i) {
                     return { name: elem.name, value: val };
                 }) :
                 {
                     //                   name: elem.name,
                     name: id,
                     value: (o.checkboxesAsBools && this.type === 'checkbox') ? //moar ternaries!
                            (this.checked ? 'true' : 'false') :
                            val
                 };
             }).get();
            };

     })(jQuery);



	 $(".validation-summary-errors").addClass('alert alert-danger');
     $('.input-validation-error').parents('.form-group').addClass('has-error');
     $('.field-validation-error').addClass('alert-danger');
	 
	 
    });

</script>

</head>
<body class="hold-transition fixed sidebar-collapse <?php if($this->session->userdata('user_id') == TRUE) echo "skin-blue sidebar-mini"; else echo "login-page";
 ?>" >
<div class="wrapper" >
<?php if($this->session->userdata('user_id') == TRUE) { ?>
  <header class="main-header">
   <?php $this->load->view('template/header'); ?>
 </header>
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
     <?php //$this->load->view('left'); ?>
  </aside>
<?php } ?>
