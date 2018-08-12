<style>
    #num{
        color:white;
    }
    </style>
 
  <div class="content-wrapper" style="background-color:white;">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1><i class="fa fa-dashboard"></i><strong> Welcome To Packaging Naukri</strong>
        
       
      </h1>

    </section>
<hr style="border-top: 1px solid #ccc;">
    <!-- Main content -->
    <section class="content">

       <?php if (isset($user_data)){if($user_data->user_type=="admin"){?>  
            <div class="row">
        
         <!--./col--> 
        <div class="col-lg-3 col-xs-6">
           <!--small box--> 
          <div class="small-box" style="background:#FFCC33;">
            <div class="inner">
              <h3 id="num"><?php if(isset($centers)){echo count($centers);}else{echo "0";}?><sup style="font-size: 20px"></sup></h3>

              <p id="num">Centers</p>
            </div>
            <div class="icon">
              <i class="fa fa-users"></i>
            </div>
            <a href="<?php echo base_url(); ?>admin/Centers" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
          <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box" style="background:#90EE90;">
            <div class="inner">
              <h3 id="num"><?php if(isset($sub_centers)){echo $sub_centers;}else{echo "0";}?></h3>

              <p id="num">Sub Centers</p>
            </div>
            <div class="icon">
              <i class="fa fa-mortar-board"></i>
            </div>
            <a href="<?php echo base_url(); ?>admin/Sub_center" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
         <!--./col--> 
        <div class="col-lg-3 col-xs-6">
           <!--small box--> 
          <div class="small-box" style="background:#7FB3D5">
            <div class="inner">
              <h3 id="num"><?php if(isset($users)){echo count($users);}else{echo "0";}?></h3>

              <p id="num">Users</p>
            </div>
            <div class="icon">
              <i class="fa fa-suitcase"></i>
            </div>
            <a href="<?php echo base_url(); ?>admin/Users" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
         
          <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box" style="background:#FFB6C1;">
            <div class="inner">
              <h3 id="num"><?php if(isset($coupons)){echo $coupons;}else{echo "0";}?></h3>

              <p id="num">Coupons</p>
            </div>
            <div class="icon">
              <i class="fa fa-money"></i>
            </div>
            <a href="<?php echo base_url(); ?>admin/Coupon" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
         

      </div>
        
        <div class="row">
              <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box" style="background:#F0B27A;">
            <div class="inner">
              <h3 id="num"><?php if(isset($accounts)){echo count($accounts);}else{echo "0";}?><sup style="font-size: 20px"></sup></h3>

              <p id="num">Roll No's</p>
            </div>
            <div class="icon">
              <i class="fa fa-institution"></i>
            </div>
            <a href="<?php echo base_url(); ?>center/Account" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>  
            
            
           <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box" style="background:#008080;">
            <div class="inner">
              <h3 id="num"><?php if(isset($questions)){echo $questions;}else{echo "0";}?></h3>

              <p id="num">Questions</p>
            </div>
            <div class="icon">
              <i class="fa fa-question-circle"></i>
            </div>
            <a href="<?php echo base_url(); ?>admin/Question" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div> 
            
            <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-red" >
            <div class="inner">
              <h3 id="num"><?php if(isset($payments)){
                  foreach($payments as $pay)
                  {
                      $amt[]=$pay->amount;
                  }
                  echo array_sum($amt);}else{echo "0";}?>
                  <sup style="font-size: 20px"></sup>
              </h3>

              <p id="num">Total Payment</p>
            </div>
            <div class="icon">
              <i class="fa fa-institution"></i>
            </div>
            <a href="<?php echo base_url(); ?>center/Account" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>  
            
            
        </div>
        
        
       <?php } }?>
        
        
        
        
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  
<script>
  

</script>

