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
	include('header.php');

	?>

	<section class="content">
		<div class="judul-hal">
			<i class="fas fa-table font-a" style="color: #b52a2a; margin-right: 8px; font-size: 28px;"></i>
			<h1 style="margin: 0;">Matriks</h1>
		</div>

		<div class="garis"></div>

		<div class="judul-hal">
			<i class="fas fa-network-wired font-a" style="color: #b52a2a; margin-right: 8px; font-size: 24px;"></i>
			<h2 class="ui header" style="margin: 0;">Matriks Perbandingan Berpasangan</h2>
		</div>

		<table class="ui collapsing celled blue table" style="width: 100%;">
			<thead>
				<tr>
					<th>Kriteria</th>
					<?php
					for ($i = 0; $i <= ($n - 1); $i++) {
						echo "<th>" . getKriteriaNama($i) . "</th>";
					}
					?>
				</tr>
			</thead>
			<tbody>
				<?php
				for ($x = 0; $x <= ($n - 1); $x++) {
					echo "<tr>";
					echo "<td>" . getKriteriaNama($x) . "</td>";
					for ($y = 0; $y <= ($n - 1); $y++) {
						echo "<td>" . round($matrik[$x][$y], 5) . "</td>";
					}

					echo "</tr>";
				}
				?>
			</tbody>
			<tfoot>
				<tr>
					<th>Jumlah</th>
					<?php
					for ($i = 0; $i <= ($n - 1); $i++) {
						echo "<th>" . round($jmlmpb[$i], 5) . "</th>";
					}
					?>
				</tr>
			</tfoot>
		</table>


		<br>

		<div class="judul-hal" style="margin-top: 0px;">
			<i class="fas fa-ruler-combined font-a" style="color: #b52a2a; margin-right: 8px; font-size: 24px;"></i>
			<h2 class="ui header" style="margin: 0;">Matriks Nilai Kriteria</h2>
		</div>
		<table class="ui celled red table">
			<thead>
				<tr>
					<th>Kriteria</th>
					<?php
					for ($i = 0; $i <= ($n - 1); $i++) {
						echo "<th>" . getKriteriaNama($i) . "</th>";
					}
					?>
					<th>Jumlah</th>
					<th>Priority Vector</th>
				</tr>
			</thead>
			<tbody>
				<?php
				for ($x = 0; $x <= ($n - 1); $x++) {
					echo "<tr>";
					echo "<td>" . getKriteriaNama($x) . "</td>";
					for ($y = 0; $y <= ($n - 1); $y++) {
						echo "<td>" . round($matrikb[$x][$y], 5) . "</td>";
					}

					echo "<td>" . round($jmlmnk[$x], 5) . "</td>";
					echo "<td>" . round($pv[$x], 5) . "</td>";

					echo "</tr>";
				}
				?>

			</tbody>
			<tfoot>
				<tr>
					<th colspan="<?php echo ($n + 2) ?>">Principe Eigen Vector (λ maks)</th>
					<th><?php echo (round($eigenvektor, 5)) ?></th>
				</tr>
				<tr>
					<th colspan="<?php echo ($n + 2) ?>">Consistency Index</th>
					<th><?php echo (round($consIndex, 5)) ?></th>
				</tr>
				<tr>
					<th colspan="<?php echo ($n + 2) ?>">Consistency Ratio</th>
					<th><?php echo (round(($consRatio * 100), 2)) ?> %</th>
				</tr>
			</tfoot>
		</table>

		<?php
		if ($consRatio > 0.1) {
			?>
			<div class="ui icon red message">
				<i class="close icon"></i>
				<i class="warning circle icon"></i>
				<div class="content">
					<div class="header">
						Nilai Consistency Ratio melebihi 10% !!!
					</div>
					<p>Mohon input kembali tabel perbandingan...</p>
				</div>
			</div>

			<br>

			<a href='javascript:history.back()'>
				<button class="ui left labeled icon button">
					<i class="left arrow icon"></i>
					Kembali
				</button>
			</a>

			<?php
		} else {

			?>
			<br>

			<a href="bobot.php?c=1">
				<button class="ui right labeled icon button" style="float: right;">
					<i class="right arrow icon"></i>
					Lanjut
				</button>
			</a>

			<?php
		}
		echo "</section>";
		?>

</body>

</html>