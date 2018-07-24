<?php 

class Payment_model extends CI_Model
{
	var $table='payment';

	public function getall_payment()
	{
		$this->db->from($this->table);
		$this->db->join('centers as cen','cen.center_id=payment.center_id','LEFT');
		$this->db->order_by("payment_id","desc");
		
		$query=$this->db->get();
		return $query->result();
	}
	public function addpayment($data)
	{
		$query=$this->db->insert($this->table,$data);
		return $this->db->insert_id();

	}

	public function get_by_center_id($id)
	{
		$this->db->from($this->table);
		$this->db->where('center_id',$id);
		$this->db->order_by("payment_id","desc");
		$query = $this->db->get();

		return $query->result();
	}
        
        public function get_order_detail()
        {
            $this->db->from('payment as pay');
                    $this->db->join('order_details as ord','ord.order_id=pay.order_id','pay.order_id');
                    $this->db->where('payment_status','success');
                    $query=$this->db->get();
                    return $query->result();
        }
}


 ?>