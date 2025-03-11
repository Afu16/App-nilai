<?php
session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] != 'guru') {
    header("Location: ../index.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Guru</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <!-- Sidebar Menu Kiri -->
    <div class="sidebar">
        <a href="../profil/profilguru.php"><i class="fas fa-user"></i> Profil</a>
        <a href="../mapel/mapelsiswa.php"><i class="fas fa-book-open"></i> Mapel</a>
        <a href="../crud/index2.php"><i class="fas fa-chart-bar"></i> Nilai</a>
    </div>

    <!-- Konten Utama -->
    <div class="content">
        <a href="../logout.php" class="logout"><i class="fas fa-sign-out-alt"></i> Logout</a>
        <div class="dashboard">
            <h2>Selamat datang, <?php echo $_SESSION['nama']; ?></h2>
            <i class="fas fa-chalkboard-teacher role-icon"></i>
        </div>
        <div class="">
        <h2>TAHUN AJARAN</h2>
        <p>2025-2026</p>
        
        <h2>SEMESTER</h2>
        <p>GENAP</p>
        </div>
    </div>

</body>
</html>
