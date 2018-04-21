<?php
$myHost = "localhost"; 
$myUserName = "root";  
$myPassword = "";   
$myDataBaseName = "ifmutility"; 
//db connection
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
}//change password
    session_start();
    $uname = $_SESSION['sess_username'];
	 $role = $_SESSION['sess_userrole'];
	if(isset($_POST['re_password']))
		{
		$old_pass=$_POST['old_pass'];
		$new_pass=$_POST['new_pass'];
		$re_pass=$_POST['re_pass'];
		$result = mysqli_query($con,"select * from User_detail where username ='". $_SESSION['sess_username']."'");
		$row=mysqli_fetch_array($result,MYSQLI_ASSOC);
		$data_pwd=$row['password'];
        $userid = $row['userid']; 
		if($data_pwd==$old_pass){
		if($new_pass==$re_pass){
			$update_pwd=mysqli_query($con,"update user_detail set password='$new_pass' where username ='". $_SESSION['sess_username']."'");
			echo "<script>alert('Update Sucessfully'); window.location='password.php'</script>";
		}
		else{
			echo "<script>alert('Your new and Retype Password is not match'); window.location='password.php'</script>";
		}
		}
		else
		{
		echo "<script>alert('Your old password is wrong'); window.location='password.php'</script>";
		}}
		
	        if(isset($_POST['redirect']))
			{
    	   if( $_SESSION['sess_userrole'] == "Admin")
			{
			header('Location: admin.php');
			}
			elseif( $_SESSION['sess_userrole'] == "Business Analyst")
			{
			header('Location: ba.php');
			}
			elseif( $_SESSION['sess_userrole'] == "Developer")
			{
			header('Location: developer.php');
			}
			elseif($_SESSION['sess_userrole'] == "Release Team")
			{
			header('Location: release.php');
			}
			else
			{header('Location: index.php');
			} 
			}
	?>
 
 <!DOCTYPE html>
<html >
<head>
  <meta charset="UTF-8">
  <title>SVN UTILITY-Acc Settings</title>
  
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">

  <link rel='stylesheet prefetch' href='http://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css'>
	<link href="https://fonts.googleapis.com/css?family=Anaheim" rel="stylesheet">
      <link rel="stylesheet" href="style/password_style.css">
	  	<link rel="stylesheet" href="style/drop.css"/>

	<script src="js/drop.js"></script>


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
  	<div id="head">


	

	<div class="dropdown">

	  <button><?php echo $_SESSION['sess_name']  ;?> <label>  (<?php echo $_SESSION['sess_username'];?>)</label> <label> - <?php echo $_SESSION['sess_userrole'];?></label></button>

	  <ul id="dropdown-list">

		<li><a href="password.php">Account Settings</a></li>
		<li><a href="signout.php">Sign Out</a></li>
	  </ul>
	</div>
	</div>
<div class="container">
  <form method="post" autocomplete="off" id="password_form">
    <div class="row">
      <h2><strong>Account Settings</strong></h2>
	  <h3>Change Password</h3>
      <div class="input-group input-group-icon">
        <input type="password" name="old_pass"  placeholder="Current Password" value="" required/>
      </div>
	        <div class="input-group input-group-icon">
        <input type="password" name="new_pass" placeholder="New Password" value="" required/>
      </div>
	        <div class="input-group input-group-icon">
        <input type="password" name="re_pass"  placeholder="Confirm Password" value="" required/>
      </div>
    </div>

    <div>
      <button type="submit"   value="Reset Password" name="re_password"  class="buttonsubmit">Submit</button>
	  <button type="submit" name="redirect" class="buttonsubmit" onclick="window.history.go(-1)">Cancel</button>
    </div>
     
    </div>
  </form>
  <p></p>

  <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
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
    
</body>
</html>
