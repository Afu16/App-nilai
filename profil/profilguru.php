<?php
session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] != 'guru') {
    header("Location: ../index.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>profil</title>
</head>
<header>
    <h1>Profil</h1>
    <nav>
        <ul>
        <li><a style="text-decoration: none;" href="../dashboard/siswa.php">Beranda</a></li>
        <li><a style="text-decoration: none;" href="../logout.php">Logout</a></li>
        </ul>
    </nav>
</header>
<body>
<h2><?php echo $_SESSION['nama']; ?></h2>
</body>
</html>