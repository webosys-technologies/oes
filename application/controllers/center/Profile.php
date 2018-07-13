
  <?php

   if(!defined('BASEPATH')) exit('No direct script access allowed');

//require APPPATH . '/libraries/BaseController.php';

class Profile extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();

               
        $this->load->model('Students_model');
        $this->load->model('Courses_model');
         $this->load->model('Centers_model');
         $this->load->model('System_model');
        $this->load->helper('url');

	}

	public function index()
	{  
        $center_LoggedIn=$this->session->userdata('center_LoggedIn');

        if(isset($center_LoggedIn) || $center_LoggedIn == TRUE)
        {      
          $id=$this->session->userdata('center_id');

            $result['system']=$this->System_model->get_info();
         $result['data']=$this->Centers_model->get_by_id($id);
         //print_r($result['data']);
           
          $this->load->view('center/header',$result);
      	 $this->load->view('center/profile_view');
          $this->load->view('center/footer',$result);



        }
        else
        {
          redirect('center/index/login');
        }


	}

  
 
}



 ?>