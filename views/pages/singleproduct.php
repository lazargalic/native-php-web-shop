<?php

$id=$_GET['id'];
$proizvod=DohvatiSvePodatkeZaProizvod($id);
$dodatneslike=DodatneSlikeZaSlajder($id);
$sverecenzije=DohvatiSveRecenzije($id);




?>


<section class="section single-productLG">
        <div class="container mt-5 pt-5">
            <div class="row">
                <div class="col-lg-6">
                    <div class="right-content mb-5 pr-5">
                        <h1 class="mb-3 font-weight-bold"><?= $proizvod->name_brand . ' ' . $proizvod->name_product ?></h1>
                        <h2 class="my-2"><?= $proizvod->name_category ?></h2>

                        <h3 class="price my-3 font-weight-bolder"> <?= $proizvod->last_price ?> rsd</h3>
                        <input type="hidden" id="cenasakrivena" value=<?= $proizvod->last_price ?>/>

                        <span><?= $proizvod->description ?></span>

                        <div class="pt-3">
                            Ocena: 
                            <?php
                              if($sverecenzije){
                                $zbirOcena=0;

                                foreach($sverecenzije as $s):
                                  $zbirOcena+=$s->id_mark;
                                endforeach;

                                $prosecna=round($zbirOcena/count($sverecenzije));

                                for($i=0; $i<$prosecna; $i++):
                              ?>
                              

                              <i class="fa fa-star"></i>

                              <?php
                                  endfor;
                                }
                                else{
                                  echo "<p>Još nema ocena, ocenite ispod.</p>";
                                }
                              ?>
                        </div>
                        <div class="pt-4"><a class="dodajUFav" href="#" vrednost="<?= $proizvod->id_product?>">Dodaj u Omiljene</a></div>

                        <div class="quantity-content">
                            <div class="left-content">
                                 <!-- <h6>Količina</h6> -->
                                <h6>Kategorija </h6>
                            </div>
                            <div class="right-content">
                                <div class="quantity buttons_added">
                                    <!-- <input type="button" value="-" class="minus obaa"> 
                                    <input id="ukupno" type="number" step="1" min="1" max="" name="quantity" value="1" title="Qty" class="input-text qty text" size="4" pattern="" inputmode="">
                                    <input type="button" value="+" class="plus obaa"> -->
                                    <h5 class="font-weight-bolder pr-5 pt-2"><?= $proizvod->name_category ?></h5>
                                </div>
                            </div>
                        </div>
                        <div class="total">
                            <h4>Cena: <span id="prikazukupno"><?= $proizvod->last_price ?></span> rsd</h4>

                            <div class="main-border-button pt-4">
                              <button class="dodajUkorpu btn btn-info main-border-button"  vrednost="<?= $proizvod->id_product?>"> Dodaj U Korpu </button>
                            </div>

                        </div>


                        
                    </div>
                </div>
                <div class="col-lg-6">
                    <div id="carouselExampleIndicators" class="carousel slide " data-ride="carousel">
                        <ol class="carousel-indicators">
                          <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                          <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                          <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                        </ol>
                        <div class="carousel-inner">
                          
                          <div class="carousel-item active">
                            <img class="d-block slika" src="<?= $proizvod->main_picture?>" alt="<?= $proizvod->name_product?>">
                          </div>

                          <?php
                           if($dodatneslike){
                          foreach($dodatneslike as $d):
                        ?>
                          <div class="carousel-item ">
                            <img class="d-block slika" src="<?= $d->src?>"  />
                          </div>
                        <?php
                          endforeach;
                        }
                        ?>

                        </div>
                        <?php 
                          if($dodatneslike){
                          ?>
                        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                          <span  class="carousel-control-prev-icon strelice" aria-hidden="true"></span>
                          <span class="sr-only" >Previous</span>
                        </a>
                        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                          <span class="carousel-control-next-icon strelice" aria-hidden="true"></span>
                          <span class="sr-only">Next</span>
                        </a>
                        <?php
                          }
                        ?>
                      </div>
                </div>
            </div>

        </div>                        
    </section>
    <!-- ***** Product Area Ends ***** -->
    <!-- Comments Start -->

    <div class="container-fluid text-center mt-5 pt-5">
    <hr/>
    <h2 class="pt-5" >Ocene I Komentari</h2>
    </div>
    <!-- Komentarisi --> 
  <?php
  
     if(isset($_SESSION['korisnik'])){
  ?>
  <section>
    <div class="container mt-5 pt-3 text-dark">
    <h5 class="pb-4">Vaš komentar i Ocena: </h5>
      <div class="row d-flex justify-content-center">
        <div class="col-12">
          <div class="card">
            <div class="card-body p-4">
              <div class="d-flex flex-start w-100">
                <img class="rounded-circle shadow-1-strong me-3 mr-4"
                    src="<?= $korisnik->small_picture?>" alt="profilepic" width="65px" height="65px" />
                <div class="w-100">
                  <div class="form-outline">
                  <label class="form-label" for="textAreaExample"><?= $korisnik->first_name ?>, Kakvo je vaše iskustvo sa ovim proizvodom?</label>
                    <textarea class="form-control" id="textAreaExample" rows="4"></textarea>
                  </div>
                  
                  <div id="rating" class="pt-2">
                  <label class="form-label">Vaša Ocena: <span id="selektovanaOcena"> <span></label> <br/>
                  <a id="1"  class="oceni" > <i class="fa fa-star"> </i></a>
                  <a id="2"  class="oceni" > <i class="fa fa-star"> </i></a>
                  <a id="3"  class="oceni" > <i class="fa fa-star"> </i></a>
                  <a id="4"  class="oceni" > <i class="fa fa-star"> </i></a>
                  <a id="5"  class="oceni" > <i class="fa fa-star"> </i></a>
                  </div>


                  <div class="d-flex justify-content-between mt-3">
                    <button type="button" id="review" idkorisnik="<?= $korisnik->id_user?>" idproizvod="<?= $id ?>" class="btn btn-success">Pošalji</button>
                  </div>

                  <div id="greska" class="d-none col-12 mt-2 d-none py-2 px-2 bg-info">
                    <p> Morate da odaberete ocenu i napisete komentar sa minimalno 4 karaktera! </p>
                  </div>

                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <?php
     }
     else{
      ?>

      <div class="container my-5 py-4 pl-4 text-dark bg-light">
          <h5 class="pb-3"> Ulogujte se da biste ocenili ili komentarisali ovaj proizvod.</h5>
          <u><i><a href="index.php?page=logovanje">Uloguj se </a></i></u>
      </div>

      <?php
     }
  ?>

<!-- Svi ostali Komentari -->
<section>
  <div class="container mb-5 pb-5">
  <h5 class="pt-5 pb-4">Komentari i Ocene korisnika: </h5>
    <div class="row d-flex justify-content-center">
      <div class="col-12 col-md-12">
          <div class="card text-dark">


    <div id="ispisirecenzije">

          <?php
            if($sverecenzije){
            foreach($sverecenzije as $s):
          ?>


          <div class="card-body p-4">

            <div class="d-flex flex-start mb-4">
              <img class="rounded-circle shadow-1-strong me-3 mr-4"
                src="<?= $s->small_picture?>" alt="profilepic" width="60" height="60" />
              <div>
                <h6 class="fw-bold mb-1"><?= $s->first_name . ' ' . $s->last_name?></h6>
                <div class="d-flex align-items-center mb-3">
                  <p class="mb-0">
                    <?= $s->reviewed_at?>
                  </p>

                </div>
                <p class="mb-0">
                  <?= $s->comment ?>
                </p>
                <div class="pt-3">
                            Ocena: 
                            <?php
                            
                              for($i=0; $i<$s->id_mark; $i++):

                            ?>                

                              <i class="fa fa-star"></i>

                            <?php
                                endfor;
                              
                            ?>

                        </div>

                        <?php 
                          if(isset($_SESSION['korisnik'])){
                          if($korisnik->id_user==$s->id_user):
                        ?>
                        <button type="button" class="obrisikomentar btn btn-dark mt-4" productid='<?= $s->id_product ?>' idcom="<?= $s->id_review ?>"  >Uklonite Recenziju</button>

                        <?php
                          endif;
                        }
                        ?>

              </div>
              
            </div>
            

          </div>
          <hr class="my-0" />
          <?php
            endforeach;
          }
          
          else{
          
          ?>
      
 

            <div class="container my-5 py-4 pl-4 text-dark bg-light">
                <h6 class="pb-3"> Trenutno nema komentara i ocena! Budite prvi ko će komentarisati ili oceniti ovaj proizvod. </h6>
            </div>
          <?php
              }
          ?>

          
      </div> 

        </div>
      </div>
    
    </div>
  </div>
</section>
    <!-- Comments ENDS -->
<hr  />
