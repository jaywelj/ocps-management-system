<?php
$varcharAdminUserName = $_SESSION['sessionAdminName'];

?>
<?php 
include("connectionString.php");

?>
<div class="top_nav">
	<div class="nav_menu">
		<nav>
			<div class="nav toggle">
				<a id="menu_toggle"><i class="fa fa-bars"></i></a>
			</div>

			<ul class="nav navbar-nav navbar-right">
				<li class="">
					<a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
						<?php

						$result = mysqli_query($connect,"SELECT * FROM `tbl_adminaccount` WHERE `adminUserName` = '$varcharAdminUserName'");

						while($res = mysqli_fetch_array($result))
						{
							$varcharAdminUserName = $res['adminUserName'];
							$varcharAdminFirstName = $res['adminFirstName'];
							$varcharAdminMiddleName = $res['adminMiddleName'];
							$varcharAdminLastName = $res['adminLastName'];
							$varcharAdminBirthDate = $res['adminBirthDate'];
							$varcharAdminPassword = $res['adminPassword'];
							$varcharAdminAccessLevel = $res['adminAccessLevel'];
							$varcharAdminImage = $res['adminImage'];
						if(empty($varcharAdminImage))
						{
							echo '
							<tr>
							<td>
							<img src="assets/img/default-user.png">
							</tr>
							</td>
							';
						}
						else{
							echo '
							<tr>
							<td>
							<img src="data:image/jpeg;base64,'.base64_encode($res['adminImage']).'"  alt="">
							</tr>
							</td>
							';
						}
					}
						?>
						<?php echo $varcharAdminFirstName;?>
						<span class=" fa fa-angle-down"></span>
					</a>
					
					<ul class="dropdown-menu dropdown-usermenu pull-right">
						<li><a href="AdminProfile.php"> Profile</a></li>
						<li>
							<a href="javascript:;">
								<span class="badge bg-red pull-right">50%</span>
								<span>Settings</span>
							</a>
						</li>
						<li><a href="javascript:;">Help</a></li>
						<li><a href="logout.php"><i class="fa fa-sign-out pull-right"></i> Log Out</a></li>
					</ul>
				</li>

				<li role="presentation" class="dropdown">
					<a href="javascript:;" class="dropdown-toggle info-number" data-toggle="dropdown" aria-expanded="false">
						<i class="fa fa-envelope-o"></i>
						<span class="badge bg-green">6</span>
					</a>
					<ul id="menu1" class="dropdown-menu list-unstyled msg_list" role="menu">
						<li>
							<a>
								<span class="image"><img src="images/img.jpg" alt="Profile Image" /></span>
								<span>
									<span>John Smith</span>
									<span class="time">3 mins ago</span>
								</span>
								<span class="message">
									Film festivals used to be do-or-die moments for movie makers. They were where...
								</span>
							</a>
						</li>
						<li>
							<a>
								<span class="image"><img src="images/img.jpg" alt="Profile Image" /></span>
								<span>
									<span>John Smith</span>
									<span class="time">3 mins ago</span>
								</span>
								<span class="message">
									Film festivals used to be do-or-die moments for movie makers. They were where...
								</span>
							</a>
						</li>
						<li>
							<a>
								<span class="image"><img src="images/img.jpg" alt="Profile Image" /></span>
								<span>
									<span>John Smith</span>
									<span class="time">3 mins ago</span>
								</span>
								<span class="message">
									Film festivals used to be do-or-die moments for movie makers. They were where...
								</span>
							</a>
						</li>
						<li>
							<a>
								<span class="image"><img src="images/img.jpg" alt="Profile Image" /></span>
								<span>
									<span>John Smith</span>
									<span class="time">3 mins ago</span>
								</span>
								<span class="message">
									Film festivals used to be do-or-die moments for movie makers. They were where...
								</span>
							</a>
						</li>
						<li>
							<div class="text-center">
								<a>
									<strong>See All Alerts</strong>
									<i class="fa fa-angle-right"></i>
								</a>
							</div>
						</li>
					</ul>
				</li>
			</ul>
		</nav>
	</div>
</div>
