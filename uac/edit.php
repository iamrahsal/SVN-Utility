<html>
<head>
	<link rel="stylesheet" href="../style/uac.css"/>
	<link rel="stylesheet" href="ss.css"/>
		<link rel="stylesheet" href="../style/drop.css"/>
		<link rel="stylesheet" href="../style/drop2.css"/>
	<script src="../js/drop.js"></script>
		<script src="../js/drop2.js"></script>
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
if(isset($_GET['id']))
{
$id=$_GET['id'];
if(isset($_POST['submit']))
{
$userid=$_POST['userid'];
$name=$_POST['name'];
$role=$_POST['role'];
$username=$_POST['username'];
$password=$_POST['password'];
$query3=mysqli_query($con,"update user_detail set userid='$userid',name='$name', role='$role',username='$username',password='$password' where id='$id'");
if($query3)
{
header('location:search.php');
}
}
$query1=mysqli_query($con,"select * from user_detail where id='$id'");
$query2=mysqli_fetch_array($query1,MYSQL_ASSOC);
?>


<div id="head">
	<div id="mySidenav" class="sidenav">
  <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">X</a>
  <a href="../admin.php">Dashboard</a>
  <a href="../search.php">Search</a>
  <a href="../deploy.php">Deploy</a>
  <a href="../settings.php">Settings</a>
  <a href="../help.html">Help</a>
  <a href="../about.html">About</a>
</div>

<span style="font-size:30px;cursor:pointer;position:absolute;left:0;padding-left: 10px;padding-top:10px;text-align:right;" class="oop" onclick="openNav()">&#9776;</span>
	
	
	<div class="dropdown">
		
	 	  <button><?php echo $_SESSION['sess_name']  ;?> <label>  (<?php echo $_SESSION['sess_username'];?>)</label> <label> - <?php echo $_SESSION['sess_userrole'];?></label></button>
	  <!--<ul id="dropdown-list">
		<li><a href="../password.php">Account Settings</a></li>
		<li><a href="../signout.php">Sign Out</a></li>
	  </ul>-->
	</div>
</div>
		<div class="out">
	
	<div class="card">
	
	 <div class="container">
  <form action="" method="POST">
    <div class="row">
      <center><h1>Edit User Details</h1></center>
      <div class="input-group">
        <input type="text" name="userid" value="<?php echo $query2['userid']; ?>" />
      </div>
      <div class="input-group">
        <input input type="text" name="name" value="<?php echo $query2['name']; ?>" />
      </div>              
      <div class="input-group">
        <input type="text" name="username" value="<?php echo $query2['username']; ?>"/>
      </div>
      <div class="input-group">
        <input type="text" name="password" value="<?php echo $query2['password']; ?>" />
      </div>
    </div>
<div><h4>Designation</h4>
       
        <div class="input-group">
		<div class="seee">
          <select style="border-radius:0px; color: black" name="role" >
			<option value="<?php echo $query2['role'];?>"><?php echo $query2['role'];?></option>
			<option value="Admin">Admin</option>
            <option value="Business Analyst">Business Analyst</option>
            <option value="Developer">Developer</option>
            <option value="Release Team">Release Team</option>
          </select>
		  </div>
		  <div class="see">
          <button class="buttonsubmit" type="submit" name="submit" value="update" ><strong>Update</strong></button>
		</div>
    </div>
	</div>
    

     </form>
    </div>
  	</div>
	
	
	
	</div>
	


<?php
}
?>
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
	<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <script src="smoothscroll.js"></script>
    <!-- Latest compiled and minified JavaScript -->
	<script src="http://code.jquery.com/jquery-1.11.3.min.js"></script> 
</body>
</html>