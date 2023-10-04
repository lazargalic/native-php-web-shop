<?php

function UnesiKategoriju($naziv, $roditelj){

    global $conn;
    
    $upit="INSERT INTO categories (name_category, id_parent) VALUES (:naziv, :roditelj)";

    $priprema=$conn->prepare($upit);
    $priprema->bindParam(":naziv", $naziv);
    $priprema->bindParam(":roditelj", $roditelj);

    return $priprema->execute();

}


function DohvatiSveKorisnike(){
    global $conn;

    $upit="SELECT * from users u JOIN roles r ON r.id_role= u.id_role JOIN teritories t ON u.id_teritory=t.id_teritory order by u.registered_at asc";

    $rez=$conn->query($upit)->fetchAll();

    return $rez;
}


function ObrisiKategoriju($id){
    global $conn;

    $upit="DELETE FROM categories WHERE id_category= :id";

    $priprema=$conn->prepare($upit);
    $priprema->bindParam(":id", $id);


    return $priprema->execute();
}

function PromeniUlogu($id_user, $id_role){

    $id_role==1? $nova=2 : $nova=1;


    global $conn;

    $upit="UPDATE users SET id_role=:nova WHERE id_user=:id_user";

    $priprema=$conn->prepare($upit);
    $priprema->bindParam(":nova", $nova);
    $priprema->bindParam(":id_user", $id_user);

    return $priprema->execute();
}

function ObrisiKorisnika($id){
    global $conn;

    $upit="DELETE FROM users WHERE id_user= :id";

    $priprema=$conn->prepare($upit);
    $priprema->bindParam(":id", $id);


    return $priprema->execute();
}

function UnesiBrend($naziv){
    global $conn;
    
    $upit="INSERT INTO brands (name_brand) VALUES (:naziv)";

    $priprema=$conn->prepare($upit);
    $priprema->bindParam(":naziv", $naziv);

    return $priprema->execute();
}


function ObrisiBrend($id){
    global $conn;

    $upit="DELETE FROM brands WHERE id_brand= :id";

    $priprema=$conn->prepare($upit);
    $priprema->bindParam(":id", $id);


    return $priprema->execute();
}

function DodajNoviProizvod($naziv, $brend, $kategorija, $opis, $pol, $putanja){
    
    global $conn;

    $available=1;

    $upit = "INSERT INTO products (name_product, id_brand, id_category, description, id_gender, available , main_picture)
             VALUES (:naziv, :brend, :kategorija, :opis, :pol, $available, :putanja)";

    $priprema=$conn->prepare($upit);
    $priprema->bindParam(":naziv", $naziv);
    $priprema->bindParam(":brend", $brend);
    $priprema->bindParam(":kategorija", $kategorija);
    $priprema->bindParam(":opis", $opis);
    $priprema->bindParam(":pol", $pol);
    $priprema->bindParam(":putanja", $putanja);

    $priprema->execute();
    
    return $conn->lastInsertId();
}

function DodajCenuZaProizvod($id, $cena){

    global $conn;

    $postoji=ProveraDaLiCenaPostoji($id, $cena);

    if(!$postoji){

        $upit = "INSERT INTO productsprices (id_product, price) VALUES (:id, :cena)";
        $priprema=$conn->prepare($upit);
    }
    else {
        $datum= date('Y-m-d H:i:s');

        $upit = "UPDATE productsprices SET start_price_at= :datum WHERE id_product=:id AND price=:cena";

        $priprema=$conn->prepare($upit);
        $priprema->bindParam(":datum", $datum);

    }

    $priprema->bindParam(":id", $id);
    $priprema->bindParam(":cena", $cena);

    return $priprema->execute();

}

function ProveraDaLiCenaPostoji($id, $cena){

    global $conn;

    $upit = "SELECT * from productsprices WHERE id_product=:id AND price=:cena";

    $priprema=$conn->prepare($upit);
    $priprema->bindParam(":id", $id);
    $priprema->bindParam(":cena", $cena);

    $priprema->execute();

    return $priprema->fetch();

}


function IzmeniProizvod($naziv, $brend, $kategorija, $opis, $pol, $putanja, $dostupnost, $id){
    
    global $conn;

    $datum =date('Y-m-d H:i:s');

    $upit="UPDATE products SET name_product=:naziv, id_brand=:brend, id_category=:kategorija, description =:opis, id_gender=:pol, main_picture=:putanja,
           available=:dostupnost, last_updated_at= :datum  WHERE id_product=:id";

    $priprema=$conn->prepare($upit);
    $priprema->bindParam(":naziv", $naziv);
    $priprema->bindParam(":brend", $brend);
    $priprema->bindParam(":kategorija", $kategorija);
    $priprema->bindParam(":opis", $opis);
    $priprema->bindParam(":pol", $pol);
    $priprema->bindParam(":putanja", $putanja);
    $priprema->bindParam(":dostupnost", $dostupnost);
    $priprema->bindParam(":id", $id);
    $priprema->bindParam(":datum", $datum);

    return $priprema->execute(); 
        
}


function ObrisiProizvod($id){

    global $conn;

    $upit="DELETE FROM products WHERE id_product= :id";

    $priprema=$conn->prepare($upit);
    $priprema->bindParam(":id", $id);


    return $priprema->execute();
}

function DodajDodatnuSliku($id, $putanja, $naziv){
    global $conn;
    
    $upit="INSERT INTO productspictures (id_product, src, alt) VALUES (:id, :putanja, :naziv)";

    $priprema=$conn->prepare($upit);

    $priprema->bindParam(":id", $id);
    $priprema->bindParam(":putanja", $putanja);
    $priprema->bindParam(":naziv", $naziv);

    return $priprema->execute();

}

function  ObrisiSveDodatneSlike($id){
    global $conn;

    $upit="DELETE FROM productspictures WHERE id_product= :id";

    $priprema=$conn->prepare($upit);
    $priprema->bindParam(":id", $id);

    return $priprema->execute();
}

function DohvatiSveKupovine(){

    global $conn;

    $upit = "SELECT * from payments p";

    $priprema=$conn->query($upit);

    $priprema->execute();

    return $priprema->fetchAll();

}

function DohvatiProizvodePorudzbine($idpayment){

    global $conn;

    $upit = "SELECT * from payments p JOIN itemspayments ip ON p.id_payment=ip.id_payment JOIN products pp ON pp.id_product=ip.id_product
     JOIN brands b ON b.id_brand=pp.id_brand JOIN categories c ON c.id_category=pp.id_category
     WHERE p.id_payment= :idpayment  ";

    $priprema=$conn->prepare($upit);
    $priprema->bindParam("idpayment", $idpayment);
    
    $priprema->execute();

    return $priprema->fetchAll();

}

function DohvatiPodatkeKorisnikaPorudzbine($iduserpayment){

    global $conn;

    $upit = "SELECT * from userspayments u JOIN teritories t on t.id_teritory=u.id_teritory WHERE u.id_user_payment= :iduserpayment ";

    $priprema=$conn->prepare($upit);
    $priprema->bindParam("iduserpayment", $iduserpayment);
    
    $priprema->execute();

    return $priprema->fetchAll();

}

function ObrisiPORUDZBINU($id){

    global $conn;

    $upit="DELETE FROM payments WHERE id_payment= :id";

    $priprema=$conn->prepare($upit);
    $priprema->bindParam(":id", $id);

    return $priprema->execute();
    
}

function Apdejtuj($id, $textt){
    
    global $conn;

    $upit="UPDATE texts SET text= :textt WHERE id_text= :id";

    $priprema=$conn->prepare($upit);
    $priprema->bindParam(":id", $id);
    $priprema->bindParam(":textt", $textt);

    return $priprema->execute();
}

?>