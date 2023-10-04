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

        $id=$_POST['id'];
 
       
        if(isset($id)){
            
            $rez=ObrisiKategoriju($id);

            if($rez){

                header("Content-type: application/json");
            
                $sveKat= DohvatiPodKategorije();
                
                echo json_encode($sveKat);

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

