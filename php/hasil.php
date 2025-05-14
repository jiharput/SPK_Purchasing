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


	// menghitung perangkingan
	$jmlKriteria = getJumlahKriteria();
	$jmlAlternatif = getJumlahAlternatif();
	$nilai = array();

	// mendapatkan nilai tiap alternatif
	for ($x = 0; $x <= ($jmlAlternatif - 1); $x++) {
		// inisialisasi
		$nilai[$x] = 0;

		for ($y = 0; $y <= ($jmlKriteria - 1); $y++) {
			$id_alternatif = getAlternatifID($x);
			$id_kriteria = getKriteriaID($y);

			$pv_alternatif = getAlternatifPV($id_alternatif, $id_kriteria);
			$pv_kriteria = getKriteriaPV($id_kriteria);

			$nilai[$x] += ($pv_alternatif * $pv_kriteria);
		}
	}

	// update nilai ranking
	for ($i = 0; $i <= ($jmlAlternatif - 1); $i++) {
		$id_alternatif = getAlternatifID($i);
		$query = "INSERT INTO ranking VALUES ($id_alternatif,$nilai[$i]) ON DUPLICATE KEY UPDATE nilai=$nilai[$i]";
		$result = mysqli_query($koneksi, $query);
		if (!$result) {
			echo "Gagal mengupdate ranking";
			exit();
		}
	}

	include('header.php');

	?>

	<section class="content">
		<div class="judul-hal">
			<i class="fas fa-calculator font-a" style="color: #b52a2a; margin-right: 8px; font-size: 28px;"></i>
			<h1 style="margin: 0;">Hasil</h1>
		</div>

		<div class="ucapan2" style="margin-bottom: 32px;">
			<h4 style="font-weight: 500;">Berikut hasil perhitungan berdasarkan data yang Anda masukkan</h4>
		</div>

		<div class="judul-hal">
			<i class="fas fa-square-root-alt font-a" style="color: #b52a2a; margin-right: 8px; font-size: 24px;"></i>
			<h2 class="ui header" style="margin: 0;">Hasil Perhitungan</h2>
		</div>

		<div>
			<table id="d" class="ui celled table">
				<thead>
					<tr>
						<th>Overall Composite Height</th>
						<th>Priority Vector (rata-rata)</th>
						<?php
						for ($i = 0; $i <= (getJumlahAlternatif() - 1); $i++) {
							echo "<th>" . getAlternatifNama($i) . "</th>\n";
						}
						?>
					</tr>
				</thead>
				<tbody>
					<?php
					for ($x = 0; $x <= (getJumlahKriteria() - 1); $x++) {
						echo "<tr>";
						echo "<td>" . getKriteriaNama($x) . "</td>";
						echo "<td>" . round(getKriteriaPV(getKriteriaID($x)), precision: 3) . "</td>";

						for ($y = 0; $y <= (getJumlahAlternatif() - 1); $y++) {
							echo "<td>" . round(getAlternatifPV(getAlternatifID($y), getKriteriaID($x)), 3) . "</td>";
						}


						echo "</tr>";
					}
					?>
				</tbody>

				<tfoot>
					<tr>
						<th colspan="2" style="font-weight: 600; text-align: center;">Total</th>
						<?php
						for ($i = 0; $i <= ($jmlAlternatif - 1); $i++) {
							echo "<th style='text-align: left;'>" . round($nilai[$i], precision: 3) . "</th>";
						}
						?>
					</tr>
				</tfoot>
			</table>
		</div>

		<div class="rangking-wrap" style="margin-top: 45px;">
			<div class="judul-hal" style="margin-top: 0px;">
				<i class="fas fa-star font-a" style="color: #b52a2a; margin-right: 8px; font-size: 24px;"></i>
				<h2 class="ui header" style="margin: 0;">Perangkingan</h>
			</div>

			<table id="c" class="ui celled collapsing table">
				<thead>
					<tr>
						<th>Peringkat</th>
						<th>Alternatif</th>
						<th>Nilai</th>
					</tr>
				</thead>
				<tbody>
					<?php
					$query = "SELECT id,nama,id_alternatif,nilai FROM alternatif,ranking WHERE alternatif.id = ranking.id_alternatif ORDER BY nilai DESC";
					$result = mysqli_query($koneksi, $query);

					$i = 0;
					while ($row = mysqli_fetch_array($result)) {
						$i++;
						?>
						<tr>
							<div>
								<?php if ($i == 1) {
									echo "<td><div class=\"ui ribbon label\">Pertama</div></td>";
								} else {
									echo "<td>" . $i . "</td>";
								}
								?>
							</div>

							<td><?php echo $row['nama'] ?></td>
							<td><?php echo number_format($row['nilai'], 3); ?></td>
							<!-- round($nilai[$i], precision: 3) -->
						</tr>

						<?php
					}
					?>
				</tbody>
			</table>
		</div>
	</section>

</body>

</html>