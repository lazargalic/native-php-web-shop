<?php

function RegistracijaKorisnika($ime, $prezime, $mejl, $adresa, $teritorija, $mesto, $postanski, $mob, $sifra, $pol){
    global $conn;

    $uloga=1;
    $aktivan=1;
    $DefaultSlikaVelika="assets/images/ProfilePictures/defaultBig.jpg";
    $DefaultSlikaMala="assets/images/ProfilePictures/defaultSmall.jpg";

    $upit= 'INSERT INTO users (first_name, last_name, mail, adress, id_teritory, location, zip_code, mobile, password, id_gender, id_role, active, big_picture, small_picture)
     VALUES (:ime, :prezime, :mejl, :adresa, :teritorija, :mesto, :postanski, :mob, :sifra, :pol, :uloga, :aktivan, :DefaultSlikaVelika, :DefaultSlikaMala)';
    try{
        $priprema =$conn->prepare($upit);
        $priprema->bindParam(':ime', $ime);
        $priprema->bindParam(':prezime', $prezime);
        $priprema->bindParam(':mejl', $mejl);
        $priprema->bindParam(':adresa', $adresa);
        $priprema->bindParam(':teritorija', $teritorija);
        $priprema->bindParam(':mesto', $mesto);
        $priprema->bindParam(':postanski', $postanski);
        $priprema->bindParam(':mob', $mob);
        $priprema->bindParam(':sifra', $sifra);
        $priprema->bindParam(':pol', $pol);
        $priprema->bindParam(':uloga', $uloga);
        $priprema->bindParam(':aktivan', $aktivan);
        $priprema->bindParam(':DefaultSlikaVelika', $DefaultSlikaVelika);
        $priprema->bindParam(':DefaultSlikaMala', $DefaultSlikaMala);

        $rezultat=$priprema->execute();

        if($rezultat){

            $_SESSION['uspehReg']= "Uspešno ste se registrovali!";
            return $rezultat;
        }
        else{
            $_SESSION['greskaReg']="Greška, pokusajte ponovo";
        }                                
    }
    catch(PDOException $ex){
        var_dump($ex);
    }
}


function UnesiKomentar($proizvod, $korisnik, $komentar, $ocena){
   
    global $conn;

    $upit= 'INSERT INTO reviews (id_product, id_user, comment, id_mark) VALUES (:proizvod, :korisnik, :komentar, :ocena)';
    
    try{
       $priprema =$conn->prepare($upit);

       $priprema->bindParam(':proizvod', $proizvod);
       $priprema->bindParam(':korisnik', $korisnik);
       $priprema->bindParam(':komentar', $komentar);
       $priprema->bindParam(':ocena', $ocena);

       $rezultat=$priprema->execute();

       if($rezultat){

           return $rezultat;
       }
                             
   }
   catch(PDOException $ex){
       var_dump($ex);
   }

}

function NadjiId($mejl, $sifra){

    global $conn;

    $upit='SELECT * FROM users WHERE mail=:mejl AND password=:sifra';

    $priprema=$conn->prepare($upit);
    $priprema->bindParam(":mejl", $mejl);
    $priprema->bindParam(":sifra", $sifra);

    $priprema->execute();
    $rez=$priprema->fetch()->id_user;
    return $rez;
}

function NapraviKorpu($id){

    global $conn;
    $upit= 'INSERT INTO carts (id_user) VALUES (:id)';

    $priprema =$conn->prepare($upit);
    $priprema->bindParam(':id', $id);

    $priprema->execute();


}


function ObrisiKomentar($id){

    global $conn;

    $upit="DELETE FROM reviews WHERE id_review= :id";

    $priprema=$conn->prepare($upit);
    $priprema->bindParam(":id", $id);


    return $priprema->execute();

}

function UnesiProizvodUFavorite($idkor, $productfav){

    global $conn;

    $upit='INSERT INTO favorites ( id_user, id_product) VALUES ( :idkor, :productfav)' ;

    $priprema=$conn->prepare($upit);
    $priprema->bindParam(":idkor", $idkor);
    $priprema->bindParam(":productfav", $productfav);

    return $priprema->execute();

    
}

function ProveraDaLiJeVec($idkor, $productfav){

    global $conn;

    $upit='SELECT * from favorites WHERE id_user=:idkor AND id_product=:productfav' ;

    $priprema=$conn->prepare($upit);
    $priprema->bindParam(":idkor", $idkor);
    $priprema->bindParam(":productfav", $productfav);

    $priprema->execute();

    return $priprema->fetch();
    
}

function DohvatiIdKorpe($id){
    global $conn;

    $upit="SELECT id_cart from carts WHERE id_user= :id";

    $priprema=$conn->prepare($upit);
    $priprema->bindParam(":id", $id);


    $priprema->execute();

    return $priprema->fetch()->id_cart;
}


function UnesiProizvodUKorpu($productfav, $idkorpa){

    global $conn;


    $provera = DaLiVecImaUKorpi($productfav, $idkorpa);

    if(!$provera){

        $q=1;

        $upit='INSERT INTO cartsitems (id_product, id_cart, quantity) VALUES ( :productfav, :idkorpa, :q) ' ;
    
        $priprema=$conn->prepare($upit);
        $priprema->bindParam(":q", $q);
    
    }
    else{

        $upit='UPDATE cartsitems SET quantity= quantity+1 WHERE id_cart= :idkorpa AND id_product= :productfav';
    
        $priprema=$conn->prepare($upit);

    }

    $priprema->bindParam(":productfav", $productfav);
    $priprema->bindParam(":idkorpa", $idkorpa);

    return $priprema->execute();

}



function UnesiProizvodUKorpu2($productfav, $idkorpa){

    global $conn;


    $provera = DaLiVecImaUKorpi($productfav, $idkorpa);

    if(!$provera){

        $q=1;

        $upit='INSERT INTO cartsitems (id_product, id_cart, quantity) VALUES ( :productfav, :idkorpa, :q) ' ;
    
        $priprema=$conn->prepare($upit);
        $priprema->bindParam(":q", $q);
    
    }
    else{

        $upit='UPDATE cartsitems SET quantity= quantity+1 WHERE id_cart= :idkorpa AND id_product= :productfav';
    
        $priprema=$conn->prepare($upit);

    }

    $priprema->bindParam(":productfav", $productfav);
    $priprema->bindParam(":idkorpa", $idkorpa);

    return $priprema->execute();

}




function DaLiVecImaUKorpi($productfav, $idkorpa){

    global $conn;

    $upit="SELECT * from cartsitems WHERE id_product= :productfav AND id_cart= :idkorpa";

    $priprema=$conn->prepare($upit);

    $priprema->bindParam(":productfav", $productfav);
    $priprema->bindParam(":idkorpa", $idkorpa);

    $priprema->execute();

    return $priprema->fetch();

    
}

function BrojArtikalaUKorpi($id){

    global $conn;

    $upit="SELECT SUM(quantity) as broj from cartsitems WHERE id_cart= :id";

    $priprema=$conn->prepare($upit);

    $priprema->bindParam(":id", $id);
    $priprema->execute();

    return $priprema->fetch()->broj;

    
}

function DohvatiProizvodeKorpe($id){

    global $conn;

    $upit="SELECT cai.id_cart_item, p.name_product, p.id_product, p.id_category, c.id_category, c.name_category, p.id_brand, p.main_picture, b.id_brand,
            b.name_brand, (SELECT price
                              from productsprices pp
                              WHERE pp.id_product=p.id_product
                              ORDER BY start_price_at desc
                              LIMIT 0,1) as latestprice, ca.id_cart, cai.id_cart, cai.quantity 
            FROM products p JOIN brands b on p.id_brand=b.id_brand JOIN productsprices pp ON pp.id_product=p.id_product JOIN categories c ON c.id_category=p.id_category
            JOIN cartsitems cai ON cai.id_product= p.id_product JOIN carts ca ON cai.id_cart=ca.id_cart WHERE ca.id_cart=:id
            GROUP BY p.id_product ";


    $priprema=$conn->prepare($upit);

    $priprema->bindParam(":id", $id);

    $priprema->execute();
    return $priprema->fetchAll();

}

function ApdejtujKorpu($idcartitem, $vrednost){

    global $conn;

    if($vrednost=="+"){

        $upit="UPDATE cartsitems SET quantity=quantity+1 WHERE id_cart_item= :idcartitem AND quantity>0";
    }
    if($vrednost=="-"){

        $upit="UPDATE cartsitems SET quantity=quantity-1 WHERE id_cart_item= :idcartitem AND quantity>1";
    }


    $priprema=$conn->prepare($upit);
    $priprema->bindParam(":idcartitem", $idcartitem);

    return $priprema->execute();

}

function DohvatiSumuCenaZaKorpu($id){
    
    global $conn;

    $upit="SELECT cai.id_cart_item, p.name_product, p.id_product, p.id_category, p.id_brand, p.main_picture, b.id_brand,
            b.name_brand, (SELECT price
                            from productsprices pp
                            WHERE pp.id_product=p.id_product
                            ORDER BY start_price_at desc
                            LIMIT 0,1) * cai.quantity as ukupno, ca.id_cart, cai.id_cart, cai.quantity
            FROM products p JOIN brands b on p.id_brand=b.id_brand JOIN productsprices pp ON pp.id_product=p.id_product
            JOIN cartsitems cai ON cai.id_product= p.id_product JOIN carts ca ON cai.id_cart=ca.id_cart WHERE ca.id_cart= :id
            GROUP BY p.id_product ";

    $priprema=$conn->prepare($upit);
    
    $priprema->bindParam(":id", $id);

    $priprema->execute();
    
    $svi= $priprema->fetchAll();

    $ukupno=0;

    foreach($svi as $s){
        $ukupno+=$s->ukupno;
    }

    return $ukupno;
}

function ObrisiCartItem($id){
    global $conn;

    $upit="DELETE FROM cartsitems WHERE id_cart_item= :id";

    $priprema=$conn->prepare($upit);
    $priprema->bindParam(":id", $id);


    return $priprema->execute();


}

function UnesiPodatkeOKorisniku($ime, $prezime, $mejl, $adresa, $teritorija, $mesto, $postanski, $mob){
    
    global $conn;

    $upit= 'INSERT INTO userspayments (first_name, last_name, mail, adress, id_teritory, location, zip_code, mobile)
    VALUES (:ime, :prezime, :mejl, :adresa, :teritorija, :mesto, :postanski, :mob)';
   
   try{

       $priprema =$conn->prepare($upit);
       
       $priprema->bindParam(':ime', $ime);
       $priprema->bindParam(':prezime', $prezime);
       $priprema->bindParam(':mejl', $mejl);
       $priprema->bindParam(':adresa', $adresa);
       $priprema->bindParam(':teritorija', $teritorija);
       $priprema->bindParam(':mesto', $mesto);
       $priprema->bindParam(':postanski', $postanski);
       $priprema->bindParam(':mob', $mob);


       $priprema->execute();

       return $conn->lastInsertId();
    
                            
   }
   catch(PDOException $ex){
       var_dump($ex);
   }



}

function UnesiPlacanje($iduserpayment){

    global $conn;

    $upit= 'INSERT INTO payments (id_user_payment) VALUES (:iduserpayment)';
   
   try{

       $priprema =$conn->prepare($upit);
       $priprema->bindParam(':iduserpayment', $iduserpayment);

       $rezultat=$priprema->execute();
    

       if($rezultat){


           return $conn->lastInsertId();
       }

                           
   }
   catch(PDOException $ex){
       var_dump($ex);
   }



}


function UnesiProizvodeZaPlacanje($idpayment, $id_product, $quantity, $total){

    global $conn;

    $upit= 'INSERT INTO itemspayments (id_payment, id_product, quantity, total_price)
    VALUES (:idpayment, :id_product, :quantity, :total)';
   
   try{

       $priprema =$conn->prepare($upit);
       $priprema->bindParam(':idpayment', $idpayment);
       $priprema->bindParam(':id_product', $id_product);
       $priprema->bindParam(':quantity', $quantity);
       $priprema->bindParam(':total', $total);


       $rezultat=$priprema->execute();

       if($rezultat){

        $_SESSION['uspehPosiljka']= "Uspešno ste se izvrsili kupovinu !";

        return $rezultat;

        }
        else{
            $_SESSION['greskaPosiljka']="Greška, pokusajte ponovo";

        }                                 
   }
   catch(PDOException $ex){
       var_dump($ex);
   }

}


function ObrisiSVEItemeKorpe($idkorpa){

    global $conn;

    $upit="DELETE FROM cartsitems WHERE id_cart= :idkorpa";

    $priprema=$conn->prepare($upit);
    $priprema->bindParam(":idkorpa", $idkorpa);


    return $priprema->execute();

}

//ne ulogovan :

function KreirajIdKorpe(){

    global $conn;

    $upit="INSERT INTO carts () VALUES ()";

    $priprema=$conn->prepare($upit);
    $priprema->execute();

    return $conn->lastInsertId();

}

function DohvatiOmiljeneKorisnika($iduser){

    global $conn;

    $upit="SELECT * from favorites f JOIN products p ON f.id_product=p.id_product JOIN brands b ON b.id_brand=p.id_brand WHERE f.id_user= :iduser ";

    $priprema=$conn->prepare($upit);
    $priprema->bindParam(":iduser", $iduser);

    $priprema->execute();

    return $priprema->fetchAll();


}

function ObrisiSveFav($id){
    
    global $conn;

    $upit="DELETE FROM favorites WHERE id_user= :id";

    $priprema=$conn->prepare($upit);
    $priprema->bindParam(":id", $id);


    return $priprema->execute();
}

function DodajProfilnuSlikuVeliku($id, $putanja){

    global $conn;
    
    $upit="UPDATE users SET big_picture= :putanja WHERE id_user=:id ";

    $priprema=$conn->prepare($upit);

    $priprema->bindParam(":id", $id);
    $priprema->bindParam(":putanja", $putanja);

    return $priprema->execute();
}

function DodajProfilnuSlikuMalu($id, $putanja){

    global $conn;
    
    $upit="UPDATE users SET small_picture= :putanja WHERE id_user=:id ";

    $priprema=$conn->prepare($upit);

    $priprema->bindParam(":id", $id);
    $priprema->bindParam(":putanja", $putanja);

    return $priprema->execute();
}

?>