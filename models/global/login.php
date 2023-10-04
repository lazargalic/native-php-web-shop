<?php session_start();
    if($_SERVER['REQUEST_METHOD'] =='POST'){

        include "../../assets/config/connection.php";
        include "functions.php";

        try{

            if(isset($_POST['uloguj'])){
            $regmejl= "/^[a-z][\w\.\-]+\@[a-z0-9]{2,15}(\.[a-z]{2,4}){1,2}$/";
            $rgsifrap= "/^[A-Z]{1}[a-z|A-Z|0-9|.!@%&*_]{7,24}$/";

            $greske=0;

            $mejl=trim($_POST["mejl"]);
            $sifra=trim($_POST["sifra"]);

            if(!preg_match($regmejl, $mejl)){
                $greske++;
                echo "Greska mejl";
            };
            if(!preg_match($rgsifrap, $sifra)){
                $greske++;
                echo "Greska sifra";
            };

            $mejl=addslashes($mejl);
            $sifra=md5($sifra);
            
            if($greske==0){

            $korisnik=Logovanje($mejl, $sifra);

            //var_dump($korisnik);

                if($korisnik){ 

                    $_SESSION['korisnik']=$korisnik;

                    if(isset($korisnik)){  

                        if($korisnik->id_role==2){    //ako je admin 
                            $_SESSION['admin']=$korisnik;
                        }

                    }

                        http_response_code(200);
                        header("Location: ../../index.php?page=pocetna");  
                        exit();
                }

                http_response_code(400);
                header("Location: ../../index.php?page=logovanje");   
                exit();
            }
            else{
                http_response_code(400);
                echo "Greska";
            }
        }

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

