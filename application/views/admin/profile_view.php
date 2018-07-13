
<style type="text/css">
  .modal fade{
    display: block !important;
}
.modal-dialog{
     width: 700px;
      overflow-y: initial !important
}
.modal-body{
  overflow-y: auto;
}

#box{
    /*padding:100px,0px;*/
    width:100px;
    height:100px;
    background-color:lightgrey;
    text-align:center;
   
}

#img{
    display: none;
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
          if(isset($user_info))
          {
              
          }
          ?>
    
        
	<div class="row" id="profile">
      <!-- left column -->
      <div class="col-md-3">
        
           <img src='<?php if($user_info->user_profile_pic){echo base_url(); echo $user_info->user_profile_pic;}else{ echo base_url()."profile_pic/boss.png"; }?>' width="100px" hieght="100px" class="img-circle" alt="User Image"/>
             &nbsp;&nbsp;
          <!--<input id="files"  type="file">-->
            <h4><?php echo $user_info->user_fname." ".$user_info->user_lname;?></h4>      
        </div>
      
     
      <div class="col-md-9">
            
          <label> <span class="glyphicon glyphicon-user ">&nbsp; </span>Name :</label><?php echo $user_info->user_fname."&nbsp;".$user_info->user_lname;?><br>
          <label> <span class="glyphicon glyphicon-envelope">&nbsp;</span>Email :</label><?php echo $user_info->user_email;?><br>
          <label> <span class="glyphicon glyphicon-phone">&nbsp;</span>Mobile :</label><?php echo $user_info->user_mobile;?><br>
          <label> <span class="glyphicon glyphicon-user"></span>&nbsp;Gender :</label><?php echo $user_info->user_gender ;?><br>
          <h4><a href="#" data-toggle="collapse" data-target="#demo" onclick="edit_profile(<?php echo $user_info->user_id ; ?>)">Edit Pofile?</a></h4>
  
               
                   
        </div>
      </div>


      <script type="text/javascript">
        $(document).ready(function(){
            
            
   function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('#profile_pic').attr('src', e.target.result);
            
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
                $('#profile_pic').attr('src',"");
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

      //Ajax Load data from ajax
      $.ajax({
        url : "<?php echo site_url('index.php/admin/Profile/ajax_edit/')?>/" + id,        
        type: "GET",
               
        dataType: "JSON",
        success: function(data)
        {        

            $("#userid").val(data.user_id);            
            $('[name="user_fname"]').val(data.user_fname);
            $('[name="user_lname"]').val(data.user_lname);
            $('[name="user_email"]').val(data.user_email);
            $('[name="user_mobile"]').val(data.user_mobile);
            $('[name="user_password"]').val(data.user_password);

            $('#user_profile_pic').attr("src", "<?php echo base_url();?>"+data.center_profile_pic);
            
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
      
        url = "<?php echo site_url('index.php/admin/Profile/user_update')?>";
      

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

    function show_password() {
  
    var x =$("#password").prop('readonly');
    if(x == true)
     {        
        $("#password").prop('readonly',false);
    }
    else
    {        
        $("#password").prop('readonly',true);
   }
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
          <input type="hidden" value="" name="user_id"/>
                    <div class="box-body">
                          
                            <input type="hidden" name="user_id">
      <div class="modal-body form">         
                    <div class="box-body">   
                         <input type="text" value="" id="userid" name="user_id" hidden/>
                         
                                    
                         <div class="row">
                                <div class="col-md-4 col-md-offset-1 ">                                
                                    <div class="form-group">
                                        <label for="fname">First Name</label>
                                        <input type="text" class="form-control required" id="fname" name="user_fname" maxlength="128"   style="text-transform:uppercase" required>
                                        <span class="text-danger" id="fname_err"></span>

                                    </div>
                                    
                                </div>
                                <div class="col-md-4 col-md-offset-1 ">
                                    <div class="form-group">
                                        <label for="lname">Last Name</label>
                                        <input type="text" class="form-control required email" id="lname"  name="user_lname" maxlength="128"  style="text-transform:uppercase" required>
                                      <span class="text-danger" id="lname_err"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                               <div class="col-md-4 col-md-offset-1 ">
                                    <div class="form-group">
                                        <label for="mobile">Mobile Number</label>
                                        <input type="text" class="form-control required digits" id="mobile" name="user_mobile" maxlength="10" required>
                                       <span class="text-danger" id="mobile_err"></span>
                                    </div>
                                </div>
                                 <div class="col-md-4 col-md-offset-1">
                                      <div class="form-group">
                                          <label for="state">Profile Picture</label> 
                                          <label id="file_label" class="btn btn-info">
                                          <input type = "file"  id="img" name = "img"  accept="image/*" required /> 
                                          Choose Image
                                          </label>
                                      </div>
                                </div>
                            </div>
                            
                            <div class="row">
                                
                                <div class="col-md-4 col-md-offset-1">
                                <div class="form-group">
                                  <label>Password<input type="checkbox" name="ch" id="chkpass" onclick="show_password()" ></label>
                                  <input class="form-control" name="user_password" value="" id="password" required="" minlength="8" placeholder="Password" type="text" readonly="true" />
                                </div>                                
                                </div> 
                               
                             <div class="col-md-4 col-md-offset-1">
                            <div id="box"><p>width*height 1920*1200</p></div>
                            <div class="col-md-3" hidden id="img_box">                                
                            <img id='profile_pic' src='' width="100px" hieght="100px" >
                            
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


    
        
    



    