<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Questions_model extends CI_Model
{

	var $table = 'questions';


	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	public function getall_ques()
	{
		$this->db->from('questions as ques');
		$this->db->join('courses as cor','cor.course_id=ques.course_id','LEFT');

        $this->db->order_by("question_id","desc");
		$query=$this->db->get();

		return $query->result();
	}
        
        
        public function get_questions($qid,$course_id)
     	{
            $data=array('question_id'=>$qid,
                        'course_id'=>$course_id,
                        'question_status'=>'1');
		$this->db->from($this->table);
		$this->db->where($data);
		$query = $this->db->get();
                 //$this->get
		return $query->row();

	}
        
        
        
         public function get_questions_by_id($id)
	{
		$this->db->from($this->table);
		$this->db->where('question_id',$id);
		$query = $this->db->get();
                 //$this->get
		return $query->result();

	}
	

	public function add($dataSet)
	{
		$this->db->insert_batch($this->table, $dataSet);
                return $this->db->insert_id();
	}
     
	public function update($where, $data)
	{
		$this->db->update($this->table, $data, $where);
		return $this->db->affected_rows();
	}

	public function get_by_id($id)
	{
		$this->db->from($this->table);
		$this->db->where('question_id',$id);
		$query = $this->db->get();

		return $query->row();
	}


	public function delete_by_id($id)
	{
		$this->db->where('question_id', $id);
		$this->db->delete('questions');
	}
        public function no_of_questions()
        {
            
            $row = $this->db->query('SELECT MAX(question_id) AS `maxid` FROM `questions`')->row();
            $maxid = $row->maxid; 

            return $maxid;
            
        }
        
        public function get_question_count()
        {   
            $this->db->from($this->table);
            $this->db->where('question_status','1');
            $query=$this->db->get();
            return $query->num_rows();
            
        }

       
}