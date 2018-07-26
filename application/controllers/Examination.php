<?php if(!defined('BASEPATH')) exit('No direct script access allowed');



class Examination extends CI_Controller
{
  function __construct()
  {
    parent::__construct();
    
    
  }
  function index()
  {
      $this->load->view('examination');
  }
  
  function exam_login()
  {
      $form=$this->input->post();      
      $val=$this->check_if_roll_exist($form);      
      if ($val == false)
      {
          redirect('Examination');
      }else{
          redirect('Examination/start_exam');
      }
  }
  
    function check_if_roll_exist($form)
  {
     
      $val=$this->Account_model->get_by_no(ltrim($form['acc_no']));
      
      if($val)
      {
          if($val->course_id==$form['course'])
          {
          if($val->acc_status==1)
          {
         return true;
          }elseif($val->acc_status==2)
          {
         $this->session->set_flashdata('acc_err',"This Roll No Login onto Another Device");
         return false;    
          }elseif($val->acc_status==0)
          {
         $this->session->set_flashdata('acc_err',"Please Make Payment");
         return false;    
          }
          }else{
         $this->session->set_flashdata('course_err',"Please Select Correct Course");
         return false; 
          }
      }
      else
      {
      $this->session->set_flashdata('acc_err',"Please Enter Correct Roll No");
      return false;    
      }
      
  }
  
  function start_exam() 
  {
      $this->load->view('start_exam1');
  }
  

  
  }