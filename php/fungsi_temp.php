<?php

// mencari ID kriteria
// berdasarkan urutan ke berapa (C1, C2, C3)
function getKriteriaID($no_urut)
{
    include('config.php');
    $query = "SELECT id FROM kriteria ORDER BY id";
    $result = mysqli_query($koneksi, $query);
    $listID = [];

    while ($row = mysqli_fetch_array($result)) {
        $listID[] = $row['id'];
    }

    // Validasi indeks
    if ($no_urut < 0 || $no_urut >= count($listID)) {
        return null; // atau throw exception
    }

    return $listID[$no_urut];
}

// mencari ID alternatif
// berdasarkan urutan ke berapa (A1, A2, A3)
function getAlternatifID($no_urut)
{
    include('config.php');
    $query = "SELECT id FROM alternatif ORDER BY id";
    $result = mysqli_query($koneksi, $query);
    $listID = [];

    while ($row = mysqli_fetch_array($result)) {
        $listID[] = $row['id'];
    }

    // Validasi indeks
    if ($no_urut < 0 || $no_urut >= count($listID)) {
        return null; // atau throw exception
    }

    return $listID[$no_urut];
}

// mencari nama kriteria
function getKriteriaNama($no_urut)
{
    include('config.php');
    $query = "SELECT nama FROM kriteria ORDER BY id";
    $result = mysqli_query($koneksi, $query);
    $nama = [];

    while ($row = mysqli_fetch_array($result)) {
        $nama[] = $row['nama'];
    }

    // Validasi indeks
    if ($no_urut < 0 || $no_urut >= count($nama)) {
        return null; // atau throw exception
    }

    return $nama[$no_urut];
}

// mencari nama alternatif
function getAlternatifNama($no_urut)
{
    include('config.php');
    $query = "SELECT nama FROM alternatif ORDER BY id";
    $result = mysqli_query($koneksi, $query);
    $nama = [];

    while ($row = mysqli_fetch_array($result)) {
        $nama[] = $row['nama'];
    }

    // Validasi indeks
    if ($no_urut < 0 || $no_urut >= count($nama)) {
        return null; // atau throw exception
    }

    return $nama[$no_urut];
}

// mencari priority vector alternatif
function getAlternatifPV($id_alternatif, $id_kriteria)
{
    include('config.php');
    $query = "SELECT nilai FROM pv_alternatif WHERE id_alternatif=$id_alternatif AND id_kriteria=$id_kriteria";
    $result = mysqli_query($koneksi, $query);

    if ($row = mysqli_fetch_array($result)) {
        return $row['nilai'];
    }

    return null; // Mengembalikan null jika tidak ada nilai
}

// mencari priority vector kriteria
function getKriteriaPV($id_kriteria)
{
    include('config.php');
    $query = "SELECT nilai FROM pv_kriteria WHERE id_kriteria=$id_kriteria";
    $result = mysqli_query($koneksi, $query);

    if ($row = mysqli_fetch_array($result)) {
        return $row['nilai'];
    }

    return null; // Mengembalikan null jika tidak ada nilai
}

// mencari jumlah alternatif
function getJumlahAlternatif()
{
    include('config.php');
    $query = "SELECT count(*) FROM alternatif";
    $result = mysqli_query($koneksi, $query);
    $jmlData = mysqli_fetch_array($result)[0];

    return $jmlData;
}

// mencari jumlah kriteria
function getJumlahKriteria()
{
    include('config.php');
    $query = "SELECT count(*) FROM kriteria";
    $result = mysqli_query($koneksi, $query);
    $jmlData = mysqli_fetch_array($result)[0];

    return $jmlData;
}

// menambah data kriteria / alternatif
function tambahData($tabel, $nama)
{
    include('config.php');
    $nama = mysqli_real_escape_string($koneksi, $nama); // Sanitasi input

    $query = "INSERT INTO $tabel (nama) VALUES ('$nama')";
    $tambah = mysqli_query($koneksi, $query);

    if (!$tambah) {
        echo "Gagal menambah data " . $tabel;
        exit();
    }
}

// hapus kriteria
function deleteKriteria($id)
{
    include('config.php');

    // Hapus record dari tabel kriteria
    $query = "DELETE FROM kriteria WHERE id=$id";
    if (!mysqli_query($koneksi, $query)) {
        echo "Gagal menghapus kriteria: " . mysqli_error($koneksi);
        return;
    }

    // Hapus record dari tabel lainnya
    $queries = [
        "DELETE FROM pv_kriteria WHERE id_kriteria=$id",
        "DELETE FROM pv_alternatif WHERE id_kriteria=$id",
        "DELETE FROM perbandingan_kriteria WHERE kriteria1=$id OR kriteria2=$id",
        "DELETE FROM perbandingan_alternatif WHERE pembanding=$id"
    ];

    foreach ($queries as $query) {
        if (!mysqli_query($koneksi, $query)) {
            echo "Gagal menghapus data terkait: " . mysqli_error($koneksi);
            return;
        }
    }
}

// hapus alternatif
function deleteAlternatif($id)
{
    include('config.php');

    // hapus record dari tabel alternatif
    $query = "DELETE FROM alternatif WHERE id=$id";
    mysqli_query($koneksi, $query);

    // hapus record dari tabel pv_alternatif
    $query = "DELETE FROM pv_alternatif WHERE id_alternatif=$id";
    mysqli_query($koneksi, $query);

    // hapus record dari tabel ranking
    $query = "DELETE FROM ranking WHERE id_alternatif=$id";
    mysqli_query($koneksi, $query);

    $query = "DELETE FROM perbandingan_alternatif WHERE alternatif1=$id OR alternatif2=$id";
    mysqli_query($koneksi, $query);
}

// memasukkan nilai priority vektor kriteria
function inputKriteriaPV($id_kriteria, $pv)
{
    include('config.php');

    $query = "SELECT * FROM pv_kriteria WHERE id_kriteria=$id_kriteria";
    $result = mysqli_query($koneksi, $query);

    if (!$result) {
        echo "Error !!!";
        exit();
    }

    // jika result kosong maka masukkan data baru
    // jika telah ada maka diupdate
    if (mysqli_num_rows($result) == 0) {
        $query = "INSERT INTO pv_kriteria (id_kriteria, nilai) VALUES ($id_kriteria, $pv)";
    } else {
        $query = "UPDATE pv_kriteria SET nilai=$pv WHERE id_kriteria=$id_kriteria";
    }

    $result = mysqli_query($koneksi, $query);
    if (!$result) {
        echo "Gagal memasukkan / update nilai priority vector kriteria";
        exit();
    }
}

// memasukkan nilai priority vektor alternatif
function inputAlternatifPV($id_alternatif, $id_kriteria, $pv)
{
    include('config.php');

    $query = "SELECT * FROM pv_alternatif WHERE id_alternatif = $id_alternatif AND id_kriteria = $id_kriteria";
    $result = mysqli_query($koneksi, $query);

    if (!$result) {
        echo "Error !!!";
        exit();
    }

    // jika result kosong maka masukkan data baru
    // jika telah ada maka diupdate
    if (mysqli_num_rows($result) == 0) {
        $query = "INSERT INTO pv_alternatif (id_alternatif, id_kriteria, nilai) VALUES ($id_alternatif, $id_kriteria, $pv)";
    } else {
        $query = "UPDATE pv_alternatif SET nilai=$pv WHERE id_alternatif=$id_alternatif AND id_kriteria=$id_kriteria";
    }

    $result = mysqli_query($koneksi, $query);
    if (!$result) {
        echo "Gagal memasukkan / update nilai priority vector alternatif";
        exit();
    }
}

// memasukkan bobot nilai perbandingan kriteria
function inputDataPerbandinganKriteria($kriteria1, $kriteria2, $nilai)
{
    include('config.php');

    $id_kriteria1 = getKriteriaID($kriteria1);
    $id_kriteria2 = getKriteriaID($kriteria2);

    if ($id_kriteria1 === null || $id_kriteria2 === null) {
        echo "Kriteria tidak valid.";
        return;
    }

    $query = "SELECT * FROM perbandingan_kriteria WHERE kriteria1 = $id_kriteria1 AND kriteria2 = $id_kriteria2";
    $result = mysqli_query($koneksi, $query);

    if (!$result) {
        echo "Error dalam query: " . mysqli_error($koneksi);
        exit();
    }

    if (mysqli_num_rows($result) == 0) {
        $query = "INSERT INTO perbandingan_kriteria (kriteria1, kriteria2, nilai) VALUES ($id_kriteria1, $id_kriteria2, $nilai)";
    } else {
        $query = "UPDATE perbandingan_kriteria SET nilai=$nilai WHERE kriteria1=$id_kriteria1 AND kriteria2=$id_kriteria2";
    }

    $result = mysqli_query($koneksi, $query);
    if (!$result) {
        echo "Gagal memasukkan data perbandingan: " . mysqli_error($koneksi);
        exit();
    }
}

// memasukkan bobot nilai perbandingan alternatif
function inputDataPerbandinganAlternatif($alternatif1, $alternatif2, $pembanding, $nilai)
{
    include('config.php');

    $id_alternatif1 = getAlternatifID($alternatif1);
    $id_alternatif2 = getAlternatifID($alternatif2);
    $id_pembanding = getKriteriaID($pembanding);

    if ($id_alternatif1 === null || $id_alternatif2 === null || $id_pembanding === null) {
        echo "Alternatif atau kriteria tidak valid.";
        return;
    }

    $query = "SELECT * FROM perbandingan_alternatif WHERE alternatif1 = $id_alternatif1 AND alternatif2 = $id_alternatif2 AND pembanding = $id_pembanding";
    $result = mysqli_query($koneksi, $query);

    if (!$result) {
        echo "Error !!!";
        exit();
    }

    // jika result kosong maka masukkan data baru
    // jika telah ada maka diupdate
    if (mysqli_num_rows($result) == 0) {
        $query = "INSERT INTO perbandingan_alternatif (alternatif1, alternatif2, pembanding, nilai) VALUES ($id_alternatif1, $id_alternatif2, $id_pembanding, $nilai)";
    } else {
        $query = "UPDATE perbandingan_alternatif SET nilai=$nilai WHERE alternatif1=$id_alternatif1 AND alternatif2=$id_alternatif2 AND pembanding=$id_pembanding";
    }

    $result = mysqli_query($koneksi, $query);
    if (!$result) {
        echo "Gagal memasukkan data perbandingan: " . mysqli_error($koneksi);
        exit();
    }
}

// mencari nilai bobot perbandingan kriteria
function getNilaiPerbandinganKriteria($kriteria1, $kriteria2)
{
    include('config.php');

    $id_kriteria1 = getKriteriaID($kriteria1);
    $id_kriteria2 = getKriteriaID($kriteria2);

    if ($id_kriteria1 === null || $id_kriteria2 === null) {
        return 1; // Mengembalikan nilai default jika kriteria tidak valid
    }

    $query = "SELECT nilai FROM perbandingan_kriteria WHERE kriteria1 = $id_kriteria1 AND kriteria2 = $id_kriteria2";
    $result = mysqli_query($koneksi, $query);

    if (!$result) {
        echo "Error !!!";
        exit();
    }

    if (mysqli_num_rows($result) == 0) {
        return 1; // Mengembalikan nilai default jika tidak ada data
    } else {
        while ($row = mysqli_fetch_array($result)) {
            return $row['nilai'];
        }
    }
}

// mencari nilai bobot perbandingan alternatif
function getNilaiPerbandinganAlternatif($alternatif1, $alternatif2, $pembanding)
{
    include('config.php');

    $id_alternatif1 = getAlternatifID($alternatif1);
    $id_alternatif2 = getAlternatifID($alternatif2);
    $id_pembanding = getKriteriaID($pembanding);

    if ($id_alternatif1 === null || $id_alternatif2 === null || $id_pembanding === null) {
        return 1; // Mengembalikan nilai default jika alternatif atau kriteria tidak valid
    }

    $query = "SELECT nilai FROM perbandingan_alternatif WHERE alternatif1 = $id_alternatif1 AND alternatif2 = $id_alternatif2 AND pembanding = $id_pembanding";
    $result = mysqli_query($koneksi, $query);

    if (!$result) {
        echo "Error !!!";
        exit();
    }

    if (mysqli_num_rows($result) == 0) {
        return 1; // Mengembalikan nilai default jika tidak ada data
    } else {
        while ($row = mysqli_fetch_array($result)) {
            return $row['nilai'];
        }
    }
}

// menampilkan nilai IR
function getNilaiIR($jmlKriteria)
{
    include('config.php');
    $query = "SELECT nilai FROM ir WHERE jumlah=$jmlKriteria";
    $result = mysqli_query($koneksi, $query);
    while ($row = mysqli_fetch_array($result)) {
        $nilaiIR = $row['nilai'];
    }

    return $nilaiIR;
}

// mencari Principe Eigen Vector (λ maks)
function getEigenVector($matrik_a, $matrik_b, $n)
{
    $eigenvektor = 0;
    for ($i = 0; $i <= ($n - 1); $i++) {
        $eigenvektor += ($matrik_a[$i] * (($matrik_b[$i]) / $n));
    }

    return $eigenvektor;
}

// mencari Cons Index
function getConsIndex($matrik_a, $matrik_b, $n)
{
    $eigenvektor = getEigenVector($matrik_a, $matrik_b, $n);
    $consindex = ($eigenvektor - $n) / ($n - 1);

    return $consindex;
}

// Mencari Consistency Ratio
function getConsRatio($matrik_a, $matrik_b, $n)
{
    $consindex = getConsIndex($matrik_a, $matrik_b, $n);
    $consratio = $consindex / getNilaiIR($n);

    return $consratio;
}

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
                                        <input name="pilih<?php echo $urut ?>" value="1" checked="" class="" type="radio">
                                        <label><?php echo $pilihan[$x]; ?></label>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="field">
                                    <div class="ui radio checkbox">
                                        <input name="pilih<?php echo $urut ?>" value="2" class="" type="radio">
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

                                    <?php
                                    if ($kriteria == 'kriteria') {
                                        $nilai = getNilaiPerbandinganKriteria($x, $y);
                                    } else {
                                        $nilai = getNilaiPerbandinganAlternatif($x, $y, ($jenis - 1));
                                    }

                                    ?>

                                    <?php
                                    $keterangan = [
                                        1 => "Sama penting",
                                        2 => "Mendekati sedikit lebih penting",
                                        3 => "Sedikit lebih penting",
                                        4 => "Mendekati lebih penting",
                                        5 => "Lebih penting",
                                        6 => "Mendekati sangat penting",
                                        7 => "Sangat penting",
                                        8 => "Mendekati mutlak penting",
                                        9 => "Mutlak sangat penting"
                                    ];

                                    $teks = isset($keterangan[$nilai]) ? $keterangan[$nilai] : "Tidak diketahui";
                                    ?>

                                    <p style="color: #b5b5b5; font-weight: bold;">
                                        Nilai terpilih: <?= $nilai . " - " . $teks ?>
                                    </p>

                                    <select name="bobot<?php echo $urut ?>" required>
                                        <option value="<?php echo $nilai ?>" selected></option>
                                        <option value="1">1 - Sama penting</option>
                                        <option value="2">2 - Mendekati sedikit lebih penting</option>
                                        <option value="3">3 - Sedikit lebih penting</option>
                                        <option value="4">4 - Mendekati lebih penting</option>
                                        <option value="5">5 - Lebih penting</option>
                                        <option value="6">6 - Mendekati sangat penting</option>
                                        <option value="7">7 - Sangat penting</option>
                                        <option value="8">8 - Mendekati mutlak penting</option>
                                        <option value="9">9 - Mutlak sangat penting</option>
                                    </select>
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