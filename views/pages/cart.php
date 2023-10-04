<?php 

if(!isset($_SESSION['korisnik']) && !isset($_SESSION['korpaneulogovan']) ){
    header("Location: index.php?page=pocetna");
    exit();
}



if(isset($_SESSION['korisnik'])){
    $korpa=DohvatiIdKorpe($korisnik->id_user);
}
else{
    $korpa=$_SESSION['korpaneulogovan'];
}

$proizvodikorpa=DohvatiProizvodeKorpe($korpa);
$ukupnacenakorpe=DohvatiSumuCenaZaKorpu($korpa);


?>

<div class="py-5">      
            <div class="container">
                <div class="row">
                    <div class="col-12 text-center pt-5 my-5">
                        <h2 class="font-weight-bold">Vasa Korpa </h2>
                    </div>
                </div>                     
                

                <div class="col-12 mb-4 ma za-tabelu">
                    <table  class="table table-striped">

                    <thead>
                        <tr>
                        <th scope="col">Proizvod</th>
                        <th scope="col">Naziv</th>
                        <th scope="col">Kolicina</th>
                        <th scope="col">Cena</th>
                        <th scope="col"></th>
                        </tr>
                    </thead>

                                      
                    <?php
                           
                           if(count($proizvodikorpa)!=0){

                    ?>

                    <tbody id="ispisProizvodaKorpe">

<?php
                            foreach($proizvodikorpa as $s): 
                            ?>
                                <tr>
                                <th><div> <img src="<?= $s->main_picture?>" width="90px" alt="<?= $s->name_product?>"  /> </div></th>
                                <th><div class="pt-4"><?=$s->name_brand?> <?=$s->name_product?></div></th>

                                <th>  
                                    <div class="pt-4">
                                           <input type="button" value="-" id_cart="<?= $s->id_cart ?>" idcartitem="<?= $s->id_cart_item?>" class="minus korpaquantity">
                                                &nbsp;&nbsp;   <?= $s->quantity  ?>  &nbsp;&nbsp;
                                            <input type="button" value="+" id_cart="<?= $s->id_cart ?>" idcartitem="<?= $s->id_cart_item?>" class="plus korpaquantity">
                                    </div>
                                </th>

                                <th><div class="pt-4"><?=$s->latestprice * $s->quantity?> rsd</div></th>
                                <th scope="col"> <div class="pt-3">
                                    <button type="button" idcart="<?= $s->id_cart ?>" vrednost="<?= $s->id_cart_item?>" class='uklonired btn btn-light'>
                                            Ukloni
                                        </button> </div>
                                </th>
                
                                </tr>
                            <?php
                               
                            endforeach;

                           


                            
                        
                            ?>
                    
                    </tbody>
                        
                    <div id="prazno">
                    <?php
                    }
                    else{
                                                
                        echo "
                        <div class='bg-info py-3 px-3'>
                            <h6> Trenutno nema proizvoda. </h6>
                        </div>";
                        
                    }

                    ?>
                    </div>


                    </table>
                    </div>

                    <div class="col-12 text-center pt-5">
                            <h2 class="pb-3"> Ukupno: </h2>
                            <h3 class="font-weight-bold"> <span id="ukupno"><?= $ukupnacenakorpe ?><span> rsd</h3>
                    </div>



                    <div class="col-12 d-flex justify-content-between pt-5">
                
                    <a href="index.php?page=proizvodi">
                    <button type="button"  class='nastavi btn btn-info p-2'>
                       Nastavi Kupovinu
                    </button>
                    </a>


                    <?php
                      if(count($proizvodikorpa)!=0){
                    ?>
                    <a href="index.php?page=kasa">
                    <button type="button" id="plati"  class='btn btn-success p-3'>
                       Idi na Kasu
                    </button>
                    </a>

                    <?php
                      }
                    ?>
                    
                    </div>





                 

                </div>
            </div>
</div>