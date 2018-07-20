<script src="<?php echo base_url();?>assets/js/center_form_validation.js" type="text/javascript"></script>
<style type="text/css">

  .modal fade{
    display: block !important;
}

.modal-dialog{
  width: 600px;
      overflow-y: initial !important
}

.modal-body{
  height: 170px;
  /*overflow-y: auto;*/
}
#pay{
  overflow-x: auto;
}
#box{
    /*padding:100px,0px;*/
    width:100px;
    height:100px;
    background-color:lightgrey;
    text-align:center;
   
}
p{
    padding:30px 0px;
}
#img{
    display:none;
}
</style>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <i class="fa fa-users"></i><strong>Student Management</strong>
        <small>Add, Edit, Delete <?php  ?></small>
      </h1>
      <ol class="breadcrumb" >
        <li><a href="<?php echo base_url(); ?>center/Dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
        <li >Manage Sub Center</li>
      </ol>
    </section><br>
    <form id="table" name="table" action="<?php echo base_url(); ?>center/Orders/selected_mem" method="post">
    <section class="content-header">
    <div class="row">
    <div class="col-md-4">
    <button type="button" class="btn btn-primary" onclick="add_sub_center()"><i class="glyphicon glyphicon-plus"></i> Add Sub Center</button>
      </div>
        <div class="col-md-6">
         <?php
        $this->load->helper('form');
        $error = $this->session->flashdata('error');
        if($error)
        {
            ?>
            <script>
                alert("<?php echo $error; ?> ");
             </script>
            
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
          
          <th>ID</th>
         
          <th>NAME</th>
          <th>SUB CENTER NAME</th>
          <th>CREATED AT</th>
          <th>STATUS</th>

          <th style="width:100px;">ACTION
          </th>
        </tr>
      </thead>
      <tbody id="myTable">
          
        <?php
          if (isset($sub_center_data)) {
            
          
         foreach($sub_center_data as $res){
          $status=$res->sub_center_status; ?>
          <tr>
                                        <td><?php echo $res->sub_center_id;?></td>
                                        <td><?php echo $res->sub_center_fullname ?></td>
                                        <td><?php echo $res->sub_center_name; ?></td>
                                       <td><?php echo $res->sub_center_created_at;?></td>
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
  
                  <button type="button" class="btn btn-success" onclick="edit_sub_center(<?php echo $res->sub_center_id; ?>)" data-toggle="tooltip" data-placement="bottom" title="Edit Sub Center" ><i class="glyphicon glyphicon-pencil"></i></button>
                  <!--<button type="button" class="btn btn-info" onclick="view_sub_center(<?php echo $res->sub_center_id; ?>)" data-toggle="tooltip" data-placement="bottom" title="View Sub Center"><i class="glyphicon glyphicon-eye-open"></i></button>-->
                  <!-- <button type="button" class="btn btn-danger" onclick="(<?php echo $res->sub_center_id;?>)" data-toggle="tooltip" data-placement="bottom" title="Delete Sub Center" ><i class="glyphicon glyphicon-trash"></i></button> -->


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
    
    
    function add_sub_center()
    {
      save_method = 'add';
      $('#form')[0].reset(); // reset form on modals
      $('#modal_form').modal('show'); // show bootstrap modal
      $('.modal-title').text('Add Sub Center'); // Set Title to Bootstrap modal title
      $(".err").html("");
    }

    function edit_sub_center(id)
    {
        $(".err").html("");
      save_method = 'update';
     $('#form')[0].reset(); // reset form on modals

      //Ajax Load data from ajax
      $.ajax({
        url : "<?php echo site_url('index.php/center/Sub_center/ajax_edit/')?>/" + id,        
        type: "GET",
               
        dataType: "JSON",
        success: function(data)
        {        
//                     $("#append_city").remove();
          
            $('[name="sub_center_id"]').val(data.sub_center_id);
            $('[name="fullname"]').val(data.sub_center_fullname);
            $('[name="sub_center_name"]').val(data.sub_center_name);
            $('[name="status"]').val(data.sub_center_status);
                  
                                  
                     
            $('#modal_form').modal('show'); // show bootstrap modal when complete loaded
            $('.modal-title').text('Edit Sub Center'); // Set title to Bootstrap modal title
            

        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error get data from ajax 1');
        }
    });
    }
    
    function view_sub_center(id)
    {
      save_method = 'update';
     $('#form')[0].reset(); // reset form on modals

      //Ajax Load data from ajax
      $.ajax({
        url : "<?php echo site_url('index.php/center/Sub_center/ajax_edit/')?>/" + id,        
        type: "GET",
               
        dataType: "JSON",
        success: function(data)
        {          
            $('#sfname').html(data.sub_center_fullname);
            $('#scenter_name').html(data.sub_center_name); 
            $('#created_at').html(data.sub_center_created_at);
           
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
        var val=centers_sub_center_validation();
        if(val)
        {
            $("#btnSave").attr("disabled",true);
        var data = new FormData(document.getElementById("form"));

      var url;
      if(save_method == 'add')
      {
        url = "<?php echo site_url('index.php/center/Sub_center/sub_center_add')?>";
      }
      else
      {
        url = "<?php echo site_url('index.php/center/Sub_center/sub_center_update')?>";
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
              if(json.status)
              {
               $('#modal_form').modal('hide');
              location.reload();// for reload a page
               }else{
                    $("#btnSave").attr("disabled",false);
               }
            
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error adding / update data in student');
            }
        });
        }
    }

    function delete_sub_center(id)
    {
        $("#delete_sub_center").attr('onclick','delete_menu('+id+')');
     $("#delete_modal").modal('show');
     
    }

    function delete_menu(id)
    {
        // ajax delete data from database
          $.ajax({
            url : "<?php echo site_url('index.php/center/Sub_center/sub_center_delete')?>/"+id,
            type: "POST",
            //dataType: "JSON",
            success: function(data)
            {
                alert("Deleted successfully");  
               location.reload();
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error deleting data');
            }
        });

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
       <center> <h3 class="modal-title"></h3></center>
      </div>
         <form action="#" name="form_student" id="form2" class="form-horizontal">
      <div class="modal-body form">
       
          <input type="hidden" value="" name="student_id"/>
          <input type="hidden" value="" name="center_id"/>

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
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header" style="color:#fff; background-color:#338cbf">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <center><h3 class="modal-title"></h3></center>
      </div>
        <form action="#" name="form_student" id="form" class="form-horizontal">
      <div class="modal-body form">
          <input type="hidden" value="" name="sub_center_id"/>
         
          <div class="box-body">
               
                            <div class="row">
                                <div class="col-md-5 ">                                
                                    <div class="form-group">
                                        <label for="fname">Full Name</label>
                                        <input type="text" class="form-control required" id="fullname" name="fullname" maxlength="128" required>
                                        <span id="fullname_err" class="err" style="color:red;"></span>
                                    </div>
                                    
                                </div>
                                <div class="col-md-5 col-md-offset-1 ">
                                    <div class="form-group">
                                        <label for="lname">Sub Center Name</label>
                                        <input type="text" class="form-control required email" id="sub_center_name"  name="sub_center_name" maxlength="128" required>
                                        <span id="sub_center_name_err" class="err" style="color:red;"></span>
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
            <button type="button" id="btnSave" onclick="save()"  class="btn btn-success">Save</button>
            <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
          </div>
                       
          </form>
        </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
  <!-- End Bootstrap modal -->

<!-- for Payment view -->

  <div class="modal fade" id="delete_modal" style=""  tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div style="background:#3c8dbc;" class="modal-header">
          
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <center><h4 style="color:white" class="modal-title" style="" id="myModalLabel"><strong>Delete Sub center</strong></h4></center>
      </div>
      <div  style="background:#F2F3F4" style="" class="modal-body">
          <div class="row">
              <div class="col-md-10 col-md-offset-2">
                  <label style="color:black">Are you sure want to delete this Sub Center ?</label> <br>
                  <button class="btn btn-default" id="delete_sub_center">Yes</button>
                  <button class="btn btn-default" data-dismiss="modal">No</button>
          
                  </div>              
                 </div>
      </div>
     
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->