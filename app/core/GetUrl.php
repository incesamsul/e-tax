<?php

class GetUrl
{
    public static function parseURL()
    {
        if (isset($_GET['url'])) {
            $url = rtrim($_GET['url'], "/");
            $url = explode("/", $url);
            $urlLowercase = array();

            foreach ($url as $element) {
                $lowercaseElement = strtolower($element);
                $urlLowercase[] = $lowercaseElement;
            }
            return $urlLowercase;
        }
    }
}
