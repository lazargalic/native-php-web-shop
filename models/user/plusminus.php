<?php
    session_start();

    if(!isset($_SESSION['korisnik']) && !isset($_SESSION['korpaneulogovan']) ){
        header("Location: index.php?page=pocetna");
        exit();
    }

    

    if($_SERVER['REQUEST_METHOD'] =='POST'){
        
        header("Content-type: application/json");

        include "../../assets/config/connection.php";
        include "functions.php"; 
        include "../global/functions.php";

        $idcartitem=$_POST['idcartitem'];
        $vrednost=$_POST['vrednost'];
        $idcart=$_POST['id_cart'];

        if(isset($idcartitem) && isset($vrednost) && isset($idcart) ){
            
            $rez=ApdejtujKorpu($idcartitem, $vrednost);

            $brojukorpi=BrojArtikalaUKorpi($idcart);

            if($rez){


                $sve= DohvatiProizvodeKorpe($idcart);

                $ukupnacena=DohvatiSumuCenaZaKorpu($idcart);

                echo json_encode(["korpaprikaz"=>$sve, "brojukorpi"=>$brojukorpi, "ukupnacena"=>$ukupnacena]);

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

