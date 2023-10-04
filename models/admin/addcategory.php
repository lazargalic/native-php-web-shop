<?php
    session_start();

    if(!isset($_SESSION['admin'])){
        header("Location: index.php?page=pocetna");
        exit();
    }



    if($_SERVER['REQUEST_METHOD'] =='POST'){

        include "../../assets/config/connection.php";
        include "functions.php";
        include "../global/functions.php";


        $regnaziv= "/^[A-ZĆČŠŽĐ|0123456789|-]{1}[a-zžčćšđ|0123456789|-]{0,15}(\s[A-ZĆČŠŽĐ|0123456789|-]{1}[a-zžčćšđ|0123456789|-]{0,15})*$/";  
        
        $naziv=trim($_POST["naziv"]);
        $roditelj=$_POST["roditelj"];

        $brgresaka=0;

        //echo $naziv;
        //echo $roditelj;

        if(!preg_match($regnaziv, $naziv)){
            $brgresaka++;
        }

        if( $roditelj < 1 || $roditelj > 4) {
            $brgresaka++;
        }
        
       // echo $brgresaka;
        



        if($brgresaka==0){
            $rez=UnesiKategoriju($naziv, $roditelj);

            if($rez){

                header("Content-type: application/json");
            
                $sveKat= DohvatiPodKategorije();

                echo json_encode($sveKat);
                
                
            }
            else{
                echo "Greska";
            }
            

        }
        else{
            http_response_code(401);
            echo "Greska";
        }

        
    

    }
    else{
        http_response_code(404);
    }
?>

