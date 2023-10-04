<?php
    session_start();
    if($_SERVER['REQUEST_METHOD'] =='POST'){

        include "../../assets/config/connection.php";
        include "functions.php";

        header("Content-type: application/json");

        try{


            $productfav=$_POST['productfav'];
            $idkor=$_POST['idkor'];

            $provera=ProveraDaLiJeVec($idkor, $productfav);


            if(!$provera){

                $rez= UnesiProizvodUFavorite($idkor, $productfav);


                if($rez){

                    echo json_encode("Dodato u Omiljene!");
                    http_response_code(200);
        
                }
                else{
                    http_response_code(401);
                }

            }
            else{
                                    
                echo json_encode("Proizvod vec Postoji u Omiljenim.");
                http_response_code(200);
            }

           

        }

        catch(PDOException $ex){
            http_response_code(500);
            //echo $ex;
        }
    }
    else{
        http_response_code(404);
    }
?>

