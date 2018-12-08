<?php if(!defined('BASEPATH')) exit('No direct script access allowed');



class Examination extends CI_Controller
{
  function __construct()
  {
    parent::__construct();
    
    
  }
  function index()
  {
       if(!empty($this->session->userdata('oes_acc_no')) || $this->session->userdata('oes_exam_start')==true)
      {
           redirect('Examination/start_exam');
      }else{
          $this->session->set_flashdata('home',"active");
          
          $this->load->view('header');
           $this->load->view('examination1');
           $this->load->view('footer');
      }
    
  }
  
  function exam_login()
  {
      $form=$this->input->post();      
      $val=$this->check_if_roll_exist($form);      
      if ($val == false)
      {
          redirect('Examination');
      }else{
          
          $res=$this->Account_model->get_by_no($form['acc_no']);
          $centers=$this->Centers_model->get_id($res->center_id);
          $course=$this->Courses_model->get_by_id($res->course_id);
           $data=array('oes_exam_start'=>true,
                      'oes_acc_no'=>$res->acc_no,
                      'oes_acc_id'=>$res->acc_id,
                      'oes_course_id'=>$res->course_id,
                      'oes_course_name'=>$course->course_name,
                      'oes_language'=>$form['language'],
                      );
         
         if($centers->center_askfor_password=='disable')
         {
          $this->Account_model->account_update(array('acc_no'=>$form['acc_no']),array('acc_status'=>'2'));
          $this->session->set_userdata($data);         
          redirect('Examination/start_exam');
         }else{
             $this->load->view('ask_center_password',$data);
         }
      }
  }
  
  
    public function check_center_password()
    {
        $acc_id=$this->input->post('oes_acc_id');
        $pass=$this->input->post('center_password');
        $res=$this->Account_model->get_by_id($acc_id);
        
        $data=array('center_id'=>$res->center_id,
                    'center_password'=>$pass);
        
        $result=$this->Account_model->check_center_password($data);
       
        if($result)
        {
           
          $centers=$this->Centers_model->get_id($res->center_id);
          $course=$this->Courses_model->get_by_id($res->course_id);
           $oes=array('oes_exam_start'=>true,
                      'oes_acc_no'=>$res->acc_no,
                      'oes_acc_id'=>$res->acc_id,
                      'oes_course_id'=>$res->course_id,
                      'oes_course_name'=>$course->course_name,
                      'oes_language'=>$form['language'],
                      );
            $this->session->set_userdata($oes);         
          redirect('Examination/start_exam');
               
        }
        else
        {
            $this->session->set_flashdata('error','Center Administrative password does not match');
            $stud_data['oes_acc_id']=$acc_id;
            $this->load->view('ask_center_password',$stud_data);
        }
    }
  
    function check_if_roll_exist($form)
  {     
      $val=$this->Account_model->get_by_no(ltrim($form['acc_no']));
     
      if($val)
      {
          if($val->course_id==$form['course'])
          {
          if(date("Y-m-d")>=$val->acc_valid_from && date("Y-m-d")<=$val->acc_valid_to && $val->acc_status==1)
          {
              return true;    
          }elseif(date("Y-m-d")<=$val->acc_valid_from || date("Y-m-d")>=$val->acc_valid_to){
              if(date("Y-m-d")>=$val->acc_valid_to)
              {
                  $this->Account_model->account_update(array("acc_id"=>$val->acc_id),array('acc_status'=>'3'));
                  $this->session->set_flashdata('acc_err',"Account no validity Finished");  
              }else{
                 $this->session->set_flashdata('acc_err',"Account no validity Finished or Not Purchased");  
              }             
             return false; 
          }elseif($val->acc_status==2)
          {
         $this->session->set_flashdata('acc_err',"This Roll No Login onto Another Device");
         return false;    
          }elseif($val->acc_status==0)
          {
         $this->session->set_flashdata('acc_err',"Please Purchase Account No");
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
   
      if(!empty($this->session->userdata('oes_acc_no')) || $this->session->userdata('oes_exam_start')==true)
      {

          if(!$this->session->userdata('get_question')==true)
          {
              $val=$this->get_question(); 
          }
        
           $this->load->view('header');
         $this->load->view('start_exam',$this->session->userdata('q1'));       
          $this->load->view('footer');
              
      }else{
          
          redirect('Examination');
      }
  }
  
  function reset_answer()
  {
      $question_num=$this->input->post("question_num");
      $this->session->unset_userdata('ans_qno'.$question_num);
      echo json_encode(array('reset_qno'=>$question_num));
  }
  
  
  function get_question()
  {
     
       if(!empty($this->session->userdata('oes_acc_no')) || $this->session->userdata('oes_exam_start')==true)
      {
           if(!$this->session->userdata('get_question')==true)
          {
      if($this->session->userdata('oes_language')=="marathi")
      {
          $res=$this->Questions_model->marathi_que_by_course($this->session->userdata('oes_course_id'));
      }elseif($this->session->userdata('oes_language')=="hindi")
      {
        $res=$this->Questions_model->hindi_que_by_course($this->session->userdata('oes_course_id'));  
      }else{
      $res=$this->Questions_model->que_by_course($this->session->userdata('oes_course_id'));
      }
     
      if(count($res)>1)
      {
      $i=1;
       while($i<=100)
                  {
                      $qid=mt_rand(1,count($res));
                      
                      if($this->session->userdata('oes_language')=="marathi")
                    {
                        $question=$this->Questions_model->marathi_get_questions($qid,$this->session->userdata('oes_course_id'));
                    }elseif($this->session->userdata('oes_language')=="hindi")
                    {
                      $question=$this->Questions_model->hindi_get_questions($qid,$this->session->userdata('oes_course_id'));
                    }else{
                    $question=$this->Questions_model->get_questions($qid,$this->session->userdata('oes_course_id'));
                    }              
                  
               if($question)
               {                         
                  
                   $que_field['q'.$i]=array('qno'=>$i,
                                    'question_id'=>$question->question_id,
                                    'question_name'=>$question->question_name,
                                    'question_option_a'=>$question->question_option_a,
                                    'question_option_b'=>$question->question_option_b,
                                    'question_option_c'=>$question->question_option_c,
                                    'question_option_d'=>$question->question_option_d,
                                    'no_of_que'=>100
                                   );
                     $i++;
                
               }
                             
                  }
                  
                  
                   $this->session->set_userdata($que_field);
                   $this->session->set_userdata(array('get_question'=>true));
                
                   
//                   return true;
      }else{
          $this->session->flashdata('language_err','Questions are not available for this language');
//          return false;
      }
          }else{
               redirect('Examination');
          }   
                   
             }
             
             else{
          redirect('Examination');
      }
  }
  
  
  function question($id)
  {
      if(!empty($this->session->userdata('oes_acc_no')) || $this->session->userdata('oes_exam_start')==true)
      {      
           $qno=$this->input->post("press_btn_qno");           //button number
           $question_num=$this->input->post("question_num");   //question number value in input
           $press_btn=$this->input->post("press_btn");
           $qid=$this->input->post('question_id');
           $option=$this->input->post('option'); 
      
//           print_r($this->input->post());
//           die;
             
                             if(!empty($qid) && !empty($option))
                {
                                      
               $answer=$this->Questions_model->get_questions_by_id($qid,$this->session->userdata('oes_language'));
                
                      $correct_ans=$answer->question_correct_ans;                     
                 
                
                  if($correct_ans==$option)
                  {
                     $data['ans_qno'.$question_num]=array('question_id'=>$qid,
                                 'acc_id'=>$this->session->userdata('oes_acc_id'),
                                 'correct_ans'=>$correct_ans,
                                 'given_ans'=>$option,
                                 'mark'=>1); 

                     $this->session->set_userdata($data);
                  }
                  else
                  {
                       $data['ans_qno'.$question_num]=array('question_id'=>$qid,
                                 'acc_id'=>$this->session->userdata('oes_acc_id'),
                                 'correct_ans'=>$correct_ans,
                                 'given_ans'=>$option,
                                 'mark'=>0); 

                       $this->session->set_userdata($data);
                  }
                 
                }
                $solved_question=null;
                $check=null;
                $given_ans=null;
             for($i=1;$i<=100;$i++)
             {
                  if(!empty($this->session->userdata('ans_qno'.$i)))
                  {
                     $solved_question[]=$i;
                      $res= $this->session->userdata('ans_qno'.$i);
                      $given_ans[$i]= $res['given_ans'];;

                  }
                  
             }
            
        
               if($press_btn=="next")
               {
                   $question_num++;
               }
              if($press_btn=="prev")
               {
                    $question_num--;
               }
               
               if(!empty($qno))
               {
                   $question=$this->session->userdata('q'.$qno);
               }
               else
               {
                   $question=$this->session->userdata('q'.$question_num);
               }
                   
               
            echo json_encode(array('no_of_que'=>100,
                                   'solved_question'=>$solved_question,     //solved question number
                                   'question'=>$question,                   //which question wants to ask
                                    'given_ans'=>$given_ans)
                                   );
         
          
          
      }            
      else
      {
          redirect('Examination');
      }
  }
  
  
   function submit_exam()
        {
            
//            $timestamp=explode(":",$this->input->post('timestamp'));
//             $min=50-$timestamp[0];
//             $sec=60-$timestamp[1];
            
           $fun_btn_qno=$this->input->post("press_btn_qno");  // IF LAST QUESTION IS REMAINING
           $question_num=$this->input->post("question_num");
           $press_btn=$this->input->post("press_btn");
           $qid=$this->input->post('question_id');
           $option=$this->input->post('option'); 
           
                       if(!empty($qid) && !empty($option))
                {
                                      
               $answer=$this->Questions_model->get_questions_by_id($qid,$this->session->userdata('oes_language'));
                   $correct_ans=$answer->question_correct_ans;   
                
                  if($correct_ans==$option)
                  {
                     $data['ans_qno'.$question_num]=array('question_id'=>$qid,
                                 'acc_id'=>$this->session->userdata('oes_acc_id'),
                                 'correct_ans'=>$correct_ans,
                                 'given_ans'=>$option,
                                 'mark'=>1); 
                     $this->session->set_userdata($data);
                  }
                  else
                  {
                       $data['ans_qno'.$question_num]=array('question_id'=>$qid,
                                 'acc_id'=>$this->session->userdata('oes_acc_id'),
                                 'correct_ans'=>$correct_ans,
                                 'given_ans'=>$option,
                                 'mark'=>0); 

                       $this->session->set_userdata($data);
                  }
                 
                }

           $sid=$this->session->userdata('oes_acc_id');
           $this->Exam_details_model->delete_by_id($sid);
           $this->Exams_model->delete_by_id($sid);
           $total_mark=0;
           for($i=1;$i<=100;$i++)
            {
                if(!empty($this->session->userdata('ans_qno'.$i)))
                {
                    $total_mark=$total_mark+$this->session->userdata('ans_qno'.$i)['mark'];
                }            
            }
            
            if($total_mark>=40)
             {
                 
                $result="pass"; 
             }
             else
             {
                 $result="fail";
             }
             $per=($total_mark/100)*100;
                        
            
              $result_data=array('acc_id'=>$sid,
                                'exam_obtain_marks'=>$total_mark,
//                                'exam_taken_time'=>$min.':'.$sec,
                                'exam_percentage'=>$per,
                                'exam_result'=>$result,
                                'exam_language'=>$this->session->userdata('oes_language'),
                                'exam_date'=>date('Y-m-d h:i:sa'),                               
                                'exam_status'=>'1');
             
             $insert_id=$this->Exams_model->insert_data($result_data);
           
         
           
           
            for($i=1;$i<=100;$i++)
            {
                if(!empty($this->session->userdata('ans_qno'.$i)))
                {
             $this->Exam_details_model->insert_data($this->session->userdata('ans_qno'.$i),$insert_id);  
                }
                else
                {
                     $not_solved=$this->session->userdata('q'.$i);
                  $que_data=$this->Questions_model->get_questions_by_id($not_solved['question_id'],$this->session->userdata('oes_language'));
                
                      $cor_ans=$que_data->question_correct_ans;                     
                                    
                 
                  $not_solved_que=array('acc_id'=>$this->session->userdata('oes_acc_id'),
                                        'question_id'=>$not_solved['question_id'],
                                        'correct_ans'=>$cor_ans,
                                        'given_ans'=>'-',
                                        'mark'=>'0');
                  $this->Exam_details_model->insert_data($not_solved_que,$insert_id);  
                }
                
                $this->session->unset_userdata('q'.$i);
                $this->session->unset_userdata('ans_qno'.$i);
                $this->session->unset_userdata('oes_acc_no');
                $this->session->unset_userdata('oes_exam_start');
                $this->session->unset_userdata('get_question');
            }
            
             $exam_result=$this->Exam_details_model->get_result_by_id($sid,$insert_id);
               
             
            
   
                  echo json_encode(array('exam_result'=>$exam_result,
                                         'total_questions'=>100,
                                         'result'=>$result,
                                         'test_review_id'=>$insert_id));
            
        }
function result()
{
    $this->load->view('header');
    $this->load->view('result');
    $this->load->view('footer');

}

        function get_result()
{
                         if(!empty($this->input->post('get_result')))
                    {
                        $no=$this->input->post('acc_no');
                        $res=$this->Account_model->get_by_no($no);
                        if($res)
                        {
                            if($res->course_id==$this->input->post('course'))
                            {
                                $result['result']=$this->Exams_model->result_by_id(array('acc_id'=>$res->acc_id));
                           $this->load->view('header');
                           $this->load->view('result',$result);
                           $this->load->view('footer');
                            }else{
                                $this->session->set_flashdata('error',"Roll no and Course does Not Match");
                                 redirect('Examination/result');
                            }
                        }else{
                            $this->session->set_flashdata('error',"Please Enter Valid Roll NO");
                            redirect('Examination/result');
                        }
                    }
}
  
   function test_review($exam_id)
        {
         
              $id=$this->session->userdata('oes_acc_id');
              $cid=$this->session->userdata('oes_course_id');
              $lang=$this->session->userdata('oes_language');
              $data=array('acc_id'=>$id,
                          'exam_id'=>$exam_id,
                          'language'=>$lang);
              $exam_result=$this->Exam_details_model->test_review($data); 
           
          
              echo json_encode($exam_result);                  
        }
  
  
  function logout()
  {
      $this->session->sess_destroy();
     echo json_encode(array('status'=>"success"));
  }
  
  function log()
  {
      echo json_encode(array('status'=>"success"));
  }
 
  }