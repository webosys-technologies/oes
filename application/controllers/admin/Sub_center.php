
  <?php if(!defined('BASEPATH')) exit('No direct script access allowed');

//require APPPATH . '/libraries/BaseController.php';

class Sub_center extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
       
      if(!is_admin_LoggedIn($this->session->userdata('oes_user_LoggedIn')))
     {
         redirect('admin/index');
     }
	}

	public function index()
	{  


            $uid=$this->session->userdata('oes_user_id');
          
            $result['user_data']=get_user_info($uid);
            $result['system']=$this->System_model->get_info();
           
            $data['sub_center_data']=$this->Sub_centers_model->getall_sub_centers();
             $data['center_data']=$this->Centers_model->getall();
            
            
          
             $this->load->view('admin/header',$result);
            $this->load->view('admin/sub_centers_view',$data);
           $this->load->view('admin/footer',$result);

         
	}
 

	

	function sub_center_add()
	{
                 $id=$this->input->post('center_id');
                $name=$this->input->post('fullname');
                $sub_center_name=$this->input->post('sub_center_name');
                $check=$this->Sub_centers_model->check_sub_center($sub_center_name,$id);
                if($check==false)
                {                  
            	$data= array(
                'center_id' =>$id,
                'sub_center_fullname' => strtoupper($name),
                'sub_center_name' => strtoupper($sub_center_name),
                'sub_center_created_at' => date('Y-m-d'),
                'sub_center_status'  =>$this->input->post('status') ,
                );
                
                              
                $data['student_id'] = $this->Sub_centers_model->sub_center_add($data);
                 if($data)
                {
                $this->session->set_flashdata('success', 'Sub-Centers Added Successfully');
                }
                  
                echo json_encode(array("status" => TRUE,
                                       ));               
         
                
	}
        else
        {
           echo json_encode(array("error" => "Sub Center already exist",
                                       ));
        }
        }
	
    
  function ajax_edit($id)
    {
            $data = $this->Sub_centers_model->get_id($id);
         
            echo json_encode($data);
    }
    
 
	
    function sub_center_update()
    {       
                 
                $id=$this->input->post('center_id');
                $name=$this->input->post('fullname');
                $sub_center_name=$this->input->post('sub_center_name');
                $check=$this->Sub_centers_model->check_sub_center($sub_center_name,$id);
                if($check==false)
                {
        
            	$data= array(       
                'center_id'=>$id,
                'sub_center_fullname' => strtoupper($name),
                'sub_center_name' => strtoupper($sub_center_name),
                'sub_center_status'  =>$this->input->post('status') ,
                );

                       
                    
                  $result=$this->Sub_centers_model->sub_center_update(array('sub_center_id' => $this->input->post('sub_center_id')), $data);
                 if($result)
                {
                $this->session->set_flashdata('success', 'Sub-Centers Updated Successfully');
                }
                  echo json_encode(array("status" => TRUE,
                                          ));   
                }else{
                   
                    $data1= array(       
                'sub_center_fullname' => strtoupper($name),
                'sub_center_status'  =>$this->input->post('status') ,
                );
                     $res=$this->Sub_centers_model->sub_center_update($id, $data1);
                     if($res)
                     {
                          $this->session->set_flashdata('success', 'Sub-Centers Updated Successfully');
                           echo json_encode(array("status" => TRUE,
                                          ));   
                     }else{
                         echo json_encode(array("error" => "Sub Center already exist",
                                       ));                        
                     }
                }      
                  
    }

    function sub_center_delete($id)
    {
         

        $result=$this->Sub_centers_model->delete_by_id($id);
         if($result)
                {
                $this->session->set_flashdata('success', 'Sub-Centers Deleted Successfully');
                }
        echo json_encode(array("status" => TRUE));
          

    }
    


}

                     



 ?>
