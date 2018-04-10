

 <!DOCTYPE html>
 <html class=" ">
     <head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
         <!-- 
         * @Package: Crest Admin - Responsive Theme
         * @Subpackage: Bootstrap
         * @Version: 1.0
         * This file is part of Crest Admin Theme.
        -->
         
         <meta charset="utf-8" />
         <title>Chating</title>
         <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
         <meta content="" name="description" />
         <meta content="" name="author" />
         <meta http-equiv="X-UA-Compatible" content="IE=edge" />

         <link rel="shortcut icon" href="<?php echo base_url(''); ?>assets/images/favicon.png" type="image/x-icon" />     <!-- Favicon -->
         <link rel="apple-touch-icon-precomposed" href="<?php echo base_url(''); ?>assets/images/apple-touch-icon-57-precomposed.png" />	 <!-- For iPhone -->
         <link rel="apple-touch-icon-precomposed" sizes="114x114" href="<?php echo base_url(''); ?>assets/images/apple-touch-icon-114-precomposed.png" />     <!-- For iPhone 4 Retina display -->
         <link rel="apple-touch-icon-precomposed" sizes="72x72" href="<?php echo base_url(''); ?>assets/images/apple-touch-icon-72-precomposed.png" />     <!-- For iPad -->
         <link rel="apple-touch-icon-precomposed" sizes="144x144" href="<?php echo base_url(''); ?>assets/images/apple-touch-icon-144-precomposed.png" />     <!-- For iPad Retina display -->
         <!-- CORE CSS FRAMEWORK - START -->
         <link href="<?php echo base_url(''); ?>assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
         <link href="<?php echo base_url(''); ?>assets/plugins/bootstrap/css/bootstrap-theme.min.css" rel="stylesheet" type="text/css" />
         <link href="<?php echo base_url(''); ?>assets/fonts/font-awesome/css/font-awesome.css" rel="stylesheet" type="text/css" />
         <link href="<?php echo base_url(''); ?>assets/css/animate.min.css" rel="stylesheet" type="text/css" />
         <link href="<?php echo base_url(''); ?>assets/plugins/perfect-scrollbar/perfect-scrollbar.css" rel="stylesheet" type="text/css" />
         <!-- CORE CSS FRAMEWORK - END -->
         <!-- CORE CSS TEMPLATE - START -->
         <link href="<?php echo base_url(''); ?>assets/css/style.css" rel="stylesheet" type="text/css" />
         <!-- CORE CSS TEMPLATE - END -->
		<!--- API SCRIPT ---> 
		<script src="https://apis.google.com/js/platform.js" async defer></script>
		<link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet" type="text/css">
		<script src="https://apis.google.com/js/api:client.js"></script>
		<style type="text/css">
			#gSignInWrapper{
				text-align:center;
			}
			.btn-img{width:200px;cursor:pointer;}
			.img-thumbnail-my {
				border: 3px dotted #FFC107;
				background: none;
				padding: 0px;
				display: inline-block;
				width: 130px;
				line-height: 1.42857143;
				-webkit-transition: all .2s ease-in-out;
				-o-transition: all .2s ease-in-out;
				transition: all .2s ease-in-out;
			}
			.block .user .info {
				width: 125px;
			}
			.img-circle{width:120px;}
			.panel{box-shadow:0px 3px 30px 0px #eea236;background-color: rgba(245, 245, 245, 0.81);}
		</style>
     </head>
     <!-- END HEAD -->

     <!-- BEGIN BODY -->
     <body class=" login_page">
         <div class="container-fluid">
             <div class="login-wrapper row">
                 <div id="login" class="login loginpage col-lg-offset-4 col-md-offset-3 col-sm-offset-3 col-xs-offset-0 col-xs-12 col-sm-6 col-lg-4">
                    <h1><a href="#" title="Login Page" tabindex="-1">Chat System </a></h1>
					<div id="name"></div>
                    <form action="<?php echo base_url('Admin/index'); ?>" method="post">
                         <p>
                            <label for="user_login">Username <br />
                            <input type="email" name="email" class="input" /></label>
                         </p>
                         <p>
                            <label for="user_pass">Password <br />
                            <input type="password" name="password" class="input" /></label>
                         </p>
                         <p class="submit">
                             <input type="submit" name="wp-submit" id="wp-submit" class="btn btn-accent btn-block" value="Sign In" />
                         </p>
                     </form>
                 </div>
             </div>
         </div>
         <!-- MAIN CONTENT AREA ENDS -->
         <!-- LOAD FILES AT PAGE END FOR FASTER LOADING -->


         <!-- CORE JS FRAMEWORK - START --> 
         <script src="<?php echo base_url(''); ?>assets/js/jquery-1.12.4.min.js" type="text/javascript"></script> 
         <script src="<?php echo base_url(''); ?>assets/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>  
         <script src="<?php echo base_url(''); ?>assets/plugins/perfect-scrollbar/perfect-scrollbar.min.js" type="text/javascript"></script>  
         <script>window.jQuery || document.write('<script src="../assets/js/jquery-1.12.4.min.js"><\/script>');</script>
         <!-- CORE JS FRAMEWORK - END --> 
         <!-- CORE TEMPLATE JS - START --> 
         <script src="<?php echo base_url(''); ?>assets/js/scripts.js" type="text/javascript"></script> 
		<script type="text/javascript" src="<?php echo base_url()?>assets/js/noty.min.js"></script>
         <!-- END CORE TEMPLATE JS - END --> 
     </body>
 </html>



 