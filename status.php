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

$query1=mysqli_query($con,"SELECT version from ver");


$query2=mysqli_fetch_array( $query1,MYSQLI_ASSOC);


$ver_name=$query2['version'];
?>


<!DOCTYPE html>
<html >
<head>
  <meta charset="UTF-8">
  <title>SVN Utility-Status</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
  <link rel='stylesheet prefetch' href='http://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css'>
  <link href="https://fonts.googleapis.com/css?family=Anaheim" rel="stylesheet">
  <link rel="stylesheet" href="style/status.css">
  <link rel="stylesheet" href="style/table.css">
  <style>
  
	  body {
	  background: url("img/bg.jpg") no-repeat center center fixed;
		background-color: #ECEFF1;
		-webkit-background-size: cover;
		-moz-background-size: cover;
		-o-background-size: cover;
		background-size: cover;
		}
	</style>
</head>

<body>
	<div class="container">
		<div class="row">
			<h2><strong>Deployment Status</strong></h2>
			<div id="demo">
				  
				  <!-- Responsive table starts here -->
				  <!-- For correct display on small screens you must add 'data-title' to each 'td' in your table -->
				  <div class="table-responsive-vertical shadow-z-1">
				  <!-- Table starts here -->
				  <table id="table" class="table table-hover table-mc-light-blue">
					  <thead>
						<tr>
						  <th><h3><strong>File name</strong></h3></th>
						  <th><h3><strong>Path</strong></h3></th>
						  </tr>
					  </thead>
					  <tbody>
						<?php
						$f_path="f:/AA/".$ver_name."wcopy/trunk";
						$directory =$f_path;
						$it = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($directory));

						while($it->valid()) {

						   if (!$it->isDot())
							{	$fname=basename($it->getSubPathName() );
								if(stristr($it->getSubPathName(), ".svn") === FALSE) 
								{								
								if(stristr($it->getSubPathName(), $ver_name) === FALSE) 	
								{	
								
								echo"<tr><td data-title=File_Name>".$fname."</td>";
								echo"<td data-title=Path>".$it->key() ."</td>";						  
								}
								}
							}
							$it->next();
						}
						?> 
<script>
var vername= localStorage['version_name'];

</script>
					   
					  </tbody>
					</table>
				  </div>

					</div>
					 
  

 </div>   </div>
 <p></p>

  <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>

    
</body>
</html>
