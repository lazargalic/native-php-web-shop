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

        $id=$_POST['rewievid'];
        $idproduct=$_POST['productid'];
       
        if(isset($id)){
            
            $rez=ObrisiKomentar($id);

            if($rez){

                header("Content-type: application/json");
            
                $sve= DohvatiSveRecenzije($idproduct);

                //$id_korisnika=$korisnik->id_user;
                //ovo sam vracao 

                
                echo json_encode(["rezencije"=>$sve]);

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

