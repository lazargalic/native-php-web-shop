<?php
    session_start();

    if(!isset($_SESSION['korisnik'])){
        header("Location: index.php?page=pocetna");
        exit();
    }

    

    if($_SERVER['REQUEST_METHOD'] =='POST'){

        include "../../assets/config/connection.php";
        include "functions.php"; 
        include "../global/functions.php";

        $id=$_POST['iduser'];
       
        if(isset($id)){
            
            $rez=ObrisiSveFav($id);

            if($rez){

                header("Location: ../../index.php?page=profil");
                exit();
                http_response_code(203);

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

