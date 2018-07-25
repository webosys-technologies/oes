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
      .row.content {height: auto;} 
    }
    th, td {
    padding: 1px;
}
  </style>
</head>
<script>
   $(document).ready(function () {  
       
   window.onbeforeunload = function() {
        return "Dude, are you sure you want to leave?";  //show dialog before reload and close
    }
    
    });
</script>
<body>

<div class="container-fluid">
  <div class="row content">
    <div class="col-sm-4 sidenav">
        <center><h3>Online Examination</h3></center>
<!--      <div class="input-group">
        <input type="text" class="form-control" placeholder="Search Blog..">
        <span class="input-group-btn">
          <button class="btn btn-default" type="button">
            <span class="glyphicon glyphicon-search"></span>
          </button>
        </span>
      </div>-->
<div class="row">
    <div class="col-md-5 col-sm-5 col-xs-5">
        <label>Exam Name : </label>
    </div>
     <div class="col-md-7 col-sm-7 col-xs-7">
         <span> CCC Exam </span>
    </div>
</div>
<div class="row">
    <div class="col-md-5 col-sm-5 col-xs-5">
        <label>Roll No : </label>
    </div>
     <div class="col-md-7 col-sm-7 col-xs-7">
         <span> AU1234567 </span>
    </div>
</div>
<div class="row">
    <div class="col-md-5 col-sm-5 col-xs-5">
        <label>Language : </label>
    </div>
     <div class="col-md-7 col-sm-7 col-xs-7">
         <span> English </span>
    </div>
</div>
<br>
      <table width="">
          <tr>
           <?php
           for($i=1;$i<=10;$i++)
           {
           ?>   
          <td><button onclick="get_question()" id="que_btn" class="btn btn-default btn-sm"><?php echo $i;?></button></td>
           <?php 
           }?>
         </tr>
          <tr>
           <?php
           for($i=11;$i<=20;$i++)
           {
           ?>   
          <td><button onclick="get_question()" id="que_btn" class="btn btn-default btn-sm"><?php echo $i;?></button></td>
           <?php 
           }?>
         </tr>
          <tr>
           <?php
           for($i=21;$i<=30;$i++)
           {
           ?>   
          <td><button onclick="get_question()" id="que_btn" class="btn btn-default btn-sm"><?php echo $i;?></button></td>
           <?php 
           }?>
         </tr>
          <tr>
           <?php
           for($i=31;$i<=40;$i++)
           {
           ?>   
          <td><button onclick="get_question()" id="que_btn" class="btn btn-default btn-sm"><?php echo $i;?></button></td>
           <?php 
           }?>
         </tr>
          <tr>
           <?php
           for($i=41;$i<=50;$i++)
           {
           ?>   
          <td><button onclick="get_question()" id="que_btn" class="btn btn-default btn-sm"><?php echo $i;?></button></td>
           <?php 
           }?>
         </tr>
          <tr>
           <?php
           for($i=41;$i<=50;$i++)
           {
           ?>   
          <td><button onclick="get_question()" id="que_btn" class="btn btn-default btn-sm"><?php echo $i;?></button></td>
           <?php 
           }?>
         </tr>
          <tr>
           <?php
           for($i=51;$i<=60;$i++)
           {
           ?>   
          <td><button onclick="get_question()" id="que_btn" class="btn btn-default btn-sm"><?php echo $i;?></button></td>
           <?php 
           }?>
         </tr>
          <tr>
           <?php
           for($i=61;$i<=70;$i++)
           {
           ?>   
          <td><button onclick="get_question()" id="que_btn" class="btn btn-default btn-sm"><?php echo $i;?></button></td>
           <?php 
           }?>
         </tr>
          <tr>
           <?php
           for($i=71;$i<=80;$i++)
           {
           ?>   
          <td><button onclick="get_question()" id="que_btn" class="btn btn-default btn-sm"><?php echo $i;?></button></td>
           <?php 
           }?>
         </tr>
          <tr>
           <?php
           for($i=81;$i<=90;$i++)
           {
           ?>   
          <td><button onclick="get_question()" id="que_btn" class="btn btn-default btn-sm"><?php echo $i;?></button></td>
           <?php 
           }?>
         </tr>
          <tr>
           <?php
           for($i=91;$i<=100;$i++)
           {
           ?>   
          <td><button onclick="get_question()" id="que_btn" class="btn btn-default btn-sm"><?php echo $i;?></button></td>
           <?php 
           }?>
         </tr>
        
      </table>
    </div>

    <div class="col-sm-8">
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
      <h2>I Love Food</h2>
      <h5><span class="glyphicon glyphicon-time"></span> Post by Jane Dane, Sep 27, 2015.</h5>
      <h5><span class="label label-danger">Food</span> <span class="label label-primary">Ipsum</span></h5><br>
      <p>Food is my passion. Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
      <br><br>
      
      <h4><small>RECENT POSTS</small></h4>
      <hr>
      <h2>Officially Blogging</h2>
      <h5><span class="glyphicon glyphicon-time"></span> Post by John Doe, Sep 24, 2015.</h5>
      <h5><span class="label label-success">Lorem</span></h5><br>
      <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
      <hr>

      <h4>Leave a Comment:</h4>
      <form role="form">
        <div class="form-group">
          <textarea class="form-control" rows="3" required></textarea>
        </div>
        <button type="submit" class="btn btn-success">Submit</button>
      </form>
      <br><br>
      
      <p><span class="badge">2</span> Comments:</p><br>
      
      <div class="row">
        <div class="col-sm-2 text-center">
          <img src="bandmember.jpg" class="img-circle" height="65" width="65" alt="Avatar">
        </div>
        <div class="col-sm-10">
          <h4>Anja <small>Sep 29, 2015, 9:12 PM</small></h4>
          <p>Keep up the GREAT work! I am cheering for you!! Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
          <br>
        </div>
        <div class="col-sm-2 text-center">
          <img src="bird.jpg" class="img-circle" height="65" width="65" alt="Avatar">
        </div>
        <div class="col-sm-10">
          <h4>John Row <small>Sep 25, 2015, 8:25 PM</small></h4>
          <p>I am so happy for you man! Finally. I am looking forward to read about your trendy life. Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
          <br>
          <p><span class="badge">1</span> Comment:</p><br>
          <div class="row">
            <div class="col-sm-2 text-center">
              <img src="bird.jpg" class="img-circle" height="65" width="65" alt="Avatar">
            </div>
            <div class="col-xs-10">
              <h4>Nested Bro <small>Sep 25, 2015, 8:28 PM</small></h4>
              <p>Me too! WOW!</p>
              <br>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<footer class="container-fluid">
  <center><p>Copyright © 2018 Webosys Technologies. All rights reserved.</p></center>
</footer>

</body>
</html>