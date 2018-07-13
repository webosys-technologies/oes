
<style type="text/css">

    .radio-green [type="radio"]:checked+label:after {
    border-color: #00C851;
    background-color: #00C851;
}
/*Gap*/

.radio-green-gap [type="radio"].with-gap:checked+label:before {
    border-color: #00C851;
}

.radio-green-gap [type="radio"]:checked+label:after {
    border-color: #00C851;
    background-color: #00C851;
}                
    
    
    
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
        <i class="fa fa-users"></i><strong> Setting</strong>
        <small>Ask for password <?php  ?></small>
      </h1>
      <ol class="breadcrumb" >
        <li><a href="<?php echo base_url(); ?>center/Dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
        <li >Manage Setting</li>
      </ol>
    </section><br>
    
   
    
    <section class="content">        
        <div class="row">           
            <div class="col-md-6">
                <div class="form-check radio-green">
                <label>Ask Center Password for Student Login</label>  <br>
               <input type="radio" name="same"  id="ask_password_enable" class="form-check-input" value="enable"> <label class="form-check-label">Enable</label><br>
                <input type="radio" name="same" id="ask_password_disable"  class="form-check-input" value="disable"> <label class="form-check-label">Disable</label>
            </div>
                 </div>
        </div>    
    </section>
    
    
  </div>

  <script src="<?php echo base_url('assets/js/validation1.js'); ?>" type="text/javascript"></script>



  <script type="text/javascript">
  $(document).ready( function () { 
      
      
      
       <?php
    if(isset($data))
    {
        foreach($data as $res)
        {
           $ask_val=$res->center_askfor_password; 
        }
        ?>
          
               if("<?php echo $ask_val;?>"=='enable')
               {
                   
                   $("#ask_password_enable").prop('checked',true);
               }
                if("<?php echo $ask_val;?>"=='disable')
               {                   
                   $("#ask_password_disable").prop('checked',true);
               }
                  <?php
    }
    ?>
      
 
      
         $("#ask_password_disable").click(function(){
            save($("#ask_password_disable").val());
    
                      });
                      
            $("#ask_password_enable").click(function(){
                
                 save($("#ask_password_enable").val());
            });
      
      $('#pay').DataTable();
           
  } );
    var save_method; //for save method string
    var table;
    var ask_value;

     
 





    
        function save(ask_value)
    {
     
       
       // ajax adding data to database
          $.ajax({
            url : "<?php echo site_url('index.php/center/Setting/center_askfor_password')?>/"+ask_value,
            type: "GET",
            dataType: "JSON",
            success: function(data)
            {
              
                    alert('Center password for student login is '+ data.ch_val +' ...!'); 
               
               $('#modal_form').modal('hide');
              location.reload();// for reload a page
             
            
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error adding / update data in center');
            }
        });
    } 
 
    
     
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
                                        <input type="text" class="form-control required" id="fullname" name="fullname" maxlength="128"   style="text-transform:uppercase" required>
                                    </div>
                                    
                                </div>
                                <div class="col-md-5 col-md-offset-1 ">
                                    <div class="form-group">
                                        <label for="lname">Sub Center Name</label>
                                        <input type="text" class="form-control required email" id="sub_center_name"  name="sub_center_name" maxlength="128"  style="text-transform:uppercase" required>
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



</aside>


