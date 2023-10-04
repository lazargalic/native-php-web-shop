<?php

if(!isset($_SESSION['admin'])){
    header("Location: index.php?page=pocetna");
    exit();
}

$idpayment=$_GET['idpaym'];
$iduserpayment=$_GET['iduspay'];

$proizvodiPorudzbine=DohvatiProizvodePorudzbine($idpayment);
$ukupno=0;

$podaciKorisnikaPorudzbine=DohvatiPodatkeKorisnikaPorudzbine($iduserpayment);

?>
<section class="pb-5">    
            <div class="container">
                <div class="row">
                    <div class="col-12 text-center mt-5 pt-5">
                        <h2 class="font-weight-bold mt-5 pb-5">Porudzbina <?= $idpayment?></h2>
                    </div>
                   
                </div>
                <div class="row">
                    <div class="col-12 my-4 pb-5 text-center">
                        <h3 id="DodajKat">Naruceni Artikli</h3>
                    </div>
                </div>
                <div class="row">
                <div class="col-12 za-tabelu">
                        <table  class="table table-striped">
                        <thead>
                            <tr>
                            <th scope="col">Slika</th>
                            <th scope="col">Proizvod</th>
                            <th scope="col">Kategorija</th>
                            <th scope="col">Kolicina</th>
                            <th scope="col">Ukupna Cena</th>

                            </tr>
                        </thead>
                        <tbody id="ispisPorudzbine">
                            
                                <?php
                                //var_dump($proizvodiPorudzbine);
                               
                                foreach($proizvodiPorudzbine as $s):
                                    
                                    $ukupno+=$s->total_price;
                                    
                                    echo "<tr>";
                                    echo "<th><img src='$s->main_picture' width='75' alt='slika' /></th>";
                                    echo "<th>$s->name_brand $s->name_product</th>";
                                    echo "<th>$s->name_category</th>";
                                    echo "<th>$s->quantity</th>";
                                    echo "<th>$s->total_price</th>";
                                   
                                endforeach;
                            
                                ?>
                        
                        </tbody>
                        </table>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 text-center">
                        <h2 class="pt-5 pb-2">Ukupno</h2>
                        <h3 class="font-weight-bold"><?=$ukupno ?> rsd</h3>
                
                    </div>
                </div>

                <div class="row mb-5">
                    <div class="col-12">
                        <h2 class="pt-5 pb-5 align-center ">Podaci Za Slanje: </h2>
                        
                        <?php
                            foreach($podaciKorisnikaPorudzbine as $p):
                        ?>
                        <div class="podaci">
                            <h4>Ime i Prezime: <span class="font-weight-bolder"> <?= $p->first_name?> <?= $p->last_name?> </span></h4>
                            <h4>Adresa: <span class="font-weight-bolder"> <?= $p->adress?> </span></h4>
                            <h4>Grad/Opstina: <span class="font-weight-bolder"> <?= $p->name_teritory?> </span></h4>
                            <h4>Mesto: <span class="font-weight-bolder"> <?= $p->location?> </span></h4>
                            <h4>Postanski Broj: <span class="font-weight-bolder"> <?= $p->zip_code?> </span></h4>
                            <h4>Mobilni <span class="font-weight-bolder"> <?= $p->mobile?> </span></h4>
                        </div>
                        <?php
                            endforeach;
                        ?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 text-center">
                    <form name="obrisiporudzbinu" method="POST" action="models/admin/DELpayment.php" >
                            <button type="submit" class="btn btn-success py-4" name="btDel" id="btDel">SPAKOVANO I SPREMNO ZA SLANJE</button>
                            <input type="hidden" name="idpay" value="<?=$idpayment?>" />
                        </form>
                    </div>
                </div>

            </div>
    </section>