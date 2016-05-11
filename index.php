<?php 
session_start();
if(isset($_GET['logout']))
{
	
	        unset( $_SESSION['Nom'] );
			 unset($_SESSION['Prenom'] );
			 unset($_SESSION['DateN'] );
			 unset($_SESSION['Email'] );
}
?>
<!DOCTYPE html>

<html lang="en" class="body-full-height">
<head>        
	<!-- META SECTION -->
	<title>Atlant - Responsive Bootstrap Admin Template</title>            
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	
	<link rel="icon" href="favicon.ico" type="image/x-icon" />
	<!-- END META SECTION -->
	
	<!-- CSS INCLUDE -->        
	<link rel="stylesheet" type="text/css" id="theme" href="css/theme-default.css"/>
	<!-- EOF CSS INCLUDE -->                                    
</head>
<body>
<?php

if (!isset($_POST['submit'])){

?>
	
	<div class="login-container">
	
		<div class="login-box animated fadeInDown">
			<div class="login-logo"></div>
			<div class="login-body">
				<div class="login-title"><strong>Welcome</strong>, Please login</div>
				<form action="index.php" class="form-horizontal" method="post">
				<div class="form-group">
					<div class="col-md-12">
						<input type="text" class="form-control" placeholder="num mat ou app" name="username"/>
					</div>
				</div>
				<div class="form-group">
					<div class="col-md-12">
						<input type="password" class="form-control" placeholder="Password" name="password"/>
					</div>
				</div>
				<div class="form-group">
					<div class="col-md-6">
						<a href="#" class="btn btn-link btn-block">Forgot your password?</a>
					</div>
					<div class="col-md-6">
						<button class="btn btn-info btn-block" name="submit">Log In</button>
					</div>
				</div>
				</form>
			</div>
			<div class="login-footer">
				<div class="pull-left">
					&copy; 2014 AppName
				</div>
				<div class="pull-right">
					<a href="#">About</a> |
					<a href="#">Privacy</a> |
					<a href="#">Contact Us</a>
				</div>
			</div>
		</div>
		
	</div>
	<?php
} else {
require_once("db1.php");
$mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
# check connection
if ($mysqli->connect_errno) {
	echo "<p>MySQL error no {$mysqli->connect_errno} : {$mysqli->connect_error}</p>";
	exit();
}

$username = $_POST['username'];
$password = $_POST['password'];

$sql = "SELECT * from compte WHERE compte_user LIKE '{$username}' AND compte_mdp LIKE '{$password}' LIMIT 1";
$result = $mysqli->query($sql);
if (!$result->num_rows) {echo("votre mot de passe est incorrect");
	?>
	<div class="login-container">
	
		<div class="login-box animated fadeInDown">
			<div class="login-logo"></div>
			<div class="login-body">
				<div class="login-title"><strong>Welcome</strong>, Please login</div>
				<form action="index.php" class="form-horizontal" method="post">
				<div class="form-group">
					<div class="col-md-12">
						<input type="text" class="form-control" placeholder="num mat ou app" name="username"/>
					</div>
				</div>
				<div class="form-group">
					<div class="col-md-12">
						<input type="password" class="form-control" placeholder="Password" name="password"/>
					</div>
				</div>
				<div class="form-group">
					<div class="col-md-6">
						<a href="#" class="btn btn-link btn-block">Forgot your password?</a>
					</div>
					<div class="col-md-6">
						<button class="btn btn-info btn-block" name="submit">Log In</button>
					</div>
				</div>
				</form>
			</div>
			<div class="login-footer">
				<div class="pull-left">
					&copy; 2014 AppName
				</div>
				<div class="pull-right">
					<a href="#">About</a> |
					<a href="#">Privacy</a> |
					<a href="#">Contact Us</a>
				</div>
			</div>
		</div>
		
	</div>
	
	<?php
} else { 	

 $N=mysqli_fetch_row($result);
  echo $N[4];
  echo"<br> etudiant : $N[3]";
  if($N[4]!=NULL)
	{
	  $Z=("select * from professeur where prf_id={$N[4]}");
      $resultZ = $mysqli->query($Z);
	  while($P=mysqli_fetch_row($resultZ) )
		{				
             $_SESSION['id'] = $P[0];	
			$_SESSION['Nom'] = $P[1];
			$_SESSION['Prenom'] = $P[2];
			$_SESSION['DateN'] = $P[5];
			$_SESSION['Email'] = $P[3];
			header("location: prof_index.php");
									   
		}  
	}
	else   
		if($N[3]!=NULL)
		{    
			$A=("select * from etudiant where etd_nap={$N[3]}");
			$resultA = $mysqli->query($A);
			while($P=mysqli_fetch_row($resultA) )
			{
				$_SESSION['Nom'] = $P[1];
				$_SESSION['Prenom'] = $P[2];
				$_SESSION['DateN'] = $P[3];
				$_SESSION['Email'] = $P[4];
				header("location: etd_index.php");			   
			}  
		}
}
}
?>		
</body>
</html>






