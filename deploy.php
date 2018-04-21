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
if(isset($_POST['vername']))
{ 
$vername=$_POST['vername'];

$query1=mysqli_query($con,"SELECT lpath from vtable where vername='$vername'");
$query2=mysqli_fetch_array( $query1,MYSQLI_ASSOC);
$lpath=$query2['lpath'];



$msg="a11sdasd";
$ver_name=$vername;
$vername=$vername."wcopy";
$lpath=str_replace("\\","/",$lpath);
$final_path=$lpath."\\".$vername;
exec("svn add --force $final_path");
exec("svn commit -m $msg $final_path");


}}

sleep(2);

/*
if(isset($_POST['submit1']))
{
if(isset($_POST['vername']))
{ 
$vername=$_POST['vername'];
$query = "DELETE FROM `ver` WHERE 1";
mysqli_query($con,$query);
$query = "INSERT INTO `ver`(`version`) VALUES ('$vername')";
mysqli_query($con,$query);
header("Location:status.php");
}}*/
?>


<!DOCTYPE html>
<html lang="en" class="no-js">
	<head>
		<meta charset="UTF-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge"> 
		<meta name="viewport" content="width=device-width, initial-scale=1"> 
		<title>SVN Utility-Deploy</title>
		<meta name="keywords" content="custom select, select style, javascript, inspiration, select element" />
		<link rel="shortcut icon" href="img/favicon.ico">
		<link href='http://fonts.googleapis.com/css?family=Raleway:400,300,700' rel='stylesheet' type='text/css'>
		<link rel="stylesheet" type="text/css" href="style/demo.css" />
		<link rel="stylesheet" type="text/css" href="style/cs-select.css" />
		<link rel="stylesheet" type="text/css" href="style/cs-skin-rotate.css" />
		<link rel="stylesheet" href="style/drop.css"/>
		<link rel="stylesheet" href="style/drop2.css"/>
		<script src="js/drop.js"></script>
		<script src="js/drop2.js"></script>
		<script src="js/n.js"></script>
		<script src="js/n1.js"></script>
		<script src="sweet/dist/sweetalert.min.js"></script> <link rel="stylesheet" type="text/css" href="sweet/dist/sweetalert.css">
			<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
	
		
		
		<style>
		body{
		background: url("img/bg.jpg") no-repeat center center fixed;
		background-color:#ECEFF1;
		-webkit-background-size: cover;
		-moz-background-size: cover;
		-o-background-size: cover;
		background-size: cover;
		}
		  canvas {
        -moz-user-select: none;
        -webkit-user-select: none;
        -ms-user-select: none;
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
		.chartb{
		margin-left:30px;
height:300px;
width:500px;
    padding: 10px 10px 20px 10px;
    border: 2px solid;
    box-shadow: 1px 1px 1px 1px;
}

	

		</style>
	</head>
	<body>

	
	<div id="head">
	<div id="mySidenav" class="sidenav">
  <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">X</a>
  <a href="admin.php">Dashboard</a>
  <a href="search.php">Search</a>
  <a href="#">Deploy</a>
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
	</div><div class="m7">
	<div id="container">
        <canvas id="canvas"></canvas>
    
   
	
</div>
<form method="POST" action="" name="form">
			<div class="buttons">
			<section id="yy">
				<label class="select-label">Choose Version</label>
			<?php	
			/*--<select name="vername" class="cs-select cs-skin-rotate">
				$query3=mysqli_query($con,"SELECT vername from vtable");
				   $query4=mysqli_fetch_array( $query3,MYSQLI_ASSOC);


					$lpath=$query2['lpath'];
					<option value="v2.0">v2.0</option>
					<option value="v3.0">v3.0</option>
					<option value="v4.0">v4.0</option>
					<option value="v5.0">v5.0</option>
					<option value="v6.0">v6.0</option>
				</select>---*/
				$sql = "SELECT vername FROM vtable";
$result = mysqli_query($con,$sql);

echo "<select name='vername' class='cs-select cs-skin-rotate'>";
while ($row = mysqli_fetch_array($result,MYSQLI_ASSOC)) {
    echo "<option value='" . $row['vername'] ."'>" . $row['vername'] ."</option>";
}
echo "</select>";

				?>
			</section>
			<div class="txt">
							<div class="li">
				<input class="lu" name="submit" type="submit" onclick="myFunction()" value="Deploy" style="padding-left:87px;padding-right:87px"/></div>
				<!--<div class="li">
				<input class="lu" name="submit1" type="submit" value="Status"/>

			</div> -->
			</div>


			</div>
			</form>
		
				

</div>

<p></p>

		<script src="js/classie.js"></script>
		<script src="js/selectFx.js"></script>
				<script>
function myFunction() {
      <!--alert("Done! You've deployed successfully");-->
	swal({   title: "Done!",   text: " You've deployed successfully",   timer: 2000,   showConfirmButton: false });
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
		<?php
		$i1="0";
		$directory1 = 'c:/new/v1.0wcopy/';
		echo $directory1;
	$it = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($directory1));
	while($it->valid()) 
	{
		if (!$it->isDot()) 
		{if(stristr($it->getSubPathName(), ".svn") === FALSE) 
			{$i1++;	
			echo $i1;
		}}
		$it->next();
	}?>
	<?php
  		$i2="0";
		$directory2 = 'c:/new/v2.0wcopy/trunk/';
	$it1 = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($directory2));
	while($it1->valid()) 
	{
		if (!$it1->isDot()) 
		{if(stristr($it1->getSubPathName(), ".svn") === FALSE) 
			{$i2++;	
		}} 	
		$it1->next();
	}


		?>
		<script>

	
        var color = Chart.helpers.color;
        var barChartData = {
            labels: ['v1.0','v2.0','v3.0','v4.0','v5.0','v6.0'],
            datasets: [ {
                label: 'No of FIles',
                backgroundColor: color(window.chartColors.blue).alpha(0.5).rgbString(),
                borderColor: window.chartColors.blue,
                borderWidth: 1,
                data: [ '<?php echo $i1 ;?>',
				'<?php echo $i2 ;?>',
				0,0,0]
            }]

        };

        window.onload = function() {
            var ctx = document.getElementById("canvas").getContext("2d");
            window.myBar = new Chart(ctx, {
                type: 'bar',
                data: barChartData,
                options: {
                    responsive: true,
                    legend: {
                        position: 'top',
                    },
                    title: {
                        display: true,
                        text: 'Number of files'
                    }
                }
            });

        };

        /*    var colorNames = Object.keys(window.chartColors);
        document.getElementById('addDataset').addEventListener('click', function() {
            var colorName = colorNames[barChartData.datasets.length % colorNames.length];;
            var dsColor = window.chartColors[colorName];
            var newDataset = {
                label: 'Dataset ' + barChartData.datasets.length,
                backgroundColor: color(dsColor).alpha(0.5).rgbString(),
                borderColor: dsColor,
                borderWidth: 1,
                data: []
            };

            for (var index = 0; index < barChartData.labels.length; ++index) {
                newDataset.data.push(randomScalingFactor());
            }

            barChartData.datasets.push(newDataset);
            window.myBar.update();
        });*/

       
</script>


<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <script src="smoothscroll.js"></script>
    <!-- Latest compiled and minified JavaScript -->
	<script src="http://code.jquery.com/jquery-1.11.3.min.js"></script> 
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

	</body>
</html>