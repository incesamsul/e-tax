<?php

class FlashMessage
{
    public static function setFlash($pesan)
    {
        $_SESSION['flash'] = [
            'pesan' => $pesan
        ];
    }

    public static function showFlash()
    {
        if (isset($_SESSION['flash'])) {
            echo "<p style=color:red;>" . $_SESSION['flash']['pesan'] . "</p>";
            unset($_SESSION['flash']);
        }
    }
}
