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
	if (isset($_GET['jenis']) && isset($_GET['id'])) {
		$id = $_GET['id'];
		$jenis = $_GET['jenis'];

		// hapus record
		$query = "SELECT nama FROM $jenis WHERE id=$id";
		$result = mysqli_query($koneksi, $query);

		while ($row = mysqli_fetch_array($result)) {
			$nama = $row['nama'];
		}
	}

	if (isset($_POST['update'])) {
		$id = $_POST['id'];
		$jenis = $_POST['jenis'];
		$nama = $_POST['nama'];

		$query = "UPDATE $jenis SET nama='$nama' WHERE id=$id";
		$result = mysqli_query($koneksi, $query);

		if (!$result) {
			echo "Update gagal";
			exit();
		} else {
			header('Location: ' . $jenis . '.php');
			exit();
		}
	}

	include('header.php');
	?>

	<section class="content">
		<div class="judul-hal" style="margin-bottom: 10px;">
			<i class="fas fa-edit font-a" style="color: #b52a2a; margin-right: 8px; font-size: 28px;"></i>
			<h1 style="margin: 0;">Edit <?php echo $jenis ?></h1>
		</div>

		<div class="garis" style="margin-bottom: 25px; background: #b52a2a;"></div>

		<form class="ui form" method="post" action="edit.php">
			<div class="inline field">
				<label>Nama <?php echo $jenis ?></label>
				<input type="text" name="nama" value="<?php echo $nama ?>">
				<input type="hidden" name="id" value="<?php echo $id ?>">
				<input type="hidden" name="jenis" value="<?php echo $jenis ?>">
			</div>
			<br>
			<input class="ui green button" type="submit" name="update" value="UPDATE">
		</form>
	</section>

</body>

</html>