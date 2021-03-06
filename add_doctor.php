<?php  
	session_start();
	if(!isset($_SESSION['admin']))
	header('Location: admin_login.php'); 
	include 'dbconfig.php';
?>

<?php
	//$con = new mysqli("localhost", "root", "", "has");
	$data = array();
	$sql = ("SELECT DISTINCT hos_city from hospital");
	$result = mysqli_query($con,$sql);
	while($row = mysqli_fetch_array($result))
	{
	   $city = $row['hos_city'];
	   $hos = array();
	   $sql2 =("SELECT DISTINCT hos_name from hospital WHERE hos_city = '$city'");
	   $result2 = mysqli_query($con,$sql2);
	   while($row2 = mysqli_fetch_array($result2))
	   {
		array_push($hos, $row2['hos_name']);
	   }
	   $data[$city] = $hos;
	}
	$con->close();
?>
<?php
	$doctor_name = $experience = $qualification = $email = $dob = $specialization = $languages = "";
	
	if ($_SERVER["REQUEST_METHOD"] == "POST") 
	{
		$hospital_city = $_POST["hospital_city"];
		$hospital_name = $_POST["hospital_name"];
		$doctor_name = $_POST["doctor_name"];
		$gender = $_POST["gender"];
		$experience = $_POST["experience"];
		$qualification = $_POST["qualification"];
		$specialization = $_POST["specialization"];
		$languages = $_POST["languages"];
		$email = $_POST["email"];
		$dob = $_POST["dob"];
		
		//----------------------Inserting into Database-------------------------------//

		$con = new mysqli("localhost", "root", "", "has");
		
		$sql = " SELECT hos_id from hospital WHERE hos_city = '$hospital_city' AND hos_name = '$hospital_name' ";
		$result = $con->query($sql);
		$row = mysqli_fetch_array($result);
		$hospital_id = $row['hos_id'];
		
		$sql2 = "INSERT INTO doctor (hos_id,name,gender,email,dob,qualification,experience,specialization,languages)
				VALUES ('$hospital_id','$doctor_name','$gender','$email','$dob','$qualification','$experience','$specialization','$languages')";
		
		if(($con->query($sql2)))
		{
			header("Location:admin_menu.php");
		}
		$con->close();
	}
?>
<html>
	<head>
		<title>Tambah Dokter</title>
		<link rel="stylesheet" href="bootstrap/bootstrap.min.css">
		<link rel="stylesheet" type="text/css" href="bootstrap/common.css">
		<script src="bootstrap/jquery-1.11.3.min.js"></script>
		<script src="bootstrap/bootstrap.min.js"></script>
	</head>
	
<script>

	$(document).ready(function(){

		$("#city").change(function(){
	  var data = '<?php echo json_encode($data);?>';
	  var city = $(this).val();
	  var arr = JSON.parse(data);
	  $(".added").remove();
	   if(city !=  " ")
	   {
		var hos = arr[city];
		for(var i=0;i<hos.length;i++)
		{
			$("#hospital").append('<option class="added" value = '+JSON.stringify(hos[i]) +'>'+hos[i]+'</option>')
		}
	   }

	});
	});

</script>
 
<body>
	<?php require("nav_bar_clc.php"); ?>
  
	<div class="form-box">
		<center>
			<div class="register">
				Add Doctor
			</div>

			<div class="form_box">
			
				<form class="form-horizontal" role="form" action="" method="post">
				
					<div class="form-group">
					
						<label class="control-label col-sm-4">Pilih Kota</label>
						<div class="col-sm-8">  
							<select class="form-control" id="city" name="hospital_city" required>
								<option value="">Pilih Kota</option>
								<?php
									foreach ($data as $key => $value) 
									{
										echo "<option value ='".$key."'>$key</option>";
									}
								?>
							</select>
						</div>

						<label for="sel1" class="control-label col-sm-4">Pilih Rumah Sakit</label>
						<div class="col-sm-8">
							<select  class="form-control" id="hospital" name="hospital_name" required>
								<option value="">Pilih Rumah Sakit</option>
							</select>
						</div>
						
					</div>
		  
					<div class="form-group">
						<label class="control-label col-sm-4">Nama</label>
						<div class="col-sm-8">
							<input type="text" class="form-control" name="doctor_name"  value="<?php echo "$doctor_name" ?>" placeholder="Masukkan nama dokter" required>
						</div>
					</div>
		  
					<div class="form-group">
						<label class="control-label col-sm-4">Gender</label>
						<div class="col-sm-8">
							<select class="form-control" name="gender" required>
								<option value="">Select</option>
								<option value="Male">Male</option>
								<option value="Female">Female</option>
							</select>
						</div>
					</div>

					<div class="form-group">
						<label class="control-label col-sm-4" >Pengalaman</label>
						<div class="col-sm-8">
							<input type="text" class="form-control" name="experience"  value="<?php echo "$experience" ?>" placeholder="Masukkan lama pengalaman" required>
						</div>
					</div>
		  
					<div class="form-group">
						<label class="control-label col-sm-4">Kualifikasi</label>
						<div class="col-sm-8">
							<input type="text" class="form-control" name="qualification" value="<?php echo "$qualification" ?>" placeholder="Kualifikasi" required>
						</div>
					</div>
					
					<div class="form-group">
						<label class="control-label col-sm-4">Spesialisasi</label>
						<div class="col-sm-8">
							<input type="text" class="form-control" name="specialization" value="<?php echo "$specialization" ?>" placeholder="Spesialisasi" required>
						</div>
					</div>
		  
					<div class="form-group">
						<label class="control-label col-sm-4">Email</label>
						<div class="col-sm-8">
							<input type="email" class="form-control" name="email" value="<?php echo "$email" ?>" placeholder="Masukkan alamat email dokter" required>
						</div>
					</div>
					
					<div class="form-group">
						<label class="control-label col-sm-4">Bahasa</label>
						<div class="col-sm-8">
							<input type="text" class="form-control" name="languages" value="<?php echo "$languages" ?>" placeholder="Bahasa yang dikuasai" required>
						</div>
					</div>
		  
					<div class="form-group">
						<label class="control-label col-sm-4">Tanggal Lahir</label>
						<div class="col-sm-8">
							<input type="date" class="form-control" name="dob" value="<?php echo "$dob" ?>" placeholder="Masukkan tanggal lahir dokter" required>
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