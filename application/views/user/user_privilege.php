<?php $this->load->view('template/head'); ?>

<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
     <h1>
        User Profile
        <small>Users</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-user"></i>User</a></li>
        <li class="active">Privilege</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
     <div class="row">
        <!-- left column -->
        <div class="col-md-6">
          <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">User Privilege</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
             <div class="box-body">                
               
               <?php  foreach($privileges as $row) { ?>
                <div class="form-group">
  					<a href="<?php echo $this->config->base_url($row['form_name'])?>" >
					<?php echo $row['name'] ?>
                    </a>
                </div>
               <?php } ?>
               
              </div>
              <!-- /.box-body -->

              <div class="box-footer">
              </div>
          </div>
          <!-- /.box -->
        </div>
        <!--/.col (left) -->
        <!-- right column -->
        <div class="col-md-6">
        <div class="box box-primary">
          </div>
        </div>
        <!--/.col (right) -->
      </div> 
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

<?php $this->load->view('template/footer'); ?>