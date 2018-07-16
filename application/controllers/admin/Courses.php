<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Courses extends CI_Controller {


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
       
		$data['courses']=$this->Courses_model->getall_courses();
               $uid=$this->session->userdata('oes_user_id');
            $result['system']=$this->System_model->get_info();
            $result['user_data']=get_user_info($uid);
       
            $this->load->view('admin/header',$result);
		$this->load->view('admin/course_view',$data);
		$this->load->view('admin/footer',$result);

    }

	
	public function course_add()
		{
                        $date=date('Y-m-d');
			$data = array(
					'course_name' => $this->input->post('name'),
					'course_duration' => $this->input->post('duration'),
					'course_fees' => $this->input->post('fees'),
					'course_reexam_fees' => $this->input->post('reexam_fees'),
					'course_created_at' => $date,
                                        'course_created_by' => 'admin',
                                        'course_status' => $this->input->post('status'),
				);
			$insert = $this->Courses_model->course_add($data);

			$book=array(
					'book_name' => 'No Book',
					'course_id' => $insert,
					'book_price' => 0,
                                        'book_created_at' => date('Y-m-d'),
					'book_status' => 1,
			);


			$insert = $this->Books_model->book_add($book);
                        if($insert)
                {
                $this->session->set_flashdata('success', 'Course Added Successfully');
                }
			echo json_encode(array("status" => TRUE));
		}
		public function ajax_edit($id)
		{
			$data = $this->Courses_model->get_by_id($id);



			echo json_encode($data);
		}

		public function course_update()
            {
                     $date=date('Y-m-d');
		$data = array(
					'course_name' => $this->input->post('name'),
					'course_duration' => $this->input->post('duration'),
					'course_reexam_fees' => $this->input->post('reexam_fees'),
					'course_fees' => $this->input->post('fees'),
					'course_created_at' => $date,
                                        'course_created_by' => 'admin',
                                        'course_status' => $this->input->post('status'),
                                        'course_id'=>$this->input->post('id')
				);
                
                $this->student_course_date_update($data);
		$result=$this->Courses_model->course_update(array('course_id' => $this->input->post('id')), $data);
                 if($result)
                {
                $this->session->set_flashdata('success', 'Course Updated Successfully');
                }
		echo json_encode(array("status" => TRUE));
	}

	public function course_delete($id)
	{
		$result=$this->Courses_model->delete_by_id($id);
                  if($result)
                {
                $this->session->set_flashdata('success', 'Course Deleted Successfully');
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



}
