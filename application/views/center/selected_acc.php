<style type="text/css">

  .modal fade{
    display: block !important;
}

.modal-dialog{
  width: 600px;
      overflow-y: initial !important
}

.modal-body{
  height: 330px;
  overflow-y: auto;
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
.form-control1
{
    
    height: 34px;
    padding: 6px 3px;
    font-size: 13px;
    line-height: 1.42857143;
    color: #555;
    background-color: #fff;
    background-image: none;
    border: 1px solid #ccc;
    border-radius: 4px;
}
</style>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <i class="fa fa-users"></i><strong>Student Management</strong>
        <small>Control Panel</small>
      </h1>
      <ol class="breadcrumb" >
        <li><a href="<?php echo base_url(); ?>center/Dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
        <li >Student Management</li>
      </ol>
    </section><br>
    
    
    <section class="content-header">
    <form id="table" name="table" action="<?php echo base_url(); ?>center/Orders/payment" method="post">
    <a href="<?php echo base_url(); ?>center/Account" class="btn btn-primary" >Previous</a> 
    <div class="row">
    
               <div class="col-md-6 col-md-offset-3">
       
        </div>
    </div>
    <br>
    
    
   <div id="print">
    <div class="table-responsive">
        
    <table id="pay" class="table table-bordered" cellspacing="0" width="100%">
        
      <thead class="thead-dark">
        <tr bgcolor="#338cbf" style="color:#fff">
          
          <th>ID</th>
          <th>Account No</th>
          <th>Course</th>          
          <th>Created At</th>
          <th>Course Fees</th>         
          <th>Total</th>

          <th style="width:125px;">Action
          </th>
        </tr>
      </thead>
      <tbody id="myTable">
          
        <?php
          if (isset($account_data)) {
            
          
         foreach($account_data as $res){
          $status=$res->acc_status; ?>
          <tr id="remove<?php echo $res->acc_id;?>" class="tagWrapper" <?php if($status != 1) { ?> class="bg-danger" <?php } ?> >
                            <td><?php echo $res->acc_id;?></td>
                                        <td><?php echo $res->acc_no; ?></td>
                                        <td><?php echo $res->course_name;?></td>                                       
                                       <td><?php echo $res->acc_created_at;?></td>
                                       <td><?php echo 'RS.'. $res->course_fees; ?></td>
                                      
                                       <td><?php $total=$res->course_fees;
                                       echo $total; ?> </td>

                                       <td>
                  <button type="button" class="btn btn-danger" onclick="remove_field(<?php echo $res->acc_id;?>)"  data-dismiss="" ><i class="glyphicon glyphicon-trash"></i></button>


                </td>
              </tr>
             <?php 
                $sum[]=$total;
                $crs[]=$res->course_fees;

           }}?>
      </tbody>

    </table>
    </div>
        </div>

         <?php 
    $amt=array();
    $sid=array();
    foreach ($account_data as $key) {
      $sid[]=$key->acc_id;
    } 
    $amt=array_sum($sum);
    $account=count($sid);
    $course_amount=array_sum($crs);
        $this->load->helper('form');        
    
        $success = $this->session->flashdata('success');
        $error = $this->session->flashdata('error');


    ?>

    <input type="hidden" name="account"  value="<?php echo $account; ?>">
    <input type="hidden" name="course" value="<?php echo $course_amount ; ?>">
    <div class="row">
        <div class="col-md-6 col-sm-6 col-xs-12">
            <div class="row">&nbsp;</div>
            <div class="row">&nbsp;</div>
            <div class="row">
                <div class="col-md-3 col-sm-3 col-xs-12"></div>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <div class="form-group">
                    <input class="form-control1" type="text" placeholder="Enter Coupen Code" name="coupon_code"  id="coupon_code">
                     <button type="button" name="apply"  id="apply" value="Apply" class="btn btn-info">Apply</button>          
                     </div>
                     <font id="msg"></font>
                </div> 
                <div class="col-md-3 col-sm-3 col-xs-12"></div>
            </div>
            
            <div class="row">
                &nbsp;
            </div>
            
            <div class="row">
                &nbsp;
            </div>
           
       

        </div>
        <!--Section Left end-->
        
        <!--Section right start-->
        
        <div class="col-md-6 col-sm-6 col-xs-12">
            <div class="row">
                <div class="col-md-3 col-sm-3 col-xs-12"></div>  
                 <div class="col-md-3 col-sm-3 col-xs-12">Total Amount</div>  
                 <div class="col-md-3 col-sm-3 col-xs-12"><?php echo "RS.".$amt; ?></div>
                 <input class="form-control" type="hidden" value="<?php echo $amt ; ?>" name="amount" readonly>

            </div>
            
            <div class="row">
                <div class="col-md-3 col-sm-3 col-xs-12"></div>  
                 <div class="col-md-3 col-sm-3 col-xs-12">GST</div>  
                 <div class="col-md-3 col-sm-3 col-xs-12"><?php echo "RS.0"; ?></div>
                 <input class="form-control" type="hidden" value="<?php echo "0"; ?>" name="gst" readonly>
            </div>
            
            <div class="row">
                <div class="col-md-3 col-sm-3 col-xs-12"></div>  
                 <div class="col-md-3 col-sm-3 col-xs-12"> Offer Discount</div>  
                 <div class="col-md-3 col-sm-3 col-xs-12"><span id="discount"><?php  echo "- RS.0"; ?></span>
                 <input class="form-control" type="hidden" value="<?php echo "0"; ?>" name="discount" readonly>
                 </div>
            </div>
                      
            <div class="row">
                <div class="col-md-3 col-sm-3 col-xs-12"></div>  
                <div class="col-md-3 col-sm-3 col-xs-12" style="border-top:1px solid #DBD8D7; "> <label style="margin-top: 10px;" class="form-label">Net Payable Amount</label></div>  
                 <div class="col-md-3 col-sm-3 col-xs-12" style="border-top:1px solid #DBD8D7;">
                     <div style="margin-top: 10px;">
                         <label><span id="payable_amount"><?php echo "RS.".$amt; ?></span></label>
                        <input class="form-control" type="hidden" name="payable_amount" value="<?php echo $amt; ?>" readonly>
                    </div>
                 </div>
            </div>
            
            <div class="row">
                &nbsp;
            </div>
            
            
            <div class="row">
                <div class="col-md-3 col-sm-3 col-xs-12"></div>  
                <div class="col-md-3 col-sm-3 col-xs-12"> <button type="submit" class="btn btn-warning" id="payment"  ><i class="glyphicon glyphicon-plus"></i>Proceed to Payment</button></div>  
                 <div class="col-md-3 col-sm-3 col-xs-12"></div>
            </div>
            
        </div>
    </div>
   </form>
        
        <br>
</section>

    
    
    
  </div>




  <script type="text/javascript">
  $(document).ready( function () {   

  $('#apply').click(function(){
      
    
     var textboxvalue = $('input[name=coupon_code]').val();
     var amount = $('input[name=course]').val();
     var account = $('input[name=account]').val();
     var total_amount = $('input[name=amount]').val();

        $.ajax(
        {
            type: "POST",
            url: '<?php echo site_url('index.php/center/Orders/get_coupon')?>',
            data: {txt1: textboxvalue,amt: amount,std: account},
            dataType : "JSON",
            success: function(data)
            {
               
      
              if(data.msg)
              {
                $("#msg").html(data.msg);
                $("#msg").attr('color','red');

              }else{
              var amt = total_amount-data.discount;             

             $('#discount').html('-RS.'+data.discount);
            $('#payable_amount').html('RS.'+amt);
            $('[name="discount"]').val(data.discount);
            $('[name="payable_amount"]').val(amt);
                $("#msg").html(data.success);
                $("#msg").attr('color','green');
              

          }
          

            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error  data in coupon');
            }
        });



  });       
      
  } );

    function remove_field(id)
    {      
        
//        $.ajax(
//        {
//            type: "POST",
//            url: '<?php echo site_url('index.php/center/Orders/remove_acc_from_order')?>/'+id,
//            dataType : "JSON",
//            success: function(data)
//            {
//               
//                $("#remove"+id).remove();
//
//            },
//            error: function (jqXHR, textStatus, errorThrown)
//            {
//                alert('Error  data in coupon');
//            }
//        });
       
    }

  
  </script>



