<?php

class RoleCheck
{
    public static function cekLevel($role)
    {
        $loginUserRole = $_SESSION['login']['role'];
        $result = in_array($loginUserRole, $role);
        if (!$result) {
            header('location: ' . BASEURL . '/pages/pages403');
        }
    }
}
