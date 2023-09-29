<?php

class General extends Controller
{

    public function __construct()
    {
        LoginCheck::isLogin();
    }



    public function download_manual_book($files = null)
    {
        Helpers::download_manual_book($files);
    }
}
