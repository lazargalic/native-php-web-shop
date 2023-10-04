<?php

$brojpostrani=16;

//filtering
function FiltrirajSveProizvode($keyword, $podkategorije, $brendovi, $pol, $cenamax, $sortcena, $paginacija){

    //napisi podupit za productprices  select top 1 price from productsprices order by start_price_at desc

    global $conn;
    global $brojpostrani;

    $limitOd=$paginacija*$brojpostrani;

    $upit="SELECT p.name_product, p.id_product, p.id_category, p.id_brand, p.main_picture, b.id_brand,
                  b.name_brand, p.added_at, (SELECT price
                                            from productsprices pp
                                            WHERE pp.id_product=p.id_product
                                            ORDER BY start_price_at desc
                                            LIMIT 0,1) AS latestprice
           FROM products p JOIN brands b on p.id_brand=b.id_brand JOIN productsprices pp ON pp.id_product=p.id_product ";


    if($podkategorije){
        $upit.="WHERE p.id_category IN (";
        foreach($podkategorije as $p):
            $upit.="$p, ";
        endforeach;

        $upit.="0) ";
    }

    if($brendovi){
        
        $podkategorije ? $upit.="AND p.id_brand IN (" : $upit.="WHERE p.id_brand IN (" ;

        foreach($brendovi as $b):
            $upit.="$b, ";
        endforeach;

        $upit.="0) ";
    }


    if($pol){
        
        $brendovi || $podkategorije ? $upit.="AND (" : $upit.="WHERE (" ;

        $upit.="p.id_gender= $pol ) ";


    }

    if($keyword){
        
        $pol || $brendovi || $podkategorije ? $upit.="AND (" : $upit.="WHERE (" ;

        $upit.=" (CONCAT ( b.name_brand, ' ' , p.name_product))  LIKE '%$keyword%') ";


    }

    if($cenamax){
        
        $pol || $brendovi || $podkategorije || $keyword ? $upit.="AND (" : $upit.="WHERE (" ;

        $upit.=" pp.price < $cenamax ) ";       //kad ovde stavim latest price pise uncomn column hahahaha a ispod moze 


    }

    $upit.="AND p.available=1 GROUP BY p.id_product ";


    if($sortcena){

        $sortcena==1? $upit.="ORDER BY latestprice asc " : $upit.="ORDER BY latestprice desc "; 
                                            // kad ovde stavim samo pp.price ne orderuje samo taj jedan koji ima promenjenu cenu hahahahh
                                            // kad stavim last_price kao sto je u products.php i kolona u bazi ili pp.last_price ne radi nigde
                                            // lastprice radi pp. lastprice nece sto mi je i logicno negde 
                                            
    }
    else{
        $upit.=" ORDER BY p.added_at desc";
    }

    $svi = $conn->query($upit)->fetchAll(); 
    
    $brojfiltriranih=count($svi);
    $_SESSION['BrojFiltriranih']=$brojfiltriranih;

    
    $upit.=" LIMIT $limitOd, $brojpostrani ";
    $novi=$conn->query($upit)->fetchAll(); 

    return $novi;
}


function UnesiTeritorije($teritorija){
    global $conn;
    
    $upit="INSERT INTO teritories (name_teritory) VALUES (:teritorija)";

    $priprema=$conn->prepare($upit);
    $priprema->bindParam(":teritorija", $teritorija);

    $priprema->execute();

}


function DohvatiTeritorije(){

    global $conn;

    $upit="SELECT * from teritories";

    $rez=$conn->query($upit)->fetchAll();

    return $rez;
}

function DohvatiPolove(){

    global $conn;

    $upit="SELECT * from genders";

    $rez=$conn->query($upit)->fetchAll();

    return $rez;
}

function Logovanje($mejl, $sifra){

    global $conn;

    $upit='SELECT * FROM users WHERE mail=:mejl AND password=:sifra';

    $priprema=$conn->prepare($upit);
    $priprema->bindParam(":mejl", $mejl);
    $priprema->bindParam(":sifra", $sifra);

    $priprema->execute();  //true
        
    $rezultat=$priprema->fetch();   //false

   

    if($rezultat){
       $_SESSION['uspeh']= "Uspešno ste se ulogovali!";
    }
    else{
        $_SESSION['greskalog']="Greška. Proverite kredencijale za unos.";
    }
    
    return $rezultat;
}



function DohvatiGlavneKategorije(){
    
    global $conn;

    $upit="SELECT * from categories WHERE id_parent IS NULL";

    $rez=$conn->query($upit)->fetchAll();

    return $rez;
}

function DohvatiPodKategorije(){
    
    global $conn;

    $upit="SELECT * from categories WHERE id_parent IS NOT NULL order by id_category desc";

    $rez=$conn->query($upit)->fetchAll();

    return $rez;
}


function DohvatiSveBrendove(){
    
    global $conn;

    $upit="SELECT * from brands order by id_brand desc";

    $rez=$conn->query($upit)->fetchAll();

    return $rez;
}
//i dodatne slike za pojedinacni proizvod

function DohvatiSvePodatkeZaProizvod($id){
    
    global $conn;
    
    $upit="SELECT * from products p JOIN categories c ON p.id_category=c.id_category JOIN brands b ON b.id_brand=p.id_brand JOIN genders g ON p.id_gender=g.id_gender 
         WHERE p.id_product=$id ";

    $s = $conn->query($upit)->fetch();  //

    $s->last_price=PoslednjaCena($id);  // 

    return $s;
}

function DodatneSlikeZaSlajder($id){
    global $conn;
    
    $upit="SELECT * from productspictures WHERE id_product= :id ";     

    $priprema=$conn->prepare($upit);
    $priprema->bindParam(":id", $id);
    
    $priprema->execute(); 

    return $priprema->fetchAll();
}

function DohvatiSveRecenzije($id){

    global $conn;
    
    $upit="SELECT r.id_review, u.id_user, r.id_mark, r.comment, r.reviewed_at, r.id_user, u.first_name, u.last_name,u.small_picture, u.big_picture, r.id_product
     from reviews r JOIN users u ON u.id_user=r.id_user WHERE r.id_product= :id order by reviewed_at desc";     

    $priprema=$conn->prepare($upit);
    $priprema->bindParam(":id", $id);
    
    $priprema->execute(); 

    return $priprema->fetchAll();
}


//admin panel
function DohvatiSveProizvode($keyword){
    global $conn;

    //p.name_product, p.id_brand, p.name_product, p.id_product, p.id_category, p.addet_at, p.last_updated_at, p.available, c.id_category, c.name_category, br.id_brand

    $upit="SELECT * 
      from products p JOIN categories c ON p.id_category=c.id_category JOIN brands b ON b.id_brand=p.id_brand JOIN genders g ON p.id_gender=g.id_gender 
    WHERE p.name_product LIKE '%$keyword%' OR c.name_category LIKE '%$keyword%' OR b.name_brand LIKE '%$keyword%' 
    ORDER BY b.name_brand asc, p.added_at desc ";

    $svi = $conn->query($upit)->fetchAll(); 

    foreach($svi as $s){                    
        $s->last_price=PoslednjaCena($s->id_product); 
    }

    return $svi;
}


//products.php refresh
function DohvatiSveProizvode2(){
    global $conn;
    global $brojpostrani;

    $upit="SELECT p.id_product, p.main_picture, p.name_product, b.name_brand from products p JOIN brands b ON b.id_brand=p.id_brand 
           WHERE p.available=1 ORDER BY p.added_at desc LIMIT 0, $brojpostrani ";

    $svi = $conn->query($upit)->fetchAll(); 

    foreach($svi as $s){                    
        $s->last_price=PoslednjaCena($s->id_product); 
    }

    return $svi;
}

//filtering

////   ---   .... . .. . .. .


function PoslednjaCena($id){

    global $conn;

    $upit2="SELECT * FROM productsprices WHERE id_product=$id ORDER BY start_price_at DESC LIMIT 0,1";

    return $conn->query($upit2)->fetch()->price;

    
}

function DohvatiPodKategorijeIdCat($id){
    
    global $conn;

    $upit="SELECT * from categories WHERE id_parent = :id order by id_category desc";

    $priprema=$conn->prepare($upit);
    $priprema->bindParam(":id", $id);
    
    $priprema->execute();  //prvo ovo

    return $priprema->fetchAll(); //pa onda return pa fetch all , dok kad je samo select bez bind moze odma sve 

}

function DohvatiBrendoveIdCat($id){
    
    global $conn;

    $upit="SELECT  b.id_brand, b.name_brand, p.id_brand, p.id_category, c.id_category, c.id_parent from products p JOIN brands b ON p.id_brand=b.id_brand
           JOIN categories c ON p.id_category=c.id_category WHERE c.id_parent= :id GROUP BY b.id_brand";

    $priprema=$conn->prepare($upit);
    $priprema->bindParam(":id", $id);
    
    $priprema->execute();  //prvo ovo

    return $priprema->fetchAll(); //pa onda return pa fetch all , dok kad je samo select bez bind moze odma sve 

}



/////////////////////////////////

function NajvecaCenaUBazi(){
    global $conn;

    $upit="SELECT MAX(price) as maks FROM productsprices";

    $rez= $conn->query($upit)->fetch()->maks;

    return $rez;
    
}

function DohvatiBrojProizvoda(){
    global $conn;

    $upit="SELECT COUNT(id_product) as broj FROM products";

    $rez= $conn->query($upit)->fetch()->broj;

    return $rez;
}

function PrikazPocetnihKategorija($id){
    global $conn;

    $upit="SELECT * from categories c JOIN products p ON c.id_category=p.id_category JOIN brands b on b.id_brand=p.id_brand
             WHERE id_parent= :id GROUP BY p.id_product ORDER BY added_at desc LIMIT 0, 12";

    $priprema=$conn->prepare($upit);
    $priprema->bindParam(":id", $id);
    
    $priprema->execute();   // 

    return $priprema->fetchAll(); 
}

function TextPostarine($id){
    global $conn;

    $upit="SELECT text from texts where id_text= :id";

    $priprema=$conn->prepare($upit);
    $priprema->bindParam(":id", $id);
    
    $priprema->execute();  

    return $priprema->fetch(); 

}

function PodaciZaKorisnika($id){

    global $conn;

    $upit='SELECT * FROM users WHERE id_user= :id';

    $priprema=$conn->prepare($upit);
    $priprema->bindParam(":id", $id);

    $priprema->execute(); 
        
    return $priprema->fetch();


}

?>