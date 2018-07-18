
  <?php

   if(!defined('BASEPATH')) exit('No direct script access allowed');

//require APPPATH . '/libraries/BaseController.php';

class Profile extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
    if(!is_center_LoggedIn($this->session->userdata('ccc_center_LoggedIn')))
     {
         redirect('center/Index/login');
     }
	}

	public function index()
	{  
             
          $id=$this->session->userdata('center_id');

            $result['system']=$this->System_model->get_info();
        $result['data']=get_center_info($id);
          $this->load->view('center/header',$result);
      	 $this->load->view('center/profile_view');
          $this->load->view('center/footer',$result);

	}

  
 
}



 ?>