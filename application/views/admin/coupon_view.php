
</style>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <i class="fa fa-users"></i><strong> Coupons Management</strong>
        <small>Add, Edit, Delete <?php  ?></small>
      </h1>
      <ol class="breadcrumb" >
        <li><a href="<?php echo base_url(); ?>center/Dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
        <li >Manage Coupon</li>
      </ol>
    </section><br>
    <form id="table" name="table" action="" method="post">
    <section class="content-header">
    <div class="row">
    <div class="col-md-4">
    <button type="button" class="btn btn-primary" onclick="add_coupon()"><i class="glyphicon glyphicon-plus"></i> Add Coupon</button>
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
        <div class="alert alert-danger alert-dismissible" data-auto-dismiss="5000">
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
          <th>CENTER NAME</th>
          <th>COUPON CODE</th>
          <th>PERCENTAGE</th>
          <th>MIN STUDENT </th>
          <th>LIMIT</th>
          <th style="width:80px;">VALID FROM</th>
          <th style="width:80px;">VALID TO</th>
          <th style="width:80px;">STATUS</th>

          <th style="width:80px;">ACTION
          </th>
        </tr>
      </thead>
      <tbody id="myTable">
          
        <?php
          if (isset($coupons)) {
            
          
         foreach($coupons as $res){
          $status=$res->coupon_status; ?>
          <tr>                         
                                        <td><?php echo $res->coupon_id;?></td>
                                         <td><?php if(empty($res->center_name)){echo "All Centers";}else{echo $res->center_name;}?></td>
                                        <td><?php echo $res->coupon_code; ?></td>
                                        <td><?php echo $res->coupon_percentage;?></td>
                                        <td><?php echo $res->coupon_min_student;?></td>
                                        <td><?php echo $res->coupon_limit; ?></td>
                                       <td><?php echo $res->coupon_valid_from;?></td>
                                       <td><?php echo $res->coupon_valid_to;?></td>
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
  
                  <button type="button" class="btn btn-success" onclick="edit_coupon(<?php echo $res->coupon_id; ?>)" data-toggle="tooltip" data-placement="bottom" title="Edit Coupon" ><i class="glyphicon glyphicon-pencil"></i></button>
                  <!--<button type="button" class="btn btn-info" onclick="view_coupon(<?php echo $res->coupon_id; ?>)" data-toggle="tooltip" data-placement="bottom" title="View Sub Center"><i class="glyphicon glyphicon-eye-open"></i></button>-->
                  <button type="button" class="btn btn-danger" onclick="delete_coupon(<?php echo $res->coupon_id;?>)" data-toggle="tooltip" data-placement="bottom" title="Delete Coupon" ><i class="glyphicon glyphicon-trash"></i></button>


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
    
    
    function add_coupon()
    {
      save_method = 'add';
      $('#form')[0].reset(); // reset form on modals
      $('#modal_form').modal('show'); // show bootstrap modal
      $('.modal-title').text('Add Coupon'); // Set Title to Bootstrap modal title  
       $("#center_name_error").html("");
       $("#perc_error").html("");            
       $("#valid_from_error").html("");
       $("#valid_to_error").html("");
       $("#limit_error").html("");
       $("#stud_limit_error").html("");
       $("#code_error").html("");
    }

    function edit_coupon(id)
    {
      save_method = 'update';
       $('#form')[0].reset(); // reset form on modals
       $("#center_name_error").html("");
       $("#perc_error").html("");            
       $("#valid_from_error").html("");
       $("#stud_limit_error").html("");
       $("#valid_to_error").html("");
       $("#limit_error").html("");
       $("#code_error").html("");
       
      //Ajax Load data from ajax
      $.ajax({
        url : "<?php echo site_url('admin/Coupon/ajax_edit/')?>/" + id,        
        type: "GET",
               
        dataType: "JSON",
        success: function(data)
        {      
           
//                     $("#append_city").remove();
             $('[name="center_id"]').val(data.center_id);
            $('[name="coupon_code"]').val(data.coupon_code);
            $('[name="coupon_perc"]').val(data.coupon_percentage);
            $('[name="limit"]').val(data.coupon_limit);
            $('[name="stud_limit"]').val(data.coupon_min_student);
            $('[name="valid_from"]').val(data.coupon_valid_from);
            $('[name="valid_to"]').val(data.coupon_valid_to);
            $('[name="status"]').val(data.coupon_status);
            $('[name="coupon_id"]').val(data.coupon_id);
                  
                                  
                     
            $('#modal_form').modal('show'); // show bootstrap modal when complete loaded
            $('.modal-title').text('Edit Coupon'); // Set title to Bootstrap modal title
            

        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error get data from ajax 1');
        }
    });
    }
    
    function view_coupon(id)
    {
      save_method = 'update';
     $('#form')[0].reset(); // reset form on modals

      //Ajax Load data from ajax
      $.ajax({
        url : "<?php echo site_url('admin/Coupon/ajax_edit/')?>/" + id,        
        type: "GET",
               
        dataType: "JSON",
        success: function(data)
        {          
            $('#sfname').html(data.coupon_id);
            $('#scenter_name').html(data.coupon_name); 
            $('#created_at').html(data.coupon_created_at);
           
            $('#modal_form2').modal('show'); // show bootstrap modal when complete loaded
            $('.modal-title').text('Sub Center Data'); // Set title to Bootstrap modal title

        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error get data from ajax 1');
        }
    });
    }
    
    
     
    function form_validation() {        
        if ($("#center_id").val() == ""){
            $("#center_name_error").html("Please Select Center Name");
          }else{
              var per="true";
              $("#center_name_error").html("");
          }
         
          if ($("#coupon_perc").val() == ""){
            $("#perc_error").html("Please Enter Coupon Percentage");
//         return false;
          }else{
              var per="true";
              $("#perc_error").html("");
          }
          
          if ($("#valid_from").val() == ""){
             $("#valid_from_error").html("Please Enter Valid Date");
//         return false;
          }else{
                 var from="true";         
                   $("#valid_from_error").html("");
          }
          
          if ($("#valid_to").val() == ""){
            $("#valid_to_error").html("Please Enter Valid Date");
//         return false;
          }else{
              var to="true";
              $("#valid_to_error").html("");
          }
          
          if ($("#limit").val() == ""){
             $("#limit_error").html("Please Enter Coupon Limit");
//         return false;
          }else{
             var lim="true";
              $("#limit_error").html("");
          }
          
          
          if ($("#stud_limit").val() == ""){
             $("#stud_limit_error").html("Please Enter Student Limit");
//         return false;
          }else{
             var stud_lim="true";
              $("#stud_limit_error").html("");
          }
          
          if ($("#coupon_code").val() == ""){
            $("#code_error").html("Please Enter Coupon Code");
//         return false;
          }else{
              var code="true";
              $("#code_error").html("");
          }
          
          if(code=="true" && lim=="true" && to=="true" && from=="true" && stud_lim=="true" && per=="true")
          {
             return true;
        }else{
            return false;
        }
    }

    function save()
    {
        var val=form_validation();
        
        if(val==true)
        {   
           $("#btnSave").attr('disabled',true); 
            
        var data = new FormData(document.getElementById("form"));
          var url;
      if(save_method == 'add')
      {
        url = "<?php echo site_url('admin/Coupon/coupon_add')?>";
      }
      else
      {
        url = "<?php echo site_url('admin/Coupon/coupon_update')?>";
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
                 $("#btnSave").attr('disabled',false); 
                  $("#code_error").html(json.error);  
               }else{
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

    function delete_coupon(id)
    {
      if(confirm('Are you sure delete this data?'))
      {
        // ajax delete data from database
          $.ajax({
            url : "<?php echo site_url('admin/Coupon/coupon_delete')?>/"+id,
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
  <div class="modal-dialog" id="modal_dialog">
    <div class="modal-content">
      <div class="modal-header" style="color:#fff; background-color:#338cbf">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
       <center> <h3 class="modal-title"></h3></center>
      </div>
         <form action="#" name="form_student" id="form2" class="form-horizontal">
      <div class="modal-body form">
       
           <div class="box-body">
          
               <div class="row">
                   <div class="col-md-5 col-md-offset-1"> 
                <label for="pincode">Name :</label><span id="sfname"></span>
                   </div>           
                   <div class="col-md-5">                                   
                    <label for="pincode">Sub-Center Name :</label><span id="scenter_name"></span>
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
  <div class="modal-dialog" id="modal_dialog">
    <div class="modal-content">
      <div class="modal-header" style="color:#fff; background-color:#338cbf">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <center><h3 class="modal-title"></h3></center>
      </div>
        <form action="#" name="form_student" id="form" class="form-horizontal">
      <div class="modal-body form">
          <input type="hidden" value="" name="coupon_id"/>
         
          <div class="box-body">
               
                            <div class="row">
                               
                                <div class="col-md-5">
                                    <div class="form-group">
                                        <label for="lname">Center Name</label>
                                        <select name="center_id" id="center_id" class="form-control required" required>
                                            <option value="">--Select Center--</option> 
                                             <option value="0">All Center</option> 
                                            <?php 
                                            foreach($center_data as $center)
                                            { 
                                              if ($center->center_status==1)
                                                  {                                                
                                              echo '<option value="'.$center->center_id.'">'.$center->center_name.'</option>';
                                            }
                                            }
                                            ?>
                                        </select>
                                        <span style="color:red" id="center_name_error"></span>
                                    </div>
                                </div>
                                <div class="col-md-5 col-md-offset-1  ">
                                    <div class="form-group">
                                        <label for="lname">Coupon Code</label>
                                        <input type="text" placeholder="Coupon Code" class="form-control required email" id="coupon_code"  name="coupon_code" maxlength="128" style="text-transform:uppercase" required>
                                   <span style="color:red" id="code_error"></span>
                                    </div>
                                    
                                </div>
                            </div>   
              
                          <div class="row">
                             
                               <div class="col-md-5">                                
                                    <div class="form-group">
                                        <label for="limit">Coupon Limit</label>
                                        <input type="number" placeholder="Coupon Limit" class="form-control required"  id="limit" name="limit" min="0" maxlength="128"  required>
                                        <span style="color:red" id="limit_error"></span>
                                    </div>                                      
                                </div>
                              
                                <div class="col-md-5 col-md-offset-1">                                
                                    <div class="form-group">
                                        <label for="limit">Min Student </label>
                                        <input type="number" placeholder="Minimum Student Limit" class="form-control required"  id="stud_limit" name="stud_limit" min="0" maxlength="128" required>
                                    <span style="color:red" id="stud_limit_error"></span>
                                    </div>                                   
                                </div>
                              
                          </div>
                             
                             <div class="row">
                             <div class="col-md-5  ">
                                    <div class="form-group">
                                        <label for="lname">Coupon Percentage</label>
                                        <input type="text" placeholder="Coupon Percentage" class="form-control required email" id="coupon_perc"  name="coupon_perc" maxlength="128"  required>
                                   <span style="color:red" id="perc_error"></span>
                                    </div>                                  
                                </div>
                                 </div>
              
                            <div class="row">
                                  <div class="col-md-5 ">                                
                                    <div class="form-group">
                                        <label for="fname">Valid From</label>
                                         <input type="date" class="form-control required" id="valid_from" name="valid_from" maxlength="128"   style="text-transform:uppercase" required>
                                    <span style="color:red" id="valid_from_error"></span>
                                    </div>                                      
                                    </div>
                                 <div class="row">
                                  <div class="col-md-5 col-md-offset-1">                                
                                    <div class="form-group">
                                        <label for="fname">Valid To</label>
                                      <input type="date" class="form-control required" id="valid_to" name="valid_to" maxlength="128"   style="text-transform:uppercase" required>                   
                                     <span style="color:red" id="valid_to_error"></span>
                                    </div>                                      
                                    </div>
                                 </div>
                                 </div>
                              <div class="row">
                                  <div class="col-md-5 ">                                
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
            <button type="button" id="btnSave" onclick="save()" class="btn btn-success">Save</button>
            <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
          </div>
                       
          </form>
        </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
  <!-- End Bootstrap modal -->

<!-- for Payment view -->



</aside>


