<?php $this->load->view('template/head'); ?>

<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
     <h1>User Profile
        <small>Users</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-user"></i>User</a></li>
        <li class="active">Company Include</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
     <div class="row">
        <!-- left column -->
        <div class="col-md-6">
          <!-- general form elements -->
          <div class="box box-primary">
          <form action="<?php echo $this->config->base_url("user/company_include"); ?>" method="post" >
 <?php if(isset($error)) echo '<div class="login-box-msg validation-summary-errors">'.$error.'</div>' ?>
            <div class="box-header with-border">
              <h3 class="box-title">Company Include</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
             <div class="box-body">
               <div class="form-group">
               <?php echo form_dropdown('user_id', $user,$user_id,'id="user_id" class="form-control" ');?>
               </div>
               
             <?php  foreach($company as $row) { ?>
                <div class="form-group">
  				<input <?php if($row["company_id"]) echo 'checked="checked"'; ?>   id="company<?=$row["id"]?>" name="company<?=$row["id"]?>" type="checkbox"   />
  				<label for="company<?=$row["id"]?>"><?=$row["name"]?></label>
                </div>
               <?php } ?>

              </div>
              <!-- /.box-body -->

              <div class="box-footer">
                <button type="submit" id="submit"  name="submit" class="btn btn-primary">Save Changes</button>
              </div>
          </div>
            </form>
          <!-- /.box -->
        </div>
        <!--/.col (left) -->
      </div> 
  
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
 
 
 <script>
    document.getElementById("user_id").onchange = function() {
        if (this.selectedIndex>=0) {
            window.location.href ='<?php echo $this->config->base_url("user/company_include?user_id="); ?>'+this.value;
        }        
    };
</script>

<?php $this->load->view('template/footer'); ?>