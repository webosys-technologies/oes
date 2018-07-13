<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class User_model extends CI_Model
{
     var $table='users';
    
     public function getall_user()
     {
        $this->db->from($this->table);
        $query=$this->db->get();

        return $query->result();
     }

    public  function loginMe($user_email, $user_password)
    {
    
         $this->db->where('user_email', $user_email);
          $this->db->where('user_password', $user_password);
        $query = $this->db->get('users');
        
         $row = $query->num_rows();
        $result=$query->result();
        
        $this->db->where('user_email', $user_email);
        $query2 = $this->db->get('users');
        $valid_email=$query2->num_rows();
        return array($row,$result,$valid_email);
     
  
    }

    public function getall_email()
    {
        $this->db->select('user_email');
        $this->db->from($this->table);
        $query=$this->db->get();
        return $query->result();
    }
    public function user_add($data)
    {
        $this->db->insert($this->table,$data);

        return $this->db->insert_id();

    }

    public function user_update($where,$data)
    {
        $this->db->update($this->table,$data,$where);

        return $this->db->affected_rows();
    }

    
    public function get_user_by_id($id)
    {
        $this->db->from($this->table);
        $this->db->where('user_id',$id);
        $query=$this->db->get();
        return $query->row();
    }
    
    
    public function delete_by_id($id)
    {
        $this->db->where('user_id', $id);
        $this->db->delete($this->table);
    }
}

  