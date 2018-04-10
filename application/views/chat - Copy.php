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
		<!-- CORE CSS FRAMEWORK - END -->
		<!-- PUSHER - START -->
		<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js" type="text/javascript" ></script> 
		<script src="//js.pusher.com/2.2/pusher.min.js" type="text/javascript" type="text/javascript" ></script>    
		<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js" type="text/javascript" ></script>   
		<script src="//cdnjs.cloudflare.com/ajax/libs/bootbox.js/4.3.0/bootbox.min.js" type="text/javascript" ></script>
		<link rel="stylesheet" type="text/css" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css" />
		<!-- PUSHER - END -->
		<style>
			#loader {display:none;width: 30px;margin: 0px 0px 15px 40%;}
			.noMoreMessage{color: #ef7474;background: #fde9e9;padding: 5px;text-align: center;width: 250px;margin-left: -6px;margin-top: -15px;}
			.blink_me {
			  //animation: blinker 1s linear infinite;
			  background:#565090;
			}
			.unreadCount {
			  animation: counterblinker 2s linear infinite;
			}
			.chatapi-windows .user-window.minimizeit .controlbar .blink_img{top: -20px;width: 25px;height: 25px;left: -20px;animation: blinker 1s linear infinite;}
			@keyframes blinker {  
			  100% { padding:2px; }
			} 
			@keyframes counterblinker {  
			  50% { box-shadow: 0px 0px 10px #ff5f74; }
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
                 <div class='pull-right'>
                     <ul class="info-menu right-links list-inline list-unstyled">
                         <li class="profile">
                             <a href="#" data-toggle="dropdown" class="toggle">
                                 <img src="<?php echo base_url('assets/data/profile/').$this->session->userdata('image'); ?>" alt="user-image" class="img-circle img-inline" />
                                 <span><?= $this->session->userdata('name'); ?><i class="fa fa-angle-down"></i></span>
                             </a>
                             <ul class="dropdown-menu profile animated fadeIn">
                                 <li>
                                     <a href="<?php echo base_url('Admin/logout'); ?>">
                                         <i class="fa fa-lock"></i>
                                        Logout
                                     </a>
                                 </li>
                             </ul>
                         </li>
                         <li class="chat-toggle-wrapper">
                             <a href="#" data-toggle="chatbar" class="toggle_chat">
                                 <i class="fa fa-comments"></i>
                                 <span class="badge badge-accent" id="unreadChat" style="background:#ff5f74;"></span>
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
                     <input type="text" placeholder="Search" class="form-control" />
                 </div>

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
									 <a href="#"><img src="<?php echo base_url('assets/data/profile/').$users['image']; ?>" alt="" /></a>
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
							<li class="user-row " id='<?= $user['id']; ?>' data-user-id='<?= $user['id']; ?>'>
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
										<a href="#"><?= $user['name']; ?>
											<span class="badge badge-accent unreadCount" id="<?= $user['id']; ?>" style="background:#ff5f74;padding: 3px 5px;font-size: 8px;"></span> 
										</a>
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
										<a href="#"><?= $user['name']; ?>
											<span class="badge badge-accent unreadCount" id="<?= $user['id']; ?>" style="background:#ff5f74;padding: 3px 5px;font-size: 8px;"></span>
										</a>
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
							<li class="user-row-noactive">
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
									 <span class="status" id="request_<?= $request['fl_id']; ?>"><button class="btn btn-success btn-xs" onClick="actionRequest('<?= $request['fl_id']; ?>','accept');"><i class="fa fa-check"></i></button> <button class="btn btn-warning btn-xs" onClick="actionRequest('<?= $request['fl_id']; ?>','reject');"> <i class="fa fa-times"></i></button> <!--<button class="btn btn-danger btn-xs" onClick="actionRequest('<?= $request['fl_id']; ?>','block');"> <i class="fa fa-ban"></i></button>--></span>
								</div>
							</li>
						<?php
								}
							}
							else{
						?>
						<li class="user-row-noactive">
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
         <script src="<?php echo base_url(''); ?>assets/js/jquery-1.12.4.min.js" type="text/javascript"></script> 
         <script src="<?php echo base_url(''); ?>assets/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script> 
         <script src="<?php echo base_url(''); ?>assets/plugins/perfect-scrollbar/perfect-scrollbar.min.js" type="text/javascript"></script>
         <script src="<?php echo base_url(''); ?>assets/js/scripts.js" type="text/javascript"></script>  
         <!-- CORE JS FRAMEWORK - END --> 
		 <script>
			jQuery(document).ready(function() {
				reloadUnreadChat();
				$('.unreadCount').each(function(){
					var id = $(this).attr('id');
					loadUserUnreadChat(id);
				});
			});
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
			
			$('.pending_request').click(function(){
				$(this).addClass('active');
				$('.mlp').removeClass('active');
				$('.friend').removeClass('active');
				$('#mlp').hide();
				$('#friend').hide();
				$('#pending_request').show();
			});
			
			function addRequest(id){
				$.ajax({
					type:'POST',
					url:'<?php echo base_url('Admin/addRequest'); ?>',
					data:{id:id},
					dataType:'JSON',
					success:function(data){
						if(data == true){
							$('#user_'+id).html("<p class='text-success' style='font-size:11.2px;'>friend request sent</p>");
							$('#user_'+id).fadeOut(3000);
						}
						else{
							$('#user_'+id).html("<p class='text-danger' style='font-size:11.2px;'>request already exist</p>");
							$('#user_'+id).fadeOut(3000);
						}
					},
					error:function(data){console.log('error: '+data.responseText);}
				});
			}
			
			function actionRequest(id, status){
				$.ajax({
					type:'POST',
					url:'<?php echo base_url('Admin/actionRequest'); ?>',
					data:{id:id, status:status},
					dataType:'JSON',
					success:function(data){
						if(status == 'accept'){
							$('#request_'+id).html("<p class='text-success' style='font-size:11.2px;'>friend request accept</p>");
						}
						else if(status == 'reject'){
							$('#request_'+id).html("<p class='text-danger' style='font-size:11.2px;'>friend request decline</p>");
						}
						else if(status == 'block'){
							$('#request_'+id).html("<p class='text-danger' style='font-size:11.2px;'>Blocked</p>");
						}
					},
					error:function(data){console.log('error: '+data.responseText);}
				});
			}
			
				<!--- DateTime Convertion --->
				function timeDifference(previousDate) {
					var previous = new Date(previousDate.replace(/-/g,"/"));
					var msPerMinute = 60 * 1000;
					var msPerHour = msPerMinute * 60;
					var msPerDay = msPerHour * 24;
					var msPerWeek = msPerDay * 7;
					var msPerMonth = msPerDay * 30;
					var msPerYear = msPerDay * 365;
					var currentDate = "<?php echo date('Y-m-d H:i:s'); ?>";
					var current = new Date(currentDate.replace(/-/g,"/"));
					var elapsed = current - previous;
					//Explode / Convert Date
					var explodeDate = previousDate.split(" ");
					var oldDate = explodeDate[0];
					var seperateDate = oldDate.split("-");
					var convertDate = seperateDate[1]+"-"+seperateDate[2]+"-"+ seperateDate[0];
					//Explode / Convert Time AM PM
					var oldTime = explodeDate[1];
					var seperateTime = oldTime.split(":");
					var hours = seperateTime[0];
					var minutes = seperateTime[1];
					var seconds = seperateTime[2];
					var ampm = hours >= 12 ? 'pm' : 'am';
					hours = hours % 12;
					hours = hours ? hours : 12; // the hour '0' should be '12'
					minutes = minutes < 10 ? '0'+minutes : minutes;
					var thistime = hours + ':' + minutes + ' ' + ampm;
					
					var gyear = previous.getFullYear();
					var gmonth = previous.getMonth();
					var gdate = previous.getDate();
					var gday = previous.getDay();
					
					var gyear2 = current.getFullYear();
					var gmonth2 = current.getMonth();
					var gdate2 = current.getDate();
					var gday2 = current.getDay();
					
					var monthNames = ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"];
					var dayNames = ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'];
					
					if (elapsed < msPerMinute) {
						 return Math.round(elapsed/1000) + ' seconds ago';   
					}

					else if (elapsed < msPerHour) {
						 return Math.round(elapsed/msPerMinute) + ' minutes ago';   
					}

					else if (elapsed < msPerDay ) {
						//return Math.round(elapsed/msPerHour ) + ' hours ago';
						if(gyear == gyear2 && gmonth == gmonth2 && gdate == gdate2){
							return 'Today'+" "+thistime;
						}
						else{
							return 'Yesterday'+" "+thistime;
						} 						
					}
					
					else if (elapsed < msPerWeek ) {
						 return dayNames[gday]+" "+thistime;   
					}

					else {
						return monthNames[gmonth]+", "+gdate+" "+gyear+" "+thistime;   
					} 
				}			
				<!--- End DateTime Convertion --->
				<!--- Chatbox script --->
				// Enter your own Pusher App key
				//var pusher = new Pusher('755194918955dd82f4a3');
			    var lastId;
				var pusher = new Pusher('755194918955dd82f4a3', {
					  cluster: 'ap2'
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
						titleSet = $(document).attr("title", sender_name[0]+" send you a message");	
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
										data[index]['chat_userid'] == <?php echo $this->session->userdata('id'); ?> ? user_name = "You"  : user_name = getUserName(data[index]['chat_userid']);
										data[index]['chat_userid'] == <?php echo $this->session->userdata('id'); ?> ?  style = 'background:#e6e9ed;color:#333;' : style ='background:#565090;color:#fff;';
										items = items + "<div class='chatmsg msg_save'><span class='name'>"+user_name+"</span><span class='text' style='"+bg+"'>"+data[index]['chat_msg']+"</span><span class='ts'>"+timeDifference(data[index]['chat_datetime'])+"</span></div>";
									});
									
									html = "<div class='user-window minimizeit' id='user-window" + reciever_id + "' data-user-id='" + reciever_id + "'>";
									html += "<div class='controlbar'><img class='blink_img' src='<?php echo base_url("assets/data/img/chat-alert.png"); ?>' style='display:none;'><img src='" + img + "' data-user-id='" + reciever_id + "' class='profile_img' rel='tooltip' data-animate='animated fadeIn' data-toggle='tooltip' data-original-title='" + name + "' data-placement='top' data-color-class='primary'><span class='status " + status + "'><i class='fa fa-circle'></i></span><span class='name'>" + name + "</span><span class='opts'><i class='fa fa-times closeit' data-user-id='" + reciever_id + "'></i><i class='fa fa-minus minimizeit' data-user-id='" + reciever_id + "'></i></span></div>";
									
									html += "<img id='loader' src='<?php echo base_url("assets/data/img/chat-loader.gif"); ?>'><div class='chatarea'>"+items+"</div>";
									
									html += "<div class='typearea'><input type='text' name='chating' data-user-id='" + reciever_id + "' placeholder='Type & Enter' class='form-control'></div>";
									html += "</div>";
									$(".chatapi-windows").append(html);
									$("#user-window" + sender_id + " .controlbar").css('background','#565090');
									$("#user-window" + sender_id + " .controlbar .profile_img").css('top','-25px');
									$("#user-window" + sender_id + " .controlbar .blink_img").show();
									loadConversation(reciever_id,lastId);
									loadUserUnreadChat(reciever_id);
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
							loadUserUnreadChat(reciever_id);
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
							loadUserUnreadChat(reciever_id);					
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
				$('.page-chatapi .user-row').on('click', function() {
					var name = $(this).find(".user-info h4 a").html();
					var img = $(this).find(".user-img a img").attr("src");
					var id = $(this).attr("data-user-id");
					var status = $(this).find(".user-info .status").attr("data-status");

					if ($(this).hasClass("active")) {
						$(this).toggleClass("active");
						$(".chatapi-windows #user-window" + id).hide();
					} 
					else {
						$(this).toggleClass("active");

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
												data[index]['chat_userid'] == <?php echo $this->session->userdata('id'); ?> ? user_name = "You"  : user_name =getUserName(data[index]['chat_userid']);
												data[index]['chat_userid'] == <?php echo $this->session->userdata('id'); ?> ?  style = 'background:#e6e9ed;color:#333;' : style ='background:#565090;color:#fff;';
												items = items + "<div class='chatmsg msg_save'><span class='name'>"+user_name+"</span><span class='text' style='"+style+"'>"+data[index]['chat_msg']+"</span><span class='ts'>"+timeDifference(data[index]['chat_datetime'])+"</span></div>";
											});
												
											var html = "<div class='user-window' id='user-window" + id + "' data-user-id='" + id + "'>";
											html += "<div class='controlbar'><img class='blink_img' src='<?php echo base_url("assets/data/img/chat-alert.png"); ?>' style='display:none;'><img src='" + img + "' data-user-id='" + id + "' class='profile_img' rel='tooltip' data-animate='animated fadeIn' data-toggle='tooltip' data-original-title='" + name + "' data-placement='top' data-color-class='primary'><span class='status " + status + "'><i class='fa fa-circle'></i></span><span class='name'>" + name + "</span><span class='opts'><i class='fa fa-times closeit' data-user-id='" + id + "'></i><i class='fa fa-minus minimizeit' data-user-id='" + id + "'></i></span></div>";
											
											html += "<img id='loader' src='<?php echo base_url("assets/data/img/chat-loader.gif"); ?>'><div class='chatarea'>"+items+"</div>";
											
											html += "<div class='typearea'><input type='text' name='chating' data-user-id='" + id + "' placeholder='Type & Enter' class='form-control'></div>";
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
											html += "<div class='typearea'><input type='text' name='chating' data-user-id='" + id + "' placeholder='Type & Enter' class='form-control'></div>";
											html += "</div>";
											$(".chatapi-windows").append(html);
										}
									},
									error:function(data){console.log('error: '+data.responseText);}
								}); 
						}
					}
                 
				});
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
				/*** Start get sender name ***/
				function getUserName(id){
					var userName = null;
					$.ajax({
						type:'POST',
						url:'<?php echo base_url('Admin/getName'); ?>',
						data:{employee_id:id},
						dataType: "html",
						async: false,
						success:function(data){
							var split_name = data.split(" ");
							userName = split_name[0].replace(/"/g, "");
						},
						error:function(data){console.log('error: '+data.responseText);}
					});
					return userName;
				}
				/*** End get sender name ***/
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
								$(document).attr("title", "Chating");
								reloadUnreadChat();	
								loadUserUnreadChat(id);
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
							$("#unreadChat").text(data);
						},
						type: 'GET'
					});
				}
				/*** END UNREAD VALUE ***/
				/*** START UNREAD USER VALUE ***/
				function loadUserUnreadChat(id){
					$.ajax({
						type: "POST",
						url: '<?php echo base_url('Admin/reloadUserCounter'); ?>',
						dataType: "json",
						data: {sender_id:id},
						success: function(data){ 
							if(data != 0){
								if (!$("#"+id+" .user-info h4 a .unreadCount").css("display","none")) {
									$("#"+id+" .user-info h4 a .unreadCount").text(data);
									$(".controlbar .name #"+id+" .unreadCount").text(data);
								}
								else{
									$("#"+id+" .user-info h4 a .unreadCount").show().text(data);
									$(".controlbar .name #"+id+" .unreadCount").show().text(data);
								}
							}
							else{
								$("#"+id+" .user-info h4 a .unreadCount").hide();
								$(".controlbar .name #"+id+" .unreadCount").hide();
							} 
						},
						error: function(msg) {}
					});
				} 
				/*** END UNREAD USER VALUE ***/
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
												data[index]['chat_userid'] == <?php echo $this->session->userdata('id'); ?> ? user_name = "You"  : user_name = getUserName(data[index]['chat_userid']);
												data[index]['chat_userid'] == <?php echo $this->session->userdata('id'); ?> ?  style = 'background:#e6e9ed;color:#333;' : style ='background:#565090;color:#fff;';
												items = items + "<div class='chatmsg msg_save'><span class='name'>"+user_name+"</span><span class='text' style='"+style+"'>"+data[index]['chat_msg']+"</span><span class='ts'>"+timeDifference(data[index]['chat_datetime'])+"</span></div>";
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
				/* function chatformat_msg(msgDetail, type, name) {
					var d = new Date();
					var h = d.getHours();
					var m = d.getMinutes();
					return "<div class='chatmsg msg_" + type + "'><span class='name'>" + name + "</span><span class='text' style='background:#e6e9ed;color:#333;'>"+ msgDetail +"</span><span class='ts'>" + h + ":" + m + "</span></div>";
				} */ 
		 </script>
     </body>
 </html>



 