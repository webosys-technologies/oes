<!DOCTYPE html>

<html>
  <head>
    <meta charset="UTF-8">
    <title>Center|Dashboard</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <!-- Bootstrap 3.3.4 -->
    <link href="<?php echo base_url(); ?>assets/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />    
    <!-- FontAwesome 4.3.0 -->
    <link href="<?php echo base_url(); ?>assets/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <!-- Ionicons 2.0.0 -->
    <link href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css" rel="stylesheet" type="text/css" />
    <!-- Theme style -->
    <link href="<?php echo base_url(); ?>assets/dist/css/AdminLTE.min.css" rel="stylesheet" type="text/css" />
    <!-- AdminLTE Skins. Choose a skin from the css/skins 
         folder instead of downloading all of them to reduce the load. -->
    <link href="<?php echo base_url(); ?>assets/dist/css/skins/_all-skins.min.css" rel="stylesheet" type="text/css" />
    
     <link rel="stylesheet" href="<?php echo base_url(); ?>assets/bower_components/morris.js/morris.css">
  <!-- jvectormap -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/bower_components/jvectormap/jquery-jvectormap.css">
  <!-- Date Picker -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/bower_components/bootstrap-daterangepicker/daterangepicker.css">
  <!-- bootstrap wysihtml5 - text editor -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
   <link href="<?php echo base_url(); ?>assets/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />    
    <!-- FontAwesome 4.3.0 -->
    <link href="<?php echo base_url(); ?>assets/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <!-- Ionicons 2.0.0 -->
    <link href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css" rel="stylesheet" type="text/css" />
    <!-- Theme style -->
    <link href="<?php echo base_url(); ?>assets/dist/css/AdminLTE.min.css" rel="stylesheet" type="text/css" />
    <!-- AdminLTE Skins. Choose a skin from the css/skins 
         folder instead of downloading all of them to reduce the load. -->
    <link href="<?php echo base_url(); ?>assets/dist/css/skins/_all-skins.min.css" rel="stylesheet" type="text/css" />
     <link href="<?php echo base_url('assets/bootstrap/css/bootstrap.min.css')?>" rel="stylesheet">
    <link href="<?php echo base_url('assets/datatables/css/dataTables.bootstrap.css')?>" rel="stylesheet">

    <!-- Data tables.. -->
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css"/>
    
    
    
    <style>
    	.error{
    		color:red;
    		font-weight: normal;
    	}
        
        #center{
    font-size: 20px;
    color:white;
     padding-left:10cm;
    padding-top:15px;
}
    </style>
    <!-- jQuery 2.1.4 -->
    <script src="<?php echo base_url(); ?>assets/js/jQuery-2.1.4.min.js"></script>
 
    
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  
  
  
  <body class="skin-blue sidebar-mini">
    <div class="wrapper">
      
      <header class="main-header">
        <!-- Logo -->
        <a href="<?php echo base_url();?>center/index/login" class="logo">
          <!-- mini logo for sidebar mini 50x50 pixels -->
          <span class="logo-mini">DLT</span>
          <!-- logo for regular state and mobile devices -->
          <span class="logo-lg"><b><img src="<?php echo base_url('assets/images/oes_logo.PNG') ?>" width="100%" height="60px"></b></span>
        </a>
        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top" role="navigation">
          <!-- Sidebar toggle button-->
          <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
            <span class="sr-only">Toggle navigation</span>
          </a>
      
             
          <label id="center"><?php
          if(isset($data))
          { 
              foreach($data as $res)
              {
                echo $res->center_name;
              }
          
          }
          ?></label>             
          <?php
          if(isset($data))
          {
              
              
               foreach ($data as $res) {
                   
                   
                   
                 $info=array(
		 	'center_fname'=>$res->center_fname,
                        'center_lname'=>$res->center_lname,
                        'center_email'=>$res->center_email,
                        'center_mobile'=>$res->center_mobile,
                        'center_gender'=>$res->center_gender,
                        'center_dob'=>$res->center_dob,
                        'center_address'=>$res->center_address,
                        'center_city'=>$res->center_city,
                        'center_state'=>$res->center_state,
                        'center_pincode'=>$res->center_pincode,
                        'center_profile_pic'=>$res->center_profile_pic);
		 }	
          }
               
		 	 
          ?>
          
          <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
              <!-- User Account: style can be found in dropdown.less -->
              <li class="dropdown user user-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                     <img src='<?php if($info['center_profile_pic']){echo base_url(); echo $info['center_profile_pic'];}else{ echo base_url()."assets/dist/img/avatar.png"; }?>' class="user-image" alt="User Image"/>
                     <span class="hidden-xs"><?php echo $info['center_fname']."&nbsp;".$info['center_lname'];?></span>
                </a>
                <ul class="dropdown-menu">
                  <!-- User image -->
                  <li class="user-header">
                    <img src='<?php if($info['center_profile_pic']){echo base_url(); echo $info['center_profile_pic'];}else{ echo base_url()."assets/dist/img/avatar.png"; }?>' class="img-circle" alt="User Image"/>
                    <p>
                      <?php echo $info['center_fname']."&nbsp;".$info['center_lname'];?>
                      <small><?php echo 'Center' ?></small><br>
                    </p>
                  </li>
                  
                  <!-- Menu Footer-->
                  <li class="user-footer">
                    <div class="pull-left">
                      <button type="button" class="btn btn-default btn-flat" data-toggle="modal" data-target="#pass"><i class="fa fa-key"></i> Change Password</button>
                    </div>
                    <div class="pull-right">
                      <a href="<?php echo base_url(); ?>center/Index/signout" class="btn btn-default btn-flat"><i class="fa fa-sign-out"></i> Sign out</a>
                    </div>
                  </li>                 
                </ul>
              </li>
            </ul>
          </div>
        </nav>
      </header>
        
    
        
        
        <form  class="modal fade" id="pass" role="dialog" action="<?php echo base_url(); ?>student/index/reset_password" method="post">
             <div class="modal-dialog">
       <!-- Modal content-->
      <div class="modal-content">
         
        <div class="panel-heading">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Reset Password</h4>
        </div>
          
          <div class="row">
               <div class="col-md-offset-3 col-md-6 col-md-offset-3">
                            
                    <div class="form-group">

				<label for="subject">Enter Old Password</label><span style="color:red">*</span>
					<!--<input class="form-control" name="student_old_password" id="old_password" required="" minlength="8" placeholder="Enter Old password" type="password" /><span class="text-danger" id="old_password_err"></span>-->
					
                                </div>
                        
                                <div class="form-group">
				<label for="subject">Enter New Password</label><span style="color:red">*</span>
					<input class="form-control" name="student_new_password" id="password" required="" minlength="8" placeholder="Enter New Password" type="password" /><span class="text-danger" id="password_err"></span>
					
                                </div> 
                        
                                  <div class="form-group">
				<label for="subject">Confirm New Password</label><span style="color:red">*</span>
					<input class="form-control" name="student_confirm_password" id="cpassword" required="" minlength="8" placeholder="Confirm New Password" type="password" /><span class="text-danger" id="cpassword_err"></span>
					
                                  </div> 
                       
               
                   
                         <div class="form-group">
                             <button type="Submit" name="submit" class="btn btn-primary">Reset Password</button>
                            </div>
                   
                   
                         </div>     
                    
      </div>
          
          
          </div>
       </div>
        </form>
        
    
                    
      <!-- Left side column. contains the logo and sidebar -->
      <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
          
          <!-- sidebar menu: : style can be found in sidebar.less -->
          <ul class="sidebar-menu">
            <li class="header">MAIN NAVIGATION</li>
            <li class="treeview">
              <a href="<?php echo base_url(); ?>center/Dashboard">
                <i class="fa fa-dashboard"></i> <span>Dashboard</span></i>
              </a>
            </li>
            <li class="treeview">
              <a href="<?php echo base_url(); ?>center/Account" >
                <i class="fa fa-users"></i>
                <span>Roll Management</span>
              </a>
            </li>
            
            <li class="treeview">
              <a href="<?php echo base_url(); ?>center/Sub_center" >
                <i class="fa fa-users"></i>
                <span>Sub Centers</span>
              </a>
            </li>
            
            <li class="treeview">
              <a href="<?php echo base_url(); ?>center/Orders" >
                <i class="fa fa-users"></i>
                <span>Orders</span>
              </a>
            </li>
            
            <li class="treeview">
              <a href="<?php echo base_url(); ?>center/Payment" >
                <i class="fa fa-users"></i>
                <span>Payments</span>
              </a>
            </li>
            
             <li class="treeview">
              <a href="<?php echo base_url(); ?>center/Setting" >
                <i class="fa fa-users"></i>
                <span>Setting</span>
              </a>
            </li>
            
            <li class="treeview">
              <a href="<?php echo base_url(); ?>center/Profile" >
                <i class="fa fa-users"></i>
                <span>Manage Profile</span>
              </a>
            </li>
         
<!--
             <li class="treeview">
              <a href="<?php echo base_url(); ?>center/Setting" >
                <i class="fa fa-child"></i>
                <span>Setting</span>
              </a>
            </li>
            <li class="treeview">
              <a href="<?php echo base_url(); ?>center/Profile" >
                <i class="fa fa-child"></i>
                <span>Manage profile</span>
              </a>
            </li>-->
          
          </ul>
        </section>
       
        <!-- /.sidebar -->
      </aside>
      
     