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
    <br>
    <section class="content">
        <br>
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
          <th>CENTER</th>
          <th>TRANSCATION ID</th>
          <th>MERCHANT REFRENCE</th>
          <th>BANK REF No</th>
          <th>AMOUNT</th>
          <th>PAYMENT AT</th>
          <th>STATUS</th>

        </tr>
      </thead>
      <tbody id="myTable">
        <?php
          if (isset($payment)) {
            
          
         foreach($payment as $res){ ?>
             <tr>
                            <td><?php echo $res->p_id;?></td>
                                        <td><?php echo $res->order_id ?></td>
                                        <td><?php echo $res->center_name; ?></td>
                                        <td><?php echo $res->payment_id;?></td>
                                       <td><?php echo $res->merchant_order_id;?></td>
                                       <td><?php echo $res->bank_ref_num;?></td>
                                       <td><?php echo $res->amount;?></td>
                                       <td><?php echo $res->payment_at;?></td>
                                       <td><?php echo $res->payment_status;?></td>


                                      
              </tr>
             <?php }}?>



      </tbody>
      
      <tfoot>
            <tr>
                <th colspan="6" style="text-align:right">Total:</th>
                <th></th>
            </tr>
        </tfoot>

    </table>
    </div>
    
</form>
</section>
  </div>

<script  src="https://code.jquery.com/jquery-3.3.1.js"></script>
<script  src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script type="text/javascript">
$(document).ready(function() {
        
    $('#table_id').DataTable( {

        "footerCallback": function ( row, data, start, end, display ) {
            var api = this.api(), data;
 
            // Remove the formatting to get integer data for summation
            var intVal = function ( i ) {
                return typeof i === 'string' ?
                    i.replace(/[\$,]/g, '')*1 :
                    typeof i === 'number' ?
                        i : 0;
            };
 
            // Total over all pages
            total = api
                .column( 6 )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );
               
            // Total over this page
            pageTotal = api
                .column( 6, { page: 'current'} )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );
 
            // Update footer
            $( api.column( 6 ).footer() ).html(
                'Rs.'+pageTotal +' ( Rs.'+ total +' total)'
            );   
                
                
        }

    } );
} );

    $("#myName").on("keyup", function() {
    var value = $(this).val().toLowerCase();
    $("#myTable tr").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
  });
  
    $(document).ready(function(){
        $.fn.dataTable.ext.search.push(
        function (settings, data, dataIndex) {
            var min = $('#min').datepicker("getDate");
            var max = $('#max').datepicker("getDate");
            var startDate = new Date(data[7]);
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
  </script>