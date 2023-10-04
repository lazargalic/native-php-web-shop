<?php
    session_start();
    if($_SERVER['REQUEST_METHOD'] =='POST'){

        include "../../assets/config/connection.php";
        include "functions.php";

        try{

            $id=$_POST['id'];

            header("Content-type: application/json");

            if($id==0){

            $svekat=DohvatiPodKategorije();

            $svibrend=DohvatiSveBrendove();
            
            }
            else{

            $svekat=DohvatiPodKategorijeIdCat($id);

            $svibrend=DohvatiBrendoveIdCat($id);

            }

            echo json_encode(["podkat"=>$svekat, "brendovi"=>$svibrend]);

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

