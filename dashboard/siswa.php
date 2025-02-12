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
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
            height: 100vh;
        }
        .sidebar {
            width: 220px;
            background: #007BFF;
            height: 100vh;
            display: flex;
            flex-direction: column;
            align-items: center;
            padding-top: 50px;
            position: fixed;
            left: 0;
            top: 0;
        }
        .sidebar a {
            display: block;
            width: 100%;
            text-align: center;
            padding: 15px 0;
            text-decoration: none;
            color: white;
            font-size: 18px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.3);
            transition: 0.3s;
        }
        .sidebar a:hover {
            background: #0056b3;
        }
        .content {
            margin-left: 240px;
            padding: 20px;
            flex-grow: 1;
            display: flex;
            flex-direction: column;
            align-items: flex-start;
            justify-content: flex-start;
        }
        .dashboard h2 {
            color: #333;
            margin-bottom: 10px;
        }
        .role-icon {
            font-size: 24px;
            color: #007BFF;
            display: block;
            margin-top: 5px;
        }
        .logout {
            position: absolute;
            top: 10px;
            right: 10px;
            background: red;
            color: white;
            padding: 10px 15px;
            border-radius: 5px;
            text-decoration: none;
            font-weight: bold;
            transition: 0.3s;
        }
        .logout:hover {
            background: darkred;
        }
    </style>
</head>
<body>

    <!-- Sidebar Menu Kiri -->
    <div class="sidebar">
        <a href="profil.php"><i class="fas fa-user"></i> Profil</a>
        <a href="materi.php"><i class="fas fa-book"></i> Materi</a>
        <a href="tugas.php"><i class="fas fa-tasks"></i> Tugas</a>
        <a href="tugas.php"><i class="fas fa-trophy"></i> Nilai</a>

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
<!-- <!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Dashboard Siswa</title>
</head>
<body>
    <h2>Selamat datang, <?php echo $_SESSION['nama']; ?> (Siswa)</h2>
    <a href="../logout.php">Logout</a>
</body>
</html> -->
