<?php 


$teritorije=DohvatiTeritorije();
//var_dump($teritorije);

?>
<div class="ppppp pt-4"> 
<section class="reglog">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center mb-5">
                    <h1 class="font-weight-bold">Registrujte se</h1>
                </div>
            </div>
            
            <div class="container"> 
            <?php
                        if(isset($_SESSION['uspehReg'])){ ?>
                          <p class='alert-success my-2 py-2 px-2'><?= $_SESSION['uspehReg']?></p>
                          <?php 
                             unset($_SESSION['uspehReg']);
                          }
                      ?> 
                <?php
                        if(isset($_SESSION['greskaReg'])){ ?>
                          <p class='alert-danger my-2 py-2 px-2'><?= $_SESSION['greskaReg']?></p>
                          <?php 
                             unset($_SESSION['greskaReg']);
                          }
                      ?>                       
            <form  id="registracija" action="models/user/register.php" method="POST" class="pb-5">
                <div class="form-group row">
                    <label for="ime" class="col-sm-2 col-form-label">Ime:</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="ime" name="ime">
                      <p id="greskaime" class="d-none alert-danger mt-2 pl-3">Ime se mora popuniti, i to velikim početnim slovom!</p>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="prezime" class="col-sm-2 col-form-label">Prezime:</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="prezime" name="prezime">
                      <p id="greskaprezime" class="d-none alert-danger mt-2 pl-3">Prezime se mora popuniti, i to velikim početnim slovom!</p>
                    </div>
                </div>
                <div class="form-group row">
                  <label for="inputEmail3" class="col-sm-2 col-form-label">Imejl:</label>
                  <div class="col-sm-10">
                    <input type="email" class="form-control" id="inputEmail3" name="mejl">
                    <p id="greskamejl" class="d-none alert-danger mt-2 pl-3">Imejl se mora mora popuniti i mora biti u ispravnom formatu!</p>
                  </div>
                </div>
                <div class="form-group row">

                    <label for="gradovi" class="col-sm-2 col-form-label">Opština* (grad):</label>
                <div class="col-sm-10">
                    <!--  <input list="gradovi" name="browser" id="browser"> !-->

                    <select id="gradovi" name="grad" class="mt-2">
                    <option value='0'>Izaberite</option> <!-- -->
                        <?php 

                          foreach($teritorije as $t){
                            echo "<option value='$t->id_teritory'>$t->name_teritory</option>";
                          }
                        
                        ?>

                      </select>
                      <p id="greskagrad" class="d-none alert-danger mt-2 pl-3">Odaberite opštinu!</p>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="mesto" class="col-sm-2 col-form-label">Mesto</label>
                    <div class="col-sm-10">
                      <input type="text"  class="form-control pola2" id="mesto" name="mesto" class="mt-2" placeholder="Na primer: Mali Mokri Lug" />
                      <p id="greskamesto" class="d-none alert-danger mt-2 pl-3">Nije dobar format!</p>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="postbr" class="col-sm-2 col-form-label">Poštanski broj mesta:</label>
                    <div class="col-sm-10">
                      <input type="text"  class="form-control pola2" id="postbr" name="postbr" class="mt-2" />
                      <p id="greskapostbr" class="d-none alert-danger mt-2 pl-3">Poštanski brojevi u Srbiji imaju 5 cifara</p>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="prezime" class="col-sm-2 col-form-label" >Adresa sa brojem:</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" name="adresa" id="adresa">
                      <p id="greskaadresa" class="d-none alert-danger mt-2 pl-3">Promenite format adrese!</p>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="telefon" class="col-sm-2 col-form-label">Mobilni telefon:</label>
                    <div class="col-sm-10">
                      <input type="text"  class="form-control pola2" id="telefon" name="telefon" class="mt-2" />
                      <p id="greskatelefon" class="d-none alert-danger mt-2 pl-3">Nije dobar format!</p>
                    </div>
                </div>

                <div class="form-group row">
                  <label for="inputPassword3" class="col-sm-2 col-form-label">Šifra:</label>
                  <div class="col-sm-10">
                    <input type="password" class="form-control" id="inputPassword3first">
                    <p id="greskasifra1" class="d-none alert-danger mt-2 pl-3">Šifra mora početi velikim početnim slovom sa minimalno 8 karaktera!</p>
                  </div>
                </div>
                <div class="form-group row">
                  <label for="inputPassword3" class="col-sm-2 col-form-label">Ponovite šifru:</label>
                  <div class="col-sm-10">
                    <input type="password" name="sifra" class="form-control" name="pol" id="inputPassword3second" name="sifra">
                    <p id="greskasifra2" class="d-none alert-danger mt-2 pl-3">Šifre se ne poklapaju!</p>
                  </div>
                </div>
                <fieldset class="form-group">
                  <div class="row">
                    <legend class="col-form-label col-sm-2 pt-0">Pol:</legend>
                    <div class="col-sm-10">
                                <div class='form-check'>
                                 
                                    <input class='form-check-input' type='radio' name='pol' class='polovi' id='gridRadios1' value='1'>
                                    <label class='form-check-label' for='gridRadios1'>Muški</label> <br/>

                                    <input class='form-check-input' type='radio' name='pol' class='polovi' id='gridRadios2' value='2'>
                                    <label class='form-check-label' for='gridRadios2'>Ženski</label> <br/>


                                  </div>
                      <p id="greskapol" class="d-none alert-danger mt-2 pl-3">Odaberite pol!</p>
                    </div>
                  </div>
                </fieldset>
                <div class="form-group row">
                  <div class="col-sm-2"></div>
                  <div class="col-sm-10">
                    <div class="form-check">
                      <input class="form-check-input" value="slaze" name="uslovi" type="checkbox" id="gridCheck1">
                      <label class="form-check-label" for="gridCheck1">
                        Slažem se sa uslovima korišćenja.
                      </label>
                    </div>
                    <p id="greskauslovi" class="d-none alert-danger mt-2 pl-3">Obavezno polje!</p>
                  </div>
                </div>
                <div class="form-group row">
                  <div class="col-sm-10 mb-4">
                    <button id="registruj" name="registruj" type="submit" class="btn btn-secondary">Registruj se</button>
                  </div>

                  <a href="index.php?page=logovanje">Imate nalog? Ulogujte se ovde.</a>
                </div>
              </form>
        </div>

</section>
<hr/>
</div>