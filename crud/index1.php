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

// Ambil nilai dari form
$id = @$_POST['tid'];
$nama = @$_POST['tnama'];
$nilai_harian = @$_POST['tnilai_harian'];
$ulangan_H1 = @$_POST['tulangan_H1'];
$ulangan_H2 = @$_POST['tulangan_H2'];
$nilai_SA = @$_POST['tnilai_SA'];
$simpan = @$_POST['tombolsimpan'];
$update = @$_POST['tombolupdate'];

// Hitung nilai rata-rata otomatis
$nilai_rata = ($nilai_harian + $ulangan_H1 + $ulangan_H2 + $nilai_SA) / 4;

// Simpan Data
if(isset($simpan)){
    $masuk = mysqli_query($konek, "INSERT INTO nilais (id,nama, nilai_harian, ulangan_H1, ulangan_H2, nilai_SA, nilai_rata) 
                                   VALUES ('$id','$nama', '$nilai_harian', '$ulangan_H1', '$ulangan_H2', '$nilai_SA', '$nilai_rata')");
    if($masuk){
        echo "<script>alert('Data berhasil disimpan'); document.location.href='index1.php';</script>";
    } else {
        echo "<script>alert('Gagal menyimpan data');</script>";
    }
}

// Hapus Data
$hapus = @$_GET['delete'];
if(!empty($hapus)){
    $sql = mysqli_query($konek, "DELETE FROM nilais WHERE id = '$hapus'");
    if($sql){
        echo "<script>alert('Data berhasil dihapus'); document.location.href='index1.php';</script>";
    } else {
        echo "<script>alert('Gagal menghapus data');</script>";
    }
}

// Edit Data
$getID = @$_GET['id'];
$tombolEdit = @$_GET['edit'];
if(isset($tombolEdit)){
    $edit = mysqli_query($konek, "SELECT * FROM nilais WHERE id = '$getID'");
    $data = mysqli_fetch_array($edit);
    $id = $data['id'];
    $nama = $data['nama'];
    $nilai_harian = $data['nilai_harian'];
    $ulangan_H1 = $data['ulangan_H1'];
    $ulangan_H2 = $data['ulangan_H2'];
    $nilai_SA = $data['nilai_SA'];
    $nilai_rata = $data['nilai_rata'];
    if($edit){
        echo "<script>alert('$getID');</script>";

    }
}

// Update Data
if(isset($update)){
    
    $nilai_rata = ($nilai_harian + $ulangan_H1 + $ulangan_H2 + $nilai_SA) / 4;
    $sup = mysqli_query($konek, "UPDATE nilais SET  
        nama = '$nama', 
        nilai_harian = '$nilai_harian', 
        ulangan_H1 = '$ulangan_H1',
        ulangan_H2 = '$ulangan_H2', 
        nilai_SA = '$nilai_SA', 
        nilai_rata = '$nilai_rata' 
        WHERE id = '$id'");
    
    if($sup){
        echo "<script>alert('Data berhasil diperbarui'); document.location.href='index1.php';</script>";
    } else {
        echo "<script>alert('Gagal memperbarui data: " . mysqli_error($konek) . "');</script>";
    }
}



?>
<br>
<form action="" method="post">
<table>
<tr>
   <td>ID</td>
<td><input type="number" name="tid" value="<?php echo @$id; ?>" <?php echo isset($_GET['edit']) ? 'readonly' : ''; ?> required /></td>
  </tr>
 <tr>
   <td>Nama</td>
<td><input type="text" name="tnama" value="<?php echo @$nama; ?>" required /></td>
   </tr>
        <tr>
            <td>Nilai Harian</td>  
<td><input type="number" name="tnilai_harian" value="<?php echo @$nilai_harian; ?>" required min="0" max="100" /></td>
          </tr>
        <tr>
            <td>Ulangan H1</td>
<td><input type="number" name="tulangan_H1" value="<?php echo @$ulangan_H1; ?>" required min="0" max="100" /></td>
                  </tr>
        <tr>
            <td>Ulangan H2</td>
<td><input type="number" name="tulangan_H2" value="<?php echo @$ulangan_H2; ?>" required min="0" max="100" /></td>
                  </tr>
        <tr>
            <td>Nilai SA</td>
<td><input type="number" name="tnilai_SA" value="<?php echo @$nilai_SA; ?>" required min="0" max="100" /></td>
               </tr>
        <!-- <tr>
            <td>Nilai Rata-rata</td>
            <td><input type="text" name="tnilai_rata" value="<?php echo @$nilai_rata; ?>" /></td>
        </tr> -->
        <tr>
            <td rowspan="2">
                <input type="submit" name="tombolsimpan" value="Simpan" 
                onclick="return confirm('Apakah Anda yakin ingin menyimpan data ini?');" />
                </td>
                <td>
                <input type="submit" name="tombolupdate" value="Update" 
                onclick="return confirm('Apakah Anda yakin ingin memperbarui data ini?');" />
            </td>
        </tr>
    </table>

</form>

<h2>Data Nilai</h2>
<table border="1">
    <tr>
        <th>ID</th>
        <th>Nama</th>
        <th>Nilai Harian</th>
        <th>Nilai H1</th>
        <th>Nilai H2</th>
        <th>Nilai SA</th>
        <th>Nilai Rata-Rata</th>
        <th>Edit</th>
        <th>Delete</th>
    </tr>
    <?php
    $panggil = mysqli_query($konek, "SELECT * FROM nilais ORDER BY nama ASC");
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
        <td><a href="?edit&id=<?php echo $data['id']; ?>"><img src="../img/pulpen.png" width="30px" height="30" alt="tombol edit" ></a></td>
        <td><a href="?delete=<?php echo $data['id']; ?>"><img src="../img/buang.png" width="30px" height="30" alt="tombol hapus" ></a></td>
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
