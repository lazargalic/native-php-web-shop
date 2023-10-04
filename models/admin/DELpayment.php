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

        $id=$_POST['idpay'];
 
       
        if(isset($id)){
            
            $rez=ObrisiPORUDZBINU($id);

            if($rez){

                http_response_code(422);
                header("Location: ../../index.php?page=admin");
                exit();

            }
            else{
                echo "Greska Prilikom brisanja. Javite se programeru ako se bude ponovilo.";
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

