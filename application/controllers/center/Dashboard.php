<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

//require APPPATH . '/libraries/BaseController.php';

/**
 *
 * Class : User (UserController)
 * User Class to control all user related operations.
 * @author : Kishor Mali
 * @version : 1.1
 * @since : 15 November 2016
 */
//BaseController
class Dashboard extends CI_Controller
{
    /**
     * This is default constructor of the class
     */
     //$center_LoggedIn = $this->session->get_userdata('center_LoggedIn');
        
    public function __construct()
    {
        parent::__construct();
       
       if(!is_center_LoggedIn($this->session->userdata('ccc_center_LoggedIn')))
     {
         redirect('center/Index/login');
     }
    }
    
    /**
     * This function used to load the first screen of the user
     */
    public function index()
    {
       
             $id=$this->session->userdata('ccc_center_id');            
                 
             $result['data']=get_center_info($id);
             $result['courses']=$this->Courses_model->getall_courses();
             $result['sub_centers']=$this->Sub_centers_model->get_sub_centers_by_id($id);
            $result['system']=$this->System_model->get_info();

             $this->load->view('center/header',$result);
             $this->load->view('center/dashboard',$result);
             $this->load->view('center/footer',$result);
      
    }
    
    
    /**
     * This function is used to change the password of the user
     */
    function changePassword()
    {
        $this->load->library('form_validation');
        
        $this->form_validation->set_rules('oldPassword','Old password','required|max_length[20]');
        $this->form_validation->set_rules('newPassword','New password','required|max_length[20]');
        $this->form_validation->set_rules('cNewPassword','Confirm new password','required|matches[newPassword]|max_length[20]');
        
        if($this->form_validation->run() == FALSE)
        {
            $this->loadChangePass();
        }
        else
        {
            $oldPassword = $this->input->post('oldPassword');
            $newPassword = $this->input->post('newPassword');
            
            $resultPas = $this->User_model->matchOldPassword($this->vendorId, $oldPassword);
            
            if(empty($resultPas))
            {
                $this->session->set_flashdata('nomatch', 'Your old password not correct');
                redirect('loadChangePass');
            }
            else
            {
                $usersData = array('password'=>getHashedPassword($newPassword), 'updatedBy'=>$this->vendorId,
                                'updatedDtm'=>date('Y-m-d H:i:s'));
                
                $result = $this->User_model->changePassword($this->vendorId, $usersData);
                
                if($result > 0) { $this->session->set_flashdata('success', 'Password updation successful'); }
                else { $this->session->set_flashdata('error', 'Password updation failed'); }
                
                redirect('loadChangePass');
            }
        }
    }

    
}

?>