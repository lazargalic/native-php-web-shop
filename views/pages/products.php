<!-- ***** Products Area Starts ***** -->
<?php 



$brendovi=DohvatiSveBrendove();
$glkat=DohvatiGlavneKategorije();
$podkat=DohvatiPodKategorije();
$polovi=DohvatiPolove();
$maxcena=NajvecaCenaUBazi() + 10;

$proizvodi=DohvatiSveProizvode2();
$brojubazi=DohvatiBrojProizvoda();
$brojpostrani=16;
$strana=ceil($brojubazi/$brojpostrani);



?>

<div class="container">
            <div class="row">
                <div class="col-lg-12 my-5">
                    <div class="section-heading mt-5 pt-5 text-center"> 
                        <h1>Dostupni Proizvodi</h1>
                    </div>
                </div>
            </div>
        </div>

<div id="drzac">


    <div id="filteri" class="mt-5 py-4 " >

                    <div class="row d-flex justify-content-end" >
                    <button type="button" id="close" class="close px-1 py-1" aria-label="Close">
                        &times;
                    </button>
                    </div>



                     
                    <div class="col-12 ml-2 mb-4">
                        <button type="button" class="primenifilterepaginaciju btn btn-primary">Primeni Filtere </button>
                    </div>
                    <hr/>  
                    <div class="row col-12 my-4 ml-1">
                        <input type="text" class="px-1" placeholder="Pretraga" id="keyword" />
                    </div>
                    <hr/>  
                        <div class="row pb-4">    
                            <select id="kategorija"  class="selectt form-select ml-3">
                                <option value="0">Sve kategorije </option>
                                <?php

                                    foreach($glkat as $g):
                                        
                                ?>
                                    <option class="glavnekat" value="<?= $g->id_category ?>"><?= $g->name_category ?></option>
                                <?php
                                    endforeach;
                                ?>
                            </select>
                        </div>
                        <div class="py-3">
                            <div id="prikazpodkat" class="prikaz">
                            <?php
                                foreach($podkat as $p):
                                    
                            ?>    
                                 <div class="col-12">
                                 <input type="checkbox" class="podkat" name="podkategorije" value="<?= $p->id_category ?>"  /> <?= $p->name_category ?>     
                
                                 </div>
                               
                            <?php
                                endforeach;
                            ?>
                            </div>

                        </div>
                        <hr/>  


                        <div class="py-3">
                            <div class="ml-3 mb-2">
                               <label>Brendovi</label>
                            </div>
                            
                            <div id="prikazbrendovi" class="prikaz">
                            <?php
                                foreach($brendovi as $b):
                                    
                            ?>    
                                 <div class="col-12">
                                 <input type="checkbox" class="brendovi" name="brendovi" value="<?= $b->id_brand ?>"  /> <?= $b->name_brand ?>     
                                 </div>
                               
                            <?php
                                endforeach;
                            ?>
                            </div>
                        </div>
                        <hr/>  



                        <div class="py-2">
                            <div id="radioPol">
                            <div class="col-12 ml-2">
                               <label>Odeljak</label>
                            </div>
                                <?php 
                                    foreach($polovi as $p):
                                ?>
                                   <div class="col-12 ml-1">
                                        <label for="<?= $p->name_gender?>"><?= $p->name_gender?></label>
                                        <input type="radio" id="<?= $p->name_gender?>" name="pol" value="<?= $p->id_gender?>" />
                                    </div>
                                <?php
                                    endforeach;
                                ?>
                            </div>
                        </div>
                        <hr/>  
                        <div class="py-2">
                            <div class="col-12">
                                <label for="cena-id">Cena od 0 do <span id="cenado"><?= $maxcena + 10?></span>rsd</label>
                            </div>
                            <div class="col-12 pl-3">
                                <input type="range" id="cenamax" min="0" max="<?= $maxcena + 10?>" value="<?= $maxcena + 10?>"/>
                            </div>   
                        </div>
                        <div class="py-2">
                            <div class="col-12">
                                <label>Sortiraj po Ceni:</label>
                            </div>
                        <select id="sortcena"  class="selectt form-select ml-3">
                                <option value="0">Izaberi </option>
                                <option value="1">Rastuće</option>
                                <option value="2">Opadajuće</option>
                            </select>
                        </div>



    </div>


    <?php
    
    //$vr=FiltrirajSveProizvode('kirke',0,0,0,0,0);
    //var_dump($vr);
    ?>


    <div class="section reglog " id="products">

        <div class="container">

        <div id="filtriraj" class="col-12 mb-5 pl-4">
            <button type="button" class="btn btn-dark">Filtriraj Proizvode </button>
        </div>

            <div id="ispisproizvoda" class="row pl-4">

                <?php foreach($proizvodi as $p): ?>

                <div class="proizvod-jedan">
                    <div class="item">
                        <div class="thumb">
                            <div class="hover-content">
                                <ul>
                                    <li><a href="index.php?page=proizvod&id=<?= $p->id_product ?>" rel="nofollow"><i class="fa fa-eye"></i></a></li>
                                    <li><a class="dodajUkorpu" vrednost="<?= $p->id_product?>"><i class="fa fa-shopping-cart"></i></a></li>
                                    <li><a class="dodajUFav" vrednost="<?= $p->id_product?>"><i class="fa fa-star"></i></a></li>
                                </ul>
                            </div>
                            <img src="<?= $p->main_picture?>" alt="<?= $p->name_product?>" class="slikaproizvoda" />
                        </div>
                        <div class="down-content text-center pb-2">
                            <p class="imepr"><?= $p->name_brand?> <?= $p->name_product?></p>
                            <p class="cenalast" ><?= $p->last_price?> rsd</p>
                        </div>
                    </div>
                </div>

                <?php
                    endforeach;
                ?>

            </div>

           
            <nav id="paginacija"  aria-label="Page navigation example ">
                <div id="ispispaginacija" class="za-tabelu ">
                        <ul class="pagination">
                            
                            <li class="page-item ">
                            <a class="page-link primenifilterepaginaciju" vrednost="0" aria-label="Previous">
                                <span aria-hidden="true">&laquo;</span>
                            </a>
                            </li>
                            <?php
                            
                                for($i=0; $i< $strana ;$i++):
                                    /* if($i< 2 || $i> $strana -3){
                                        */
                            ?>

                            <a class="page-link primenifilterepaginaciju" vrednost="<?= $i ?>"> 
                                <li class="page-item"> <?= $i+1 ?></li>
                            </a>

                            <?php 
                            /*
                                    }
                                    else{
                                        echo " . ";
                                    }*/
                                endfor;
                            
                            ?>

                            <a class="page-link primenifilterepaginaciju" vrednost="<?= $strana-1 ?>" aria-label="Next">
                                <span aria-hidden="true">&raquo;</span>
                            </a>

                            </li>

                           
                        </ul>
                </div>        
            </nav>
           
            

        </div>
    </div>

</div>
<!-- ***** Products Area Ends ***** -->
<hr/>

