<nav class="navbar navbar-expand bg-transparent">
    <a class="navbar-brand" href="#">
	
	</a> 
	<ul class="nav navbar-nav">
        <li class="nav-item">
            <a class="nav-link active" href="user_menu.php">Beranda</a>
        </li>
         <li class="nav-item dropdown">
					<a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false"> <?php echo $_SESSION['user'];?> <span class="caret"></span></a>
				<div class="dropdown-menu">
						<a class="dropdown-item" href="appointment_search.php">Cek Jadwal Dokter</a>
						<a class="dropdown-item" href="appointment_search.php">Daftar Pemeriksaan</a>
						<a class="dropdown-item" href="edit_profile.php">Profil Diri</a>
						<a class="dropdown-item" href="logout.php">Keluar</a>
					</div>
			</li>
			<li nav-item><a  class="nav-link" href="#">Bantuan</a></li> 
	</ul>
		</div>
		</div>
	</nav>