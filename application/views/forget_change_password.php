<?php $this->load->view('template/head'); ?>
  <div class="register-box">
  <div class="login-logo login-box-body">
    <a href="<?php echo $this->config->base_url(); ?>"><b>Payroll</b></a>
  </div>
  <div class="register-box-body">
    <p class="login-box-msg">Change Password</p>

<form action="<?php echo $this->config->base_url("welcome/forget_change_password"); ?>" method="post">
 <?php if(isset($error)) echo '<div class="login-box-msg validation-summary-errors">'.$error.'</div>' ?>
      
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
      <div class="row">
        <div class="col-xs-8">
     
        </div>
        <!-- /.col -->
        <div class="col-xs-4">
          <button name="submit" id="submit"  type="submit" class="btn btn-primary btn-block btn-flat">Submit</button>
        </div>
        <!-- /.col -->
      </div>
    </form>
  </div>
</div>
<!-- /.login-box -->
<?php $this->load->view('template/footer'); ?>