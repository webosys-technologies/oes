<style type="text/css">

  
#box{
    /*padding:100px,0px;*/
    width:100px;
    height:100px;
    background-color:lightgrey;
    text-align:center;
   
}
#img{
    display:none;
}
</style>


<div class="content-wrapper">
     <section class="content-header">
      <h1>
       <strong> Profile </strong>
        <small>Control panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url(); ?>center/Dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Profile</li>
      </ol>
    </section>

<!--<div class="panel-group">-->
    
     <!--<div class="panel panel-default">-->
     
     
     <section class="content-header">



        
         <?php
          if(isset($data))
          {
               foreach ($data as $res) {
                 $info=array(
                        'center_id' => $res->center_id,
                          'center_fname'=>$res->center_fname,
                        'center_lname'=>$res->center_lname,
                        'center_name' =>$res->center_name,
                        'center_email'=>$res->center_email,
                        'center_mobile'=>$res->center_mobile,
                        'center_gender'=>$res->center_gender,
                        'center_dob'=>$res->center_dob,
                        'center_address'=>$res->center_address,
                        'center_city'=>$res->center_city,
                        'center_state'=>$res->center_state,
                        'center_pincode'=>$res->center_pincode,
                        'center_profile_pic'=>$res->center_profile_pic
                      );
		 }	
          }
          ?>
    
        
	<div class="row" id="profile">
      <!-- left column -->
      <div class="col-md-3">
        <img src='<?php if($info['center_profile_pic']){echo base_url(); echo $info['center_profile_pic'];}else{ echo base_url()."assets/dist/img/avatar.png"; }?>' class="img-circle" width="150" height="150" alt="User Image"/>
            <!--<img src="<?php echo base_url(); echo $info['center_profile_pic'];?>" class="img-circle" width="150" height="120" alt="avatar">-->
            <br> &nbsp;&nbsp;
          <!--<input id="files"  type="file">-->
            <h3><?php echo $info['center_fname']." ".$info['center_lname'];?></h3>      
        </div>
      
     
      <div class="col-md-9">
            
          <label> <span class="glyphicon glyphicon-user "> </span>&nbsp; Name :</label><?php echo  $info['center_fname']."&nbsp;".$info['center_lname'];?><br>
          <label> <span class="glyphicon glyphicon-envelope"></span>&nbsp; Email :</label><?php echo $info['center_email'];?><br>
          <label> <span class="fa fa-graduation-cap"></span>&nbsp; Education :</label><?php echo $info['center_name'];?><br>
          <label> <span class="glyphicon glyphicon-phone"></span>&nbsp; Mobile :</label><?php echo $info['center_mobile'];?><br>
          <label> <span class="glyphicon glyphicon-user"></span>&nbsp; Gender :</label><?php echo $info['center_gender'];?><br>
          <label> <span class="fa fa-birthday-cake"></span>&nbsp; DOB :</label><?php echo $info['center_dob'];?><br>
          <label> <span class="glyphicon glyphicon-home"></span>&nbsp; Address :</label><?php echo $info['center_address'];?><br>
          <h4><a href="#" data-toggle="collapse" data-target="#demo" onclick="edit_profile(<?php echo $info['center_id']; ?>)">Edit Pofile?</a></h4>
  
               
                   
        </div>
      </div>


      <script type="text/javascript">
        $(document).ready(function(){
            
            
   function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('#sprofile_pic').attr('src', e.target.result);
            
        }

        reader.readAsDataURL(input.files[0]);
    }
}



var _URL = window.URL || window.webkitURL;
$("#img").change(function (e) {
    var file, img;
    if ((file = this.files[0])) {
    var xyz=this;
       
        img = new Image();
        img.onload = function () { 
            
            if(this.height>1200 || this.width>1920 || file.size>7340032)
            {
                $('#sprofile_pic').attr('src',"");
                  $("#img_error").html("please upload image less than 7 mb or Dimenssion 1920*1200");
                  $("#img").val("");
                  $("#box").show();
                  $("#img_error").show(); 
             }
            else
            {
                                
                  $("#box").hide();
               $("#img_error").hide();      
                        readURL(xyz);       
                  $("#img_box").show();
            }
           
        };
        img.src = _URL.createObjectURL(file);
    }
});


        });

    function edit_profile(id)
    {
      save_method = 'update';
     $('#form')[0].reset(); // reset form on modals
     $('#sprofile_pic').attr('src', "");
      //Ajax Load data from ajax
      $.ajax({
        url : "<?php echo site_url('index.php/center/Index/ajax_edit/')?>/" + id,        
        type: "GET",
               
        dataType: "JSON",
        success: function(data)
        {        
            $('[name="center_id"]').val(data.center_id);            
            $('[name="center_fname"]').val(data.center_fname);
            $('[name="center_lname"]').val(data.center_lname);
            $('[name="center_email"]').val(data.center_email);
            $('[name="center_mobile"]').val(data.center_mobile);
            $('[name="center_address"]').val(data.center_address);
           
            if(data.center_profile_pic)
            {
            $('#sprofile_pic').attr("src", "<?php  echo base_url();?>"+data.center_profile_pic);
             }
             else
             {
               $('#sprofile_pic').attr("src", "<?php echo base_url(); ?>profile_pic/avatar.png");
             }
            $('#modal_form').modal('show'); // show bootstrap modal when complete loaded
            $('.modal-title').text('Edit Profile'); // Set title to Bootstrap modal title
            

        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error get data from ajax 1');
        }
    });
    }

    function save()
    {
        var data = new FormData(document.getElementById("form"));

      var url;
      
        url = "<?php echo site_url('index.php/center/Index/update_profile')?>";
      

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
                    alert("Data Save Successfully...!"); 
               //if success close modal and reload ajax table
               $('#modal_form').modal('hide');
              location.reload();// for reload a page
             
            
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error adding / update data Please select image less than 2 MB');
            }
        });
    }



      </script>

      <div class="modal fade" id="modal_form" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header" style="color:#fff; background-color:#338cbf">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <center><h3 class="modal-title">Course Form</h3></center>
      </div>
        <form action="#" name="form_student" id="form" class="form-horizontal">
      <div class="modal-body form">
          <input type="hidden" value="" name="student_id"/>
          <input type="hidden" value="" name="center_id"/>

          <div class="box-body">
                         
                            <input type="hidden" name="center_id">  
                            <div class="row">
                            <div class="col-md-3" >
                      <!--<img src="<?php echo base_url(); ?><?php if (!empty($res->student_profile_pic)){echo $res->student_profile_pic;} else{echo "profile_pic/avatar.png";}?>" class="avatar img-responsive"  width="100px" height="100px">-->
                           <img id='sprofile_pic' src='' width="100px" hieght="100px" >
                           </div>
                                </div>
                            <div class="row">
                                <div class="col-md-5  ">                                
                                    <div class="form-group">
                                        <label for="fname">First Name</label>
                                        <input type="text" class="form-control required" id="fname" name="center_fname" maxlength="128"   style="text-transform:uppercase" required>
                                        <span class="text-danger" id="fname_err"></span>

                                    </div>
                                    
                                </div>
                                <div class="col-md-5 col-md-offset-1">
                                    <div class="form-group">
                                        <label for="lname">Last Name</label>
                                        <input type="text" class="form-control required email" id="lname"  name="center_lname" maxlength="128"  style="text-transform:uppercase" required>
                                      <span class="text-danger" id="lname_err"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-5">
                                    <div class="form-group">
                                        <label for="email">E-mail</label>
                                        <input type="email" class="form-control required" id="email"  name="center_email" maxlength="128" required>
                                        <span class="text-danger" id="email_err"></span>
                                    </div>
                                </div>
                                <div class="col-md-5 col-md-offset-1">
                                    <div class="form-group">
                                        <label for="mobile">Mobile Number</label>
                                        <input type="text" class="form-control required digits" id="mobile" name="center_mobile" maxlength="10" required>
                                       <span class="text-danger" id="mobile_err"></span>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="row">
                                
                                <div class="col-md-5 ">
                                    <div class="form-group">
                                        <label for="address">Address</label>
                                        <textarea class="form-control required " id="address" name="center_address" maxlength="128" required></textarea>
                                    </div>
                                </div>
                                <div class="col-md-5 col-md-offset-1">
                                      <div class="form-group">
                                          <label for="state">Profile Picture</label><br>
                                          <label class="btn btn-info">
                                          <input type = "file" name = "img" id="img" accept="image/*" required />                                            
                                          Choose Image
                                          </label><br>
                                          <span id="img_error" style="color:red"></span>
                                      </div>
                                </div>
                            </div>
                            
                             
                        </div><!-- /.box-body -->
    
        
          </div>
          <div class="modal-footer">
            <button type="button" id="btnSave" onclick="save()"  class="btn btn-success">Save</button>
            <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
          </div>
          </form>
        </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
  <!-- End Bootstrap modal -->

       </section>
  
      </div>


    
        
    



    