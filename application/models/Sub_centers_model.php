<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Sub_centers_model extends CI_Model
{
	var $table='sub_centers';

	function __construct()
	{

		parent::__construct();
		$this->load->database();
	}
        
        public function get_sub_centers_by_id($id)
        {
            $this->db->from($this->table);
            $this->db->where('center_id',$id);
            $query=$this->db->get();
            return $query->result();
            
        }
        public function check_sub_center($name,$id)
        {
            $data=array('sub_center_name'=>$name,
                       'center_id'=>$id);
            $this->db->from($this->table);
            $this->db->where($data);
            $query=$this->db->get();
            $res=$query->num_rows();
            if($res>0)
            {
                return true;
            }else{
                return false;
            }
            
        }
        
         public function getall_sub_center()
        {
            $this->db->from($this->table);
            $this->db->where('sub_center_status','1');
            $query=$this->db->get();
            return $query->num_rows();
        }
        
        public function sub_center_add($data)
        {
            $this->db->insert($this->table, $data);
            return $this->db->insert_id();
        }
         public function get_id($id)
        {
                    
        $this->db->from($this->table);       
        $this->db->where('sub_center_id',$id);
            $query = $this->db->get();

            return $query->row();
        }
        public function sub_center_update($where, $data)
	{
           
		$this->db->update($this->table, $data, $where);
		return $this->db->affected_rows();
	}
        public function delete_by_id($id)
	{
		$this->db->where('sub_center_id', $id);
		$this->db->delete($this->table);
                return $this->db->affected_rows();
	}
        
        public function getall_sub_centers()
        {
            
         $this->db->from('sub_centers as sub');        
         $this->db->join('centers as crs', 'crs.center_id=sub.center_id', 'LEFT');
         $query = $this->db->get();
       	return $query->result();
           
        }
         public function get_sub_by_id($id)
        {
            
         $this->db->from($this->table);   
         $this->db->where('center_id',$id);
         $this->db->where('sub_center_status','1');
         $query = $this->db->get();
       	return $query->num_rows();
           
        }
        
        
       
}

 ?>