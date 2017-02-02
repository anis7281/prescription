<?php $this->load->view('template/head'); ?>
  <div class="register-box">
  <div class="login-logo login-box-body">
    <a href="<?php echo $this->config->base_url("welcome/forget"); ?>"><b>Forget Password</b></a>
  </div>
  <div class="register-box-body">
<form action="<?php echo $this->config->base_url("welcome/forget"); ?>" method="post">
 <?php if(isset($error)) echo '<div class="login-box-msg validation-summary-errors">'.$error.'</div>' ?>
      <div class="form-group has-feedback">
        <input id="email" name="email" type="email" class="form-control" placeholder="Email" 
        value="<?php echo $email ?>">
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
        <?php echo form_error('email', '<div class="input-validation-error field-validation-error">', '</div>'); ?>
      </div>
     
      <div class="row">
        <div class="col-xs-4">
        </div>
        <!-- /.col -->
        <div class="col-xs-8">
          <button name="submit" id="submit"  type="submit" class="btn btn-primary btn-block btn-flat">Submit</button>
        </div>
        <!-- /.col -->
      </div>
    </form>
    <a href="<?php echo $this->config->base_url("welcome/login"); ?>" class="text-center">I already have a membership</a>
  </div>
</div>
<!-- /.login-box -->
<?php $this->load->view('template/footer'); ?>