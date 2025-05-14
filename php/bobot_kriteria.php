<!doctype html>
<html lang="en">

<head>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.8.2/css/all.min.css"
		integrity="sha512-rqQltXRuHxtPWhktpAZxLHUVJ3Eombn3hvk9PHjV/N5DMUYnzKPC1i3ub0mEXgFzsaZNeJcoE0YHq0j/GFsdGg=="
		crossorigin="anonymous" referrerpolicy="no-referrer" />
	<link rel="stylesheet" href="./css/style.css" />
</head>

<body>

	<?php
	include('config.php');
	include('fungsi.php');

	include('header.php');
	?>
	<section class="content">
		<div class="judul-hal" style="margin-bottom: 14px;">
			<i class="fas fa-cogs font-a" style="color: #b52a2a; margin-right: 8px; font-size: 28px; "></i>
			<h1 class="ui header" style="margin: 0;">Perbandingan Kriteria</h1>
		</div>
		<div class="ucapan3" style="margin-bottom: 32px;">
			<h4 style="font-weight: 500;">Isi nilai perbandingan dengan <strong>logika transitif</strong>. Dimana jika C1>C2 dan C2>C3, maka
				harus C1>C3. Dengan nilai C1>C3 mendekati C1>C2 x C2>C3</h4>
		</div>
		<div id="a">
			<?php showTabelPerbandingan('kriteria', 'kriteria'); ?>
		</div>
	</section>

</body>

</html>