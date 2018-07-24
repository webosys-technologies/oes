<?php 

class Orders_model extends CI_Model
{
	var $table="orders";
	function getall_orders()
	{
		$this->db->from($this->table);
		$this->db->join('centers','centers.center_id=orders.center_id','left');

		  $this->db->order_by("order_id","desc");
		$query=$this->db->get();
		return $query->result();
	}

        function get_orders($id)   //get orders by center id and success
	{
		$this->db->from($this->table);
		 $this->db->where('center_id',$id);
                 $this->db->where('order_status',"success");
		$query=$this->db->get();
		return $query->num_rows();
	}

        function get_by_id($id)   //get orders by center id and success
	{
		$this->db->from($this->table);
		 $this->db->where('order_id',$id);
		$query=$this->db->get();
		return $query->row();
	}   
        function getall_orders_num()   //get orders by and success
	{
		$this->db->from($this->table);
		$this->db->where('order_status',"success");
		$query=$this->db->get();
		return $query->num_rows();
	}
        
	function order($data)
	{
		$this->db->insert($this->table,$data);
		return $this->db->insert_id();
	}

	function update_order($id)
	{	
		$data=array('order_status'=> $this->input->post('status'));

            $this->db->set($data);
            $this->db->where('order_id',$id);
            $result=$this->db->update($this->table,$data);
	}


    public function get_all_id($id)
	{
		$this->db->from('orders');
		$this->db->where('center_id',$id);
		  $this->db->order_by("order_id","desc");
		$query = $this->db->get();

		return $query->result();
	}

	public function test()
	{
		$query=$this->db->query("ALTER TABLE `orders` ADD `order_gst` INT(20) NOT NULL AFTER `order_amount`");
		$this->db->query("ALTER TABLE coupons ADD coupon_min_student INT(20) NOT NULL AFTER coupon_limit ");
		return $query;
	}

	public function test1()
	{
		$query=$this->db->query("ALTER TABLE `orders` ADD `order_discount` INT(20) NOT NULL AFTER `order_amount`, ADD `order_payable_amount` INT(20) NOT NULL AFTER `order_discount`");
		return $query;
	}
	
}

 ?>