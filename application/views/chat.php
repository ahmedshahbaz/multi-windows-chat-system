<?php date_default_timezone_set("Asia/Karachi"); ?>
<!DOCTYPE html>
<html class=" ">
    <head>
		 <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		 <meta charset="utf-8" />
		 <title>Chating</title>
		 <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
		 <meta content="" name="description" />
		 <meta content="" name="author" />
		 <meta http-equiv="X-UA-Compatible" content="IE=edge" />
		<!-- CORE CSS FRAMEWORK - START -->
		 <link href="<?php echo base_url(''); ?>assets/fonts/font-awesome/css/font-awesome.css" rel="stylesheet" type="text/css" />
		 <link href="<?php echo base_url(''); ?>assets/plugins/perfect-scrollbar/perfect-scrollbar.css" rel="stylesheet" type="text/css" />
		 <link href="<?php echo base_url(''); ?>assets/css/style.css" rel="stylesheet" type="text/css" />
		 <link href="<?php echo base_url(''); ?>assets/css/animate.min.css" rel="stylesheet" type="text/css" />
		 <link href="<?php echo base_url(''); ?>assets/emoji/stylesheet.css" rel="stylesheet" type="text/css" />
		<!-- CORE CSS FRAMEWORK - END -->
		<!-- PUSHER - START -->
		<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js" type="text/javascript" ></script> 
		<script src="//js.pusher.com/2.2/pusher.min.js" type="text/javascript" type="text/javascript" ></script>    
		<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js" type="text/javascript" ></script>   
		<script src="//cdnjs.cloudflare.com/ajax/libs/bootbox.js/4.3.0/bootbox.min.js" type="text/javascript" ></script>
		<link rel="stylesheet" type="text/css" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css" />
		<!-- PUSHER - END -->
		<style>
			.badge{background:#ff5f74;}
			#loader {display:none;width: 30px;margin: 0px 0px 15px 40%;}
			#messages-loader {
				display:none;
				position: fixed;
				left: 235px;
				top: 60px;
				width: 320px;
				height: 300px;
				z-index: 9999;
				background: url(http://localhost/chating/assets/data/img/chat-loader.gif) center no-repeat #ffffff61;
			}
			.noMoreMessage{color: #ef7474;background: #fde9e9;padding: 5px;text-align: center;width: 250px;margin-left: -15px;margin-top: -5px;}
			.noMessages{color: #ffffff;background: #565090;padding: 5px;text-align: center;margin-bottom: 0;}
			.blink_me {
			  //animation: blinker 1s linear infinite;
			  background:#565090;
			}
			
			.chatapi-windows .user-window.minimizeit .controlbar .blink_img{top: -20px;width: 25px;height: 25px;left: -20px;animation: blinker 1s linear infinite;}
			
			.someoneType{display: none;padding-left: 5px;font-size: 11px;z-index: 9999;position: relative;margin-top: -15px;background: #f7f1f1;opacity: 0.7;color: #888283;margin-bottom: 0px;font-style: italic;}
			.typingImg{width:20px;}
			
			@keyframes blinker {  
			  100% { padding:2px; }
			} 
		</style>
    </head>
     <!-- END HEAD -->

     <!-- BEGIN BODY -->
     <body class=" chat-open">
		<!-- START TOPBAR -->
         <div class='page-topbar  chat_shift '>
             <div class='logo-area'>
             </div>
             <div class='quick-area'>
				<div class='pull-left'>
                     <ul class="info-menu left-links list-inline list-unstyled">
                         <li class="message-toggle-wrapper" onClick="unseenMessages();">
                             <a href="#" data-toggle="dropdown" class="toggle">
                                 <i class="fa fa-envelope"></i>
                                 <span class="badge badge-accent" id="unreadChat"><?php if($countUnseenMessages > 0) echo $countUnseenMessages; ?></span>
                             </a>
                             <ul class="dropdown-menu messages animated fadeIn">
                                 <li class="list">
                                    <ul class="dropdown-menu-list list-unstyled ps-scrollbar" id="unseenMessages">
									<!--- GET ALL UNSEEN MESSAGES ---> 
                                    </ul>
                                 </li>
                                 <!--<li class="external">
                                     <a href="javascript:;">
                                        <span>Read All Messages </span>
                                     </a>
                                 </li>-->
                             </ul>
                         </li>
                         <li class="notify-toggle-wrapper">
                             <a href="#" data-toggle="dropdown" class="toggle">
                                 <i class="fa fa-bell"></i>
                                 <span class="badge badge-accent">3 </span>
                             </a>
                             <ul class="dropdown-menu notifications animated fadeIn">
                                 <li class="total">
                                     <span class="small">
                                        You have  <strong>3 </strong> new notifications.
                                     </span>
                                 </li>
                                 <li class="list">
                                     <ul class="dropdown-menu-list list-unstyled ps-scrollbar">
                                         <li class="unread available">  <!-- available: success, warning, info, error -->
                                             <a href="javascript:;">
                                                 <div class="notice-icon">
                                                     <i class="fa fa-check"></i>
                                                 </div>
                                                 <div>
                                                     <span class="name">
                                                        <strong>Arif Khan accept your friend request </strong>
                                                        <span class="time small">15 mins ago </span>
                                                     </span>
                                                 </div>
                                             </a>
                                         </li>
                                     </ul>
                                 </li>
                                 <li class="external">
                                     <a href="javascript:;">
                                         <span>Read All Notifications </span>
                                     </a>
                                 </li>
                             </ul>
                         </li>
						  <li class="message-toggle-wrapper">
                             <a href="#" data-toggle="dropdown" class="toggle">
                                 <i class="fa fa-user"></i>
                                 <span class="badge badge-accent">3</span>
                             </a>
                             <ul class="dropdown-menu messages animated fadeIn">
                                 <li class="list">
                                     <ul class="dropdown-menu-list list-unstyled ps-scrollbar">
                                        <li class="unread status-available">
                                            <a href="javascript:;">
                                                 <div class="user-img">
                                                     <img src="<?php echo base_url(''); ?>assets/data/img/loginhead.jpg" alt="user-image" class="img-circle img-inline" />
                                                 </div>
                                                 <div>
                                                     <span class="name">
                                                         <strong>Noman Ansari </strong>
                                                         <span class="time small">- 15 mins ago </span>
                                                         <!--<span class="profile-status available pull-right"></span>-->
                                                     </span>
                                                     <span class="desc small">
                                                        Send you a friend request
                                                     </span>
                                                </div>
                                            </a>
                                        </li>
                                    </ul>
                                 </li>
                                 <li class="external">
                                     <a href="javascript:;">
                                         <span>Read All Messages </span>
                                     </a>
                                 </li>
                             </ul>
                         </li>
                     </ul>
                 </div>	
                 <div class='pull-right'>
                     <ul class="info-menu right-links list-inline list-unstyled">
                         <li class="profile">
                             <a href="#" data-toggle="dropdown" class="toggle">
                                 <img src="<?php echo base_url('assets/data/profile/').$this->session->userdata('image'); ?>" alt="user-image" class="img-circle img-inline" />
                                 <span><?= $this->session->userdata('name'); ?><!---<i class="fa fa-angle-down"></i>--></span>
                             </a>
                         </li>
						 <li>
                             <a href="<?php echo base_url('Admin/logout'); ?>">
                                 <i class="fa fa-lock" style="color:white;font-size:20px;"></i>
                             </a>
                         </li>
                         <li class="chat-toggle-wrapper">
                             <a href="#" data-toggle="chatbar" class="toggle_chat">
                                 <i class="fa fa-comments"></i>
                                 <i class="fa fa-times"></i>
                             </a>
                         </li>
                     </ul>			
                 </div>		
             </div>

         </div>
         <!-- END TOPBAR -->
         <!-- START CONTAINER -->
         <div class="page-container row-fluid container-fluid">
             <!-- SIDEBAR - START -->
             <!--  SIDEBAR - END -->
             <!-- START CONTENT -->
             <!-- END CONTENT -->
             <div class="page-chatapi  showit ">
                <div class="search-bar">
                     <input type="text" placeholder="Search" class="form-control emojis-wysiwyg" />
                 </div>
				<script>
				</script>
                 <div class="chat-wrapper">
                    <h4 class="group-head">Groups</h4>
                    <ul class="group-list list-unstyled">
                        <li class="group-row mlp">
                             <div class="group-status offline">
                                 <i class="fa fa-circle"></i>
                             </div>
                             <div class="group-info">
                                 <h4><a href="#">MLP</a></h4>
                             </div>
                        </li>
                        <li class="group-row friend active">
                             <div class="group-status away">
                                 <i class="fa fa-circle"></i>
                             </div>
                             <div class="group-info">
                                 <h4><a href="#">Friends </a></h4>
                             </div>
                        </li>
						<li class="group-row pending_request">
                             <div class="group-status busy">
                                 <i class="fa fa-circle"></i>
                             </div>
                             <div class="group-info">
                                 <h4><a href="#">Pending Request </a></h4>
                             </div>
                        </li>
                    </ul>

					<!--- Mlp List --->
					<div id="mlp" class="animated fadeIn">
						<h4 class="group-head">MLP </h4>
						<ul class="contact-list">
						<?php
							/* echo "<pre>";
							print_r($getUnfriends); */
							if($getUnfriends){
								foreach($getUnfriends as $unfriend){
						?>
							<li class="user-row-noactive unfriend animated">
								<div class="user-img">
									 <a href="#"><img src="<?php echo base_url('assets/data/profile/').$unfriend['image']; ?>" alt="" /></a>
								</div>
								<div class="user-info">
									 <h4><a href="#"><?= $unfriend['name']; ?> </a></h4>
									 <span class="status" id="user_<?= $unfriend['id']; ?>"><button class="btn btn-info btn-xs" onClick="addRequest('<?= $unfriend['id']; ?>');">Add</button></span>
								</div>
							</li>
						<?php
								}
							}
							else{
								//foreach($getAllUsers as $users){
						?>
							<!--<li class="user-row-noactive users animated">
								<div class="user-img">
									 <a href="#"><img src="<?php echo $users['image']; ?>" alt="" /></a>
								</div>
								<div class="user-info">
									 <h4><a href="#"><?= $users['name']; ?> </a></h4>
									 <span class="status" id="user_<?= $users['id']; ?>"><button class="btn btn-info btn-xs" onClick="addRequest('<?= $users['id']; ?>');">Add</button></span>
								</div>
							</li>-->
						<?php
								//}
							}
						?>
						</ul>
					</div>
					<!--- End Mlp List --->
					<!--- Friends List --->.
					<div id="friend" class="animated fadeIn">
						<h4 class="group-head">Friends </h4>
						<ul class="contact-list">
							<?php
								if($getFriends != ''){
									foreach($getFriends as $user){
							?>
							<li class="user-row " id='<?= $user['id']; ?>' data-user-id='<?= $user['id']; ?>' onClick="chatWindowOpen('<?= $user['id']; ?>');">
								<div class="user-img">
									 <a href="#"><img src="<?php echo base_url('assets/data/profile/').$user['image']; ?>" alt="" /></a>
								</div>
								<?php
									$currentTime = time() - 1800; // 30 minutes
									$loginTime = strtotime($user['ul_datetime']);
									if($user['ul_status'] == 'online'){
								?>
								<div class="user-info">
									<h4>
										<a href="#"><?= $user['name']; ?></a>
									</h4>
									 <span class="status available" data-status="available"> Online </span>
								</div>
								<div class="user-status available">
									 <i class="fa fa-circle"></i>
								</div>
								<?php
									}
									else{
								?>
								<div class="user-info">
									<h4>
										<a href="#"><?= $user['name']; ?></a>
									</h4>
									 <span class="status away abc" data-status="away"> Last seen: <?= time_ago($user['ul_datetime']); ?></span>
								</div>
								<?php
									}
								?>
							</li>
							<?php
									}
								}
								else{
							?>
							<li class="user-row-noactive" id="no-friend-added">
								<p class="text-danger text-center">No friend added</p>
							</li>
							<?php
								}
							?>
						</ul>
					</div>
					<!--- End Friends List --->
					<!--- Pending Request List --->
					<div id="pending_request" class="animated fadeIn">
						<h4 class="group-head">Pending Request </h4>
						<ul class="contact-list">
						<?php
							if($getRequests){
								foreach($getRequests as $request){
						?>
							<li class="user-row-noactive animated">
								<div class="user-img">
									 <a href="#"><img src="<?= base_url('assets/data/profile/').$request['image']; ?>" alt="" /></a>
								</div>
								<div class="user-info">
									 <h4><a href="#"><?= $request['name']; ?></a></h4>
									 <span class="status" id="request_<?= $request['fl_userid']; ?>"><button class="btn btn-success btn-xs" onClick="actionRequest('<?= $request['fl_empid']; ?>','<?= $request['fl_userid']; ?>','accept');"><i class="fa fa-check"></i></button> <button class="btn btn-warning btn-xs" onClick="actionRequest('<?= $request['fl_empid']; ?>','<?= $request['fl_userid']; ?>','reject');"> <i class="fa fa-times"></i></button> <!--<button class="btn btn-danger btn-xs" onClick="actionRequest('<?= $request['fl_id']; ?>','block');"> <i class="fa fa-ban"></i></button>--></span>
								</div>
							</li>
						<?php
								}
							}
							else{
						?>
						<li class="user-row-noactive" id="no-pending-request">
							<p class="text-danger text-center">No pending request</p>
						</li>
						<?php
							}
						?>
						</ul>
					</div>
					<!--- End Pending Request List --->
                 </div>
             </div>

			<!--- Chat window open ---->	
				<div class="chatapi-windows  showit"></div>
			</div>
         <!-- END CONTAINER -->
         <!-- LOAD FILES AT PAGE END FOR FASTER LOADING -->
         <!-- CORE JS FRAMEWORK - START --> 
         <!--<script src="<?php echo base_url(''); ?>assets/js/jquery-1.12.4.min.js" type="text/javascript"></script> -->
         <script src="<?php echo base_url(''); ?>assets/plugins/perfect-scrollbar/perfect-scrollbar.min.js" type="text/javascript"></script> 
         <script src="<?php echo base_url(''); ?>assets/js/scripts.js" type="text/javascript"></script>
		 
         <!-- CORE JS FRAMEWORK - END --> 
		 <script>
			/* jQuery(document).ready(function() {
				reloadUnreadChat();
				$('.unreadCount').each(function(){
					var id = $(this).attr('id');
					loadUserUnreadChat(id);
				});
			}); */
			(function titleScroller(text) {
				document.title = text;
				setTimeout(function () {
					titleScroller(text.substr(1) + text.substr(0, 1));
				}, 300);
			}(" MOBILELINK USA | Chat System "));
			$('#mlp').hide();
			$('#pending_request').hide();
			$('.mlp').click(function(){
				$(this).addClass('active');
				$('.friend').removeClass('active');
				$('.pending_request').removeClass('active');
				$('#friend').hide();
				$('#pending_request').hide();
				$('#mlp').show();
			});
			
			$('.friend').click(function(){
				$(this).addClass('active');
				$('.mlp').removeClass('active');
				$('.pending_request').removeClass('active');
				$('#mlp').hide();
				$('#pending_request').hide();
				$('#friend').show();
			});
			
			$('.pending_request, .fa-users').click(function(){
				$(this).addClass('active');
				$('.mlp').removeClass('active');
				$('.friend').removeClass('active');
				$('#mlp').hide();
				$('#friend').hide();
				$('#pending_request').show();
			});
			
			<!--- Chatbox script --->
			// Enter your own Pusher App key
			var lastId;
			var pusher = new Pusher('Your app key', {
				  cluster: 'your cluster'
				}); 
			// Enter a unique channel you wish your users to be subscribed in.
			var channel = pusher.subscribe('test_channel');
			channel.bind('my_event', function(data) {
				var userId = '<?php echo $this->session->userdata('id'); ?>';
				var reciever_id = "";
				var sender_name = "";
				var titleSet = "";
				var html = "";
				var sender_id = data.id;
				if(userId == data.employee_id){
					reciever_id = data.id;
					var sname = data.sender_name;
					sender_name = sname.split(" ");
					//titleSet = $(document).attr("title", sender_name[0]+" send you a message");	
					(function titleScroller(text) {
						document.title = text;
						setTimeout(function () {
							titleScroller(text.substr(1) + text.substr(0, 1));
						}, 200);
					}(" "+sender_name[0]+" send you a message " ));
				}
				else{
					reciever_id = data.employee_id;
					var sname = data.employee_name;
					sender_name = sname.split(" ")
				}
				var bg = (data.id == userId) ?  style = 'background:#e6e9ed;color:#333;' : style ='background:#565090;color:#fff;';
				var nameUser = (data.id == userId) ? "You" : sender_name[0];
				// Chat window open and append message
				if(userId == data.employee_id || userId == sender_id) {
					if($("#user-window"+reciever_id).length == 0){
						var name = $("#"+data.id).find(".user-info h4 a").html();
						var img = $("#"+data.id).find(".user-img a img").attr("src");
						var status = $("#"+data.id).find(".user-info .status").attr("data-status");
						$("#"+data.id).addClass('active');
						$.ajax({
							type:'POST',
							url:'<?php echo base_url('Admin/getChat'); ?>',
							data:{employee_id:reciever_id},
							dataType:'JSON',
							success:function(data){
								var items = "";
								$.each(data, function(index) {
									var user_name = "";
									var backcolor;
									lastId = data[0]["chat_id"];
									data[index]['chat_userid'] == <?php echo $this->session->userdata('id'); ?> ? user_name = "You"  : user_name = data[index]['chat_username'].split(" ")[1];
									data[index]['chat_userid'] == <?php echo $this->session->userdata('id'); ?> ?  style = 'background:#e6e9ed;color:#333;' : style ='background:#565090;color:#fff;';
									items = items + "<div class='chatmsg msg_save'><span class='name'>"+user_name+"</span><span class='text' style='"+bg+"'>"+data[index]['chat_msg']+"</span><span class='ts'>"+data[index]['chat_datetime']+"</span></div>";
								});
								
								html = "<div class='user-window minimizeit' id='user-window" + reciever_id + "' data-user-id='" + reciever_id + "'>";
								html += "<div class='controlbar'><img class='blink_img' src='<?php echo base_url("assets/data/img/chat-alert.png"); ?>' style='display:none;'><img src='" + img + "' data-user-id='" + reciever_id + "' class='profile_img' rel='tooltip' data-animate='animated fadeIn' data-toggle='tooltip' data-original-title='" + name + "' data-placement='top' data-color-class='primary'><span class='status " + status + "'><i class='fa fa-circle'></i></span><span class='name'>" + name + "</span><span class='opts'><i class='fa fa-times closeit' data-user-id='" + reciever_id + "'></i><i class='fa fa-minus minimizeit' data-user-id='" + reciever_id + "'></i></span></div>";
								
								html += "<img id='loader' src='<?php echo base_url("assets/data/img/chat-loader.gif"); ?>'><div class='chatarea'>"+items+"</div>";
								
								html += "<p class='someoneType'></p><div class='typearea'><input type='text' name='chating' data-user-id='" + reciever_id + "' placeholder='Type & Enter' class='form-control'></div>";
								html += "</div>";
								$(".chatapi-windows").append(html);
								$("#user-window" + sender_id + " .controlbar").css('background','#565090');
								$("#user-window" + sender_id + " .controlbar .profile_img").css('top','-25px');
								$("#user-window" + sender_id + " .controlbar .blink_img").show();
								loadConversation(reciever_id,lastId);
							},
							error:function(data){console.log('error: '+data.responseText);}
						});		
					}
					// Chat window already open and append message or minimize
					else if($("#user-window"+reciever_id).hasClass("minimizeit") || $("#user-window"+reciever_id).css('display') == 'none'){
						$("#"+data.id).addClass('active');
						if(!$("#user-window"+reciever_id).hasClass("minimizeit")){
							$("#user-window"+reciever_id).addClass('minimizeit');
						}
						$("#user-window"+reciever_id).css('display','block');
						html = "<div class='chatmsg msg_sent'><span class='name'>"+nameUser+"</span><span class='text' style='"+bg+"'>"+data.message+"</span><span class='ts'>"+data.datetime+"</span></div>";
						$("#user-window"+reciever_id+" .chatarea").append(html);
						$("#user-window" + sender_id + " .controlbar").css('background','#565090');
						$("#user-window" + sender_id + " .controlbar .profile_img").css('top','-25px');
						$("#user-window" + sender_id + " .controlbar .blink_img").show();
					} 
					else{
						html = "<div class='chatmsg msg_sent'><span class='name'>"+nameUser+"</span><span class='text' style='"+bg+"'>"+data.message+"</span><span class='ts'>"+data.datetime+"</span></div>";
						$("#user-window"+reciever_id+" .chatarea").append(html); 
						$("#user-window" + sender_id + " .controlbar").addClass('blink_me');
						// Scroll to last message
						$(".chatarea").animate({ scrollTop: $(".chatarea").prop("scrollHeight")}, 0);
						// Chat window scrolling
						$(".chatapi-windows #user-window"+sender_id+" .chatarea").perfectScrollbar({
							suppressScrollX: true
						});					
					}
					// Append audio tag in body
					$('<audio id="chatAudio"><source src="<?php echo base_url('assets/sounds/notify.mp3'); ?>" type="audio/mpeg"></audio>').appendTo('body');
					$('#chatAudio')[0].play();	
					// Set page title and reload unread messages
					titleSet;
					reloadUnreadChat(); 
				}
				else{
					return false;
				}				
			});
			/*** END PUSHER SCRIPT  ***/
			
			/*** START OPEN CHAT WINDOW ON CLICK ***/
			length_user_chat = 0;
			//$('.page-chatapi .user-row').on('click', function() {
			function chatWindowOpen(id){
				var name = $('.user-row#'+id).find(".user-info h4 a").html();
				var img = $('.user-row#'+id).find(".user-img a img").attr("src");
				var id = $('.user-row#'+id).attr("data-user-id");
				var status = $('.user-row#'+id).find(".user-info .status").attr("data-status");

				if ($('.user-row#'+id).hasClass("active")) {
					$('.user-row#'+id).toggleClass("active");
					$(".chatapi-windows #user-window" + id).hide();
				} 
				else {
					$('.user-row#'+id).toggleClass("active");

					if ($(".chatapi-windows #user-window" + id).length) {
						$(".chatapi-windows #user-window" + id).removeClass("minimizeit").show();

					} else {
							$.ajax({
								type:'POST',
								url:'<?php echo base_url('Admin/getChat'); ?>',
								data:{employee_id:id},
								dataType:'JSON',
								success:function(data){
									if(data){
										var items = "";
										$.each(data, function(index) {
											lastId = data[0]["chat_id"];
											var user_name = "";
											var backcolor;
											var seen;
											/// Sender Name
											data[index]['chat_userid'] == <?php echo $this->session->userdata('id'); ?> ? user_name = "You"  : user_name =data[index]['chat_username'].split(" ")[1];
											/// Seen Check
											if(data[index]['chat_userid'] == <?php echo $this->session->userdata('id'); ?>){
												if(data[index]['chat_status'] == "seen"){seen = "<i class='fa fa-check' style='color: #50b950;float: right;margin-top: 3px;font-size: 10px;'></i>"}else{seen = "<i class='fa fa-check' style='color: #c3c3c3;float: right;margin-top: 3px;font-size: 10px;'></i>"}
											}
											else{seen = "";}
											/// Style
											data[index]['chat_userid'] == <?php echo $this->session->userdata('id'); ?> ?  style = 'background:#e6e9ed;color:#333;' : style ='background:#565090;color:#fff;';
											items = items + "<div class='chatmsg msg_save'><span class='name'>"+user_name+"</span><span class='text' style='"+style+"'>"+data[index]['chat_msg']+" "+seen+"</span><span class='ts'>"+data[index]['chat_datetime']+"</span></div>";
										});
											
										var html = "<div class='user-window' id='user-window" + id + "' data-user-id='" + id + "'>";
										html += "<div class='controlbar'><img class='blink_img' src='<?php echo base_url("assets/data/img/chat-alert.png"); ?>' style='display:none;'><img src='" + img + "' data-user-id='" + id + "' class='profile_img' rel='tooltip' data-animate='animated fadeIn' data-toggle='tooltip' data-original-title='" + name + "' data-placement='top' data-color-class='primary'><span class='status " + status + "'><i class='fa fa-circle'></i></span><span class='name'>" + name + "</span><span class='opts'><i class='fa fa-times closeit' data-user-id='" + id + "'></i><i class='fa fa-minus minimizeit' data-user-id='" + id + "'></i></span></div>";
										
										html += "<img id='loader' src='<?php echo base_url("assets/data/img/chat-loader.gif"); ?>'><div class='chatarea'>"+items+"</div>";
										
										html += "<p class='someoneType'></p><div class='typearea'><input type='text' name='chating' data-user-id='" + id + "' placeholder='Type & Enter' class='form-control emojis-wysiwyg'></div>";
										html += "</div>";
										
										$(".chatapi-windows").append(html);
										// Scroll to last message
										$(".chatarea").animate({ scrollTop: $('.chatarea').prop("scrollHeight")}, 0);
										// Chat window scrolling
										$(".chatapi-windows #user-window" + id + " .chatarea").perfectScrollbar({
											suppressScrollX: true
										});
										loadConversation(id, lastId);
									}
									else{
										var html = "<div class='user-window' id='user-window" + id + "' data-user-id='" + id + "'>";
										html += "<div class='controlbar'><img class='blink_img' src='<?php echo base_url("assets/data/img/chat-alert.png"); ?>' style='display:none;'><img src='" + img + "' data-user-id='" + id + "' rel='tooltip' data-animate='animated fadeIn' data-toggle='tooltip' data-original-title='" + name + "' data-placement='top' data-color-class='primary'><span class='status " + status + "'><i class='fa fa-circle'></i></span><span class='name'>" + name + "</span><span class='opts'><i class='fa fa-times closeit' data-user-id='" + id + "'></i><i class='fa fa-minus minimizeit' data-user-id='" + id + "'></i></span></div>";
										html += "<div class='chatarea'></div>";
										html += "<p class='someoneType'></p><div class='typearea'><input type='text' name='chating' data-user-id='" + id + "' placeholder='Type & Enter' class='form-control'></div>";
										html += "</div>";
										$(".chatapi-windows").append(html);
									}
								},
								error:function(data){console.log('error: '+data.responseText);}
							}); 
					}
				}
			 
			}
			/*** END OPEN CHAT WINDOW ON CLICK ***/
			/*** Start close chat window ***/
			$(document).on('click', ".chatapi-windows .user-window .controlbar .closeit", function(e) {
				var id = $(this).attr("data-user-id");
				$(".chatapi-windows #user-window" + id).hide();
				$(".chatapi-windows #user-window" + id + " .blink_img").hide();
				$(".chatapi-windows #user-window" + id + " .controlbar").css('background','#e8e8e8');
				$("#user-window" + id + " .controlbar .profile_img").css('top','-5px');
				$(".page-chatapi .user-row#" + id).removeClass("active");
			});
			/*** End close chat window ***/
			$(document).on('click', ".user-row", function(e) {
				var id = $(this).attr("data-user-id");
				$(".chatapi-windows #user-window" + id + " .blink_img").hide();
				$(".chatapi-windows #user-window" + id + " .controlbar").css('background','#e8e8e8');
				$("#user-window" + id + " .controlbar .profile_img").css('top','-5px');
			});
			/*** Start minimize chat window ***/
			$(document).on('click', ".chatapi-windows .user-window .controlbar img, .chatapi-windows .user-window .controlbar .minimizeit", function(e) {
				var id = $(this).attr("data-user-id");

				if (!$(".chatapi-windows #user-window" + id).hasClass("minimizeit")) {
					$(".chatapi-windows #user-window" + id).addClass("minimizeit");
					//CRESTADMIN_SETTINGS.tooltipsPopovers();
				} else {
					$(".chatapi-windows #user-window" + id).removeClass("minimizeit");
					// Scroll to last message
					$(".chatarea").animate({ scrollTop: $('.chatarea').prop("scrollHeight")}, 0);
					// Chat window scrolling
					$(".chatapi-windows #user-window" + id + " .chatarea").perfectScrollbar({
						suppressScrollX: true
					});
					$(".chatapi-windows #user-window" + id + " .blink_img").hide();
					$(".chatapi-windows #user-window" + id + " .controlbar").css('background','#e8e8e8');
					$("#user-window" + id + " .controlbar .profile_img").css('top','-5px');
				}
			});
			/*** End minimize chat window ***/
			/*** Start post chat ***/
			$(document).on('keypress', ".chatapi-windows .user-window .typearea input", function(e) {
				if (e.keyCode == 13) {
					length_user_chat++;
					var id = $(this).attr("data-user-id");
					var msg = $(this).val();
					//var msgDetail = chatformat_msg(msg, 'sent', 'You');
					//$(".chatapi-windows #user-window" + id + " .chatarea").append(msgDetail);
					if(msg != ''){
						$(this).val("");
						$(this).focus();
						// AJAX request
						$.ajax({
							type: "POST",
							url: '<?php echo base_url('Admin/chating'); ?>',
							dataType: "json",
							data: {employee_id:id, msg:msg},
							success: function(response, textStatus, jqXHR) {
								console.log(jqXHR.responseText);
							},
							error: function(msg) {}
						});
					}
				}
				$(".chatarea").animate({ scrollTop: $('.chatarea').prop("scrollHeight")}, 0);
				$(".chatapi-windows #user-window" + id + " .chatarea").perfectScrollbar({
					suppressScrollX: true
				});
			});
			/*** End post chat ***/
			/*** Start CLICK to change the status of chat ***/
			$(document).on('click', ".chatapi-windows .user-window", function(e) {
				var id = $(this).attr("data-user-id");
				$.ajax({
					type: "POST",
					url: '<?php echo base_url('Admin/updateChatStatus'); ?>',
					dataType: "json",
					data: {employee_id:id},
					success: function(data) {
						if(data){
							//$(document).attr("title", "Chating");
							(function titleScroller(text) {
								document.title = text;
								setTimeout(function () {
									titleScroller(text.substr(1) + text.substr(0, 1));
								}, 300);
							}(" MOBILELINK USA | Chat System "));
							reloadUnreadChat();	
							if ($(".chatapi-windows #user-window" + id+ " .controlbar").hasClass("blink_me")) {
								$(".chatapi-windows #user-window" + id+ " .controlbar").removeClass('blink_me').css('background','#e8e8e8');
							}
						}
						else{
							return false;
						}
					},
					error: function(msg) {}
				});
			});
			/*** END CLICK to change the status of chat ***/
			/*** START UNREAD VALUE ***/
			function reloadUnreadChat(){
				$.ajax({
					url: '<?php echo base_url('Admin/reloadUnreadChat'); ?>',
					data: {},
					error: function(xhr, statusText, err) {
						alert("error"+xhr.status);
					},
					success: function(data) {
						if(data == 0){
							$("#unreadChat").text("");
						}else{
							$("#unreadChat").text(data);
						}
						
					},
					type: 'GET'
				});
			}
			/*** END UNREAD VALUE ***/
			/*** START LOAD CONVERSATION SCROLL UP ***/
			function loadConversation(sender_id,lastId){
				/// LOAD CONVERSATION ON SCROLL UP
				var noMoreMessage = false;           
				$(".chatapi-windows #user-window"+sender_id+" .chatarea").scrollTop($(".chatapi-windows #user-window"+sender_id+" .chatarea")[0].scrollHeight);
				$(".chatapi-windows #user-window"+sender_id+" .chatarea").scroll(function(){
					if ($(".chatapi-windows #user-window"+sender_id+" .chatarea").scrollTop() == 0){
						$('#loader').show();
						$.ajax({
							type:'POST',
							url:'<?php echo base_url('Admin/loadConversation'); ?>',
							data: {employee_id:sender_id,lastId : lastId},
							dataType:'JSON',
							success:function(data){
								if(!noMoreMessage){
									var items = "";
									if(data){
										lastId = data[0]["chat_id"];
										$.each(data, function(index) {
											var user_name = "";
											var backcolor;
											data[index]['chat_userid'] == <?php echo $this->session->userdata('id'); ?> ? user_name = "You"  : user_name = data[index]['chat_username'].split(" ")[1];
											data[index]['chat_userid'] == <?php echo $this->session->userdata('id'); ?> ?  style = 'background:#e6e9ed;color:#333;' : style ='background:#565090;color:#fff;';
											items = items + "<div class='chatmsg msg_save'><span class='name'>"+user_name+"</span><span class='text' style='"+style+"'>"+data[index]['chat_msg']+"</span><span class='ts'>"+data[index]['chat_datetime']+"</span></div>";
										});
									}
									else{
										items = "<p class='animated noMoreMessage' style='color:red;'>No more conversation</p>";
										noMoreMessage = true;
									}
									$("#user-window"+sender_id+" .chatarea").prepend(items);
									$(".noMoreMessage").toggleClass('fadeInDown');
									$('#loader').hide();
									$("#user-window"+sender_id+" .chatarea").scrollTop(10);
								}else{
									$('#loader').hide();
									$("#user-window"+sender_id+" .chatarea").scrollTop(10);
								}
							}
						}); 
					}
				});
			}
			/*** END LOAD CONVERSATION SCROLL UP ***/
			/*** START ADD REQUEST PUSHER EVENT ***/
			function addRequest(id){
				$.post('<?php echo base_url('Admin/addRequest'); ?>', {id: id});
				$('#user_'+id).html("<p class='text-success' style='font-size:11.2px;'>friend request sent</p>");
				$('#user_'+id).parent().parent().fadeOut(2000);
			}
			
			var requestChannel = pusher.subscribe('request_channel');
			var requestUserid = "<?php echo $this->session->userdata('id'); ?>";
			requestChannel.bind('request_event', function(data){
				if(data.receiver_id == requestUserid){
					var html = '<li class="user-row-noactive animated fadeIn"><div class="user-img"><a href="#"><img src="<?php echo base_url('assets/data/profile/'); ?>'+data.sender_image+'" alt="" /></a></div><div class="user-info"><h4><a href="#">'+data.sender_name+'</a></h4><span class="status" id="request_'+data.sender_id+'"><button class="btn btn-success btn-xs" onClick="actionRequest('+requestUserid+','+data.sender_id+',1);"><i class="fa fa-check"></i></button> <button class="btn btn-warning btn-xs" onClick="actionRequest('+requestUserid+','+data.sender_id+',0);"> <i class="fa fa-times"></i></button></span></div></li>';
					if($("#no-pending-request").length > 0){
						$("#no-pending-request").hide();
						$("#pending_request .contact-list").append(html);
					}
					else{
						$("#pending_request .contact-list").append(html);
					}
					// Desktop Notification
					Notification.requestPermission(function(permission) {
						// If the user accepts, let's create a notification
						if (permission === "granted") {
							 var options = {
									 body: ""+data.sender_name+" send you a friend request",
									 icon: "<?php echo base_url('assets/data/profile/'); ?>"+data.sender_image+"",
								 }
							// If it's okay let's create a notification
							var notification = new Notification("Friend Request", options);
						}
					});
				}
			}); 
			/*** END ADD REQUEST PUSHER EVENT ***/
			/*** START REQUEST ACTION PUSHER EVENT ***/
			function actionRequest(id, empid, status){
				if(status == 'accept' || status == '1'){
					$.post('<?php echo base_url('Admin/actionRequest'); ?>', {id:id, empid:empid, status:'accept'});
					$('#request_'+empid).html("<p class='text-success' style='font-size:11.2px;'>friend request accept</p>");
					$('#request_'+empid).parent().parent().fadeOut(2000);
				}
				else if(status == 'reject' || status == '0'){
					$.post('<?php echo base_url('Admin/actionRequest'); ?>', {id:id, empid:empid, status:'reject'});
					$('#request_'+empid).html("<p class='text-danger' style='font-size:11.2px;'>friend request decline</p>");
					$('#request_'+empid).parent().parent().fadeOut(2000);
				}
			}
			var actionRequestChannel = pusher.subscribe('actionRequest_channel');
			var actionRequestUserid = "<?php echo $this->session->userdata('id'); ?>";
			actionRequestChannel.bind('actionRequest_event', function(data){
				if(data.receiver_id == actionRequestUserid){
					var html = '<li class="user-row " onClick="chatWindowOpen('+data.sender_id+');" id="'+data.sender_id+'" data-user-id="'+data.sender_id+'"><div class="user-img"><a href="#"><img src="<?php echo base_url('assets/data/profile/'); ?>'+data.sender_image+'" alt="" /></a></div><div class="user-info"><h4><a href="#">'+data.sender_name+'</a></h4><span class="status available" data-status="available"> Online </span></div><div class="user-status available"><i class="fa fa-circle"></i></div></li>';
					
					if($("#no-friend-added").length > 0){
						$("#no-friend-added").hide();
					}
					$("#friend .contact-list").append(html);
					// Desktop Notification
					Notification.requestPermission(function(permission) {
						// If the user accepts, let's create a notification
						if (permission === "granted") {
							 var options = {
									 body: ""+data.sender_name+" accept your friend request",
									 icon: "<?php echo base_url('assets/data/profile/'); ?>"+data.sender_image+"",
								 }
							// If it's okay let's create a notification
							var notification = new Notification("Accepted", options);
						}
					});
				}
				
				else if(data.sender_id == actionRequestUserid){
					var html = '<li class="user-row " onClick="chatWindowOpen('+data.receiver_id+');" id="'+data.receiver_id+'" data-user-id="'+data.receiver_id+'"><div class="user-img"><a href="#"><img src="<?php echo base_url('assets/data/profile/'); ?>'+data.receiver_image+'" alt="" /></a></div><div class="user-info"><h4><a href="#">'+data.receiver_name+'</a></h4><span class="status available" data-status="available"> Online </span></div><div class="user-status available"><i class="fa fa-circle"></i></div></li>';
					if($("#no-friend-added").length > 0){
						$("#no-friend-added").hide();
					}
					$("#friend .contact-list").append(html);
				} 
				else{
					return false;
				}
			}); 
			/*** END REQUEST ACTION PUSHER EVENT ***/
			/*** START NOTIFICATIONS SCRIPT ***/
			function unseenMessages(){
				$('#messages-loader').show();
				$('.list').animate({scrollTop:$('.list').position().top}, 'slow');
				$.ajax({
					type: "POST",
					url: '<?php echo base_url('Admin/unseenMessages'); ?>',
					dataType: "json",
					data: {},
					success: function(data){ 
						$('#unseenMessages').html(data.html);
						$('#messages-loader').hide();
					},
					error: function(msg) {}
				});
			}
			
			var noMessages = false;
			var users = [];
			var getMessages = <?php echo json_encode($getMessages);?>;
			<?php if(!empty($getMessages)){ foreach($getMessages as $message){?>
				 users.push(<?php echo $message["chat_userid"]?>);
			<?php } }?>;
			/// LOAD MESSAGES ON SCROLL DOWN
			$(".list").scroll(function(){
				if ($(".list").scrollTop() >= ($(".dropdown-menu-list").height() - $(".list").height())-1){
					console.log('scroll');
					$('#messages-loader').show();
					 $.ajax({
						type:'POST',
						url:'<?php echo base_url('Admin/loadMessages'); ?>',
						data: {users : users},
						dataType:'JSON',
						success:function(data){
							//console.log(data)							
							var items = "";
							if(!noMessages){
								if(data != ''){ 
								   for(var i = 0; i < data.length ; i++){
									   users.push(parseInt(data[i]["chat_userid"]));
								   }
								   $.each(data, function(index) {
										items = items + '<li class="unread status-available" onClick="chatWindowOpen("'+data[index]['chat_userid']+'");"><a href="javascript:;"><div class="user-img"><img src="<?php echo base_url('assets/data/profile/'); ?>'+data[index]['sender_image']+'" alt="user-image" class="img-circle img-inline" /></div><div><span class="name"><strong>'+data[index]['chat_id']+'</strong><span class="time small">- '+data[index]['datetime']+' </span></span><span class="desc small">'+data[index]['message']+'</span></div></a></li>';
									});
									noMessages = false;
								}
								else{
									//console.log('no data');
									items = "<p class='animated noMessages'>No more previous messages</p>";
									noMessages = true;
								}
								$('#messages-loader').hide();
								$(".dropdown-menu-list").append(items);
								$(".noMessages").toggleClass('fadeIn');
							}
							else{
								$('#messages-loader').hide();
							}
						}
					}); 
				}
			});
			/*** END NOTIFICATIONS SCRIPT ***/
			
			
			
			
			
			/*** START WHO"S IS TYPING PUSHER EVENT ***/
			var canPublish = true;
			var throttleTime = 200; //0.2 seconds
			$(document).on('keyup', ".chatapi-windows .user-window .typearea input", function(e){
				var typefor = $(this).attr("data-user-id");
				var typeis = "<?php echo $this->session->userdata('id'); ?>";
				var username = "<?php echo $this->session->userdata('name'); ?>";
				if(canPublish) {
					$.post('<?php echo base_url('Admin/whoTyping'); ?>', {username: username,typefor: typefor,typeis: typeis});

					canPublish = false;
					setTimeout(function() {
					  canPublish = true;
					}, throttleTime);
				  }
			});
			
			var typeChannel = pusher.subscribe('typing_channel');
			//var clearInterval = 900; //1 seconds
			var clearTimerId;
			var currentUserid = "<?php echo $this->session->userdata('id'); ?>";
			typeChannel.bind('typing_event', function(data){
				if(data.typefor == currentUserid) {
					if(!$("#user-window"+data.typeis).hasClass("minimizeit")){
						$("#user-window"+data.typeis+ " .someoneType").show().html("<img class='typingImg' src='<?php echo base_url('assets/data/img/writing-smiley.gif'); ?>' /> "+data.username + " is typing...");
						//restart timeout timer
						clearTimeout(clearTimerId);
						clearTimerId = setTimeout(function () {
						  //clear user is typing message
						  $("#user-window"+data.typeis+ " .someoneType").hide();
						}, 900);
					}
				} 
			}); 
			/*** END WHO"S IS TYPING PUSHER EVENT ***/
		 </script>
     </body>
 </html>



 
