<?php


if(!isset($_SESSION['admin'])){
    header("Location: index.php?page=pocetna");
    exit();
}

$id=$_GET["id"]; 

$pr=DohvatiSvePodatkeZaProizvod($id);



?>


<section class="lg-transparent-bg pb-5">      
            <div class="container reglog">
                <div class="row">                                      
                    <div class="col-12 mt-5 text-center">
                        <h2 class="font-weight-bold">Dodavanje Dodatnih Slika Za Proizvod <?= $pr->name_product ?> </h2>
                    </div>        
                </div>
                <div class="row">
                                <div class="col-12 my-4 pt-4">

                                        <?php
                                        if(isset($_SESSION["uspesnaDodatnaSlika"])):
                                            ?>
                                            <p class='alert-success my-2 py-2 px-2'><?=$_SESSION['uspesnaDodatnaSlika']?></p> 
                                        <?php     
                                        endif;
                                        unset($_SESSION["uspesnaDodatnaSlika"]);
                                        ?>

                                        <?php
                                        if(isset($_SESSION["greskaDodatnaSlika"])):
                                            ?>
                                            <p class='alert-danger my-2 py-2 px-2'><?=$_SESSION['greskaDodatnaSlika']?></p>    

                                        <?php
                                        endif;
                                        unset($_SESSION["greskaDodatnaSlika"]);
                                        ?>

                                        
                                            <?php
                                            if(isset($_SESSION["greskaTip"])):
                                                ?>
                                                <p class='alert-danger my-2 py-2 px-2'><?= $_SESSION["greskaTip"] ?></p>
                                            <?php
                                            endif;
                                            unset($_SESSION["greskaTip"]);
                                            ?>
                                          
                                          


                                            
                                        <form id="dodatneslike" name="dodatneslike" method="POST" enctype="multipart/form-data" action="models/admin/morepicturess.php" >
                                        

                                            <p class="mt-3 mb-2" >Dodajte Dodatnu Sliku sata: (Dodatne Slike se dodaju jedna po jedna)</p>
                                            <input type="file" value="slika" class="mb-5" id="slikadodatna" name="slikadodatna"/> <br/>
                                        


                                            <p id="nistedodali" class='d-none alert-danger my-2 py-2 px-2'>Niste dodali sliku!</p>
                                            <button type="submit" class="btn btn-info" name="btDodaj" id="btDodaj">Dodaj</button>

                                            <input type="hidden" name="id" value="<?=$id?>" />

                                        </form>



                                        </div>                                      
                                            <div class="col-12 mt-5 text-center">
                                                <h2 class="font-weight-bold">Brisanje SVIH Dodatnih Slika Za Proizvod <?= $pr->name_product ?> </h2>

                                                <?php
                                        if(isset($_SESSION["uspesnoBrisanjeDodatnih"])):
                                            ?>
                                            <p class='alert-success my-2 py-2 px-2'><?=$_SESSION['uspesnoBrisanjeDodatnih']?></p> 
                                        <?php     
                                        endif;
                                        unset($_SESSION["uspesnoBrisanjeDodatnih"]);
                                        ?>

                                        <?php
                                        if(isset($_SESSION["greskaBrisanjeDodatnih"])):
                                            ?>
                                            <p class='alert-danger my-2 py-2 px-2'><?=$_SESSION['greskaBrisanjeDodatnih']?></p>    

                                        <?php
                                        endif;
                                        unset($_SESSION["greskaBrisanjeDodatnih"]);
                                        ?>
                                            </div> 

                                        </div>



                                        <form name="obrisi sve"  class="mt-5 pt-5" method="POST" enctype="multipart/form-data" action="models/admin/morepicturessdeleteall.php" >
                                        

                                            <p class="mt-3 mb-4" >Brisanjem Dodatnih Slika, gubite dodatne slike i moracete da ih dodajete ispocetka.</p>

                                            <button type="submit" class="btn btn-danger" name="btObrisi" id="btObrisi">Ipak Obrisi</button>

                                            <input type="hidden" name="id" value="<?=$id?>" />

                                        </form>



                                    </div>
                                    <?php 

                                
      
                    ?>
                </div>                     
            </div>
        </section>
