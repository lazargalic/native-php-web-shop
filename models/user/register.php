<?php
    session_start();
    if($_SERVER['REQUEST_METHOD'] =='POST'){

        include "../../assets/config/connection.php";
        include "functions.php";

        try{

            if(isset($_POST['registruj'])){
            $rgsifrap= "/^[A-Z]{1}[a-z|A-Z|0-9|.!@%&*_]{7,24}$/";
            $regadresa= "/^[A-ZĆČŠŽĐ]{1}[a-zžčćšđ]{1,14}(\s[A-ZĆČŠŽĐ|a-zžčćšđ|0-9]{1,14})*$/";
            $regimeprez= "/^[A-ZĆČŠŽĐ]{1}[a-zžčćšđ]{2,14}(\s[A-ZĆČŠŽĐ]{1}[a-zžčćšđ]{2,14})?$/";
            $regmejl= "/^[a-z][\w\.\-]+\@[a-z0-9]{2,15}(\.[a-z]{2,4}){1,2}$/";

            $greske=0;


            $ime=trim($_POST["ime"]);
            $prezime=trim($_POST["prezime"]);
            $mejl=trim($_POST["mejl"]);
          
            $sifra=trim($_POST["sifra"]);
            $adresa=trim($_POST["adresa"]);
            $teritorija= $_POST["grad"];
            $pol=$_POST["pol"];

            $mesto=trim($_POST["mesto"]);
            $postanski=trim($_POST["postbr"]);
            $mob=trim($_POST["telefon"]);


            if(!preg_match($regimeprez, $ime)){
                $greske++;
                echo "Greska ime";
            }
            if(!preg_match($regimeprez, $prezime)){
                $greske++;
                echo "Greska prezime";
            }
            if(!preg_match($regmejl, $mejl)){
                $greske++;
                echo "Greska mejl";
            }
            if(!preg_match($rgsifrap, $sifra)){
                $greske++;
                echo "Greska sifra";
            }
            if(!preg_match($regadresa, $adresa)){
                $greske++;
                echo "Greska adresa";
            }


            if(strlen($adresa)>70 || strlen($adresa)<3){
                $greske++;
                echo "Greska adresa";
            }
            if(strlen($mesto)>30 || strlen($mesto)<3){
                $greske++;
                echo "Greska mesto";
            }
            if(strlen($mob)!=10){
                $greske++;
                echo "Greska tel";
            }
            if(strlen($postanski)!=5){
                $greske++;
                echo "Greska postanski";
            }

            $sifra=md5($sifra);


            if($greske==0){ 

                $ime=addslashes($ime);
                $prezime=addslashes($prezime);
                $mejl=addslashes($mejl);
                $adresa=addslashes($adresa);
                $mesto=addslashes($mesto);
                $postanski=addslashes($postanski);
                $mob=addslashes($mob);

                $registracija=RegistracijaKorisnika($ime, $prezime, $mejl, $adresa, $teritorija, $mesto, $postanski, $mob, $sifra, $pol);

                if($registracija){

                    $id = NadjiId($mejl, $sifra);
                    NapraviKorpu($id);

                    header("Location: ../../index.php?page=registracija");
                    exit();
                    http_response_code(201);
                    
                }
                else {
                    $_SESSION['greskaReg']="Greška, pokusajte ponovo";
                    header("Location: ../../index.php?page=registracija");
                    exit();
                    http_response_code(422);
                    
                }

            }
            else{
                http_response_code(404);
            }
        }
        }
        catch(PDOException $ex){
            http_response_code(500);
        }
    }
    else{
        http_response_code(404);
    }
?>

