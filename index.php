<?php
include('connect/connection.php');

if (isset($_POST["login"])) {
    $email = mysqli_real_escape_string($connect, trim($_POST['email']));
    $password = trim($_POST['password']);

    $sql = mysqli_query($connect, "SELECT * FROM login where email = '$email'");
    $count = mysqli_num_rows($sql);

    if ($count > 0) {
        $fetch = mysqli_fetch_assoc($sql);
        $hashpassword = $fetch["password"];

        if ($fetch["status"] == 0) {
            ?>
            <script>
                alert("Harap Verifikasi Akun Email Sebelum Login.");
            </script>
            <?php
        } else if (password_verify($password, $hashpassword)) {
            ?>
            <script>
                alert("Login Berhasil! Anda akan dialihkan ke halaman utama.");
                window.location.href = "verification.php";
            </script>
            <?php
        } else {
            ?>
            <script>
                alert("Email Atau Kata Sandi Tidak Valid, Silakan Coba Lagi.");
            </script>
            <?php
        }
    }
}
?>


<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css" />
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!------ Include the above in your HEAD tag ---------->

<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Raleway:300,400,600" rel="stylesheet" type="text/css">

    <link rel="stylesheet" href="CSS/index.css?= time();?>">

    <link rel="icon" href="Favicon.png">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">

    <title>Login</title>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-light navbar-laravel">
    <div class="container">
        <a class="navbar-brand" href="#">
            <img src="img/logo.png" alt="Logo" class="logo">
            Aplikasi SDN 013 Tanjungpinang Barat
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="register.php">Registrasi</a>
                </li>
                 <li class="nav-item">
                    <a class="nav-link" href="verification.php">Masukkan OTP</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<main class="login-form">
    <div class="container"> <!-- Perbaikan container -->
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Login</div>
                    <div class="card-body">
                        <form action="#" method="POST" name="login">
                            <div class="form-group row">
                                <label for="email_address" class="col-md-4 col-form-label text-md-right">Email</label>
                                <div class="col-md-6">
                                    <input type="text" id="email_address" class="form-control" name="email" required placeholder="Masukkan Email">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password" class="col-md-4 col-form-label text-md-right">Password</label>
                                <div class="col-md-6" style="position: relative;">
                                    <input type="password" id="password" class="form-control" name="password" required placeholder="Masukkan Password">
                                    <i class="bi bi-eye-slash" id="togglePassword" style="position: absolute; right: 20px; top: 50%; transform: translateY(-50%); cursor: pointer;"></i>
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-md-6 offset-md-4">
                                    <input type="submit" value="Login" name="login" class="btn btn-primary"> <!-- Menambahkan class "btn btn-primary" -->
                                    <a href="recover_psw.php" class="btn btn-link" style="text-decoration: none;">Dapatkan Password Baru?</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
</body>
</html>
<script>
    const toggle = document.getElementById('togglePassword');
    const password = document.getElementById('password');
    let isPasswordVisible = false;

    toggle.addEventListener('click', function() {
        isPasswordVisible = !isPasswordVisible;
        password.type = isPasswordVisible ? 'text' : 'password';
        this.classList.toggle('bi-eye', isPasswordVisible);
        this.classList.toggle('bi-eye-slash', !isPasswordVisible);
    });
</script>

