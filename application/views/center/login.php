<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>Center System Log in</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <link href="<?php echo base_url(); ?>assets/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url(); ?>assets/dist/css/AdminLTE.min.css" rel="stylesheet" type="text/css" />
    <script src="<?php echo base_url(); ?>assets/js/jQuery-2.1.4.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
 <script src="<?php echo base_url("assets/js/validation1.js"); ?>">
</script>


    
    
       
  <body class="login-page">
    <div class="login-box">
      <div class="login-logo">
      <!--  <a href="#"><b>CodeInsect</b><br>Admin System</a>  -->
      <a href="#"><b>Center Login</b><br></a>
      </div><!-- /.login-logo -->
      <div class="login-box-body">
        <p class="login-box-msg">Sign In</p>
        <?php $this->load->helper('form'); ?>
        <div class="row">
            <div class="col-md-12">
                <?php echo validation_errors('<div class="alert alert-danger alert-dismissable">', ' <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button></div>'); ?>
            </div>
        </div>
        <?php
        $this->load->helper('form');
       
        
        $error = $this->session->flashdata('error');
        if($error)
        {
            ?>
            <div class="alert alert-danger alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <?php echo $error; ?>                    
            </div>
        <?php }
        
         $log_error = $this->session->flashdata('log_error');
         $center_email=$this->session->flashdata('center_email');
         
        if($log_error)
        {
            ?>
            <div class="alert alert-danger alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <?php echo $log_error; ?>    <br>
                <a href="<?php echo base_url();?>center/index/resend_email/<?php echo $center_email?>">Click here to Resend verification link</a>
            </div>
        
        <?php }
        
        $success = $this->session->flashdata('email_verify');
        if($success)
        {
            ?>
            <div class="alert alert-success alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <?php echo $success; ?>                    
            </div>
        <?php }
        $signup_success=$this->session->flashdata('signup_success');
        if($signup_success)
        {?>
         <div class="alert alert-success alert-dismissable">
         <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
         <?php echo $signup_success; ?>  
         </div>
        <?php
        }
        ?>
        
        <form action="<?php echo base_url(); ?>center/Index/loginMe" method="post">
          <div class="form-group has-feedback">
            <input type="email" class="form-control" id="email" placeholder="Email" name="center_email" required /><span class="text-danger" id="email_err"></span>
            <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
          </div>
            <span class="text-danger"><?php echo form_error('center_email'); ?></span>
          <div class="form-group has-feedback">
            <input type="password" class="form-control" placeholder="Password" id="password" name="center_password" required /><span class="text-danger" id="password_err"></span>
            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
          </div>
            <span class="text-danger"></span>
          <div class="row">
            <div class="col-xs-8">    
              <!-- <div class="checkbox icheck">
                <label>
                  <input type="checkbox"> Remember Me
                </label>
              </div>  -->                       
            </div><!-- /.col -->
            <div class="col-xs-4">
              <input type="submit" class="btn btn-primary btn-block btn-flat" value="Sign In" />
            </div><!-- /.col -->
          </div>
            <br>
            
                   <div class="form-group has-feedback">
        <a href="<?php echo base_url(); ?>center/Index/forgotPassword">Forgot Password</a>
        <div class="pull-right"><a href="<?php echo base_url();?>center/index">Sign Up</a></div>
        </div>
        
    
        </form>
      
      </div><!-- /.login-box-body -->
      
      
      
      
     
     <!-- Bootstrap modal -->
  <div class="modal fade" id="add_form" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header" style="color:#fff; background-color:#338cbf" >
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
       <center> <h3 class="modal-title">Activate Account</h3></center>
       
      </div>
      <div class="modal-body form">
        <form id="otp_form" method="" action="">
          
                        <div class="form-group">
                            <label class="control-label col-md-3">Mobile Number</label>
                            <div class="col-md-7">
                                 <span style="color:green;">OTP is successfully send to this Mobile Number </span><br>
                                 <input type="text" name="mobile" readonly="" value="<?php echo $this->session->flashdata('mobile');?>" class="form-control" ><br>
                               
                            </div>
                        </div><br><br>
                        <div class="form-group">
                            <label class="control-label col-md-3">Enter OTP<span class="text-danger"> *</span></label>
                            <div class="col-md-7">
                                <input type="text" name="otp" required="" minlength="6" maxlength="6" class="form-control" >
                                <span id="otp_error" class="text-danger"></span>
                            </div>
                        </div>
                        <br><br><br>               
             <center>
                        <button type="button" onclick="send()" id="send_otp"  class="btn btn-primary">Activate Account</button>
                         
          </center>
                          

          </form>
      
           <br>
         
        </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
  <!-- End Bootstrap modal --></div>
      <?php if($this->session->flashdata('otp_modal'))
        {?>
        <script>
//            alert();
            $('#add_form').modal('show'); // show bootstrap modal          
            
       function send()
    {
        
      var url;
       var data = new FormData(document.getElementById("otp_form"));      
        url = "<?php echo site_url('index.php/center/Index/activate_account')?>";
        

       // ajax adding data to database
          $.ajax({
            url : url,
            type: "POST",
            async: false,
            processData: false,
            contentType: false,   
            data: data,
            dataType: "JSON",
            success: function(json)
            {
               if(json.otp_error)
               {
                   $("#otp_error").html(json.otp_error);
               }
               
               if(json.status)
               {
                   location.reload();
               }
              
//              location.reload();// for reload a page
                
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
//                alert('Error adding / update data');
            }
        });
    }

            
            </script>
       <?php     
        } ?>
      
    </div><!-- /.login-box -->

    
    
      
    
   </body>
</html>