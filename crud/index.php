<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>DATA NILAI</title>
 <link rel="stylesheet" href="tele.css">
</head>
<body>

<header>
    <h1>Form Data Nilai</h1>
    <nav>
        <ul>
            <li><a style="text-decoration: none;" href="../dashboard/siswa.php">Beranda</a></li>
            <li><a style="text-decoration: none;" href="../logout.php">Logout</a></li>
        </ul>
    </nav>
</header>

<?php
include "config.php";
// Ambil nilai dari form
$id = @$_POST['tid'];
$nama = @$_POST['tnama'];
$nilai_harian = @$_POST['tnilai_harian'];
$ulangan_H1 = @$_POST['tulangan_H1'];
$ulangan_H2 = @$_POST['tulangan_H2'];
$nilai_SA = @$_POST['tnilai_SA'];
$nilai_rata = @$_POST['tnilai_rata'];

$simpan = @$_POST['tombolsimpan'];
$update = @$_POST['tombolupdate'];
?>
<br>

<table>
    <tr>
        <th>ID</th>
        <th>Nama</th>
        <th>Nilai Harian</th>
        <th>Nilai H1</th>
        <th>Nilai H2</th>
        <th>Nilai SA</th>
        <th>Nilai Rata-Rata</th>
    </tr>
    <?php
    $panggil = mysqli_query($konek, "SELECT * FROM nilais WHERE `id` =?");
    while($data = mysqli_fetch_array($panggil)){
        ?>
        <tr>
            <td><?php echo $data['id']; ?></td>
            <td><?php echo $data['nama']; ?></td>
            <td><?php echo $data['nilai_harian']; ?></td>
            <td><?php echo $data['ulangan_H1']; ?></td>
            <td><?php echo $data['ulangan_H2']; ?></td>
            <td><?php echo $data['nilai_SA']; ?></td>
            <td><?php echo $data['nilai_rata']; ?></td>
       
        </tr>
        <?php
    }
    ?>
</table>

<footer>
    <p>&copy; 2025 by Kelompok 2</p>
</footer>

</body>
</html>
