<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>E-tax </title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?= BASEURL ?>/public/plugins/fontawesome-free/css/all.min.css">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="<?= BASEURL ?>/public/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?= BASEURL ?>/public/dist/css/adminlte.min.css">
    <link rel="stylesheet" href="<?= BASEURL ?>/public/css/login_style.css">
</head>

<body>
    <div class="login-wrapper">
        <div class="login-side">
            <div class="brand-wrapper">
                <div class="brand-logo">
                    <img src="<?= BASEURL ?>/public/assets/img/logo.jpg" width="400">
                </div>
                <div class="brand-name">
                    <span>E-tax</span>
                </div>
            </div>
            <div class="login-caption">
                <p>Masuk Untuk Melanjutkan</p>
                <?= FlashMessage::showFlash(); ?>
            </div>
            <div class="form-login">
                <form action="<?= BASEURL ?>/Auth" method="POST">
                    <div class="input-group">
                        <div class="icon-wrapper">
                            <i class="fas fa-user-circle login-icon"></i>
                        </div>
                        <input type="text" class=" form-custom" placeholder="email" name="email">
                    </div>
                    <div class="input-group mt-3 mb-3">
                        <div class="icon-wrapper">
                            <i class="fas fa-key login-icon smaller"></i>
                        </div>
                        <input type="password" class=" form-custom" placeholder="Password" name="password">
                    </div>
                    <div class="row">
                        <!-- /.col -->
                        <div class="col-5">
                            <button type="submit" class="btn btn-dark btn-block btn-custom" name="signIn">Masuk</button>
                        </div>
                        <div class="col-7 login-ask">
                            <p class="m-0 text-secondary">Lupa Password ?</p>
                            <p class="text-bold"><a href="https://192.168.1.12/scan">Scan Barcode ?</a></p>
                        </div>
                        <!-- /.col -->
                    </div>
                </form>

            </div>
        </div>
        <div class="ilustration-side text-center">
            <div class="ilustration-caption mt-5">
                <h4 class="text-bold">No Fix No Pay</h4>
                <p>Lakukan Konsultasi dan cek servisan anda kapanpun dan di manapun</p>
            </div>
            <div class="ilustration mt-5">
                <img src="<?= BASEURL ?>/public/assets/img/logo.jpg" alt="ilustrasi" width="400">
            </div>
        </div>
    </div>
</body>

</html>