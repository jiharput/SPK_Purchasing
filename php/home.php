<!doctype html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet"
		integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.8.2/css/all.min.css"
		integrity="sha512-rqQltXRuHxtPWhktpAZxLHUVJ3Eombn3hvk9PHjV/N5DMUYnzKPC1i3ub0mEXgFzsaZNeJcoE0YHq0j/GFsdGg=="
		crossorigin="anonymous" referrerpolicy="no-referrer" />
	<link rel="stylesheet" href="./css/style.css" />
</head>

<body>

	<?php
	include('config.php');
	include('fungsi.php');

	// header
	include('header.php');
	?>

	<section class="content">
		<!--<h2 class="ui header">Analitycal Hierarchy Process (AHP)</h2>

			<p>Analytic Hierarchy Process (AHP) merupakan suatu model pendukung keputusan yang dikembangkan oleh Thomas L. Saaty. Model pendukung keputusan ini akan menguraikan masalah multi faktor atau multi kriteria yang kompleks menjadi suatu hirarki. Hirarki  didefinisikan sebagai suatu representasi dari sebuah permasalahan yang kompleks dalam suatu struktur multi level dimana level pertama adalah tujuan, yang diikuti level faktor, kriteria, sub kriteria, dan seterusnya ke bawah hingga level terakhir dari alternatif.</p>
			
			<p>AHP membantu para pengambil keputusan untuk memperoleh solusi terbaik dengan mendekomposisi permasalahan kompleks ke dalam bentuk yang lebih sederhana untuk kemudian melakukan sintesis terhadap berbagai faktor yang terlibat dalam permasalahan pengambilan keputusan tersebut. AHP mempertimbangkan aspek kualitatif dan kuantitatif dari suatu keputusan dan mengurangi kompleksitas suatu keputusan dengan membuat perbandingan satu-satu dari berbagai kriteria yang dipilih untuk kemudian mengolah dan memperoleh hasilnya.</p>

			<p>AHP sering digunakan sebagai metode pemecahan masalah dibanding dengan metode yang lain karena alasan-alasan sebagai berikut :</p>

			<ol class="ui list">
				<li>Struktur yang berhirarki, sebagai konsekuesi dari kriteria yang  dipilih, sampai pada subkriteria yang paling dalam.</li>
				<li>Memperhitungkan validitas sampai dengan batas toleransi inkonsistensi berbagai kriteria dan alternatif yang dipilih oleh pengambil keputusan.</li>
				<li>Memperhitungkan daya tahan output analisis sensitivitas pengambilan keputusan.</li>
			</ol>

			<br>-->

		<div class="judul-hal">
			<i class="fas fa-home font-a" style="color: #b52a2a; margin-right: 8px; font-size: 28px;"></i>
			<h1 class="ui header" style="margin: 0;">Home</h1>
		</div>

		<div class="ucapan" style="margin-bottom: 16px">
			<h4>Selamat datang di sistem!</h4>
		</div>

		<div style="display:flex">
			<div class="tombol" onclick="window.location.href='kriteria.php';"
				style="margin-left: 0px; cursor: pointer;">
				<i class="fas fa-balance-scale font-a tombol-icon"></i>
				<div class="tombol-font">Kriteria</div>
			</div>
			<div class="tombol" onclick="window.location.href='alternatif.php';" style="cursor: pointer;">
				<i class="fas fa-boxes font-a tombol-icon"></i>
				<div class="tombol-font">Alternatif</div>
			</div>
			<div class="tombol" onclick="window.location.href='bobot_kriteria.php';"
				style="margin-right: 0px; cursor: pointer;">
				<i class="fas fa-cogs font-a tombol-icon"></i>
				<div class="tombol-font"> Perbandingan Kriteria</div>
			</div>
		</div>
		<div style="display:flex">
			<div class="tombol" onclick="window.location.href='bobot.php';" style="margin-left: 0px; cursor: pointer;">
				<i class="fas fa-tags font-a tombol-icon"></i>
				<div class="tombol-font">Perbandingan Alternatif</div>
			</div>
			<div class="tombol" onclick="window.location.href='hasil.php';" style="cursor: pointer;">
				<i class="fas fa-calculator font-a tombol-icon"></i>
				<div class="tombol-font">Hasil</div>
			</div>
			<div class="tombol" onclick='event.preventDefault(); logout();' style="margin-right: 0px; cursor: pointer;">
				<i class="fas fa-door-open font-a tombol-icon"></i>
				<div class="tombol-font">Keluar</div>
			</div>
		</div>

		<div class="judul-hal">
			<i class="fas fa-chart-line font-a" style="color: #b52a2a; margin-right: 8px; font-size: 23px;"></i>
			<h3 class="ui header" style="margin: 0;">Skala Prioritas Numerik</h>
		</div>

		<table class="ui collapsing striped blue table" style="width: 100%;">
			<thead>
				<tr>
					<th colspan="9" style="text-align:center;">Tingkat Kepentingan</th>
				</tr>
			</thead>
			<tbody>
				<tr style="line-height: 1.1;">
					<td class="center aligned">
						<h4 style="margin-bottom: 0;">1</h4>
						<br>
						Sama penting
					</td>
					<td class="center aligned">
						<h4 style="margin-bottom: 0;">2</h4>
						<br>
						Mendekati sedikit lebih penting

					</td>
					<td class="center aligned">
						<h4 style="margin-bottom: 0;">3</h4>
						<br>
						Sedikit lebih penting
					</td>
					<td class="center aligned">
						<h4 style="margin-bottom: 0;">4</h4>
						<br>
						Mendekati lebih penting
					</td>
					<td class="center aligned">
						<h4 style="margin-bottom: 0;">5</h4>
						<br>
						Lebih penting
					</td>
					<td class="center aligned">
						<h4 style="margin-bottom: 0;">6</h4>
						<br>
						Mendekati sangat penting
					</td>
					<td class="center aligned">
						<h4 style="margin-bottom: 0;">7</h4>
						<br>
						Sangat penting
					</td>
					<td class="center aligned">
						<h4 style="margin-bottom: 0;">8</h4>
						<br>
						Mendekati mutlak penting
					</td>
					<td class="center aligned">
						<h4 style="margin-bottom: 0;">9</h4>
						<br>
						Mutlak sangat penting
					</td>

				</tr>
			</tbody>
		</table>

		<!-- <hr style="margin: 2rem 0;"> -->

	</section>

</body>

</html>