<?php
    session_start();
    if($_SERVER['REQUEST_METHOD'] =='POST'){

        include "../../assets/config/connection.php";
        include "functions.php";
        include "../global/functions.php";
        try{

                $proizvod=$_POST["proizvod"];
                $korisnik=$_POST["korisnik"];
                $komentar=addslashes(trim($_POST["komentar"]));
                $ocena=$_POST["ocena"];
                
                $rez=UnesiKomentar($proizvod, $korisnik, $komentar, $ocena);

                if($rez){

                    $sve=DohvatiSveRecenzije($proizvod);
                    header("Content-type: application/json");
                    echo json_encode(["rezencije"=>$sve]);
                }
                else{
                    http_response_code(404);
                }

            }
            catch(PDOException $ex){
                http_response_code(500);
                //var_dump($ex);
            }

    }
    else{
        http_response_code(404);
    }
?>

