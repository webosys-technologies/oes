<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Account_model extends CI_Model
{
	var $table='account';

	function __construct()
	{
		parent::__construct();
		$this->load->database();
	}
        
        function getall()
        {
            $this->db->from($this->table);
            $query=$this->db->get();
            return $query->result();
        }
        function check_account($id)
        {
           $this->db->from($this->table);
           $this->db->where('acc_no',$id);
           $query=$this->db->get();
           if($query->num_rows()>0)
           {
               return true;
           }else{
               return false;
           }
        }
        
        function delete_by_id($id)
        {
//            $this->db->from($this-);
        }
        
        function add_account($data)
        {
            $this->db->insert($this->table,$data);
            return $this->db->insert_id();
        }
        
        function get_by_id($id)
        {
            $this->db->from($this->table);
            $this->db->where('acc_id',$id);
            $query=$this->db->get();
            
            return $query->row();           
            
        }
        
         public function get_multiple_id($ids=array())
        {
            $this->db->from('account as acc');        
                        
             $this->db->join('courses as crs', 'crs.course_id=acc.course_id', 'LEFT');
            
             foreach($ids as $id)
            {    // where $org is the instance of one object of active record
                 $this->db->or_where('acc_id',$id);
            }
            $query=$this->db->get();
            return $query->result();
        }
        
        public function account_update($where,$data)
        {
            $this->db->update($this->table,$data,$where);
            return $this->db->affected_rows();
        }
       
}

 ?>