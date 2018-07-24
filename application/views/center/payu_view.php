

<div class="content-wrapper">

<!-- Bootstrap 4 Navbar  -->

<!-- End Bootstrap 4 Navbar -->

	


<div class="container mt-5">
	<div class="row">
        <div class="col-md-2"></div>  
        <div class="col-md-8">
        	<div class="card">
        		<h3 class="card-header bg-success text-white">Payment Confirmation</h3>
        		<div class="card-body">
        			<form action="https://sandboxsecure.payu.in/_payment" method="post" id="payuForm" name="payuForm">
        				
		                <input type="hidden" name="key"  value="<?php echo $mkey; ?>" />
		                <input type="hidden" name="hash" value="<?php echo $hash; ?>" />
		                <input type="hidden" name="txnid" value="<?php echo $tid; ?>" />
		                
		                <div class="form-group">
		                    <label class="control-label">Center Name</label>
		                    <input class="form-control" name="address" value="<?php  echo $center_name; ?>" readonly />     
		                </div>
		                <div class="form-group">
		                    <label class="control-label">Your Name</label>
		                    <input class="form-control" name="firstname" id="firstname" value="<?php echo $firstname; ?>" readonly/>
		                </div>
		                <div class="form-group">
		                    <label class="control-label">Email</label>
		                    <input class="form-control" name="email" id="email" value="<?php echo $email; ?>" readonly/>
		                </div>
		                <div class="form-group">
		                    <label class="control-label">Mobile</label>
		                    <input class="form-control" name="phone" value="<?php echo $phone; ?>" readonly/>
		                </div>
		                <div class="form-group">
		                    <label class="control-label">Number Of Accounts</label>
		                    <input class="form-control" name="account" value="<?php echo $no_of_account	; ?>" readonly />
		                </div>
		                <div class="form-group">
		                    <label class="control-label">Total Payable Amount</label>
		                    <input class="form-control" name="amount" value="<?php echo $amount; ?>" readonly />
		                </div>
		                <div class="form-group">
		                    <label class="control-label">Payment For</label>
		                    <input class="form-control" name="productinfo" value="<?php echo $productinfo; ?>" readonly>
		                </div>
		                
		                <div class="form-group">
		                	<input type="hidden" name="udf1" value="<?php echo $udf1; ?>" readonly>
		                	<input type="hidden" name="udf2" value="<?php echo $udf2; ?>" readonly>
                                        <input type="hidden" name="udf3" value="<?php echo $udf3; ?>" readonly>
		                    <input name="surl"  size="64" type="hidden" value="<?php echo $success; ?>" readonly/>
		                    <input name="furl"  size="64" type="hidden" value="<?php echo $failure; ?>" readonly />  
		                    <!--for test environment comment  service provider   -->
		                    <input type="hidden" name="service_provider" value="payu_paisa" size="64" readonly/>
		                    <input name="curl"   type="hidden" value="<?php echo $cancel; ?>" readonly/>
		                </div>
		                <div class="form-group float-right">
		                	<input type="submit" value="Pay Now" class="btn btn-success" />
		                </div>
		            </form> 
        		</div>
        	</div>
        	                                   
        </div>
      
    </div>
</div>
</div>