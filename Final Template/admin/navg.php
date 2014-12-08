


<nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.php">X Note Admin</a>
            </div>
			 <ul class="nav navbar-nav navbar-right">
				<li>
                        <a href="https://atlp1.serversvast.com:2083" target="_blank"><i class="fa fa-gear fa-fw"></i>cPanel&nbsp;&nbsp;</a>
                </li>
			</ul>
            
            
            <!-- /.navbar-top-links -->

            <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">
						<li>
                            <i></i><br><br>
                        </li>
                        <li>
                            <a href="index.php"><i class="fa fa-dashboard fa-fw"></i> Dashboard</a>
                        </li>
						
                        <li>
                            <a href="#"><i class="fa fa-user fa-fw"></i> Accounts <span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
									<a href="#">Student Accounts <span class="fa arrow"></span></a>
                                    <ul class="nav nav-third-level">
                                        <li>
                                            <a href="studentaccounts.php">View Accounts</a>
                                        </li>
                                        <li>
                                            <a href="addstudent.php">Add Account</a>
                                        </li>                                        
                                    </ul>
                                </li>
                                <li>
                                    <a href="#">Admin Accounts <span class="fa arrow"></span></a>
                                    <ul class="nav nav-third-level">
                                        <li>
                                            <a href="adminaccounts.php">View Accounts</a>
                                        </li>
                                        <li>
                                            <a href="addadmin.php">Add Account</a>
                                        </li>                                        
                                    </ul>
                                </li>
								<li>
                                    <a href="#">Teacher Accounts <span class="fa arrow"></span></a>
                                    <ul class="nav nav-third-level">
                                        <li>
                                            <a href="studentaccounts.php">View Accounts</a>
                                        </li>
                                        <li>
                                            <a href="addstudent.php">Add Account</a>
                                        </li>                                        
                                    </ul>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li> 
                        <li>
                            <a href="#"><i class="fa fa-file-text fa-fw"></i> Notes Files <span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="userfiles.php">User Files</a>
                                </li>
                                <li>
                                    <a href="morris.html">Study Guides</a>
                                </li>
								<li>
                                    <a href="morris.html">Courses</a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li> 
						<li>
                            <a href="#"><i class="fa fa-exclamation-triangle fa-fw"></i> Abuse <span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="flot.html">Files</a>
                                </li>
                                <li>
                                    <a href="morris.html">Study Guides</a>
                                </li>								
                            </ul>
                            <!-- /.nav-second-level -->
                        </li> 
						<li>
							<a href="#"><i class="fa fa-list fa-fw""></i> Feeds <span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="feeds.php">View</a>
                                </li>
                                <li>
                                    <a href="addfeed.php">Add</a>
                                </li>								
                            </ul>                            
                        </li>
						<?php
							if(loggedin()){
								echo 	'<li>
											<a href="logout.php"><i class="fa fa-sign-out fa-fw"></i> Log Out</a>
										</li>';
							}else{
							
							}
						?>
                        
                       
                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
        </nav>