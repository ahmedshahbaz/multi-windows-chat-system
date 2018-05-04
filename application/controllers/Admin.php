<?php
defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set('Asia/Karachi');
class Admin extends CI_Controller {

	public function index()
	{
		if($this->input->post())
		{
			$userdata = $this->Admin_m->login($_POST);
			if(!empty($userdata)){
				$userlog = $this->Admin_m->getlog($userdata[0]['id']);
				if(empty($userlog)){
					$this->Admin_m->createlog(array('ul_userid'=>$userdata[0]['id'], 'ul_status'=>'online'));
					$session = array(
						'id'=>$userdata[0]['id'],
						'email'=>$userdata[0]['email'],
						'password'=>$userdata[0]['password'],
						'name'=>$userdata[0]['name'],
						'image'=>$userdata[0]['image']
					);
				}
				else{
					$this->Admin_m->updatelog(array('ul_userid'=>$userdata[0]['id'], 'ul_status'=>'online'));
					$session = array(
						'id'=>$userdata[0]['id'],
						'email'=>$userdata[0]['email'],
						'password'=>$userdata[0]['password'],
						'name'=>$userdata[0]['name'],
						'image'=>$userdata[0]['image']
					);
				} 
					
				$this->session->set_userdata($session);
				redirect('Admin/home');
			}
		}
		else{
			$this->load->view('index');
		} 
		//$this->load->view('index');
	}
	
	/* public function login(){
		//$id = $_POST['id'];
		$name = $_POST['name'];
		$email = $_POST['email'];
		$image = $_POST['image'];
		$userdata = $this->Admin_m->checkEmployeeExist($email);
		if(!empty($userdata)){
			$this->Admin_m->updateImage(array('id'=>$userdata[0]['id'],'image'=>$image));
			$userlog = $this->Admin_m->getlog($userdata[0]['id']);
				if(empty($userlog)){
					$this->Admin_m->createlog(array('ul_userid'=>$userdata[0]['id'], 'ul_status'=>'online'));
					$session = array(
						'id'=>$userdata[0]['id'],
						'email'=>$userdata[0]['email'],
						'name'=>$userdata[0]['name'],
						'image'=>$image
					);
				}
				else{
					$this->Admin_m->updatelog(array('ul_userid'=>$userdata[0]['id'], 'ul_status'=>'online'));
					$session = array(
						'id'=>$userdata[0]['id'],
						'email'=>$userdata[0]['email'],
						'name'=>$userdata[0]['name'],
						'image'=>$image
					);
				}
				$this->session->set_userdata($session);
				echo json_encode(true);
		}
		else{
			echo json_encode(false);
		}
	} */
	
	public function home()
	{
		$data['getFriends'] = $this->Admin_m->getFriends();
		$data['getUnfriends'] = $this->Admin_m->getUnfriends();
		$data['getRequests'] = $this->Admin_m->getRequests(); 
		$data['countUnseenMessages'] = $this->db->where('chat_status','unseen')->where('chat_empid',$this->session->userdata('id'))->count_all_results('chating');
		$chatMessages = $this->Admin_m->getMessages();
		$data['chat_userid'] = ($chatMessages) ? $chatMessages[0]["chat_userid"]: "";
		$data['getMessages'] = $chatMessages;
		
		$this->load->view('chat', $data);
	}
	
	public function addRequest(){
		// Load the library.
		// You can also autoload the library by adding it to config/autoload.php
		 require_once APPPATH.'third_party\vendor\autoload.php';

		 // Change the following with your app details:
		// Create your own pusher account @ www.pusher.com
		$app_id = ''; // App ID
		$app_key = ''; // App Key
		$app_secret = ''; // App Secret
		$options = array(
			'cluster' => '',
			'encrypted' => true
		  );
		$pusher = new Pusher\Pusher($app_key, $app_secret, $app_id, $options);
		$userid = $this->session->userdata('id');
		$empid = $_POST['id'];
		$data['sender_id'] = $userid;
		$data['receiver_id'] = $empid;
		$data['sender_name'] = $this->session->userdata('name');
		$data['sender_image'] = $this->session->userdata('image');
		if($pusher->trigger('request_channel', 'request_event', $data)) {
			$sql = $this->Admin_m->checkRequest(array('fl_userid'=>$userid, 'fl_empid'=>$empid));
			if($sql != ''){
				if($sql[0]['fl_status'] == 'reject'){
					$this->Admin_m->actionRequest(array('fl_id'=>$sql[0]['fl_id'], 'fl_status'=>'pending', 'fl_request'=>'inactive'));
					$this->Admin_m->addRequest(array('fl_userid'=>$userid, 'fl_empid'=>$empid, 'fl_status'=>'pending'));
					echo "success";
					//echo json_encode(true);
				}
				else{
					echo "error";
					//echo json_encode(false);
				}
			}
			else{
				$this->Admin_m->addRequest(array('fl_userid'=>$userid, 'fl_empid'=>$empid, 'fl_status'=>'pending'));
				echo "success";
				//echo json_encode(true);
			}
		}
		else{
			echo "error";
		}
	}
	
	/* public function actionRequest(){
		$id = $_POST['id'];
		$empid = $_POST['empid'];
		$status = $_POST['status'];
		$result = $this->Admin_m->actionRequest(array('fl_id'=>$id, 'fl_status'=>$status));
		if($result){
			echo "success";
		}
	} */
	
	public function actionRequest(){
		// Load the library.
		// You can also autoload the library by adding it to config/autoload.php
		 require_once APPPATH.'third_party\vendor\autoload.php';

		 // Change the following with your app details:
		// Create your own pusher account @ www.pusher.com
		$app_id = ''; // App ID
		$app_key = ''; // App Key
		$app_secret = ''; // App Secret
		$options = array(
			'cluster' => '',
			'encrypted' => true
		  );
		$pusher = new Pusher\Pusher($app_key, $app_secret, $app_id, $options);
		$userid = $_POST['id'];
		$empid = $_POST['empid'];
		$status = $_POST['status'];
		$userid = $this->session->userdata('id');
		$data['receiver_id'] = $empid;
		$data['receiver_name'] = userName($empid);
		$data['receiver_image'] = userImage($empid);
		$data['sender_id'] = $userid;
		$data['sender_name'] = $this->session->userdata('name');
		$data['sender_image'] = $this->session->userdata('image');
		if($pusher->trigger('actionRequest_channel', 'actionRequest_event', $data)) {
			$result = $this->Admin_m->actionRequest(array('fl_empid'=>$userid, 'fl_userid'=>$empid, 'fl_status'=>$status));
			if($result){
				echo "success";
			}
		}
	}
	
	
	public function chating(){
		
		// Load the library.
		// You can also autoload the library by adding it to config/autoload.php
		 require_once APPPATH.'third_party\vendor\autoload.php';

		 // Change the following with your app details:
		// Create your own pusher account @ www.pusher.com
		$app_id = ''; // App ID
		$app_key = ''; // App Key
		$app_secret = ''; // App Secret
		$options = array(
			'cluster' => '',
			'encrypted' => true
		  );
		$pusher = new Pusher\Pusher($app_key, $app_secret, $app_id, $options);
		
		$user_id = $this->session->userdata('id');
		$employee_id = $_POST['employee_id'];
		$msg = $_POST['msg'];
		$chat_status = 'unseen';
		$data['message'] = $_POST['msg'];
		$data['employee_id'] = $_POST['employee_id'];
		$data['employee_name'] = userName($_POST['employee_id']);
		$data['sender_name'] = userName($user_id);
		$data['id'] = $user_id;
		$data['datetime'] = time_ago(date('Y-m-d H:i:s'));
		
		$result = $this->Admin_m->chating(array('chat_userid'=>$user_id, 'chat_empid'=>$employee_id, 'chat_msg'=>$msg, 'chat_status'=>$chat_status));
		
		// Return the received message
		if($pusher->trigger('test_channel', 'my_event', $data)) {               
			echo 'success';         
		} else {        
			echo 'error';   
		}
	}
	
	public function getChat(){
		$user_id = $this->session->userdata('id');
		$employee_id = $_POST['employee_id'];
		$sql = "SELECT * FROM (SELECT * FROM chating WHERE chat_userid='".$user_id."' AND chat_empid='".$employee_id."' || chat_userid='".$employee_id."' AND chat_empid='".$user_id."' ORDER BY chat_datetime DESC LIMIT 5) tmp ORDER BY tmp.chat_datetime ASC";
		$result = $this->db->query($sql)->result_array();
		if(!empty($result)){
			$data = array();
			foreach($result as $chat){
				$data[] = array(
					'chat_id'=>$chat['chat_id'],
					'chat_userid'=>$chat['chat_userid'],
					'chat_username'=>userName($chat['chat_userid']),
					'chat_empid'=>$chat['chat_empid'],
					'chat_empname'=>userName($chat['chat_empid']),
					'chat_msg'=>$chat['chat_msg'],
					'chat_status'=>$chat['chat_status'],
					'chat_datetime'=>time_ago($chat['chat_datetime'])
				);
			}
			echo json_encode($data);
		} 
		else{
			echo json_encode(false);
		} 
	}
	
	public function loadConversation(){
		$user_id = $this->session->userdata('id');
		$employee_id = $_POST['employee_id'];
		$lastId = $_POST['lastId'];
		
		$sql = "SELECT * FROM (SELECT * FROM chating WHERE chat_userid='".$user_id."' AND chat_empid='".$employee_id."' AND chat_id < '".$lastId."' || chat_userid='".$employee_id."' AND chat_empid='".$user_id."' AND chat_id < '".$lastId."' ORDER BY chat_datetime DESC LIMIT 5) tmp ORDER BY tmp.chat_datetime ASC";
		$result = $this->db->query($sql)->result_array();
		if(!empty($result)){
			$data = array();
			foreach($result as $chat){
				$data[] = array(
					'chat_id'=>$chat['chat_id'],
					'chat_userid'=>$chat['chat_userid'],
					'chat_username'=>userName($chat['chat_userid']),
					'chat_empid'=>$chat['chat_empid'],
					'chat_empname'=>userName($chat['chat_empid']),
					'chat_msg'=>$chat['chat_msg'],
					'chat_status'=>$chat['chat_status'],
					'chat_datetime'=>time_ago($chat['chat_datetime'])
				);
			}
			echo json_encode($data);
		} 
		else{
			echo json_encode(false);
		} 
	}
	
	public function updateChatStatus(){
		$user_id = $this->session->userdata('id');
		$employee_id = $_POST['employee_id'];
		$result = $this->Admin_m->updateChatStatus(array('chat_userid'=>$employee_id, 'chat_empid'=>$user_id, 'chat_status'=>'seen'));
		echo json_encode($result);
	}
	
	public function reloadUnreadChat(){
		$result = $this->db->where('chat_status','unseen')->where('chat_empid',$this->session->userdata('id'))->count_all_results('chating');
		echo json_encode($result);
	}
	
	public function getName()
	{
		$employee_id = $_POST['employee_id'];
		$sql = "SELECT name FROM users WHERE id='".$employee_id."'";
		$result = $this->db->query($sql)->first_row()->name;
		
		if($result != ''){
			echo json_encode($result);
		} 
		else{
			echo json_encode(false);
		} 
	}
	
	/*** NOTIFICATION METHOD ***/
	public function unseenMessages(){
		$data['getMessages'] = $this->Admin_m->getMessages();
		//$data['getSeenMessages'] = $this->Admin_m->getSeenMessages();
		$output = array('html'=>$this->load->view("notifications/messages",$data, true));
		echo json_encode($output);
	}
	public function loadMessages(){
		$user_id = $this->session->userdata('id');
		$chat_userid = $_POST["users"]; //Second array
		$received = false;
		$sql = "SELECT * FROM ( SELECT * FROM chating WHERE chat_empid = '".$user_id."' AND chat_status = 'unseen' OR chat_empid = '".$user_id."' AND chat_status = 'seen' ORDER BY chat_id DESC ) AS chat WHERE chat.chat_userid NOT IN (".implode(",", $_POST['users']).") GROUP BY chat.chat_userid LIMIT 3";
		$result = $this->db->query($sql)->result_array(); //First array
		$data = array(); //third array
		foreach($result as $key => $user){
			$data[] =  array(
				"chat_id"=>$user['chat_id'],
				"sender_name"=>userName($user['chat_userid']),
				"datetime"=>time_ago($user['chat_datetime']),
				"sender_image"=>userImage($user['chat_userid']),
				"message"=>$user['chat_msg'],
				"chat_status"=>$user['chat_status'],
				"chat_userid"=>$user['chat_userid'],
				"emp_id"=>$user_id
			);
		} 
		
		echo json_encode($data);
		
		/* foreach($chat_userid as $id){
			
			if(!empty($result)){
				$received = true;
			}
		}
		if($received){
			$data = array('object'=>$result);
			foreach($result as $key => $mesg){
				$data[] = array(
					"chat_id"=>$mesg['chat_id'],
					"sender_name"=>userName($mesg['chat_userid']),
					"datetime"=>time_ago($mesg['chat_datetime']),
					"sender_image"=>userImage($mesg['chat_userid']),
					"message"=>$mesg['chat_msg']
				);
			} 
			echo json_encode($data);
		}
		else{
			echo json_encode(false);
			
		} */
		
	}
	/*** END NOTIFICATION METHOD ***/
	
	public function whoTyping(){
		// Load the library.
		// You can also autoload the library by adding it to config/autoload.php
		 require_once APPPATH.'third_party\vendor\autoload.php';

		 // Change the following with your app details:
		// Create your own pusher account @ www.pusher.com
		$app_id = ''; // App ID
		$app_key = ''; // App Key
		$app_secret = ''; // App Secret
		$options = array(
			'cluster' => 'ap2',
			'encrypted' => true
		  );
		$pusher = new Pusher\Pusher($app_key, $app_secret, $app_id, $options);
		
		$data['username'] = $_POST['username'];
		$data['typefor'] = $_POST['typefor'];
		$data['typeis'] = $_POST['typeis'];
		
		// Return the received message
		if($pusher->trigger('typing_channel', 'typing_event', $data)) {               
			echo 'success';         
		} else {        
			echo 'error';   
		}
	}
	
	public function logout()
	{
		$this->session->sess_destroy();
		$this->Admin_m->updatelog(array('ul_userid'=>$this->session->userdata('id'), 'ul_status'=>'offline'));
		redirect(base_url(),'refresh');
	}
	
}
