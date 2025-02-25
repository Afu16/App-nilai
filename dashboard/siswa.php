<?php
session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] != 'siswa') {
    header("Location: ../index.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Siswa</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>

    <!-- Sidebar Menu Kiri -->
    <div class="sidebar">
        <a href="profil.php"><i class="fas fa-user"></i> Profil</a>
        <a href="materi.php"><i class="fas fa-book"></i> Materi</a>
        <!-- <a href="tugas.php"><i class="fas fa-tasks"></i> Tugas</a> -->
        <a href="../crud/index.php"><i class="fas fa-trophy"></i> Nilai</a>

    </div>

    <!-- Konten Utama -->
    <div class="content">
        <a href="../logout.php" class="logout"><i class="fas fa-sign-out-alt"></i> Logout</a>
        <div class="dashboard">
            <h2>Selamat datang, <?php echo $_SESSION['nama']; ?></h2>
            <i class="fas fa-user-graduate role-icon"></i>
        </div>
    </div>

</body>
</html>
