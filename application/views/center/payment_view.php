<!Doctype html>


<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <i class="fa fa-credit-card"></i><strong> Payment </strong>
        <small>Control panel</small>
      </h1>
      <ol class="breadcrumb" >
        <li><a href="<?php echo base_url(); ?>center/Dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Payment</li>
      </ol>
    </section>
    <section class="content">
      <br />
    <br />
      <div class="row">
        <div class="col-md-3 ">
        <label class="form-label">From</label>
        <input class="form-control" type="text" name="min" id="min" placeholder=" ">
      </div>
      <div class="col-md-3">
        <label class="form-label">To</label>
        <input type="text" name="max" id="max" class="form-control">
      </div>
      </div><br>
    <form id="table" name="table" action="<?php echo base_url(); ?>center/Orders/payment" method="post">
    
    <div class="table-responsive">
    <table id="table_id" class="table table-bordered" cellspacing="0" width="100%">
      <thead class="thead-dark">
        <tr bgcolor="#338cbf" style="color:#fff">
          <th>ID</th>
          <th>ORDER ID</th>
          <th>TRANSCATION ID</th>
          <th>MERCHANT REFRENCE</th>
          <th>BANK REF No</th>
          <th>AMOUNT</th>
          <th>PAYMENT AT</th>
          <th>STATUS</th>

        </tr>
      </thead>
      <tbody>
        <?php
          if (isset($payment)) {
            
          
         foreach($payment as $res){ ?>
             <tr>
                            <td><?php echo $res->p_id;?></td>
                                        <td><?php echo $res->order_id ?></td>
                                        <td><?php echo $res->payment_id;?></td>
                                       <td><?php echo $res->merchant_order_id;?></td>
                                       <td><?php echo $res->bank_ref_num;?></td>
                                       <td><?php echo $res->amount;?></td>
                                       <td><?php echo $res->payment_at;?></td>
                                       <td><?php echo $res->payment_status;?></td>


                                      
              </tr>
             <?php }}?>



      </tbody>

    </table>
    </div>
    
</form>
  </div>
</section>
<script type="text/javascript">
    $(document).ready( function () {
     $('#table_id').DataTable({
         'order':[[0,'desc']]
     });
} );
             $(document).ready(function(){
        $.fn.dataTable.ext.search.push(
        function (settings, data, dataIndex) {
            var min = $('#min').datepicker("getDate");
            var max = $('#max').datepicker("getDate");
            var startDate = new Date(data[6]);
//            alert(startDate);
            if (min == null && max == null) { return true; }
            if (min == null && startDate <= max) { return true;}
            if(max == null && startDate >= min) {return true;}
            if (startDate <= max && startDate >= min) { return true; }
            return false;
        }
        );

       
            $("#min").datepicker({ onSelect: function () { table.draw(); }, changeMonth: true, changeYear: true });
            $("#max").datepicker({ onSelect: function () { table.draw(); }, changeMonth: true, changeYear: true });
            var table = $('#table_id').DataTable();

            // Event listener to the two range filtering inputs to redraw on input
            $('#min, #max').change(function () {
                table.draw();
            });
        });

//         $(function() {
//   var oTable = $('#table_id').DataTable({
//     "oLanguage": {
//       "sSearch": "Filter Data"
//     },
//     "iDisplayLength": -1,
//     "sPaginationType": "full_numbers",

//   });




//   $("#min").datepicker({
//     showOn: "button",
//     buttonImage: "images/calendar.gif",
//     buttonImageOnly: false,
//     "onSelect": function(date) {
//       minDateFilter = new Date(date).getTime();
//       oTable.fnDraw();
//     }
//   }).keyup(function() {
//     minDateFilter = new Date(this.value).getTime();
//     oTable.fnDraw();
//   });

//   $("#max").datepicker({
//     showOn: "button",
//     buttonImage: "images/calendar.gif",
//     buttonImageOnly: false,
//     "onSelect": function(date) {
//       maxDateFilter = new Date(date).getTime();
//       oTable.fnDraw();
//     }
//   }).keyup(function() {
//     maxDateFilter = new Date(this.value).getTime();
//     oTable.fnDraw();
//   });

// });

// // Date range filter
// minDateFilter = "";
// maxDateFilter = "";

// $.fn.dataTableExt.afnFiltering.push(
//   function(oSettings, aData, iDataIndex) {
//     if (typeof aData._date == 'undefined') {
//       aData._date = new Date(aData[0]).getTime();
//     }

//     if (minDateFilter && !isNaN(minDateFilter)) {
//       if (aData._date < minDateFilter) {
//         return false;
//       }
//     }

//     if (maxDateFilter && !isNaN(maxDateFilter)) {
//       if (aData._date > maxDateFilter) {
//         return false;
//       }
//     }

//     return true;
//   }
// );
    </script>