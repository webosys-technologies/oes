
<style type="text/css">

  .modal fade{
    display: block !important;
}
.modal-dialog{
  width: 1000px;
  /*overflow-x: !important;*/
}
.modal-body{
  max-height: 450px ;
  overflow-y: auto;
}
input[type='search']
{
  border-radius: 0.3em;
  padding: 0.3em;
  border-style: ridge;
  border-width: 0.1em ;
}
        
        .hr1 {
    display: block;
    height: 1px;
/*    border: 0;
    border-top: 1px solid #ccc;
    margin: 1em 0;*/
    padding: 0; 
}

  .hr2 {
    display: block;
    height: 1px;
     /*width:30%;*/
     
/*    border: 0;
    border-top: 1px solid #ccc;
    margin: 1em 0;*/
    padding: 0; 
}


.address{
    line-height:0.5cm; 
    font-size:15px;
    word-spacing:normal;
    /*font-weight:bold;*/
    text-size:0.2cm;
}
.tab_data{
    line-height:0.6cm; 
    font-size:12px;
    color:#2E86C1;
    word-spacing:normal;
    text-size:0.2cm;
}
        
    .invoice-box {
        max-width: 900px;
        margin: auto;
        padding: 15px;
        border: 1px solid #eee;
        box-shadow: 0 0 10px rgba(0, 0, 0, .15);
        font-size: 16px;
        line-height: 24px;
        font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
        color: #555;
    }
</style>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <i class="fa fa-upload"></i><strong> ORDERS </strong>
        <small>Control panel</small>
        </h1>
      <ol class="breadcrumb" >
        <li><a href="<?php echo base_url(); ?>center/Dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Orders</li>
      </ol>
    </section>

    <form id="table" name="table" action="<?php echo base_url(); ?>center/Orders/payment" method="post">
    <section class="content-header">
    
    <br />
    <div class="form-group" style="width:350px" >
            <label for="name">SEARCH</label>
        <input id="myName" class="form-control" type="text" placeholder="Search..." >
        </div>
    
    <div class="table-responsive">
    <table id="table_id" class="table table-bordered" cellspacing="0" width="100%">
      <thead >
        <tr bgcolor="#338cbf" style="color:#fff" >
          <th>ID</th>
          <th width="10%">DATE</th>          
          <th width=15%><center>NO. OF Accounts</center></th>
          <th>PAYMENT FOR</th>
          <th>AMOUNT</th>
          <th>GST</th>
          <th>DISCOUNT</th>
          <th>PAYABLE AMOUNT</th>
          <th>STATUS</th>
          <th width="10%">ACTION</th>

        </tr>
      </thead>
      <tbody id="myTable" >
        <?php
          if (isset($orders)) {
            
          
         foreach($orders as $res){
          $status=$res->order_status; ?>
             <tr <?php if($status == 'success') { ?> style="background-color:#61F48B; "  <?php }elseif ($status == 'pending') { ?> class="bg-warning"
             <?php }else{?> style="background-color:#ec5858 "  <?php } ?> >
                            <td><?php echo $res->order_id;?></td>
                                        <td><?php echo $res->order_date ;?></td>
                                       <td><?php echo $res->acc_qty;?></td>
                                       <td><?php echo $res->order_name ;?></td>
                                       <td><?php echo $res->order_amount ;?></td>
                                       <td><?php echo $res->order_gst ; ?></td>
                                       <td><?php echo $res->order_discount ;?></td>
                                        <td><?php echo $res->order_payable_amount;?></td>                                       
                                       <td><?php echo $res->order_status;?></td>
                                       <td>      
             <button type="button" class="btn btn-info"  onclick="order_details(<?php echo $res->order_id; ?>)" data-toggle="tooltip" data-placement="bottom" title="View Order"><i class="glyphicon glyphicon-eye-open"></i></button>
             <button type="button" class="btn btn-danger"  onclick="print_invoice(<?php echo $res->order_id; ?>)" data-toggle="tooltip" data-placement="bottom" title="Print Invoice"><i class="glyphicon glyphicon-print"></i></button>
                                       </td>
                                      
              </tr>
             <?php }}?>



      </tbody>

      
    </table>
    </div>
    </section>
</form>
  </div>


  <script type="text/javascript">
  $(document).ready( function () {
     $('#table_id').DataTable({
         'order':[[0,'desc']]
     });
  } );

   $("#myName").on("keyup", function() {
    var value = $(this).val().toLowerCase();
    $("#myTable tr").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
  });
  
  
   $('#print').on('click',function(){
        printRecord();
        });

          function printRecord()
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



           newWin.document.write(htmlToPrint);
           newWin.print();
           newWin.close();
        }


  function order_details(id)
    {
      save_method = 'update';
     $('#form')[0].reset(); // reset form on modals
       //         $('#record').reset();      

      //Ajax Load data from ajax
      $.ajax({
        url : "<?php echo site_url('index.php/center/Orders/ajax_edit/')?>/" + id,        
        type: "GET",
//        data: "{}",
        contentType: "application/json; charset=utf-8",               
        dataType: "JSON",
        success: function(data)
        {  

        $('#record').html(" ");
        var sum=0;

        $.each(data, function (i, row) {


            $('#record').append('<tr><td>'+row.order_detail_id+'</td><td>'+row.student_fname +' '+ row.student_lname+'</td><td>'+row.course_name+'</td><td>'+row.od_course_fees+'</td><td>'+row.od_book_price+'</td><td>'+row.od_total_amount+'</td><td>'+row.order_detail_status+'</td></tr>');
             sum=sum+parseInt(row.od_total_amount);

             $('[name="sum"]').val(sum);
             $('#total_amount').html(row.order_amount);
             $('#discount').html(row.order_discount);
             $('#gst').html(row.order_gst);
             $('#payable_amount').html(row.order_payable_amount);
                          

       });
        

        //     $('#modal_form').append();
            $('#modal_form').modal('show'); // show bootstrap modal when complete loaded
            $('.modal-title').text('Orders Details'); // Set title to Bootstrap modal title

        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error get data from ajax 1');
        }
    });
    }
    
    
    
      $('#print_in').on('click',function(){
        printData();
        });

          function printData()
        {
           var divToPrint=document.getElementById("invoice");
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

function print_invoice(id)
{

//Ajax Load data from ajax
      $.ajax({
        url : "<?php echo site_url('index.php/center/Orders/invoice_details/')?>/" + id,        
        type: "GET",
//        data: "{}",
        contentType: "application/json; charset=utf-8",               
        dataType: "JSON",
        success: function(data)
        {  
          // alert(data.order_discount);
        $('#data').html(" ");
        $('#total').html(" ");

         var sum=0;
          var no = 0;
          var dis=0;
          var payin =0;
          var status= "";
        $.each(data, function (i, row) {
          no=no+1;    

          // alert(no);
        $('#order_id').html(row.order_id);
        $('#order_date').html(row.order_date);
        $('#center_name').html(row.center_name);
        $('#center_mobile').html(row.center_mobile);
        $('#center_email').html(row.center_email);
        $('#center_address').html(row.center_address);
        $('#center_city').html(row.center_city);
        $('#center_pincode').html(row.center_pincode);
        $('#center_state').html(row.center_state);





            $('#data').append('<tr><td>'+no+'</td><td>'+row.student_fname +' '+ row.student_lname+'</td><td>'+1+'</td><td>'+row.course_name+'</td><td>'+row.od_course_fees+'</td><td>'+0+'</td><td>'+row.od_course_fees+'</td></tr>');

            if (row.book_name != "No Book") {
                      no=no+1;                  
              // alert('book');

            $('#data').append('<tr><td>'+no+'</td><td>'+row.book_name +'</td><td>'+1+'</td><td>'+row.course_name+'</td><td>'+row.od_book_price+'</td><td>'+0+'</td><td>'+row.od_book_price+'</td></tr>');

              sum=sum+parseInt(row.od_book_price);

            }

             sum=sum+parseInt(row.od_course_fees);
             dis=row.order_discount;
             payin =row.order_payable_amount;
             status=row.order_status;

            //  $('[name="sum"]').val(sum);

       });


            $('#total').append('<tr><td>'+ " "+'</td><td>'+"TOTAL" +'</td><td>'+no+'</td><td>'+ " "+'</td><td>'+sum+'</td><td>'+ 0 +'</td><td>'+sum+'</td></tr>');

        $('#itotal_amount').html(sum);
        $('#idiscount').html(dis);
        $('#ipayable_amount').html(payin);
           // alert(status);

        if (status =='success')
         {
        $('#order_status').html('Paid');
        $('#order_status').css({'color':'green','font-weight':'bold'});

         }else{

        $('#order_status').html('Unpaid');
        $('#order_status').css('color','red');


         }


          

        //     $('#modal_form').append();
            $('#modal_form2').modal('show'); // show bootstrap modal when complete loaded
            $('.modal-title').text('INVOICE'); // Set title to Bootstrap modal title

        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error get data from ajax 1');
        }
    });
}
     

  </script>



  <div class="modal fade" id="modal_form" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header" style="color:#fff; background-color:#338cbf">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <center><h3 class="modal-title">admission Details</h3></center>
      </div>
      <div class="modal-body form">
        <form action="#" name="form_student" id="form" class="form-horizontal">
           <div class="table-responsive">
    <table id="pay" class="table table-bordered" cellspacing="0" width="100%">
      <thead class="thead-dark">
        <tr bgcolor="#338cbf" style="color:#fff">
          <th>ORDER DETAILS ID</th>
          <th width="150px">STUDENT NAME</th>
          <th>COURSE</th>
          <th>COURSE AMOUNT 
          / REEXAM FEES</th>
          <th>BOOK PRICE</th>
          <th>TOTAL</th>
          <th>PAYMENT STATUS</th>

        </tr>
      </thead>
      <tbody id="record" >
        

      </tbody>

    </table>
    </div>
    <div id="ajax-content-container">
      
    </div>
         <row>
        <div class="col-md-6 col-sm-6 col-xs-12">

        </div>
        <!--Section Left end-->
        
        <!--Section right start-->
        
        <div class="col-md-6 col-sm-6 col-xs-12">
            <div class="row">
                <div class="col-md-3 col-sm-3 col-xs-12"></div>  
                 <div class="col-md-3 col-sm-3 col-xs-12">Total Amount</div>  
                 <div class="col-md-3 col-sm-3 col-xs-12"><span id="total_amount"></span></div>

            </div>
            
            <div class="row">
                <div class="col-md-3 col-sm-3 col-xs-12"></div>  
                 <div class="col-md-3 col-sm-3 col-xs-12">GST</div>  
                 <div class="col-md-3 col-sm-3 col-xs-12"><span id="gst"></span></div>

            </div>
            
            <div class="row">
                <div class="col-md-3 col-sm-3 col-xs-12"></div>  
                 <div class="col-md-3 col-sm-3 col-xs-12"> Offer Discount</div>  
                 <div class="col-md-3 col-sm-3 col-xs-12"><span id="discount"></span></div>
            </div>
                      
            <div class="row">
                <div class="col-md-3 col-sm-3 col-xs-12"></div>  
                <div class="col-md-3 col-sm-3 col-xs-12" style="border-top:1px solid #DBD8D7; "> <label style="margin-top: 10px;" class="form-label">Net Payable Amount</label></div>  
                 <div class="col-md-3 col-sm-3 col-xs-12" style="border-top:1px solid #DBD8D7;">
                     <div style="margin-top: 10px;">
                         <label><span id="payable_amount"></span></label>
                    </div>
                 </div>
            </div>
            
            <div class="row">
                &nbsp;
            </div>
            
            
            
        </div>
    </row>
   
          
          <div class="modal-footer">
            <button type="button" class="btn btn-warning" id="print">Print</button>
            <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
          </div>
          </form>
        </div>
        </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
    
    


    <div class="modal fade" id="modal_form2" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header" style="color:#fff; background-color:#338cbf">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <center><h3 class="modal-title">INVOICE</h3></center>
            <button type="button" class="btn btn-warning " id="print_in">Print</button>
         
      </div>
      <div class="modal-body form">
        
          <div id="invoice"> 
        <div class="row">
            <div class="col-xs-6">
                                <img src="<?php echo base_url();?>profile_pic/Capture.PNG" style="width:70%; max-width:210px;">
            </div>
            <div class="col-xs-6" align="right">
                                <h4>ORIGINAL INVOICE</h4>
                                <h4>Order No <span id="order_id"></span></h4>
                                <label>Date</label>&nbsp;<span id="order_date">12 April,2018</span><br/>
                                
            </div>            
            </div> 
            <center><h3 id="order_status" style="font-weight: bold"></h3></center>
            
             <hr class="hr1" color="#2E86C1"> 
             <div class="row">
            <div class="col-xs-8">
                <h4 style="color:#2E86C1;"><i><b>DELTO</b></i></h4>
                <div class="address"><label class="glyphicon glyphicon-home"></label> &nbsp;E1/1, State Bank Nagar,Behind Vanaz Co.,<br>
                               &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Paud RoadKothrud,<br>
                               &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Pune,PIN Code 411038, Maharashtra ,India<br>
                               <label class="glyphicon glyphicon-phone-alt"></label> &nbsp;9822280896<br>
                               &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;info@delto.in<br>
                               <i class="glyphicon glyphicon-globe"></i> &nbsp; http://delto.in<br>
                               
                               </div>
            </div>
            <div class="col-xs-4" align="left"><h4 style="color:#2E86C1;"><i><b>Bill To :</b></i></h4>
                               <div class="address">&nbsp;&nbsp;&nbsp;&nbsp;<b id="center_name">ACUMEN PACKAGING PRIVATE LIMITED</b><br>
                                                    
                                                    <p class="glyphicon glyphicon-home" ></p>&nbsp;<label>Address:</label>&nbsp;<span id="center_address"></span><br>
                                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span id="center_city"></span>-<span id="center_pincode"></span>,<span id="center_state"></span>.<br>
                                                   &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<label>Email:</label><Span id="center_email"></Span><br>
                                                    <P class="glyphicon glyphicon-phone-alt"></P>&nbsp;<label>Mobile:</label>&nbsp;<span id="center_mobile"></span><br>
                                                    
                               </div>
            </div>            
            </div><br>
            <div class="table-responsive">
                <table class="table table-condensed" width="100%">
                    <thead  class="" >
                        <tr>
                            <th>NO</th>
                            <th width="35%">PRODUCT NAME</th>
                            <th>QTY</th>
                            <th>COURSE</th>                            
                            <th>FEES / REEXAM</th>
                            <th>GST</th>
                            <th>AMOUNT</th>
                            
                        </tr>
                    </thead>
                    <tfoot id="total">
                        
                    </tfoot>
                    <tbody id="data">                                              
                        
                    </tbody>
                </table>
                </div>
            <div class="row">
                <div class="col-md-1 col-sm-1  ">
<!--                    <label style="color:#2E86C1;">AUTHORISED SIGNATURE</label><br><br>
                    <hr class="hr2" align="left" width="40%" color="#2E86C1">-->
                </div>
            <div class="col-md-7 col-sm-7 col-md-offset-4  "><br><br>
               
                <div class="row">
                <div class="col-md-3 col-sm-3 col-xs-12"></div>  
                 <div class="col-md-3 col-sm-3 col-xs-12">Total Amount</div>
                 <div class="col-md-3 col-sm-3 col-xs-12"><span id="itotal_amount"></span></div>

            </div>
            
            
            <div class="row">
                <div class="col-md-3 col-sm-3 col-xs-12"></div>  
                 <div class="col-md-3 col-sm-3 col-xs-12"> Offer Discount</div>  
                 <div class="col-md-3 col-sm-3 col-xs-12"><span id="idiscount"></span></div>
            </div>
                      
            <div class="row">
                <div class="col-md-3 col-sm-3 col-xs-12"></div>  
                <div class="col-md-3 col-sm-3 col-xs-12" style="border-top:1px solid #DBD8D7; "> <label style="margin-top: 10px;" class="form-label">Net Payable Amount</label></div>  
                 <div class="col-md-3 col-sm-3 col-xs-12" style="border-top:1px solid #DBD8D7;">
                     <div style="margin-top: 10px;">
                         <label><span id="ipayable_amount"></span></label>
                    </div>
                 </div>
            </div>
           
            
            
               </div>         
            
    </div><br>
            <div style="color:#2E86C1; text-size:7px; ">NOTE :</div>
            
    </div>
           
          
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-warning" id="print_in">Print</button>
            <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
          </div>
        </div>

        </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->     

    </div><!-- /.modal -->

