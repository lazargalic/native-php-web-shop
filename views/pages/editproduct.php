<?php


if(!isset($_SESSION['admin'])){
    header("Location: index.php?page=pocetna");
    exit();
}

$id=$_GET["id"]; 

$pr=DohvatiSvePodatkeZaProizvod($id);

$brendovi=DohvatiSveBrendove();
$kat=DohvatiPodKategorije();
$polovi=DohvatiPolove();



?>


<section class="lg-transparent-bg pb-5">      
            <div class="container reglog">
                <div class="row">                                      
                    <div class="col-12 mt-5 text-center">
                        <h2 class="font-weight-bold">Izmeni Proizvod <?= $pr->name_product ?> </h2>
                    </div>        
                </div>
                <div class="row">
                                <div class="col-12 my-4 pt-4">

                                    <?php
                                        if(isset($_SESSION["uspesnaIzmena"])):
                                            ?>
                                            <p class='alert-success my-2 py-2 px-2'><?=$_SESSION['uspesnaIzmena']?></p> 
                                        <?php     
                                        endif;
                                        unset($_SESSION["uspesnaIzmena"]);
                                        ?>

                                        <?php
                                        if(isset($_SESSION["greskaIzmena"])):
                                            ?>
                                            <p class='alert-danger my-2 py-2 px-2'><?=$_SESSION['greskaIzmena']?></p>    

                                        <?php
                                        endif;
                                        unset($_SESSION["greskaIzmena"]);
                                        ?>

                                        
                                            <?php
                                            if(isset($_SESSION["greskaTip"])):
                                                ?>
                                                <p class='alert-danger my-2 py-2 px-2'><?= $_SESSION["greskaTip"] ?></p>
                                            <?php
                                            endif;
                                            unset($_SESSION["greskaTip"]);
                                        ?>
                                          
                                          


                                            
                                        <form id="izmeni" name="izmeni" method="POST" enctype="multipart/form-data" action="models/admin/editproductt.php" >
                                            <div class="form-group">
                                                <label for="exampleFormControlInput1">Naziv Proizvoda</label>
                                                
                                                <input type="text" name="naziv" value="<?= $pr->name_product?>" class="form-control" id="exampleFormControlInput1"/>  <!-- *** -->
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleFormControlSelect1">Brend</label>
                                                <?php     
                                                ?>
                                                <select class="form-control" name="brend" id="exampleFormControlSelect1">
                                                <?php
                                                foreach($brendovi as $b):
                                                    if($pr->id_brand==$b->id_brand){
                                                        echo "<option value='$b->id_brand' selected >$b->name_brand</option>";
                                                    }
                                                    else {
                                                        echo "<option value='$b->id_brand'>$b->name_brand</option>";
                                                    }
                                                endforeach;
                                                ?>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleFormControlSelect2">Kategorija </label>
                                                <select class="form-control" name="kategorija" id="exampleFormControlSelect2">
                                                <?php
                                                foreach($kat as $k):
                                                    if($pr->id_category==$k->id_category){
                                                        echo "<option selected value='$k->id_category'>$k->name_category</option>";
                                                    }
                                                    else {
                                                        echo "<option value='$k->id_category'>$k->name_category</option>";
                                                    }
                                                endforeach;
                                                ?>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleFormControlSelect3">Odeljak</label>
                                                <select class="form-control" name="pol" id="exampleFormControlSelect3">
                                                <?php
                                                foreach($polovi as $p):
                                                    if($pr->id_gender==$p->id_gender){
                                                        echo "<option selected value='$p->id_gender'>$p->name_gender </option>";
                                                    }
                                                    else{
                                                        echo "<option value='$p->id_gender'>$p->name_gender </option>";
                                                    }
                                                endforeach;
                                                ?>
                                                </select>
                                            </div>

                                            <div class="form-group">
                                                <label for="exampleFormControlSelect3">Dostupnost</label>
                                                <select class="form-control" name="dostupnost" id="exampleFormControlSelect4">
                                                <?php

                                                    if($pr->available==1){
                                                        echo "<option selected value='1'>Dostupan </option>";
                                                    }
                                                    else{
                                                        echo "<option value='1'>Dostupan </option>";
                                                    }

                                                    if($pr->available==0){
                                                        echo "<option selected value='0'>Nedostupan </option>";
                                                    }
                                                    else{
                                                        echo "<option value='0'>Nedostupan </option>";
                                                    }

                                               
                                                ?>
                                                </select>
                                            </div>

                                            <div class="form-group">
                                                <label for="exampleFormControlInput2">Cena u rsd</label>
                                                <input type="number" class="form-control" value="<?= $pr->last_price?>" name="cena" id="exampleFormControlInput2">
                                            </div>


                                            <div class="form-group mb-4">
                                                <label for="exampleFormControlTextarea1">Opis</label>
                                                <textarea class="form-control" id="exampleFormControlTextarea1" name="opis" rows="3"><?= $pr->description ?></textarea>
                                            </div>

                                            <div class="form-group mb-4">
                                            <img src="<?= $pr->main_picture?>" alt="<?= $pr->name_product?>" class="slikaproizvodaadmin">
                                            </div>


                                            <p>Nova GLAVNA slika sata: (Ukoliko se ne odabere ostace stara)</p>
                                            <input type="file" value="slika" class="mb-5" name="slikanova"/> <br/>
                                        


                                            <p id="nistedodali" class='d-none alert-danger my-2 py-2 px-2'>Niste dobro uneli podatke, sve se mora popuniti, Nazivi velikim pocetnim slovom i brojevi ne smeju biti u minusu!</p>
                                            <button type="submit" class="btn btn-info" name="btIzmeni" id="btIzmeni">Izmeni</button>

                                            <input type="hidden" name="id" value="<?=$id?>" />
                                            <input type="hidden" name="slikastara" value="<?= $pr->main_picture?>" />

                                        </form>




                                    </div>
                                    <?php 

                                
      
                    ?>
                </div>                     
            </div>
        </section>
