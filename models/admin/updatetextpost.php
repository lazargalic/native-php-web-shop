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

        $text=$_POST['vrednost'];
 
       
        if(isset($text)){
            
            $rez=Apdejtuj(1, $text);

            if($rez){

                header("Content-type: application/json");
            
                echo json_encode("Uspesno Promenjeno!");
                http_response_code(200);
            }

        }
        else{
            http_response_code(401);
        }

        
    

    }
    else{
        http_response_code(404);
    }
?>

