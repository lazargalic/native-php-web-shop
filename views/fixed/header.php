<header class="header-area header-sticky">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <nav class="main-nav">
                        <!-- ***** Logo Start ***** -->
                        <a href="/" class="logo">
                            <img src="assets/images/logo.jpg" alt="Logo" width="120" height="70">
                        </a>
                        <!-- ***** Logo End ***** -->
                        <!-- ***** Menu Start ***** -->
                        <ul class="nav">
                            <li><a href="index.php?page=proizvodi" rel="nofollow" >Proizvodi</a></li>
                            <li><a href="index.php?page=o-nama" rel="nofollow" >O nama</a></li>
                            
                            <?php
                            if(!isset($_SESSION['korisnik'])){

                            ?>

                            <li class="submenu">
                                <a href="javascript:;">Logovanje</a>
                                <ul>
                                    <li><a href='index.php?page=logovanje' rel="nofollow">Uloguj se</a></li>
                                    <li><a href="index.php?page=registracija" rel="nofollow" >Registruj se</a></li>
                                </ul>
                            </li>

                            <?php
                            }
                            ?>

                            
                            <?php 
                            if(isset($_SESSION['korisnik'])):
                                echo "<li><a href='index.php?page=profil' >Moj Profil</a></li>";
                            endif;
                            ?>


                            <?php
                            if(isset($_SESSION['admin'])):
                                echo "<li><a href='index.php?page=admin' ><b>Admin</b></a></li>";
                            endif;

                            if(isset($_SESSION['korisnik'])):
                                echo "<li><a href='models/global/odjava.php'>Odjavi se</a></li>";
                            endif;
                            ?>

                            <?php
                                $broj=0;

                                if(isset($_SESSION['korisnik'])){

                                $idkorpe=DohvatiIdKorpe($korisnik->id_user);

                                $broj=BrojArtikalaUKorpi($idkorpe);
                                }
                                else{
                                    if(isset($_SESSION['korpaneulogovan'])){
                                        $idkorpe=$_SESSION['korpaneulogovan'];
                                        $broj=BrojArtikalaUKorpi($idkorpe);
                                    }
                                 
                                
                                }

                                
                            ?>

                                <li>
                                    <div class="shopcart mr-3">
                                        <a href='index.php?page=korpa'> 
                                            <i class="fas fa-shopping-cart"> </i><span id="brojKorpa"><?= $broj ?></span>
                                        </a>
                                    </div> 
                                </li>

                            <?php

                        
                            ?>
                            




                        </ul>        
                        <a class='menu-trigger'>
                            <span>Menu</span>
                        </a>
                        <!-- ***** Menu End ***** -->
                    </nav>
                </div>
            </div>
        </div>
    </header>