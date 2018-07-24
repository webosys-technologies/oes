<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

 class Payment extends CI_Controller {

	public function __construct() {
        parent::__construct();
         if(!is_admin_LoggedIn($this->session->userdata('oes_user_LoggedIn')))
     {
         redirect('admin/index');
     }
      
    }

    public function index()
    {
      
                
            $data['payment']=$this->Payment_model->getall_payment();
            $uid=$this->session->userdata('oes_user_id');
            $result['user_data']=get_user_info($uid);
            $result['system']=$this->System_model->get_info();
           
       
            $this->load->view('admin/header',$result);
            $this->load->view('admin/payment_view',$data);
            $this->load->view('admin/footer',$result);

    }
    
    public function book_view()
    {
        $user_LoggedIn=$this->session->userdata('user_LoggedIn');
        if(isset($user_LoggedIn) || $user_LoggedIn == TRUE)
        {
                
            $data['payment']=$this->Order_details_model->getall_book_buyers();
            $uid=$this->session->userdata('user_id');
            $result['system']=$this->System_model->get_info();
            $result['user_info']=$this->User_model->get_user_by_id($uid);
       
            $this->load->view('admin/header',$result);
            $this->load->view('admin/order_book_view',$data);
            $this->load->view('admin/footer',$result);

        }
        else
        {
            redirect('admin/index/login');
        }
    }

    

	  
   }

   ?>