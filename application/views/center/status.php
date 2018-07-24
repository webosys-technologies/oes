<style type="text/css">
	.right { 
 color: green;   
 font-size:500%;
 text-align: center;
}

.wrong {
 color: red;   
 font-size:500%;
 text-align: center;
}
</style>

<div class="content-wrapper">
	<section class="content-header">
      <h1>
        <i class="fa fa-users"></i><strong> Payment Response </strong>
        <small>View </small>
      </h1>
      <ol class="breadcrumb" >
        <li><a href="<?php echo base_url(); ?>center/Dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
        <li >Payment Response</li>
      </ol>
    </section>
    <section class="content-header">
    	<br>
    		<?php if ($payment_status=='success') { ?>
    			
    		

				<p class='right'>&#10004;</p>
				<h2 class="right">Thank you..!! </h2>
				<h3 style="text-align: center; color:green;">Your payment was successfully completed</h3>
				<?php }else { ?>
				<p class='wrong'>&#10006;</p>
				<h2 class="wrong">Failed</h2>
				<h3 style="text-align: center; color: red;">Please Try Agian...</h3>
				<?php } ?>

				<div>
				<label>Name :</label>
				<label><?php echo $name; ?></label>			
			
				<br>
				<label>Email :</label>
				<label><?php echo $email; ?></label>			
			
				<br>
				<label>Mobile :</label>
				<label><?php echo $mobile; ?></label>			
			
			<br>
			<label >Amount :</label>
			<label ><?php echo $amount; ?></label>			
			
			<br>
			<label >Status :</label>
			<label ><?php echo $payment_status; ?></label>


			<br>
			<label >Status :</label>
			<label ><?php echo $error; ?></label>

			</div>			

			</section>

</div>
