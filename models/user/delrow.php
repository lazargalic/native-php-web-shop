<?php
    session_start();

    if(!isset($_SESSION['korisnik']) && !isset($_SESSION['korpaneulogovan'])){
        //header("Location: index.php?page=pocetna");
        exit();
    }

    

    if($_SERVER['REQUEST_METHOD'] =='POST'){

        include "../../assets/config/connection.php";
        include "functions.php"; 
        include "../global/functions.php";

        $idcartitem=$_POST['idcartitem'];
        $idcart=$_POST['idcart'];
       
        if(isset($idcart) && isset($idcartitem)){
            
            $rez=ObrisiCartItem($idcartitem);

            if($rez){

                header("Content-type: application/json");
            
                $sve= DohvatiProizvodeKorpe($idcart);

                $ukupnacena=DohvatiSumuCenaZaKorpu($idcart);

                $brojukorpi=BrojArtikalaUKorpi($idcart);

                echo json_encode(["korpaprikaz"=>$sve, "ukupnacena"=>$ukupnacena, "brojukorpi"=>$brojukorpi]);

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

