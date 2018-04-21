<?php
session_start();
    $role = $_SESSION['sess_userrole'];
	 
    if(!isset($_SESSION['sess_username']) || $role!="Admin"){
      header('Location: index.php?err=2');
    }
	 
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
if(isset($_POST['submit'])) {
 
 $userid = strip_tags($_POST['userid']);
 $name = strip_tags($_POST['name']);
 $role = strip_tags($_POST['role']);
 $username = strip_tags($_POST['username']);
 $password = strip_tags($_POST['password']);
 
 $userid = $con->real_escape_string($userid);
 $name = $con->real_escape_string($name);
 $role = $con->real_escape_string($role);
 $username = $con->real_escape_string($username);
 $password = $con->real_escape_string($password);
 
 
 
 $check_username = $con->query("SELECT username FROM user_detail WHERE username='$username'");
 $count=$check_username->num_rows;
 
 if ($count==0) {
  
  $query = "INSERT INTO user_detail(userid,name,role,username,password) VALUES('$userid','$name','$role','$username','$password')";

  if ($con->query($query)) {
   echo "<script>
      alert('successfully registered !');
     </script>";
  }else {
   echo "<script>
      alert('unsuccessfull !');
     </script>";
  }
  
 } else {
  
  
  echo "<script>
      alert('alredy existing');
     </script>";
   
 }
 
 $con->close();
}
   
?>


<!DOCTYPE html>
<html >
<head>
  <meta charset="UTF-8">
  <title>SVN Utility-UAC</title>
      <link href="img/favicon.ico" type="image" rel="icon">
	<link rel="stylesheet" href="style/uac.css"/>
	<link rel="stylesheet" href="style/drop.css"/>
	<link rel="stylesheet" href="style/drop2.css"/>
	<script src="js/drop.js"></script>
	<script src="js/drop2.js"></script>
  	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">

  <link rel='stylesheet prefetch' href='http://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css'>
	<link href="https://fonts.googleapis.com/css?family=Anaheim" rel="stylesheet">

  <style>
  
  body {
  background: url("img/bg.jpg") no-repeat center center fixed;
  background-color: #ECEFF1;
		-webkit-background-size: cover;
		-moz-background-size: cover;
		-o-background-size: cover;
		background-size: cover;
}
#customers {
    font-family: 'Anaheim', sans-serif;
    border-collapse: collapse;
    width: 100%;
}

#customers td, #customers th {
    border: 1px solid #ddd;
    padding: 8px;
    color: black;
}

#customers tr:nth-child(even){background-color: #f2f2f2;}

#customers tr:hover {background-color: #ddd;}

#customers th {
    padding-top: 12px;
    padding-bottom: 12px;
    text-align: left;
    background-color: #546E7A;
    color: white;
}
</style>
</head>

<body>
<div id="head">
	<div id="mySidenav" class="sidenav">
  <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">X</a>
  <a href="admin.php">Dashboard</a>
  <a href="search.php">Search</a>
  <a href="deploy.php">Deploy</a>
  <a href="settings.php">Settings</a>
 <!--<a href="help.html">Help</a>
  <a href="about.html">About</a>-->
</div>

<span style="font-size:30px;cursor:pointer;position:absolute;left:0;padding-left: 10px;padding-top:10px;text-align:right;" class="oop" onclick="openNav()">&#9776;</span>
	
	
	

	<div class="dropdown">

	 <button><?php echo $_SESSION['sess_name']  ;?> <label>  (<?php echo $_SESSION['sess_username'];?>)</label> <label> - <?php echo $_SESSION['sess_userrole'];?></label></button>

	  <ul id="dropdown-list">

		<li><a href="password.php">Account Settings</a></li>
		<li><a href="signout.php">Sign Out</a></li>
	  </ul>
	</div>
	</div>
	
	
		<div class="out">
	
	<div class="card">
	
	 <div class="container">
  <form action="uac.php" method="POST">
    <div class="row">
      <center><h1>User Access Control</h1></center>

      <div class="input-group">
        <input type="text" placeholder="User Id" name="userid" required="required"/>
      </div>
      <div class="input-group">
        <input type="text" placeholder="Name" name="name"  required="required"/>
      </div>              
      <div class="input-group">
        <input type="text" placeholder="User Name" name="username"  required="required"/>
      </div>
      <div class="input-group">
        <input type="password" placeholder="Password" name="password"  required="required"/>
      </div>
    </div>
<div>
       
        <div class="input-group">
		<div class="see">
          <select style="border-radius:0px;" name="role" required="required" >
			<option>Select Designation..</option>
			<option>Admin</option>
            <option>Business Analyst</option>
            <option>Developer</option>
            <option>Release Team</option>
          </select>
		  </div>
		  <div class="see">
          <button class="buttonsubmit" name="submit" type="submit" value="Insert"><strong>Submit</strong></button></div>
    </div>
	</div>
    

     </form>
	 <div class="li"><a href="uac/search.php">VIEW EMPLOYEE  DETAILS</a></div>
    </div>
  	</div>
	
	
	
	</div>

<p></p>


	<script>
	 var Dropdown = (function($) {

          var $body = $('body'),
            $dropdown = $body.find('.dropdown'),
            $trigger = $dropdown.find('button'),
            $list = $dropdown.find('ul'),
            $firstLink = $list.find('li:first a'),
            $lastLink = $list.find('li:last a');

          var init = function() {
            ariaSetup();
            bindEvents();
          }

          var ariaSetup = function() {
            var listId = $list.attr('id');

            $trigger.attr({
              'aria-expanded': 'false',
              'aria-controls': listId
            });

            $list.attr({
              'aria-hidden': true
            });
          }

          var bindEvents = function() {
            $trigger.on('click', toggleDropdown);

            $firstLink.on('keydown', function() {
              if (event.which === 9 && event.shiftKey === false) {
                return;
              } else if (event.which === 9 && event.shiftKey === true) {
                toggleDropdown();
              }
            });

            $lastLink.on('keydown', function() {
              if (event.shiftKey) return;
              toggleDropdown();
            });
          }

          var toggleDropdown = function() {
            var hidden = $list.attr('aria-hidden') === 'true' ? false : true,
              expanded = !hidden;

            $trigger.attr('aria-expanded', expanded);
            $list.attr('aria-hidden', hidden);
          }

          return {
            init: init
          }

        })(jQuery);

        Dropdown.init();
		
		
var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-36251023-1']);
  _gaq.push(['_setDomainName', 'jqueryscript.net']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();
</script>
  <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
  	<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <script src="smoothscroll.js"></script>
    <!-- Latest compiled and minified JavaScript -->
	<script src="http://code.jquery.com/jquery-1.11.3.min.js"></script> 

    
</body>
</html>
