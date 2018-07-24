<?php 

  if(!defined('BASEPATH')) exit('No direct script access allowed');



class Orders extends CI_Controller
{
  function __construct()
  {
    parent::__construct();

       if(!is_admin_LoggedIn($this->session->userdata('oes_user_LoggedIn')))
     {
         redirect('admin/index');
     }
  }
  public function index()
    {
             
            $data['orders']=$this->Orders_model->getall_orders();

         $uid=$this->session->userdata('oes_user_id');
            $result['user_data']=get_user_info($uid);
            $result['system']=$this->System_model->get_info();
           
       
            $this->load->view('admin/header',$result);
            $this->load->view('admin/orders_view',$data);
            $this->load->view('admin/footer',$result);

    }

    function ajax_edit($id)
    {
            $data = $this->Order_details_model->get_id($id);
            
         
            echo json_encode($data);
    }

      function selected_mem()
    {
          $user_LoggedIn = $this->session->userdata('user_LoggedIn');

        
        if(isset($user_LoggedIn) || $user_LoggedIn == TRUE)
        {
            $checked=$this->input->post('cba');
        $id=array();
        if($checked)
        {
          foreach ($checked as $check ) {
            $id[]=$check;
          }
            $data['student_data'] = $this->Students_model->get_multiple_id($id);
           
            $this->session->set_userdata($data);     
          $uid=$this->session->userdata('user_id');
            $result['user_info']=$this->User_model->get_user_by_id($uid);
            $result['system']=$this->System_model->get_info();
             $this->load->view('admin/header',$result);
          $this->load->view('admin/selected_student',$data);
          $this->load->view('admin/footer',$result);
        } 
        else{
           $this->session->set_flashdata('error','please select at least one student...!');
          redirect('admin/students/index');
        }

        }
        else
        {
            $this->load->view('admin/login');
        }
        
    }

    public function get_coupon()
    { 

     $id=$this->session->userdata('user_id');
      $ids=array('0',$id);
     $code=$this->input->post('txt1');
     $amt=$this->input->post('amt');
     $std=$this->input->post('std');
     $cen=$this->input->post('center');

      $data=$this->Coupons_model->get_coupon($code);

      //print_r($data);
      $dt=date('Y-m-d');
      if (isset($data)) {
      
      if(($data->center_id == 0 || $data->center_id == $id) && ($data->coupon_status == 1) && ($data->coupon_valid_from <= $dt && $data->coupon_valid_to >= $dt  ) && ($data->coupon_min_student <= $std) && ($data->coupon_limit >= 1))
      {
        $per=$data->coupon_percentage/100;
        $dis=$amt*$per;
        $net=$amt-$dis;
         $ses="Coupon Applied successfully";
        $value = array('discount' => $dis ,
                        'success' =>$ses );

          // $this->session->set_flashdata('success','Coupon added successfully');


        echo json_encode($value);
      }
      else{

           //$this->session->set_flashdata('error','Coupon code is not valid or expired');
      
          echo json_encode(array('msg'=>'Coupon code is not valid or expired'));

      }
    }
    else{
    echo json_encode(array('msg'=>'Coupon code is Invalid'));

    }



    }

      public function payment()
      {

      $id=$this->input->post('center');
      $amount=$this->input->post('amount');       
      $payable_amount=$this->input->post('payable_amount');
      $discount=$this->input->post('discount');
      $student=$this->input->post('student');
      $coupon_code=$this->input->post('coupon_code');
      $gst=$this->input->post('gst');

      

      $order=array(
        'center_id' => $id,
        'order_name' => "Admission",
        'order_amount' => $amount,
        'order_gst' => $gst,
        'order_discount' => $discount,
        'order_payable_amount' => $payable_amount,
        'student_qty' => $student,
        'order_date' =>date('Y-m-d'),
        'order_status' => "success"
      );
      // print_r($order);
      $res=$this->Orders_model->order($order);
      $fname=$this->session->userdata('user_fname');
      $mobile=$this->session->userdata('user_mobile');

      if (TRUE) {
        $pay['amount'] = $payable_amount;
          $pay['merchant_order_id'] = "-";
          $pay['center_id']=$id;
          $pay['order_id']=$res;
          $pay['name']="Admin"." ".$fname;
          $pay['email']="admin@delto.in";
          $pay['mobile']=$mobile;
          $pay['payment_gateway']="Manual";
          $pay['bank_ref_num']="-";
          $pay['payment_id']="-";
          $pay['payment_status']="success";
          $pay['payment_at']=date('Y-m-d');

          // print_r($pay);
                 $result=$this->Payment_model->addpayment($pay);

      }

         $pay['error']="None";
         $pay['coupon_code']=$coupon_code;
         $pay['productinfo']="Admission";
         $this->session->set_userdata($pay);

        $this->order_proceed($pay);

        redirect('admin/Orders/test');
        


            
    }

    function order_proceed($pay)
    {
      $stud_data=$this->session->userdata('student_data');
      // print_r($stud_data);
      foreach ($stud_data as $key )
      {
          $pass['student_id']=$key->student_id;
          $pass['course_id']=$key->course_id;
          $course_fees=$key->course_fees;
          $reexam_fees=$key->course_reexam_fees;
          $student_email=$key->student_email;
          $order_id=$pay['order_id'];
          $center_id=$pay['center_id'];
          $status=$pay['payment_status'];
            $price=$key->book_price;


          if ($pay['productinfo'] == 'Reexam') 
          {
            $amt=$reexam_fees;
            $total=$reexam_fees;
          }
          else{
              $amt=$course_fees;
          $total=$course_fees+$price;

            }
            if($pass['student_id'] != 7)
            {

          $pass['student_fname']=$key->student_fname;

          $order = array(
            'order_id' =>$order_id ,
            'center_id' =>$center_id,
            'student_id' =>$pass['student_id'],
            'course_id' => $pass['course_id'],
            'od_course_fees' =>$amt,
            'od_book_price' =>$price,
            'od_total_amount' =>$total,
            'order_detail_status'=>$status ,

          );
          
            $coupon=$pay['coupon_code'];
            

          $res=$this->Order_details_model->addorder($order);
          if($res)
          {
            if ($status == 'success') {
              
              if (!empty($coupon)) {
             $coupon_data=$this->Coupons_model->get_coupon($coupon);
              $limit=$coupon_data->coupon_limit-1;
              $data=array('coupon_limit' => $limit );

              $this->Coupons_model->coupon_update(array('coupon_code' =>$coupon ),$data);
              }


             $this->login_create($pass);

              
            }
          }
        }
      }
    }

    function login_create($pass)
    {
      // $res=$this->Courses_model->course_by_id($pass['course_id']);
      // foreach ($res as $key) {
      // // echo $dur=$key->course_duration;
      // }
       $alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
             $password = array(); 
             $alpha_length = strlen($alphabet) - 1; 
             for ($i = 0; $i < 8; $i++) 
             {
                 $n = rand(0, $alpha_length);
                 $password[] = $alphabet[$n];
             }
             $pwd= implode($password); 
             
             $result=$this->Students_model->get_id($pass['student_id']);

             if (empty($result->student_username))
             {     

      $data = array('student_admission_month' => date('M-Y'),
                    'student_admission_date' => date('Y-m-d '),
                    'student_username' =>strtolower($pass['student_fname']).$pass['student_id'] ,
                    'student_password' =>$pwd ,
                    'student_status' =>'1' );
             $this->Students_model->student_update(array('student_id'=>$pass['student_id']),$data);

           }else{

            $data=array('student_exam_passcode' => "");
             $this->Students_model->student_update(array('student_id'=>$pass['student_id']),$data);

           }



    }

     function test()
    {
      $user_LoggedIn=$this->session->userdata('user_LoggedIn');

        if(isset($user_LoggedIn) || $user_LoggedIn == TRUE)
        {
          $data = array(
                'name' => $this->session->userdata('name'),
                'email' => $this->session->userdata('email'),
                'mobile' => $this->session->userdata('mobile'),
                'amount' => $this->session->userdata('amount'),
                'payment_status' => $this->session->userdata('payment_status'),
                'error'=>$this->session->userdata('error'),
                 );
                
         $uid=$this->session->userdata('user_id');
            $result['system']=$this->System_model->get_info();
            $result['user_info']=$this->User_model->get_user_by_id($uid);
       
            $this->load->view('admin/header',$result);
            $this->load->view('admin/status',$data);
            $this->load->view('admin/footer',$result);
              
        }
        else{
          redirect('admin/index/login');
        }
      }
	
    
}



 ?>