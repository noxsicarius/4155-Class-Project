<?php
		$UserRole=UserRole();
		function UserRole(){
			$ID=getuserid();
			$query="SELECT * FROM `users` WHERE `Id` = $ID";
			if($result = mysql_query($query)){			
				$content=mysql_result($result,0,'role');
				$File_Field= $content;			
				return $File_Field;
			}
			return 'Student';
		}
	
?>
</div></div>
<div class="container">
				<div class="row">
					<div class="col-md-6 col-md-offset-3">
						<ul class="list-inline">
							<li>
								<a href="index.php">Home</a>
							</li>
							<li>
								<a href="aboutus.php">About US</a>
							</li>
							<li>
								<a href="manual.php">User Manual</a>
							</li>
							<li>
								<a href="credits.php">Credits</a>
							</li>							
							<li>
								<a href="contact.php">Contact</a>
							</li>
							<?php
								if($UserRole=='Admin'){
							?>	
							
							<li>
								<a href="admin/index.php">Admin</a>
							</li>
							<?php
								}
							?>
						</ul>
					   
					</div>
					
				</div>
				<hr>
				
</div>