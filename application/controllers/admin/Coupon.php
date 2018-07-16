
  <?php if(!defined('BASEPATH')) exit('No direct script access allowed');

//require APPPATH . '/libraries/BaseController.php';

class Coupon extends CI_Controller
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
            $data['coupons']=$this->Coupons_model->getall_Coupons();
             $data['center_data']=$this->Centers_model->getall();
            $result['system']=$this->System_model->get_info();
            $result['user_data']=get_user_info($uid);
          
             $this->load->view('admin/header',$result);
            $this->load->view('admin/coupon_view',$data);
           $this->load->view('admin/footer',$result);

	}
 
            function generate_captcha()
            {
            
            }

	function Coupon_add()
	{
               $id=$this->input->post('center_id');                            
                $code=$this->input->post('coupon_code');
                
                $code_data=array('coupon_code'=>$code,
                                 'center_id'=>$id);
                $check=$this->Coupons_model->check_by_code($code,$id);   
               
                if($check==false)
                {                   
            	$data= array(
                'center_id' =>$this->input->post('center_id'),
                'coupon_code' => strtoupper($code),
                'coupon_min_student'=>$this->input->post('stud_limit'),
                'coupon_percentage' =>$this->input->post('coupon_perc'),
                'coupon_limit' =>$this->input->post('limit'),
                'coupon_valid_from' =>$this->input->post('valid_from'),
                'coupon_valid_to' =>$this->input->post('valid_to'),
                'coupon_created_at' => date('Y-m-d'),
                'coupon_status'  =>$this->input->post('status') ,
                );
                
                              
                $result = $this->Coupons_model->Coupon_add($data);
                 if($result)
                {
                $this->session->set_flashdata('success', 'Coupon Added Successfully');
                }
                  
                echo json_encode(array("status" => TRUE,
                                       ));
                }
                else
                {
                   echo json_encode(array("error" => 'Coupon Code Already Exist',));
                }
         
                
	}

	
    
  function ajax_edit($id)
    {
            $data = $this->Coupons_model->get_id($id);
         
            echo json_encode($data);
    }
    
 
	
    function Coupon_update()
    {       
         $id=$this->input->post('center_id');                            
         $code=$this->input->post('coupon_code');
                
                $code_data=array('coupon_code'=>$code,
                                 'center_id'=>$id);
                $check=$this->Coupons_model->check_by_code($code,$id);   
                             
                if($check==false)
                {                        
            	$data= array(
                'center_id' =>$this->input->post('center_id'),
                'coupon_code' => $code,
                'coupon_percentage' =>$this->input->post('coupon_perc'),
                 'coupon_min_student'=>$this->input->post('stud_limit'),
                'coupon_limit' =>$this->input->post('limit'),
                'coupon_valid_from' =>$this->input->post('valid_from'),
                'coupon_valid_to' =>$this->input->post('valid_to'),
                'coupon_status'  =>$this->input->post('status') ,
                );                   
                  $result=$this->Coupons_model->Coupon_update(array('coupon_id' => $this->input->post('coupon_id')), $data);
                 if($result)
                {
                $this->session->set_flashdata('success', 'Coupon Updated Successfully');
                }
                  echo json_encode(array("status" => TRUE,
                            ));   
                }
                else
                {                   
                  $data1=array( 'coupon_percentage' =>$this->input->post('coupon_perc'),
                'coupon_limit' =>$this->input->post('limit'),
                 'coupon_min_student'=>$this->input->post('stud_limit'),
                'coupon_valid_from' =>$this->input->post('valid_from'),
                'coupon_valid_to' =>$this->input->post('valid_to'),
                'coupon_status'  =>$this->input->post('status') ,
                               ); 
                  $result1=$this->Coupons_model->Coupon_update(array('coupon_id' => $this->input->post('coupon_id')), $data1);
                 if($result1)
                {
                $this->session->set_flashdata('success', 'Coupon Updated Successfully');
                echo json_encode(array("status" => TRUE,
                            )); 
                }
                else{
                    
                  echo json_encode(array('error' => $code.' Code Already Exist ...!',));
                }
                }
                
                  
    }

    function Coupon_delete($id)
    {
         

        $result=$this->Coupons_model->delete_by_id($id);
         if($result)
                {
                $this->session->set_flashdata('success', 'Coupon Deleted Successfully');
                }
        echo json_encode(array("status" => TRUE));
          

    }
    public function coupon_table()
  {
      $res=$this->Coupons_model->coupon_table();
  
      if($res)
       {
           redirect('admin/Coupon/index');
       }
  }


}

                     



 ?>
