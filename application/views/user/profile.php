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
        <li class="active">Profile</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
<form action="<?php echo $this->config->base_url("user/profile"); ?>" method="post" enctype="multipart/form-data">
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
                <div class="form-group">
                  <label for="FullName" class="col-sm-4 control-label">Full Name</label>
                  <div class="col-sm-8">
                    <input id="user_name_full" name="user_name_full" type="text" class="form-control" value="<?php echo $user_name_full ?>" placeholder="Your full name">
                <?php echo form_error('user_name_full', '<div class="input-validation-error field-validation-error">', '</div>'); ?>
                  </div>
                </div>
               <div class="form-group">
                  <label for="user_designation" class="col-sm-4 control-label">Designation</label>
                  <div class="col-sm-8">
        <input id="user_designation" name="user_designation" type="text" class="form-control" 
        value="<?php echo $user_designation ?>" placeholder="Your designation">
                        <?php echo form_error('user_designation', '<div class="input-validation-error field-validation-error">', '</div>'); ?>
                  </div>
                </div>
                <div class="form-group">
                  <label for="JoinDate" class="col-sm-4 control-label">Joining Date</label>
                  <div class="col-sm-8">
 <input id="user_joining_date" name="user_joining_date" type="date" class="form-control" value="<?php echo $user_joining_date ?>" placeholder="Your joining date">
                        <?php echo form_error('user_joining_date', '<div class="input-validation-error field-validation-error">', '</div>'); ?>
                  </div>
                </div>

               <div class="form-group">
                   <label for="JoinDate" class="col-sm-4 control-label" >User Photo</label>
                    <div class="col-sm-4">
                      <img id="photo_url" class="img-responsive" src="<?php echo $this->config->base_url().$photo_url ?>" alt="Photo">
                    </div>
                    <div class="col-sm-4" >
                        <input id="PhotoUrl" name="PhotoUrl" type="file"  onchange="document.getElementById('photo_url').src = window.URL.createObjectURL(this.files[0])" 
                        accept=".jpg, .png, .jpeg, .gif, .bmp, .tif, .tiff|images/*" >
                    </div>
                </div>
              </div>
              <!-- /.box-body -->

              <div class="box-footer">
                <button type="submit" id="submit"  name="submit" class="btn btn-primary">Save</button>
              </div>
          </div>
          <!-- /.box -->
        </div>
        <!--/.col (left) -->
        <!-- right column -->
        <div class="col-md-6">
        <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Security</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
             <div class="box-body">
                <div class="form-group">
  					<a href="<?php echo $this->config->base_url("user/change_password")?>" >Change Password</a>
                </div>
                
                <div class="form-group">
  					<a href="<?php echo $this->config->base_url("user/user_privilege")?>" >User Privilege</a>
                </div>
               
              </div>
              <!-- /.box-body -->

          </div>
        </div>
        <!--/.col (right) -->
      </div> 
    </form>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  
  
  <script>
    $(function () {
        $('#PhotoUrl').change(function (evt) {
            var files = evt.target.files;
            if (files.length > 0) {
                if (window.FormData !== undefined) {
                    var data = new FormData();
                    data.append("PhotoUrl", files[0]);
                    var url ='<?php echo $this->config->base_url("user/user_photo") ?>';
                    $.ajax({
                        type: "POST",
                        url: url,
                        contentType: false,
                        processData: false,
                        data: data,
                        success: function (result) {
							//alert(result);
                            //$("#photo_url").attr('src', evt.target.files[0]);
                        },
                        error: function (xhr) {
                            var err = JSON.parse(xhr.responseText).Message;
                            alert(err);
                        }
                    });

                } else {
                    alert("This browser doesn't support HTML5 file uploads!");
                }
            }
        });

    });
</script>
 
<?php $this->load->view('template/footer'); ?>