<?php
if(isset($_POST['btIzmeni'])){

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

            //
            $dostupnost=$_POST["dostupnost"];
            $id=$_POST["id"];
            $staraslika=$_POST["slikastara"];
    

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

            $slika= $_FILES['slikanova'];

            // if(){  fali mi provera da li su prazna svojstva niza !!!! jer ga uvek tura kao true jer je array ispod var dump a on je true array uvek 
            //      $slika=false;   
            //  }

            foreach($slika as $red){
                $provera = $red;
            } 

            //var_dump($slika);

            $putanja=$staraslika;

            $premestanje=true;
            

            if($provera) {

            //echo "Proso";

            $imeSlike=$slika['name'];
            $privrem=$slika['tmp_name'];
            $tipSlike=$slika['type'];
            $velicinaSlike=$slika['size'];

            $tipovi=["image/jpg", "image/jpeg", "image/png"];

            if(!in_array($tipSlike, $tipovi)){
                $greske++;
                $_SESSION['greskaTip']="Nedozvoljeni tip slike.";
                header("Location: ../../index.php?page=izmena-proizvoda&id=".$id);
                exit();
                http_response_code(404);
            }
            if($velicinaSlike > 60000) {
                $greske++;
                $_SESSION['greskaTip']="Prevelik fajl. Maksimum je do 60KB.";
                header("Location: ../../index.php?page=admin-novi-proizvod");
                exit();
            }
            
             
            //$premestanje=move_uploaded_file($privrem, $putanja);

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

                $putanja=substr($putanja, 6, strlen($putanja));


            }

            if($greske==0){




                if(true){

                    $izmeniProizvod= IzmeniProizvod($naziv, $brend, $kategorija, $opis, $pol, $putanja, $dostupnost, $id);

                    //var_dump($dodajproizvod);
                    
                    if($izmeniProizvod){

                        $dodajcenu=DodajCenuZaProizvod($id, $cena); 

                        if($dodajcenu){

                          
                            $_SESSION["uspesnaIzmena"]= "Uspesno izmenjen proizvod.";
                            http_response_code(204);
                            header("Location: ../../index.php?page=izmena-proizvoda&id=".$id);
                            exit();
                            
                        }
                        else {
                            $_SESSION["greskaIzmena"]= "Problem prilikom Dodavanje cene";
                            http_response_code(422);
                            header("Location: ../../index.php?page=izmena-proizvoda&id=".$id);
                            exit();
                            
                        }

    
                    }
                    else{
                        $_SESSION["greskaIzmena"]= "Greska Prilikom izmene";
                        http_response_code(422);
                        header("Location: ../../index.php?page=izmena-proizvoda&id=".$id);
                        exit();
                        
                    }


                }
                else{
                    $_SESSION["greskaIzmena"]= "Greska Prilikom premestanja slike, obratite se programeru";
                    http_response_code(422);
                    header("Location: ../../index.php?page=izmena-proizvoda&id=".$id);
                    exit();
                }

            
            }
            else{
                $_SESSION["greskaIzmena"]= "Imate greske";
                http_response_code(422);
                header("Location: ../../index.php?page=izmena-proizvoda&id=".$id);
                exit();
                
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