    <?php defined('BASEPATH') OR exit('No direct script access allowed');
class Index extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		
                 
	}
       
	
	function index()
	{
	    	
            $this->register();
	}

    function register()
    {
		$this->load->library('form_validation');

		$this->form_validation->set_rules('center_fname','Name','trim|required');
		$this->form_validation->set_rules('center_lname','Last_name','trim|required');
		$this->form_validation->set_rules('center_name','center_name','trim|required');
		$this->form_validation->set_rules('center_email','Email','trim|required|valid_email|callback_check_if_email_exist');
		$this->form_validation->set_rules('center_mobile','Mobile','trim|required|numeric');
		$this->form_validation->set_rules('center_gender','Gender','required');
		$this->form_validation->set_rules('center_password','Password','trim|required|min_length[8]');
		$this->form_validation->set_rules('center_cpassword','Confirm Password','trim|required|matches[center_password]');  
		$this->form_validation->set_rules('center_address','Address','trim|required');
		$this->form_validation->set_rules('center_city','City','trim|required');
		$this->form_validation->set_rules('center_pincode','Pincode','trim|required|numeric');
		$this->form_validation->set_rules('center_state','State','trim|required');   
                
		//validate form input
		if ($this->form_validation->run() == false)
        {
			
		
                $this->load->view('center/signup');     
                
                    
        }
        else
		{
                   
            
			list($get_insert,$get_data)=$this->Centers_model->register();
			if($get_insert)
			{
                           
                            
				$msg=array(
                                    'title'=>'Delto Center Registration...!',
                                    'data'=>'Your Center Registration Successfully with delto',
                                    'email'=>$get_data['center_email']
                                          );
//				 echo $get_data['center_mobile']."<br>";
//                                 die;
//                               $result=$this->signup_email($get_data,$msg);
//                               $this->verification_email($get_data,$msg);
//                                $user_email=$this->User_model->getall_email();
//                            foreach ($user_email as $mail)
//                            {
//                                $this->center_registration_mail_to_admin($mail->user_email,$get_data);
//                            }
                               if(true)
                                {                                  
                                  $this->session->set_flashdata('signup_success','Registration Successfull,please check email & verify your Account!');
                                  $this->session->unset_userdata('center_otp');                                  
                                    $this->session->set_flashdata('mobile',$get_data['center_mobile']);
                                  $otp_val=$this->send_otp($get_data['center_mobile']); 
                                  if($otp_val)
                                  {
                                  $this->session->set_flashdata('otp_modal','success');
                                  }
                                  redirect('center/index/login');
                                }
                                else
                                {                                  
                                $this->session->set_flashdata('signup_error','please Enter Valid Email...!');                                    
                                $this->load->view('center/signup');
                                }

			}
			else
                            {                          
                           
				$this->load->view('center/signup');
			}

		
                
             }    
        }
        
   
              
   function login()
    {
             $center_LoggedIn = $this->session->userdata('oes_center_LoggedIn');
        
        if(isset($center_LoggedIn) || $center_LoggedIn == TRUE)
        {
           redirect('center/dashboard');
        }
        else
        {
           
          
             $this->load->view('center/login');
            
        }
    }
    function center_encrypt($email,$hash)
    {
        $data=array('center_verification'=>$hash);
        $center_email=array('center_email'=>$email);
        $this->Centers_model->center_update($center_email,$data);
    }
    function resend_email($center_email)
    {
        $get_data=$this->Centers_model->get_data_by_email($center_email);
        $msg=array(
                                    'title'=>'Delto Center Verification...!',
                                    'data'=>'Your Center Registration Successfully with delto',
                                    'email'=>$center_email
                                );
         
         $center_data=array('center_fname'=>$get_data->center_fname,
             'center_lname'=>$get_data->center_lname,
             'center_mobile'=>$get_data->center_mobile,
             'center_password'=>$get_data->center_password,
             'center_name'=>$get_data->center_name,
             'center_email'=>$center_email);
         
       
        $result=$this->verification_email($center_data,$msg);
        if($result==true)
        {
           $this->session->set_flashdata('signup_success','Verification code send successfully,please check & verify your email!');
                                
             redirect('center/index/login'); 
        }
        else
        {
            redirect('center/index/login');
        }
    }
    
    function verification_email($getdata,$msg)
    {
         $hash= md5( rand(0,1000) );
                 $this->center_encrypt($getdata['center_email'],$hash);
                
                    $headers = "From: no-reply@delto.in";
                    $headers .= ". DELTO-Team" . "\r\n";
                    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
                    $to = $msg['email'];
                    $subject = "Delto.in - Account verification";

                    $txt = '<html>
                        <head>
                                            <style>
                                            .button {
                                                background-color: #4CAF50; 
                                                border: none;
                                                color: white;
                                                padding: 20px;
                                                text-align: center;
                                                text-decoration: none;
                                                display: inline-block;
                                                font-size: 16px;
                                                margin: 4px 2px;
                                                cursor: pointer;
                                            }
                                            .button3 {border-radius: 8px;}


                                             .div1 {
                                           
                                                   width: 100%;
                                                   border-radius: 5px;
                                                   background-color: #3c8dbc;
                                                   padding: 20px;
                                               }
                                                .div2 {

                                                   width: 100%;
                                                   border-radius: 5px;
                                                   background-color: #d2d6de;
                                                   padding: 20px;
                                               }
                                               #color{
                                               color:blue;
                                               }
                                            </style>
                                        </head>
                                             <body><div class="div1"><h2>Delto Center Verification...!<h2></div><div class="div2">Dear'." ".$getdata['center_fname']." ".$getdata['center_lname'].',<br><br> We are ready to activate your account.Simply Please Verify your email Address.<br><br><br>
                                            
                                              <center><a  href="'.base_url().'center/index/center_verification/'.$getdata['center_email'].'/'.$hash.'">Click here to verify your account </a></center>'
                            . '          <br>Best Regards,<br>Delto Team<br><a href="http://delto.in">http://delto.in</a><br> </div></body></html>';
                              
                                              
                                            
                 
                       $success=  mail($to,$subject,$txt,$headers); 
                       if($success)
                       {
                          return true;
                       }
    }
    
    function signup_email($getdata,$msg)
    {    
               
                 $hash= md5( rand(0,1000) );
                 $this->center_encrypt($getdata['center_email'],$hash);
                
                    $headers = "From: support@delto.in";
                    $headers .= ". DELTO-Team" . "\r\n";
                    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
                    $to = $msg['email'];
                    $subject = "Welcome To Delto.in";

                    $txt = '<html>
                        <head>

                                        </head>
                                             <body>Dear '.$getdata['center_fname'].' '.$getdata['center_lname'].',<br><br>Thank You for sign up with delto.<br><br>You can now login with following login details<br><br>
                                            
                                            Name: '.$getdata['center_fname']." "
                                             .$getdata['center_lname'].
                                             "<br>Center Name: ".$getdata['center_name'].
                                             '<br>Center Login URL: <a href="http://delto.in/center/index/login">http://delto.in/center/index/login</a>
                                             <br>Email Id: '.$getdata['center_email'].
                                              "<br>Password: ".$getdata['center_password'].
                                              '<br><br>Thanks & Regards,<br>Delto Team<br><a href="http://delto.in">http://delto.in</a><br></body></html>';
                              
                                              
                                            
                 
                       $success=  mail($to,$subject,$txt,$headers); 
                       if($success)
                       {
                          return true;
                       }
//                   
    }
    
   function center_registration_mail_to_admin($user_email,$center_data)
    {
        
       $headers = "From: team@webosys.com";
                    $headers .= ". Webosys-Team" . "\r\n";
                    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
                    $to =$user_email;
                    $subject = 'New Center Registration at Delto';

                    $txt = '<html><body>
                           <span>Dear Delto,</span><br><br> 

                            <span> New Center Successfully registered at Delto as per following detail </span><br><br>

                            <span><b>Center Information:</b></span><br>
                            <span>Center Name: '.$center_data['center_name'].'</span><br>
                            <span>Center Owner: '.$center_data['center_fname']." ".$center_data['center_lname'].'</span><br> 
                            <span>Center Contact: '.$center_data['center_mobile'].'</span><br>    
                            <span>Center Email: '.$center_data['center_email'].'</span><br>  <br>  


                            <span>Thanks & regards,</span><br>
                            <span>Webosys team.</span><br>
                            <a href="mailto:team@webosys.com" target="_top">team@webosys.com</a>
                             </body></html>';
                              
                                              
                                            
                 
                       $success=  mail($to,$subject,$txt,$headers); 
                       if($success)
                       {
//                           echo "success";
                          return true;
                       }else{
                           return false;
                       }
       
       
    }
    
    
    
    function otp_email($getdata,$msg)
    {
                 
                    $headers = "From: admin@webosys.com";
                    $headers .= "MIME-Version: 1.0" . "\r\n";
                    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
                    $to = $msg['email'];
                    $subject = "Delto";
                    $txt='<html>
                        <head>
                                            <style>
                                            

                                             .div1 {
                                           
                                                   width: 100%;
                                                   border-radius: 5px;
                                                   background-color: #3c8dbc;
                                                   padding: 20px;
                                               }
                                                .div2 {

                                                   width: 100%;
                                                   border-radius: 5px;
                                                   background-color: #d2d6de;
                                                   padding: 20px;
                                               }
                                               #color{
                                               color:blue;
                                               }
                                            </style>
                                        </head>
                                             <body><div class="div1"><h2>'.$msg['title'].'</h2></div>
                                                                                       
                                             
                            <div class="div2">Dear Customer,<br><b>Center Name :</b>'.$getdata['center_name'].'<br><br>'.$msg['data'].'<b id="color"> '.$getdata['otp'].'</b><br><br>
                                              Best Regards,<br>Delto Team<br><a href="http://delto.in">http://delto.in</a><br>
                                               <a href="'.base_url().'center/index/login">Sign In</a> </div></body></html>';                               
                                      
                                                                                                     
                     $success=  mail($to,$subject,$txt,$headers); 
                       if($success)
                       {
                           
                           redirect('center/index/login');
                       }
                       else
                       {
                            redirect('center/index/login');
                       }
                  
             
    }
    
    
    
     function password_email($getdata,$msg)
    {
       
                
                    $headers = "From: admin@webosys.com";
                    $headers .= "MIME-Version: 1.0" . "\r\n";
                    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
                    $to = $msg['email'];
                    $subject = "Delto";
                    $txt='<html>
                        <head>
                                            <style>
                                            

                                             .div1 {
                                           
                                                   width: 100%;
                                                   border-radius: 5px;
                                                   background-color: #3c8dbc;
                                                   padding: 20px;
                                               }
                                                .div2 {

                                                   width: 100%;
                                                   border-radius: 5px;
                                                   background-color: #d2d6de;
                                                   padding: 20px;
                                               }
                                               #color{
                                               color:blue;
                                               }
                                            </style>
                                        </head>
                                             <body><div class="div1"><h2>'.$msg['title'].'</h2></div>
                                                                                       
                                             
                            <div class="div2">Dear Customer,<br>'.$get_data['center_name'].'<br>'.$msg['data'].'<br>
                            <br><b>Username :</b>'.$msg['email'].
                                              "<br><b>New Password :</b>".$msg['password'].'
                                               <br>Thank You,<br>
                                               Webosys Team,<br>
                                               <a href=http:"'.base_url().'center/index/login">Sign In</a> </div></body></html>';
                                                
                                      
                                            
                                                         
                    $success=  mail($to,$subject,$txt,$headers); 
                      
                     if($success)
                   {
                          $this->session->set_flashdata('signup_success','Password changed successfully...!');
                       redirect('center/index/login');
                   }
             
    }
    
    
    
    
    
    
     public function loginMe()
    {
        
        $this->load->library('form_validation');
        
      //  $this->form_validation->set_rules('email', 'Username', 'callback_username_check');
        $this->form_validation->set_rules('center_email', 'Email', 'required|valid_email|max_length[128]|trim');
        $this->form_validation->set_rules('center_password', 'Password', 'required|max_length[32]');
        
        if($this->form_validation->run() == FALSE)
        {
            $this->login();
        }
        else  
        {
            $center_email = $this->input->post('center_email');
            $center_password = $this->input->post('center_password');
            list($result,$getdata,$valid_email) = $this->Centers_model->loginMe($center_email, $center_password);  
         foreach($getdata as $res)  
         {   
            $status=array('center_status'=>$res->center_status);
         }
        
       if($valid_email>0)
       {
           
         
                
            if($result > 0 && $status['center_status']==1)
            {
               foreach ($getdata as $res)
                {
                    $sessionArray = array(
                        
                         'oes_center_id' => $res->center_id,
                    'oes_center_fname' => $res->center_fname,
                    'oes_center_lname' => $res->center_lname,
                    'oes_center_email' => $res->center_email,
                     'oes_center_name'=>$res->center_name,
                     'oes_center_mobile' =>$res->center_mobile,
                    'oes_center_LoggedIn' => true
                                    );
                                    
                    $this->session->set_userdata($sessionArray);  
                    
                    redirect('center/dashboard');
                  
                  
               }
              }
              
           
            else
            {   
                             
                if($result > 0 && $status['center_status']==0)
                {
                                  $this->session->unset_userdata('center_otp');                                  
                                    $this->session->set_flashdata('mobile',$res->center_mobile);
                                  $otp_val=$this->send_otp($res->center_mobile); 
                                  if($otp_val)
                                  {
                                  $this->session->set_flashdata('otp_modal','success');
                                  }
                    
                   
                 $this->session->set_flashdata('log_error', 'Account is not activeted yet.');
                 $this->session->set_flashdata('center_email', $center_email);
                }
                else
                {
                    $this->session->set_flashdata('error', 'Email or password mismatch');
                }
                
                redirect('center/index/login');  
            } 
            }
            else
            {
                 $this->session->set_flashdata('error', 'This email id is not registered with us.');
                 redirect('center/index/login'); 
            }
        
        }
    }
    
    
    
       
        function send_otp($mobile)
        {           
                    
                     $rand=mt_rand(000000,999999);
                     $this->session->set_userdata(array('center_otp'=>$rand));
                        //Your authentication key

                   $authKey = "217899AjUpTycrXx6K5b0e2283";    //suraj9195shinde for

                   //Multiple mobiles numbers separated by comma

                   $mobileNumber = $mobile;
                   //Sender ID,While using route4 sender id should be 6 characters long.

                   $senderId = "DELTO2";
                   //Your message to send, Add URL encoding here.

                   $message =$rand.' is your OTP for Activating Account on DELTO';


                   //Define route 

                   $route = "4";
                   //Prepare you post parameters

                   $postData = array(

                       'authkey' => $authKey,

                       'mobiles' => $mobileNumber,

                       'message' => $message,

                       'sender' => $senderId,

                       'route' => $route

                   );


                   //API URL

                   $url="http://api.msg91.com/api/sendhttp.php";


                   // init the resource

                   $ch = curl_init();
                   curl_setopt_array($ch, array(

                       CURLOPT_URL => $url,

                       CURLOPT_RETURNTRANSFER => true,

                       CURLOPT_POST => true,

                       CURLOPT_POSTFIELDS => $postData

                       //,CURLOPT_FOLLOWLOCATION => true

                   ));
                   //Ignore SSL certificate verification
                   curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
                   curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);

                   //get response

                   $output = curl_exec($ch);
                   //Print error if any
                   if(curl_errno($ch))
                   {
                       echo json_encode(array('error'=> curl_error($ch)));
                   }else{
                   curl_close($ch);
//                   echo json_encode(array('send'=>'OTP is sent Successfully'));       
                   //echo $output;   
                   return true;
                   }
                   
        }
        
        
    function activate_account()
    {
         $otp=$this->input->post('otp');
         $mobile=$this->input->post('mobile');
        if(!empty($otp) && $otp==$this->session->userdata('center_otp'))
        {
            $where=array('center_mobile'=>$mobile);
            $data=array('center_status'=>1);
            $this->Centers_model->center_update($where,$data);
            $this->session->set_flashdata('email_verify','Account Verification Successfull,Please Login...!');
            echo json_encode(array('status'=>true));
         }else{
              echo json_encode(array('otp_error'=>"Please Enter Correct OTP"));
         }
    }
    
    
    public function forgotPassword()
    {
        $this->load->view('center/forgotPassword');
    }
    
    /**
     * This function used to generate reset password request link
     */
    function resetPasswordUser()
    {
        $status = '';
        
        $this->load->library('form_validation');
        
        $this->form_validation->set_rules('center_email','Email','trim|required|valid_email');
                
        if($this->form_validation->run() == FALSE)
        {
            //$this->forgotPassword();
             $this->session->set_flashdata('error', 'Invalid Email ID');
//            redirect('center/index/forgotPassword');
       
            echo json_encode(array('status'=>false));
        }
        else 
        {
             
            $center_email= $this->input->post('center_email');
            list($get_result,$get_data)=$this->Centers_model->checkEmailExist($center_email);
         
            if($get_result>0)
            {  
                $msg=array(
                    'title'=>"Delto Center Verification",
                    'data'=>'Your Center Verification OTP is: ',
                    'email'=>$get_data['center_email']
                );
//               
               $this->otp_email($get_data,$msg);

                 $data=array(
                              'id'=>$get_data['center_id'],
                              'email'=> $get_data['center_email'],
                              'activation_id' =>$get_data['otp'],
                              'createdDtm' => date('Y-m-d H:i:s'),
                     );

                $save = $this->Centers_model->resetPasswordUser($data); 
                
           
                echo json_encode(array('status'=>true));
                
                
              
            }
            else
            {
                 $this->session->set_flashdata('error', 'This Email ID is not registered with us.');
                echo json_encode(array('status'=>false));

            }
             
        
        } 
    }
    function reset_password()
    {
        $this->form_validation->set_rules('center_password','Password','trim|required|min_length[8]');
        $this->form_validation->set_rules('center_cpassword','Confirm Password','trim|required|matches[center_password]');
        if ($this->form_validation->run() == false)
        {                  $status = 'invalid';
			 setFlashData($status, "Password and Confirm Password Does not match.");
			 redirect('center/index/forgotPassword');
                 
                    
        } 
        else
        {
        
       
        $form_otp=$this->input->post('otp');
        $center_email=$this->input->post('email');
         list($get_otp,$center_data)=$this->Centers_model->otp_verify($center_email);
        $password=$this->input->post('center_password');
        
        if($form_otp==$get_otp['otp'])
        {
//            echo"success";
            $data=array(
                        'center_email'=>$center_email,
                        'password'=>$password
                       
            );
             $result=$this->Centers_model->reset_password($data);
             if($result)
             {
                 $msg=array(
                     'title'=>'Delto center Updation...!',
                     'data'=>'Your delto center password has been changed successfully.',
                     'password'=>$password,
                     'email'=>$center_email,
                     'center_name'=>$center_data['center_name']
                     
                 );
               
                 
                $this->password_email($center_data,$msg);
                 
                redirect('center/index/login');
             }
        }
        else
        {

            $this->session->set_flashdata('error', 'OTP does not match');
            redirect('center/index/forgotPassword');
        }
        }
        
        
    }
    
    
       
     public function signout()
    {
    
        
//        $this->session->sess_destroy();
          $this->session->unset_userdata('oes_center_LoggedIn'); 
        redirect('center/index/login');  
    }
    
        
    
        
        
  function check_if_email_exist($requested_email)
	{
		$this->load->model('Centers_model');
		$email_available=$this->Centers_model->check_if_email_exist($requested_email);

		if($email_available){
                    $this->form_validation->set_message('check_if_email_exist', 'You must select a business');
			return TRUE;
		}
		else{
			return FALSE;
		}
	}

  public function ajax_edit($id)
  {

            $data = $this->Centers_model->get_id($id);
         
            echo json_encode($data);
  }

  public function update_profile()
        {
             $center_LoggedIn = $this->session->userdata('center_LoggedIn');
             
        
        if(isset($center_LoggedIn) || $center_LoggedIn == TRUE)
        {
                $id=$this->session->userdata('center_id');
                      
                      
             
                     
                      $data= array(
                'center_id'=>$this->input->post('center_id'),
                'center_fname' => strtoupper($this->input->post('center_fname')),
                'center_lname' => strtoupper($this->input->post('center_lname')),
                'center_email' => $this->input->post('center_email'),
                'center_mobile' => $this->input->post('center_mobile'),
                'center_address' => $this->input->post('center_address'),                
                
                
                );

                $res=$this->pic_upload($data);
                
                     
                  $this->Centers_model->center_update(array('center_id' => $this->input->post('center_id')), $data);
                   echo json_encode(array("status" => TRUE));
              
                     
                      
            

        }
        else
        {
            $this->load->view('student/login');
            

        }                     
        }
        
         function pic_upload($data)
    {  
       $id=$data['center_id'];
       
                                   $new_file=$data['center_fname'].mt_rand(100,999);
       
         $config = array(
                                  'upload_path' => './profile_pic',
                                  'allowed_types' => 'gif|jpg|png|jpeg',
                                  'max_size' => '7200',
                                  'max_width' => '1920',
                                  'max_height' => '1200',
                                  'overwrite' => false,
                                  'remove_spaces' =>true,
                                  'file_name' =>$new_file 
                              );           
                      
                    
                                  
                       $this->load->library('upload', $config);
                       $this->upload->initialize($config);
                       
                       if (!$this->upload->do_upload('img')) # form input field attribute
                       {
                           if(empty($this->input->post('img')))
                           {
                                $msg="Image size should less than 7MB,Dimension 1920*1200";
                           return $msg; 
                            
                           }
                           else
                           {
                                   return true;                    
                           }
                         
                       }
                       else
                       {
                        
                            $res=$this->Centers_model->get_id($this->input->post('center_id'));
                            if(file_exists($res->center_profile_pic))
                            {
                            unlink($res->center_profile_pic);
                            }
                                               
                           
                            $ext= explode(".",$this->upload->data('file_name'));  
                            $img_name =$new_file.".".end($ext); //video name as path in db
                             $img_path='profile_pic/'.str_replace(' ','_',$img_name);
                          $pic = array(
                              'center_profile_pic' => $img_path,
                            );
            
                                  
                                    
                   $insert =  $this->Centers_model->center_update(array('center_id' =>$id), $pic);
                          
                         return true; 
                                               
                       }

        

            
    }
        function center_verification($email,$hash)
        {
           $verify=$this->Centers_model->email_verification($email,$hash);
           if($verify)
           {
               $this->session->set_flashdata('email_verify','Account Verification Successfull,Please Login...!');
               redirect('center/index/login');
           }
           else
           {
                $this->session->set_flashdata('email_verify','Error...Please Resend link while login...!');
               redirect('center/index/login');
           }
      
                             
        }
        
        function show_cities($state)
        {
           
            $cities=$this->Cities_model->getall_cities(ltrim($state));
            echo json_encode($cities);
        }
        
        
        
        
        public function delete_photo()
        {
            $this->load->helper("file");
         
         if($s)
         {
             echo "success";
         }
         else
         {
             echo"false";
         }
        }	
    
}


  
    
    

