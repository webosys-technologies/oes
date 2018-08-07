<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

//require APPPATH . '/libraries/BaseController.php';

/**
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
    public function __construct()
    {
        parent::__construct();
       if(!is_admin_LoggedIn($this->session->userdata('oes_user_LoggedIn')))
     {
         redirect('admin/index');
     }
    }
    
    /**
     * This function used to load the first screen of the user
     */
    public function index()
    {      
        
            $uid=$this->session->userdata('oes_user_id');
            $result['user_data']=get_user_info($uid);             
            $result['centers']=$this->Centers_model->getall();  
            $result['users']=$this->User_model->getall_user();  
            $result['system']=$this->System_model->get_info();
            $result['accounts']=$this->Account_model->get_by_center(array('acc_status >='=>1));
             $result['sub_centers']=$this->Sub_centers_model->getall_sub_center();
             $result['coupons']=$this->Coupons_model->get_allcoupon();
             $result['questions']=$this->Questions_model->get_question_count();
           
            $this->load->view('admin/header',$result);
             $this->load->view('admin/dashboard',$result);
             $this->load->view('admin/footer',$result);
           
    }
    
    /**
     * This function is used to load the user list
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
            
            $resultPas = $this->user_model->matchOldPassword($this->vendorId, $oldPassword);
            
            if(empty($resultPas))
            {
                $this->session->set_flashdata('nomatch', 'Your old password not correct');
                redirect('loadChangePass');
            }
            else
            {
                $usersData = array('password'=>getHashedPassword($newPassword), 'updatedBy'=>$this->vendorId,
                                'updatedDtm'=>date('Y-m-d H:i:s'));
                
                $result = $this->user_model->changePassword($this->vendorId, $usersData);
                
                if($result > 0) { $this->session->set_flashdata('success', 'Password updation successful'); }
                else { $this->session->set_flashdata('error', 'Password updation failed'); }
                
                redirect('loadChangePass');
            }
        }
    }

}

?>