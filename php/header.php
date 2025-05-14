<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>Toko DKiDS Media</title>
	<link rel="stylesheet" type="text/css" href="../css/style.css">
	<link rel="stylesheet" type="text/css" href="semantic/dist/semantic.min.css">
	<script src="../js/logout.js" defer></script>
</head>

<body>
<header>
		<img style="filter: brightness(100); width: 180px;" src="../img/logo.webp">
		<div>
			<div style="text-align: right; font-weight: 700;">Sistem Pendukung Keputusan <br> Purchasing</div>
			<div style="color:rgb(225, 162, 162); text-align: right; font-size: 12px;">Jihan Arsyifa Putri</div>
			<div style="color:rgb(225, 162, 162); text-align: right; font-size: 12px; line-height: 0.8;">2011010064</div>
		</div>
</header>

<div class="wrapper">
	<nav id="navigation" role="navigation">
		<ul>
			<li><a class="item" href="home.php">Home</a></li>
			<li>
				<a class="item" href="kriteria.php">Kriteria
					<div class="ui blue tiny label" style="float: right;"><?php echo getJumlahKriteria(); ?></div>
				</a>
			</li>
			<li>
				<a class="item" href="alternatif.php">Alternatif
					<div class="ui blue tiny label" style="float: right;"><?php echo getJumlahAlternatif(); ?></div>
				</a>
			</li>
			<li><a class="item" href="bobot_kriteria.php">Perbandingan Kriteria</a></li>
			<li><a class="item" href="bobot.php?c=1">Perbandingan Alternatif</a></li>
				<ul>
					<?php

						if (getJumlahKriteria() > 0) {
							for ($i=0; $i <= (getJumlahKriteria()-1); $i++) { 
								echo "<li><a class='item' style='font-weight: lighter; font-size: 11px;' href='bobot.php?c=".($i+1)."'>".getKriteriaNama($i)."</a></li>";
							}
						}

					?>
				</ul>
			<li><a class="item" href="hasil.php">Hasil</a></li>
			<li><a class="item" href="#" onclick="event.preventDefault(); logout()">Keluar</a></li>
		</ul>
	</nav>