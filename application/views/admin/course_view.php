 <!DOCTYPE html>
<html>

  <body>


  <div class="content-wrapper">
      <section class="content-header">
      <h1><strong> Courses </strong>
        <small>Control panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url(); ?>admin/Dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Courses</li>
      </ol>
    </section>
      <section class="content">
        <br><br>
        <div class="row">
             <div class="col-md-4">
    <button class="btn btn-primary" onclick="add_course()" data-toggle="tooltip" data-placement="bottom" title="Add Course"><i class="glyphicon glyphicon-plus"></i> Add Course</button>
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
					<th>NAME</th>
					<th>DURATION</th>
					<th>FEES</th>
          <th width="12%">REEXAM FEES</th>
					<th>CREATED AT</th>
          <th>CREATED BY</th>
          <th>STATUS</th>

          <th style="width:125px;">ACTION
          </p></th>
        </tr>
      </thead>
      <tbody id="myTable">
				<?php foreach($courses as $course){?>
				     <tr>
                                        <td><?php echo $course->course_id;?></td>
                                        <td><?php echo $course->course_name;?></td>
                                        <td><?php echo $course->course_duration.' '.'Month' ;?></td>
                                       <td><?php echo $course->course_fees;?></td>
                                       <td><?php echo $course->course_reexam_fees;?></td>
                                       <td><?php echo $course->course_created_at;?></td>
                                       <td><?php echo $course->course_created_by;?></td>
                                       <td>
                                           <?php 
                                       if($course->course_status==1)
                                       {
                                           echo "Active";
                                       }
                                       else 
                                       {
                                           echo "Not Active";
                                       }
                                       ?></td>
                                       <td>
									<button class="btn btn-success" onclick="edit_course(<?php echo $course->course_id;?>)" data-toggle="tooltip" data-placement="bottom" title="Edit Course"><i class="glyphicon glyphicon-pencil"></i></button>
									<button class="btn btn-danger" onclick="delete_course(<?php echo $course->course_id;?>)" data-toggle="tooltip" data-placement="bottom" title="Delete Course"><i class="glyphicon glyphicon-remove"></i></button>


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

    function add_course()
    {
      save_method = 'add';
      $('#form')[0].reset(); // reset form on modals
      $('#modal_form').modal('show'); // show bootstrap modal
      $('.modal-title').text('Add Course'); // Set Title to Bootstrap modal title
      
       $("#course_name_error").html("");
              $("#duration_error").html("");
              $("#fees_error").html("");
               $("#reexam_error").html("");
    }

    function edit_course(id)
    {
         $("#course_name_error").html("");
              $("#duration_error").html("");
              $("#fees_error").html("");
               $("#reexam_error").html("");
        
      save_method = 'update';
      $('#form')[0].reset(); // reset form on modals

      //Ajax Load data from ajax
      $.ajax({
        url : "<?php echo site_url('index.php/admin/Courses/ajax_edit/')?>/" + id,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {

            $('[name="id"]').val(data.course_id);
            $('[name="name"]').val(data.course_name);
            $('[name="duration"]').val(data.course_duration);
            $('[name="fees"]').val(data.course_fees);
            $('[name="reexam_fees"]').val(data.course_reexam_fees);
            $('[name="status"]').val(data.course_status);
            
            $('#modal_form').modal('show'); // show bootstrap modal when complete loaded
            $('.modal-title').text('Edit Course'); // Set title to Bootstrap modal title

        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error get data from ajax 1');
        }
    });
    }
    
       function form_validation()
        {
          if ($("#name").val() == ""){
            $("#course_name_error").html("Please Enter Course Name");
          }else{
              var name="true";
              $("#course_name_error").html("");
          }
         
          if ($("#duration").val() == ""){
            $("#duration_error").html("Please Enter Duration");
//         return false;
          }else{
              var duration="true";
              $("#duration_error").html("");
          }
          
          if ($("#fees").val() == ""){
             $("#fees_error").html("Please Enter Fees");
//         return false;
          }else{
                 var fees="true";         
                   $("#fees_error").html("");
          }
          
          if ($("#reexam_fees").val() == ""){
             $("#reexam_error").html("Please Enter Reexam Fees");
//         return false;
          }else{
                 var reexam_fees="true";         
                   $("#reexam_error").html("");
          }
          
          if(name=="true" && reexam_fees=="true" && duration=="true" && fees=="true")
          {
             return true;
        }else{
            return false;
        }
        }
        

    function save()
    {
        
        var val=form_validation();
        if(val)
        {
      var url;
      if(save_method == 'add')
      {
          url = "<?php echo site_url('index.php/admin/Courses/course_add')?>";
      }
      else
      {
        url = "<?php echo site_url('index.php/admin/Courses/course_update')?>";
      }

       // ajax adding data to database
          $.ajax({
            url : url,
            type: "POST",
            data: $('#form').serialize(),
            dataType: "JSON",
            success: function(data)
            {
               //if success close modal and reload ajax table
               $('#modal_form').modal('hide');
            location.reload();// for reload a page
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error adding / update data');
            }
        });
        }
    }

    function delete_course(id)
    {
      if(confirm('Are you sure delete this data?'))
      {
        // ajax delete data from database
          $.ajax({
            url : "<?php echo site_url('index.php/admin/Courses/course_delete')?>/"+id,
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

  </script>

  <!-- Bootstrap modal -->
  <div class="modal fade" id="modal_form" role="dialog">
  <div class="modal-dialog" id="modal_dialog">
    <div class="modal-content">
      <div class="modal-header" style="color:#fff; background-color:#338cbf">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
       <center> <h3 class="modal-title">Course Form</h3></center> 
      </div>
      <div class="modal-body form">
        <form action="#" name="form_course" id="form" class="form-horizontal">
          <input type="hidden" value="" name="id"/>
          <div class="form-body">
            <div class="form-group">
              <label class="control-label col-md-3">Course Name</label>
              <div class="col-md-9">
                <input name="name" id="name" placeholder="name" class="form-control" type="text">
                <span id="course_name_error" style="color:red"></span>
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-md-3">Duration</label>
              <div class="col-md-9">
                <input name="duration" id="duration" placeholder="duration" class="form-control" type="number">
                <span id="duration_error" style="color:red"></span>
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-md-3">Fees</label>
              <div class="col-md-9">
                <input name="fees" placeholder="fees" id="fees" class="form-control" type="text">
                <span id="fees_error" style="color:red"></span>
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-md-3">Reexam Fees</label>
              <div class="col-md-9">
                <input name="reexam_fees" id="reexam_fees" placeholder="fees" class="form-control" type="text">
                <span id="reexam_error"style="color:red"></span>
              </div>
            </div>
              <div class="form-group">
              <label class="control-label col-md-3">Status</label>
              <div class="col-md-9">
                  <select name="status" class="form-control">
                      <option value="1">Active</option>
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



