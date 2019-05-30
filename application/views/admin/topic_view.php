 <!DOCTYPE html>
<html>

  <body>


  <div class="content-wrapper">
      <section class="content-header">
      <h1><strong> Topics </strong>
        <small>Control panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url(); ?>admin/Dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Topics</li>
      </ol>
    </section>
      <section class="content">
        <br><br>
        <div class="row">
             <div class="col-md-4">
    <button class="btn btn-primary" onclick="add_topic()" data-toggle="tooltip" data-placement="bottom" title="Add Topic"><i class="glyphicon glyphicon-plus"></i> Add Topic</button>
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
    <br />
    <br />
     <div class="form-group" style="width:350px" >
            <label for="name">SEARCH</label>
        <input id="myName" class="form-control" type="text" placeholder="Search..." >
        </div>
    <div class="table-responsive">
    <table id="table_id" class="table table-striped table-bordered" cellspacing="0" width="100%">
      <thead>
        <tr bgcolor="#338cbf" style="color:#fff" >
          <th>ID</th>
          <th>QUESTION ID</th>
          <th>NAME</th>
          <th>DESCRIPTION</th>
          <th>CREATED AT</th>
          <th>CREATED BY</th>
          <th>STATUS</th>

          <th style="width:125px;">ACTION
          </p></th>
        </tr>
      </thead>
      <tbody id="myTable">
        <?php foreach($topics as $topic){?>
             <tr>
                                        <td><?php echo $topic->topic_id;?></td>
                                        <td><?php echo $topic->course_id;?></td>
                                        <td><?php echo $topic->topic_name;?></td>
                                        <td><?php echo $topic->topic_description;?></td>
                                       <!--<td><?php echo $course->course_reexam_fees;?></td>-->
                                       <td><?php echo $topic->topic_created_at;?></td>
                                       <td><?php echo $topic->topic_created_by;?></td>
                                       <td>
                                           <?php 
                                       if($topic->topic_status==1)
                                       {
                                           echo "Active";
                                       }
                                       else 
                                       {
                                           echo "Not Active";
                                       }
                                       ?></td>
                                       <td>
                  <button class="btn btn-success" onclick="edit_topic(<?php echo $topic->topic_id;?>)" data-toggle="tooltip" data-placement="bottom" title="Edit Topic"><i class="glyphicon glyphicon-pencil"></i></button>
                  <button class="btn btn-danger" onclick="delete_topic(<?php echo $topic->topic_id;?>)" data-toggle="tooltip" data-placement="bottom" title="Delete Topic"><i class="glyphicon glyphicon-remove"></i></button>


                </td>
              </tr>
             <?php }?>



      </tbody>

    </table>
        </div>
</section>
  </div>


  <script type="text/javascript">
  $(document).ready( function () {
      $('#table_id').DataTable();
  } );
    var save_method; //for save method string
    var table;

    $("#myName").on("keyup", function() {
    var value = $(this).val().toLowerCase();
    $("#myTable tr").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
  });

    function add_topic()
    {
      save_method = 'add';
      $('#form')[0].reset(); // reset form on modals
      $('#modal_form').modal('show'); // show bootstrap modal
      $('.modal-title').text('Add Topic'); // Set Title to Bootstrap modal title
      
       $("#course_name_error").html("");
              $("#duration_error").html("");
              $("#fees_error").html("");
               $("#reexam_error").html("");
    }

    function edit_topic(id)
    {

         $("#course_name_error").html("");
              $("#duration_error").html("");
              $("#fees_error").html("");
               $("#reexam_error").html("");
        
      save_method = 'update';
      $('#form')[0].reset(); // reset form on modals

      //Ajax Load data from ajax
      $.ajax({
        url : "<?php echo site_url('admin/Topics/ajax_edit/')?>/" + id,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {

          $('[name="id"]').val(data.topic_id);
            $('[name="course_id"]').val(data.course_id);
            $('[name="topic_name"]').val(data.topic_name);
            $('[name="topic_description"]').val(data.topic_description);
            $('[name="status"]').val(data.topic_status);
            
            $('#modal_form').modal('show'); // show bootstrap modal when complete loaded
            $('.modal-title').text('Edit Topic'); // Set title to Bootstrap modal title

        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error get data from ajax 1');
        }
    });
    }
    
       function form_validation()
        {
          if ($("#topic_name").val() == ""){
            $("#topic_name_error").html("Please Enter Topic Name");
          }else{
              var name="true";
              $("#topic_name_error").html("");
          }
         
          if ($("#course_id").val() == ""){
            $("#course_error").html("Please select course");
//         return false;
          }else{
              var course="true";
              $("#course_error").html("");
          }
          
          
          if(name=="true" && course=="true")
          {
             return true;
        }else{
            return false;
        }
        }
        

    function save()
    {
      
        var val=form_validation();
     //   alert(val);
        if(val)
        {
            $("#btnSave").attr("disabled",true);
      var url;
      if(save_method == 'add')
      {
          url = "<?php echo site_url('admin/Topics/topic_add')?>";
      }
      else
      {
        url = "<?php echo site_url('admin/Topics/topic_update')?>";
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
               $('#modal_form').modal('hide');
                location.reload();// for reload a page
               }else{
                   $("#btnSave").attr("disabled",false);
               }
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error adding / update data');
            }
        });
        }
    }

    function delete_topic(id)
    {
         $("#delete_topic").attr('onclick','delete_menu('+id+')');
     $("#delete_modal").modal('show');
      
    }
    
    function delete_menu(id)
    {
        
        // ajax delete data from database
          $.ajax({
            url : "<?php echo site_url('admin/Topics/topic_delete')?>/"+id,
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

  </script>

  <!-- Bootstrap modal -->
  <div class="modal fade" id="modal_form" role="dialog">
  <div class="modal-dialog" id="modal_dialog">
    <div class="modal-content">
      <div class="modal-header" style="color:#fff; background-color:#338cbf">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
       <center> <h3 class="modal-title">Topic Form</h3></center> 
      </div>
      <div class="modal-body form">
        <form action="#" name="form_course" id="form" class="form-horizontal">
          <input type="hidden" value="" name="id"/>
          <div class="form-body">
            <div class="form-group">
              <label class="control-label col-md-3">Course</label>
              <div class="col-md-9"> 
                  <select class="form-control" name="course_id" id="course_id" required>
                      <option value="">--Select Course--</option>
                      <?php $course=$this->Courses_model->getall_courses();
                      {
                          if(isset($course))
                          {
                              foreach ($course as $c)
                              {
                                  echo '<option value="'.$c->course_id.'">'.$c->course_name.'</option>';
                              }
                          }
                      }
                      ?>         
                  </select>
                <!--<input name="duration" id="duration" placeholder="duration" class="form-control" type="number">-->
                <span id="course_error" style="color:red"></span>
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-md-3">Topic Name</label>
              <div class="col-md-9">
                <input name="topic_name" id="topic_name" placeholder="name" class="form-control" type="text">
                <span id="topic_name_error" style="color:red"></span>
              </div>
            </div>
            
            <div class="form-group">
              <label class="control-label col-md-3">Description</label>
              <div class="col-md-9">
                <input name="topic_description" placeholder="Description" id="topic_description" class="form-control" type="text">
                <span id="topic_description_error" style="color:red"></span>
              </div>
            </div>
<!--            <div class="form-group">
              <label class="control-label col-md-3">Reexam Fees</label>
              <div class="col-md-9">
                <input name="reexam_fees" id="reexam_fees" placeholder="fees" class="form-control" type="text">
                <span id="reexam_error"style="color:red"></span>
              </div>
            </div>-->
              <div class="form-group">
              <label class="control-label col-md-3">Status</label>
              <div class="col-md-9">
                  <select name="status" class="form-control">
                      <option selected value="1">Active</option>
                      <option value="0">Not Active</option>
                  </select>
              </div>
            </div>
            
          </div>
        </form>
          </div>
          <div class="modal-footer">
            <button type="button" id="btnSave" onclick="save()" class="btn btn-primary">Save</button>
            <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
          </div>
        </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
  <!-- End Bootstrap modal -->
  
   <div class="modal fade" id="delete_modal" style=""  tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div style="background:#3c8dbc;" class="modal-header">
          
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <center><h4 style="color:white" class="modal-title" style="" id="myModalLabel"><strong>Delete Topic</strong></h4></center>
      </div>
      <div  style="background:#F2F3F4" style="" class="modal-body">
          <div class="row">
              <div class="col-md-10 col-md-offset-2">
                  <label style="color:black">Are you sure you want to delete this Topic ?</label> <br>
                  <button class="btn btn-default" id="delete_topic">Yes</button>
                  <button class="btn btn-default" data-dismiss="modal">No</button>
          
                  </div>              
                 </div>
      </div>
     
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->



