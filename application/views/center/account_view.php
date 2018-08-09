
<style type="text/css">

 
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
        <i class="fa fa-users"></i><strong> Account Management</strong>
        <small>Add, Edit, Delete <?php  ?></small>
      </h1>
      <ol class="breadcrumb" >
        <li><a href="<?php echo base_url(); ?>center/Dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
        <li >Manage Account</li>
      </ol>
    </section><br>
    <form id="table" name="table" action="<?php echo base_url(); ?>center/Orders/selected_mem" method="post">
    <section class="content-header">
    <div class="row">
    <div class="col-md-4">
    <button type="button" class="btn btn-primary" onclick="add_account()"><i class="glyphicon glyphicon-plus"></i> Create Accounts</button>
       <button type="submit" class="btn btn-warning" id="payment"  ><i class="fa fa-inr"></i> Make Payment</button>
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
          <th width=5%>SELECT <input type="checkbox" id="select_all"/> ALL</th>          
          <th>ID</th>
         
          <th>ROLL NO</th>
          <th>COURSE</th>
          <th>VALID FROM</th>
          <th>VALID TO</th>
          <th>DURATION</th>
          <th>FEES</th>
          <th>CREATED AT</th>
          <th>STATUS</th>

          <th width="10%">ACTION</th>
        </tr>
      </thead>
      <tbody id="myTable">
          
        <?php
          if (isset($account_data)) {
            
          
         foreach($account_data as $res){
          $status=$res->acc_status; ?>
             <tr <?php if($status == 1) { ?> style="background-color:#61F48B "  <?php }elseif ($status == 2) { ?> style="background-color:orange; " <?php  }elseif ($status == 3) { ?> style="background-color:#EC7063; " <?php  } ?> > 
                            <td><input  <?php if($status == 0) { ?> class="checkbox" <?php } ?>
                              type="checkbox" name="cba[]"  value="<?php echo $res->acc_id; ?>"
                              <?php if($status == 1 || $status == 2 || $status==3) { ?> disabled <?php } ?> ></td>
                                       <td><?php echo $res->acc_id;?></td>
                                        <td><?php echo $res->acc_no;?></td>
                                        <?php $course=$this->Courses_model->get_by_id($res->course_id);?>
                                        <td><?php echo $course->course_name; ?></td>
                                        <td><?php echo $res->acc_valid_from;?></td>
                                       <td><?php echo $res->acc_valid_to;?></td>
                                       <td>1 year</td>
                                       <td></td>
                                       <td><?php echo $res->acc_created_at; ?></td>
                                       
                                       <td>
                                           <?php 
                                       if($status==1)
                                       {
                                           echo "Active";
                                       }
                                       elseif ($status == 2) {
                                          
                                          echo "Logged In";
                                        }elseif($status == 3)
                                        {
                                           echo "Completed";  
                                        }
                                      else
                                       {
                                           echo "Not Active";
                                       }
                                       ?></td>
                                       <td>
  
                  <!--<button type="button" class="btn btn-success" id="" value="<?php echo $res->acc_id; ?>" onclick="edit_account(<?php echo $res->acc_id; ?>)" data-toggle="tooltip" data-placement="bottom" title="Edit Account" ><i class="glyphicon glyphicon-pencil"></i></button>-->
                  <?php if($status==2){?><button type="button" class="btn btn-info btn-sm" onclick="sign_out(<?php echo $res->acc_id; ?>)" data-toggle="tooltip" data-placement="bottom" title="Sign Out"><i class="fa fa-sign-out" aria-hidden="true"></i></button><?php } ?>
                  <button type="button" class="btn btn-danger btn-sm" onclick="delete_account(<?php echo $res->acc_id;?>)" data-toggle="tooltip" data-placement="bottom" title="Delete Student" <?php if($status!=0){echo "disabled";} ?> ><i class="glyphicon glyphicon-trash"></i></button>


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
  $(document).ready( function (){
      
      
      
      
      
     $('#pay').DataTable({
         'order':[[0,'desc']]
          });           
  });
    var save_method; //for save method string
    var table;

     
     
  function isNumber(evt) {
    evt = (evt) ? evt : window.event;
    var charCode = (evt.which) ? evt.which : evt.keyCode;
    if (charCode > 31 && (charCode < 48 || charCode > 57)) {
        return false;
    }
    return true;
        }   
     
   

 
$("#myName").on("keyup", function() {
    var value = $(this).val().toLowerCase();
    $("#myTable tr").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
  });
    
    
    function add_account()
    {
      save_method = 'add';
      $('#form')[0].reset(); // reset form on modals
      $('#modal_form').modal('show'); // show bootstrap modal
      $('.modal-title').text('Create Account'); // Set Title to Bootstrap modal title
 
      $(".err").html("");
     
    }

       function validation()
       {     var acc;
             var course;
           
           if($("#account").val()=="")
           {
               acc=false;
               $("#account_err").html("Please Enter No of Accounts");
           }else{
               acc=true;
               $("#account_err").html("");
           }
           
           if($("#course").val()=="")
           {
               course=false; 
               $("#course_err").html("Please Select Course");              
           }else{
              course=true;   
              $("#course_err").html("");      
           }
           if(acc==true && course==true)
           {
               return true;
           }else{
               return false;
           }
       }

    
    function save()
    {

         var val=validation()
         if(val)
         {
      var data = new FormData(document.getElementById("form"));

      var url;
      if(save_method == 'add')
      {
        url = "<?php echo site_url('index.php/center/Account/account_add')?>";
      }
      else
      {
        url = "<?php echo site_url('index.php/center/Account/account_update')?>";
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
                
               $('#modal_form').modal('hide');
              location.reload();// for reload a page
             
            
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error adding / update data in student');
            }
        });
    }
    }
    
    function sign_out(id)
    {
         $.ajax({
            url : "<?php echo site_url('index.php/center/Account/sign_out')?>/"+id,
            type: "POST",
            //dataType: "JSON",
            success: function(data)
            {
//                alert("Deleted successfully");  
               location.reload();
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error deleting data');
            }
        });
    }
    
    function delete_account(id)
    {
      if(confirm('Are you sure delete this data?'))
      {
        // ajax delete data from database
          $.ajax({
            url : "<?php echo site_url('index.php/center/Account/account_delete')?>/"+id,
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
    }
    
    function edit_account(id)
    {
        
         $.ajax({
            url : "<?php echo site_url('index.php/center/Account/edit_account')?>/"+id,
            type: "POST",
            //dataType: "JSON",
            success: function(data)
            {
               $("#modal_form").modal('show');
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error deleting data');
            }
        });
        
    }





    $(document).ready(function () {

     $("#course_id").change(function() {


   var el = $(this) ;
              $("#book_id").html("");


var id=el.val();
          if(id>0)
          {
      $.ajax({
       url : "<?php echo site_url('index.php/center/Account/show_book')?>/" + id,        
       type: "GET",
              
       dataType: "JSON",
       success: function(data)
       {
        
          $.each(data,function(i,row)
          {
           
              $("#book_id").append('<option value="'+ row.book_id +'">' + row.book_name + '</option>');
          }
          );
       },
       error: function (jqXHR, textStatus, errorThrown)
       {
         alert('Error...!');
       }
     });
     }
    
 });

   });



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
  <div class="modal fade" id="modal_form" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header" style="color:#fff; background-color:#338cbf">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <center><h3 class="modal-title">Course Form</h3></center>
      </div>
        <form action="#" name="form_student" data-async data-target="#modal_form" id="form" class="form-horizontal">
      <div class="modal-body form">
         
          <div class="box-body">
               <div class="form-group">
              <div class="row">
                  <div class="col-md-12">
                     
                      <label>No Of Account :</label> <span style="color:red">*</span>
                      <input type="text" class="form-control" value="" id="account" maxlength="5" onkeypress="return isNumber(event)" name="account">
                      <span style="color:red" class="err" id="account_err"></span>
                      </div>
                      </div>
                        </div>
                        
             <div class="form-group">
              <div class="row">
                  <div class="col-md-12">
                     
                      <label>Select Course :</label> <span style="color:red">*</span>
                      <select class="form-control" id="course" name="course">
                          <option value="">Select Course</option>
                          <?php $course=$this->Courses_model->getall_courses();
                          foreach($course as $c)
                          {
                              if($c->course_status==1)
                              {
                                  echo '<option value="'.$c->course_id.'">'.$c->course_name.'</option>';
                              }
                          }
                          
                          ?>
                      </select>
                      <span style="color:red" class="err" id="course_err"></span>
                      </div>
                      </div>
                        </div>
    
        
          </div><!-- /.box-body -->
          <div class="modal-footer">
            <button type="button" id="btnSave" onclick="save()"  class="btn btn-success">Generate</button>
            <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
          </div>
          </div>
          </form>
        </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
  

<div class="control-sidebar-bg"></div>

