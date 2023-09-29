<?php

class LoginCheck
{
    public static function isLogin()
    {
        // if (time() - $_SESSION['login']['timestamp'] > 600) {
        //     header('location: ' . BASEURL . '/Auth/logout');
        // }
        if (!isset($_SESSION['login'])) {
            header('location: ' . BASEURL . '/auth');
        }
    }
}
