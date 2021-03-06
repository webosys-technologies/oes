<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

	
class Question extends CI_Controller
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
             
       
	        $data['question']=$this->Questions_model->getall_ques();

			$data['courses']=$this->Courses_model->getall_courses();
			$data['topics']=$this->Topics_model->getall_topics();
		$uid=$this->session->userdata('oes_user_id');
            $result['system']=$this->System_model->get_info();
            $result['user_data']=get_user_info($uid);
       
            $this->load->view('admin/header',$result);
			$this->load->view('admin/question_view',$data);
			$this->load->view('admin/footer',$result);

       
    }

	
	function question_add()
	{
            
		$dataSet=array();

	   $course = $this->input->post('course_id');
	   $topic = $this->input->post('topic_id');
	   $question = $this->input->post('question'); 
	   $option_a = $this->input->post('option_a'); 
	   $option_b = $this->input->post('option_b'); 
	   $option_c = $this->input->post('option_c'); 
	   $option_d = $this->input->post('option_d'); 
	   $answer = $this->input->post('answer'); 
	   $answer = $this->input->post('answer'); 
	   $status = $this->input->post('status'); 

	   for($i=0;$i<sizeof($answer);$i++)
	   {
	     $dataSet[$i] = array (                'course_id' => $course[$i],
	     					   'topic_id' => $topic[$i],
	     					   'question_name' => ltrim($question[$i]),
	     					   'question_option_a' => ltrim($option_a[$i]),
	     					   'question_option_b' => ltrim($option_b[$i]),
	     					   'question_option_c' => ltrim($option_c[$i]),
	     					   'question_option_d' => ltrim($option_d[$i]),
	     					   'question_correct_ans' => ltrim($answer[$i]),
	     					   'question_created_at' => date('Y-m-d'),
	     					   'question_created_by' => 'admin',
	     					   'question_status' => $status[$i],

	     					);
	   }
	   // $dataSet is an array of array
         
           if($this->input->post('language')=="marathi")
           {
             $this->Questions_model->marathi_add($dataSet);
           }
           elseif($this->input->post('language')=="hindi")
           {
               $this->Questions_model->hindi_add($dataSet);
           }else{
          
             $this->Questions_model->add($dataSet);   
           }
	  
	   
        echo json_encode(array("status" => TRUE));

	   

    }

    function question_update()
	{
        
             

	     $data = array (        
	     				       'course_id' => $this->input->post('course_id'),
	     				       'topic_id' =>  $this->input->post('topic_id'),
	     					   'question_name' => $this->input->post('question'),
	     					   'question_option_a' =>$this->input->post('option_a'),
	     					   'question_option_b' => $this->input->post('option_b'),
	     					   'question_option_c' =>$this->input->post('option_c'),
	     					   'question_option_d' =>  $this->input->post('option_d'),
	     					   'question_correct_ans' => $this->input->post('answer'),
	     					   'question_status' => $this->input->post('status'),

	     					);
	   
             
              if($this->input->post('language')=="marathi")
           {
              $this->Questions_model->marathi_update(array('question_id' => $this->input->post('id')),$data);
           }
           elseif($this->input->post('language')=="hindi")
           {
               $this->Questions_model->hindi_update(array('question_id' => $this->input->post('id')),$data);
           }else{
          
             $this->Questions_model->update(array('question_id' => $this->input->post('id')),$data);
           }
	  
	   
        echo json_encode(array("status" => TRUE));


	   

    }
	

	public function ajax_edit($id)
	{
		$data = $this->Questions_model->get_by_id($id);
		//foreach ($data as $val) 
		//{
		  // $data['course_topics']=$this->Topics_model->topic_by_course_id($val->course_id);
		//}
		
	   
		echo json_encode($data);
	}
        public function marathi_ajax_edit($id)
	{
		$data = $this->Questions_model->marathi_get_by_id($id);
		echo json_encode($data);
	}
         public function hindi_ajax_edit($id)
	{
		$data = $this->Questions_model->hindi_get_by_id($id);
		echo json_encode($data);
	}

    public function delete_ques($id)
	{
		$this->Questions_model->delete_by_id($id);

		echo json_encode(array("status" => TRUE));
	}
        
        public function marathi_delete_ques($id)
	{
		$this->Questions_model->marathi_delete_by_id($id);

		echo json_encode(array("status" => TRUE));
	}
        
         public function hindi_delete_ques($id)
	{
		$this->Questions_model->hindi_delete_by_id($id);

		echo json_encode(array("status" => TRUE));
	}
        
    public function marathi_question()
    {
            $data['question']=$this->Questions_model->getall_marathi_ques();

	    $data['courses']=$this->Courses_model->getall_courses();
	    $uid=$this->session->userdata('oes_user_id');
            $result['system']=$this->System_model->get_info();
            $result['user_data']=get_user_info($uid);
       
            $this->load->view('admin/header',$result);
	    $this->load->view('admin/marathi_question',$data);
	    $this->load->view('admin/footer',$result);
    }
    
   
    
    
    
     public function hindi_question()
    {
            $data['question']=$this->Questions_model->getall_hindi_ques();

	    $data['courses']=$this->Courses_model->getall_courses();
	    $uid=$this->session->userdata('oes_user_id');
            $result['system']=$this->System_model->get_info();
            $result['user_data']=get_user_info($uid);
       
            $this->load->view('admin/header',$result);
	    $this->load->view('admin/hindi_question',$data);
	    $this->load->view('admin/footer',$result);
    }
}	

 ?>