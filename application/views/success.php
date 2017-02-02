<?php $this->load->view('template/head'); ?>

  <div class="register-box">
  <div class="login-logo login-box-body">
    <a href="<?php echo $this->config->base_url(); ?>"><b>Payroll</b></a>
  </div>
  <div class="register-box-body">
 	<p class="login-box-msg">
    	  <?php echo '<div class="has-success">'.$message.'</div>'; ?>
    </p> 
  </div>
</div>
<!-- /.login-box -->

<?php $this->load->view('template/footer'); ?>