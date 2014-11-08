
			<br>
			<div class="panel panel-default">
			  <!-- Default panel contents -->
			  <!--<div class="panel-heading">Your Files</div>-->
			  <h2> Your Files</h2>
			  <div class="panel-body">
			  <table class="table">
										
						<tr bgcolor="#FFFFF0">
							
							<td><b>File Title</b></td>
							<td><b>File Name</b></td>
							<td><b>Action</b></td>
						</tr>

						<?php
							$ID=getuserid();
							$Files_Title=FilesInDataBase_ID('NotesTitle',$ID);
							$Files_Names=FilesInDataBase_ID('FileName',$ID);
							$Files_ID=FilesInDataBase_ID('FileID',$ID);
							$arrlength=count($Files_Title);

							for($x=0;$x<$arrlength;$x++){
								echo '<tr>';
								//First column
								echo '<td>'."$Files_Title[$x]".'</td>';
								//Second column 
								echo '<td>'."$Files_Names[$x]".'</td>';
								//Third Column
								$similarfile='similar.php?id='.$Files_ID[$x];								
								echo '<td>';echo "<a href='".$similarfile."'>View Similar Notes</a>";
								
								echo '</td>';
								echo '</tr>';
							}
						?>
				</table>
				</div>
				</div>
				