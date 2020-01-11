<?php  
	session_start();
	if(!isset($_SESSION['admin']))
	header('Location: admin_login.php'); 
?>

<html>

<head>
	<title>Admin Menu</title>
	<link rel="stylesheet" href="bootstrap/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="common.css" >
</head>

<body>
	
	<?php require("nav_bar_clc.php"); ?>

	<div class="form-box">
		<center>
		<table>
			<tr>
				<td>
					<a href="add_doctor.php" ><button type="button" class="btn btn-primary btn-lg " style="width:300; margin-right:40; margin-bottom:15;">Tambah Dokter</button></a>
				</td>
				<td>
					<a href="del_doctor.php" ><button type="button" class="btn btn-primary btn-lg" style="width:300; margin-bottom:15;">Hapus Dokter</button></a>
				</td>
			</tr>
				
			<tr>
				<td>
					<a href="add_hospital.php" ><button type="button" class="btn btn-primary btn-lg" style="width:300; margin-right:40; margin-bottom:15;">Tambah Rumah Sakit</button></a>
				</td>
				<td>
					<a href="del_hospital.php" ><button type="button" class="btn btn-primary btn-lg" style="width:300;  margin-bottom:15;">Hapus Rumah Sakit</button></a>
				</td>
			</tr>
			
			<tr>
				<td>
					<button type="button" class="btn btn-primary btn-lg" style="width:300; margin-right:40; margin-bottom:15;">Cetak Laporan</button>
				</td>
				<td>
					<a href="change_password.php" ><button type="button" class="btn btn-primary btn-lg" style="width:300; margin-right:40; margin-bottom:15;">Ubah Kata Sandi</button></a>
				</td>
			</tr>
			
		</table>
		</center>
	</div>
</body>
	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" ></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" ></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js" ></script>
</html>