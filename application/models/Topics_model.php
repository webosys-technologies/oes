<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Topics_model extends CI_Model
{

	var $table = 'topics';


	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}


    public function getall_topics()
    {
    	 $this->db->from($this->table);
	    $query=$this->db->get();
	    return $query->result();
    }
    public function fetch_all_topics($course_id)
    {
	    $this->db->from($this->table);
	    $this->db->where('course_id',$course_id);
	    $this->db->where('topic_status','1');
	    $query=$this->db->get();

	    $output = '<option value="">Select Topic</option>';
	    $output .= '<option value="0">All Topics</option>';
		foreach($query->result() as $row)
		{
			$output .= '<option value="'.$row->topic_id.'">'.$row->topic_name.'</option>';
		}
		return $output;
    }
    public function fetch_topics($course_id)
    {
	    $this->db->from($this->table);
	    $this->db->where('course_id',$course_id);
	    $this->db->where('topic_status','1');
	    $query=$this->db->get();

	    $output = '<option value="">Select Topic</option>';
	    foreach($query->result() as $row)
		{
			$output .= '<option value="'.$row->topic_id.'">'.$row->topic_name.'</option>';
		}
		return $output;
    }
    
     public function get_course_rows()
    {
    $this->db->from($this->table);
    $this->db->where('course_status','1');
    $query=$this->db->get();
    return $query->num_rows();
    }


	public function get_by_id($id)
	{
		$this->db->from($this->table);
		$this->db->where('topic_id',$id);
		$query = $this->db->get();

		return $query->row();
	}
        
    public function topic_by_id($id)
	{
		$this->db->from($this->table);
		$this->db->where('topic_id',$id);
		$query = $this->db->get();

		return $query->result();
	}
	public function topic_by_course_id($id)
	{
		$this->db->from($this->table);
		$this->db->where('course_id',$id);
		$query = $this->db->get();

		return $query->result();
	}

	public function topic_add($data)
	{
		$this->db->insert($this->table, $data);
		return $this->db->insert_id();
	}

	public function topic_update($where, $data)
	{
		$this->db->update($this->table, $data, $where);
		return $this->db->affected_rows();
	}

	public function delete_by_id($id)
	{
		$this->db->where('topic_id', $id);
		$this->db->delete($this->table);
                return $this->db->affected_rows();
	}

	


}