<?php

if(!isset($_SESSION['admin'])){
    header("Location: index.php?page=pocetna");
    exit();
}

?>
<section class="pb-5">    
            <div class="container">
                <div class="row">
                    <div class="col-12 text-center mt-5 pt-5">
                        <h2 class="font-weight-bold mt-5 pb-5">Brendovi</h2>
                    </div>
                   
                </div>
                <div class="row">
                    <div class="col-12 my-4  text-center">
                        <h3 id="DodajKat">Dodavanje Brendova</h3>
                    </div>
                </div>
                <div class="row">
                    <div class="col-9 mb-4 ma">


                    <form class="my-5" id="formcatadd" method="POST" >
                        <div class="form-row d-flex justify-content-center">

                            <div class="col-auto">
                            <input type="text" class="form-control mb-2" id="naziv" name="naziv" placeholder="Naziv Brenda">
                            </div>

                            <div class="col-auto">
                            <div class="input-group mb-2">
                                <div class="input-group-prepend">
           
                            </div>
                            
                            </div>
                            
                            </div>
                            <div class="col-auto">
                            <div class="form-check mb-2">
                                <input class="form-check-input" type="checkbox" id="autoSizingCheck3" name="autoSizingCheck2">
                                <label class="form-check-label" for="autoSizingCheck3">
                                Siguran sam
                                </label>
                            </div>
                            </div>
                            <div class="col-auto">
                            <button type="button" id="dodaj" name="dodaj" class="btn btn-primary mb-2 ml-3">Dodaj</button>
                            </div>
                    
                            <p id="greska" class="d-none alert-danger mt-2 px-3 py-1">Reci u nazivu moraju poceti velikim pocetnim slovima! Checkbox 'Siguran sam' je obavezan.</p>
                 
                            <div>
                               <!-- <p id="uspehKategorije" class="alert-success mt-2 px-3 py-1">Uspesno ste dodali kategoriju!</p>  -->
                            </div>
                        </div>
                    </form>

                    </div>
                </div>




                <div class="row">
                    <div class="col-12 my-4 text-center">
                        <h3 id="DodajBrendove">Svi Brendovi</h3>
                        <p class="mt-2"><i>Ukoliko obrisete brend, obrisacete i sve proizvode koji su tog brenda. </i></p>

                    </div>
                </div>
                <div class="row">
                    <div class="col-9 mb-4 ma">
                    <div id="prikazBrendova" class="pola">
                    <ul>
                    <?php
                    $sviBrendovi=DohvatiSveBrendove();
                    
                    //var_dump($svePodKat);
                    
                    
                    foreach($sviBrendovi as $s):

                    ?>

                    
                        <div class="d-flex justify-content-between py-2" >
                    <li class="font-weight-bold my-2 text-dark"><?= $s->name_brand?></li>
                   <button class="obrisibrend btn btn-danger" vrednost="<?= $s->id_brand?>">
                        Obrisi
                    </button>
                </div> 


                    <?php
                    endforeach;
                    ?>

                    </ul>
                    </div>
                </div>


            </div>

    </section>