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
$uname=$_SESSION['sess_username'];
$query3=mysqli_query($con,"SELECT `search_word` from `search` where userid='$uname'");
$query4=mysqli_fetch_array($query3,MYSQLI_ASSOC);
$s_value=$query4['search_word'];
$b=$s_value;

?>

<!DOCTYPE html>
<html>
<head lang="en">
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<link href="http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800" rel="stylesheet" type="text/css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
	<title>SVN UTILITY-Search result</title>
    <link href="img/favicon.ico" type="image" rel="icon">
	<link rel="stylesheet" href="style/s_result.css"/>
	<link rel="stylesheet" href="style/drop.css"/>
	<link rel="stylesheet" href="style/drop2.css"/>
	<script src="js/drop.js"></script>
	<script src="js/drop2.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <!-- Optional theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
	<link href="https://fonts.googleapis.com/css?family=Titan+One|Ubuntu+Condensed" rel="stylesheet">
	<style>
		body {
		background: url("img/bg.jpg") no-repeat center center fixed;
			background-color: white;
			-webkit-background-size: cover;
			-moz-background-size: cover;
			-o-background-size: cover;
			background-size: cover;
			}
	</style>

</head>
<body data-spy="scroll" data-offset="0" data-target="#my-navbar">

	<div class="top">
    
		<div id="head">
	
			<div id="mySidenav" class="sidenav">
				  <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">X</a>
				  <a href="admin.php">Dashboard</a>
				  <a href="search.php">Search</a>
 <!--<a href="help.html">Help</a>
  <a href="about.html">About</a>-->
			</div>

			<span style="font-size:30px;cursor:pointer;position:absolute;left:0;padding-left: 10px;padding-top:10px;text-align:right;" class="oop" onclick="openNav()">&#9776;</span>

			<div class="wrap">
				<div class="search">
					<input type="text" class="searchTerm" value= <?php echo $s_value;  ?>>
					<div class="ver">
						<!--<button type="submit" class="searchButton">
							<i class="fa fa-search"></i>
						</button>-->
					</div>
				</div>
			</div>

	
		<div class="dropdown" style="font-size:10px;">
				<button><label><?php echo $_SESSION['sess_username'];?> - <?php echo $_SESSION['sess_userrole'];?></label></button>
	  <ul id="dropdown-list">
		
				<li><a href="password.php">Account Settings</a></li>
				<li><a href="signout.php">Sign Out</a></li>
			</ul>
		</div></br>
		<div class="he2">Search</div>
			<div class="main">
				<div class="tab-wrap">
  
					<input type="radio" name="tabs" id="tab1" checked>
						<div class="tab-label-content" id="tab1-content">
							<label for="tab1">Doc</label>
								<div class="tab-content">
									<?php
	$directory = 'f:/AA';
	$it = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($directory));
	while($it->valid()) 
	{
		if (!$it->isDot()) 
		{	$fname=basename($it->getSubPathName() );
			if(stristr($fname, $s_value) !== FALSE) 
			{	
			if(stristr($it->getSubPathName(), ".svn") === FALSE) 
			{
				$ext = pathinfo($fname, PATHINFO_EXTENSION);
				if($ext =="txt")
				{
									?>
				<div class="card">
				<div class="container">
				<img src="img/file.png" width="40px" height="35px"><?php
				//echo exec("svn list -R $directory | findstr $s_value.txt");
				echo 'Name:     ' .$fname. "<br><br>";
				echo 'Key:         ' . $it->key() . "<br><br>";
				?>	</div>
					</div><?php
					}
				}
			}
		}
		$it->next();
	}
?>
								</div>
						</div>
     
						<input type="radio" name="tabs" id="tab2">
						<div class="tab-label-content" id="tab2-content">
							<label for="tab2">Code</label>
							<div class="tab-content"> 
								<?php
	$directory = 'f:/AA/';
	$it = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($directory));
	while($it->valid()) 
	{
		if (!$it->isDot()) 
		{	$fname=basename($it->getSubPathName() );
			if(stristr($fname, $b) !== FALSE) 
			{	if(stristr($it->getSubPathName(), ".svn") === FALSE) 
			{
				$ext = pathinfo($fname, PATHINFO_EXTENSION);
				if($ext =="code")
				{
				?>
				
 				<a href="#r_a" data-toggle="tab" class="smoothScroll"><div class="card"></a>
				<div class="container">
				<img src="img/file.png" width="40px" height="35px"><?php
				echo 'Name:     ' .$fname. "<br><br>";
				echo 'Key:         ' . $it->key() . "<br><br>";
				?>	</div>
					</div><?php
					}
				}
			}
		}
		$it->next();
	}
?>
							</div>
						</div>
						<div class="slide">
						</div>
  
				</div>
			</div>

		</div>
	

	</div>
	<div class="right">
		<div id="act"><h3>Recent Activity</h3>
		<form method="POST" action="">
		<input type="text" name="rec" id="rec" placeholder="Enter the path">
		<input class="recb" type="submit" name="recb" value="Submit">
		</form>
		<div style="color=black">
<?php
			
		$cmd1="svn log file:///c:/new/v1.0";
		$cmd1=$cmd1.$fname;
exec(escapeshellcmd($cmd1), $output, $status);

foreach ($output as $value) {
    echo $value."<br>";
}

?>
		</div>
		</div>
	</div>






	
	
	
	
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
	<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">

	<link href='https://fonts.googleapis.com/css?family=Roboto:400,500,300,700' rel='stylesheet' type='text/css'>
	<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <script src="smoothscroll.js"></script>
    <!-- Latest compiled and minified JavaScript -->
	<script src="http://code.jquery.com/jquery-1.11.3.min.js"></script> 
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

</body>
</html>
