<?php

    define("SERVER", env("SERVER"));
    define("DATABASE", env("DATABASE"));
    define("USERNAME", env("USERNAME"));
    define("PASSWORD", env("PASSWORD"));
    define("BASE_URL", $_SERVER['DOCUMENT_ROOT'].'/Kuca Higijene Galic 1/');

    function env($marker){
        $niz = file(__DIR__ . "/.env");
        $trazenaVrednost = "";
    
        foreach($niz as $red){
            $red = trim($red);
    
            list($identifikator, $vrednost) = explode("=", $red);
    
            if($identifikator == $marker){
                $trazenaVrednost = $vrednost;
                break;
            }
        }
    
        return $trazenaVrednost;
    }
?>