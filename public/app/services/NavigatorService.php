<?php

namespace app\services;

class NavigatorService
{

    public function goHome() {
        echo '
            <script type="module">
                import { goHome } from "/app/js/navigate.js";
            
                goHome();
        </script>';

        exit;
    }
}