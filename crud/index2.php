<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>INPUT DATA</title>
    <link rel="stylesheet" href=".css">
</head>
<body>

<header>
    <h1>Form Input Nilai</h1>
    <p>Masukkan Nilai Siswa</p>
    <nav>
        <ul>
            <li><a style="text-decoration: none;" href="../dashboard/siswa.php">Beranda</a></li>
            <li><a style="text-decoration: none;" href="../logout.php">Logout</a></li>
        </ul>
    </nav>
</header>

<?php
include "config.php";

$id_edit = "";
$nama_edit = "";
$nilai_harian_edit = "";
$ulangan_H1_edit = "";
$ulangan_H2_edit = "";
$nilai_SA_edit = "";
$mode_edit = false;

if (isset($_GET['edit'])) {
    $id_edit = $_GET['edit'];
    $query_edit = "SELECT * FROM nilais WHERE id = ?";
    $stmt_edit = mysqli_prepare($konek, $query_edit);
    mysqli_stmt_bind_param($stmt_edit, "s", $id_edit);
    mysqli_stmt_execute($stmt_edit);
    $result_edit = mysqli_stmt_get_result($stmt_edit);
    $data_edit = mysqli_fetch_assoc($result_edit);

    if ($data_edit) {
        $mode_edit = true;
        $nama_edit = $data_edit['nama'];
        $nilai_harian_edit = $data_edit['nilai_harian'];
        $ulangan_H1_edit = $data_edit['ulangan_H1'];
        $ulangan_H2_edit = $data_edit['ulangan_H2'];
        $nilai_SA_edit = $data_edit['nilai_SA'];
    }
    mysqli_stmt_close($stmt_edit);
}
?>

<h2><?= $mode_edit ? "Edit Data Siswa" : "Tambah Data Siswa" ?></h2>
<form method="POST" action="">
    <label for="tid">ID Siswa:</label>
    <input type="text" name="tid" id="tid" value="<?= $id_edit ?>" <?= $mode_edit ? 'readonly' : '' ?> required><br><br>

    <label for="tnama">Nama:</label>
    <input type="text" name="tnama" id="tnama" value="<?= $nama_edit ?>" required><br><br>

    <label for="tnilai_harian">Nilai Harian:</label>
    <input type="number" name="tnilai_harian" id="tnilai_harian" step="0.01" value="<?= $nilai_harian_edit ?>" required><br><br>

    <label for="tulangan_H1">Ulangan Harian 1:</label>
    <input type="number" name="tulangan_H1" id="tulangan_H1" step="0.01" value="<?= $ulangan_H1_edit ?>" required><br><br>

    <label for="tulangan_H2">Ulangan Harian 2:</label>
    <input type="number" name="tulangan_H2" id="tulangan_H2" step="0.01" value="<?= $ulangan_H2_edit ?>" required><br><br>

    <label for="tnilai_SA">Nilai Sumatif Akhir:</label>
    <input type="number" name="tnilai_SA" id="tnilai_SA" step="0.01" value="<?= $nilai_SA_edit ?>" required><br><br>

    <?php if ($mode_edit): ?>
        <button type="submit" name="tombolupdate">Update</button>
        <a href="index2.php" style="text-decoration: none; margin-left: 10px;">Batal</a>
    <?php else: ?>
        <button type="submit" name="tombolsimpan">Simpan</button>
    <?php endif; ?>
</form>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['tid'];
    $nama = $_POST['tnama'];
    $nilai_harian = $_POST['tnilai_harian'];
    $ulangan_H1 = $_POST['tulangan_H1'];
    $ulangan_H2 = $_POST['tulangan_H2'];
    $nilai_SA = $_POST['tnilai_SA'];

    if (!empty($id) && !empty($nama) && !empty($nilai_harian) && !empty($ulangan_H1) && !empty($ulangan_H2) && !empty($nilai_SA)) {
        $nilai_rata = ($nilai_harian + $ulangan_H1 + $ulangan_H2 + $nilai_SA) / 4;

        if (isset($_POST['tombolsimpan'])) {
            $query = "INSERT INTO nilais (id, nama, nilai_harian, ulangan_H1, ulangan_H2, nilai_SA, nilai_rata) VALUES (?, ?, ?, ?, ?, ?, ?)";
            $stmt = mysqli_prepare($konek, $query);
            mysqli_stmt_bind_param($stmt, "ssdddds", $id, $nama, $nilai_harian, $ulangan_H1, $ulangan_H2, $nilai_SA, $nilai_rata);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_close($stmt);
            echo "<script>window.location='index2.php';</script>";
        }

        if (isset($_POST['tombolupdate'])) {
            $query = "UPDATE nilais SET nama=?, nilai_harian=?, ulangan_H1=?, ulangan_H2=?, nilai_SA=?, nilai_rata=? WHERE id=?";
            $stmt = mysqli_prepare($konek, $query);
            mysqli_stmt_bind_param($stmt, "sddddss", $nama, $nilai_harian, $ulangan_H1, $ulangan_H2, $nilai_SA, $nilai_rata, $id);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_close($stmt);
            echo "<script>window.location='index2.php';</script>";
        }
    }
}

// Hapus Data
$hapus = @$_GET['delete'];
if(!empty($hapus)){
    $sql = mysqli_query($konek, "DELETE FROM nilais WHERE id = '$hapus'");
    if($sql){
        echo "<script>alert('Data berhasil dihapus'); document.location.href='index2.php';</script>";
    } else {
        echo "<script>alert('Gagal menghapus data');</script>";
    }
}
?>

<h2>Data Nilai Siswa</h2>
<table border="1">
    <tr>
        <th>ID</th>
        <th>Nama</th>
        <th>Nilai Harian</th>
        <th>Ulangan Harian 1</th>
        <th>Ulangan Harian 2</th>
        <th>Nilai Sumatif Akhir</th>
        <th>Nilai Rata-Rata</th>
        <th>Edit</th>
        <th>Delete</th>
    </tr>

    <?php
    $query = "SELECT * FROM nilais";
    $result = mysqli_query($konek, $query);

    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>";
        echo "<td>" . $row['id'] . "</td>";
        echo "<td>" . $row['nama'] . "</td>";
        echo "<td>" . $row['nilai_harian'] . "</td>";
        echo "<td>" . $row['ulangan_H1'] . "</td>";
        echo "<td>" . $row['ulangan_H2'] . "</td>";
        echo "<td>" . $row['nilai_SA'] . "</td>";
        echo "<td>" . $row['nilai_rata'] . "</td>";
  
        echo '<td>
        <a href="index2.php?edit=' . $row['id'] . '">
            <img src="../img/pulpen.png" width="30px" height="30px" alt="tombol edit">
        </a>
             </td>';
        echo '<td>
        <a href="?delete=' . $row['id'] . '" onclick="return confirm(\'Yakin ingin menghapus?\');">
            <img src="../img/buang.png" width="30px" height="30px" alt="tombol hapus">
        </a>
    </td>';
        echo "</tr>";
    }

    mysqli_close($konek);
    ?>
</table>

<!-- <footer>
    <p>&copy; 2025 by Kelompok 2</p>
</footer> -->

</body>
</html>
