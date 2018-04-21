<?php  
session_start();
    $role = $_SESSION['sess_userrole'];
	 
    if(!isset($_SESSION['sess_username']) || $role!="Admin" ){
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
 if(isset($_POST['submit']))
{ 
$vername = $_POST['ver'];
 $lpath = $_POST['lpath'];
 $spath = $_POST['spath'];
$lpath= str_replace('\\\\', '/', $lpath);
$spath= str_replace('\\\\', '/', $spath);
echo $lpath;


  $query = "INSERT INTO vtable(vername,spath,lpath) VALUES('$vername','$spath','$lpath')";
 
 mysqli_query($con,$query);
  
 
 $con->close();
  
$ver = $_POST['ver'];
$lpath = $_POST['lpath'];
$spath = $_POST['spath'];



$vname="\\".$ver;
$svnpath= $spath;
$serverpath=$svnpath.$vname;
$localpath=$lpath.$vname."wcopy"."\\";
mkdir("$serverpath", 0777, true);
//exec("mkdir $serverpath");
exec("svnadmin create $serverpath");
exec("mkdir $localpath");
exec("chmod 777 $localpath");
$serverpath1= str_replace('\\', '/', $serverpath);
$serverpath1= "file:///".$serverpath1;

exec("svn checkout $serverpath1 $localpath");

$use1=$localpath."trunk";
$use1=str_replace('/', '\\', $use1);
exec("mkdir $use1");
}
?>

<!DOCTYPE html>
<html lang="en" class="no-js">
	<head>
		<meta charset="UTF-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge"> 
		<meta name="viewport" content="width=device-width, initial-scale=1"> 
		<title>SVN Utility-Settings</title>
		<meta name="keywords" content="custom select, select style, javascript, inspiration, select element" />
		<link rel="shortcut icon" href="img/favicon.ico">
		<link href='http://fonts.googleapis.com/css?family=Raleway:400,300,700' rel='stylesheet' type='text/css'>
		<link rel="stylesheet" type="text/css" href="style/sett.css" />
		<link rel="stylesheet" href="style/drop.css"/>
		<link rel="stylesheet" href="style/drop2.css"/>
		<script src="js/drop.js"></script>
		<script src="js/drop2.js"></script>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
		<script src="sweet/dist/sweetalert.min.js"></script> <link rel="stylesheet" type="text/css" href="sweet/dist/sweetalert.css">
		<style>
				body{
				background: url("img/bg.jpg") no-repeat center center fixed;
					background-color: #ECEFF1;
					-webkit-background-size: cover;
					-moz-background-size: cover;
					-o-background-size: cover;
					background-size: cover;
					}
				
				#head {
					height: 65px;
					width: 100%;
					background-color: #541313;
					float:top;
					box-shadow: 0px 3px 10px #888888;
					position: absolute;
					right: 0;
					top: 0;
					} 

		</style>
	</head>
	
	<body >
		<div id="head">
			<div id="mySidenav" class="sidenav">
				<a href="javascript:void(0)" class="closebtn" onclick="closeNav()">X</a>
				<a href="admin.php">Dashboard</a>
				<a href="search.php">Search</a>
				<a href="deploy.php">Deploy</a>
				<a href="#">Settings</a>
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
			<div class="he">
				<h1>Settings</h1>
			</div>
	
			<div class="card">
	
				<div class="container">
					<form action="" method="POST">
					<div class="row">
						<h2><strong>New Version</strong></h2>
	  
						<div class="input-group input-group-icon">
							<input type="text" placeholder="New Version Name" id="ver" name="ver"/>
						</div>
						<div class="input-group input-group-icon">
			 
							<input type="text" placeholder="Server Path" id="spath" name="spath"/>
						</div>
						<div class="input-group input-group-icon">
							<input type="text" placeholder="Local Path" id="lpath" name="lpath"/>
						</div>
						
					</div>

					<div width="100%">
						<div class="add">



							<button type="submit" name="submit" class="cal" onclick="myFunction()">&#10010;</button>
						</div>
					</div>
					</form>
				</div>
			</div>
			<div class="ca">
				<a href="uac.php">
				<div class="cd">
					<img src="img/u1.jpg" alt="Avatar" style="width:100%">
					<div class="container1">
						<h4><b>User Access Control</b></h4> 
					</div>
				</div></a>
				<a href="svncred.html">
				<div class="cd">
					<img src="img/svn.jpg" alt="Avatar" style="width:100%">
					<div class="container1">
						<h4><b>SVN Credentials</b></h4> 
					</div>
				</div></a>
			</div>
		</div>
			
<!--<footer id="myFooter" style="position:relative;bottom:0;width:100%;height:60px; background:#541313; "><h3 style=" color: white;   text-align:left; font-size: 15px;  padding-left: 10px;"><font face="verdana">© 2017 SVN UTILITY. All Rights Reserved.</font></h3></footer>-->


		<script src="js/classie.js"></script>
		<script src="js/selectFx.js"></script>
		<script>
function myFunction() {
    alert("Done! New version is added");
}
</script>
		<script>
			(function() {
				[].slice.call( document.querySelectorAll( 'select.cs-select' ) ).forEach( function(el) {	
					new SelectFx(el);
				} );
			})();
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


	<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <script src="smoothscroll.js"></script>
    <!-- Latest compiled and minified JavaScript -->
	<script src="http://code.jquery.com/jquery-1.11.3.min.js"></script> 
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

	</body>
</html>