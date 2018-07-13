

<style type="text/css">

  .modal fade{
    display: block !important;
}
.modal-dialog{
  width: 650px;
      overflow-y: initial !important
}
.modal-body{
  height: 500px;
  overflow-y: auto;
}
/*#pay{
  overflow-x: auto;
}*/
#box{
    /*padding:100px,0px;*/
    width:100px;
    height:100px;
    background-color:lightgrey;
    text-align:system;
   
}
p{
    padding:30px 0px;
}


#img{
    display: none;
}
</style>



<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <i class="fa fa-users"></i><strong> System Management</strong>
        <small>Add, Edit, Delete <?php  ?></small>
      </h1>
      <ol class="breadcrumb" >
        <li><a href="<?php echo base_url(); ?>system/Dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
        <li>SYSTEM MANAGEMENT</li>
      </ol>
    </section><br>
    <form id="table" name="table" action="<?php echo base_url(); ?>system/Orders/selected_mem" method="post">
    <section class="content-header">
    <div class="row">
    <div class="col-md-4">
    <button type="button" class="btn btn-primary" onclick="add_system()"><i class="glyphicon glyphicon-plus"></i> Add SYSTEM</button>
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
    <br>
    <div class="form-group" style="width:350px" >
            <label for="name">SEARCH</label>
        <input id="myName" class="form-control" type="text" placeholder="Search..." >
        </div>
    
    
   <div id="print">
    <div class="table-responsive">
        
    <table id="pay" class="table table-bordered" cellspacing="0" width="100%">
        
      <thead class="thead-dark">
        <tr bgcolor="#338cbf" style="color:#fff">
          
          <th style="width:10px;">ID</th>         
          <th>SYSTEM NAME</th>
          <th>ADMIN NAME</th>
          <th>SYSTEM TYPE</th>
          <th>SYSTEM NICKNAME</th>          
          <th>SYSTEM MOBILE</th>
          <th style="width:80px;">ACTION
          </th>
        </tr>
      </thead>
      <tbody id="myTable">
          
        <?php
          if (isset($system_data)) {
            
          
         foreach($system_data as $res){
          $status=$res->system_status; ?>
          <tr>
                                        <td><?php echo $res->system_id;?></td>
                                        <td><?php echo $res->system_fullname ?></td>
                                        <td><?php echo $res->system_name;?></td>
                                        <td><?php echo $res->system_name; ?></td>
                                       <td><?php echo $res->system_created_at;?></td>
                                       <td>
                                           <?php 
                                       if($status==1)
                                       {
                                           echo "Active";
                                       }
                                       else 
                                       {
                                           echo "Not Active";
                                       }
                                       ?></td>
                                       <td>
  
                  <button type="button" class="btn btn-success" onclick="edit_system(<?php echo $res->system_id; ?>)" data-toggle="tooltip" data-placement="bottom" title="Edit Sub Center" ><i class="glyphicon glyphicon-pencil"></i></button>
                  <!--<button type="button" class="btn btn-info" onclick="view_system(<?php echo $res->system_id; ?>)" data-toggle="tooltip" data-placement="bottom" title="View Sub Center"><i class="glyphicon glyphicon-eye-open"></i></button>-->
                  <button type="button" class="btn btn-danger" onclick="delete_system(<?php echo $res->system_id;?>)" data-toggle="tooltip" data-placement="bottom" title="Delete Sub Center" ><i class="glyphicon glyphicon-trash"></i></button>


                </td>
              </tr>
             <?php }}?>



      </tbody>

    </table>
    </div>
        </div>
      
    
</section>
</form>
    
    
    
  </div>

  <script src="<?php echo base_url('assets/js/validation1.js'); ?>" type="text/javascript"></script>
    <script type="text/javascript">
  $(document).ready( function () {          
               
      $('#pay').DataTable();
           
  } );
    var save_method; //for save method string
    var table;

     
     



 
$("#myName").on("keyup", function() {
    var value = $(this).val().toLowerCase();
    $("#myTable tr").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
  });
    
    
    function add_system()
    {
       
      save_method = 'add';
      $('#form')[0].reset(); // reset form on modals
      $('#modal_form').modal('show'); // show bootstrap modal
      $('.modal-title').text('Add System'); // Set Title to Bootstrap modal title 
       $("#text_field1_error").html("");
        $("#text_field2_error").html("");
        $("#select1_error").html("");
    }

    function edit_system(id)
    {
          $("#text_field1_error").html("");
        $("#text_field2_error").html("");
        $("#select1_error").html("");
        
      save_method = 'update';
     $('#form')[0].reset(); // reset form on modals

      //Ajax Load data from ajax
      $.ajax({
        url : "<?php echo site_url('index.php/admin/System/ajax_edit/')?>/" + id,        
        type: "GET",
               
        dataType: "JSON",
        success: function(data)
        {        
//                     $("#append_city").remove();
             $('[name="system_id"]').val(data.system_id);
            $('[name="system_id"]').val(data.system_id);
            $('[name="fullname"]').val(data.system_fullname);
            $('[name="system_name"]').val(data.system_name);
            $('[name="status"]').val(data.system_status);
                  
                                  
                     
            $('#modal_form').modal('show'); // show bootstrap modal when complete loaded
            $('.modal-title').text('Edit Sub Center'); // Set title to Bootstrap modal title
            

        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error get data from ajax 1');
        }
    });
    }
    
    function view_system(id)
    {
      save_method = 'update';
     $('#form')[0].reset(); // reset form on modals

      //Ajax Load data from ajax
      $.ajax({
        url : "<?php echo site_url('index.php/admin/System/ajax_edit/')?>/" + id,        
        type: "GET",
               
        dataType: "JSON",
        success: function(data)
        {          
            $('#sfname').html(data.system_fullname);
            $('#ssystem_name').html(data.system_name); 
            $('#created_at').html(data.system_created_at);
           
            $('#modal_form2').modal('show'); // show bootstrap modal when complete loaded
            $('.modal-title').text('Sub Center Data'); // Set title to Bootstrap modal title

        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error get data from ajax 1');
        }
    });
    }





    function save()
    {
        var val=system_validation();
        if(val)
        {
        var data = new FormData(document.getElementById("form"));

      var url;
      if(save_method == 'add')
      {
        url = "<?php echo site_url('index.php/admin/System/system_add')?>";
      }
      else
      {
        url = "<?php echo site_url('index.php/admin/System/system_update')?>";
      }

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
              if(json.error)  
              {
              $("#text_field2_error").html(json.error);
              }else
              {
                   $('#modal_form').modal('hide');
              location.reload();// for reload a page
              }
            
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error adding / update data in student');
            }
        });
    }
    }

    function delete_system(id)
    {
      if(confirm('Are you sure delete this data?'))
      {
        // ajax delete data from database
          $.ajax({
            url : "<?php echo site_url('index.php/admin/System/system_delete')?>/"+id,
            type: "POST",
            //dataType: "JSON",
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


        //select all checkboxes
    $("#select_all").change(function(){  //"select all" change 
        var status = this.checked; // "select all" checked status
        $('.checkbox').each(function(){ //iterate all listed checkbox items
            this.checked = status; //change ".checkbox" checked status
        });
    });

    $('.checkbox').change(function(){ //".checkbox" change 
        //uncheck "select all", if one of the listed checkbox item is unchecked
        if(this.checked == false){ //if this item is unchecked
            $("#select_all")[0].checked = false; //change "select all" checked status to false
        }
        
        //check "select all" if all checkbox items are checked
        if ($('.checkbox:checked').length == $('.checkbox').length ){ 
            $("#select_all")[0].checked = true; //change "select all" checked status to true
        }
    });
    
 
    
     
  </script>
  
  
  <!-- Bootstrap modal -->
  <div class="modal fade" id="modal_form2" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header" style="color:#fff; background-color:#338cbf">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
       <system> <h3 class="modal-title"></h3></system>
      </div>
         <form action="#" name="form_student" id="form2" class="form-horizontal">
      <div class="modal-body form">
       
           <div class="box-body">
          
               <div class="row">
                   <div class="col-md-5 col-md-offset-1"> 
                <label for="pincode">Name :</label><span id="sfname"></span>
                   </div>           
                   <div class="col-md-5">                                   
                    <label for="pincode">Sub-Center Name :</label><span id="ssystem_name"></span>
                     </div>
               </div>
              <br>
              
               <div class="row">
                   <div class="col-md-5 col-md-offset-1">                                    
                   <label for="pincode">Created At :</label><span id="created_at"></span>                                 
                   </div>
                                 
               </div>
           
              
               </div><!-- /.box-body -->
    
        
          </div>

          </form>
        </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
    </div>
  
  
  


  <!-- Bootstrap modal -->
  <div class="modal fade" id="modal_form" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header" style="color:#fff; background-color:#338cbf">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <system><h3 class="modal-title"></h3></system>
      </div>
        <form action="#" name="form_student" id="form" class="form-horizontal">
      <div class="modal-body form">
          <input type="hidden" value="" name="system_id"/>
         
          <div class="box-body">
               
                            <div class="row">
                                <div class="col-md-5 ">                                
                                    
                                     <div class="form-group">
                                        <label for="lname">Admin Name</label>
                                        <select name="user_id" id="system_id" class="form-control required" required>
                                             <option value="">--Select User--</option>  
                                            <?php 
                                            foreach($user_data as $user)
                                            { 
                                              if ($user->system_status==1)
                                                  {                                                
                                              echo '<option value="'.$user->user_id.'">'.$system->system_name.'</option>';
                                            }
                                            }
                                            ?>
                                        </select>
                                     <span id="select1_error" style="color:red"></span>

                                    </div>
                                </div>
                                </div>

                                <div class="row">
                                  <div class="col-md-5">
                                                                 
                                    <div class="form-group">
                                        <label for="fname">Name</label>
                                        <input type="text" class="form-control required" name="system_name" maxlength="128"   style="text-transform:uppercase" required>
                                    </div>
                                    <span id="sname_error" style="color:red"></span>
                                </div>
                                    <div class="col-md-5 col-md-offset-1">
                                                                 
                                    <div class="form-group">
                                        <label for="fname">Type</label>
                                        <input type="text" class="form-control required" name="system_type" maxlength="128" required>
                                    </div>
                                    <span id="text_field1_error" style="color:red"></span>
                                </div>
                            </div>   
              
              <div claass="row">
                  <div class="form-group">
                       <label for="fname">Description</label>
                 <textarea class="form-control required" name="system_desc" maxlength="128"   style="text-transform:uppercase" required></textarea>
                      </div>
                  </div>
              
               <div claass="row">
                   <div class="col-md-5">
                  <div class="form-group">
                       <label for="fname">Nick Name</label>
                 <input type="text" class="form-control required" name="system_nick" maxlength="128" required>
                  </div>    
                  </div>
                    <div class="col-md-5 col-md-offset-1">
                  <div class="form-group">
                       <label for="fname">Email</label>
                 <input type="text" class="form-control required" name="system_email" maxlength="128" required>
                  </div>    
                  </div>
                  </div>
              
               <div claass="row">
                   <div class="col-md-5">
                  <div class="form-group">
                       <label for="fname">Another Email</label>
                 <input type="text" class="form-control required" placeholder="Email2 (optional)"  name="system_email2" maxlength="128" required>
                  </div>    
                  </div>
                    <div class="col-md-5 col-md-offset-1">
                  <div class="form-group">
                       <label for="fname">Website</label>
                 <input type="text" class="form-control required" name="system_site" maxlength="128" required>
                  </div>    
                  </div>
                  </div>
              
               <div claass="row">
                   <div class="col-md-5">
                  <div class="form-group">
                       <label for="fname">Phone</label>
                 <input type="text" class="form-control required" placeholder=""  name="system_ph" maxlength="128" required>
                  </div>    
                  </div>
                    <div class="col-md-5 col-md-offset-1">
                  <div class="form-group">
                       <label for="fname">Mobile</label>
                       <input type="text" class="form-control required" placeholder="" name="system_mob" maxlength="128" required>
                  </div>    
                  </div>
                  </div>
              
           
                   <div claass="row">
                  <div class="form-group">
                       <label for="fname">Address</label>
                 <textarea class="form-control required" name="system_addr" maxlength="128"  required></textarea>
                      </div>
                  </div>
             
              
               <div claass="row">
                   <div class="col-md-5">
                  <div class="form-group">
                       <label for="fname">City</label>
                 <input type="text" class="form-control required" placeholder=""  name="system_city" maxlength="128" required>
                  </div>    
                  </div>
                    <div class="col-md-5 col-md-offset-1">
                  <div class="form-group">
                       <label for="fname">Pincode</label>
                       <input type="text" class="form-control required" placeholder="" name="system_pin" maxlength="128" required>
                  </div>    
                  </div>
                  </div>
              <div claass="row">
                   <div class="col-md-5">
                  <div class="form-group">
                       <label for="fname">Payment Gateway</label>
                 <input type="text" class="form-control required" placeholder=""  name="system_pay_gateway" maxlength="128" required>
                  </div>    
                  </div>
                    <div class="col-md-5 col-md-offset-1">
                  <div class="form-group">
                       <label for="fname">Merchant Id</label>
                       <input type="text" class="form-control required" placeholder="" name="system_merch_id" maxlength="128" required>
                  </div>    
                  </div>
                  </div>
              
              
                          <div class="row">
                              <div class="col-md-5  ">
                                    <div class="form-group">
                                        <label for="lname">Merchant Name</label>
                                        <input type="text" class="form-control required email"  name="system_merch_name" maxlength="128"  style="text-transform:uppercase" required>
                                    </div>
                           <span id="text_field2_error" style="color:red"></span>

                                </div>
                                <div class="col-md-5 col-md-offset-1 ">                                
                                    <div class="form-group">
                                        <label for="fname">Status</label>
                                        <select class="form-control" name="status">
                                            <option value="1">Active</option>
                                            <option value="0">Not Active</option>
                                        </select>
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

<!-- for Payment view -->



</aside>


