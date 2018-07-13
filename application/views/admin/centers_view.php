<script src="<?php echo base_url("assets/js/form_validation.js"); ?>">
</script>
<style type="text/css">
  .modal fade{
    display: block !important;
}
.modal-dialog{
     width: 700px;
      overflow-y: initial !important
}
.modal-body{
  height: 450px;
  overflow-y: auto;
}


</style>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <i class="fa fa-users"></i><strong> Centers Management </strong>
        <small>Add, Edit, Delete <?php  ?></small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Manage Centers</li>
      </ol>
    </section><br>
    <section class="content">
       
        <div class="row">
         <div class="col-md-4">
    <button class="btn btn-primary" onclick="add_student()" data-toggle="tooltip" data-placement="bottom" title="Add Center">      <i class="glyphicon glyphicon-plus"></i> Add Centers</button>
<!--    <button class="btn btn-success" onclick="add_student()"><i class="glyphicon glyphicon-plus"></i> Payment</button>-->
    </div>
    <div class="col-md-6">
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
    <br><br>
    <div class="form-group" style="width:350px" >
            <label for="name">SEARCH</label>
        <input id="myName" class="form-control" type="text" placeholder="Search..." >
        </div>
<div class="table-responsive">
    <table id="table_id" class="table table-striped table-bordered" cellspacing="0" width="100%">
      <thead>
        <tr bgcolor="#338cbf" style="color:#fff">
          <th>ID</th>
          <th>NAME</th>
          <th>CENTER NAME</th>
          <th>MOBILE</th>
          <th>CITY</th>
          <th>CREATED AT</th>
          <th>STATUS</th>

          <th style="width:125px;">ACTION
          </p></th>
        </tr>
      </thead>
      <tbody id="myTable">
        <?php
          if (isset($centers)) {
            
          
         foreach($centers as $res){?>
             <tr>    <!--                    <td><input type="checkbox" name="checked[]"  value="<?php echo $res->center_id; ?>" class="" ></td> -->
                                        <td><?php echo $res->center_id;?></td>
                                        <td><?php echo $res->center_fname.' '. $res->center_lname; ?></td>
                                        <td><?php echo $res->center_name;?></td>
                                       <td><?php echo $res->center_mobile;?></td>
                                       <td><?php echo $res->center_city;?></td>
                                       <td><?php echo $res->center_created_at;?></td>
                                       <td>
                                           <?php 
                                       if($res->center_status==1)
                                       {
                                           echo "Active";
                                       }
                                       else 
                                       {
                                           echo "Not Active";
                                       }
                                       ?></td>
                                       <td>
                  <button class="btn btn-success btn-xs" onclick="edit_center(<?php echo $res->center_id; ?>)" data-toggle="tooltip" data-placement="bottom" title="Edit Center"><i class="glyphicon glyphicon-pencil"></i></button>
                  <button class="btn btn-danger btn-xs" onclick="delete_center(<?php echo $res->center_id;?>)" data-toggle="tooltip" data-placement="bottom" title="Delete Center"><i class="glyphicon glyphicon-trash"></i></button>
                  <button type="button" class="btn btn-info btn-xs" onclick="view_center(<?php echo $res->center_id; ?>)" data-toggle="tooltip" data-placement="bottom" title="View Center"><i class="glyphicon glyphicon-eye-open"></i></button>

                </td>
              </tr>
             <?php }}?>



      </tbody>

    </table>
    </div>
</section>
  </div>

  <script type="text/javascript">
  $(document).ready( function () {   
 
 
 
 
 
 
          $('#state').change(function() {
        // alert();
   var el = $(this) ;
              $('#city').html("");
              $("#city").append('<option value="">--Select City--</option>');              
var state=el.val();
        if(state)
        {
          // alert(state);            
      $.ajax({
       url : "<?php echo site_url('admin/Index/show_cities')?>/" + state,        
       type: "GET",              
       dataType: "JSON",
       success: function(data)
       {        
          $.each(data,function(i,row)
          {          
              $('#city').append('<option value="'+ row.cityName +'">' + row.cityName+'</option>');
          }
          );
       },
       error: function (jqXHR, textStatus, errorThrown)
       {
//         alert('Error...!');
       }
     });
     }    
 });
 
 
      $('#table_id').DataTable();
  } );

    $("#myName").on("keyup", function() {
    var value = $(this).val().toLowerCase();
    $("#myTable tr").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
  });
  
    var save_method; //for save method string
    var table;

 function printchalan()
        {
//          alert();
           var divToPrint=document.getElementById("chalan");
           newWin= window.open("");
           var htmlToPrint = '' +
                '<style type="text/css">' +
                'table th, table td {' +
                'border:0.5px solid #000;' +
                'padding:0.5em;' +
                '}' +
                '</style>';

            htmlToPrint += divToPrint.outerHTML;



           newWin.document.write(htmlToPrint);
           newWin.print();
           newWin.close();
        }

function view_center(id)
    {
      save_method = 'update';
     $('#form')[0].reset(); // reset form on modals
     // alert();
      //Ajax Load data from ajax
      $.ajax({
        url : "<?php echo site_url('admin/Centers/ajax_edit/')?>/" + id,        
        type: "GET",
               
        dataType: "JSON",
        success: function(data)
        {          
          // alert(data.center.center_name);
            $('#cname').html(data.center.center_name);
            $('#caddress').html(data.center.center_address); 
            $('#cmobile').html(data.center.center_mobile);
            $('#cemail').html(data.center.center_email);
            $('#dname').html(data.system.system_nickname);
            $('#daddress').html(data.system.system_address);
            $('#dcontact').html(data.system.system_mobile);
            $('#demail').html(data.system.system_email);
            $('#dwebsite').html(data.system.system_website);
            // if(data.student_profile_pic)
            // {
            // $('#sprofile_pic').attr("src", "<?php  echo base_url();?>"+data.student_profile_pic);
            //  }
            //  else
            //  {
            //    $('#sprofile_pic').attr("src", "<?php echo base_url(); ?>profile_pic/avatar.png");
            //  }
            // $('#remove_pic').attr("onclick","remove_profile_pic("+data.student_id+")");
            // $('#sdob').html(data.student_dob);
            // $('#susername').html(data.student_username);
            // $('#spassword').html(data.student_password);
            // $('#sstudent_last_education').html(data.student_last_education);
            // $('#saddress').html(data.student_address);  
            // $('#scity').html(data.student_city);
            // $('#sstate').html(data.student_state);
            // $('#spincode').html(data.student_pincode);
            
            $('#modal_form2').modal('show'); // show bootstrap modal when complete loaded
            $('.modal-title').text('Center Data'); // Set title to Bootstrap modal title

        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error get data from ajax 1');
        }
    });
    }

    function add_student()
    {
      save_method = 'add';
      $('#form')[0].reset(); // reset form on modals
      $('#modal_form').modal('show'); // show bootstrap modal
      $('.modal-title').text('Add Centers'); // Set Title to Bootstrap modal title
    }

    function edit_center(id)
    {
      save_method = 'update';
     $('#form')[0].reset(); // reset form on modals

      //Ajax Load data from ajax
      $.ajax({
        url : "<?php echo site_url('admin/Centers/ajax_edit/')?>/" + id,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {
//            $("#append_city").remove();     
            $('[name="center_id"]').val(data.center.center_id);
            $('[name="center_fname"]').val(data.center.center_fname);
            $('[name="center_name"]').val(data.center.center_name);
            $('[name="center_lname"]').val(data.center.center_lname);
            $('[name="center_email"]').val(data.center.center_email);
            $('[name="center_mobile"]').val(data.center.center_mobile);
            $('[name="center_gender"]').val(data.center.center_gender);
            $('[name="center_dob"]').val(data.center.center_dob);
            $('[name="center_address"]').val(data.center.center_address);  
            $('[name="center_password"]').val(data.center.center_password);
             $('[name="status"]').val(data.center.center_status);
            $('[name="center_cpassword"]').val(data.center.center_password);
            $('[name="center_city"]').val(data.center.center_city);
//             $("#center_city").append('<option value="'+ data.center_city +'" id="append_city">' + data.center_city + '</option>');
            $('[name="center_state"]').val(data.center.center_state);
            $('[name="center_pincode"]').val(data.center.center_pincode);
            
            $('#modal_form').modal('show'); // show bootstrap modal when complete loaded
            $('.modal-title').text('Edit Centers'); // Set title to Bootstrap modal title

        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error get data from ajax 1');
        }
    });
    }



    function save()
    {
        var val=center_form();
        
        if(val)
        {      
      var url;
      if(save_method == 'add')
      {
        url = "<?php echo site_url('admin/Centers/center_add')?>";
      }
      else
      {
        url = "<?php echo site_url('admin/Centers/center_update')?>";
      }

       // ajax adding data to database
          $.ajax({
            url : url,
            type: "POST",
            data: $('#form').serialize(),
            dataType: "JSON",
            success: function(data)
            {
                if(data.status)
                {
               
               //if success close modal and reload ajax table
               $('#modal_form').modal('hide');
              location.reload();// for reload a page
                 }
                 if(data.email_err)
                 {
                     $("#email_err").html(data.email_err);
                 }
                 
                 if(data.mobile_err)
                 {
                     $("#mobile_err").html(data.mobile_err);
                 }
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
//                alert('Error adding / update data');
            }
        });
        }
    }

    function delete_center(id)
    {
      if(confirm('Are you sure delete this data?'))
      {
        // ajax delete data from database
          $.ajax({
            url : "<?php echo site_url('admin/Centers/center_delete')?>/"+id,
            type: "POST",
            dataType: "JSON",
            success: function(data)
            {
               
               location.reload();
              
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error deleting data');
            }
        });

      }
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

  <!-- Bootstrap modal -->
  <div class="modal fade" id="modal_form" role="dialog">
  <div class="modal-dialog" id="modal_dialog">
    <div class="modal-content">
      <div class="modal-header" style="color:#fff; background-color:#338cbf">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <center><h3 class="modal-title">Center Form</h3></center>
      </div>
      <div class="modal-body form">    

          <div class="panel-body">
                            <form action="#" name="form_student" id="form" class="form-horizontal">
          <input type="hidden" value="" name="student_id"/>
          <input type="hidden" value="" name="center_id"/>
                            <div class="row">
                                <div class="form-group">
                            <div class="col-md-6 col-xs-12 col-sm-6">
                                
					<label for="name">First Name</label><span style="color:red">*</span>
					<input class="form-control" name="center_fname" id="fname" placeholder="First Name" required="" type="text"  value="" /><span class="text-danger" id="fname_err" style=""></span>
					
				
                             </div>
                          <div class="col-md-6 col-xs-12 col-sm-6">
				
					<label for="name">Last Name</label><span style="color:red">*</span>
                                        <input class="form-control" name="center_lname" id="lname" required="" placeholder="Last Name" type="text" value=""><span class="text-danger" id="lname_err" style=""></span>
			</div>
                        </div>
                             </div>
                            
                            
                    <div class="row">
                        <div class="form-group">
                    <div class="col-md-6 col-xs-12 col-sm-6">
                                <label for="name">Center Name</label><span style="color:red">*</span>
					<input class="form-control" name="center_name" id="center_name" required="" placeholder="Enter Center Name" type="text" value="" style="text-transform:uppercase" />
                                         <span class="text-danger" id="center_name_err"></span>
                   				
                    </div>
                     <div class="col-md-6 col-xs-12 col-sm-6">
				
				
					<label for="email">Email ID</label><span style="color:red">*</span>
					<input class="form-control" name="center_email" id="email" required="" placeholder="Email-ID" type="text" value="" />
                                        <span class="text-danger" id="email_err"></span>
                          	</div>
                    </div>
                    </div>
                            <div class="row">
                                 <div class="form-group"> 
                            <div class="col-md-6 col-xs-12 col-sm-6" >
                                 	<label for="mobile">Mobile</label><span style="color:red">*</span>
					<input class="form-control" name="center_mobile" id="mobile" required="" minlength="10" maxlength="11" placeholder="Enter Mobile Number" type="text" value="" />
                    <span class="text-danger" id="mobile_err"></span>			
				
                                </div>
                                <div class="col-md-6 col-xs-12 col-sm-6">
                            <label for="subject">Password<span style="color:red">*</span><input type="checkbox" name="ch" id="chkpass" onclick="show_password()" ></label>
                              <input class="form-control" name="center_password" value="" id="password" required="" minlength="8" placeholder="Password" type="text" readonly="true" />
                                <span class="text-danger" id="password_err"></span>
          
                                 </div>
                                </div>
                                     </div>
                            
                            <div class="row">
                                <div class="form-group">
                                <div class="col-md-6 col-xs-12 col-sm-6">
                                
                                <label for="text">Gender</label><span style="color:red">*</span>
                                <select name="center_gender" required="" class="form-control">
                                <option value="male">Male</option>
                                <option value="female">Female</option>
                                </select>
                                </div>
                               
                             
                                <div class="col-md-6 col-xs-12 col-sm-6">                          
                               
                                  
                                <label for="dob">DOB</label><span style="color:red">*</span>
				<input class="form-control required digits" name="center_dob" type="Date" value="" />
				
                                  
                                    </div>
                                </div>
                            </div>
                                               
                            
                            <div class="row">
                                <div class="form-group">
                                  <div class="col-md-6 col-xs-12 col-sm-6">
					<label for="text">Address</label><span style="color:red">*</span>
                                        <textarea class="form-control" name="center_address"   rows="4" cols="50" value="">
                                        </textarea>
                                   </div>                     
				</div>   
                                </div>
                            
                            <div class="row">
                                 <div class="form-group">
                                 <div class="col-md-6 col-xs-12 col-sm-6" >                               
                                <label for="text">State</label><span style="color:red">*</span>
                                <select name="center_state" id="state" class="form-control">
                                     <option value="">-- Select State --</option>
                                     <?php $result=$this->Location_model->getall(); 
                                            foreach($result as $res)
                                            {
                                                echo '<option value="'.$res->stateID.'">'.$res->stateName.'</option>';
                                            }
                                       ?>
                                            
                                 
                                </select>
                                </div>
                                
                                <div class="col-md-6 col-xs-12 col-sm-6">                      
                               
                                <label for="text">City</label><span style="color:red">*</span>
                                <select class="form-control" id="city" name="center_city">
                                  <option value="">-- Select City --</option>
                                 
                                </select>
                                </div>
                                </div>
                            </div>
                            
                            
                            <div class="row">
                             <div class="form-group">
                                 <div class="col-md-6 col-xs-12 col-sm-6" >
					<label for="text">Pincode</label><span style="color:red">*</span>
					<input class="form-control" name="center_pincode" id="pincode" maxlength="6" placeholder="Enter Pincode" type="text" value="" />
                                        <span class="text-danger" id="pincode_err"></span>
					
                            </div>
                               
                
                                  <div class="col-md-6 col-xs-12 col-sm-6">
              <label class="">Status</label>
                     <select name="status" class="form-control">
                      <option value="1">Active</option>
                      <option value="0">Not Active</option>
                  </select>
              
            </div>
                       </div>
                            </div>               
           </form>
                        </div>   
       
          </div>
          <div class="modal-footer">
            <button type="button" id="btnSave" onclick="save()" class="btn btn-primary">Save</button>
            <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
          </div>
        </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
  <!-- End Bootstrap modal -->
  










  
    <div class="modal fade" id="modal_form2" role="dialog">
  <div class="modal-dialog" id="modal_dialog1">
    <div class="modal-content">
      <div class="modal-header" style="color:#fff; background-color:#338cbf">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
       <center> <h3 class="modal-title">Course Form</h3></center>
      </div>
         <form action="#" name="form_student" id="form2" class="form-horizontal">
      <div class="modal-body form">
       
          <div class="box-body" id="chalan">
                            
            <div>
              <strong>To,</strong>
              <p id="cname"></p>
              <p id="caddress"></p>
              <p id="cmobile"></p>
              <p id="cemail"></p>
            </div><br>
            <div class="row">
              <div class="col-md-7"></div>
              <div class="col-md-5">
              <strong>From,</strong>
              <p id="dname"></p>
              <p id="daddress"></p>
              <p id="dcontact"></p>
              <p id="demail"></p>
              <p id="dwebsite"></p>



              </div>
              
            </div>
              
              
    
        
          </div>
        </div>
          <div class="modal-footer">
            <button type="button" id="btnSave" onclick="printchalan()"  class="btn btn-success">Print</button>
            <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
          </div>
          </form>
        </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
    </div>

  </body>
</html>

<script>
    
    </script>

