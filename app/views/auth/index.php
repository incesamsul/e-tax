<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>Login &mdash; E-TAX</title>

    <!-- General CSS Files -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">


    <!-- Template CSS -->
    <link rel="stylesheet" href="<?= BASEURL ?>/public/template/stisla/assets/css/style.css">
    <link rel="stylesheet" href="<?= BASEURL ?>/public/template/stisla/assets/css/component.css">
    <link rel="stylesheet" href="<?= BASEURL ?>/public/assets/css/style.css">
    <link rel="stylesheet" href="<?= BASEURL ?>/public/assets/css/custom.css">
</head>

<style>
    body {
        background: url('public/assets/img/pattern/bg3png.png') !important;
        background-repeat: no-repeat !important;
        background-size: cover !important;
        background-attachment: fixed !important;
    }
</style>

<body>
    <div id="app">
        <section class="section">
            <div class="container mt-5">
                <div class="row">
                    <div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 col-lg-6 offset-lg-3 col-xl-4 offset-xl-4">
                        <div class="login-brand">
                            <img src="<?= BASEURL ?>/public/assets/img/logo/logo.jpg" alt="logo" width="200">
                        </div>

                        <div class="card card-danger">
                            <div class="card-header">
                                <h4>Login</h4>
                            </div>

                            <div class="card-body">
                                <form action="<?= BASEURL ?>/Auth" method="POST">
                                    <?= FlashMessage::showFlash(); ?>
                                    <div class="form-group">
                                        <label for="nrik">NRIK</label>
                                        <input id="nrik" type="text" class="form-control" name="nrik" tabindex="1" required autofocus>
                                        <div class="invalid-feedback">
                                            Masukkan NRIK Anda
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="d-block">
                                            <label for="password" class="control-label">Kata Sandi</label>
                                            <div class="float-right">
                                                <a href="auth-forgot-password.html" class="text-small">
                                                    <!-- Forgot Password? -->
                                                </a>
                                            </div>
                                        </div>
                                        <input id="password" type="password" class="form-control" name="password" tabindex="2" required>
                                        <div class="invalid-feedback">
                                            Masukkan Kata Sandi Anda
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" name="remember" class="custom-control-input" tabindex="3" id="remember-me">
                                            <label class="custom-control-label" for="remember-me">Ingat Saya</label>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <button name="signIn" type="submit" class="btn btn-danger btn-lg btn-block" tabindex="4">
                                            Masuk
                                        </button>
                                    </div>
                                </form>

                            </div>
                        </div>
                        <div class="simple-footer">
                            Copyright &copy; <a href="https://www.bankdki.co.id/">Bank DKI</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>


</body>

</html>