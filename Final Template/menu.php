<ul>
        	<li class="start selected"><a href="index.php">Home</a></li>
            <li class=""><a href="uploads.php">upload</a></li>
		<?php
			if(!loggedin()){
				echo '<li class=""><a href="register.php">Register</a></li>';
				echo '<li class=""><a href="login.php">Log in</a></li>';
			}else{
				echo '<li class=""><a href="index.php">My Account</a></li>';
				echo '<li class=""><a href="logout.php">Log Out</a></li>';
			}
			
		?>

            <li class=""><a href="index.php">Contact</a></li>
</ul>