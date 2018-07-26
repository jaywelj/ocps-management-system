<?php
if(isset($_POST['btnAdd'])) 
{
										//including the database connection file
	include_once("connectionString.php");

	$varcharStudentNumber = mysqli_real_escape_string($connect, $_POST['txtbxStudentNumber']);

	$varcharStudentFirstName = mysqli_real_escape_string($connect, $_POST['txtbxStudentFirstName']);

	$varcharStudentLastName = mysqli_real_escape_string($connect, $_POST['txtbxStudentLastName']);

	$varcharStudentMiddleName = mysqli_real_escape_string($connect, $_POST['txtbxStudentMiddleName']);

	$varcharStudentCourse = mysqli_real_escape_string($connect, $_POST['selectStudentCourse']);

	$varcharStudentYear = mysqli_real_escape_string($connect, $_POST['txtbxStudentYear']);

	$varcharStudentSection = mysqli_real_escape_string($connect, $_POST['txtbxStudentSection']);

	$varcharStudentImage = addslashes(file_get_contents($_FILES["fileStudentImage"]["tmp_name"]));

	$queryGetCollege = "SELECT tbl_college.collegeCode FROM tbl_course INNER JOIN tbl_college ON tbl_course.collegeCode = tbl_college.collegeCode WHERE courseCode = '$varcharStudentCourse' ;";
	$queryGetCollegeArray = mysqli_query($connect, $queryGetCollege);
	while ($row = mysqli_fetch_array($queryGetCollegeArray))
	{
		$varcharStudentCollege = $row['collegeCode'];
	}
	echo "<script type='text/javascript'>alert('$varcharStudentCollege');</script>";


										//first name validation if input is a space 
										// checking empty fields
	if(empty($varcharStudentFirstName) || empty($varcharStudentNumber)) 
	{

		if(empty($varcharStudentFirstName))
		{
			$message = "Enter a First Name";
			echo "<script type='text/javascript'>alert('$message');</script>";
		}
		if(empty($varcharStudentNumber)) 
		{
			$message = "Enter a valid Student Number";
			echo "<script type='text/javascript'>alert('$message');</script>";
		}
												//link to the previous page
		echo "<br/><a href='javascript:self.history.back();'>Go Back</a>";
	}
	else if(empty($varcharStudentImage))
	{
		$queryAdd = "INSERT INTO `tbl_studentaccount` (`studentNumber`, `studentPassword`, `aboutStudent`,`studentDisplayPic`) vALUES ('$varcharStudentNumber', '$varcharStudentPassword', NULL, NULL)";

		$queryAdd2 = "INSERT INTO `tbl_personalinfo` (`infoID`, `lastName`, `firstName`, `middleName`, `sex`, `sexuality`, `age`, `year`, `section`, `civilStatus`, `birthDate`, `height`, `weight`, `complexion`, `birthPlace`, `cityHouseNumber`, `cityProvince`, `cityName`, `cityBarangay`, `provinceHouseNumber`, `provinceProvincial`, `provinceName`, `provinceBarangay`, `telNumber`, `mobileNumber`, `email`, `hsGWA`, `religion`, `employerName`, `employerAddress`, `contactPersonName`, `cpAddress`, `cpRelationship`, `cpContactNumber`, `collegeCode`, `courseCode`, `studentNumber`) vALUES (NULL, '$varcharStudentFirstName', '$varcharStudentMiddleName', '$varcharStudentLastName', 'M', 'Homosexual', '19', '$varcharStudentYear', '$varcharStudentSection', 'Single', '1998-08-17', '172', '54', 'Fair', 'Pasig City', '113', 'Rizal', 'Taytay', 'San Juan', '113', 'Rizal', 'Rizal', 'San Juan', '6354478', '09086966016', 'jaywelj@gmail.com', '92.5', 'Catholic', 'None', 'None', 'None', 'None', 'Tito', '090817271', '$varcharStudentCollege', '$varcharStudentCourse', '$varcharStudentNumber')";
	} 
	else 
	{ 						//insert data to database   
		$queryAdd = "INSERT INTO `tbl_studentaccount` (`studentNumber`, `studentFirstName`, `studentMiddleName`, `studentLastName`, `studentPassword`, `aboutStudent`,`studentDisplayPic`) vALUES ('$varcharStudentNumber', '$varcharStudentFirstName', '$varcharStudentMiddleName', '$varcharStudentLastName', '$varcharStudentPassword', NULL, '$varcharStudentImage')";

		$queryAdd2 = "INSERT INTO `tbl_personalinfo` (`infoID`, `firstName`, `middleName`, `lastName`, `sex`, `sexuality`, `age`, `year`, `section`, `civilStatus`, `birthDate`, `height`, `weight`, `complexion`, `birthPlace`, `cityHouseNumber`, `cityProvince`, `cityName`, `cityBarangay`, `provinceHouseNumber`, `provinceProvincial`, `provinceName`, `provinceBarangay`, `telNumber`, `mobileNumber`, `email`, `hsGWA`, `religion`, `employerName`, `employerAddress`, `contactPersonName`, `cpAddress`, `cpRelationship`, `cpContactNumber`, `collegeCode`, `courseCode`, `studentNumber`) vALUES (NULL, 'Javier', 'Jaywel', 'Bisarra', 'M', 'Bisexual', '25', '$varcharStudentYear', '$varcharStudentSection', 'Single', '1993-03-10', '172', '54', 'Fair', 'Pasig City', '113', 'Olongapo', 'Olongapo', 'San Juan', '113', 'Rizal', 'Rizal', 'San Juan', '6354478', '09086966016', 'jaywelj@gmail.com', '92.5', 'Catholic', 'None', 'None', 'None', 'None', 'Tito', '090817271', '$varcharStudentCollege', '$varcharStudentCourse', '$varcharStudentNumber')";
	}

												
	if(mysqli_query($connect, $queryAdd))
	{   
		if(mysqli_query($connect, $queryAdd2))
		{
			$message = "Student Account added successfully!";
			echo "<script type='text/javascript'>alert('$message');</script>";
															//redirectig to the display page. In our case, it is index.php
			echo "<script type='text/javascript'>location.href = 'manageAccountStudentAccount.php';</script>";
		}
	}
	else
	{
		$query = "SELECT * FROM tbl_studentaccount WHERE studentNumber='$varcharStudentNumber' ";
		$result = mysqli_query($connect, $query);

		if (mysqli_num_rows($result) == 1) {

			$message = "Student Number Already Registered";
			echo "<script type='text/javascript'>alert('$message');</script>";





			$message = "Query Error";
			
			echo "<script type='text/javascript'>alert('$message');</script>";
														//redirectig to the display page. In our case, it is index.php
			echo "<script type='text/javascript'>location.href = 'manageAccountStudent.php';</script>";
		}
	}
	
}
if(isset($_POST['btnUpdate']))
{
	include_once("connectionString.php");

	$varcharStudentNumber	= mysqli_real_escape_string($connect, $_POST['txtbxEditStudentNumber']);

	$varcharStudentFirstName = mysqli_real_escape_string($connect, $_POST['txtbxEditStudentFirstName']);

	$varcharStudentMiddleName = mysqli_real_escape_string($connect, $_POST['txtbxEditStudentMiddleName']);

	$varcharStudentLastName = mysqli_real_escape_string($connect, $_POST['txtbxEditStudentLastName']);

	$varcharStudentCourse = mysqli_real_escape_string($connect, $_POST['optionStudentCourse']);
		
	$varcharStudentYear = mysqli_real_escape_string($connect, $_POST['txtbxEditStudentYear']);

	$varcharStudentSection = mysqli_real_escape_string($connect, $_POST['txtbxEditStudentSection']);

	$varcharStudentGender = mysqli_real_escape_string($connect, $_POST['optionEditStudentGender']);

	$varcharStudentBirthdate = mysqli_real_escape_string($connect, $_POST['dateEditStudentBirthdate']);

	$varcharStudentContactNo = mysqli_real_escape_string($connect, $_POST['txtbxEditStudentContactNo']);

	$varcharStudentEmail = mysqli_real_escape_string($connect, $_POST['txtbxEditStudentEmail']);

	
	if(!empty($_FILES['fileEditStudentImage']['tmp_name']) && file_exists($_FILES['fileEditStudentImage']['tmp_name'])) 
	{
		$varcharStudentImage = addslashes(file_get_contents($_FILES["fileEditStudentImage"]["tmp_name"]));
	}
	else
	{
		$varcharStudentImage = "";
	}
	// checking empty fields
	if(empty($varcharStudentFirstName)) 
	{

		if(empty($varcharStudentFirstName))
		{
			$message = "Enter a First Name";
			echo "<script type='text/javascript'>alert('$message');</script>";
		}
		//link to the previous page
		echo "<br/><a href='javascript:self.history.back();'>Go Back</a>";
	} 
	else 
	{ 
		// if all the fields are filled (not empty) 
		//insert data to database   
		if (!empty($varcharStudentImage)) 
		{
			$queryEdit = "
			UPDATE `tbl_studentaccount` AS A
			INNER JOIN tbl_personalinfo AS B 
			ON A.studentNumber = B.studentNumber 
			SET `firstName` = '$varcharStudentFirstName', `middleName` = '$varcharStudentMiddleName', `lastName` = '$varcharStudentLastName', courseCode = '$varcharStudentCourse', year = '$varcharStudentYear', section = '$varcharStudentSection', `birthDate` = '$varcharStudentBirthdate', `sex` = '$varcharStudentGender', `cpContactNumber` = '$varcharStudentContactNo', `studentDisplayPic` = '$varcharStudentImage' 
			WHERE A.studentNumber = '$varcharStudentNumber'";
			$message = "0";
			echo "<script type='text/javascript'>alert('$message');</script>";
		}
		else
		{
			$queryEdit = "
			UPDATE `tbl_studentaccount` AS A
			INNER JOIN tbl_personalinfo AS B 
			ON A.studentNumber = B.studentNumber 
			SET `firstName` = '$varcharStudentFirstName', `middleName` = '$varcharStudentMiddleName', `lastName` = '$varcharStudentLastName', courseCode = '$varcharStudentCourse', year = '$varcharStudentYear', section = '$varcharStudentSection', `birthDate` = '$varcharStudentBirthdate', `sex` = '$varcharStudentGender', `cpContactNumber` = '$varcharStudentContactNo'
			WHERE A.studentNumber = '$varcharStudentNumber'";
			$message = "1";
			echo "<script type='text/javascript'>alert('$message');</script>";
		}
		if(!mysqli_query($connect, $queryEdit))
		{
			$message = "Query Error" ;
			echo "<script type='text/javascript'>alert('$message');</script>";
			echo("Error description: " . mysqli_error($connect));
		}
		else
		{
			$message = "Student Account Updated Successfully!";
			echo "<script type='text/javascript'>alert('$message');</script>";
			//redirectig to the display page. In our case, it is index.php
			echo "<script type='text/javascript'>location.href = 'manageAccountStudentAccount.php';</script>";	
		}
	}
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<!-- Meta, title, CSS, favicons, etc. -->
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<title>DataTables | Gentelella</title>

	<!-- Bootstrap -->
	<link href="../vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
	<!-- Font Awesome -->
	<link href="../vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
	<!-- NProgress -->
	<link href="../vendors/nprogress/nprogress.css" rel="stylesheet">
	<!-- iCheck -->
	<link href="../vendors/iCheck/skins/flat/green.css" rel="stylesheet">
	<!-- Datatables -->
	<link href="../vendors/datatables.net-bs/css/dataTables.bootstrap.min.css" rel="stylesheet">
	<link href="../vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min.css" rel="stylesheet">
	<link href="../vendors/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css" rel="stylesheet">
	<link href="../vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css" rel="stylesheet">
	<link href="../vendors/datatables.net-scroller-bs/css/scroller.bootstrap.min.css" rel="stylesheet">

	<!-- Custom Theme Style -->
	<link href="../build/css/custom.min.css" rel="stylesheet">
</head>
<?php
require 'header.php';
?>
<body class="nav-md">
	<div class="container body" id="div1">
		<div class="main_container">
			<!-- side navigation -->
			<?php 
			require 'sidebar.php';
			?>
			<!-- /side navigation -->
			<!-- top navigation -->
			<?php 
			require 'navbar.php';
			?>
			<!-- /top navigation -->

			<!-- page content -->
			<div class="right_col" role="main">
				<div class="">
					<div class="page-title">
						<div class="title_left">
							<h3>Manage Archived Student Accounts<small></small></h3>
						</div>

						<div class="title_right">
							<div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
								<div class="input-group">
									<input type="text" class="form-control" placeholder="Search for...">
									<span class="input-group-btn">
										<button class="btn btn-default" type="button">Go!</button>
									</span>
								</div>
							</div>
						</div>
					</div>

					<div class="clearfix"></div>

					<div class="row">

						<div class="col-md-12 col-sm-12 col-xs-12">
							<div class="x_panel">
								<div class="x_title">
									<h2>Student Accounts <small>StudentAccounts</small></h2>
									<ul class="nav navbar-right">
										<button class="btn btn-default btn-info" data-toggle="modal" data-target="#add_data_Modal" type="button">ADD STUDENT ACCOUNT</button>
									</ul>
									<div class="clearfix"></div>
								</div>
								<div class="x_content">
									<table id="datatable-buttons" class="table table-striped table-bordered">

										<thead>
											<tr>
												<th></th>
												<th>Student Number</th>
												<th>First Name</th>
												<th>Middle Name</th>
												<th>Last Name</th>
												<th>Image</th>
											</tr>
										</thead>


										<tbody>
											<?php  
											include("connectionString.php");  
											$queryStudent = "SELECT * FROM tbl_studentaccountarchive ORDER BY tbl_studentaccountarchive.studentNumber DESC";
											$resultStudent = mysqli_query($connect, $queryStudent); 

											$queryPersonalInfo = "SELECT * FROM tbl_personalinfoarchive ORDER BY tbl_personalinfoarchive.studentNumber DESC";
											$resultPersonalInfo = mysqli_query($connect, $queryPersonalInfo);
											while($row = mysqli_fetch_array($resultStudent) AND $res = mysqli_fetch_array($resultPersonalInfo))   
												{
  
											 
																								 	# code...
												  
												?>  
												<tr>
													<td width="14%" >
														<center>

															<a title="Revive" class="btn btn-info" href="manageAccountStudentAccountReturn.php?id=<?php echo$row['studentNumber']; ?>" onClick="return confirm('Are you sure you want to return?')"><span class="fa fa-share-square"></span></a>

															<a title="Delete" class="btn btn-danger" title="Delete" href="manageAccountStudentAccountArchivedDelete.php?id=<?php echo $row['studentNumber']; ?>" onClick="return confirm('Are you sure you want to delete?')"><span class="glyphicon glyphicon-trash"></span></a>

														</center>
													</td>
													<td> <?php echo $row['studentNumber'];?> </td>
													<td> <?php echo $res['firstName'];?> </td>
													<td> <?php echo $res['middleName'];?> </td>
													<td> <?php echo $res['lastName'];?> </td>
													<td> 
														<center>	
															<?php


															$VarcharStudentProfileImage = $res['studentDisplayPic'];
															if(empty($VarcharStudentProfileImage))
															{
																echo '
																<img src="assets/img/default-user.png" height="200" width="200" style="object-fit:cover;">
																';
															}
															else{
																echo '<img src="data:image/jpeg;base64,'.base64_encode($res['studentDisplayPic'] ).'" height="200" width="200" style="object-fit:cover;" />';
															}

															?>
														</td>
														</center>
													</tr>  
													<?php
												}
											
												?> 
											</tbody>
											<tfoot>
											<tr>
												<th></th>
												<th>Student Number</th>
												<th>First Name</th>
												<th>Middle Name</th>
												<th>Last Name</th>
												<th>Image</th>
											</tr>
										</tfoot>
										</table>
									</div>
								</div>
							</div>
							<!--Other Tables othertables/-->
						</div>
					</div>
				</div>
				<!-- /page content -->
				<!--Modal view-->
				<form method="post" enctype="multipart/form-data">
					<div id="view_data_Modal" class="modal fade">
						<div class="modal-dialog">
							<div class="modal-content">
								<div class="modal-header" style="background: #800; color:#fff; margin-right: -1px;">
									<button type="button" class="close" data-dismiss="modal" style="color: #fff" >&times;</button>
									<h4 class="modal-title text-center">STUDENT ACCOUNT DETAILS</h4>
								</div>
								<div class="modal-body" id="studentAccountDetails"    style=" padding: 5px 50px 5px 50px;">

								</div>
								<div class="modal-footer">
									<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
								</div>
							</div>
						</div>
					</div>
				</form>
				<!--/Modal view-->
				<!--Modal Edit-->
				<form method="post" enctype="multipart/form-data">
					<div id="edit_data_Modal" class="modal fade">
						<div class="modal-dialog">
							<div class="modal-content">
								<div class="modal-header" style="background: #800; color:#fff; margin-right: -1px;">
									<button type="button" class="close" data-dismiss="modal" style="color: #fff" >&times;</button>
									<h4 class="modal-title text-center">EDIT STUDENT ACCOUNT DETAILS</h4>
								</div>
								<div class="modal-body" id="editStudentAccountDetails"    style=" padding: 25px 50px 5px 50px;">

								</div>
								<div class="modal-footer">
									<input type="submit" name="btnUpdate" id="btnUpdate" value="Update" class="btn btn-success"/>
									<button type="button" class="btn btn-danger  pull-right" data-dismiss="modal">Close</button>
								</div>
							</div>
						</div>
					</div>
				</form>
				<!--/Modal Edit-->
				<!--Modal Add-->
				<form method="post" enctype="multipart/form-data">
					<div id="add_data_Modal" class="modal fade">
						<div class="modal-dialog">
							<div class="modal-content">
								<div class="modal-header" style="background: #800; color:#fff; margin-right: -1px;">
									<button type="button" class="close" data-dismiss="modal" style="color: #fff" >&times;</button>
									<h4 class="modal-title text-center">ADD NEW ACCOUNT</h4>
								</div>
								<div class="modal-body" style=" padding: 25px 50px 5px 50px;">
									<label>Student Number</label>
									<input type="text" name="txtbxStudentNumber" id="txtbxStudentNumber" class="form-control" />
									<br />
									<label>First Name</label>
									<input type="text" name="txtbxStudentFirstName" id="txtbxStudentFirstName" class="form-control" />
									<br />
									<label>Middle Name</label>
									<input type="text" name="txtbxStudentMiddleName" id="txtbxStudentMiddleName" class="form-control" />
									<br />
									<label>Last Name</label>
									<input type="text" name="txtbxStudentLastName" id="txtbxStudentLastName" class="form-control" />
									<br />
									<?php

								// php select option value from database
									include("connectionString.php");

								// mysql select query
									$queryCourse2 = "SELECT * FROM tbl_course";

								// for method 1/
									$resultCourse2 = mysqli_query($connect, $queryCourse2);

									?>
									<label>Course</label>
									<select name="selectStudentCourse" id="selectStudentCourse" class="form-control">
										<option value="NULL" selected>Select A Course</option>
										<?php while($row = mysqli_fetch_array($resultCourse2)):;?>
											<option value="<?php echo $row[0];?>"><?php echo $row[0];?> - <?php echo $row[1];?></option>
										<?php endwhile;?>
									</select>
									<br />
									<label>Year</label>
									<input type="number" name="txtbxStudentYear" id="txtbxStudentYear" class="form-control" />
									<br />
									<label>Section</label>
									<input type="number" name="txtbxStudentSection" id="txtbxStudentSection" class="form-control" />
									<br />
									<label>Password</label>
									<input type="password" name="txtbxStudentPassword" id="txtbxStudentPassword" class="form-control" />
									<br />
									<label>Image</label>
									<input type="file" name="fileStudentImage" id="fileStudentImage" class="form-control" />
									<br />
								</div>
								<div class="modal-footer">
									<input type="submit" name="btnAdd" id="btnAdd" value="Add Account" class="btn btn-success " />
									<button type="button" class="btn btn-danger  pull-right" data-dismiss="modal">Close</button> 
								</div>
							</div>
						</div>
					</div>
				</form>
				<!--/Modal Edit-->

				<!-- footer content -->
				<footer>
					<div class="pull-right">
						Gentelella - Bootstrap Admin Template by <a href="https://colorlib.com">Colorlib</a>
					</div>
					<div class="clearfix"></div>
				</footer>
				<!-- /footer content -->
			</div>
		</div>

		<!-- jQuery -->
		<script src="../vendors/jquery/dist/jquery.min.js"></script>
		<!-- Bootstrap -->
		<script src="../vendors/bootstrap/dist/js/bootstrap.min.js"></script>
		<!-- FastClick -->
		<script src="../vendors/fastclick/lib/fastclick.js"></script>
		<!-- NProgress -->
		<script src="../vendors/nprogress/nprogress.js"></script>
		<!-- iCheck -->
		<script src="../vendors/iCheck/icheck.min.js"></script>
		<!-- Datatables -->
		<script src="../vendors/datatables.net/js/jquery.dataTables.min.js"></script>
		<script src="../vendors/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
		<script src="../vendors/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
		<script src="../vendors/datatables.net-buttons-bs/js/buttons.bootstrap.min.js"></script>
		<script src="../vendors/datatables.net-buttons/js/buttons.flash.min.js"></script>
		<script src="../vendors/datatables.net-buttons/js/buttons.html5.min.js"></script>
		<script src="../vendors/datatables.net-buttons/js/buttons.print.min.js"></script>
		<script src="../vendors/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js"></script>
		<script src="../vendors/datatables.net-keytable/js/dataTables.keyTable.min.js"></script>
		<script src="../vendors/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
		<script src="../vendors/datatables.net-responsive-bs/js/responsive.bootstrap.js"></script>
		<script src="../vendors/datatables.net-scroller/js/dataTables.scroller.min.js"></script>
		<script src="../vendors/jszip/dist/jszip.min.js"></script>
		<script src="../vendors/pdfmake/build/pdfmake.min.js"></script>
		<script src="../vendors/pdfmake/build/vfs_fonts.js"></script>

		<!-- Custom Theme Scripts -->
		<script src="../build/js/custom.min.js"></script>

		<script>
			$(document).ready(function(){
				$(document).on('click','.btn-view',function(){
					var studentNumber = $(this).attr("id");
					$.ajax({
						url:"viewStudentAccountDetails.php",
						method:"post",
						data:{studentNumber:studentNumber},
						success:function(data){
							$('#studentAccountDetails').html(data);
							$('#view_data_Modal').modal('show');
						}
					});
				});
				$(document).on('click','.btn-edit',function(){
					var studentNumber = $(this).attr("id");
					$.ajax({
						url:"editStudentAccountDetails.php",
						method:"post",
						data:{studentNumber:studentNumber},
						success:function(data){
							$('#editStudentAccountDetails').html(data);
							$('#edit_data_Modal').modal('show');
						}
					});
				});
			});
		</script>

	</body>
	</html>