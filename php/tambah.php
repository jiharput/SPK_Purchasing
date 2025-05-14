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

	// mendapatkan data edit
	if (isset($_GET['jenis'])) {
		$jenis = $_GET['jenis'];
	}

	if (isset($_POST['tambah'])) {
		$jenis = $_POST['jenis'];
		$nama = $_POST['nama'];

		tambahData($jenis, $nama);

		header('Location: ' . $jenis . '.php');
	}

	include('header.php');
	?>

	<section class="content">

		<div class="judul-hal" style="margin-bottom: 10px;">
			<i class="fas fa-list-alt font-a" style="color: #b52a2a; margin-right: 8px; font-size: 28px;"></i>
			<h1 style="margin: 0;">Tambah <?php echo $jenis ?></h1>
		</div>

		<div class="garis" style="margin-bottom: 25px; background: #b52a2a;"></div>

		<form class="ui form" method="post" action="tambah.php">
			<div class="inline field">
				<label>Nama <?php echo $jenis ?></label>
				<input type="text" name="nama" placeholder="<?php echo $jenis ?> baru">
				<input type="hidden" name="jenis" value="<?php echo $jenis ?>">
			</div>
			<br>
			<input class="ui green button" type="submit" name="tambah" value="SIMPAN">
		</form>
	</section>

</body>

</html>