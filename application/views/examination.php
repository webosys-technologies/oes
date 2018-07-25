<!DOCTYPE html>
<html>
<title>Examination</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://www.w3schools.com/lib/w3-theme-black.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.3.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<body>
    <style>
        div span {
            line-space: 1.6;
        }
    </style>




<!-- Modal -->
<div id="id01" class="w3-modal">
<!--    <div class="w3-modal-content w3-card-4 w3-animate-top">
      <header class="w3-container w3-theme-l1"> 
        <span onclick="document.getElementById('id01').style.display='none'"
        class="w3-button w3-display-topright">×</span>
        <h4>Oh snap! We just showed you a modal..</h4>
        <h5>Because we can <i class="fa fa-smile-o"></i></h5>
      </header>
      <div class="w3-padding">
        <p>Cool huh? Ok, enough teasing around..</p>
        <p>Go to our <a class="w3-btn" href="/w3css/default.asp">W3.CSS Tutorial</a> to learn more!</p>
      </div>
      <footer class="w3-container w3-theme-l1">
        <p>Modal footer</p>
      </footer>
    </div>-->
</div>
<div class="row">
    <div class="col-md-offset-3 col-xs-offset-1 col-md-6" style="padding-top:20px;">
        <h4 style="color:#CA3F07;"><b>DELTO मार्फत विद्यार्थ्यांना Training देण्यासाठी खालील procedure करा.</b></h4>
       <span>1) प्रथम delto.in या वेबसाइट ला visit करा.</span><br>
       <span>2) Home page वर Center SignUp ला click करा.</span><br>
       <span>3) सर्व फॉर्म भरून SignUp करा.</span><br>
       <span>4) तुमच्या email account वर जाऊन account active करा (After 10 minutes) किंवा center चे नाव 9822280896 या नंबर वर Whatsapp करून  Account active करायला सांगा.</span><br>
       <span>5) Account active झाल्यानंतर delto.in या वेबसाइट ला visit करा.</span><br>
       <span>6) Home Page वर Center login ला click करा.</span><br>
       <span>7) Login ID व Password देऊन login करा.</span><br>
       <span>8) Navigation List मधील Sub Centers ऑप्शन वापरुन तुमच्या center च्या under काही sub centers असतील तर ती तयार करा.</span><br>
       <span>9) नंतर Batch wise Student add करण्यासाठी Batches add करा.</span><br>
      <span>10) नंतर Manage Student मधून Students Add करा. Student add करताना centre चे नाव, Course योग्य सिलेक्ट करा. व Book हवे असल्यास तसे option सिलेक्ट करा. Book नको असेल तर No Book option select करा.</span><br>
      <span>11) Student add केल्यानंतर ज्या ज्या students’ चे payment करायचे आहे, ते student select करून Make Payment option वर click करा.</span><br>
      <span>12) Payment झाल्यानंतर Admission मध्ये त्या students’ चे login details दिसतील.</span><br>
      <span>13) ते login details students ला द्यावेत.</span><br>
      <span>14) delto.in या वेबसाइट च्या Home Page वर Student Login ला click करावे.</span><br>
      <span>15) Username व Password देऊन Student Login झाल्यानंतर Student Login मध्ये Topic ला click करून Students सर्व topics चे सविस्तर knowledge घेऊ शकतात.</span><br>
      <span>16) सर्व कोर्से पूर्ण झाल्यानंतर Center Admin ने त्याच्या login मधून EXAM PASSCODE generate करावा व तो student ला द्यावा. Student त्याच्या login मधून EXAM ऑप्शन वापरुन EXAM देऊ शकतो. Pass झाल्यानंतर student चे certificate, Center ला त्यांच्या login मध्ये दिसेल.</span><br>
       <br>
       
       <form action="<?php echo base_url();?>Examination/exam_login" id="form" method="post">
        <div class="row">
    <div class="col-md-6 col-sm-6 col-xs-6">
        <div class="form-group">
        <label>Enter Roll No :</label>
        <input type="text" name="acc_no" required="" id="acc_no" class="form-control">  
        <span id="acc_no_err" style="color:red"><?php echo $this->session->flashdata('acc_err');?></span>
        </div>
    </div>
     <div class="col-md-4 col-sm-4 col-xs-4">
        <div class="form-group">
        <label>Select Language :</label>
        <select name="language" class="form-control">
            <option value="english">English</option>
            <option value="marathi">मराठी</option> 
            <option value="hindi">हिंदी</option>
        </select>
            </div>
    </div>
            
</div>
            <div class="row">
    <div class="col-md-6 col-sm-6 col-xs-6">
        <div class="form-group">
        <label>Select Course :</label>
        <select name="course" class="form-control" required>
             <option value="">--Select Coiurse--</option>
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
    
             <div class="col-md-2 col-sm-2 col-xs-2">
        <div class="form-group">
            <label></label><br>
            <button type="submit" class="btn btn-primary">Start Exam</button>
       
            </div>
    </div>
</div>
           </form>
        </div>
    </div>
<br>




<br>





<!-- Script for Sidebar, Tabs, Accordions, Progress bars and slideshows -->
<script>
// Side navigation
function w3_open() {
    var x = document.getElementById("mySidebar");
    x.style.width = "100%";
    x.style.fontSize = "40px";
    x.style.paddingTop = "10%";
    x.style.display = "block";
}
function w3_close() {
    document.getElementById("mySidebar").style.display = "none";
}

// Tabs
function openCity(evt, cityName) {
  var i;
  var x = document.getElementsByClassName("city");
  for (i = 0; i < x.length; i++) {
     x[i].style.display = "none";
  }
  var activebtn = document.getElementsByClassName("testbtn");
  for (i = 0; i < x.length; i++) {
      activebtn[i].className = activebtn[i].className.replace(" w3-dark-grey", "");
  }
  document.getElementById(cityName).style.display = "block";
  evt.currentTarget.className += " w3-dark-grey";
}

var mybtn = document.getElementsByClassName("testbtn")[0];
mybtn.click();

// Accordions
function myAccFunc(id) {
    var x = document.getElementById(id);
    if (x.className.indexOf("w3-show") == -1) {
        x.className += " w3-show";
    } else { 
        x.className = x.className.replace(" w3-show", "");
    }
}

// Slideshows
var slideIndex = 1;

function plusDivs(n) {
slideIndex = slideIndex + n;
showDivs(slideIndex);
}

function showDivs(n) {
  var x = document.getElementsByClassName("mySlides");
  if (n > x.length) {slideIndex = 1}    
  if (n < 1) {slideIndex = x.length} ;
  for (i = 0; i < x.length; i++) {
     x[i].style.display = "none";  
  }
  x[slideIndex-1].style.display = "block";  
}

showDivs(1);

// Progress Bars
function move() {
  var elem = document.getElementById("myBar");   
  var width = 5;
  var id = setInterval(frame, 10);
  function frame() {
    if (width == 100) {
      clearInterval(id);
    } else {
      width++; 
      elem.style.width = width + '%'; 
      elem.innerHTML = width * 1  + '%';
    }
  }
}
</script>

</body>
</html>
