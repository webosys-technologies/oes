
<style type="text/css">
    
 .modal fade{
    display: block !important;
}
.modal-dialog{
  width: 700px;
      overflow-y: initial !important
}
.modal-body{
  height: 500px;
  overflow-y: auto;
}
</style>

<div class="content-wrapper">
	<section class="content-header">
      <h1>
        <i class="fa fa-upload"></i><strong>Question</strong>
        <small>Control panel</small>
        </h1>
      <ol class="breadcrumb" >
        <li><a href="<?php echo base_url(); ?>admin/Dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Question</li>
      </ol>
    </section>
    <br>
    <section class="content">

        <button class="btn btn-primary" onclick="add()" data-toggle="tooltip" data-placement="bottom" title="Add Question"><i class="glyphicon glyphicon-plus"></i> Add Question</button>
    <br />
    <br />
    <div class="form-group" style="width:350px" >
            <label for="name">SEARCH</label>
        <input id="myName" class="form-control" type="text" placeholder="Search..." >
        </div>
    <div class="table-responsive">
    <table id="table_id" class="table table-striped table-bordered" cellspacing="0" width="100%">
      <thead bgcolor="#338cbf" style="color:#fff">
        <tr>
                    <th>ID</th>
                    <th>COURSE NAME</th>
                    <th>QUESTION</th>
                    <th>OPTION A</th>
                    <th>OPTION B</th>
                    <th>OPTION C</th>
                    <th>OPTION D</th>
                    <th>ANSWER</th>
                    <th>STATUS</th>

          <th style="width:125px;">ACTION
          </p></th>
        </tr>
      </thead>
      <tbody id="myTable">
                <?php if (isset($question)) {
                    //print_r($question);
                    
                                foreach($question as $ques){?>
                     <tr>
                                        <td><?php echo $ques->question_id;?></td>
                                        <td><?php echo $ques->course_name;?></td>
                                        <td><?php echo $ques->question_name;?></td>
                                        <td><?php echo $ques->question_option_a;?></td>
                                        <td><?php echo $ques->question_option_b;?></td>
                                        <td><?php echo $ques->question_option_c;?></td>
                                        <td><?php echo $ques->question_option_d;?></td>
                                        <td><?php echo $ques->question_correct_ans; ?></td>
                                       <td>
                                           <?php 
                                       if($ques->question_status==1)
                                       {
                                           echo "Active";
                                       }
                                       else 
                                       {
                                           echo "Not Active";
                                       }
                                       ?></td>
                                       <td>
                                    <button class="btn btn-success" onclick="edit_ques(<?php echo $ques->question_id;?>)" data-toggle="tooltip" data-placement="bottom" title="Edit Question" ><i class="glyphicon glyphicon-pencil" ></i></button>
                                    <button class="btn btn-danger" onclick="delete_ques(<?php echo $ques->question_id;?>)" data-toggle="tooltip" data-placement="bottom" title="Delete Question"><i class="glyphicon glyphicon-remove"></i></button>


                                </td>
                      </tr>
                     <?php } }?>



      </tbody>

    </table>
    </div>
    
    
        </section>
</div>

<script>

 
$("#myName").on("keyup", function() {
    var value = $(this).val().toLowerCase();
    $("#myTable tr").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
  });
    
        $(document).ready(function(){
            var i = 1;
            $('#add').click(function(){
                i++;
                $('#dynamic_field').append('<tr id="row'+i+'"><td class="col-md-11"><div class="form-group"><label class="control-label col-md-3">      Courses<span class="req">*</span></label><div class="col-md-7"><select name="course_id[]" class="form-control"><?php 
                                foreach($courses as $row){echo '<option value="'.$row->course_id.'">'.$row->course_name.'</option>';
                                }?></select></div></div><br><br><div class="form-group"><label class="control-label col-md-3">        Question<span class="req">*</span></label><div class="col-md-9"><input type="text" required class="form-control" name="question[]"/></div></div><br><br><div class="form-group"><label class="control-label col-md-3">     Option A<span class="req">*</span></label><div class="col-md-9"><input type="text"required class="form-control" name="option_a[]"/></div></div><br><br><div class="form-group"><label class="control-label col-md-3">             Option B<span class="req">*</span></label><div class="col-md-9"><input type="text"required class="form-control" name="option_b[]"/></div></div><br><br><div class="form-group"><label class="control-label col-md-3">             Option C<span class="req">*</span></label><div class="col-md-9"><input type="text"required class="form-control" name="option_c[]"/></div></div><br><br><div class="form-group"><label class="control-label col-md-3">             Option D<span class="req">*</span></label><div class="col-md-9"><input type="text"required class="form-control" name="option_d[]"/></div></div><br><br><div class="form-group"><label class="control-label col-md-3">             Answer<span class="req">*</span></label><div class="col-md-9"><input type="text"required class="form-control" name="answer[]"/></div></div><br><br><div class="form-group"><label class="control-label col-md-3">Status<span style="color:red">*</span></label><div class="col-md-9"><select name="status[]" class="form-control"><option value="1">Active</option><option value="0">Not Active</option></select></div></div><br><br></td></td><td class="col-md-1"><button name="remove" id="'+i+'" class="btn btn-danger btn_remove">X</button></td></tr>');
            });

            $(document).on('click','.btn_remove', function(){
                var button_id = $(this).attr("id");
                $("#row"+button_id+"").remove();
            });

            
        });


        $(document).ready( function () {
      $('#table_id').DataTable();   
 
    }); 

        function add()
    {
      save_method = 'add';
      $('#form')[0].reset(); // reset form on modals
      $('#add_form').modal('show'); // show bootstrap modal
      $('.modal-title').text('Add Question'); // Set Title to Bootstrap modal title
    }

    function edit_ques(id)
    {
      save_method = 'update';
      $('#form2')[0].reset(); // reset form on modals

      //Ajax Load data from ajax
      $.ajax({
        url : "<?php echo site_url('index.php/admin/Question/ajax_edit/')?>/" + id,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {
            
            $('[name="id"]').val(data.question_id);
            $('[name="question"]').val(data.question_name);
            $('[name="course_id"]').val(data.course_id);
            $('[name="option_a"]').val(data.question_option_a);
            $('[name="option_b"]').val(data.question_option_b);
            $('[name="option_c"]').val(data.question_option_c);
            $('[name="option_d"]').val(data.question_option_d);
            $('[name="answer"]').val(data.question_correct_ans);
            $('[name="status"]').val(data.question_status);
            
            $('#edit_form').modal('show'); // show bootstrap modal when complete loaded
            $('.modal-title').text('Edit Question'); // Set title to Bootstrap modal title

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
      if(save_method == 'add')
      {
          url = "<?php echo site_url('index.php/admin/Question/question_add')?>";          
          var data = new FormData(document.getElementById("form"));
      }
      else
      {
        url = "<?php echo site_url('index.php/admin/Question/question_update')?>";        
        var data = new FormData(document.getElementById("form2"));
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
            success: function(data)
            {
              alert("Data Updated successfully..!!");
               //if success close modal and reload ajax table
               $('#add_form').modal('hide');
              location.reload();// for reload a page
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error adding / update data');
            }
        });
    }

    function delete_ques(id)
    {
      if(confirm('Are you sure delete this data?'))
      {
        // ajax delete data from database
          $.ajax({
            url : "<?php echo site_url('index.php/admin/Question/delete_ques')?>/"+id,
            type: "POST",
            dataType: "JSON",
            success: function(data)
            {
               alert("Question deleted successfully.");  
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
  <div class="modal fade" id="add_form" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header" style="color:#fff; background-color:#338cbf" >
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
       <center> <h3 class="modal-title">Topics Form</h3></center>
       
      </div>
      <div class="modal-body form">
        <form id="form" method="" action="">
            <table class="table" id="dynamic_field">
                <tr >
                    <td class="col-md-8">
                        <!--div class="top-row"-->
                        <div class="form-group">
                            <label class="control-label col-md-3">
                                Course<span class="req">*</span>
                            </label>
                            <div class="col-md-7">
                            <select name="course_id[]" class="form-control">
                                <?php 
                                foreach($courses as $row)
                                { 
                                  echo '<option value="'.$row->course_id.'">'.$row->course_name.'</option>';
                                }
                                ?>
                            </select>
                            </div>
                        </div><br><br>
                        

                        <div class="form-group">
                            <label class="control-label col-md-3">Question<span class="req">*</span></label>
                            <div class="col-md-9">
                                <textarea name="question[]" class="form-control"></textarea>
                            </div>
                        </div><br><br><br>

                        <div class="form-group">
                            <label class="control-label col-md-3">Option A</label>
                            <div class="col-md-9">
                            <input type="text"required class="form-control" name="option_a[]"/>
                            </div>
                        </div><br><br>

                        <div class="form-group">
                            <label class="control-label col-md-3">Option B</label>
                            <div class="col-md-9">
                            <input type="text"required class="form-control" name="option_b[]"/>
                            </div>
                        </div><br><br>

                        <div class="form-group">
                            <label class="control-label col-md-3">Option C</label>
                            <div class="col-md-9">
                            <input type="text"required class="form-control" name="option_c[]"/>
                            </div>
                        </div><br><br>
                        <div class="form-group">
                            <label class="control-label col-md-3">Option D<span class="req">*</span></label>
                            <div class="col-md-9">
                            <input type="text"required class="form-control" name="option_d[]"/>
                            </div>
                        </div><br><br>
                        <div class="form-group">
                            <label class="control-label col-md-3">Answer<span class="req">*</span></label>
                            <div class="col-md-9">
                            <input type="text"required class="form-control" name="answer[]"/>
                            </div>
                        </div>
                        <br><br>
                        <div class="form-group">
                          <label class="control-label col-md-3">Status<span style="color:red">*</span></label>
                          <div class="col-md-9">
                              <select name="status[]" class="form-control">
                                  <option value="1">Active</option>
                                  <option value="0">Not Active</option>
                              </select>
                          </div>
                        </div><br><br>

                    </td>
                </tr>
            </table>
          </form>
      
           
          <div class="modal-footer">
              <button type="button" name="add" id="add" class="btn btn-success">Add More</button>
            <button type="button" id="btnSave" onclick="save()" class="btn btn-primary">Save</button>
            <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
              
          </div>
        </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
  <!-- End Bootstrap modal --></div>
  
  
     
         
      

     <!-- Bootstrap modal -->
  <div class="modal fade" id="edit_form" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header" style="color:#fff; background-color:#338cbf">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
       <center> <h3 class="modal-title">Edit Question</h3> </center>
       
      </div>
      <div class="modal-body form">
        <form id="form2" method="POST" action="">
            
                      <input type="hidden" name="id">
                        <div class="form-group">
                            <label class="control-label col-md-3">
                                Course<span style="color:red">*</span>
                            </label>
                            <div class="col-md-7">
                            <select name="course_id" class="form-control">
                                <?php 
                                foreach($courses as $row)
                                { 
                                  echo '<option value="'.$row->course_id.'">'.$row->course_name.'</option>';
                                }
                                ?>
                            </select>
                            </div>
                        </div><br><br><br>
                        

                        <div class="form-group">
                            <label class="control-label col-md-3">Question<span style="color:red">*</span></label>
                            <div class="col-md-9">
                                <textarea name="question" class="form-control"></textarea>
                            </div>
                        </div><br><br><br>

                        <div class="form-group">
                            <label class="control-label col-md-3">Option A<span style="color:red">*</span></label>
                            <div class="col-md-9">
                            <input type="text" required class="form-control" name="option_a"/>
                            </div>
                        </div><br><br>

                        <div class="form-group">
                            <label class="control-label col-md-3">Option B<span style="color:red">*</span></label>
                            <div class="col-md-9">
                            <input type="text" required class="form-control" name="option_b"/>
                            </div>
                        </div><br><br>

                        <div class="form-group">
                            <label class="control-label col-md-3">Option C<span style="color:red">*</span></label>
                            <div class="col-md-9">
                            <input type="text" required class="form-control" name="option_c"/>
                            </div>
                        </div><br><br>
                        <div class="form-group">
                            <label class="control-label col-md-3">Option D<span style="color:red">*</span></label>
                            <div class="col-md-9">
                            <input type="text" required class="form-control" name="option_d"/>
                            </div>
                        </div><br><br>
                        <div class="form-group">
                            <label class="control-label col-md-3">Answer<span style="color:red">*</span></label>
                            <div class="col-md-9">
                            <input type="text" required class="form-control" name="answer"/>
                            </div>
                        </div><br><br>
                         <div class="form-group">
                          <label class="control-label col-md-3">Status<span style="color:red">*</span></label>
                          <div class="col-md-9">
                              <select name="status" class="form-control" required>
                                  <option value="1">Active</option>
                                  <option value="0">Not Active</option>
                              </select>
                          </div>
                        </div><br><br>
                    
          </form>
      
           
          <div class="modal-footer">
              
            <button type="button" id="btnSave" onclick="save()" class="btn btn-primary">Save</button>
            <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
            

          </div>
        </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
  <!-- End Bootstrap modal -->
</div>