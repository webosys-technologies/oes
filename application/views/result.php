<style>
    .space{
        /*padding-top: 10%;*/
        padding-bottom: 22%;
    }
</style>      
<div class="container">
            <div class="row space">
	<div class="col-md-5">
		<div class="panel panel-default">
			<div class="panel-heading" style="background:#3c8dbc">
                            <h4 style="color:white">Result</h4>
			</div>
                    <div class="panel-body">
                        <form action="<?php echo base_url();?>Examination/get_result" onsubmit="return validateForm()" id="form" method="post">
                      <div class="row">
                         
    <div class="col-md-6 col-sm-6 col-xs-6">
        <div class="form-group">
        <label>Enter Roll No :</label>
        <input type="text" name="acc_no" required="" id="acc_no" class="form-control">  
        <span id="acc_no_err" style="color:red"><?php echo $this->session->flashdata('acc_err');?></span>
        </div>
    </div>
     <div class="col-md-6 col-sm-6 col-xs-6">
        <div class="form-group">
        <label>Select Course :</label>
        <select name="course" class="form-control" required>
             <option value="">--Select Course--</option>
            <?php $course=$this->Courses_model->getall_courses();
            {
                if(isset($course))
                {
                    foreach ($course as $c)
                    {
                    echo '<option value="'.$c->course_id.'">'.$c->course_name.'</option>';
                    }
                }
            }
            ?>         
        </select>
        <span id="course_err" style="color:red"><?php echo $this->session->flashdata('course_err');?></span>
        </div>
    </div>
       </div>
     <div class="row">
     <div class="col-md-6 col-sm-6 col-xs-6">
        <div class="form-group">
            <label></label><br>
            <button type="submit" class="btn btn-primary">Get Result</button>
       
            </div>
    </div>            
    </div>
           
         
           </form>
           </div>
           </div>
            </div>
                <div class="col-md-7">
                </div>
            </div>
            </div>