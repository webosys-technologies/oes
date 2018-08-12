  <?php if(!defined('BASEPATH')) exit('No direct script access allowed');



class Orders extends CI_Controller
{
  function __construct()
  {
    parent::__construct();
    
     if(!is_center_LoggedIn($this->session->userdata('oes_center_LoggedIn')))
     {
         redirect('center/Index/login');
     }

  }
  function index()
  {
   

            $id=$this->session->userdata('oes_center_id');
            $data['orders']=$this->Orders_model->get_all_id($id);
            $result['system']=$this->System_model->get_info();
              $result['data']=get_center_info($id);      
              $this->load->view('center/header',$result);
            $this->load->view('center/orders_view',$data);
            $this->load->view('center/footer',$result);


    
  }

  function ajax_edit($id)
    {
            $data = $this->Order_details_model->get_id($id);
            
         
            echo json_encode($data);
    }

    function invoice_details($id)
    {
            $data = $this->Order_details_model->get_invoice($id);
            
        // print_r($data);
            echo json_encode($data);
    }  
    

	function selected_mem()
    {
          $oes_center_LoggedIn = $this->session->userdata('oes_center_LoggedIn');

        
        if(isset($oes_center_LoggedIn) || $oes_center_LoggedIn == TRUE)
        {
            $checked=$this->input->post('cba');
        $id=array();
        if($checked)
        {
          foreach ($checked as $check ) {
            $id[]=$check;
          }
            $data['account_data'] = $this->Account_model->get_multiple_id($id);
           
            $this->session->set_userdata($data);     
          $center_id=$this->session->userdata('oes_center_id');
          $result['system']=$this->System_model->get_info();
          $result['data']=get_center_info($center_id);       
          $this->load->view('center/header',$result);
          $this->load->view('center/selected_acc',$data);
          $this->load->view('center/footer',$result);
        } 
        else{
           $this->session->set_flashdata('error','please select at least one Account...!');
          redirect('center/Account');
        }

        }
        else
        {
            $this->load->view('center/login');
        }
        
    }
    
    function remove_acc_from_order($id)
    {
        $data=$this->session->userdata();        
        print_r($data);
        echo "<pre>";
//        $data=$this->Account_model->get_by_id($id);
//        $this->session->unset_userdata($data);
//        echo json_encode(array('status'=>true));
    }

    public function get_coupon()
    { 

     $id=$this->session->userdata('oes_center_id');
      $ids=array('0',$id);
     $code=$this->input->post('txt1');
     $amt=$this->input->post('amt');
     $std=$this->input->post('std');

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
    


    function payment()
    {      

       $id=$this->session->userdata('oes_center_id');
       $fname=$this->session->userdata('oes_center_fname');
       $lname=$this->session->userdata('oes_center_lname');
       $email=$this->session->userdata('oes_center_email');
       $mobile=$this->session->userdata('oes_center_mobile');
       $center_name=$this->session->userdata('oes_center_name');
       $amount=$this->input->post('amount');       
       $payable_amount=$this->input->post('payable_amount');
       $discount=$this->input->post('discount');
      $account=$this->input->post('account');
      $coupon_code=$this->input->post('coupon_code');
      $gst=$this->input->post('gst');


      $order=array(
        'center_id' => $id,
        'order_name' => "Account Creation",
        'order_amount' => $amount,
        'order_discount' => $discount,
        'order_payable_amount' => $payable_amount,
        'acc_qty' => $account,
        'order_date' =>date('Y-m-d'),
        'order_status' => "pending"
      );
      $res=$this->Orders_model->order($order);
      
//      echo $res;
//      die;
      if ($res) {
        
      
        $customer_name=$fname;
        $customer_email=$email;
        $customer_mobile=$mobile;
        $product_info="Account Creation";
        //$customer_address=$e;

//       $MERCHANT_KEY = "O9h9G1PC"; //change  merchant with yours
//          $SALT = "KejTc6CuIJ";  //change salt with yours 
        $MERCHANT_KEY = "Z8TeLZnZ"; //for suraj
          $SALT = "Mt8PAIV9Ig";  //for suraj
          $txnid = substr(hash('sha256', mt_rand() . microtime()), 0, 20);
          //optional udf values 
          $udf1 = $id;
          $udf2 = $res;
          $udf4 = '';
          $udf5 = '';

          if (empty($coupon_code)) {
        $udf3 ='';
        

      }else{
          $udf3 = $coupon_code;

      }
           $hashstring = $MERCHANT_KEY . '|' . $txnid . '|' . $payable_amount . '|' . $product_info . '|' . $customer_name . '|' . $customer_email . '|' . $udf1 . '|' . $udf2 . '|' . $udf3 . '|' . $udf4 . '|' . $udf5 . '||||||' . $SALT;
           $hash = strtolower(hash('sha512', $hashstring));
           
         $success = base_url() . 'center/payment/status';  
          $fail = base_url() . 'center/payment/status';
          $cancel = base_url() . 'center/Account';
          
          
           $data = array(
              'mkey' => $MERCHANT_KEY,
              'tid' => $txnid,
              'hash' => $hash,
              'amount' => $payable_amount,           
              'firstname' => $customer_name,
              'productinfo' => $product_info,
              'email' => $customer_email,
              'phone' => $customer_mobile,
              'udf1' => $udf1,
              'udf2' =>$udf2,
              'udf3' =>$udf3,
              'no_of_account'=>$account,
              'center_name' =>$center_name,
              'service_provider' => ".payu_paisa", //for live change action  https://secure.payu.in
              'success' => $success,
              'failure' => $fail,
              'cancel' => $cancel            
          );

           // print_r($data);
           
            $result['system']=$this->System_model->get_info();
          $result['data']=get_center_info($id);             
             $this->load->view('center/header',$result);
              $this->load->view('center/payu_view',$data);
                 $this->load->view('center/footer',$result);     

        }
        else
        {
          echo "order table insertion issue";
        }


            
    }

    function test()
    {
      $res=$this->Orders_model->test();
      if ($res) {
        $this->index();
      }
    }

    function test1()
    {
      $res=$this->Orders_model->test1();
      if ($res) {
        $this->index();
      }
    }



    
}



 ?>