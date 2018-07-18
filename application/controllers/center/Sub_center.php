
  <?php if(!defined('BASEPATH')) exit('No direct script access allowed');

//require APPPATH . '/libraries/BaseController.php';

class Sub_center extends CI_Controller
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

            $id=$this->session->userdata('ccc_center_id');
            $data['sub_center_data']=$this->Sub_centers_model->get_sub_centers_by_id($id);
            $result['data']=get_center_info($id);
            $result['system']=$this->System_model->get_info();
           
             $this->load->view('center/header',$result);
      		$this->load->view('center/sub_centers_view',$data);
          $this->load->view('center/footer',$result);
     
	}
 

	

	function sub_center_add()
	{
        $id=$this->session->userdata('ccc_center_id');

		         
            
            	$data= array(
                'center_id' =>$id,
                'sub_center_fullname' => strtoupper($this->input->post('fullname')),
                'sub_center_name' => strtoupper($this->input->post('sub_center_name')),
                'sub_center_created_at' => date('Y-m-d'),
                'sub_center_status'  =>$this->input->post('status') ,
                );
                
                              
                $data['student_id'] = $this->Sub_centers_model->sub_center_add($data);
                
                  
                echo json_encode(array("status" => TRUE,
                                       ));
                  
         
                
	}

	
    
  function ajax_edit($id)
    {
            $data = $this->Sub_centers_model->get_id($id);
         
            echo json_encode($data);
    }
    
    function students_data()   //student data by multiple id's
    {
       
         $checked=$this->input->post('cba');
        $ids=array();
        if($checked)
        {
          foreach ($checked as $check ) {
            $ids[]=$check;
          }
         
            $data = $this->Students_model->get_id($ids[0]);
         
            echo json_encode($data);
        }
        else
        {
            echo json_encode(array('error'=>'please select at least one student'));
        }
    }
	
    function sub_center_update()
    {       
                         
            	$data= array(               
                'sub_center_fullname' => strtoupper($this->input->post('fullname')),
                'sub_center_name' => strtoupper($this->input->post('sub_center_name')),
                'sub_center_status'  =>$this->input->post('status') ,
                );

                       
                    
                  $this->Sub_centers_model->sub_center_update(array('sub_center_id' => $this->input->post('sub_center_id')), $data);
                   echo json_encode(array("status" => TRUE,
                                          ));   
                
                  
    }

    function sub_center_delete($id)
    {
         

        $this->Sub_centers_model->delete_by_id($id);
        echo json_encode(array("status" => TRUE));
          

    }
    


}

                     



 ?>
