

<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>Student System Log in</title>
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

<script type="text/javascript">
    $(window).on('load',function(){
        $('#myModal').modal('show');
    });
</script>
  
<body>
            <form class="modal fade" id="myModal" role="dialog" action="<?php echo base_url(); ?>Examination/check_center_password" method="post">
   
            <div class="modal-dialog">
     
      <!-- Modal content-->
      <div class="modal-content">
         
          <div style="background:#F0B27A" class="panel-heading">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <center><h4 class="modal-title" style="color:white">Center Administrative Password</h4></center>
        </div>
          <div class="panel-body" style="background:#FAD7A0;">
          <div class="row">
           <div class="col-md-12">
         <?php
        $this->load->helper('form');
        $success = $this->session->flashdata('success');
        if($success)
        {
            ?>
            
        <div class="alert alert-success alert-dismissible" data-auto-dismiss="5000">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    <strong>Success!</strong> <?php echo $success; ?> 
  </div>
        <?php }?>
             
              <?php
        $this->load->helper('form');
        $error = $this->session->flashdata('error');
        if($error)
        {
            ?>           
        <div class="alert alert-danger alert-dismissible" data-auto-dismiss="2000">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    <strong>Error!</strong> <?php echo $error; ?> 
  </div>
        <?php }?>    
       
        </div>
              </div>
                    <div class="row" >
                    <div class="col-md-offset-3 col-md-6 col-md-offset-3" >
                                <div class="form-group">
                                    <input name="oes_acc_id" value="<?php echo $oes_acc_id; ?>" hidden >
				<label for="subject">Enter Center Password</label><span style="color:red">*</span>
					<input class="form-control" name="center_password" id="password" required placeholder="Enter password" type="password" /><span class="text-danger" id="password_err"></span>
					<span class="text-danger"><?php echo form_error('center_password'); ?></span>	
                                </div>
                        
                               
                         <div class="form-group">
            <button type="Submit" name="submit" class="btn btn-primary">Login</button>
            <a href="<?php echo  base_url();?>Examination" name="cancel" class="btn btn-danger">Cancel</a>
        </div>
                         </div>
                    
      </div>
          </div>
      </div>
      
    </div>
        </form> 
</body>
</html>