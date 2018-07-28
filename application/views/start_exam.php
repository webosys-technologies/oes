<!DOCTYPE html>
<html lang="en">
<head>
  <title>Examination</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  
  <style>
    /* Set height of the grid so .sidenav can be 100% (adjust if needed) */
    .row.content {height: 1500px}
    
    /* Set gray background color and 100% height */
    .sidenav {
      background-color: #f1f1f1;
      height: 100%;
    }
    
    /* Set black background color, white text and some padding */
    footer {
      background-color: #555;
      color: white;
      padding: 15px;
    }
    
    /* On small screens, set height to 'auto' for sidenav and grid */
    @media screen and (max-width: 767px) {
      .sidenav {
        height: auto;
        padding: 15px;
        
      }
      /*.row.content {height: auto;}*/ 
    }
    
     @media only screen and (max-width: 600px) {
   .sidenav {
        height: auto;
        padding: 15px;
        
      }
}

/*@media screen and (min-width: 400px) {
   .sidenav {
        height: 100%;
        padding: 15px;
        
      }
}*/
    
    
    
    th, td {
    padding: 1px;
}
  </style>
</head>
<script>
   $(document).ready(function () {  
       
//   window.onbeforeunload = function() {
//        return "Dude, are you sure you want to leave?";  //show dialog before reload and close
//    }
    
    });
    
    
    
    var p;
  function gen_btn(p)
{   
    
    btn="gen_btn";
    $('#press_btn').val(btn);
    $('#press_btn_qno').val(p);
    get_question();
}
function prev_btn()
{  
   
    btn="prev";
    $('#press_btn').val(btn);
    get_question(p);
}
    function next_btn()
{   
    
    btn="next";
    $('#press_btn').val(btn);
    get_question(p);
}



   function result(submit)
    {
        if(submit)
        {
            r=true;
        }
        else
        {
        var r = confirm("Are you sure want to finish the exam...!");
        }
        if(r==true)
        {
        var data = new FormData(document.getElementById("form"));

      var url;
      
        url = "<?php echo site_url('index.php/Examination/submit_exam')?>";
      

       // ajax adding data to database
          $.ajax({
            url : url,
            type: "POST",
            async: false,
            processData: false,
            contentType: false,            
            data: data,
            dataType: "JSON",
            success: function(data)
            {
                               if(data.result=="pass")
                               {
                                   $('#exm_res').html('<span style="color:#32CD32">'+data.result+'</span>');
                               }
                               else
                               {
                                   $('#exm_res').html('<span style="color:red">'+data.result+'</span>');
                               }
                               $('#total_questions').html(data.total_questions);
                               $('#marks_obtain').html(data.exam_result['total_marks']);
                               $('#out_of').html(data.total_questions);
                               $('#correct_ans').html(data.exam_result['correct_ans']);
                               $('#wrong_ans').html(data.exam_result['wrong_ans']);  
                               $("#review").attr("onclick", 'test_review('+ data.test_review_id +')');
                               
                               $("#show_button").hide();
                              $("#start_exam").hide();
                              $("#exam_result").show();
                              if(data.result=="pass")
                              {
                              $("#congratulation").show();
                              }

            
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
//                alert('Error.......! ');
            }
        });
    }
    }

    
    
    
function get_question(id)
    {
//           alert($("#question_num").val());
         var data = new FormData(document.getElementById("form"));
         var url;
        
            
             url="<?php echo site_url('index.php/Examination/question/')?>"+id;
              
      //Ajax Load data from ajax
      $.ajax({
        url : url,        
        type: "POST",
         async: false,
         processData: false,
         contentType: false,            
         data:data,    
        dataType: "JSON",
        success: function(data)
        {      

                       $('#press_btn_qno').val("");
                       $('#exams').hide();
                       $('#start_exam').show();
                       $('#show_button').show();
                 
                  if(data.question['qno']=='1')
                  {
                      $("#prev").hide();
                      $("#next").show();
                      
                  }
                  else
                  {
                      $("#prev").show();
                  }
                  if(data.question['qno']==data.no_of_que)
                  {
                      $("#next").hide();
                      $("#prev").show();
                  }
                  else
                  {
                  $("#next").show();
                  }
                  

                 $("#question_id").val(data.question['question_id']);
                  $("#question_num").val(data.question['qno']);
           

            $('#question').html(data.question['question_name']);
            $('#option_a').html(data.question['question_option_a']);
            $('#option_b').html(data.question['question_option_b']);
            $('#option_c').html(data.question['question_option_c']);
            $('#option_d').html(data.question['question_option_d']);
             $('#qno').html("Question "+data.question['qno']);
            $('input:radio[id=optiona]').val(data.question['question_option_a']).prop('checked',false);
            $('input:radio[id=optionb]').val(data.question['question_option_b']).prop('checked',false);
            $('input:radio[id=optionc]').val(data.question['question_option_c']).prop('checked',false);
            $('input:radio[id=optiond]').val(data.question['question_option_d']).prop('checked',false);
            
            
             var solved=data.no_of_que-1;
             var qno=data.question['qno'];
           if(data.solved_question)
           {
           for(var n=0;n<=solved;n++)
           {
               if(data.solved_question[n])
               {
                  
                   $("#btn_"+data.solved_question[n]).attr("class","btn btn-success btn-sm");  //change given answer button color
               } 
              
            }
           }
          
          
          if(data.given_ans!==null)
          {
             
                     //checked radio previous given answer.                              
            if($("#optiona").val()== data.given_ans[qno])    
            {
                $("#optiona").prop('checked',true);
            }
                if($("#optionb").val()== data.given_ans[qno])
                {
                    $("#optionb").prop('checked',true);
                }
                    if($("#optionc").val()== data.given_ans[qno])
                    {
                         $("#optionc").prop('checked',true);
                    }
                        if($("#optiond").val()== data.given_ans[qno])
                        {
                             $("#optiond").prop('checked',true);
                        }
                    }
                            
  
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
//            alert('Error.....!');
        }
    });
    }
    
    
</script>
<body>

<div class="container-fluid">
  <div class="row content">
    <div class="col-sm-12 col-md-4 col-xs-12 sidenav">
        <center><h3>Online Examination</h3></center>

<div class="row">
    <div class="col-md-5 col-sm-5 col-xs-5">
        <label>Exam Name : </label>
    </div>
     <div class="col-md-7 col-sm-7 col-xs-7">
         <span> <?php echo $this->session->userdata('oes_course_name');?> </span>
    </div>
</div>
<div class="row">
    <div class="col-md-5 col-sm-5 col-xs-5">
        <label>Roll No : </label>
    </div>
     <div class="col-md-7 col-sm-7 col-xs-7">
         <span> <?php echo $this->session->userdata('oes_acc_no');?> </span>
    </div>
</div>
<div class="row">
    <div class="col-md-5 col-sm-5 col-xs-5">
        <label>Language : </label>
    </div>
     <div class="col-md-7 col-sm-7 col-xs-7">
         <span> <?php echo ucfirst($this->session->userdata('oes_language'));?> </span>
    </div>
</div>

<br>
                    <?php
                     for($i=1;$i<=100;$i++)
                                 {
                                      if(!empty($this->session->userdata('ans_qno'.$i)))
                                      {   
                                          if($i==1)
                                          {
                                        $res= $this->session->userdata('ans_qno'.$i)['given_ans'];  
                                          }
                                        ?>
                    <script>
                        $(document).ready(function()
                        {
                           if("<?php echo $i;?>"==1)
                           {
                             if($("#optiona").val()== "<?php echo $res;?>")    
            {
                $("#optiona").prop('checked',true);
            }
                if($("#optionb").val()== "<?php echo $res;?>")
                {
                    $("#optionb").prop('checked',true);
                }
                    if($("#optionc").val()== "<?php echo $res;?>")
                    {
                         $("#optionc").prop('checked',true);
                    }
                        if($("#optiond").val()== "<?php echo $res;?>")
                        {
                             $("#optiond").prop('checked',true);
                        }
                    }
                            
                          $("#btn_<?php echo $i;?>").attr("class","btn btn-success btn-sm");  //change given answer button color   
                        });                     
                        </script>
                    <?php
                                      }

                                 }
                    ?>

<center>
      <table width="">
          <tr>
           <?php
           for($i=1;$i<=10;$i++)
           {
           ?>   
          <td><button onclick="gen_btn(<?php echo $i;?>)" id="btn_<?php echo $i;?>" class="btn btn-danger btn-sm"><?php echo $i;?></button></td>
           <?php 
           }?>
         </tr>
          <tr>
           <?php
           for($i=11;$i<=20;$i++)
           {
           ?>   
          <td><button onclick="gen_btn(<?php echo $i;?>)" id="btn_<?php echo $i;?>" class="btn btn-danger btn-sm"><?php echo $i;?></button></td>
           <?php 
           }?>
         </tr>
          <tr>
           <?php
           for($i=21;$i<=30;$i++)
           {
           ?>   
          <td><button onclick="gen_btn(<?php echo $i;?>)" id="btn_<?php echo $i;?>" class="btn btn-danger btn-sm"><?php echo $i;?></button></td>
           <?php 
           }?>
         </tr>
          <tr>
           <?php
           for($i=31;$i<=40;$i++)
           {
           ?>   
          <td><button onclick="gen_btn(<?php echo $i;?>)" id="btn_<?php echo $i;?>" class="btn btn-danger btn-sm"><?php echo $i;?></button></td>
           <?php 
           }?>
         </tr>
          <tr>
           <?php
           for($i=41;$i<=50;$i++)
           {
           ?>   
          <td><button onclick="gen_btn(<?php echo $i;?>)" id="btn_<?php echo $i;?>" class="btn btn-danger btn-sm"><?php echo $i;?></button></td>
           <?php 
           }?>
         </tr>
          <tr>
           <?php
           for($i=41;$i<=50;$i++)
           {
           ?>   
          <td><button onclick="gen_btn(<?php echo $i;?>)" id="btn_<?php echo $i;?>" class="btn btn-danger btn-sm"><?php echo $i;?></button></td>
           <?php 
           }?>
         </tr>
          <tr>
           <?php
           for($i=51;$i<=60;$i++)
           {
           ?>   
          <td><button onclick="gen_btn(<?php echo $i;?>)" id="btn_<?php echo $i;?>" class="btn btn-danger btn-sm"><?php echo $i;?></button></td>
           <?php 
           }?>
         </tr>
          <tr>
           <?php
           for($i=61;$i<=70;$i++)
           {
           ?>   
          <td><button onclick="gen_btn(<?php echo $i;?>)" id="btn_<?php echo $i;?>" class="btn btn-danger btn-sm"><?php echo $i;?></button></td>
           <?php 
           }?>
         </tr>
          <tr>
           <?php
           for($i=71;$i<=80;$i++)
           {
           ?>   
          <td><button onclick="gen_btn(<?php echo $i;?>)" id="btn_<?php echo $i;?>" class="btn btn-danger btn-sm"><?php echo $i;?></button></td>
           <?php 
           }?>
         </tr>
          <tr>
           <?php
           for($i=81;$i<=90;$i++)
           {
           ?>   
          <td><button onclick="gen_btn(<?php echo $i;?>)" id="btn_<?php echo $i;?>" class="btn btn-danger btn-sm"><?php echo $i;?></button></td>
           <?php 
           }?>
         </tr>
          <tr>
           <?php
           for($i=91;$i<=100;$i++)
           {
           ?>   
          <td><button onclick="gen_btn(<?php echo $i;?>)" id="btn_<?php echo $i;?>" class="btn btn-danger btn-sm"><?php echo $i;?></button></td>
           <?php 
           }?>
         </tr>
        
      </table>
    </center>
    </div>

    <div class="col-sm-12 col-md-8 col-xs-12">
        <br>
        <div class="row">
            <div class="col-md-4">
                <label>Total Time :</label><label style="color:red">1 hour</label>
            </div>
            <div class="col-md-4">
                 <label>Remaining Time :</label><label style="color:green">1 hr 20 min 10 sec</label>
            </div>
            <div class="col-md-4">
                 <label>Total Mark :</label><label style="color:red">100 Marks</label>
            </div>
                    
        </div>
      <hr>
      
     
      <div class="container">
         
      <form action="#" id="form">
          <h4 style="color:black" id="que_detail"><span id="qno">  <?php if(isset($qno)){ echo "Question ". $qno;}?></span> Of <span id="no_of_que"><?php echo $no_of_que;?></span></h4>
      <span id="question"><?php if(isset($qno)){ echo $question_name;}?></span><br/><br>
     
        <input type="radio" id="optiona" name="option" value="<?php if(isset($qno)){ echo $question_option_a;}?>"> a) <span id="option_a"><?php if(isset($qno)){ echo $question_option_a;}?></span><br/>
        <input type="radio" id="optionb" name="option" value="<?php if(isset($qno)){ echo $question_option_b;}?>"> b) <span id="option_b"><?php if(isset($qno)){ echo $question_option_b;}?></span><br/>
        <input type="radio" id="optionc" name="option" value="<?php if(isset($qno)){ echo $question_option_c;}?>"> c) <span id="option_c"><?php if(isset($qno)){ echo $question_option_c;}?></span><br/>
        <input type="radio" id="optiond" name="option" value="<?php if(isset($qno)){ echo $question_option_d;}?>"> d) <span id="option_d"><?php if(isset($qno)){ echo $question_option_d;}?></span><br/>
        
        <input name="question_id" id="question_id" value="<?php echo $question_id; ?>" hidden>
        <input name="question_num" id="question_num" value="<?php echo $qno; ?>" hidden>
        <input name="press_btn" id="press_btn" value="" hidden>
       <input name="press_btn_qno" id="press_btn_qno" value="" hidden>
       <input name="timestamp" id="timestamp" value="" hidden>
        
        
        <br><br>
        <div class="row">
            <div class="col-md-6">
                <button type="button" class="btn btn-primary btn-sm" id="prev" onclick="prev_btn()" value="prev" style="display:none;"><< Prev</button> <button type="button" class="btn btn-primary btn-sm" id="next" onclick="next_btn()" value="next" >Next >></button>
        </div>
            <div class="col-md-6 col-sm-6 col-xs-6">
                <!--<div class="pull-right">-->
              <button type="button" id="submit_exam" name="submit_exam" value=""  onclick="result()" class="btn btn-primary btn-sm" ><span id="next_label">Submit Exam</span></button>
             <!--</div>-->
            </div>
        </div>
       </form>
       </div>
        </div>
      </div>
    </div>
 

<footer class="container-fluid">
  <center><p>Copyright © 2018 Webosys Technologies. All rights reserved.</p></center>
</footer>

</body>
</html>