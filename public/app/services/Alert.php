<?php

namespace app\services;

class Alert
{
    public static function err($msg)
    {
        echo "<div class=\"alert alert-danger\" role=\"alert\">$msg</div>";
    }

    public static function ok($msg)
    {
        echo "<div class=\"alert alert-success\" role=\"alert\">$msg</div>";
    }
}