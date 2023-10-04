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
        $slika=$_FILES['slikadodatna'];

        $imeSlike=$slika['name'];
        $privrem=$slika['tmp_name'];
        $tipSlike=$slika['type'];
        $velicinaSlike=$slika['size'];

        $tipovi=["image/jpg", "image/jpeg", "image/png"];

        $greske=0; 

        if(!in_array($tipSlike, $tipovi)){
            $greske++;
            $_SESSION['greskaTip']="Nedozvoljeni tip slike.";
            header("Location: ../../index.php?page=dodatne-slike&id=".$id);
            exit();
        }

       
        if(isset($id)){

            $putanja="../../assets/images/AdditionalPictures/".time()."_".$imeSlike;
             
            $premestanje=move_uploaded_file($privrem, $putanja);

            $putanja=substr($putanja, 6, strlen($putanja));


            if($premestanje){

                $rez=DodajDodatnuSliku($id, $putanja, $imeSlike);


                if($rez){

                    $_SESSION['uspesnaDodatnaSlika']="Uspesno dodata dodatna slika.";
                    header("Location: ../../index.php?page=dodatne-slike&id=".$id);
                    exit();
                    http_response_code(204);
                }
                else {
                    $_SESSION['greskaDodatnaSlika']="Doslo je do greske prilikom dodavanja u bazu.";
                    header("Location: ../../index.php?page=dodatne-slike&id=".$id);
                    exit();
                    http_response_code(404);
                }

            }
            else{
                $_SESSION['greskaDodatnaSlika']="Doslo je do greske prilikom dodavanja.";
                header("Location: ../../index.php?page=dodatne-slike&id=".$id);
                exit();
                http_response_code(404);
            }

        }
        else{
            header("Location: ../../index.php?page=dodatne-slike&id=".$id);
            exit();
            $_SESSION['greskaDodatnaSlika']="Doslo je do greske prilikom dodavanja.";
            http_response_code(404);
        }

        
    

    }
    else{
        http_response_code(404);
    }
?>

