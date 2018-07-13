<!DOCTYPE html>
<html>
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Center Registration</title>
	<link href="<?php echo base_url("assets/bootstrap/css/bootstrap.css"); ?>" rel="stylesheet" type="text/css" />
        <script type="text/javascript" src="<?php echo base_url("assets/js/jQuery-2.1.4.min.js"); ?>"></script>
</head>
<script src="<?php echo base_url("assets/js/validation1.js"); ?>">
</script>

<script>
    $(document).ready(function() {

//  $("#state").change(function() {
//
//    var el = $(this) ;
//
//    if(el.val() === "Maharashtra" ) {
//var state=el.val();
//           
//       $.ajax({
//        url : "<?php echo site_url('index.php/center/Index/show_cities')?>/" + state,        
//        type: "GET",
//               
//        dataType: "JSON",
//        success: function(data)
//        {
//         
//           $.each(data,function(i,row)
//           {
//            
//               $("#city_name").append('<option value="'+ row.city_name +'">' + row.city_name + '</option>');
//           }
//           );
//        },
//        error: function (jqXHR, textStatus, errorThrown)
//        {
//          alert('Error...!');
//        }
//      });
//    }
//     
//  });

});
 
</script>
    
    
<body style="background:#d2d6de">
<div class="container">
<div class="row">
	<div class="col-md-6 col-md-offset-3">
		<?php echo $this->session->flashdata('verify_msg'); ?>
	</div>
   
</div>
    <br>
    <br>

<div class="row">
	<div class="col-md-offset-3 col-md-6 col-md-offset-3">
		<div class="panel panel-default">
			<div class="panel-heading" style="background:#3c8dbc">
                            <h4 style="color:white">Center Registration</h4>
			</div>
			<div class="panel-body">
				<?php $attributes = array("name" => "registrationform");
				echo form_open("center/Index/register", $attributes);?>
		<div class="row">
                    <div class="col-md-6">
                                <div class="form-group">
					<label for="name">First Name</label><span style="color:red">*</span>
					<input class="form-control" name="center_fname" id="fname" placeholder="First Name" minlength="2" required="" type="text"  value="<?php echo set_value('center_fname'); ?>" /><span class="text-danger" id="fname_err"></span>
					<span class="text-danger"><?php echo form_error('center_fname'); ?></span>
				</div>
                        </div>
                    <div class="col-md-6">
				<div class="form-group">
					<label for="name">Last Name</label><span style="color:red">*</span>
					<input class="form-control" name="center_lname" id="lname" required="" placeholder="Last Name" minlength="2"  type="text" value="<?php echo set_value('center_lname'); ?>" /><span class="text-danger" id="lname_err"></span>
					<span class="text-danger"><?php echo form_error('center_lname'); ?></span>
				</div>
                        </div>
                </div>
                            
                            
                    <div class="row">
                    <div class="col-md-6">
                                <div class="form-group">
					<label for="name">Center Name</label><span style="color:red">*</span>
					<input class="form-control" name="center_name" id="center_name" minlength="2"  required="" placeholder="Enter Center Name" type="text" value="<?php echo set_value('center_name'); ?>" />
                    <span class="text-danger" id="center_name_err"></span>
					<span class="text-danger"><?php echo form_error('center_name'); ?></span>
				</div>
                    </div>
                     <div class="col-md-6">
				
				<div class="form-group">
					<label for="email">Email ID</label><span style="color:red">*</span>
					<input class="form-control" name="center_email" id="email" required="" placeholder="Email-ID" type="text" value="<?php echo set_value('center_email'); ?>" />
                    <span class="text-danger" id="email_err"></span>
					<span class="text-danger"><?php echo form_error('center_email'); ?></span>
				</div>
                    </div>
                    </div>
                            <div class="row">
                            <div class="col-md-6" >
                                <div class="form-group">
					<label for="mobile">Mobile</label><span style="color:red">*</span>
					<input class="form-control" name="center_mobile" id="mobile" required="" minlength="10" maxlength="11" placeholder="Enter Mobile Number" type="text" value="<?php echo set_value('center_mobile'); ?>" />
                    <span class="text-danger" id="mobile_err"></span>
					<span class="text-danger"><?php echo form_error('center_mobile'); ?></span>
				</div>
                                </div>
                                </div>
                            
                            <div class="row">
                                <div class="col-md-6">
                                <div class="form-group">
                                <label for="text">Gender</label><span style="color:red">*</span>
                                <select  required name="center_gender" required="" class="form-control">
                                <option value="male">Male</option>
                                <option value="female">Female</option>
                                </select>
                                </div>
                                </div>
                             
                                <div class="col-md-6">                          
                                <div class="form-group">
                                  
                                <label for="dob">DOB</label><span style="color:red">*</span>
				<input required class="form-control required digits" name="center_dob" type="Date" value="<?php echo set_value('center_dob'); ?>" />
				<span class="text-danger"><?php echo form_error('center_dob'); ?></span>
                                  
                                    </div>
                                </div>
                            </div>
                                                   
                            
                            <div class="row">
				<div class="form-group">
                                    <div class="col-md-6">
					<label for="subject">Password</label><span style="color:red">*</span>
					<input class="form-control" name="center_password" id="password" required="" minlength="8" placeholder="Password" type="password" /><span class="text-danger" id="password_err"></span>
					<span class="text-danger"><?php echo form_error('center_password'); ?></span>
				    </div>
                                    <div class="col-md-6">
					<label for="subject">Confirm Password</label><span style="color:red">*</span>
					<input class="form-control" name="center_cpassword" id="cpassword" required="" placeholder="Confirm Password" type="password" /><span class="text-danger" id="cpassword_err"></span>
					<span class="text-danger"><?php echo form_error('center_cpassword'); ?></span>
				
                                    </div>
                                    </div>
                               </div>
                                <div class="form-group">
					<label for="text">Address</label><span style="color:red">*</span>
                                        <textarea required class="form-control" name="center_address"   rows="4" cols="50" value="<?php echo set_value('center_address'); ?>">
                                        </textarea>
                                        <span class="text-danger"><?php echo form_error('center_address'); ?></span>
				</div>   
                            
                            <div class="row">
                                 <div class="col-md-6" >
                                <div class="form-group">
                                <label for="text">State</label><span style="color:red">*</span>
                                <select name="center_state" id="state" class="form-control" required>
                                    <option value="">-- Select State --</option>
                                  <option value="Maharashtra">Maharashtra</option>
                                </select>
                                </div>
                                </div>
                                <div class="col-md-6">                            
                                <div class="form-group">
                                <label for="text">City</label><span style="color:red">*</span>
                                <select required class="form-control" id="city_name" name="center_city">
                                  <option value="">-- Select City --</option>
                                 <?php 
                                            foreach($cities as $row)
                                            { 
                                              echo '<option value="'.$row->city_name.'">'.$row->city_name.'</option>';
                                            }
                                            ?>
                                  <!--<option id="city_names"></option>-->
                                </select>
                                </div>
                                </div>
                            </div>
                            
                            <div class="row">
                            <div class="col-md-6" >
                            <div class="form-group">
					<label for="text">Pincode</label><span style="color:red">*</span>
					<input class="form-control" name="center_pincode" id="pincode" maxlength="6" placeholder="Enter Pincode" type="text" value="<?php echo set_value('center_pincode'); ?>" /><span class="text-danger" id="pincode_err"></span>
					<span class="text-danger"><?php echo form_error('center_pincode'); ?></span>
                            </div>
                                </div>
                            </div>
                            
                            <div class="row">
                            <div class="col-md-5" > 
				<div class="form-group">
					<button name="submit" type="submit" class="btn btn-success">Signup</button>
					<button name="cancel" type="reset" class="btn btn-danger">Clear</button>
				</div>
                           </div>
                                </div>
                            <div class="row">
                                <div class="col-md-8">
                                    <a href="<?php echo base_url();?>center/index/login">I already have an account? Sign in here.</a>    
                                </div>
                                </div>
                            </div>
				<?php echo form_close(); ?>
				<?php echo $this->session->flashdata('msg'); ?>
			</div>
		</div>
	</div>
</div>
  
</div>
</body>
</html>