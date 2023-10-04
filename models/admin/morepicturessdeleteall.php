<?php
    session_start();

    if(!isset($_SESSION['admin'])){
        header("Location: index.php?page=pocetna");
        exit();
    }

    

    if(isset($_POST['btObrisi'])){

        include "../../assets/config/connection.php";
        include "functions.php";
        
        $id=$_POST['id'];
 
       
        if(isset($id)){
            
            $rez=ObrisiSveDodatneSlike($id);

            if($rez){

                $_SESSION['uspesnoBrisanjeDodatnih']="Uspesno brisanje.";
                http_response_code(204);
                header("Location: ../../index.php?page=dodatne-slike&id=".$id);
                exit();
          

            }
            else{
                $_SESSION['greskaBrisanjeDodatnih']="Greska prilikom brisanja.";
                http_response_code(404);
                header("Location: ../../index.php?page=dodatne-slike&id=".$id);
                exit();
            }

        }
        else{
            $_SESSION['greskaBrisanjeDodatnih']="Greska prilikom brisanja. Nije Setovan Id.";
            http_response_code(404);
            header("Location: ../../index.php?page=dodatne-slike&id=".$id);
            exit();
            
        }
    

    }
    else{
        http_response_code(404);
    }
?>

