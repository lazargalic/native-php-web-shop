<?php 


if(!isset($_SESSION['korisnik']) && !isset($_SESSION['korpaneulogovan']) ){
  header("Location: index.php?page=pocetna");
  exit();
}


if(isset($_SESSION['korisnik'])){
  $korpa=DohvatiIdKorpe($korisnik->id_user);
  $korisnik=$_SESSION['korisnik'];
}
else{
  $korpa=$_SESSION['korpaneulogovan'];
}

$_SESSION['korpasesijanarucivanjezastita']=$korpa;

$proizvodikorpa=DohvatiProizvodeKorpe($korpa);
$ukupnacenakorpe=DohvatiSumuCenaZaKorpu($korpa);

$teritorije=DohvatiTeritorije();


$text=TextPostarine(1);

?> 



<div class="py-5">      
            <div class="container">
                <div class="row">
                    <div class="col-12 text-center pt-4 my-5">
                        <h1 class="font-weight-bold">Plaćanje </h1>
                        <?php if(isset($_SESSION['korisnik'])){ ?> 
                           <h3 class=" mt-3"><?= $korisnik->first_name . ' ' . $korisnik->last_name ?></h3>
                        <?php }?>
                    </div>
                </div>  
                <?php
                        if(isset($_SESSION['uspehPosiljka'])){ ?>
                          <p class='alert-success my-2 py-2 px-2'><?= $_SESSION['uspehPosiljka']?></p>
                          <?php 
                             unset($_SESSION['uspehPosiljka']);
                          }
                      ?> 
                <?php
                        if(isset($_SESSION['greskaPosiljka'])){ ?>
                          <p class='alert-danger my-2 py-2 px-2'><?= $_SESSION['greskaPosiljka']?></p>
                          <?php 
                             unset($_SESSION['greskaPosiljka']);
                          }
                      ?>                
              <div>
        <form  id="placanje" action="models/user/placanje.php" method="POST" class="pb-5">
                <div class="form-group row">
                    <label for="ime" class="col-sm-2 col-form-label">Ime:</label>
                    <div class="col-sm-10">
                      <input type="text" <?php if(isset($_SESSION['korisnik'])){ ?> value="<?= $korisnik->first_name ?>"  <?php }?> 
                           class="form-control" id="ime" name="ime">
                      <p id="greskaime" class="d-none alert-danger mt-2 pl-3">Ime se mora popuniti, i to velikim početnim slovom!</p>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="prezime" class="col-sm-2 col-form-label">Prezime:</label>
                    <div class="col-sm-10">
                      <input type="text"  <?php if(isset($_SESSION['korisnik'])){ ?>  value="<?= $korisnik->last_name ?>" <?php }?>  class="form-control" id="prezime" name="prezime">
                      <p id="greskaprezime" class="d-none alert-danger mt-2 pl-3">Prezime se mora popuniti, i to velikim početnim slovom!</p>
                    </div>
                </div>
                <div class="form-group row">
                  <label for="inputEmail3" class="col-sm-2 col-form-label">Imejl:</label>
                  <div class="col-sm-10">
                    <input type="email" <?php if(isset($_SESSION['korisnik'])){ ?> value="<?= $korisnik->mail ?>"  <?php }?>   class="form-control" id="inputEmail3" name="mejl">
                    <p id="greskamejl" class="d-none alert-danger mt-2 pl-3">Imejl se mora mora popuniti i mora biti u ispravnom formatu!</p>
                  </div>
                </div>
                <div class="form-group row">

                    <label for="gradovi" class="col-sm-2 col-form-label">Opština* (grad):</label>
                <div class="col-sm-10">

                    <select id="gradovi" name="grad" class="mt-2">
                    <option value='0'>Izaberite</option> <!-- -->
                        <?php 

                          foreach($teritorije as $t){

                            if($korisnik->id_teritory==$t->id_teritory) {
                                echo "<option selected value='$t->id_teritory'>$t->name_teritory</option>";
                            }
                            else{
                               echo "<option value='$t->id_teritory'>$t->name_teritory</option>";
                            }
                          }
                        
                        ?>

                      </select>
                      <p id="greskagrad" class="d-none alert-danger mt-2 pl-3">Odaberite opštinu!</p>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="mesto" class="col-sm-2 col-form-label">Mesto</label>
                    <div class="col-sm-10">
                      <input type="text"  <?php if(isset($_SESSION['korisnik'])){ ?>  value="<?= $korisnik->location ?>" <?php }?>  class="form-control pola2" id="mesto" name="mesto" class="mt-2" placeholder="Na primer: Mali Mokri Lug" />
                      <p id="greskamesto" class="d-none alert-danger mt-2 pl-3">Nije dobar format!</p>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="postbr" class="col-sm-2 col-form-label">Poštanski broj mesta:</label>
                    <div class="col-sm-10">
                      <input type="text"  <?php if(isset($_SESSION['korisnik'])){ ?> value="<?= $korisnik->zip_code ?>" <?php }?>  class="form-control pola2" id="postbr" name="postbr" class="mt-2" />
                      <p id="greskapostbr" class="d-none alert-danger mt-2 pl-3">Poštanski brojevi u Srbiji imaju 5 cifara</p>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="prezime" class="col-sm-2 col-form-label" >Adresa sa brojem:</label>
                    <div class="col-sm-10">
                      <input type="text" <?php if(isset($_SESSION['korisnik'])){ ?>  value="<?= $korisnik->adress ?>" <?php }?> class="form-control" name="adresa" id="adresa">
                      <p id="greskaadresa" class="d-none alert-danger mt-2 pl-3">Promenite format adrese!</p>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="telefon" class="col-sm-2 col-form-label">Mobilni telefon:</label>
                    <div class="col-sm-10">
                      <input type="text" <?php if(isset($_SESSION['korisnik'])){ ?> value="<?= $korisnik->mobile ?>" <?php }?>   class="form-control pola2" id="telefon" name="telefon" class="mt-2" />
                      <p id="greskatelefon" class="d-none alert-danger mt-2 pl-3">Nije dobar format!</p>
                    </div>
                </div>


                <?php
                  if(count($proizvodikorpa)!=0){
                ?>


                <div class="form-group text-left mt-5 pt-4">
                  <div class="col-sm-12 col-md-6 mb-4 text-left mt-2 ">
                  <p id="textparagraf">
                      <?= $text->text ?>
                    </p>
                  </div>
                </div>


                <div class="form-group text-center mt-5">
                  <div class="col-12 mb-4 text-center mt-2">
                    <button id="placanje" name="placanje" type="submit" class="btn btn-success py-3 ">IZVRŠI KUPOVINU</button>
                  </div>
                </div>


                <?php
                  }
                ?>

                    <div >
                    <a href="index.php?page=korpa">
                    <button type="button"  class='nastavi btn btn-info p-2'>
                       Vrati se nazad
                    </button>
                    </a>
                    </div>

                



              </form>
            </div>



        


                 

                
            </div>
</div>

<?php
