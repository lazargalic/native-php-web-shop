<?php

if(!isset($_SESSION['admin'])){
    header("Location: index.php?page=pocetna");
    exit();
}


$glavneKat=DohvatiGlavneKategorije();

?>
<section class="pb-5">    
            <div class="container">
                <div class="row">
                    <div class="col-12 text-center mt-5 pt-5">
                        <h2 class="font-weight-bold mt-5 pb-5">Kategorije</h2>
                    </div>
                   
                </div>
                <div class="row">
                    <div class="col-12 my-4  text-center">
                        <h3 id="DodajKat">Dodavanje Podkategorije</h3>
                    </div>
                </div>
                <div class="row">
                    <div class="col-9 mb-4 ma">


                    <form class="my-5" id="formcatadd" method="POST" >
                        <div class="form-row d-flex justify-content-center">

                            <div class="col-auto">
                            <input type="text" class="form-control mb-2" id="naziv" name="naziv" placeholder="Naziv Kategorije">
                            </div>

                            <div class="col-auto">
                            <div class="input-group mb-2">
                                <div class="input-group-prepend">
                                <div class="input-group-text">*</div>
                            </div>
                            
                            <select id="roditelj" name="roditelj" class="form-control" aria-label="multiple select example">
                            <option value='0'>Izaberi</option> <!-- -->

                                <?php
                                foreach ($glavneKat as $k) {
                                    echo "<option value='$k->id_category'>$k->name_category</option>";
                                }
                                
                                ?>
                                
                            </select>
                            </div>
                            
                            </div>
                            <div class="col-auto">
                            <div class="form-check mb-2">
                                <input class="form-check-input" type="checkbox" id="autoSizingCheck" name="autoSizingCheck">
                                <label class="form-check-label" for="autoSizingCheck">
                                Siguran sam
                                </label>
                            </div>
                            </div>
                            <div class="col-auto">
                            <button type="button" id="dodaj" name="dodaj" class="btn btn-primary mb-2  ml-3">Dodaj</button>
                            </div>
                    
                            <p id="greska" class="d-none alert-danger mt-2 px-3 py-1">Reci u nazivu moraju poceti velikim pocetnim slovima! Checkbox 'Siguran sam' je obavezan kao i roditeljska kategorija.</p>
                 
                            <div>
                               <!-- <p id="uspehKategorije" class="alert-success mt-2 px-3 py-1">Uspesno ste dodali kategoriju!</p>  -->
                            </div>
                        </div>
                    </form>

                    </div>
                </div>




                <div class="row">
                    <div class="col-12 my-4 text-center">
                        <h3 id="DodajKat">Sve Podkategorije</h3>
                        <p class="mt-2"><i>Ukoliko obrisete podkategoriju, obrisacete i sve proizvode koji su u toj podkategoriji. </i></p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-9 mb-4 ma">
                    <div id="prikazPodKat" class="pola">
                    <ul>
                    <?php
                    $svePodKat=DohvatiPodKategorije();
                    
                    //var_dump($svePodKat);
                    
                    
                    foreach($svePodKat as $s):

                    ?>

                    
                        <div class="d-flex justify-content-between py-2" >
                    <li class="font-weight-bold my-2 text-dark"><?= $s->name_category?></li>
                   <button class="obrisikat btn btn-danger" vrednost="<?= $s->id_category?>">
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