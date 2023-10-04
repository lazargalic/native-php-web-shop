<?php
    session_start();
    if($_SERVER['REQUEST_METHOD'] =='POST'){

        include "../../assets/config/connection.php";
        include "functions.php";

        header("Content-type: application/json");

        try{

            $productfav=$_POST['productfav'];
            //$idkor=$_POST['idkor'];

            if(isset($_SESSION['korpaneulogovan'])){
                $idkorpa=$_SESSION['korpaneulogovan'];
            }
            else{
                $idkorpa=KreirajIdKorpe();
                $_SESSION['korpaneulogovan']=$idkorpa;
            }



            if($idkorpa){
                
                $rez= UnesiProizvodUKorpu($productfav, $idkorpa);

                $broj= BrojArtikalaUKorpi($idkorpa);

                if($rez){
                    echo json_encode(["poruka"=>"Uspesno dodato!", "brojkorpa"=> $broj]);
                    http_response_code(200);
                }
                else{
                    http_response_code(403);
                }

            }
            else{
                http_response_code(404);
            }

        }

        catch(PDOException $ex){
            http_response_code(500);
           // echo $ex;
        }
    }
    else{
        http_response_code(404);
    }
?>

