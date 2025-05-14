<!doctype html>
<html lang="en">

<head>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.8.2/css/all.min.css"
		integrity="sha512-rqQltXRuHxtPWhktpAZxLHUVJ3Eombn3hvk9PHjV/N5DMUYnzKPC1i3ub0mEXgFzsaZNeJcoE0YHq0j/GFsdGg=="
		crossorigin="anonymous" referrerpolicy="no-referrer" />
	<link rel="stylesheet" href="./css/style.css" />
</head>

<body></body>

<?php
include('config.php');
include('fungsi.php');

$jenis = $_GET['c'];

include('header.php');
?>
<section class="content">
	<div class="judul-hal" style="margin-bottom: 14px;">
		<i class="fas fa-tags font-a" style="color: #b52a2a; margin-right: 8px; font-size: 28px;"></i>
		<h1 class="ui header" style="margin: 0; color:#a7160c;">
			<div style="color:black; display:inline;">Perbandingan Alternatif <i
					class="fas fa-arrow-right logo-bobot"></i></div> <?php echo getKriteriaNama($jenis - 1) ?>
		</h1>
	</div>
	<div class="ucapan3" style="margin-bottom: 32px;">
		<h4 style="font-weight: 500;">Isi nilai perbandingan dengan <strong>logika transitif</strong>. Dimana jika A1>A2 dan A2>A3, maka
		harus A1>A3. Dengan nilai A1>A3 mendekati A1>A2 x A2>A3</h4>
	</div>
	<div id="b">
		<?php showTabelPerbandingan($jenis, 'alternatif'); ?>
	</div>
</section>

</body>

</html>