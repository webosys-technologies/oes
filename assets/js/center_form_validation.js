function centers_sub_center_validation()
{
   
         if ($("#fullname").val() == ""){
            $("#fullname_err").html("Please Enter Full Name");
          }else{
              var fullname="true";
              $("#fullname_err").html("");
          }
          
          if ($("#sub_center_name").val() == ""){
            $("#sub_center_name_err").html("Please Enter Sub Center Name");
          }else{
              var center_name="true";
              $("#sub_center_name_err").html("");
          }
        
        if(fullname=="true" && center_name=="true")
          {
             return true;
        }else{
            return false;
        }
   }