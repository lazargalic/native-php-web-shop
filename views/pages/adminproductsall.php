<?php

if(!isset($_SESSION['admin'])){
    header("Location: index.php?page=pocetna");
    exit();
}

$keyword=$_POST['keyword'];
$sviproizvodi=DohvatiSveProizvode($keyword);

$action= $_SERVER['REQUEST_URI'] ;




?>
<section class="pb-5">    
            <div class="container">
                <div class="row">
                    <div class="col-12 text-center mt-5 pt-5">
                        <h2 class="font-weight-bold mt-5 pb-5" id="vrh">Svi proizvodi</h2>
                    </div>
                </div>

            <div class="container">
                <div class="row">
                    <div class="col-12 my-4">
                        <form class="form-inline" method="POST" action="<?= $action ?>">
                            <div class="form-group mx-sm-3 mb-2">
                                <label for="inputPassword2" class="sr-only">Password</label>
                                <input type="text" class="form-control" name="keyword" id="keyword" placeholder="Kljucna rec">
                            </div>
                            <button type="submit" class="btn btn-primary mb-2">Pretrazi</button>
                        </form>

                        <p class="mt-2"><i>Ukoliko obrisete proizvod, obrisacete ga i iz stavki porudzbina koje niste spakovali za slanje. Proverite da li ste spakovali porudzbine sa                                proizvodom koji planirate da obrisete. </i></p>

                    </div>
                </div>


                <a href="#skroler" class="pb-5" >Skroler</a>
                <div class="row">
                    <div class="col-12 mb-4 ma za-tabelu">

                    <div id="prikazProizvoda">
                            
                            <?php
                                        if(isset($_SESSION["uspesnoBrisanje"])):
                                            ?>
                                            <p class='alert-info my-2 py-2 px-2'><?=$_SESSION['uspesnoBrisanje']?></p> 
                                        <?php     
                                        endif;
                                        unset($_SESSION["uspesnoBrisanje"]);
                                        ?>

                                        <?php
                                        if(isset($_SESSION["greskaBrisanje"])):
                                            ?>
                                            <p class='alert-danger my-2 py-2 px-2'><?=$_SESSION['greskaBrisanje']?></p>    

                                        <?php
                                        endif;
                                        unset($_SESSION["greskaBrisanje"]);
                                        ?>

                                        


                    <table  class="table table-striped">

                    <thead>
                        <tr>
                        <th scope="col">Slika</th>
                        <th scope="col">Brend</th>
                        <th scope="col">Naziv</th>
                        <th scope="col">Id</th>
                        <th scope="col">Na stanju</th>
                        <th scope="col">Cena</th>
                        <th scope="col">*Dodat*</th>
                        <th scope="col">Azuriran</th>
                        <th scope="col"></th>
                        <th scope="col"></th>
                        <th scope="col"></th>
                        </tr>
                    </thead>
                    <tbody id="ispisProizvoda">
                        
                            <?php
                           
                            foreach($sviproizvodi as $s): 
                            ?>
                                <tr>
                                <th> <img src="<?= $s->main_picture?>" width="70px" alt="<?= $s->name_product?>"  /> </th>
                                <th><?=$s->name_brand?></th>
                                <th><?=$s->name_product?></th>
                                <th><?=$s->id_product?></th>
                                <th><?=$s->available ? "Dostupan": "Nedostupan" ;?></th>
                                <th><?=$s->last_price?></th>
                                <th><?=$s->added_at?></th>
                                <th><?= $s->last_updated_at? $s->last_updated_at: "Nije"; ?></th>
                                <td> <a href="index.php?page=izmena-proizvoda&id=<?=$s->id_product?>"> <button class="btn btn-info ">Izmeni Proizvod</button> </a> </td>
                                <td> 
                                    <form method="POST" action="models/admin/deleteproductt.php">
                                        <button type="submit" class='btn btn-danger'>
                                            Obrisi Proizvod
                                        </button>
                                        <input type="hidden" name="id" value="<?= $s->id_product?>"/>
                                    </form>
                                </td>
                                <td> <a href="index.php?page=dodatne-slike&id=<?=$s->id_product?> "> <button class="btn btn-warning ">Dodatne Slike</button> </a> </td>
                                
                                </tr>
                            <?php
                               
                            endforeach;
                        
                            ?>
                    
                    </tbody>
                    </table>
                    </div>
                </div>
                     
                <a href="#vrh" id="skroler" class="pt-5 pl-2">Nazad na vrh</a>


            </div>

    </section>