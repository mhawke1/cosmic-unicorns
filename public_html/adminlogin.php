<?php
	session_start();
//header("Location: sdfsel");
	require_once 'swim.php';
//header("Location: addsafanel");
	$db=new database();
	$db->databaseName($SWIM['dbDatabaseName']);
	$db->username($SWIM['dbUsername']);
	$db->password($SWIM['dbPass']);

	$msg='';

	

function handlePostData(&$db)
{
	if($_SERVER['REQUEST_METHOD']!=='POST')return 1;

	$result=iniDatabase($db);
	if($result===6)return 2;
	else if($result===7)return 3;
	//header("Location: admdddsadfnpanel");
	$session=new session();
	$result=$session->start();
	if($result==2)return 4;
	if($session->getUserId()!==null)return 5;

	if(!array_key_exists('email',$_POST))return 6;
	if(!is_string($_POST['email']))return 7;
	$email=trim($_POST['email']);

	if(!array_key_exists('password',$_POST))return 8;
	if(!is_string($_POST['password']))return 9;
	$password=trim($_POST['password']);

	$result=loginEmailPass($email,$password,$db,$session);
      
	if($result===0)return 0;
	else if($result===3)return 10;
	else if($result===4)return 11;
	else if($result===6)return 12;
	else if($result===7)return 13;
	else if($result===8)return 14;
	else if($result===9)return 15;
	else if($result===10)return 16;
	else if($result===11)return 17;
	else if($result===12)return 18;
	else if($result===13)return 19;
	else if($result===14)return 20;
	else if($result===15)return 21;
	else if($result===16)return 22;
}

	$result=handlePostData($db);

	$session=new session();
	$session->start();

	if($result===0||$result===5||$session->getUserId()!==null)
	{  
		$msg='You are already logged in(and for some reason the server failed to redirect you to your admin panel). Please <a href="adminpanel">CLICK HERE</a> to visit your admin panel.';
         
         if($session->getRole()==1)
         {
         	header("Location: order-list");
         }else {
         	header("Location: adminpanel");
         }
		
		//die();
	}
	else if($result===1)$msg='';//The form was not submitted, so there is no status message needed.
	else if($result===2)$msg='An error occurred while trying to close the previous database connection.';
	else if($result===3)$msg='Failed to open a new connection to the database.';
	else if($result===4)$msg='Failed to start a user session.';
	else if($result===6)$msg='Email missing from submission data.';
	else if($result===7)$msg='Invalid submission data for email address.';
	else if($result===8)$msg='Password missing from submission data.';
	else if($result===9)$msg='Password submission data for email address.';
	else if($result===10)$msg='Invalid format passed in for email address.';
	else if($result===11)$msg='Error#11';
	else if($result===12)$msg='Error#12';
	else if($result===13||$result===15||$result===17||$result===18||$result===20||$result===21||$result===22)$msg='Invalid Email + Password';
	else if($result===14)$msg='Error#14';
	else if($result===16)$msg='Error#16';
	else if($result===19)$msg='Error#19';

//var_dump($session->getUserId());
//var_dump($session->sessionExists());
	echo '<!DOCTYPE html>
<html lang="en-US">'.
	headerHTML('Cosmic Unicorns').'
	<body class="home page wide wave-style">
	<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-TRBLWDG"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->
		<div class="page">'.
			topPanel().'
			<!-- header container -->
			<div class="header_cont">
				<div class="header_mask">
					<div class="header_pattern"></div>
					<div class="header_img"></div>
				</div>
				<header class="site_header logo-in-menu" data-menu-after="3">
					<div class="header_box">
						<div class="container">
							<!-- logo -->
							<div class="header_logo_part with_border" role="banner">
								<a class="logo" href="./"><img src="i/logo.png" data-at2x="i/logo2x.png" alt /></a>
							</div>
							<!-- / logo -->'.
	mainMenu().'
						</div>
					</div>
				</header>
				<!-- #masthead -->
			</div>

			<!-- breadcrumbs -->
			<section class="page_title wave">
				<div class="container">
					<div class="title">
						<h1>Admin Login</h1>
					</div>
					<nav class="bread-crumbs"><a href="./" >Home</a><i class="delimiter fa fa-chevron-right"></i><span class="current">Admin Login</span></nav>
					<!-- .breadcrumbs -->
				</div>
				<canvas class="breadcrumbs" data-bg-color="#f8f2dc" data-line-color="#f9e8b2"></canvas>
			</section>
			<!-- / breadcrumbs -->

			<!-- main container -->
			<div id="main" class="site-main">
				<div class="page_content">
					<!-- pattern conatainer / -->
					<div class="left-pattern pattern pattern-2"></div>
					<main>



						<!-- section -->
						<div class="grid_row clearfix" style="padding-top:30px;">
							<div class="grid_col grid_col_12">
								<div class="ce clearfix">';





	if($msg!='')
	{
echo '<div class="cws_msg_box error-box clearfix" style="display: block;">
	<div class="icon_section"><i class="fa fa-exclamation"></i></div>
	<div class="content_section">
		<div class="msg_box_title">Error</div>
		<div class="msg_box_text">
			<p for="name" class="error">'.$msg.'</p>
		</div>
	</div>
</div>';
	}
echo '  

			<form action="" method="post">
				<div class="row">
					<div class="col-lg-6 mb-4 mb-lg-0">

<p>
	Name*
	<br>
	<span class="cf-form-control-wrap your-name">
		<input type="email" name="email" value="" size="107" class="cf-form-control cf-text cf-validates-as-required" aria-required="true" aria-invalid="false">
	</span>
</p>
<p>
	Password*
	<br>
	<span class="cf-form-control-wrap your-name">
		<input type="password" name="password" value="" size="107" class="cf-form-control cf-text cf-validates-as-required" aria-required="true" aria-invalid="false">
	</span>
</p>

<p>
	<input type="submit" value="Log-In" class="cf-form-control cf-submit">
</p>





						<!--<input type="email" class="form-control mb-3" id="mail" name="email" placeholder="Email">-->
						<!--<input type="password" class="form-control mb-3" id="mail" name="password" placeholder="Password">-->
					</div>


					<!--<div class="col-lg-12">
						<button type="submit" value="send" class="btn btn-primary">Log-In</button>
					</div>-->
				</div>
			</form>



								</div>
							</div>
						</div>


					</main>
					<div class="right-pattern pattern pattern-2"></div>
					<!-- pattern conatainer / -->
				</div>
			</div>
			<!-- main container -->'.
		siteFooter().'
	</body>
</html>';
?>