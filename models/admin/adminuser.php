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

        $id_user=$_POST['id_user'];
        $id_role=$_POST['id_role'];

       
        if(isset($id_user) && isset($id_role)){
            
            $rez=PromeniUlogu($id_user, $id_role);

            if($rez){

                header("Content-type: application/json");
                
                $svi=DohvatiSveKorisnike();

                echo json_encode($svi);

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

