
<?php 
	include 'dbconfig.php';
	//$conn = new mysqli("localhost", "root" , "", "has");
	
	$city= $_POST["city"];
	//$hospital= $_POST["hospital"];
	//$sql = " SELECT hos_id from doctor WHERE specialization = '$city' ";
	//$result1 = $conn->query($sql);
	//$row1 = mysqli_fetch_array($result1);
	//$hospital_id = $row1['doc_id'];
	
	$sql = " SELECT * FROM doctor WHERE specialization='$city' ";
	$result2 = $conn->query($sql);
	
?>

<html>
	
	<head>
		<script type = "text/javascript" language = "javascript">
		function remove_doctor(d_id)
		{
			$.ajax({
			type: "POST",
			url: "remove.php",
			data: "d_id=" + d_id + '&id=0',			//to decided in remove.php
			success: function(){
				alert("Doctor Removed Successfully..");
				window.location="del_doctor.php";
				}
			});
		}
		
		</script>
	</head>
	
<body>
	
	<?php 
	print($city);
	while($row2=mysqli_fetch_array($result2))
	{ 										?>		
		<hr><table  style="width:100%; " >
			<tr >
				<td>
					<div>
						<table>
							<tr>
								<td>
									<div id="div_img"  style="width:140 ; padding:8px; ">
										<img alt="doctor-image" src="image/default_profile_pic_<?php echo $row2['gender']; ?>.png" style="height:120px; width:120px; ">
									</div>
								</td>
								
								<td>
									<div class="doctor-information"  style="width:230; ">
										<h4>
											<div>Dr. <?php echo $row2['name']; ?> </div>
										</h4>
										<span> <?php echo $row2['qualification']; ?> </span>
										<br>
										<!-- <span style="font-size:14;"><?php //echo $hospital.' , '.$city; ?></span>-->
										<br>
										<span style="font-weight:600"> <?php echo $row2['specialization']; ?> </span>
										<br>
										<!--<span style="font-size:13;"> <?php //echo $row2['experience'].' years of experience'; ?> </span>
										<br>
										<span style="font-size:12;"> <?php //echo $row2['languages']; ?> </span>-->
									</div>
								</td>
							
								<td>
									<div class="appointment-block"  style="width:220; padding:5px; ">
										
										<!--<div>
											<img src="image/thumbs_up.jpg" style="height:30px; width:30px; ">
											<span style="font-size:14;">Recomendation</span>
										</div>
										<div>
											<img src="image/cal_icon.jpg" style="height:23px; width:23px; margin-bottom:4px;">
											<span style="font-size:14;">Monday-Friday</span>
											<br>
											<img src="image/clock_icon.jpg" style="height:23px; width:23px;">
											<span style="font-size:14;">10:00 AM to 01:00 PM</span>
										</div>-->
										<div>
											<img src="image/cek.png" style="height:20px; width:20px; margin-bottom:4px; ">
											<span style="font-size:13;"> <?php echo$row2['experience'].' tahun pengalaman'; ?> </span>
										</div>
										<div>
											<img src="image/cek.png" style="height:20px; width:20px; margin-bottom:4px;">
											<span style="font-size:12;"> <?php echo $row2['languages']; ?> </span>
										</div>
										<div style="padding:5px">
											<?php $id=$_POST['id']; $doc_id=$row2["doc_id"]; $hos_id=$row2["hos_id"]; if($id==1){?> 
											
											<a href="book_appointment.php?d_id=<?php echo $doc_id; ?> && h_id=<?php echo $hos_id; ?>"><button class="btn btn-primary" style="margin-bottom:5;">Pesan Jadwal</button></a>
											<a href="availability.php?d_id=<?php echo $doc_id;?>&&h_id=<?php echo $hos_id;?>"><button class="btn btn-primary">Cek Ketersediaan Jadwal</button></a><?php  }?>
											
											<?php $id=$_POST['id']; if($id==2){?>
											<button class="btn btn-primary" OnClick="remove_doctor('<?php echo $row2['doc_id'];?>')">Hapus Doctor</button><?php } ?>
										
										</div>
									</div>
								</td>
								
							</tr>
						</table>
					</div>
				</td>
			</tr>
		</table><hr><?php	
	}
?>
</body>

</html>
