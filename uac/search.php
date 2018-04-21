<?php

  session_start();
    $role = $_SESSION['sess_userrole'];
	 
    if(!isset($_SESSION['sess_username']) || $role!="Admin"){
      header('Location: index.php?err=2');
    }

if(isset($_POST['valueToSearch']))
{
    $valueToSearch = $_POST['valueToSearch'];
    // search in all table columns
    // using concat mysql function
    $query = "SELECT * FROM `user_detail` WHERE CONCAT(`userid`, `name`, `role`, `username`, 'password') LIKE '%".$valueToSearch."%'";
    $search_result = filterTable($query);
    
}
 else {
    $query = "SELECT * FROM `user_detail`";
    $search_result = filterTable($query);
}

// function to connect and execute the query
function filterTable($query)
{
    $connect = mysqli_connect("localhost", "root", "", "ifmutility");
    $filter_Result = mysqli_query($connect, $query);
    return $filter_Result;
}

?>

<!DOCTYPE html>
<html>
    <head>

        <title>EMPLOYEE Details</title>
		<link rel="stylesheet" href="ss.css"/>
				<link rel="stylesheet" href="../style/drop.css"/>
				<link rel="stylesheet" href="../style/drop2.css"/>
	<script src="drop.js"></script>
		<script src="../js/drop2.js"></script>
		<script src="../sweet/dist/sweetalert.min.js"></script> <link rel="stylesheet" type="text/css" href="../sweet/dist/sweetalert.css">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
		<style>
		 body {
		 background: url("img/bg.jpg") no-repeat center center fixed;
  background-color: #ECEFF1;
		-webkit-background-size: cover;
		-moz-background-size: cover;
		-o-background-size: cover;
		background-size: cover;
}
       
	  caption {
      caption-side: top;
	  font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
	  font-size:30px;
	  padding-bottom: 15px;
     }
input:focus {
  outline: 0;
  border-color: #546E7A;
}

input {
  width: 20%;
  padding: 1em;
  background-color: white;
  border: 1px solid white;
  border-radius: 0px;
  text-align: center;
}

body {
background-image: url("../img/bg.jpg");
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
	  </ul>--->
	</div>
</div>
        <div class="kkl">
        <form action="search.php" method="post">

		   <div class="see2" >
           <input type="text" style="text-align: left;left:0; border:2px solid #541313"name="valueToSearch" placeholder="Search.." />
			<!--<button class="buttonsubmit" type="submit" name="search" value="Search"><a href="search.php"><strong></strong></a></button>
			<button class="buttonsubmit" onclick="window.history.go(-1)"><strong>Back</strong></button>--></div>
			

    
          
		  
            
            <table id="user" >
			<caption>EMPLOYEE DETAILS</caption>
                <tr>
                    <th >UserId</th>
                    <th>Name</th>
                    <th>Role</th>
                    <th>Username</th>
					<th>Edit</th>
					<th>Delete</th>
					<th>Reset password</th>
                   
 
                </tr>

      <!-- populate table from mysql database -->
                <?php while($row = mysqli_fetch_array($search_result)):?>
                <tr>
                    <td><?php echo $row['userid'];?></td>
                    <td><?php echo $row['name'];?></td>
                    <td><?php echo $row['role'];?></td>
                    <td><?php echo $row['username'];?></td>
					<td><?php echo "<a href='edit.php?id=".$row['userid']."' style='text-decoration:none;font-size:25px;color:black;'>&#10000;</a>";?></td>
                    <td><?php echo "<a href='delete.php?id=".$row['userid']."' onclick='myfun1()'style='text-decoration:none;font-size:25px;color:black;'>&#10008;</a>";?></td>
                    <td><?php echo "<a href='resetpassword.php?id=".$row['userid']."' onclick='myfun()' style='text-decoration:none;font-size:15px;color:black;'>Reset</a>";?></td> 
					
       
                </tr>
                <?php endwhile;?>
            </table>
        </form>
		</div>
			<p></p>

		<script>
function myfun() {
swal({   title: "DONE!!",   text: "Password reset as username!",   timer: 4000,   showConfirmButton: false });
	}
function myfun1() {
      swal({   title: "DONE!!",   text: "Account deleted successfully!",   timer: 4000,   showConfirmButton: false });
	}
</script>

		
	
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
	    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

    </body>
</html>