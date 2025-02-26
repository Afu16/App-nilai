<?php
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama = $_POST['nama'];
    $email = $_POST['email'];
    $password = md5($_POST['password']); // Hash password
    $role = $_POST['role']; // Bisa 'siswa' atau 'guru'

    // Cek apakah email sudah terdaftar
    $check_email = "SELECT email FROM users WHERE email='$email'";
    $result = mysqli_query($conn, $check_email);

    if (mysqli_num_rows($result) > 0) {
        echo "Email sudah digunakan. Silakan gunakan email lain.";
    } else {
        // Insert data ke database
        $query = "INSERT INTO users (nama, email, password, role) VALUES ('$nama', '$email', '$password', '$role')";
        if (mysqli_query($conn, $query)) {
            echo "Registrasi berhasil! <a href='index.php'>Login di sini</a>";
        } else {
            echo "Error: " . mysqli_error($conn);
        }
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrasi</title>
</head>
<body>
    <h2>Registrasi Pengguna</h2>
    <form action="" method="post">
        <input type="text" name="nama" placeholder="Nama Lengkap" required><br>
        <input type="email" name="email" placeholder="Email" required><br>
        <input type="password" name="password" placeholder="Password" required><br>
        <select name="role">
            <option value="siswa">Siswa</option>
            <option value="guru">Guru</option>
        </select><br>
        <button type="submit">Daftar</button>
    </form>
    <p>Sudah punya akun? <a href="index.php">Login</a></p>
</body>
</html>
