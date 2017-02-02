<?php $this->load->view('template/head'); ?>
  <div class="register-box">
  <div class="login-logo login-box-body">
    <a href="<?php echo $this->config->base_url("welcome/register"); ?>"><b>Register</b></a>
  </div>
  <div class="register-box-body">
    <p class="login-box-msg">Register a new membership</p>

<form action="<?php echo $this->config->base_url("welcome/register"); ?>" method="post">
 <?php if(isset($error)) echo '<div class="login-box-msg validation-summary-errors">'.$error.'</div>' ?>
      <div class="form-group has-feedback">
        <input id="user_name" name="user_name" type="text" class="form-control" value="<?php echo $user_name ?>" placeholder="Name">
        <span class="glyphicon glyphicon-user form-control-feedback"></span>
        <?php echo form_error('user_name', '<div class="input-validation-error field-validation-error">', '</div>'); ?>
      </div>
      <div class="form-group has-feedback">
        <input id="email" name="email" type="email" class="form-control" placeholder="Email" 
        value="<?php echo $email ?>">
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
        <?php echo form_error('email', '<div class="input-validation-error field-validation-error">', '</div>'); ?>
      </div>
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
          <input  id="agree" name="agree" type="checkbox" value="true" />
          <label for="agree">I agree to the terms</label>
        </div>
        <!-- /.col -->
        <div class="col-xs-4">
          <button name="submit" id="submit"  type="submit" class="btn btn-primary btn-block btn-flat">Register</button>
        </div>
        <!-- /.col -->
      </div>
    </form>
    <a href="<?php echo $this->config->base_url("welcome/login"); ?>" class="text-center">I already have a membership</a>
  </div>
</div>
<!-- /.login-box -->
<?php $this->load->view('template/footer'); ?>