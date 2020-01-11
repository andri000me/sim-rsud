<?php  
	session_start();
	if(!isset($_SESSION['id']))
	header('Location: login.php'); 
	include 'dbconfig.php';
?>

<?php
	//$hostname = "localhost";
	//$username = "root";
	//$key = "";
	//$dbname = "has";
	//$con = new mysqli($hostname, $username, $key, $dbname);
	
	$current_user_id=$_SESSION['id'];
	$sql="SELECT * FROM registered WHERE user_id='$current_user_id'";
	$result = $conn->query($sql);
	$row=mysqli_fetch_array($result);
	$name= $row['name'];
	$email= $row['email'];
	$birth_date= $row['dob'];
	$gender= $row['gender'];
	$city= $row['city'];
	$mobile= $row['mobile'];
	$image= $row['image'];
	$conn->close();
?>

<?php
	$mobileErr = $cityErr = $dobErr = "";
	if ($_SERVER["REQUEST_METHOD"] == "POST") 
	{	
		$current_user_id=$_SESSION['id'];
		$dob = $_POST["dob"];
		$gender = $_POST["gender"];
		$mobile = $_POST["mobile"];
		$city = $_POST["city"];
		$remove_image = $_POST["remove_image"];
		
		/*-------------------Image--------------------------------*/
			$image_name=$_FILES['file']['name'];
			$image_path="image/user_img/".$image_name;
			$image_tmpname=$_FILES['file']['tmp_name'];
			if( empty($image_tmpname) )
				$image_name = $image;
			if($remove_image == "yes")
			{
				$image_name = "";
			}
			if( !empty($image_tmpname) )
				move_uploaded_file($image_tmpname,$image_path);		
		/*-------------------Mobile Check------------------------*/
		if(!empty($mobile))
		{
			if (preg_match("/^[0-9]*$/",$mobile)) 
			{
				if((strlen($mobile))!=10)
					$mobileErr = "*Must be of 10 digits"; 
			}
			else
				$mobileErr = "*Invalid Mobile Number"; 
		}
		/*-------------------DOB Check------------------------*/
		$today_date = date("j-m-Y"); 
		$date1 = strtotime($today_date);
		$date2 = strtotime($dob);
		if ( ($date1 - $date2) < 3650) 
		{
			$dobErr = "*Select valid Date"; 
		}
		/*-------------------City Check------------------------*/
		if (!preg_match("/^[a-zA-Z ]*$/",$city)) 
			{
				$cityErr = "*Only letters and white space allowed"; 
			}
		/*----------------Insetting into Database--------------*/
		if(empty($mobileErr) && empty($cityErr) && empty($dobErr) && empty($imgErr) )
		{
			$con = new mysqli($hostname, $username, $key, $dbname);
		
			$sql=" UPDATE registered SET dob='$dob' , mobile='$mobile' , gender='$gender' , city='$city' , image='$image_name'
			WHERE user_id='$current_user_id'; ";
			
			$result = $con->query($sql);
			if(($con->query($sql)))
			{
				header("Location:user_menu.php");
			}
			$con->close();
		}
	}
?>

<html>

	<head>
		<title>Profile</title>
		<link rel="stylesheet" href="bootstrap/bootstrap.min.css">
		<link rel="stylesheet" type="text/css" href="common.css" >
<script src="https://code.jquery.com/jquery-3.3.1.min.js" ></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" ></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js" ></script>
		
		<script>
		$(document).ready(function() {
			$('#button').filestyle({
				buttonName : 'btn-info',
                buttonText : 'Select Image'
			});  
		});			
		</script>
	</head>

	<body>
		<?php require("nav_bar_uc.php"); ?>
		<div class="form-box">
			<center>
			<div class="register">Profile</div>
			<div class="form_box">
				<form class="form-horizontal" role="form" action="" method="post" enctype="multipart/form-data">
					
					<br>
					
					<div class="form-group">
						<div>
							<?php if($image==""){?>
							<img alt="user-image" src="image/user_img/default_profile_pic_user_<?php if($row['gender']!='-Select-')echo $row['gender']; else echo"male"; ?>.png" style="height:150px; width:150px; ">
							<?php }else{?>
							<img alt="user-image" src="image/user_img/<?php echo $image;?>" style="height:150px; width:150px; ">							
							<?php }?>
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-sm-4">Hapus Gambar</label>
						<div class="col-sm-8"> 
							<select name="remove_image" class="form-control" >
								<option value="no">Tidak</option>
								<option value="yes">Ya</option>
							</select>
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-sm-4">Ubah Gambar Profile</label>
						<div class="col-sm-8">
							<input type="file" id="button" name="file">
						</div>
					</div>
					
					<div class="form-group">
						<label class="control-label col-sm-4">Nama</label>
						<div class="col-sm-8">
							<input type="text" class="form-control" value="<?php echo "$name";?>" readonly>
						</div>
					</div>
					
					<div class="form-group">
						<label class="control-label col-sm-4">Email</label>
						<div class="col-sm-8">
							<input type="text" class="form-control" value="<?php echo "$email";?>"readonly>
						</div>
					</div>
					
					<div class="form-group">
						<label class="control-label col-sm-4">Tanggal Lahir</label>
						<div class="col-sm-8">
							<input type="date" class="form-control" name="dob" value="<?php echo "$birth_date";?>" placeholder="Pilih tanggal lahir" >
							<span><?php echo $dobErr; ?></span>
						</div>
					</div>
  
					<div class="form-group">
						<label class="control-label col-sm-4">Nomor Telepon</label>
						<div class="col-sm-8"> 
							<input type="text" class="form-control" name="mobile" value="<?php echo "$mobile";?>" placeholder="Masukkan nomor telepon" >
							<span><?php echo $mobileErr; ?></span>
						</div>
					</div>
					
					<div class="form-group">
						<label class="control-label col-sm-4">Jenis Kelamin</label>
						<div class="col-sm-8"> 
							<select name="gender" class="form-control" >
								<option value="<?php echo $gender; ?>"><?php echo "$gender";?></option>
								<option value="Pria">Pria</option>
								<option value="Wanita">Wanita</option>
							</select>
						</div>
					</div>
					
					<div class="form-group">
						<label class="control-label col-sm-4">Kota</label>
						<div class="col-sm-8"> 
							<input type="text" class="form-control" name="city" value="<?php echo "$city";?>" placeholder="Enter your City" >
							<span><?php echo $cityErr; ?></span>
						</div>
					</div>
					
					<div class="form-group"> </div>
					
					<div class="form-group"> 
						<div class="col-sm-offset-1 col-sm-10">
							<button type="submit" class="btn btn-primary" style="width:100">Simpan</button>
						</div>
					</div>
					
				</form>
			</div>
			</center>
		</div>
	</body>
</html>