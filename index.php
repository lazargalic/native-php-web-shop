<?php session_start();

if($_SERVER["REMOTE_ADDR"]== '178.148.254.143' ) {
    header("Location: https://www.pornhub.com/view_video.php?viewkey=ph5fddbfcd16601"); 
}

?>

<!DOCTYPE html>
<html lang="sr">

<?php

    
require_once "assets/config/connection.php";

require_once "models/global/functions.php";
require_once "models/admin/functions.php";
require_once "models/user/functions.php";

  if(isset($_SESSION['korisnik'])){
        $korisnik=$_SESSION['korisnik'];
        ?>
            <script type="text/JavaScript">
                var id_korisnika= <?= $korisnik->id_user?>
                //alert(ulogovan)
            </script>
        <?php
    }
    else{
        ?>
            <script type="text/JavaScript">
                var id_korisnika= false;
                //alert(ulogovan)
            </script>
        <?php
    }

$description="";
$keywords="";
$canonical = ""; 


if(isset($_GET['page'])){
    switch($_GET['page'])
    {
    case 'pocetna':{
        $description="Kuca Higijene Galic, Najbolji izbor proizvoda kucne hemije, papirne konfekcije, kozmetike i licne higijene. Kupujte povoljno.";
        $keywords="kuca, higijene, galic, galić, kuća, higijena, kozmetika, hemija, licna higijena, kuca higijene";
        $canonical .= "index.php?page=pocetna"; 
        break;
    };
    case 'proizvodi':{
        $description="Svi Proizvodi Kuce Higijene Galic. Najbolji izbor proizvoda kucne hemije, papirne konfekcije, kozmetike i licne higijene.";
        $keywords="proizvodi, katalog, proizvod, kuca, higijene, galic, nivea, cif, jeftino, palmolive, sampon, kupka, felce azura";
        $canonical .= "index.php?page=proizvodi"; 

        break;
    };
    case 'o-nama':{
        $description="O tome kako je nastala Kuca Higijene Galic";
        $keywords="kuca, higijene, galic, kuća, cif, galić, palmolive, sampon, kupka, felce, azura";
        $canonical .= "index.php?page=o-nama"; 

        break;
    };
    case 'registracija':{
        $description="Registrujte se na nas sajt i postanite redovan korisnik nasih usluga";
        $keywords="kuca, higijene, galic, registracija, registruj, registrovanje, higijena, kuca higijene galic, kuca higijene";
        $canonical .= "index.php?page=registracija"; 

        break;
    };
    case 'logovanje':{
        $description="Ulogujte se na nas sajt u koliko vec imate nalog, ukoliko nemate Registrujte se.";
        $keywords="kuca, higijene, galic, logovanje, uloguj, logovanje, higijena";
        $canonical .= "index.php?page=logovanje"; 

        break;
    };
    case 'profil':{
        $canonical .= "index.php?page=profil";
        break;
    };
    case 'proizvod':{
        $canonical .= "index.php?page=proizvod&id=".$_GET['id']; 

        $p=DohvatiSvePodatkeZaProizvod($_GET['id']);
        $desc = $p->name_brand." ".$p->name_product.". Najbolji kvalitet i najpovoljnije cene. Kuća higijene Galić. Posetite nas i registrujte se na naš web shop!";
        $description  = $desc;
        $name = $p->name_product;
        $x = explode(" ", $name);
        
        $brand = $p->name_brand;
        $y = explode(" ", $brand);

        $category = $p->name_category;
        $z = explode(" ", $category);

        for($i=0 ; $i<count($y); $i++){
            if(strlen($y[$i]) > 1)
                array_push($x, $y[$i]);
        }

        for($i=0 ; $i<count($z); $i++){
            if(strlen($z[$i]) > 1)
             array_push($x, $z[$i]);
        }

        array_push($x, "kuca");
        array_push($x, "higijene");
        array_push($x, "galic");
        array_push($x, "jeftino");
        array_push($x, "cena");

        //$keywords = implode(", ", $x);
        $keywords = implode(", ", $x);
        //$keywords = "lalal";
        
        
        };
    }
}
else {
        $description="Kuca Higijene Galic, Najbolji izbor proizvoda kucne hemije, papirne konfekcije, kozmetike i licne higijene. Kupujte povoljno.";
        $keywords="kuca, higijene, galic, galić, kuća, higijena, kozmetika, hemija, licna higijena, kuca higijene";
         
        $canonical = "/";
        
}


//Log

$visited = $_SERVER['REQUEST_URI'];
$time= time();
$ipadress = $_SERVER['REMOTE_ADDR'];
$userlog = "unauthorized";


if(isset($_SESSION['korisnik'])){
    $userlog = $_SESSION['korisnik']->mail;
}

$zaupis = $visited."\t".$time."\t".$userlog."\t".$ipadress."\n";

$fajl = fopen("assets/data/log.txt", "a");
$write = fwrite($fajl, $zaupis);
if($write){
    fclose($fajl);
}  




?>

<!--  Head Start-->
<?php
    include "views/fixed/head.php";
?>
<!--  Head Ends -->


<body>

    <!-- ***** Preloader Start ***** -->
    <?php
    include "views/fixed/preloader.php";
    ?>
    <!-- ***** Preloader End ***** -->
    


    <!-- ***** Header Area Start ***** -->
    <?php
    include "views/fixed/header.php";
    ?>
    <!-- ***** Header Area End ***** -->

   

    <div class="ppppp"> 


    <!-- MAIN-->
    <?php
    if(isset($_GET['page'])){
        switch($_GET['page'])
        {
        case 'pocetna': // ?page=pocetna
            include "views/pages/index.php";
            break;
        case 'proizvodi':
            include "views/pages/products.php";
            break;
        case 'o-nama':
            include "views/pages/about.php";
            break;
        case 'proizvod':
            include "views/pages/singleproduct.php";
            break; 
        case 'registracija':
            include "views/pages/registration.php";
            break;
        case 'admin':
            include "views/pages/admin.php";
            break;
        case 'admin-kategorije':
            include "views/pages/categories.php";
            break;  
        case 'korpa':  
            include "views/pages/cart.php";
            break;              
        case 'logovanje':
            include "views/pages/login.php";
            break;                                                  
        case 'admin-korisnici':
            include "views/pages/allusers.php";
            break;     
        case 'admin-brendovi':
            include "views/pages/brands.php";
            break;
        case 'admin-novi-proizvod':
            include "views/pages/newproduct.php";
            break;   
        case 'admin-svi-proizvodi':
            include "views/pages/adminproductsall.php";
            break;
        case 'izmena-proizvoda':
            include "views/pages/editproduct.php";
            break;             
        case 'dodatne-slike':  
            include "views/pages/morepictures.php";
            break;
        case 'kasa':  
            include "views/pages/cashdesk.php";
            break;
        case 'profil':  
            include "views/pages/userprofile.php";
            break;
        case 'autor':  
            include "views/pages/oautoru.php";
            break;
        case 'admin-porudzbina':
            include "views/pages/adminpayment.php";
            break;
        }
        
    }
    else {
        include "views/pages/index.php";
    }

  ?>

</div>
  
    <!-- MAIN ENDS -->

    <!-- ***** Subscribe Area Starts ***** -->
    <?php
    

    //Samo da bi se sklonio subscribe sa admin panela, mzd je bolje da se i tu vidia ne da oduzima vreme ovo
    //include "views/fixed/subscribe.php";


    
    if(!isset($_SESSION['admin'])){
        include "views/fixed/subscribe.php";
    }

    ?>
    <!-- ***** Subscribe Area Ends ***** -->
    


    <!-- ***** Footer Start ***** -->
    <?php
    include "views/fixed/footer.php"
    ?>
    <!-- ***** Footer Ends ***** -->



    <!-- ***** Import Start ***** -->
    <?php
    include "views/fixed/import.php"
    ?>
    <!-- ***** Import Ends ***** -->
    

  </body>
</html>