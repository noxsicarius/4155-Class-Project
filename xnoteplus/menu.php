
<ul class="nav nav-stacked templatemo-nav">
				  <li><a href="index.php" class="active"><i class="fa fa-home fa-medium"></i>Homepage</a></li>				  
				  <li><a href="uploads.php"><i class="fa fa-send-o fa-medium"></i>upload</a></li>				  
				  				  
				  <?php
					if($logged_in==1){
						echo '<li><a href="myaccount.php"><i class="fa fa-comments-o fa-medium"></i>My Account</a></li>';
						echo '<li><a href="logout.php"><i class="fa fa-gears fa-medium"></i>Log out</a></li>';
						
					}
					else{
						echo '<li><a href="login.php"><i class="fa fa-gears fa-medium"></i>Log in</a></li>';
						echo '<li><a href="register.php"><i class="fa fa-gears fa-medium"></i>Register</a></li>';
					
					
					}
				  ?>
				  <li><a href="about.php"><i class="fa fa-send-o fa-medium"></i>About Us</a></li>
				  
				</ul>