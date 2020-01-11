<?php  
	session_start();
	if(isset($_SESSION['admin']))
		unset($_SESSION['admin']);
	else if(isset($_SESSION['id']))
		header('Location: user_menu.php'); 
	include 'dbconfig.php';
?>
<?php

	$emailErr = $passwordErr = $combineErr="";
	$email = $password = "";
	
	if ($_SERVER["REQUEST_METHOD"] == "POST") 
	{
		$email = $_POST['email'];
		$password = $_POST['password'];	
		if (empty($email))
		{
			$emailErr = "* Enter email ";
		}
		if (empty($password)) 
		{
			$passwordErr = "* Password required ";
		}
	

		//$servername = "localhost";
		//$username = "root";
		//$key = "";
		//$dbname = "has";

		//-------------Create connection---------------------------------
		//$conn = new mysqli($servername, $username, $key, $dbname);
   
		if( empty($emailErr) && empty($passwordErr) ) 
	   {
			$dec_pass=sha1($password);
			$sql = "SELECT user_id,name FROM registered WHERE email = '$email' and password = '$dec_pass' ";
			$result = $conn->query($sql);
			$count = mysqli_num_rows($result);
		
			if($count == 1) 
			{
				$row=mysqli_fetch_array($result);
				$_SESSION['user'] = $row['name'];
				$_SESSION['id'] = $row['user_id'];
				header("location: user_menu.php");
			}
			else 
			{
				$combineErr = "* Kombinasi email dan kata kunci salah";
			}
	   }
	}
?>


<html>
<head>
	<title>Login Page</title>
	<link rel="stylesheet" href="bootstrap/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="bootstrap/common.css" >
</head>

<body>

	<?php require("nav_bar_arc.php"); ?>
	
	<center>
		<div class="form-box">
			<center>
				<div class="register">LOG IN</div>
				<div class="form_box">
					<form class="form-horizontal" role="form" action="" method="post">
					
						<div class="form-group"></div>
						<div class="form-group">
							<label class="control-label col-sm-4" for="email">Email:</label>
							<div class="col-sm-8">
								<input type="email" class="form-control" value="<?php echo "$email"; ?>" name="email" placeholder="Masukkan email">
								<span><?php echo $emailErr; ?></span>
							</div>
						</div>
						
						<div class="form-group">
							<label class="control-label col-sm-4" for="Password">Kata kunci:</label>
							<div class="col-sm-8"> 
								<input type="password" class="form-control" value="<?php echo "$password"; ?>" name="password" placeholder="Masukkan Kata kunci">
								<span><?php echo $passwordErr; ?></span>
								<span><?php echo $combineErr; ?></span>
							</div>
						</div>
						
						<div class="form-group"></div>
						<div class="form-group"> 
							<div class="col-sm-offset-1 col-sm-10">
								<button type="submit" class="btn btn-primary">Masuk</button>
							</div>
						</div>
					</form>
				</div>
			</center>
		</div>
	</center>
</body>

	<script src="https://code.jquery.com/jquery-3.3.1.min.js" ></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" ></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js" ></script>
	
</html>