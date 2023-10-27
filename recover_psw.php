<?php session_start() ?>
<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!------ Include the above in your HEAD tag ---------->

<!doctype html>
<html lang="en">
<head>
       
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Raleway:300,400,600" rel="stylesheet" type="text/css">

    <link rel="stylesheet" href="CSS/recover.css?=time();?>">

    <link rel="icon" href="Favicon.png">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">

    <title>Dapatkan Password</title>
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

    </div>
</nav>

<main class="login-form">
    <div class="cotainer">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Password Baru</div>
                    <div class="card-body">
                        <form action="#" method="POST" name="recover_psw">
                            <div class="form-group row">
                                <label for="email_address" class="col-md-4 col-form-label text-md-right">Masukkan Email</label>
                                <div class="col-md-6">
                                    <input type="text" id="email_address" class="form-control" name="email" required placeholder="Masukkan Email">
                                </div>
                            </div>
                            <div class="col-md-6 offset-md-4">
                                    <input type="submit" value="Dapatkan" name="recover" class="btn btn-primary"> 
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

<?php 
    if(isset($_POST["recover"])){
        include('connect/connection.php');
        $email = $_POST["email"];

        $sql = mysqli_query($connect, "SELECT * FROM login WHERE email='$email'");
        $query = mysqli_num_rows($sql);
  	    $fetch = mysqli_fetch_assoc($sql);

        if(mysqli_num_rows($sql) <= 0){
            ?>
            <script>
                alert("<?php  echo "Maaf, Email Anda Tidak Terdaftar "?>");
            </script>
            <?php
        }else if($fetch["status"] == 0){
            ?>
               <script>
                   alert("Maaf, akun anda belum ter-verifikasi, Anda tidak dapat memulihkan kata sandi untuk saat ini");
                   window.location.replace("index.php");
               </script>
           <?php
        }else{
            // generate token by binaryhexa 
            $token = bin2hex(random_bytes(50));

            //session_start ();
            $_SESSION['token'] = $token;
            $_SESSION['email'] = $email;

            require "Mail/phpmailer/PHPMailerAutoload.php";
            $mail = new PHPMailer;

            $mail->isSMTP();
            $mail->Host='smtp.gmail.com';
            $mail->Port=587;
            $mail->SMTPAuth=true;
            $mail->SMTPSecure='tls';

            // h-hotel account
            $mail->Username='013sdntanjungpinangbarat@gmail.com';
            $mail->Password='abzrczsogizfdwtc';

            // send by h-hotel email
            $mail->setFrom('013sdntanjungpinangbarat@gmail.com', 'Password Baru');
            // get email from input
            $mail->addAddress($_POST["email"]);
            //$mail->addReplyTo('lamkaizhe16@gmail.com');

            // HTML body
            $mail->isHTML(true);
            $mail->Subject="Perbarui Password Anda";
            $mail->Body="<b>Hai Pengguna PPDB SD Negeri 013 Tanjungpinang Barat</b>
            <h3>Kami menerima permintaan untuk mengatur ulang kata sandi Anda.</h3>
            <p>Silakan klik tautan di bawah ini untuk mengatur ulang kata sandi Anda:</p>
            http://localhost/coba/reset_psw.php
            <br><br>";

            if(!$mail->send()){
                ?>
                    <script>
                        alert("<?php echo " Email tidak valid "?>");
                    </script>
                <?php
            }else{
                ?>
                    <script>
                        window.location.replace("notification.html");
                    </script>
                <?php
            }
        }
    }


?>
