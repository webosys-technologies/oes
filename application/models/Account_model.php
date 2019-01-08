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
        
        function get_by_center($where)
        {
            $this->db->from($this->table);
            $this->db->where($where);
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
        
        function change_acc_status($id)
        {
          $this->db->update($this->table,array('acc_status'=>'1'),array('acc_id'=>$id));
          return $this->db->affected_rows();
        }
        
        
         public function check_center_password($data)
        {
            $this->db->from('centers');
            $this->db->where('center_id',$data['center_id']);
            $query=$this->db->get();
            $res=$query->row();
           
            if($res->center_password==$data['center_password'])
            {
                return true;
            }
            else
            {
                return false;
            }
        }
        
        function delete_by_id($id)
        {
            $this->db->from($this->table);
            $this->db->where('acc_id',$id);
            $this->db->delete();
            return $this->db->affected_rows();
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
        
        function get_by_no($no)
        {
             $this->db->from($this->table);
             $this->db->where('acc_no',$no);
    
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
        function query()
        {
            $this->db->query('ALTER TABLE `account` ADD `examination_date` DATE NOT NULL AFTER `acc_valid_to`, ADD `examination_time` VARCHAR(55) NOT NULL AFTER `examination_date`;');
        }
       
}

 ?>