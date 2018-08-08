<?php         

defined('BASEPATH') OR exit('No direct script access allowed');

 class Payment extends CI_Controller {

	public function __construct() {
        parent::__construct();
       if(!is_center_LoggedIn($this->session->userdata('oes_center_LoggedIn')))
     {
         redirect('center/Index/login');
     }        

    }

    public function index()
    {
     
    $id=$this->session->userdata('oes_center_id');
    $data['payment']=$this->Payment_model->get_by_center_id($id);
            $result['system']=$this->System_model->get_info();
     $result['data']=get_center_info($id);        
    $this->load->view('center/header',$result);
    $this->load->view('center/payment_view',$data);
    $this->load->view('center/footer',$result);
       
    } 

	public function status() {
       $status = $this->input->post('status');
      if (empty($status)) {
            redirect('center/Account');
        }
       
         $firstname = $this->input->post('firstname');
        $amount = $this->input->post('amount');
        $txnid = $this->input->post('txnid');
        $posted_hash = $this->input->post('hash');
        $key = $this->input->post('key');
        $productinfo = $this->input->post('productinfo');
        $email = $this->input->post('email');
        $mobile=$this->input->post('phone');
        $pg=$this->input->post('PG_TYPE');
        $bank=$this->input->post('bank_ref_num');
        $id=$this->input->post('payuMoneyId');
        $center_id=$this->input->post('udf1');
        $order_id=$this->input->post('udf2');
        $coupon_code=$this->input->post('udf3');
        $error=$this->input->post('error');


        $salt = "KejTc6CuIJ"; //  Your salt
        $add = $this->input->post('additionalCharges');
        If (isset($add)) {
            $additionalCharges = $this->input->post('additionalCharges');
            $retHashSeq = $additionalCharges . '|' . $salt . '|' . $status . '|||||||||||' . $email . '|' . $firstname . '|' . $productinfo . '|' . $amount . '|' . $txnid . '|' . $key;
        } else {

            $retHashSeq = $salt . '|' . $status . '|||||||||||' . $email . '|' . $firstname . '|' . $productinfo . '|' . $amount . '|' . $txnid . '|' . $key;
        }
         //$data['hash'] = hash("sha512", $retHashSeq);
          $pay['amount'] = $amount;
          $pay['merchant_order_id'] = $txnid;
         // $data['posted_hash'] = $posted_hash;
         
         // $data['additionalCharges']=$add;
          $pay['center_id']=$center_id;
          $pay['order_id']=$order_id;
          $pay['name']=$firstname;
          $pay['email']=$email;
          $pay['mobile']=$mobile;
          $pay['payment_gateway']=$pg;
          $pay['bank_ref_num']=$bank;
          $pay['payment_id']=$id;
          $pay['payment_status']=$status;
          $pay['payment_at']=date('Y-m-d');


          if(isset($status)){
                 $result=$this->Payment_model->addpayment($pay);
                 if ($result)
                 {
                  $this->Orders_model->update_order($order_id);
                    if($status)
                    {
                       $pay['error']=$error;
                       $pay['coupon_code']=$coupon_code;
                       $pay['productinfo']=$productinfo;

                      $this->Order_details($pay);
                    }
                    $id=$this->session->userdata('oes_center_id');
                     $res['data']=get_center_info($id);    

                    $this->session->set_userdata($pay);
                    
                        if($status == "success")
                        {
                        $admin_data=array('amount'=>$amount,
                                          'tid'=>$this->input->post('payuMoneyId'),
                                          'pid'=>$result,
                                          'center_id'=>$this->session->userdata('oes_center_id'));
                        $user_email=$this->User_model->getall_email();
                        foreach ($user_email as $mail)
                        {
                            $this->admin_payment_success_email($mail->user_email,$admin_data);
                        }
                        
                            $center_data=array('fname'=>$this->session->userdata('center_fname'),
                                               'oid'=>$order_id,
                                                'email'=>$this->session->userdata('center_email'));
                            
                            $this->center_payment_success_email($center_data);
                        }
                    
                    redirect('center/Payment/test');
                    
                    // $this->load->view('center/header',$res);
                    // $this->load->view('center/status',$pay);
                    // $this->load->view('center/footer');
                 }
         }
         else{
              $this->load->view('center/student'); 
         }

     
    }
   function Order_details($data)
    {
       
      $stud_data=$this->session->userdata('account_data');

      foreach ($stud_data as $key )
      {
          $pass['acc_id']=$key->acc_id;
          $pass['course_id']=$key->course_id;
          $course_fees=$key->course_fees;
//          $reexam_fees=$key->course_reexam_fees;
//          $student_email=$key->student_email;
          $order_id=$data['order_id'];
          $center_id=$data['center_id'];
          $status=$data['payment_status'];
//            $price=$key->book_price;



//          $pass['student_fname']=$key->student_fname;

          $order = array(
            'order_id' =>$order_id ,
            'center_id' =>$center_id,
            'acc_id' =>$pass['acc_id'],
            'course_id' => $pass['course_id'],
            'od_course_fees' =>$key->course_fees,
//            'od_book_price' =>$price,
            'od_total_amount' =>$key->course_fees,
            'order_detail_status'=>$status ,

          );
          
            $coupon=$data['coupon_code'];
            

          $res=$this->Order_details_model->addorder($order);
          if($res)
          {
            if ($status == 'success') {
              
              if (!empty($coupon)) {
             $coupon_data=$this->Coupons_model->get_coupon($coupon);
              $limit=$coupon_data->coupon_limit-1;
              $data1=array('coupon_limit' => $limit );

              $this->Coupons_model->coupon_update(array('coupon_code' =>$coupon ),$data1);
              }


             $this->login_create($pass);

              
            }
          }
      }

    }

    function login_create($pass)
    {
    
//             $result=$this->Account_model->get_by_id($pass['acc_id']);

             

      $data = array('acc_valid_from' => date('Y-m-d '),
//                    'acc_valid_to' =>date('Y-m-d', strtotime('+1 years 11 month 2 days')),
                    'acc_valid_to' =>date('Y-m-d', strtotime('+1 years')),
                    'acc_status' =>'1' );
//      print_r($data);
//      echo $pass['acc_id'];
//      die;
             $this->Account_model->account_update(array('acc_id'=>$pass['acc_id']),$data);

         

    }

    function test()
    {
     
          $data = array(
                'name' => $this->session->userdata('name'),
                'email' => $this->session->userdata('email'),
                'mobile' => $this->session->userdata('mobile'),
                'amount' => $this->session->userdata('amount'),
                'payment_status' => $this->session->userdata('payment_status'),
                'error'=>$this->session->userdata('error'),
                 );
                
              $id=$this->session->userdata('oes_center_id');
            $result['system']=$this->System_model->get_info();
                $result['data']=get_center_info($id);      
              $this->load->view('center/header',$result);
                $this->load->view('center/status',$data);
                $this->load->view('center/footer',$result);
              
       
      }
      
      function center_payment_success_email($data)
      {
                $result=$this->Orders_model->get_by_id($data['oid']);
                    $headers = "From:  team@delto.in";
                    $headers .= ". Delto-Team" . "\r\n";
                    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
                    $to =$data['email'];
                    $subject = "Delto Order No.".$data['oid'];

                    $txt ='<span>Dear '. $data['fname'].',</span> <br><br>

                            <span>Your order successfully placed for admission.</span><br><br>

                            <span>Order Id: '.$data['oid'].'</span><br>
                            <span>Order Amount: '.$result->order_amount.'</span><br>
                            <span>Order Discount: '.$result->order_discount.'</span><br>
                            <span>Order Paid Amount: '.$result->order_payable_amount.'</span><br><br>


                            <span>To view the admission details, <a href="'.  base_url().'center/index/login">login here.</a></span><br><br>

                            <span>In case of any queries please reply us with this email.</span><br><br>

                            <span>Thanks & regards</span><br>
                            <span>Delto team.</span><br>
                            <span>Webosys Technologies.</span><br>
                            <a href="mailto:team@delto.in" target="_top">team@delto.in</a><br>
                            <a href="www.delto.in" target="_blank">www.delto.in</a>';  
                                            
                 
                       $success=  mail($to,$subject,$txt,$headers); 
                       if($success)
                       {
                          return true;
                       }else{
                           return false;
                       }
      }

      function admin_payment_success_email($mail,$data)
      {
        $result=$this->Centers_model->get_id($data['center_id']);


           $headers = "From: support@delto.in";
                    $headers .= ". Webosys-Team" . "\r\n";
                    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
                    $to =$mail;
                    $subject = 'You have received an amount of: Rs.'.$data['amount'];

                    $txt = '<html><body>
                           <span>Dear Delto,</span><br><br> 

                            <span>You have received an amount of: Rs.<b>'.$data['amount'].'</b>, for the PayUmoney Transaction ID: '.$data['tid'].'.</span><br><br>

                            <span><b>Payee Information:</b></span><br>
                            <span>Delto Payment ID: '.$data['pid'].'</span><br><br>

                            <span><b>Payer Information:</b></span><br>
                            <span>Center Name:'.$result->center_name.'</span><br>
                            <span>Center ID: '.$data['center_id'].'</span><br><br>
                            <span>Center Location:'.$result->center_city.'</span><br>                            

                            <span>To view details of the payment, <a href="'.base_url().'admin/index/login">login here.</span><br><br>

                            <span>In case of any queries please mention the Transaction ID while contacting the Webosys team.</span><br><br>

                            <span>Thanks & regards</span><br>
                            <span>Webosys team.</span><br>
                            <a href="mailto:team@webosys.com" target="_top">team@webosys.com</a>
                             </body></html>';
                              
                                              
                                            
                 
                       $success=  mail($to,$subject,$txt,$headers); 
                       if($success)
                       {
//                           echo "success";
                          return true;
                       }else{
                           return false;
                       }
      }
      
      function getall_email()
      {
          $res=$this->User_model->getall_email();
          print_r($res);
      }

      function date_calculation()
      {
          $end = date('Y-m-d', strtotime('+0 years 12 month'));
          echo $end;
      }
    
   }

   ?>