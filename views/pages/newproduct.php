<?php


if(!isset($_SESSION['admin'])){
    header("Location: index.php?page=pocetna");
    exit();
}


$brendovi=DohvatiSveBrendove();
$kat=DohvatiPodKategorije();
$polovi=DohvatiPolove();

?>


<section class="lg-transparent-bg pb-5">      
            <div class="container reglog">
                <div class="row">                                      
                    <div class="col-12 mt-5 text-center">
                        <h2 class="font-weight-bold"> Dodaj Proizvod</h2>
                    </div>        
                </div>
                <div class="row">
                                <div class="col-12 my-4 pt-4">

                                <?php
                                        if(isset($_SESSION["uspesnoDodavanje"])):
                                            ?>
                                            <p class='alert-success my-2 py-2 px-2'><?=$_SESSION['uspesnoDodavanje']?></p> 
                                        <?php     
                                        endif;
                                        unset($_SESSION["uspesnoDodavanje"]);
                                        ?>

                                        <?php
                                        if(isset($_SESSION["greskaDodavanje"])):
                                            ?>
                                            <p class='alert-danger my-2 py-2 px-2'><?=$_SESSION['greskaDodavanje']?></p>    

                                        <?php
                                        endif;
                                        unset($_SESSION["greskaDodavanje"]);
                                        ?>

                                        
                                            <?php
                                            if(isset($_SESSION["greskaTip"])):
                                                ?>
                                                <p class='alert-danger my-2 py-2 px-2'><?= $_SESSION["greskaTip"] ?></p>
                                            <?php
                                            endif;
                                            unset($_SESSION["greskaTip"]);
                                ?>
                                            
                                            
                                        <form id="dodaj" name="dodaj" method="POST" enctype="multipart/form-data" action="models/admin/addproduct.php" >
                                            <div class="form-group">
                                                <label for="exampleFormControlInput1">Naziv Proizvoda <br/> (Ne pisati ime Brenda, dodace se automatski kao prva rec u nazivu. Ne ostavljati suvisne razmake. Velika Pocetna slova novih reci, ostala mala.)</label>
                                                <input type="text" name="naziv" class="form-control" id="exampleFormControlInput1"/>  <!-- *** -->
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleFormControlSelect1">Brend</label>
                                                <select class="form-control" name="brend" id="exampleFormControlSelect1">
                                                <?php
                                                foreach($brendovi as $b):   //ako se poklop kod ucitavanja za select
                                                    echo "<option value='$b->id_brand'>$b->name_brand</option>";
                                                endforeach;
                                                ?>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleFormControlSelect2">Kategorija</label>
                                                <select class="form-control" name="kategorija" id="exampleFormControlSelect2">
                                                <?php
                                                foreach($kat as $k):
                                                        echo "<option value='$k->id_category'>$k->name_category</option>";
                                                endforeach;
                                                ?>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleFormControlSelect3">Odeljak</label>
                                                <select class="form-control" name="pol" id="exampleFormControlSelect3">
                                                <?php
                                                foreach($polovi as $p):
                                                        echo "<option value='$p->id_gender'>$p->name_gender </option>";
                                                endforeach;
                                                ?>
                                                </select>
                                            </div>


                                            <div class="form-group">
                                                <label for="exampleFormControlInput2">Cena u rsd</label>
                                                <input type="number" class="form-control" name="cena" id="exampleFormControlInput2">
                                            </div>


                                            <div class="form-group mb-4">
                                                <label for="exampleFormControlTextarea1">Opis</label>
                                                <textarea class="form-control" id="exampleFormControlTextarea1" name="opis" rows="3"></textarea>
                                            </div>

                                            <p>Odaberite GLAVNU sliku sata:</p>
                                            <input type="file" value="slika" class="mb-5" name="slika"/> <br/>


                                            <p id="nistedodali" class='d-none alert-danger my-2 py-2 px-2'>
                                            Niste dobro uneli podatke, sve se mora popuniti. Prvo pocetno slovo reci veliko, ostala malim. Brojevi ne smeju biti u minusu! Tip slike, jpg, jpeg i png.</p>
                                            <button type="submit" class="btn btn-success" name="btDodaj" id="btDodaj">Dodaj</button>

                                        </form>




                                    </div>
                                    <?php 

                                
      
                    ?>
                </div>                     
            </div>
        </section>
