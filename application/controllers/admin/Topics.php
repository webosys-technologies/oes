<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Topics extends CI_Controller {


	 public function __construct()
	 	{
	 		parent::__construct();
	 		 $this->load->model('Topics_model');
    if(!is_admin_LoggedIn($this->session->userdata('oes_user_LoggedIn')))
     {
         redirect('admin/index');
     }
	 	}

	public function index()
    {
       
		$data['topics']=$this->Topics_model->getall_topics();
               $uid=$this->session->userdata('oes_user_id');
            $result['system']=$this->System_model->get_info();
            $result['user_data']=get_user_info($uid);
       
            $this->load->view('admin/header',$result);
		$this->load->view('admin/topic_view',$data);
		$this->load->view('admin/footer',$result);

    }

	
	      public function topic_add()
		{

                        $date=date('Y-m-d');
			$data = array(
				    'course_id' => $this->input->post('course_id'),
					'topic_name' => $this->input->post('topic_name'),
					'topic_description' => $this->input->post('topic_description'),
					'topic_created_at' => $date,
                                        'topic_created_by' => 'admin',
                                        'topic_status' => $this->input->post('status'),
				);
			$insert = $this->Topics_model->topic_add($data);

		
                $this->session->set_flashdata('success', 'Topic Added Successfully');
               
			echo json_encode(array("status" => TRUE));
		}
                
		public function ajax_edit($id)
		{
			$data = $this->Topics_model->get_by_id($id);



			echo json_encode($data);
		}

		public function topic_update()
            {
                     
		$data = array(
					 'course_id' => $this->input->post('course_id'),
					'topic_name' => $this->input->post('topic_name'),
					'topic_description' => $this->input->post('topic_description'),
					'topic_created_by' => 'admin',
					'topic_status' => $this->input->post('status'),
					// 'topic_id'=>$this->input->post('id')
				);
		
                
                
		$result=$this->Topics_model->topic_update(array('topic_id' => $this->input->post('id')), $data);
                 if($result)
                {
                $this->session->set_flashdata('success', 'Topic Updated Successfully');
                }
		echo json_encode(array("status" => TRUE));
	}

	public function topic_delete($id)
	{
		$result=$this->Topics_model->delete_by_id($id);
        if($result)
        {
        	$this->session->set_flashdata('success', 'Topic Deleted Successfully');
        }
		echo json_encode(array("status" => TRUE));
	}

        
        public function student_course_date_update($course)
        {
            
            $result=$this->Students_model->getall_students();
            
            foreach($result as $res)
            {
                if($res->student_course_start_date!="0000-00-00" && $res->course_id==$course['course_id'] )
                {
                  
                    $date=$res->student_course_start_date;
                    $data=array('student_course_end_date' =>date('Y-m-d', strtotime("+".$course['course_duration']."months", strtotime($date))));
                    $this->Students_model->student_update(array('student_id'=>$res->student_id),$data);   
                }
            }
            
        }
		function get_topics()
		{
			if($this->input->post('course_id'))
			{

			echo $this->Topics_model->fetch_topics($this->input->post('course_id'));

			}
		}
		function get_topics_edit()
		{
			if($this->input->post('course_id'))
			{

			echo $this->Topics_model->fetch_topics($this->input->post('course_id'));

			}
		}



}
