<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Coupons_model extends CI_Model
{
	var $table='coupons';

	function __construct()
	{

		parent::__construct();
		$this->load->database();
	}
        
        public function get_coupons_by_id($id)
        {
            $this->db->from($this->table);
            $this->db->where('center_id',$id);
            $query=$this->db->get();
            return $query->result();
            
        }
        
         public function get_allcoupon()
        {
            $this->db->from($this->table);
            $this->db->where('coupon_status','1');
            $query=$this->db->get();
            return $query->num_rows();
            
        }
        
         public function check_by_code($code,$id)
        {
            $this->db->from($this->table);
            $this->db->where('coupon_code',$code);
            $this->db->where('center_id',$id);
            $query=$this->db->get();
            $res=$query->num_rows();
             if($res>0)
             {
                 return true;
             }else
             {
                 return false;
             }
            
        }
        public function coupon_add($data)
        {
            $this->db->insert($this->table, $data);
            return $this->db->insert_id();
        }
         public function get_id($id)
        {
                    
        $this->db->from($this->table);       
        $this->db->where('coupon_id',$id);
            $query = $this->db->get();

            return $query->row();
        }
        
         public function get_center_by_id($id)
        {
                    
        $this->db->from('centers');       
        $this->db->where('center_id',$id);
            $query = $this->db->get();
            return $query->result();
        }
        public function coupon_update($where, $data)
	{
           
		$this->db->update($this->table, $data, $where);
		return $this->db->affected_rows();
	}
        public function delete_by_id($id)
	{
		$this->db->where('coupon_id', $id);
		$this->db->delete($this->table);
                return $this->db->affected_rows();
	}
        
        public function getall_coupons()
        {
            
         $this->db->from('coupons as sub');        
         $this->db->join('centers as crs', 'crs.center_id=sub.center_id', 'LEFT');
         $query = $this->db->get();
       	return $query->result();
           
        }
        public function coupon_table()
        {
        $this->db->query('CREATE TABLE `coupons` ( `coupon_id` INT(11) NOT NULL AUTO_INCREMENT , `coupon_code` VARCHAR(255) NOT NULL , `coupon_percentage` INT(11) NOT NULL , `coupon_limit` INT(11) NOT NULL , `center_id` INT(11) NOT NULL , `coupon_created_at` DATE NOT NULL , `coupon_valid_from` DATE NOT NULL , `coupon_valid_to` DATE NOT NULL , `coupon_status` INT(11) NOT NULL , PRIMARY KEY (`coupon_id`)) ENGINE = InnoDB');
        
        return true;
        }

        public function get_coupon($code)
        {
            $this->db->from($this->table);
            //$this->db->or_where_in('center_id',$ids);
            $this->db->where('coupon_code',$code);
            $query=$this->db->get();

            return $query->row(); 
        }


        

        
       
}

 ?>

