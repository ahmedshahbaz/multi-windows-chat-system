	<div id='messages-loader'></div>
	<?php
		if($getMessages != ''){
			foreach($getMessages as $getmessage){
	?>
		 <li class="unread status-available" onClick="chatWindowOpen('<?= $getmessage['chat_userid']; ?>');" <?php if($getmessage['chat_status']=='unseen')echo 'style="background:#eeeff4;border-bottom: 1px solid #dedddd;box-shadow:0px 1px 10px 4px #ccc"' ?>>
			 <a href="javascript:;">
				<div class="user-img">
					<img src="<?= userImage($getmessage['chat_userid']); ?>" alt="user-image" class="img-circle img-inline" />
				</div>
				<div>
					 <span class="name">
						 <strong <?php if($getmessage['chat_status']=='seen')echo 'style="font-weight:500;"' ?>><?= userName($getmessage['chat_userid']); ?></strong>
						 <span class="time small">- <?= time_ago($getmessage['chat_datetime']); ?> </span>
						 <!--<span class="profile-status available pull-right"></span>-->
					 </span>
					 <span class="desc small">
						<?= $getmessage['chat_msg']; ?>
					 </span>
				</div>
			</a>
		</li>
	<?php
			}
		}
	?>