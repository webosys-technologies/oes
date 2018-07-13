
  <?php if(!defined('BASEPATH')) exit('No direct script access allowed');

//require APPPATH . '/libraries/BaseController.php';

class Profile extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();

      
          $this->load->model('User_model');
          $this->load->model('System_model');

        $this->load->helper('url');

	}

	public function index()
	{  

        $user_LoggedIn=$this->session->userdata('user_LoggedIn');
        if(isset($user_LoggedIn) || $user_LoggedIn == TRUE)
        {
         
          $uid=$this->session->userdata('user_id');
            $result['system']=$this->System_model->get_info();
            $result['user_info']=$this->User_model->get_user_by_id($uid);
                  
            $this->load->view('admin/header',$result);        
      		$this->load->view('admin/profile_view',$result);
            $this->load->view('admin/footer',$result);



        }
        else{
          redirect('admin/Dashboard');
        }


	}
        
        public function ajax_edit($id)
	{
		$data=$this->User_model->get_user_by_id($id);

		echo json_encode($data);
	}

        public function user_update()
	{

            	$data= array(
                'user_id' =>$this->input->post('user_id'),
                'user_fname' => strtoupper($this->input->post('user_fname')),
                'user_lname' => strtoupper($this->input->post('user_lname')),
               'user_mobile' => $this->input->post('user_mobile'),
                'user_password' => $this->input->post('user_password'),
                
                );
                
                 
                  $this->User_model->user_update(array('user_id' => $this->input->post('user_id')), $data);
                
                 $res=$this->pic_upload($data);
                
                echo json_encode(array("status" => TRUE,));
	}
        
        function pic_upload($data)
    {   
      $id=$data['user_id'];
       
                                   $new_file=$data['user_fname'].mt_rand(100,999);
       
         $config = array(
                                  'upload_path' => './profile_pic',
                                  'allowed_types' => 'gif|jpg|png|jpeg',
                                  'max_size' => '7200',
                                  'max_width' => '1920',
                                  'max_height' => '1200',
                                  'overwrite' => false,
                                  'remove_spaces' =>true,
                                  'file_name' =>$new_file 
                              );           
                      
                     // $config['file_name'] = 'pawan'; //video_name in folder with extension
                       //echo $img_name;
                                  
                       $this->load->library('upload', $config);
                       $this->upload->initialize($config);

                       if (!$this->upload->do_upload('img')) # form input field attribute
                       {
                           if(empty($this->input->post('img')))
                           {
                                $msg="Image size should less than 7MB,Dimension 1920*1200";
                           return $msg; 
                            
                           }
                           else
                           {
                                   return true;                    
                           }
                         
                       }
                       else
                       {
                           $res=$this->User_model->get_user_by_id($id);
                            if(file_exists($res->user_profile_pic))
                            {
                            unlink($res->user_profile_pic);
                            }
                           
                           $ext= explode(".",$this->upload->data('file_name'));  
                            $img_name =$new_file.".".end($ext); //video name as path in db
                             $img_path='profile_pic/'.str_replace(' ','_',$img_name);
                          $pic = array(
                              'user_profile_pic' => $img_path,
                            );
            
                                      
                                    
                   $insert =  $this->User_model->user_update(array('user_id' =>$id), $pic);
                          
                         return true; 
                                               
                       } 

            
    }
 
}



 ?>