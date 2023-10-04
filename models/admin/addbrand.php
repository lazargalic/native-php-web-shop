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


        $regnaziv= "/^[A-ZĆČŠŽĐ]{1}[a-zžčćšđ]{0,15}(\s[A-ZĆČŠŽĐ]{1}[a-zžčćšđ]{0,15})*$/";      
        
        $naziv=trim($_POST["naziv"]);

        $brgresaka=0;

        //echo $naziv;
        //echo $roditelj;

        if(!preg_match($regnaziv, $naziv)){
            $brgresaka++;
        }

       // echo $brgresaka;
        

        if($brgresaka==0){

            $rez=UnesiBrend($naziv);

            if($rez){

                header("Content-type: application/json");
            
                $sviBrendovi= DohvatiSveBrendove();

                echo json_encode($sviBrendovi);
                
                
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

