<?php

	require 'core.inc.php';
	require 'connect.inc.php';
	
	if(loggedin()) {
		$user_fullname =getfield('name').' ,you are logged in';
		$logged_in=1;						
	}else{
		$logged_in=0;
	}
?>

<!doctype html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>X Note Plus</title>
	<link rel="stylesheet" href="styles.css" type="text/css" />
</head>

<body>
	<div id="container">
		<header>
			<h1><a href="/">X NOTE<span> PLUS</span></a></h1>
			<h2>Upload, Share, and compare notes</h2>
		</header>
		
		<!-- top menu bar -->
		<?php include 'menu.php'; ?>

		<div id="body">

			<!-- Main body -->
			<section id="content">
				
				<article>
					
					<!-- Page title -->
					<h1>Contact Us</h1>
					
					
					<!-- Section separator -->
					<article class="expanded"></article>
					<br>

					
					<!-- Section content -->
					<?php 
						$action=$_REQUEST['action'];
						if ($action=="")    /* display the contact form */ 
						{?>
							<form  action="" method="POST" enctype="multipart/form-data"> 
							<input type="hidden" name="action" value="submit"> 
							Your name:<br>
							<input name="name" type="text" value="" size="30"/><br> 
							Your email:<br> 
							<input name="email" type="text" value="" size="30"/><br> 
							Your message:<br> 
							<textarea name="message" rows="7" style="width:100%;height:auto;"></textarea><br> 
							<input type="submit" value="Send email"/> 
							</form>
						<?php 
						} else {
							$name=$_REQUEST['name'];
							$email=$_REQUEST['email'];
							$message=$_REQUEST['message'];
							
							if (!preg_match("/^[a-zA-Z ]*$/",$name)) {
								$nameErr = true;
								$name = "";
							} else {
								$nameErr = false;
							}
							
							if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
								$emailErr = true;
								$email="";
							} else {
								$emailErr = false;
							}
							
							if (($name=="")||($email=="")||($message=="")){
								$incorrectField = true;
								if($name==""){$incorrectName=true;}else{$incorrectName=false;};
								if($email==""){$incorrectEmail=true;}else{$incorrectEmail=false;};
								if($message==""){$incorrectMessage=true;}else{$incorrectMessage=false;};
							} else {
								$incorrectName=false;
								$incorrectEmail=false;
								$incorrectMessage=false;
								
								$from="From: $name<$email>\r\nReturn-path: $email"; 
								$subject="Message sent using your contact form";
								mail("notepluswebmaster@gmail.com", $subject, $message, $from);
								echo "Message sent to admins!";
								$incorrectField = false;
							}

							if($incorrectField) {
								echo '<strong><span style="color:#FF0000;">ALL fields are required</span></strong>';
							?>
								<br><br>
								<form  action="" method="POST" enctype="multipart/form-data"> 
								<input type="hidden" name="action" value="submit"> 
								
								<?php
								if($incorrectName){
									echo '<strong><span style="color:#FF0000;">Your name:</span></strong>';
									if($nameErr){echo'<span style="color:#FF0000;"> Name must contain only letters and spaces</span>';};
								} else {
									echo 'Your name:';
								}?>
							
								<br> 
								<input name="name" type="text" value="<?php if(!($name == '')){print "$name";}?>" size="30"/><br> 
								
								<?php
								if($incorrectEmail){
									echo '<strong><span style="color:#FF0000;">Your email:</span></strong>';
									if($emailErr){echo'<span style="color:#FF0000;"> Incorrect email format example@email.com</span>';}
								} else {
									echo 'Your email:';
								}?>
								
								<br> 
								
								<input name="email" type="text" value="<?php if(!($email == '')){print "$email";}?>" size="30"/><br> 
								
								<?php
								if($incorrectMessage){
									echo '<strong><span style="color:#FF0000;">Your message:</span></strong>';
								} else {
									echo 'Your message:';
								}?>
								
								<textarea name="message" rows="7" style="width:100%;height:auto;"><?php if(!($message == '')){print "$message";}?></textarea><br>
								<input type="submit" value="Send email"/>
								</form>
							<?php
							}
						}
						?> 
					<p>&nbsp;</p>
				</article>

			</section>
			
			<!-- Left side bar -->
			<aside class="sidebar">
				<?php include 'aside.php'; ?>
			</aside>

			<div class="clear"></div>
		</div>
		
		<!-- footer at botom of page -->
		<footer>
			<?php include 'footer.php' ?>;
		</footer>
	</div>
</body>
</html>