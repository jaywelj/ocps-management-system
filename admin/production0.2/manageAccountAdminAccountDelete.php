 <?php
//including the database connection file
include("connectionString.php");

//getting id of the data from url
$adminUserName = $_GET['id'];
//deleting the row from table
//$query ="DELETE FROM tbl_destination WHERE destination_ID=$id";
//Clearing Tour Package dependencies 



$querymovingtoarchive = "INSERT INTO tbl_adminaccountarchive select * from tbl_adminaccount where adminUserName = '$adminUserName'";
$querydeleting = "DELETE FROM `tbl_adminaccount` WHERE `tbl_adminaccount`.`adminUserName` = '$adminUserName'";

if ($resultmovingtoarchive = mysqli_query($connect, $querymovingtoarchive))
{
  if ($resultdeleting = mysqli_query($connect, $querydeleting))
    {
    header("Location:manageAccountStaffAccount.php");
    }
    else{
    $message = "Error Deleting";
    echo "<script type='text/javascript'>alert('$message');</script>";
    header("Location:manageAccounAdminAccount.php");
    }
    
}
else{
  $message = "Error Moving";
    echo "<script type='text/javascript'>alert('$message');</script>";
    header("Location:manageAccountAdminAccount.php");
}
 
//redirecting to the display page (index.php in our case)

?>

