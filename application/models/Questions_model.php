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
		$this->db->join('topics as top','top.topic_id=ques.topic_id','LEFT');
        $this->db->order_by("question_id","desc");
		$query=$this->db->get();

		return $query->result();
	}
        public function getall_marathi_ques()
	{
		$this->db->from('marathi_questions as ques');
		$this->db->join('courses as cor','cor.course_id=ques.course_id','LEFT');
		$this->db->join('topics as top','top.topic_id=ques.topic_id','LEFT');
                $this->db->order_by("question_id","desc");
		$query=$this->db->get();

		return $query->result();
	}
         public function getall_hindi_ques()
	{
		$this->db->from('hindi_questions as ques');
		$this->db->join('courses as cor','cor.course_id=ques.course_id','LEFT');
		$this->db->join('topics as top','top.topic_id=ques.topic_id','LEFT');
                $this->db->order_by("question_id","desc");
		$query=$this->db->get();

		return $query->result();
	}
        
        
        public function get_questions($qid,$course)
     	{
        
		$this->db->from($this->table);
		$this->db->where('question_id',$qid);
        $this->db->where('question_status','1');
        $this->db->where('course_id',$course);
		$query = $this->db->get();
                 //$this->get
		return $query->row();
	}
        
        public function marathi_get_questions($qid,$course_id)
     	{
            $data=array('question_id'=>$qid,
                        'course_id'=>$course_id,
                        'question_status'=>'1');
		$this->db->from('marathi_questions');
		$this->db->where($data);
		$query = $this->db->get();
                 //$this->get
		return $query->row();

	}
        public function hindi_get_questions($qid,$course_id)
     	{
            $data=array('question_id'=>$qid,
                        'course_id'=>$course_id,
                        'question_status'=>'1');
		$this->db->from('hindi_questions');
		$this->db->where($data);
		$query = $this->db->get();
                 //$this->get
		return $query->row();

	}
        
        
        
    public function get_questions_by_id($id,$lang)
	{
                if($lang=='marathi')
                {
                   $this->db->from('marathi_questions');   
                }elseif($lang=='hindi')
                {
                     $this->db->from('hindi_questions'); 
                }else{
                   $this->db->from($this->table); 
                }
		
		$this->db->where('question_id',$id);
		$query = $this->db->get();
                 //$this->get
		return $query->row();

	}
	

	public function add($dataSet)
	{
		$this->db->insert_batch($this->table, $dataSet);
                return $this->db->insert_id();
	}
        
        public function marathi_add($dataSet)
	{
		$this->db->insert_batch('marathi_questions', $dataSet);
                return $this->db->insert_id();
	}
        public function hindi_add($dataSet)
	{
		$this->db->insert_batch('hindi_questions', $dataSet);
                return $this->db->insert_id();
	}
     
	public function update($where, $data)
	{
		$this->db->update($this->table, $data, $where);
		return $this->db->affected_rows();
	}
        
        public function marathi_update($where, $data)
	{
		$this->db->update('marathi_questions', $data, $where);
		return $this->db->affected_rows();
	}
        
        public function hindi_update($where, $data)
	{
		$this->db->update('hindi_questions', $data, $where);
		return $this->db->affected_rows();
	}

	public function get_by_id($id)
	{
		$this->db->from($this->table);
		$this->db->where('question_id',$id);
		$query = $this->db->get();

		return $query->row();
	}
        public function marathi_get_by_id($id)
	{
		$this->db->from('marathi_questions');
		$this->db->where('question_id',$id);
		$query = $this->db->get();

		return $query->row();
	}
         public function hindi_get_by_id($id)
	{
		$this->db->from('hindi_questions');
		$this->db->where('question_id',$id);
		$query = $this->db->get();

		return $query->row();
	}

	public function delete_by_id($id)
	{
		$this->db->where('question_id', $id);
		$this->db->delete('questions');
	}
        
        public function marathi_delete_by_id($id)
	{
		$this->db->where('question_id', $id);
		$this->db->delete('marathi_questions');
	}
        
        public function hindi_delete_by_id($id)
	{
		$this->db->where('question_id', $id);
		$this->db->delete('hindi_questions');
	}
        
        public function no_of_questions()
        {
            
            $row = $this->db->query('SELECT MAX(question_id) AS `maxid` FROM `questions`')->row();
            $maxid = $row->maxid; 

            return $maxid;
            
        }
        
        function que_by_course($course,$topic_id)
        {
            $this->db->from($this->table);
            $this->db->where('course_id',$course);
            if($topic_id!=0)
            {
            	$this->db->where('topic_id',$topic_id);
        	}
            $this->db->where('question_status','1');
            $query=$this->db->get();
            return $query->result();
        }
        
        function que_count($data)
        {
           $this->db->from($this->table);
            $this->db->where($data);           
            $query=$this->db->get();
            return $query->result();  
        }
        
        function marathi_que_by_course($course)
        {
            $this->db->from('marathi_questions');
            $this->db->where('course_id',$course);
             if($topic_id!=0)
            {
            	$this->db->where('topic_id',$topic_id);
        	}
            $this->db->where('question_status','1');
            $query=$this->db->get();
            return $query->result();

        }
        function hindi_que_by_course($course)
        {
            $this->db->from('hindi_questions');
            $this->db->where('course_id',$course);
            if($topic_id!=0)
            {
            	$this->db->where('topic_id',$topic_id);
        	}
            $this->db->where('question_status','1');
            $query=$this->db->get();
            return $query->result();

        }
        
        public function get_question_count()
        {   
            $this->db->from($this->table);
            $this->db->where('question_status','1');
            $query=$this->db->get();
            return $query->num_rows();
            
        }
        
      
       
}