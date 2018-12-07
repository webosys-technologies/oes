
  <?php

   if(!defined('BASEPATH')) exit('No direct script access allowed');

//require APPPATH . '/libraries/BaseController.php';

class Account extends CI_Controller
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

            $result['system']=$this->System_model->get_info();
        $result['data']=get_center_info($id);
        $result['account_data']=$this->Account_model->get_by_center(array('center_id'=>$id));
          $this->load->view('center/header',$result);
      	 $this->load->view('center/account_view',$result);
          $this->load->view('center/footer',$result);

	}
        
         function pay()
    {
       
    }
        
        
        
        function account_add()
        {
            $no_of_acc=$this->input->post('account');
            $course=$this->input->post('course');
            $this->input->post('pay');
                    
            $j=1;
            $length=5;
            $str = "";
	$characters = array_merge(range('A','Z'), range('a','z'), range('0','9'));
	$max = count($characters) - 1;
        
        while($j<=$no_of_acc)
        {
	for ($i = 0; $i < $length; $i++) {
		$rand = mt_rand(0, $max);
		$str .= $characters[$rand];
	}
                $acc_no=substr($this->session->userdata('oes_center_name'), 0, 3).$str.mt_rand(1000,9999);
                $check=$this->check_account($acc_no);
                if($check)
                {
//                    echo $acc_no."<br>";
                    $data=array('acc_no'=>$acc_no,
                                'course_id'=>$course,
                                'center_id'=>$this->session->userdata('oes_center_id'),
                                'acc_created_at'=>date('Y-m-d'),
                                'acc_status'=>'0');
                   $this->Account_model->add_account($data); 
                    $str = "";
                    $data="";
                   $j++;
                }                
        }
        echo json_encode(array('status'=>'success'));
        }
        
        function account_delete($id)
        {
            $this->Account_model->delete_by_id($id);
            echo json_encode(array('status'=>'success'));
        }
        
        function edit_account($id)
        {
            $result=$this->Account_model->get_by_id($id);
            echo json_encode($result);
        }
        
        
        function sign_out($id)
        {
            $res=$this->Account_model->get_by_id($id);
            if(date('Y-m-d')<=$res->acc_valid_to)
            {
                $this->Account_model->account_update(array('acc_id'=>$id),array('acc_status'=>1));
            }else{
                $this->Account_model->account_update(array('acc_id'=>$id),array('acc_status'=>3));
            }
            echo json_encode(array('status'=>'success'));
        }
        
        function check_account($acc)
        {
        $check=$this->Account_model->check_account($acc);
        if($check)
        {
                return false;
        }else
        {
            return true;
        }
        }
        
        function account_update()
        {
            
        }

  
 
}



 ?>