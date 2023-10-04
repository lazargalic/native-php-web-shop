<?php
    session_start();

    if(!isset($_SESSION['admin'])){
        header("Location: index.php?page=pocetna");
        exit();
    }



    if($_SERVER['REQUEST_METHOD'] =='POST'){

        include "../../assets/config/connection.php";
        include "functions.php"; 

        $id=$_POST['id'];
 
       
        if(isset($id)){
            
            $rez=ObrisiProizvod($id);

            if($rez){

                $_SESSION['uspesnoBrisanje']="Uspesno obrisan proizvod.";
                header("Location: ../../index.php?page=admin-svi-proizvodi");
                exit();
                
                http_response_code(204);
            }
            else{
                $_SESSION['greskaBrisanje']="Doslo je do greske prilikom brisanja.";
            }

        }
        else{
            http_response_code(404);
            echo "Greska";
        }

        
    

    }
    else{
        http_response_code(404);
    }
?>

