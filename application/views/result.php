<style>
    .space{
        /*padding-top: 10%;*/
        padding-bottom: 22%;
    }
</style>      
<div class="container">
            <div class="row">
	<div class="col-md-5">
		<div class="panel panel-default">
			<div class="panel-heading" style="background:#3c8dbc">
                            <h4 style="color:white">Result</h4>
			</div>
                    <div class="panel-body">
                        <form action="<?php echo base_url()?>Examination/get_result" onsubmit="return validateForm()" id="form" method="post">
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
                          <div class="row">
                              <div class="col-md-12">
                             <?php  if(!empty($this->session->flashdata('error')))
                             {
                                 ?>
                                  <span style="color:red"><?php echo $this->session->flashdata('error'); ?></span>
                              <?php
                             }
                                     ?>
                              </div>
                          </div>
       </div>
     <div class="row">
     <div class="col-md-6 col-sm-6 col-xs-6">
        <div class="form-group">
            <label></label><br>
            <button type="submit" name="get_result" value="get_result" class="btn btn-primary">Get Result</button>
       
            </div>
    </div>            
    </div>
           
         
           </form>
           </div>
           </div>
            </div>
                <div class="col-md-7">
                    <?php if(isset($result))
                    {
                        $res=$this->Exam_details_model->get_result_by_id($result->acc_id,$result->exam_id);
//                     print_r($res);
                     ?>
                     <div class="table-responsive" style="" >
              <table class="table table-bordered" cellspacing="0" width="100%">
                  <!--<tr bgcolor="#338cbf" style="color:#fff">-->
          <tr> <th align="center" bgcolor="#d2d6de" style="color:#fff">Exam Report</th> <td align="center" bgcolor="#338cbf" style="color:#fff">Marks</td></tr>        
         <tr> <th align="center" >Total Questions</th> <td align="center" id="total_questions"><?php echo $res['total_questions']; ?></td></tr>
         <tr><th align="center" >Correct Answer</th> <td align="center" id="correct_ans"><?php echo $res['correct_ans']; ?></td> </tr>
          <tr><th align="center" >Wrong Answer</th> <td align="center" id="wrong_ans"><?php echo $res['wrong_ans']; ?></td></tr>
          <tr><th align="center" >Marks Obtain</th> <td align="center" id="marks_obtain"><?php echo $res['total_marks']; ?></td></tr>
          <tr><th align="center" >Marks Out Of</th> <td align="center" id="out_of"><?php echo $res['total_questions']; ?></td> </tr>
          <tr><th align="center" >Result</th> <td align="center" id="exm_res"><?php if($result->exam_result=="pass"){?> <span style="color:green;"><?php echo $result->exam_result; ?></span> <?php }else{?> <span style="color:red;"><?php echo $result->exam_result; ?></span> <?php } ?></td> </tr>
                           
         </table>
           <div class="pull-right">
                  <!--<label> <a href="#" onclick='review("<?php echo $result->acc_id;?>")' id="review">Test Review</a></label>-->
              </div>
              </div>
                 <?php   }
                    ?>
                </div>
                
            </div>
             <?php if(isset($result))
                    {
                     $question=$this->Exam_details_model->test_review(array('exam_id'=>$result->exam_id));
                     $i=1;
                     echo " <br><h3>Exam Review</h3><br>";
                     foreach ($question as $que)
                     {
                        ?>
    <div class="row" style="">  
                   
                    <div class="col-md-6">   
                        <label>Q<?php echo $i.") ".$que->question_name;;?></label><br>
                        <span>a) <?php echo $que->question_option_a; ?></span><br>
                        <span>b) <?php echo $que->question_option_b; ?></span><br>
                        <span>c) <?php echo $que->question_option_c; ?></span><br>
                        <span>d) <?php echo $que->question_option_d; ?></span><br>
                    </div>
                    <div class='col-md-6'>
                        <label>Correct Answer :</label><span style="color:#32CD32"><?php echo $que->correct_ans;?></span><br>
                        <label>Given Answer :</label> <span <?php if($que->correct_ans==$que->given_ans){?> style="color:#32CD32;" <?php }else{ ?>  style="color:red"<?php } ?>> <?php echo $que->given_ans; ?> </span><br>
                        <label>Mark :</label> <span <?php if($que->mark=='1'){?> style="color:#32CD32;" <?php }else{ ?>  style="color:red"<?php } ?>> <?php echo $que->mark; ?> </span><br>
                        
                    </div>              
                </div><hr>
                 <?php
                 $i++;
                     }
                    }
                    ?>
    <div class="row space">
        </div>
            </div>