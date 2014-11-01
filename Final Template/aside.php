<ul>
	<li>
		<h4>Links</h4>
		<ul>
			<?php
				if(!loggedin()){
					echo '<li class=""><a href="login.php">Log in</a></li>';
				}else{
					echo '<li class=""><a href="logout.php">Log Out</a></li>';
				}
			?>
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
						<label>Document Title:
							<input type="text" name="searchparams" />
						</label>
						<input type="submit" value="Search" />
					</form>
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