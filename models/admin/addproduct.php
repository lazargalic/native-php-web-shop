<?php
if(isset($_POST['btDodaj'])){

        try{

            session_start();

            
            if(!isset($_SESSION['admin'])){
                header("Location: index.php?page=pocetna");
                exit();
            }



            include "../../assets/config/connection.php";
            include "functions.php";  

            $nazivregg= "/^[A-ZĆČŠŽĐ|0123456789|-]{1}[a-zžčćšđ|0123456789|-]{0,15}(\s[A-ZĆČŠŽĐ|0123456789|-]{1}[a-zžčćšđ|0123456789|-]{0,15})*$/";

            $greske=0;

            $naziv=trim($_POST["naziv"]);
            $brend=$_POST["brend"];
            $kategorija=$_POST["kategorija"];
            $opis=trim($_POST["opis"]);
            $pol=$_POST["pol"];
            $cena=trim($_POST['cena']);


            if(!preg_match($nazivregg, $naziv) || strlen($naziv)>79){
                $greske++;
                echo "Greska naziv";
            }
            if($cena<0){
                $greske++;
                echo "Greska cena";
            }
            if(strlen($opis)<0){
                $greske++;
                echo "Greska opis";
            }

            $slika=$_FILES['slika'];
            $imeSlike=$slika['name'];
            $privrem=$slika['tmp_name'];
            $tipSlike=$slika['type'];
            $velicinaSlike=$slika['size'];

            $tipovi=["image/jpg", "image/jpeg", "image/png"];


            if(!in_array($tipSlike, $tipovi)){
                $greske++;
                $_SESSION['greskaTip']="Nedozvoljeni tip slike.";
                header("Location: ../../index.php?page=admin-novi-proizvod");
                exit();
            }
            if($velicinaSlike > 60000) {
                $greske++;
                $_SESSION['greskaTip']="Prevelik fajl. Maksimum je do 60KB.";
                header("Location: ../../index.php?page=admin-novi-proizvod");
                exit();
            }
            
            if($greske==0){

                list($wid, $ht) = getimagesize($privrem);  //

                $new_width = 450;
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


                $putanja="../../assets/images/Products/".time()."_".$imeSlike;

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
    
                //$premestanje=move_uploaded_file($privrem, $putanja);

                $putanja=substr($putanja, 6, strlen($putanja));

                if(true){

                    $dodajproizvod= DodajNoviProizvod($naziv, $brend, $kategorija, $opis, $pol, $putanja);


                    if($dodajproizvod){

                        $dodajcenu=DodajCenuZaProizvod($dodajproizvod, $cena);  //id je $dodajproizvod

                        if($dodajcenu){

                          
                            $_SESSION["uspesnoDodavanje"]= "Uspesno dodat proizvod.";
                            header("Location: ../../index.php?page=admin-novi-proizvod");
                            exit();
                            http_response_code(201);
                        }
                        else {
                            $_SESSION["greskaDodavanje"]= "Problem prilikom Dodavanje cene";
                            header("Location: ../../index.php?page=admin-novi-proizvod");
                            exit();
                            http_response_code(403);
                        }

    
                    }
                    else{
                        $_SESSION["greskaDodavanje"]= "Greska Prilikom Dodavanja";
                        header("Location: ../../index.php?page=admin-novi-proizvod");
                        exit();
                        
                    }


                }
                else{
                    echo "Nije uspelo premestanje";
                }

               

            }
            else {
                http_response_code(404);

            }


        }
        catch(PDOException $ex){
            http_response_code(500);
            var_dump($ex);
        }
    }
    else{
        http_response_code(404);
    }

?>