<?php
    session_start();

    if(!isset($_SESSION['admin']) && !isset($_SESSION['korisnik'])  ){
        header("Location: index.php?page=pocetna");
        exit();
    }


    if($_SERVER['REQUEST_METHOD'] =='POST'){

        include "../../assets/config/connection.php";
        include "functions.php";
        include "../global/functions.php";

        $id=$_POST['id'];
        $slika=$_FILES['slikaprofilna'];

        $imeSlike=$slika['name'];
        $privrem=$slika['tmp_name'];
        $tipSlike=$slika['type'];
        $velicinaSlike=$slika['size'];

        $tipovi=["image/jpg", "image/jpeg", "image/png"];

        $greske=0; 

        if(!in_array($tipSlike, $tipovi)){
            $greske++;
            $_SESSION['greskaTip']="Nedozvoljeni tip slike.";
            header("Location: ../../index.php?page=profil");
            exit();
        }

       
        if(isset($id) && isset($slika)){

            //////PRVA MANJA SLIKA

            $putanja="../../assets/images/ProfilePictures/".time()."_mala_".$imeSlike;

            $ext = explode("/",$tipSlike)[1];   

            switch($ext){

                case "jpeg":{
                    $source = imagecreatefromjpeg($privrem);
                    break;
                };
                case "png":{
                    $source = imagecreatefrompng($privrem);
                    break;
                };
            }
            

            list($wid, $ht) = getimagesize($privrem);

            $new_width = 100;
            $quota = $wid / $new_width;
            $new_height = $ht / $quota;

            $blank = imagecreatetruecolor($new_width, $new_height);

            imagecopyresampled($blank, $source, 0, 0, 0, 0, $new_width, $new_height, $wid, $ht);
    
                switch($ext){
                    case "jpeg":{
                        imagejpeg($blank,$putanja);
                        break;
                    };
                    case "png":{
                        imagepng($blank, $putanja);
                        break;
    
                    };
                }

            $putanja=substr($putanja, 6, strlen($putanja));
            $rez2 =DodajProfilnuSlikuMalu($id, $putanja);


            //////DRUGA VECA SLIKA

            list($wid, $ht) = getimagesize($privrem);

            $new_width = 800;
            $quota = $wid / $new_width;
            $new_height = $ht / $quota;

            $ext = explode("/",$tipSlike)[1];   

            switch($ext){

                case "jpeg":{
                    $source = imagecreatefromjpeg($privrem);
                    break;
                };
                case "png":{
                    $source = imagecreatefrompng($privrem);
                    break;
                };
            }
            
            $putanja="../../assets/images/ProfilePictures/".time()."_velika_".$imeSlike;
            $blank = imagecreatetruecolor($new_width, $new_height);

                imagecopyresampled($blank, $source, 0, 0, 0, 0, $new_width, $new_height, $wid, $ht);
    
                switch($ext){
                    case "jpeg":{
                        imagejpeg($blank,$putanja);
                        break;
                    };
                    case "png":{
                        imagepng($blank, $putanja);
                        break;
    
                    };
                }

            $putanja=substr($putanja, 6, strlen($putanja));
            $rez1 =DodajProfilnuSlikuVeliku($id, $putanja);


            if(true){  //ovde je bilo $premestanje pa nisam hteo da menjam if , isto i kod edita i inserta za sliku pre resiza kad sam radio
                
                if($rez1 && $rez2){

                    $_SESSION['korisnik']=PodaciZaKorisnika($id);
                    $_SESSION['uspesnaDodatnaSlika']="Uspesno promenjena profilna slika.";
                    header("Location: ../../index.php?page=profil");
                    exit();
                    http_response_code(204);

                }
                else {
                    $_SESSION['greskaDodatnaSlika']="Doslo je do greske prilikom dodavanja u bazu.";
                    header("Location: ../../index.php?page=profil");
                    exit();
                    http_response_code(404);
                }

            }
            else{
                $_SESSION['greskaDodatnaSlika']="Doslo je do greske prilikom dodavanja.";
                header("Location: ../../index.php?page=profil");
                exit();
                http_response_code(404);
            }

        }
        else{
            header("Location: ../../index.php?page=profil");
            exit();
            $_SESSION['greskaDodatnaSlika']="Doslo je do greske prilikom dodavanja.";
            http_response_code(404);
        }

        
    

    }
    else{
        http_response_code(404);
    }
?>

