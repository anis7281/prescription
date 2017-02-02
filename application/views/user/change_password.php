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
        <li class="active">Change Password</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
<form action="<?php echo $this->config->base_url("user/change_password"); ?>" method="post" enctype="multipart/form-data">
 <?php if(isset($error)) echo '<div class="login-box-msg validation-summary-errors">'.$error.'</div>' ?>
     <div class="row">
        <!-- left column -->
        <div class="col-md-6">
          <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Personal</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
             <div class="box-body">
                <div class="form-group has-feedback">
        <input id="password" name="password" type="password" class="form-control" placeholder="Password">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
        <?php echo form_error('password', '<div class="input-validation-error field-validation-error">', '</div>'); ?>
      </div>
      <div class="form-group has-feedback">
        <input id="confirm_password" name="confirm_password" type="password" class="form-control" placeholder="Retype password">
        <span class="glyphicon glyphicon-log-in form-control-feedback"></span>
         <?php echo form_error('confirm_password', '<div class="input-validation-error field-validation-error">', '</div>'); ?>
      </div>
               
              
              </div>
              <!-- /.box-body -->

              <div class="box-footer">
                <button type="submit" id="submit"  name="submit" class="btn btn-primary">Change</button>
              </div>
          </div>
          <!-- /.box -->
        </div>
        <!--/.col (left) -->
      </div> 
    </form>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  
 
<?php $this->load->view('template/footer'); ?>