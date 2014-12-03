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
                                    <a href="flot.html">Student Accounts</a>
                                </li>
                                <li>
                                    <a href="morris.html">Teacher Accounts</a>
                                </li>
								<li>
                                    <a href="morris.html">A Accounts</a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li> 
                        <li>
                            <a href="#"><i class="fa fa-file-text fa-fw"></i> Notes Files <span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="flot.html">User Files</a>
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
                            <a href="index.php"><i class="fa fa-list fa-fw"></i> Feeds</a>
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