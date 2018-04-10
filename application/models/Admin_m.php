<?php

class Admin_m extends CI_Model{
	
	public function login()
	{
		$results = $this->db->get_where('users',array('email'=>$_POST['email'],'password'=>$_POST['password']));
		if($results-> num_rows()>0){return $results->result_array();}else{return false;}
	}
	
	public function checkEmployeeExist($email){
		$this->db->select('*');
		$this->db->from('users');
		$this->db->where('email',$email);
		$query = $this->db->get();
		
		if($query->num_rows()>0){return $query->result_array();}else{return false;}
	}
	
	public function updateImage($params){
		$user_id = $params['id'];
		$this->db->where('id', $user_id);
        $result = $this->db->update('users',$params);
		if($result){ return true; }else{return false;}
	}
	
	public function getlog($id)
	{
		$results = $this->db->get_where('users_log',array('ul_userid'=>$id));
		if($results-> num_rows()>0){return $results->result_array();}else{return false;}
	}
	
	public function createlog($id){
        $result = $this->db->insert('users_log',$id);
		if($result){ return true; }else{return false;}
	}
	
	public function updatelog($params){
		$user_id = $params['ul_userid'];
		$this->db->where('ul_userid', $user_id);
        $result = $this->db->update('users_log',$params);
		if($result){ return true; }else{return false;}
	}
	
	public function getAllUsers(){
		$this->db->where("id !=",$this->session->userdata('id'));
		$results = $this->db->get('users');
		if($results-> num_rows()>0){return $results->result_array();}else{return false;}
	}
	
	public function getFriends(){
		$this->db->select('*');
		$this->db->from('users u, users_log ul, friend_list fl');
		$this->db->where('u.id != "'.$this->session->userdata('id').'"');
		$this->db->where('u.id = ul.ul_userid');
		$this->db->where('(u.id = fl.fl_userid OR u.id = fl.fl_empid)', NULL, FALSE);
		$this->db->where('(fl.fl_userid = "'.$this->session->userdata('id').'" OR fl.fl_empid = "'.$this->session->userdata('id').'")', NULL, FALSE);
		$this->db->where('fl.fl_status', 'accept'); 
		$this->db->order_by('ul.ul_status', 'DESC'); 
		$sql = $this->db->get();
		if($sql->num_rows() > 0){return $sql->result_array();}else{return false;} 
	}
	
	public function getUnfriends(){
		$this->db->select('*')
			 ->from('users AS u')
             ->where('u.id != "'.$this->session->userdata('id').'"')
             ->where('(u.id NOT IN (select fl_empid from friend_list where fl_userid = "'.$this->session->userdata('id').'") AND u.id NOT IN (select fl_userid from friend_list where fl_empid = "'.$this->session->userdata('id').'") OR u.id IN (select fl_empid from friend_list where fl_status = "reject" AND fl_userid = "'.$this->session->userdata('id').'" AND fl_request = "active") OR u.id IN (select fl_userid from friend_list where fl_status = "reject" AND fl_empid = "'.$this->session->userdata('id').'" AND fl_request = "active"))',NULL,FALSE);
		$sql = $this->db->get();
		if($sql->num_rows() > 0){return $sql->result_array();}else{return false;}
	} 
	
	//OR u.id IN (select fl_empid from friend_list where fl_status = "reject") OR u.id IN (select fl_userid from friend_list where fl_status = "reject")
	/* public function getUnfriends(){
		$sql = $this->db->select('*')
            ->from('users AS u')
            ->where('u.id != "'.$this->session->userdata('id').'"')
            ->where('(u.id NOT IN (select fl_empid from friend_list where fl_userid = "'.$this->session->userdata('id').'") OR u.id = (select fl_empid from friend_list where fl_status = "reject" AND fl_empid = "'.$this->session->userdata('id').'"))',NULL,FALSE)->get();
		if($sql->num_rows() > 0){return $sql->result_array();}else{return false;}
	} */ 
	
	public function getRequests(){
		$sql = $this->db->select('*')
            ->from('users u, friend_list fl')
            ->where('u.id = fl.fl_userid')
            ->where('fl.fl_empid', $this->session->userdata('id'))
            ->where('fl.fl_status', 'pending')
            ->where('fl.fl_request', 'active')
            ->get();
		if($sql->num_rows() > 0){return $sql->result_array();}else{return false;}
	}
	
	public function checkRequest($param){
		$fl_userid = $param['fl_userid'];
		$fl_empid = $param['fl_empid'];
		$this->db->where('((fl_userid = "'.$fl_userid.'" AND fl_empid = "'.$fl_empid.'") OR (fl_userid = "'.$fl_empid.'" AND fl_empid = "'.$fl_userid.'"))', NULL, FALSE);
		$results = $this->db->get('friend_list');
		if($results-> num_rows()>0){return $results->result_array();}else{return false;}
	}
	
	public function addRequest($params){
        $result = $this->db->insert('friend_list',$params);
		if($result){ return true; }else{return false;}
	}
	
	public function actionRequest($params){
		$this->db->where('fl_empid', $params['fl_empid']);
		$this->db->where('fl_userid', $params['fl_userid']);
		$this->db->where('fl_request', 'active');
        $result = $this->db->update('friend_list',$params);
		if($result){ return true; }else{return false;}
	}
	
	public function chating($params){
        $result = $this->db->insert('chating',$params);
		if($result){ return true; }else{return false;}
	}
	
	public function updateChatStatus($params){
		$user_id = $params['chat_userid'];
		$emp_id = $params['chat_empid'];
		$this->db->where('chat_userid', $user_id);
		$this->db->where('chat_empid', $emp_id);
		$this->db->where('chat_status', 'unseen');
        $result = $this->db->update('chating',$params);
		if($result){ return true; }else{return false;}
	}
	
	/*** NOTIFICATION, FRIEND REQUEST & MESSAGES ***/
	
	public function getMessages(){
		$employee_id = $this->session->userdata('id');
		$sql = "SELECT * FROM ( SELECT * FROM chating WHERE chat_empid = '$employee_id' AND chat_status = 'unseen' OR chat_empid = '$employee_id' AND chat_status = 'seen' ORDER BY chat_id DESC LIMIT 99999999999) AS chat  GROUP BY chat.chat_userid ORDER BY chat.chat_datetime DESC";
		$result = $this->db->query($sql)->result_array();
		if($result){return $result;}else{return false;} 
	}
	
	/* public function getUnseenMessages(){
		$employee_id = $this->session->userdata('id');
		$sql = "SELECT * FROM ( SELECT * FROM chating WHERE chat_empid = '$employee_id' AND chat_status = 'unseen' ORDER BY chat_id DESC LIMIT 18446744073709551610) AS chat GROUP BY chat.chat_userid ORDER BY chat_id DESC";
		$result = $this->db->query($sql)->result_array();
		if($result){return $result;}else{return false;} 
	}
	public function getSeenMessages(){
		$employee_id = $this->session->userdata('id');
		$sql = "SELECT * FROM ( SELECT * FROM chating WHERE chat_empid = '$employee_id' AND chat_status = 'seen' ORDER BY chat_id DESC LIMIT 10) AS chat GROUP BY chat.chat_userid ";
		$result = $this->db->query($sql)->result_array();
		if($result){return $result;}else{return false;}  
	} */
	public function updateMessagesStatus(){
		$this->db->where('chat_empid',$this->session->userdata('id'));
		$this->db->where('chat_status', 'unseen');
        $result = $this->db->update('chating',array("chat_status"=>"seen"));
		if($result){ return true; }else{return false;}
	}
	/*** END NOTIFICATION, FRIEND REQUEST & MESSAGES ***/
}