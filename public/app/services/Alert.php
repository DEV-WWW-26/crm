<?php

namespace app\services;

class Alert
{
    public static function err($msg)
    {
        echo "<div class=\"alert alert-danger\" role=\"alert\">$msg</div>";
    }
}