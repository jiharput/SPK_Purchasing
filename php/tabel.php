<?php

// menampilkan tabel perbandingan bobot
function showTabelPerbandingan($jenis, $kriteria)
{
    include('config.php');

    if ($kriteria == 'kriteria') {
        $n = getJumlahKriteria();
    } else {
        $n = getJumlahAlternatif();
    }

    $query = "SELECT nama FROM $kriteria ORDER BY id";
    $result = mysqli_query($koneksi, $query);
    if (!$result) {
        echo "Error koneksi database!!!";
        exit();
    }

    // buat list nama pilihan
    while ($row = mysqli_fetch_array($result)) {
        $pilihan[] = $row['nama'];
    }

    // tampilkan tabel
    ?>

    <form class="ui form" action="proses.php" method="post">
        <table class="ui celled selectable collapsing table">
            <thead>
                <tr>
                    <th colspan="2">pilih yang lebih penting</th>
                    <th>nilai perbandingan</th>
                </tr>
            </thead>
            <tbody>

                <?php

                //inisialisasi
                $urut = 0;

                for ($x = 0; $x <= ($n - 2); $x++) {
                    for ($y = ($x + 1); $y <= ($n - 1); $y++) {

                        $urut++;

                        ?>
                        <tr>
                            <td>
                                <div class="field">
                                    <div class="ui radio checkbox">
                                        <input name="pilih<?php echo $urut ?>" value="1" checked="" class="hidden" type="radio">
                                        <label><?php echo $pilihan[$x]; ?></label>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="field">
                                    <div class="ui radio checkbox">
                                        <input name="pilih<?php echo $urut ?>" value="2" class="hidden" type="radio">
                                        <label><?php echo $pilihan[$y]; ?></label>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="field">

                                    <?php
                                    if ($kriteria == 'kriteria') {
                                        $nilai = getNilaiPerbandinganKriteria($x, $y);
                                    } else {
                                        $nilai = getNilaiPerbandinganAlternatif($x, $y, ($jenis - 1));
                                    }

                                    ?>
                                    <input type="text" name="bobot<?php echo $urut ?>" value="<?php echo $nilai ?>" required>
                                </div>
                            </td>
                        </tr>
                        <?php
                    }
                }
                ?>
            </tbody>
        </table>
        <input type="text" name="jenis" value="<?php echo $jenis; ?>" hidden>
        <br><br><input class="ui submit button" type="submit" name="submit" value="SUBMIT">
    </form>

    <?php
}







?>