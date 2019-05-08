<script>
function validateForm() {
    var x=$("#term").prop("checked");

    if (x == true) {
               return true;
    }else{
        $("#term_err").html("You Must Select These Checkbox");
        return false;
    }
}
</script>

<style>
    .shadow {
   
    /*padding: 20px;*/
    /*{border-style: groove;}*/
    border: 1px solid #EAEDED;
    /*border-color: 1px #CCD1D1;*/
    box-shadow: 5px 5px 10px #CCD1D1;
}
</style>

<div class="row" style="background:#FEF9E7;">
    <div class="container" style="padding-top:20px;">
        <div class="row">
           
       
            
      <center>  <h4 style="color:#CA3F07;"><b>Online Exam Instruction & procedure</b></h4></center>
      <br>
             <div class="col-md-6 col-sm-6 col-xs-12">
       <span>1) प्रथम delto.in या वेबसाइट ला visit करा.</span><br>
       <span>2) Home page वर Center SignUp ला click करा.</span><br>
       <span>3) सर्व फॉर्म भरून SignUp करा.</span><br>
       <span>4) तुमच्या email account वर जाऊन account active करा (After 10 minutes) किंवा center चे नाव 9822280896 या नंबर वर Whatsapp करून  Account active करायला सांगा.</span><br>
       <span>5) Account active झाल्यानंतर delto.in या वेबसाइट ला visit करा.</span><br>
       <span>6) Home Page वर Center login ला click करा.</span><br>
       <span>7) Login ID व Password देऊन login करा.</span><br>
       <span>8) Navigation List मधील Sub Centers ऑप्शन वापरुन तुमच्या center च्या under काही sub centers असतील तर ती तयार करा.</span><br>
            </div>
            <div class="col-md-6 col-sm-6 col-xs-12">
       <span>9) नंतर Batch wise Student add करण्यासाठी Batches add करा.</span><br>
      <span>10) नंतर Manage Student मधून Students Add करा. Student add करताना centre चे नाव, Course योग्य सिलेक्ट करा. व Book हवे असल्यास तसे option सिलेक्ट करा. Book नको असेल तर No Book option select करा.</span><br>
      <span>11) Student add केल्यानंतर ज्या ज्या students’ चे payment करायचे आहे, ते student select करून Make Payment option वर click करा.</span><br>
      <span>12) Payment झाल्यानंतर Admission मध्ये त्या students’ चे login details दिसतील.</span><br>
      <span>13) ते login details students ला द्यावेत.</span><br>
      <span>14) delto.in या वेबसाइट च्या Home Page वर Student Login ला click करावे.</span><br>
     
   
       <br>   
       </div>
       </div>
        
        <div class="row">
	<div class="col-md-offset-3 col-md-6 col-md-offset-3">
		<div class="panel panel-default">
			<div class="panel-heading" style="background:#F0B27A">
                            <h4 style="color:white">Online Examination</h4>
			</div>
                    <div class="panel-body" style="background:#FAD7A0;">
                        <form action="<?php echo base_url();?>Examination/exam_login" onsubmit="return validateForm()" id="form" method="post">
                      <div class="row">
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
    
     <div class="col-md-6 col-sm-6 col-xs-6">
        <div class="form-group">
        <label>Select Language :</label>
        <select name="language" class="form-control">
            <option value="english">English</option>
            <option value="marathi">मराठी</option> 
            <option value="hindi">हिंदी</option>
        </select>
        <span id="language_err" style="color:red"><?php echo $this->session->flashdata('language_err');?></span>
            </div>
    </div>
            
</div>
            <div class="row">
            <div class="col-md-6 col-sm-6 col-xs-6">
        <div class="form-group">
        <label>Enter Roll No :</label>
        <input type="text" name="acc_no" required="" id="acc_no" class="form-control">  
        <span id="acc_no_err" style="color:red"><?php echo $this->session->flashdata('acc_err');?></span>
        </div>
    </div>
    
             <div class="col-md-2 col-sm-2 col-xs-2">

            </div>               
</div>
          <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <input type="checkbox" value="" name="term" id="term" checked> I have read and understand the above information<br>
                <span style="color:red" id="term_err"></span>
              </div>
            </div>
          </div>  
          <div class="row">
              <div class="col-md-12">
               <div class="form-group">
            <button type="submit" class="btn btn-info">Start Exam</button>
       
            </div>
                  </div>
          </div>
           </form>
                          </div>
                    </div>
            </div>
            </div>
               
        <?php // print_r($this->session->userdata());?>
        </div>
    </div>
    
    
 