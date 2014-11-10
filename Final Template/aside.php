<head>
	<link rel="stylesheet" href="css/bootstrap.css">
</head>

<ul>
	<li>
		<h4>Links</h4>
		<ul>
			<?php
				if(!loggedin()){
					echo '<li class=""><a href="login.php">Log in</a></li>';
					
				}else{
					
					echo '<li class=""><a href="similar.php">Similar Notes</a></li>';
					echo '<li class=""><a href="logout.php">Log Out</a></li>';
				}
			?>
			<li class=""><a href="contact.php">Contact Us</a></li>
		</ul>
	</li>

	<li>
		<h4>About us</h4>
			<ul>
				<li class="text"> </li>
			</ul>
	</li>

	<li>
		<h4>Search site</h4>
		<ul>
			<li class="text">
				<form action="search.php" method="get">
					<div class="input-group">
					  	<label>Document Title:
							<input type="text" name="searchDoc" class="form-control" placeholder="">
						</label>
					</div>
					<button class="btn btn-default" type="submit">Search</button>
				</form><br>
			</li>
		</ul>
	</li>

	<li>
		<h4>Helpful Links</h4>
		<ul>
			<li></li>
		</ul>
	</li>
</ul>