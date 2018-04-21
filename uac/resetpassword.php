<?php
$myHost = "localhost"; 
$myUserName = "root";  
$myPassword = "";   
$myDataBaseName = "ifmutility"; 

$con = mysqli_connect( "$myHost", "$myUserName", "$myPassword", "$myDataBaseName" );

if( !$con ) // == null if creation of connection object failed
{ 
    // report the error to the user, then exit program
    die("connection object not created: ".mysqli_error($con));
}

if( mysqli_connect_errno() )  // returns false if no error occurred
{ 
    // report the error to the user, then exit program
    die("Connect failed: ".mysqli_connect_errno()." : ". mysqli_connect_error());
}
if(isset($_GET['id']))
{

$id=$_GET['id'];
mysqli_query($con,"update user_detail set password='$id' where userid='$id'");
header('location:search.php');
sleep(4);
}
?>
<head>
	<script src="sweet/dist/sweetalert.min.js"></script> <link rel="stylesheet" type="text/css" href="sweet/dist/sweetalert.css">
	</head>
<script>
swal({   title: "DONE!!",   text: "Password reset as same as username!",   timer: 4000,   showConfirmButton: false });


</script>