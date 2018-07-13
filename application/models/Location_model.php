<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Location_model extends CI_Model
{
	var $table='states';

	function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

        function getall()
        {
            $query=$this->db->from($this->table)
                     ->where('countryID','101')
                     ->get();
            return $query->result();
        }
        
        function getall_cities($id)
        {
            $query=$this->db->from('cities')
                     ->where('stateID',$id)
                     ->get();
            return $query->result();
        }
        
      

}

?>

