<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Student_roll_model extends CI_Model
{
	var $table='student_roll';

	function __construct()
	{

		parent::__construct();
		$this->load->database();
	}
        
       
}

 ?>