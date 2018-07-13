
  <?php if(!defined('BASEPATH')) exit('No direct script access allowed');

//require APPPATH . '/libraries/BaseController.php';

class System extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
       

        $this->load->model('User_model');
        $this->load->model('System_model');
        $this->load->library('session');
        $this->load->helper(array('form', 'url','file'));

        


		
	}

	public function index()
	{  


        $user_LoggedIn=$this->session->userdata('user_LoggedIn');

        if(isset($user_LoggedIn) || $user_LoggedIn == TRUE)
        { 
            $id=$this->session->userdata('user_id');
//            $data['system_data']=$this->System_model->getall_systems();
             $data['system_data']=$this->System_model->get_system_by_id($id);
            $result['user_info']=$this->User_model->get_user_by_id($id);
          
             $this->load->view('admin/header',$result);
            $this->load->view('admin/system_view',$data);
           $this->load->view('admin/footer');

          }
        else{
          redirect('admin/index/login');
        }


	}
 

	

	function system_add()
	{
                 $id=$this->input->post('user_id');
                 $type=$this->input->post('system_type');
                  $desc=$this->input->post('system_desc');
                   $nick=$this->input->post('system_nick');
                $name=$this->input->post('system_name');
                 $email=$this->input->post('system_email');
                  $email2=$this->input->post('system_email2');
                   $site=$this->input->post('system_site');
                    $ph=$this->input->post('system_ph');
                     $mob=$this->input->post('system_mod');
                      $addr=$this->input->post('system_addr');
                       $pin=$this->input->post('system_pin');
                        $city=$this->input->post('system_city');
                         $pay=$this->input->post('system_pay_gateway');
                          $merch_id=$this->input->post('system_merch_id');
                           $merch_name=$this->input->post('system_merch_name');
                  $name=$this->input->post('system_name');
                $check=$this->System_model->check_system($system_name,$id);
                if($check==false)
                {                  
            	$data= array(
                'center_id' =>$id,
                'system_fullname' => strtoupper($name),
                'system_name' => strtoupper($system_name),
                'system_created_at' => date('Y-m-d'),
                'system_status'  =>$this->input->post('status') ,
                );
                
                              
                $data['student_id'] = $this->System_model->system_add($data);
                 if($data)
                {
                $this->session->set_flashdata('success', 'System Added Successfully');
                }
                  
                echo json_encode(array("status" => TRUE,
                                       ));               
         
                
	}
        else
        {
           echo json_encode(array("error" => "System already exist",
                                       ));
        }
        }
	
    
  function ajax_edit($id)
    {
            $data = $this->System_model->get_id($id);
         
            echo json_encode($data);
    }
    
 
	
    function system_update()
    {       
                 
               $id=$this->input->post('user_id');
                 $type=$this->input->post('system_type');
                  $desc=$this->input->post('system_desc');
                   $nick=$this->input->post('system_nick');
                $name=$this->input->post('system_name');
                 $email=$this->input->post('system_email');
                  $email2=$this->input->post('system_email2');
                   $site=$this->input->post('system_site');
                    $ph=$this->input->post('system_ph');
                     $mob=$this->input->post('system_mod');
                      $addr=$this->input->post('system_addr');
                       $pin=$this->input->post('system_pin');
                        $city=$this->input->post('system_city');
                         $pay=$this->input->post('system_pay_gateway');
                          $merch_id=$this->input->post('system_merch_id');
                           $merch_name=$this->input->post('system_merch_name');
                           
                $check=$this->System_model->check_system($system_name,$id);
                if($check==false)
                {
        
            	$data= array(       
                'center_id'=>$id,
                'system_fullname' => strtoupper($name),
                'system_name' => strtoupper($system_name),
                'system_status'  =>$this->input->post('status') ,
                );

                       
                    
                  $result=$this->System_model->system_update(array('system_id' => $this->input->post('system_id')), $data);
                 if($result)
                {
                $this->session->set_flashdata('success', 'System Updated Successfully');
                }
                  echo json_encode(array("status" => TRUE,
                                          ));   
                }else{
                   
                    $data1= array(       
                'system_fullname' => strtoupper($name),
                'system_status'  =>$this->input->post('status') ,
                );
                     $res=$this->System_model->system_update($id, $data1);
                     if($res)
                     {
                          $this->session->set_flashdata('success', 'System Updated Successfully');
                           echo json_encode(array("status" => TRUE,
                                          ));   
                     }else{
                         echo json_encode(array("error" => "System already exist",
                                       ));                        
                     }
                }      
                  
    }

    function system_delete($id)
    {
         

        $result=$this->System_model->delete_by_id($id);
         if($result)
                {
                $this->session->set_flashdata('success', 'System Deleted Successfully');
                }
        echo json_encode(array("status" => TRUE));
          

    }
    


}

                     



 ?>
