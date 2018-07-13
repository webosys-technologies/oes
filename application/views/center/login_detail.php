


<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <i class="fa fa-users"></i><strong> Login Management </strong>
        <small>View <?php  ?></small>
      </h1>
      <ol class="breadcrumb" >
        <li><a href="<?php echo base_url(); ?>center/Dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
        <li >Login Management</li>
      </ol>
    </section><br>
    <form id="table" name="table" action="<?php echo base_url(); ?>center/Orders/selected_mem" method="post">
    <section class="content-header">
    <div class="row">
    <div class="col-md-4">
    <button type="button" class="btn btn-danger" id="print" ><i class="glyphicon glyphicon-print"></i> Print</button>

    </div>
    
        <div class="col-md-6">
         <?php
        $this->load->helper('form');
        $error = $this->session->flashdata('error');
        if($error)
        {
            ?>
            <div class="alert alert-danger alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <?php echo $error; ?>                    
            </div>
        <?php }?>
        </div>
    </div>
    <br/>

    <div class="form-group" style="width:350px" >
            <label for="name">SEARCH</label>
        <input id="myName" class="form-control" type="text" placeholder="Search..." >
        </div>
           
    
    <div class="table-responsive">
     <table id="pay" class="table table-bordered" cellspacing="0" width="100%">
      <thead class="thead-dark">
        <tr bgcolor="#338cbf" style="color:#fff">
          <th width=5%>SELECT <input type="checkbox" id="select_all"/> ALL</th>
          <th>ID</th>
          <th width="150px">STUDENT NAME</th>
          <th>COURSE</th>
          <th width="80px">ADMISSION MONTH</th>
          <th>ADMISSION DATE</th>
          <th width="120px">COURSE START DATE</th>
          <th>USERNAME</th>
          <th>PASSWORD</th>
          <th width="12%">EXAM PASSCODE</th>
          <th width="100px">ACTION</th>

         </tr>
      </thead>
      <tbody id="myTable">
          
        <?php
          if (isset($student_data)) {

            
          
         foreach($student_data as $res){
          $status=$res->student_status; ?>
             <tr <?php if($status == 1) { ?>  >
                            <td><input class="checkbox"  type="checkbox" name="cba[]"  value="<?php echo $res->student_id; ?>" </td>
                                        <td><?php echo $res->student_id;?></td>
                                        <td><?php echo $res->student_fname.' '. $res->student_lname; ?></td>
                                        <td><?php echo $res->course_name;?></td>
                                        <td><?php echo $res->student_admission_month;?></td>
                                        <td><?php echo $res->student_admission_date; ?></td>
                                       <td><?php echo $res->student_course_start_date;?></td>
                                       <td><?php echo $res->student_username;?></td>
                                       <td><?php echo $res->student_password;?></td>
                                       <td><?php echo $res->student_exam_passcode; ?></td>
                                       <td> 
    <button type="button" class="btn btn-warning" onclick="create_passcode(<?php echo $res->student_id;?>)" <?php if(!empty($res->student_exam_passcode) && ($res->student_exam_passcode!="-") ) { ?> disabled  <?php    } ?> ><i class="glyphicon glyphicon-plus"></i> Create Passcode</button>
                                       </td>
             <?php } ?>                         
             </tr>
             <?php }}?>



      </tbody>

    </table>
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

     
  function printData()
{
   var divToPrint=document.getElementById("pay");
   newWin= window.open("");
   var htmlToPrint = '' +
        '<style type="text/css">' +
        'table th, table td {' +
        'border:0.5px solid #000;' +
        'padding:0.5em;' +
        '}' +
        '</style>';

    htmlToPrint += divToPrint.outerHTML;
   newWin.document.write("<style> td:nth-child(1){display:none;} </style>");
   newWin.document.write("<style> th:nth-child(1){display:none;} </style>");

   newWin.document.write("<style> td:nth-child(11){display:none;} </style>");
   newWin.document.write("<style> th:nth-child(11){display:none;} </style>");


   newWin.document.write(htmlToPrint);
   newWin.print();
   newWin.close();
}

$('#print').on('click',function(){
printData();
})

function create_passcode(id)
{

  $.ajax({
        url : "<?php echo site_url('index.php/center/Login_detail/create_passcode')?>/" + id,        
        type: "POST",
               
        dataType: "JSON",
        success: function(data)
        {
          location.reload();
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
          alert('Error while creating passcode');
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


