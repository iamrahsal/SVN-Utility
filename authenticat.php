<?php 
  $database = 'ifmutility';
   $host = 'localhost';
   $user = 'root';
   $pass = '';

   // try to conncet to database
   $dbh = new PDO("mysql:dbname={$database};host={$host};", $user, $pass);

   if(!$dbh){

      echo "unable to connect to database";
   }

 session_start();

 $username = "";
 $password = "";
 
 if(isset($_POST['username'])){
   $username = strip_tags($_POST['username']);
  
 }
 if (isset($_POST['password'])) {
  $password = strip_tags($_POST['password']);

 }
  

 $q = 'SELECT * FROM user_detail WHERE username=:username AND password=:password';

 $query = $dbh->prepare($q);

 $query->execute(array(':username' => $username, ':password' => $password));


 if($query->rowCount() == 0){
  header('Location: index.php?err=1');
 }else{

  $row = $query->fetch(PDO::FETCH_ASSOC);

         session_regenerate_id();
        $_SESSION['sess_user_id'] = $row['userid'];
        $_SESSION['sess_username'] = $row['username'];
        $_SESSION['sess_userrole'] = $row['role'];
        $_SESSION['sess_name']=$row['name'];
		echo $_SESSION['sess_name'];
        echo $_SESSION['sess_userrole'];
  session_write_close();

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