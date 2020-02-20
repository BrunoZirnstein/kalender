<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Dummy</title>
		<link rel="stylesheet" href="navbar.css">
		<link rel="stylesheet" href="general.css">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	</head>
	<body>
	<div id="mySidenav" class="sidenav">
		<a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
		<form action="" class="menu-search">
			<input type="text" placeholder="Suche ...">
			<input type="submit" class="fa" value="&#xf002;">
		</form>
		<a href="kalender.php?uid=<?php
			$uid = 1;
			echo $uid;
		?>"><i class="fa fa-calendar"></i>Kalender</a>
		<a class="search-link" href="#"><i class="fa fa-search"></i>Suche</a>
		<a href="#"><i class="fa fa-calendar-check-o"></i>Events</a>
		<a href="#"><i class="fa fa-address-card"></i>Admin</a>
	</div>

	<span id="openbtn" onclick="openNav()">&#9776;</span>

	<div id="desing-content">
		<form id="page-search">
			<input type="text" placeholder="Suche ...">
			<input type="submit" class="fa" value="&#xf002;">
		</form>
		<div id="page-head">
			<h2 class="itwc">Persönlicher Kalender</h2>
			<div class="page-logo" style="background-image:url('./img/<?php
				$company = 3;
				if ($company == 1) echo "sap.jpeg";
				if ($company == 2) echo "t-systems.svg";
				if ($company == 3) echo "communardo.png";
			?>')"></div>
		</div>
		<div id="page-content">
			<?php
				include('profil.php');
			?>
		</div>

	<script>
		function openNav() {
			document.getElementById("mySidenav").classList.add ("navOpen");
			document.getElementById("desing-content").classList.add ("navOpen");
		}

		function closeNav() {
			document.getElementById("mySidenav").classList.remove ("navOpen");
			document.getElementById("desing-content").classList.remove ("navOpen");
		}
	</script>
	</body>
</html>