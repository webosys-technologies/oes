<?php


function is_member_LoggedIn($member_Logged_in)
{
     if(isset($member_Logged_in) || $member_Logged_in == TRUE)
        {
           return true;
        }else{
             return false;            
        }
}

function is_admin_LoggedIn( $admin_LoggedIn)
{ 
             
        if(isset($admin_LoggedIn) || $admin_LoggedIn == TRUE)
        {
           return true;
        }else{
             return false;            
        }
}

function is_center_LoggedIn( $center_LoggedIn)
{ 
             
        if(isset($center_LoggedIn) || $center_LoggedIn == TRUE)
        {
           return true;
        }else{
             return false;            
        }
}


function get_center_info($id)
{
   $ci =& get_instance();
   return $ci->Centers_model->get_by_id($id); 
}


function get_user_info($id)
{
    $ci =& get_instance();
   return $ci->User_model->get_user_by_id($id);
}

function custom_encode($string) {
	$key = "cYbErClINicAdItYa";
	$string = base64_encode($string);
	$string = str_replace('=', '', $string);
	$main_arr = str_split($string);
	$output = array();
	$count = 0;
	for ($i = 0; $i < strlen($string); $i++) {
		$output[] = $main_arr[$i];
		if ($i % 2 == 1) {
			$output[] = substr($key, $count, 1);
			$count++;
		}
	}
	$string = implode('', $output);
	return $string;
}

function custom_decode($string) {
	$key = "cYbErClINicAdItYa";
	$arr = str_split($string);
	$count = 0;
	for ($i = 0; $i < strlen($string); $i++) {
		if ($count < strlen($key)) {
			if ($i % 3 == 2) {
				unset($arr[$i]);
				$count++;
			}
		}
	}
	$string = implode('', $arr);
	$string = base64_decode($string);
	return $string;
}



?>

