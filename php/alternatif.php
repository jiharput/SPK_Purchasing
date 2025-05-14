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

	// menjalankan perintah edit
	if (isset($_POST['edit'])) {
		$id = $_POST['id'];

		header('Location: edit.php?jenis=alternatif&id=' . $id);
		exit();
	}

	// menjalankan perintah delete
	if (isset($_POST['delete'])) {
		$id = $_POST['id'];
		deleteAlternatif($id);
	}

	// menjalankan perintah tambah
	if (isset($_POST['tambah'])) {
		$nama = $_POST['nama'];
		tambahData('alternatif', $nama);
	}

	include('header.php');

	?>


	<section class="content">

		<div class="judul-hal">
			<i class="fas fa-boxes font-a" style="color: #b52a2a; margin-right: 8px; font-size: 28px;"></i>
			<h1 class="ui header" style="margin: 0;">Alternatif</h1>
		</div>

		<table class="ui celled table">
			<thead>
				<tr>
					<th class="collapsing">No</th>
					<th colspan="2">Nama Alternatif</th>
				</tr>
			</thead>
			<tbody>

				<?php
				// Menampilkan list alternatif
				$query = "SELECT id,nama FROM alternatif ORDER BY id";
				$result = mysqli_query($koneksi, $query);

				$i = 0;
				while ($row = mysqli_fetch_array($result)) {
					$i++;
					?>
					<tr>
						<td><?php echo $i ?></td>
						<td><?php echo $row['nama'] ?></td>
						<td class="right aligned collapsing">
							<form method="post" action="alternatif.php">
								<input type="hidden" name="id" value="<?php echo $row['id'] ?>">
								<button type="submit" name="edit" class="ui mini teal left labeled icon button"><i
										class="right edit icon"></i>EDIT</button>
								<button type="submit" name="delete" class="ui mini red left labeled icon button"><i
										class="right remove icon"></i>DELETE</button>
							</form>
						</td>
					</tr>

				<?php } ?>

			</tbody>
			<tfoot class="full-width">
				<tr>
					<th colspan="3">
						<a href="tambah.php?jenis=alternatif">
							<div class="ui right floated small primary labeled icon button">
								<i class="plus icon"></i>Tambah
							</div>
						</a>
					</th>
				</tr>
			</tfoot>
		</table>

		<br>


		<form action="bobot_kriteria.php">
			<button class="ui right labeled icon button" style="float: right;">
				<i class="right arrow icon"></i>
				Lanjut
			</button>
		</form>
	</section>

</body>

</html>