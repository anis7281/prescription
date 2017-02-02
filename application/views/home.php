<?php $this->load->view('template/head'); ?>

<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
     <h1>Dashboard<small>Payroll</small></h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-User"></i>Emplayee</a></li>
        <li class="active">Emplayee List</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          
           <div class="form-group">
    <label>Second check in:</label>
    <input type="text" class="form-control form-control-1 input-sm from" placeholder="CheckIn" >
</div>
          
        </div>
    </div>

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  
  <script>
  $(function(){

	$('.from').datepicker({
		autoclose: true,
		minViewMode: 1,
		format: 'MM-yyyy',
		
	}); 

  });
  </script>

<?php $this->load->view('template/footer'); ?>