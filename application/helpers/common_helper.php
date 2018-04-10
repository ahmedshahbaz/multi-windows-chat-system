<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*********************************** Location Helper Functions ****************************************/
if (!function_exists('userName'))
{
	function userName($id)
	{
		$ci=& get_instance();
		$ci->load->database();
		$query = $ci->db->get_where('users',array('id'=>$id));
		if($query->num_rows()>0) return $query->first_row()->name;
	}   
}
if (!function_exists('userImage'))
{
	function userImage($id)
	{
		$ci=& get_instance();
		$ci->load->database();
		$query = $ci->db->get_where('users',array('id'=>$id));
		if($query->num_rows()>0) return $query->first_row()->image;
	}   
}

/*********************************** Date Convertion Helper Functions ****************************************/
if (!function_exists('date_to_mysql'))
{
	function date_to_mysql($date)
	{
		$convertDate = date('Y-m-d', strtotime($date));
		return $convertDate;
	}   
}

if (!function_exists('date_from_mysql'))
{
	function date_from_mysql($date)
	{
		$convertDate = date('m-d-Y', strtotime($date));
		return $convertDate;
	}   
}

if (!function_exists('explode_date'))
{
	function explode_date($date)
	{
		$explode = explode(" ", $date);
		$date = $explode[0];
		$convertDate = date('m-d-Y', strtotime($date));
		return $convertDate;
	}   
}

if (!function_exists('explode_time'))
{
	function explode_time($date)
	{
		$explode = explode(" ", $date);
		$time = $explode[1];
		return $time;
	}   
}
/*********************************** End Date Convertion Helper Functions ****************************************/
	function time_ago($timestamp) {
		//date_default_timezone_set("Asia/Kolkata"); 
        $explodeDate = explode(" ", $timestamp);
		$time_ago        = strtotime($timestamp);
		$current_time    = time();
		$time_difference = $current_time - $time_ago;
		$seconds         = $time_difference;

		$minutes = round($seconds / 60); // value 60 is seconds  
		$hours   = round($seconds / 3600); //value 3600 is 60 minutes * 60 sec  
		$days    = round($seconds / 86400); //86400 = 24 * 60 * 60;  
		$weeks   = round($seconds / 604800); // 7*24*60*60;  
		$months  = round($seconds / 2629440); //((365+365+365+365+366)/5/12)*24*60*60  
		$years   = round($seconds / 31553280); //(365+365+365+365+366)/5 * 24 * 60 * 60
						
		if ($seconds <= 60){
			return "Just Now";
		} 
		else if ($minutes <= 60){
			if ($minutes == 1){
			  return "a minute ago";
			} 
			else {
			  return "$minutes minutes ago";
			}
		} 
		else if ($hours <= 23){
			if ($hours == 1){
			  return "an hour ago";
			} else {
			  return "$hours hrs ago";
			}
		} 
		else {
			if ($days == 1){
			  return "Yesterday"." ".date("g:i a", strtotime($explodeDate[1]));
			} else {
			  return /* "$days days ago" */date("m/d/Y", strtotime($explodeDate[0]))." ".date("g:i a", strtotime($explodeDate[1]));
			}
		} 
		/* else if ($weeks <= 4.3){
			if ($weeks == 1){
			  return "a week ago";
			} else {
			  return "$weeks weeks ago";
			}
		} 
		else if ($months <= 12){
			if ($months == 1){
			  return "a month ago";
			} else {
			  return "$months months ago";
			}
		} 
		else {
			if ($years == 1){
			  return "a year ago";
			} else {
			  return "$years years ago";
			}
		} */  
	}
?>