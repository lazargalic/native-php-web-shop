<?php

if(!isset($_SESSION['korisnik'])){
    header("Location: index.php?page=pocetna");
    exit();
}


$omiljeno=DohvatiOmiljeneKorisnika($korisnik->id_user);

?>
<section class="pb-5">    
            <div class="container">
                <div class="row">
            
                    <div class="col-12 text-center mt-5 pt-5">
                        <h1 class="font-weight-bold mt-5 pb-5"><?=$korisnik->first_name?> <?= $korisnik->last_name?> Profil</h1>
                    </div>
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
                    <div class="col-12 mb-2 mt-2 pb-4 text-center">
                            
                    <h2 class="mb-3">Profilna Slika</h2>
                        <div>
                            <img src="<?= $korisnik->big_picture?>" width="250" />
                        </div>

                        <form id="profilnanova" name="profilnanova" method="POST" enctype="multipart/form-data" action="models/user/profilepicture.php" >
                                        

                            <p class="mt-3 mb-2" >Otpremite Novu Profilnu Sliku</p>
                            <input type="file" value="slika" class="mb-5" id="slikaprofilna" name="slikaprofilna"/> <br/>
                                    


                            <p id="nistedodali" class='d-none alert-danger my-2 py-2 px-2'>Niste dodali sliku!</p>
                            <button type="submit" class="btn btn-info" name="btDodaj" id="btDodaj">Dodaj</button>


                            
                            <input type="hidden" name="id" value="<?=$korisnik->id_user?>" />

                        </form>  
                
                    </div>
                    </div>
                        <div class="container">

                        <div class="row">
                                    <div class="col-12">
                                        <div class="section-heading text-center pb-5">
                                            <h2>Omiljeno</h2>
                                        </div>
                                    </div>
                                </div>
                        </div>
                    
                        <section class="section" id="men">


                            <div class="container">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="men-item-carousel">
                                            <div class="owl-men-item owl-carousel">
                                        <?php
                                            foreach($omiljeno as $p):
                                        ?>

                                        <div class="item">
                                            <div class="thumb">
                                                <div class="hover-content">
                                                    <ul>
                                                    <li><a href="index.php?page=proizvod&id=<?= $p->id_product ?>"><i class="fa fa-eye"></i></a></li>
                                                        <li><a class="dodajUkorpu" vrednost="<?= $p->id_product?>"><i class="fa fa-shopping-cart"></i></a></li>
                                                        <li><a class="dodajUFav" vrednost="<?= $p->id_product?>"><i class="fa fa-star"></i></a></li>
                                                    </ul>
                                                </div>
                                                <img src="<?= $p->main_picture?>" alt="<?= $p->name_product?>" class="slikaproizvoda" />
                                            </div>
                                            <div class="down-content text-center">
                                                <h4 class="imepr"><?= $p->name_brand?> <?= $p->name_product?></h4>

                                            </div>
                                        </div>

                                        <?php
                                            endforeach;
                                        ?>


                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                        </section>
                        <div class="col-12 text-center pt-4">
                        <form name="ukloniomiljene" method="POST" action="models/user/removefav.php" >
                            <button type="submit" class="btn btn-danger" name="btUkloni" id="btUkloni">Ukloni Sve Omiljene</button>
                            <input type="hidden" name="iduser" value="<?=$korisnik->id_user?>" />
                        </form>
                        </div>
                    </div>
    </section>