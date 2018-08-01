
  <?php

   if(!defined('BASEPATH')) exit('No direct script access allowed');

//require APPPATH . '/libraries/BaseController.php';

class Setting extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
 if(!is_center_LoggedIn($this->session->userdata('oes_center_LoggedIn')))
     {
         redirect('center/Index/login');
     }

	}

	public function index()
	{  
        $id=$this->session->userdata('oes_center_id');            
                 
             $result['data']=get_center_info($id);            
            $result['system']=$this->System_model->get_info();
        
           
          $this->load->view('center/header',$result);
      	 $this->load->view('center/setting_view',$result);
          $this->load->view('center/footer',$result);


	}
        
        public function center_askfor_password($ask_value)
        {
            $id=$this->session->userdata('oes_center_id');
            $res=$this->Centers_model->center_askfor_password($ask_value,$id);
            
            echo json_encode(array('ch_val'=>$ask_value));
            
        }

  
 
}



 ?>