<!DOCTYPE html>
<html>

<head lang="en">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SVN UTILITY</title>
    <link href="img/favicon.ico" type="image" rel="icon">
    <link rel="stylesheet" href="style/1.css" />
    <link rel="stylesheet" href="style/drop2.css" />
    <link rel="stylesheet" href="style/news.css" />
    <script src="js/drop2.js"></script>
    <script src="sweet/dist/sweetalert.min.js"></script>
    <link rel="stylesheet" type="text/css" href="sweet/dist/sweetalert.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <!-- Optional theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
    <link href="http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Fascinate" rel="stylesheet">

    <style>
        body {
            background-color: #ECEFF1;
            -webkit-background-size: cover;
            -moz-background-size: cover;
            -o-background-size: cover;
            background-size: cover;
        }
    </style>

</head>

<body>

    <div class="tab-content">

        <div id="home" class="tab-pane fade active in headerwrap">
            <div id="head">
                <div id="mySidenav" class="sidenav">
                    <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">X</a>

                    <a href="#home" data-toggle="tab" class="smoothScroll">Home</a>
                    <a href="help.html">Help</a>
                    <a href="about.html">About</a>
                </div>

                <span style="font-size:30px;cursor:pointer;position:absolute;left:0;padding-left: 10px;padding-top:10px;text-align:right;" class="oop" onclick="openNav()">&#9776;</span>

                <div class="li">
                    <a href="#sign_in" data-toggle="tab" class="smoothScroll" onclick="hideFooter()"><strong>SIGN IN</strong></a>
                </div>
            </div>
            <h1 class="animated fadeIn"></h1>
            <div align="center">
                <img src="img/logo.png" alt="logo" style="width:350px;height: 100px;">
                <h3>Welcome to SVN UTILITY!</h3>
            </div>
			</br>
			<h2 style="padding-left:20px;">Latest News</h2>
			<iframe src="index.html" frameborder="0" style="overflow:hidden;height:550px;width:100%" height="100%" width="100%"></iframe>

           
        </div>

        <div id="sign_in" class="tab-pane headerwrap">
            <div class="user_login">
                <center>
                    <form action="authenticat.php" method="POST" role="form">
                        <div>
                            <?php 

                                $errors = array(
                                    1=>"Invalid user name or password, Try again",
                                    2=>"Please login to access this area"
                                  );

                                $error_id = isset($_GET['err']) ? (int)$_GET['err'] : 0;

                                if ($error_id == 1) {
                                        ?>
                                <script>
                                    sweetAlert("Oops..", "Invalid user name and password", "error");
                                </script>
                                <?php
                                    }elseif ($error_id == 2) {
                                        ?>
                                    <script>
                                        sweetAlert("Attention!", "Please login to access this area", "error");
                                    </script>
                                    <?php
                                    }

                               ?>
                        </div>
                        <input type="text" placeholder="username" id="username" name="username" required autofocus />
                        <br />
                        <input type="password" placeholder=" password" id="password" name="password" required />
                        <br />
                        <button class="btn " type="submit">SIGN IN</button>						
						
                    </form>
                    <div class="lik">
                        <center>
						<br/>
                            <a href="#" onclick="myFunction()">Forgot Password?</a></center>
                        </br>
                        <center>
                            <a href="#home" data-toggle="tab" class="smoothScroll"><img src="img/home.png" height="50px" width="50px"></a>
                        </center>
                    </div>
                </center>
            </div>
        </div>

    </div>
	

    <script>
        function myFunction() {
			swal({   title: "Forgot Password!",   text: "Please contact the Administrator.",   imageUrl: "img/forgot-password.png" });
        }
		
		function hideFooter(){
			var display = document.getElementById("myFooter").style.display;
			document.getElementById("myFooter").style.display="none";
		}
    </script>
    <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <script src="smoothscroll.js"></script>
    <!-- Latest compiled and minified JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

</body>

</html>