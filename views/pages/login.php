<?php  if(isset($_SESSION['korisnik'])){
    header("Location: index.php?page=pocetna");
    exit();
} ?>
<div class="ppppp pt-4"> 
<div class="pb-5 reglog">      
            <div class="container">
                <div class="row">
                    <div class="col-12 text-center my-5">
                        <h1 class="font-weight-bold">Ulogujte se</h1>
                    </div>
                </div>                     
                <div class="row">
                    <div class="col-sm-6 margaut" id="section-log">
                        <form id="forma-logovanje" action="models/global/login.php" method="POST">
                            <p>Imejl:</p>
                            <input id="mejlllog" name="mejl" type="text" class="form-control mb-4"/>
                            <p id="greskamejlllog" class="d-none alert-danger mt-2 pl-3">Neispravan format!</p>
                            <p>Šifra:</p>
                            <input type="password" name="sifra" id="sifralog" class="form-control mb-4"/>
                            <p id="greskasifralog" class="d-none alert-danger mt-2 pl-3">Šifra nije u dobrom formatu!</p>
                            <button id="uloguj" name="uloguj" type="submit" class="btn btn-secondary mt-3 mb-4">Uloguj se</button> <br/>
                            <a href="index.php?page=registracija">Nemate nalog? Registrujte se ovde.</a>
                        </form>
                            <?php
                            if(isset($_SESSION['greskalog'])){ ?>
                               <p class='alert-danger mt-2 py-2 px-2'><?= $_SESSION['greskalog']?></p>
                            <?php 
                                unset($_SESSION['greskalog']);
                                }
                            ?> 

                            <?php
                            if(isset($_SESSION['uspeh'])){ ?>
                               <p class='alert-success mt-2 py-2 px-2'><?= $_SESSION['uspeh']?></p>
                            <?php 
                                unset($_SESSION['uspeh']);
                                }
                            ?>  

                    </div>
                </div>
            </div>
</div>
</div>