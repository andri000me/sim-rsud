<?php  
	session_start();
	if(!isset($_SESSION['id']))
	header('Location: login.php'); 
	include 'dbconfig.php';
?>

<?php

	//$con = new mysqli("localhost", "root" , "", "has");
	$data = array();
	$sql = ("SELECT DISTINCT specialization from doctor");
	$result = mysqli_query($conn,$sql);
	while($row = mysqli_fetch_array($result))
	{
	   $city = $row['specialization'];
	   $hos = array();
	   $sql2 =("SELECT DISTINCT name from doctor WHERE specialization = '$city'");
	   $result2 = mysqli_query($conn,$sql2);
	   while($row2 = mysqli_fetch_array($result2))
	   {
		array_push($hos, $row2['name']);
	   }
	   $data[$city] = $hos;
	}
	$conn->close();
?>

<html>

	<head>
		<title>Cari Dokter</title>
		<link rel="stylesheet" href="bootstrap/bootstrap.min.css">
		<link rel="stylesheet" type="text/css" href="bootstrap/common.css" >
		
	<script src="https://code.jquery.com/jquery-3.3.1.min.js" ></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" ></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js" ></script>
	</head>

<script>

	$(document).ready(function(){

		$("#city").change(function(){
	  var data = '<?php echo json_encode($data);?>';
	  var city = $(this).val();
	  var arr = JSON.parse(data);
	  $(".added").remove();
	 //  if(city !=  " ")
	//   {
	//	var hos = arr[city];
	//	for(var i=0;i<hos.length;i++)
	//	{
	//		$("#hospital").append('<option class="added" value = '+JSON.stringify(hos[i]) +'>'+hos[i]+'</option>')
	//	}
	  // }

	});
	});

</script>

<script type = "text/javascript" language = "javascript">
	$(document).ready(function() {
		
		$("#search").click(function(event){
			var city = $('#city').val();
			//var hospital = $("#hospital").val();
			var passedData = 'city=' + city + '&id=1';  //to decide button
			
			$.ajax( {
			type: "POST",
			url:'load_data.php',
			data:passedData,
			cache: false,
			success:function(data) {
			$('#table').html(data);
			}
		});
	});
 });
</script>


<body>
	
	<?php require("nav_bar_uc.php"); ?>

	<center>
		<div class="form">
			<div class="register">
				CARI DOKTER
			</div>

			<div class="form_box">
				<form class="form-horizontal" role="form" action="" method="post">
					
					<div class="form-group">
					
						<label class="control-label col-sm-4">Silahkan Pilih Poli</label>
						<div class="col-sm-8">  
							<select class="form-control" id="city">
								<option value="">Pilih Poli</option>
								<?php
									foreach ($data as $key => $value) 
									{
										echo "<option value ='".$key."'>$key</option>";
									}
								?>
							</select>
						</div>

						<!-- <label for="sel1" class="control-label col-sm-4">Pilih Dokter:</label>
						<div class="col-sm-8">
							<select  class="form-control" id="hospital">
								<option>Pilih Dokter</option>
							</select>
						</div> -->
						
					</div>
					
					<div class="form-group"> 
						<div class="col-sm-offset-1 col-sm-10">
							<input type = "button" class="btn btn-primary" id = "search" value = "Search" />
						</div>
					</div>
				</form>
			</div>
		</div>
		
		<div id = "table" class="form">
        
		</div>
		
	</center>
</body>

	

</html>