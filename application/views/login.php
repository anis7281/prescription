<?php $this->load->view('template/head'); ?>

  <div class="login-box">
  <div class="login-logo login-box-body">
    <a href="<?php echo $this->config->base_url("welcome/login"); ?>"><b>Log in</b></a>
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body">
    <p class="login-box-msg">Sign in to start your session</p>

<form action="<?php echo $this->config->base_url("welcome/login"); ?>" method="post">
    
    <?php if(isset($error)) echo '<div class="login-box-msg validation-summary-errors">'.$error.'</div>' ?>
      <div class="form-group has-feedback">
           <input id="email" name="email" type="email" class="form-control" placeholder="Email" 
        value="<?php echo $email ?>">
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
        <?php echo form_error('email', '<div class="input-validation-error field-validation-error">', '</div>'); ?>
      </div>
      <div class="form-group has-feedback">
            <input class="form-control" id="password" name="password" placeholder="Password" type="password" value="" />
             <span class="glyphicon glyphicon-lock form-control-feedback"></span>
             <?php echo form_error('password', '<div class="input-validation-error field-validation-error">', '</div>'); ?>
      </div>
      <div class="row">
        <div class="col-xs-8">
          <input checked="checked" id="RememberMe" name="RememberMe" type="checkbox" value="true" />
          <label for="RememberMe">Remember me?</label>
        </div>
        <!-- /.col -->
        <div class="col-xs-4">
          <button type="submit"  name="submit" id="submit" value="submit" class="btn btn-primary btn-block btn-flat" >Sign In</button>
        </div>
        <!-- /.col -->
      </div>
</form>
    <a href="<?php echo $this->config->base_url("welcome/forget"); ?>">I forgot my password</a><br>
    <a href="<?php echo $this->config->base_url("welcome/register"); ?>" class="text-center">Register a new membership</a>
  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->

<?php $this->load->view('template/footer'); ?>