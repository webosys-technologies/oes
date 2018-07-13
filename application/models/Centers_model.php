<?php

class Centers_model extends CI_Model
{
    var $table='centers';

	function __construct()
	{

		parent::__construct();
		$this->load->database();
	}
	
     public function getall()
    {
        $this->db->from($this->table);        
        $query=$this->db->get();
        return $query->result();

    }
	function register()
	{
		

		$data=array(
			'center_fname'			=> strtoupper($this->input->post('center_fname')),
			'center_lname'		 	=>strtoupper($this->input->post('center_lname')),
			'center_name'           => strtoupper($this->input->post('center_name')),
			'center_email' 		    => $this->input->post('center_email'),
			'center_mobile' 		=> $this->input->post('center_mobile'),
			'center_gender' 		=> $this->input->post('center_gender'),
                        'center_dob' 		        => $this->input->post('center_dob'),
			'center_password' 		=> $this->input->post('center_password'),
			'center_address'		=> $this->input->post('center_address'),
			'center_city'			=> $this->input->post('center_city'),
			'center_pincode'		=> $this->input->post('center_pincode'),
			'center_state'			=> $this->input->post('center_state'),
                        'center_askfor_password'       =>'disable',
			'center_created_at'	=> date("Y-m-d H:i:s"),
                        'center_status'        => '0'


		);

		$this->db->insert('centers',$data);
		$insert=$this->db->insert_id();
                 //return $insert;
                return array($insert,$data);
	}
        
        public function center_askfor_password($ask_value,$id)
        {
            $data=array('center_askfor_password'=>$ask_value);
            $where=array('center_id'=>$id);
            $this->db->update($this->table,$data,$where);
            return $this->db->affected_rows();
            
        }
        
        function loginMe($center_email, $center_password)
    {
     /*   $this->db->select('BaseTbl.userId, BaseTbl.password, BaseTbl.name, BaseTbl.roleId, Roles.role');
        $this->db->from('tbl_users as BaseTbl');
        $this->db->join('tbl_roles as Roles','Roles.roleId = BaseTbl.roleId'); 
        $this->db->where('BaseTbl.email', $email);
        $this->db->where('BaseTbl.isDeleted', 0);  */
         $this->db->where('center_email', $center_email);
          $this->db->where('center_password', $center_password);
        //  $this->db->where('center_status',1);
        $query = $this->db->get('centers');
        $row = $query->num_rows();
        $result=$query->result();
        
        $this->db->where('center_email', $center_email);
        $query2 = $this->db->get('centers');
        $valid_email=$query2->num_rows();
        return array($row,$result,$valid_email);
      
        
    
    }
        public function center_name($cid)
        {
            $this->db->from($this->table);
            $this->db->where('center_id',$cid);
            $query=$this->db->get();
            return $query->result();
        }
        
     function checkEmailExist($center_email)
    {
      //  $this->db->select('userId');
        $this->db->where('center_email', $center_email);
      //  $this->db->where('isDeleted', 0);
        $query=$this->db->get('centers');
        $result=$query->num_rows();
        $info=$query->result();

        if ($result>0)
            {
            $otp=mt_rand(100000,999999);
             foreach($info as $i)
            {
             $data=array('center_name'=>$i->center_name,
                            'center_fname'=>$i->center_fname,
                               'center_lname'=>$i->center_lname,
                                'center_mobile'=>$i->center_mobile,
                                'center_email'=>$i->center_email,
                                'center_id'=>$i->center_id,
                                'otp'=>$otp
             );   
            }
            return array($result,$data);
        } 
        else {
            return false;
        }
    }
    
    public function center_add($data)
	{
		$this->db->insert($this->table, $data);
		return $this->db->insert_id();
	}
    
     function resetPasswordUser($data)
    {
         $this->db->where('id',$data['id']);
        $query=$this->db->get('tbl_reset_password');
        
        if($query->num_rows()>0)
        {
            $result = $this->db->replace('tbl_reset_password', $data);
        }
        else
        {
        $result = $this->db->insert('tbl_reset_password', $data);
        }
        
        if($result) {
            return TRUE;
        } else {
            return FALSE;
        }
    }
    public function delete_by_id($id)
	{
		$this->db->where('center_id', $id);
		$this->db->delete($this->table);
                return $this->db->affected_rows();
	}
        
    function reset_password($data)
    {
        $this->db->set('center_password',$data['password']);
        $this->db->where('center_email',$data['center_email']);
        $this->db->update('centers');
        return true;
    }
    
    
    function otp_verify($center_email)
    {
        $this->db->where('email',$center_email);
        $query=$this->db->get('tbl_reset_password');
        $info=$query->result();
        if($query->num_rows()>0)
        {
            foreach($info as $i)
            {
             $data=array('email'=>$i->email,
                         'otp'=>$i->activation_id
             );   
            } 
            
            $this->db->where('center_email',$center_email);
            $query=$this->db->get('centers');
            $info1=$query->result();
            foreach($info1 as $i1)
            {
             $data1=array('center_fname'=>$i1->center_fname,
                         'center_lname'=>$i1->center_lname,
                         'center_email'=>$i1->center_email,
                         'center_mobile'=>$i1->center_mobile,
                         'center_name'=>$i1->center_name
             );   
            } 
            
            return array($data,$data1);
        }
        else
        {
            return false;
        }
    }
    
    

	

	function check_if_email_exist($center_email)
	{
		$this->db->where('center_email',$center_email);
		$result=$this->db->get('centers');

		if($result->num_rows()>0)
		{
			return FALSE;
		}
		else
		{
			return TRUE;
		}
	}
        
        function check_mobile_exist($mobile)
	{
		$this->db->where('center_mobile',$mobile);
		$result=$this->db->get('centers');

		if($result->num_rows()>0)
		{
			return FALSE;
		}
		else
		{
			return TRUE;
		}
	}
        
    public function get_by_id($id)
	{
		$this->db->from($this->table);
		$this->db->where('center_id',$id);
		$query = $this->db->get();

		return $query->result();
	}

    public function center_update($where, $data)
    {
        $this->db->update($this->table, $data, $where);
        return $this->db->affected_rows();
    }
    public function get_data_by_email($email)
	{
		$this->db->from($this->table);
		$this->db->where('center_email',$email);
		$query = $this->db->get();

		return $query->row();
	}

    public function get_id($id)
    {
        $this->db->from($this->table);
        $this->db->where('center_id',$id);
        $query = $this->db->get();

        return $query->row();
    }

     public function getall_centers_no()
    {
        $this->db->from($this->table);        
        $query = $this->db->get();
        return $query->num_rows();
    }
    
    
    public function get_multiple_id($ids=array())
    {
            $this->db->from($this->table);
             foreach($ids as $id)
            {    // where $org is the instance of one object of active record
                 $this->db->or_where('center_id',$id);
            }
            $query=$this->db->get();
            return $query->result();
    }


    function email_verification($email,$hash)
    {
        $this->db->from($this->table);
        $this->db->where('center_email',$email);
        $query=$this->db->get();
        $res=$query->row();
        if($hash==$res->center_verification)
        {
            $center_email=array('center_email'=>$email);
            $data=array('center_status'=>'1');
            $this->center_update($center_email,$data);
            return true;
        }
        else
        {
           
            return false;
        }
    }
    
  
     

	
}
?>