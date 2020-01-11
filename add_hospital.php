<?php  
	session_start();
	if(!isset($_SESSION['admin']))
	header('Location: admin_login.php'); 
?>

<?php 
	$hospital_nameErr = $hospital_city_nameErr = "";
	$hospital_name = $hospital_city = "";
	
	if ($_SERVER["REQUEST_METHOD"] == "POST") 
	{
		////////////////////////////////////////////////////////////
		if (empty($_POST["hospital_name"])) 
		{
			$hospital_nameErr = "*Hospital Name is required";
		} 
		else 
		{
			$hospital_name = $_POST["hospital_name"];
			if (!preg_match("/^[a-zA-Z ]*$/",$hospital_name)) 
			{
				$hospital_nameErr = "*Only letters and white space allowed"; 
			}
		}	   
		//////////////////////////////////////////////////////////	   
		if (empty($_POST["hospital_city"])) 
		{
			$hospital_city_nameErr = "*City Name is required";
		} 
		else 
		{
			$hospital_city = $_POST["hospital_city"];
			if (!preg_match("/^[a-zA-Z ]*$/",$hospital_city)) 
			{
				$hospital_city_nameErr = "*Only letters and white space allowed"; 
			}
		}
		/////////////////////////////////////////////////////////
		
		//------------------------Inserting into Database------------------------------//
		
		if( empty($hospital_nameErr) && empty($hospital_city_nameErr) )
		{
			//$hostname = "localhost";
			//$username = "root";
			//$key = "";
			//$dbname = "has";
			//$con = new mysqli($hostname, $username, $key, $dbname);
			include 'dbconfig.php';
				
			$sql = "INSERT INTO hospital (hos_name,hos_city)
			VALUES ('$hospital_name','$hospital_city')";	
					
			if(($conn->query($sql)))
			{
				header("Location:admin_menu.php");
			}
			$conn->close();
		}
		
	}	
?>

<html>
	<head>
		<title>Add Hospital</title>
		<link rel="stylesheet" href="bootstrap/bootstrap.min.css">
		<link rel="stylesheet" type="text/css" href="common.css" >
	</head>
	
<body>

	<?php require("nav_bar_clc.php"); ?>
  
	<div class="form-box">
		<center>
			<div class="register">
				Tambah Rumah Sakit
			</div>

			<div class="form_box">
				<form class="form-horizontal" role="form" action="" method="post">
				
					<div class="form-group">
						<label class="control-label col-sm-4">Nama Rumah Sakit</label>
						<div class="col-sm-8">
							<input type="text" class="form-control" name="hospital_name" value="<?php echo "$hospital_name" ?>" placeholder="Masukkan nama rumah sakit">
							<span><?php echo $hospital_nameErr; ?></span>
						</div>
					</div>
					
					<div class="form-group">
						<label class="control-label col-sm-4">Kota</label>
						<div class="col-sm-8">
							<input type="text" class="form-control" name="hospital_city" value="<?php echo "$hospital_city" ?>" placeholder="Masukkan nama kota">
							<span><?php echo $hospital_city_nameErr; ?></span>
						</div>
					</div>
  
					<div class="form-group"> 
						<div class="col-sm-offset-1 col-sm-10">
							<button type="submit" class="btn btn-primary">Kirim</button>
						</div>
					</div>
					
				</form>
			</div>
		</center>
	</div>
</body>

</html>