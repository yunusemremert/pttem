<?php

namespace Bootstrap;

class App {
    public static function init(): void // or database connection
    {
        ini_set("display_errors", "1");
        error_reporting(E_ALL);
    }
}