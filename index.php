<?php
session_start();
if (isset($_SESSION['role'])) {
    header("Location: dashboard/" . $_SESSION['role'] . ".php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="tyle.css">
    <title>Login</title>
</head>
<body>
<div class="container">
<h2 class="login-text" style="font-size: 2rem; font-weight: 800;" >Login Akun</h2>
    <form action="cek_login.php" method="post" class="login-email">
    <div class="input-group">
                <input type="email" placeholder="Email" name="email" required>
            </div>
            <div class="input-group">
                <input type="password" placeholder="Password" name="password" required>
            </div>
        <div class="input-group">
        <button type="submit" class="btn">Login</button>
        </div>
    </form>
</div>    
</body>
</html>
