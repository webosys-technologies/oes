<?php defined('BASEPATH') OR exit('No direct script access allowed');
class Index extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		
        }
	
	function index()
	{
		$this->load->view('admin/login');
	}
        
       
        
        function login()
    {
             $user_LoggedIn = $this->session->userdata('oes_user_LoggedIn');
        
        if(isset($user_LoggedIn) || $user_LoggedIn == TRUE)
        {
           redirect('admin/Dashboard');
        }
        else
        {
            redirect('admin/Index');
            
        }
    }
    
    
    
    
    public function loginMe()
    {
        
        $this->load->library('form_validation');
        
      //  $this->form_validation->set_rules('email', 'Username', 'callback_username_check');
        $this->form_validation->set_rules('user_email', 'Email', 'required|valid_email|max_length[128]|trim');
        $this->form_validation->set_rules('user_password', 'Password', 'required|max_length[32]');
        
        if($this->form_validation->run() == FALSE)
        {
            redirect('admin/Index');
        }
        else  
        {
            $user_email = $this->input->post('user_email');
            $user_password = $this->input->post('user_password');
            list($result,$getdata,$valid_email) = $this->User_model->loginMe($user_email, $user_password);  
            
            foreach($getdata as $res)  
         {   
            $status=array('user_status'=>$res->user_status);
        }
        
       if($valid_email>0)
       {
           
            
            
            if($result > 0 && $status['user_status']==1)
            {
               foreach ($getdata as $res)
                {
                    $sessionArray = array(
                        
                         'oes_user_id' => $res->user_id,
                    'oes_user_fname' => $res->user_fname,
                    'oes_user_lname' => $res->user_lname,
                    'oes_user_email' => $res->user_email,
                    'oes_user_mobile' =>$res->user_mobile,
                    'oes_user_LoggedIn' => true
                                    );
                                    
                    $this->session->set_userdata($sessionArray);  
                    
                    redirect('admin/Dashboard');
                  
               }
              }
            else
            {
                $this->session->set_flashdata('error', 'Email or password mismatch');
                
                if($result > 0 && $status['user_status']==0)
                {
                 $this->session->set_flashdata('error', 'This email is not active');
                }
                
                redirect('admin/Index/Login');  
            }  
        }
        else
        {
             $this->session->set_flashdata('error', 'This email id is not registered with us.');
                 redirect('admin/Index/Login'); 
        }
        }
    }
    
    
     public function signout()
    {
    
        
//        $this->session->sess_destroy();
         $this->session->unset_userdata('oes_user_LoggedIn'); 
        redirect('admin/Index/login');  
    }
    public function user_profile_pic()
    {
        $this->User_model->user_profile_pic();
    }
    
    public function show_cities($id)
    {
        $result=$this->Location_model->getall_cities($id);
        echo json_encode($result);
    }
    
        
}