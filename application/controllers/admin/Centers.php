<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

//require APPPATH . '/libraries/BaseController.php';

class Centers extends CI_Controller
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
             $data['centers']=$this->Centers_model->getall();       
         
            $result['user_data']=get_user_info($uid);
            $result['system']=$this->System_model->get_info();
         
       
            $this->load->view('admin/header',$result);
            $this->load->view('admin/centers_view',$data);
            $this->load->view('admin/footer',$result);

    
    }
    
    function center_add()
	{
        $id=$this->session->userdata('center_id');
                
                 $form=$this->input->post();
                 $val=$this->center_validation($form);
                 if(!is_array($val))            
                 {
            	$data= array(                
                'center_fname' => strtoupper($this->input->post('center_fname')),
                'center_lname' => strtoupper($this->input->post('center_lname')),
                'center_name' => strtoupper($this->input->post('center_name')),
                'center_email' => $this->input->post('center_email'),
                'center_mobile' => $this->input->post('center_mobile'),
                'center_gender' => $this->input->post('center_gender'),
                'center_dob' 	=> $this->input->post('center_dob'),
                'center_password' => $this->input->post('center_password'),
                'center_address' => $this->input->post('center_address'),
                'center_city' => $this->input->post('center_city'),
                'center_state' => $this->input->post('center_state'),
                'center_askfor_password' =>'disable',
                'center_pincode' =>$this->input->post('center_pincode'),
                'center_created_at' => date('Y-m-d'),
                'center_status'  => '0',
                );
                

               
                $result = $this->Centers_model->center_add($data);
                if($result)
                {
                   
                
                
                $this->session->set_flashdata('success', 'Center added Successfully');
                }
                echo json_encode(array('status'=>true,
                                           ));
                       
                 }else{
                     echo json_encode($val);
                 }
    
                
	}
        
        function center_validation($data)
        {
            $email="";
            $mobile="";
            if($this->Centers_model->check_if_email_exist($data['center_email']))
            {
                $email=true;
            }else{
                $err['email_err']="Email Already Exist";
            }
            
            
            if($this->Centers_model->check_mobile_exist($data['center_mobile']))
            {
                $mobile=true;
            }else{
                $err['mobile_err']="Mobile Already Exist";
            }
            if($email==true && $mobile==true)
            {
                return true;
            }else{
                return $err;
            }
        }
        
            function center_update()
    {
        
            
          
               $data= array(
                
                'center_fname' => strtoupper($this->input->post('center_fname')),
                'center_lname' => strtoupper($this->input->post('center_lname')),
                'center_name' => strtoupper($this->input->post('center_name')),
                'center_email' => $this->input->post('center_email'),
                'center_mobile' => $this->input->post('center_mobile'),
                'center_gender' => $this->input->post('center_gender'),
                'center_dob' 	=> $this->input->post('center_dob'),
                'center_password' => $this->input->post('center_password'),
                'center_address' => $this->input->post('center_address'),
                'center_city' => $this->input->post('center_city'),
                'center_state' => $this->input->post('center_state'),
                'center_pincode' =>$this->input->post('center_pincode'),
                'center_status' =>$this->input->post('status'),
                  );

                    
                  
               
               $result=$this->Centers_model->center_update(array('center_id' => $this->input->post('center_id')), $data);
               if($result)
                {
                $this->session->set_flashdata('success', 'Center Updated Successfully');
                }
               echo json_encode(array('status'=>true,
                                           ));
                               
                
                  
    }
        
         function ajax_edit($id)
    {           
            $data['center'] = $this->Centers_model->get_id($id);
            $data['system']=$this->System_model->get_info();

         
            echo json_encode($data);
    }
        
         function center_delete($id)
    {

        $result=$this->Centers_model->delete_by_id($id);
              if($result)
                {
                $this->session->set_flashdata('success', 'Center Deleted Successfully');
                }
        echo json_encode(array("status" => true));
           // return ['status' => FALSE];

    }
    
     function show_cities($state)
        {
           
            $cities=$this->Cities_model->getall_cities(ltrim($state));
          
            echo json_encode($cities);
        }

	
        
}