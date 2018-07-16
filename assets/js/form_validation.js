function center_form()
{
    
    var fname;
    var lname;
    var email;
    var center_name;
    var mobile;
      
    
    
                     var str_value=$("#fname").val();
                     var length=str_value.length;
                     var alpha_exp=/^[a-zA-Z]+$/;
                     var space_exp=/^\s+$/;
                     
                      if(str_value=="")
                     {
                         $("#fname_err").html("string should not be empty");
                         $("#fname").focus();
                          fname=false;
                          
                     }
                     else
                         if(length<2)
                     {
                          $("#fname_err").html("String should not be single character");
                          $("#fname").focus();
                          fname=false;
                     }
                     else
                         if(space_exp.test(str_value)){
                           $("#fname_err").html("spaces are not allowed");
                           $("#fname").focus();
                           fname=false;
                          }
                      else
                     if(!alpha_exp.test(str_value))
                      {
                       $("#fname_err").html("spaces,Numbers,Symbols and operaters are not allowed.");
                       $("#fname").focus();
                           fname=false;
                      }
                       else
                         
                     {
                         $("#fname_err").html("");
                          fname=true;
                          
                     }
                     
                     var str_value1=$("#lname").val();
                     var length1=str_value1.length1;
                     var alpha_exp1=/^[a-zA-Z]+$/;
                     var space_exp1=/^\s+$/;
                     
                      if(str_value1=="")
                     {
                         $("#lname_err").html("string should not be empty");
                          lname=false;
                          $("#lname").focus();
                     }
                      else
                         if(length1<2)
                     {
                          $("#lname_err").html("String should not be single character");
                          lname=false;
                          $("#lname").focus();
                     }
                     else

                          if(space_exp1.test(str_value1)){
                              $("#lname_err").html("spaces are not allowed");
                          lname=false;
                          $("#lname").focus();
                          }
                      else
                     if(!alpha_exp1.test(str_value1))
                      {
                       $("#lname_err").html("spaces,Numbers,Symbols and operaters are not allowed.");
                        lname=false;
                          $("#lname").focus();
                      }
                       else
                         
                     {
                          $("#lname_err").html("");
                       lname=true;
                     }
                     
                     

                  var str_value=$("#center_name").val();
                     var length=str_value.length;
                     var alpha_exp=/^[a-zA-Z]+$/;
                     var space_exp=/\s/;
                    
                     
                      if(str_value=="")
                     {
                         $("#center_name_err").html("string should not be empty");
                          center_name=false;
                          $("#center_name").focus();
                          
                     }
                      else
                         if(length<2)
                     {
                          $("#center_name_err").html("String should not be single character");
                          center_name=false;
                          $("#center_name").focus();
                     }
                             else
                     if(!alpha_exp.test(str_value))
                      {
                       $("#center_name_err").html("spaces,Numbers,Symbols and operaters are not allowed.");
                          center_name=false;
                          $("#center_name").focus();
                      }
                       else
                         
                     {
                         $("#center_name_err").html("");
                          center_name=true;
                     }
                     
                     
                     
                     var sEmail = $('#email').val();                 
                   var filter = /^[\w\-\.\+]+\@[a-zA-Z0-9\.\-]+\.[a-zA-z0-9]{2,4}$/;
                   if (filter.test(sEmail)) 
                   
                    {       
//                        alert();
                       
                      $('#email_err').html("");
                      email=true;
                      $('#email').focus();
                 
                       }
                    else
                    {
                     
                       $('#email_err').html("Invalid Email Id"); 
                       email=false;
                    }
                    
                    
                  var number=$('#mobile').val();
                  var lenght=number.length;
                  
                  if(isNaN(number))
                  {
                      
                       $('#mobile_err').html("Invalid Mobile Number ");
                       mobile=false;
                       $('#mobile').focus();
                                         
                  }
                  else if(lenght<10 || length>11)
                  { 
                      $('#mobile_err').html("Mobile no digit should be 10 or 11 digit");
                      mobile=false;
                       $('#mobile').focus();
                  }
                  else
                  { 
                      $('#mobile_err').html("");
                    mobile=true;
                  }
     
                     
             


                   if(fname==true && lname==true && center_name==true && email==true && mobile==true)
                        {
                            return true;
                        }else{
                            return false;
                        }
                     
                               
                    
                     
}

function user_form()
{
   
    var fname;
    var lname;
    var email;
    var mobile;
    var password;
            var str_value=$("#fname").val();
                     var length=str_value.length;
                     var alpha_exp=/^[a-zA-Z]+$/;
                     var space_exp=/^\s+$/;
                    
                      if(str_value=="")
                     {
                         $("#fname_err").html("string should not be empty");
                         $("#fname").focus();
                          fname=false;
                         
                     }
                     else
                         if(length<2)
                     {
                          $("#fname_err").html("String should not be single character");
                          $("#fname").focus();
                          fname=false;
                     }
                     else
                         if(space_exp.test(str_value)){
                           $("#fname_err").html("spaces are not allowed");
                           $("#fname").focus();
                           fname=false;
                          }
                      else
                     if(!alpha_exp.test(str_value))
                      {
                       $("#fname_err").html("spaces,Numbers,Symbols and operaters are not allowed.");
                       $("#fname").focus();
                           fname=false;
                      }
                       else
                         
                     {
                         $("#fname_err").html("");
                          fname=true;
                          
                     }
//                     
                     var str_value1=$("#lname").val();
                     var length1=str_value1.length1;
                     var alpha_exp1=/^[a-zA-Z]+$/;
                     var space_exp1=/^\s+$/;
                     
                      if(str_value1=="")
                     {
                         $("#lname_err").html("string should not be empty");
                          lname=false;
                          $("#lname").focus();
                     }
                      else
                         if(length1<2)
                     {
                          $("#lname_err").html("String should not be single character");
                          lname=false;
                          $("#lname").focus();
                     }
                     else

                          if(space_exp1.test(str_value1)){
                              $("#lname_err").html("spaces are not allowed");
                          lname=false;
                          $("#lname").focus();
                          }
                      else
                     if(!alpha_exp1.test(str_value1))
                      {
                       $("#lname_err").html("spaces,Numbers,Symbols and operaters are not allowed.");
                        lname=false;
                          $("#lname").focus();
                      }
                       else
                         
                     {
                          $("#lname_err").html("");
                       lname=true;
                     }
                     
                     
                     
                       
                     var sEmail = $('#email').val();                 
                   var filter = /^[\w\-\.\+]+\@[a-zA-Z0-9\.\-]+\.[a-zA-z0-9]{2,4}$/;
                   if (filter.test(sEmail)) 
                   
                    {       
//                        alert();
                       
                      $('#email_err').html("");
                      email=true;
                      $('#email').focus();
                 
                       }
                    else
                    {
                     
                       $('#email_err').html("Invalid Email Id"); 
                       email=false;
                    }
                    
                    
                  var number=$('#mobile').val();
                  var lenght=number.length;
                  
                  if(isNaN(number))
                  {
                      
                       $('#mobile_err').html("Invalid Mobile Number ");
                       mobile=false;
                       $('#mobile').focus();
                                         
                  }
                  else if(lenght<10 || length>11)
                  { 
                      $('#mobile_err').html("Mobile no digit should be 10 or 11 digit");
                      mobile=false;
                       $('#mobile').focus();
                  }
                  else
                  { 
                      $('#mobile_err').html("");
                    mobile=true;
                  }
                  
                  
                  var pass=$('#password').val();
                  var length=pass.length;
                  
                  if(length<6)
                  {
                      
                       $('#password_err').html("Password Should be Minimum 6 character");
                       password=false;
                       $('#password').focus();
                                         
                  }else{
                       password=true;
                      $('#password_err').html(""); 
                  }
                  
                  
                  
                   if(fname==true && lname==true && email==true && mobile==true && password==true)
                        {
                            return true;
                        }else{
                            return false;
                        }
                     
}

