<?php
    session_start();
    if($_SERVER['REQUEST_METHOD'] =='POST'){

        include "../../assets/config/connection.php";
        include "functions.php";

        try{

            $regkeyword="/^[A-ZĆČŠŽĐ|a-zžčćšđ|0-9]{0,14}(\s[A-ZĆČŠŽĐ|a-zžčćšđ|0-9]{1,14})*$/";
            $keyword=trim($_POST["keyword"]);

            if(preg_match($regkeyword,$keyword)){

                $maxcena=NajvecaCenaUBazi() + 10;

                $podkategorije= isset($_POST['podkategorije']) ? $_POST['podkategorije'] : 0;
                $brendovi=isset($_POST["brendovi"]) ? $_POST["brendovi"] : 0;
                $pol=isset($_POST["pol"]) ? $_POST["pol"] : 0;
                $cenamax=isset($_POST["cenamax"]) ? $_POST["cenamax"] : $maxcena;
                $sortcena=isset($_POST["sortcena"]) ? $_POST["sortcena"] : 0;
                $paginacija=$_POST["paginacija"];

                //var_dump($keyword);
                //var_dump($podkategorije);
                //var_dump($brendovi);
                //var_dump($pol);
                //var_dump($cena);

                $filtrirani=FiltrirajSveProizvode($keyword, $podkategorije, $brendovi, $pol, $cenamax, $sortcena, $paginacija);

                // foreach($brendovi as $b){
                //     echo $b;
                //}

                $brojFiltriranih=$_SESSION['BrojFiltriranih'];

                header("Content-type: application/json");
                echo json_encode(["proizvodi"=>$filtrirani, "brojfiltriranih"=>$brojFiltriranih]);

                

            }
            else{
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

/*

(SELECT start_price_at
                                        from productsprices
                                        WHERE pp.id_product=p.id_product
                                        ORDER BY start_price_at desc
                                        LIMIT 0,1
                                     )

*/



?>

