 <?php
 
 $licna=PrikazPocetnihKategorija(1);
 $kucna=PrikazPocetnihKategorija(3);
 $kozmetika=PrikazPocetnihKategorija(2);
 $papirna=PrikazPocetnihKategorija(4);

 
 ?>
 
 <!-- ***** Main Banner Area Start ***** -->
 <div class="main-banner" id="top">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-6">
                    <div class="left-content">
                        <div class="thumb">
                            <div class="inner-content">
                                <h1>&#x2217;Kuća Higijene Galić &#x2217;</h1>
                                <span>Oficijalni web shop</span>
                                <div class="main-border-button mt-4">
                                    <a href="index.php?page=proizvodi" rel="nofollow" >Započni kupovinu</a>
                                </div>
                            </div>
                            <img src="assets/images/kuca.jpg" alt="Banner Kuca Higijene">
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="right-content">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="right-first-image">
                                    <div class="thumb">
                                        <div class="inner-content">
                                            <h3>Lična Higijena</h3>
                                            <span>Proizvodi iz odeljka lične higijene</span>
                                        </div>
                                        <div class="hover-content">
                                            <div class="inner">
                                                <span>Lična Higijena</span>
                                                <p>Pod ličnom higijenom podrazumeva se održavanje čistoće ruku, tela, oralna higijena, čistoća zuba, urednost kose i noktiju, čistoća odeće i obuće.</p>
                                            </div>
                                        </div>
                                        <img src="assets/images/Categories/personal-hygiene.jpg" alt="Licna higijena prikaz">
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="right-first-image">
                                    <div class="thumb">
                                        <div class="inner-content">
                                            <h3>Kozmetika</h3>
                                            <span>Proizvodi iz odeljka kozmetike</span>
                                        </div>
                                        <div class="hover-content">
                                            <div class="inner">
                                                <span>Kozmetika</span>
                                                <p>Kozmetika se odnosi na supstance čiji je cilj poboljšavanje ili zaštita izgleda ili mirisa ljudskog tela. Dekorativna kozmetika se nekad jednostavno naziva šminka.</p>
                                            </div>
                                        </div>
                                        <img src="assets/images/Categories/cosmetic.jpg" alt="Kozmetika prikaz" >
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="right-first-image">
                                    <div class="thumb">
                                        <div class="inner-content">
                                            <h3>Kućna Hemija</h3>
                                            <span>Proizvodi iz odeljka kućne hemije</span>
                                        </div>
                                        <div class="hover-content">
                                            <div class="inner">
                                                <span>Kućna Hemija</span>
                                                <p>Čistoća kuće ogledalo je svake domaćinstva. Pred Vama je spisak preparata kućne hemije i sredstava za higijensko održavanje životnog ili radnog prostora.</p>
                                            </div>
                                        </div>
                                        <img src="assets/images/Categories/house-chemistry.jpg" alt="Prikaz Kućna Hemija ">
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="right-first-image">
                                    <div class="thumb">
                                        <div class="inner-content">
                                            <h3>Paprina Konfekcija</h3>
                                            <span>Proizvodi iz odeljka papirne konfekcije</span>
                                        </div>
                                        <div class="hover-content">
                                            <div class="inner">
                                                <span>Paprina Konfekcija</span>
                                                <p>U Paprinu Konfekciju spadaju toalet papiri, ubrusi, salvete, papirne maramice i ostali prateći proizvodi.. Snabdevamo kupce najvećim izborom proizvoda ove kategorije.</p>
                                            </div>
                                        </div>
                                        <img src="assets/images/Categories/paper.jpg" alt="Prikaz Paprina Konfekcija">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- ***** Main Banner Area End ***** -->



    <?php
    
    /*
    
    $teritorije=DohvatiTeritorije();

    var_dump($teritorije);


    $fajl=fopen("assets/data/teritorije.txt", "r");

    $fajl2=file("assets/data/teritorije.txt");
   
    foreach($fajl2 as $f){
       Unesi Teritorije($f);
    }
   
    */
    
    ?>


    <!-- ***** Area Starts ***** -->
    <section class="section" id="men">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="section-heading">
                        <h2>Lična Higijena </h2>
                    </div>
                </div>
            </div>
        </div>

        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="men-item-carousel">
                        <div class="owl-men-item owl-carousel">
                    <?php
                        foreach($licna as $p):
                    ?>

                    <div class="item">
                        <div class="thumb">
                            <div class="hover-content">
                                <ul>
                                    <li><a href="index.php?page=proizvod&id=<?= $p->id_product ?>" rel="nofollow" ><i class="fa fa-eye"></i> </a></li>
                                    <li><a class="dodajUkorpu" vrednost="<?= $p->id_product?>"><i class="fa fa-shopping-cart"></i></a></li>
                                    <li><a class="dodajUFav" vrednost="<?= $p->id_product?>"><i class="fa fa-star"></i></a></li>
                                </ul>
                            </div>
                            <img src="<?= $p->main_picture?>" alt="<?= $p->name_product ?>" class="slikaproizvoda" />
                        </div>
                        <div class="down-content text-center">
                            <span class="imepr"><?= $p->name_brand?> <?= $p->name_product?></span>

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
    <!-- ***** Area Ends ***** -->

    <!-- ***** Area Starts ***** -->
    <section class="section" id="men">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="section-heading">
                        <h2>Kućna Hemija </h2>
                    </div>
                </div>
            </div>
        </div>

        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="men-item-carousel">
                        <div class="owl-men-item owl-carousel">
                    <?php
                        foreach($kucna as $p):
                    ?>

                    <div class="item">
                        <div class="thumb">
                            <div class="hover-content">
                                <ul>
                                    <li><a href="index.php?page=proizvod&id=<?= $p->id_product ?>" rel="nofollow" ><i class="fa fa-eye"></i></a></li>
                                    <li><a class="dodajUkorpu" vrednost="<?= $p->id_product?>"><i class="fa fa-shopping-cart"></i></a></li>
                                    <li><a class="dodajUFav" vrednost="<?= $p->id_product?>"><i class="fa fa-star"></i></a></li>
                                </ul>
                            </div>
                            <img src="<?= $p->main_picture?>" alt="<?= $p->name_product?>" class="slikaproizvoda" />
                        </div>
                        <div class="down-content text-center">
                            <span class="imepr"><?= $p->name_brand?> <?= $p->name_product?></span>

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
    <!-- ***** Area Ends ***** -->

    
    
    <!-- ***** Area Starts ***** -->
    <section class="section" id="men">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="section-heading">
                        <h2>Kozmetika </h2>
                    </div>
                </div>
            </div>
        </div>

        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="men-item-carousel">
                        <div class="owl-men-item owl-carousel">
                    <?php
                        foreach($kozmetika as $p):
                    ?>

                    <div class="item">
                        <div class="thumb">
                            <div class="hover-content">
                                <ul>
                                    <li><a href="index.php?page=proizvod&id=<?= $p->id_product ?>" rel="nofollow"><i class="fa fa-eye"></i></a></li>
                                    <li><a class="dodajUkorpu" vrednost="<?= $p->id_product?>"><i class="fa fa-shopping-cart"></i></a></li>
                                    <li><a class="dodajUFav" vrednost="<?= $p->id_product?>"><i class="fa fa-star"></i></a></li>
                                </ul>
                            </div>
                            <img src="<?= $p->main_picture?>" alt="<?= $p->name_product?>" class="slikaproizvoda" />
                        </div>
                        <div class="down-content text-center">
                            <span class="imepr"><?= $p->name_brand?> <?= $p->name_product?></span>

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
    <!-- ***** Area Ends ***** -->


    <!-- ***** Area Starts ***** -->
    <section class="section" id="men">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="section-heading">
                        <h2>Papirna Konfekcija </h2>
                    </div>
                </div>
            </div>
        </div>

        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="men-item-carousel">
                        <div class="owl-men-item owl-carousel">
                    <?php
                        foreach($papirna as $p):
                    ?>

                    <div class="item">
                        <div class="thumb">
                            <div class="hover-content">
                                <ul>
                                <li><a href="index.php?page=proizvod&id=<?= $p->id_product ?>" rel="nofollow"><i class="fa fa-eye"></i></a></li>
                                    <li><a class="dodajUkorpu" vrednost="<?= $p->id_product?>"><i class="fa fa-shopping-cart"></i></a></li>
                                    <li><a class="dodajUFav" vrednost="<?= $p->id_product?>"><i class="fa fa-star"></i></a></li>
                                </ul>
                            </div>
                            <img src="<?= $p->main_picture?>" alt="<?= $p->name_product?>" class="slikaproizvoda" />
                        </div>
                        <div class="down-content text-center">
                            <span class="imepr"><?= $p->name_brand?> <?= $p->name_product?></span>

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
    <!-- ***** Area Ends ***** -->


    




    <!-- ***** Explore Area Starts ***** -->
    <section class="section" id="explore">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="left-content">
                        <h2>O našim proizvodima</h2>
                        <span>Naš asortiman proizvoda se sastoji iz 4 glavne Kateogorije. Lične higijene, kućne hemije, kozmetike i papirne konfekcije. Ove 4 kategorije su dovoljne da pokriju potrebe celog domaćinstva i svakog pojedinca.</span>
                        <div class="quote">
                            <i class="fa fa-quote-left"></i><p>Online kupovinom dobijate identitčan račun kao da ste kupovinu izvršili dirktno u prodavnici.</p>
                        </div>
                        <p>Kod nas ćete uvek naći artikle po jako niskim odnosno akcijskim cenama.
                            Radimo besplatne lične isporuke robe na adresu, za firme I kupce koji poručuju robu u
                            vrednosti preko 10.000,00 din na teritoriji Beograda, dok za ostale kupovine na celoj teritoriji Srbije to radi kurirska služba. </p>
                        <p>Potrebno je da odaberete određeni proizvod. Da ga dodate u korpu i da nakon toga na onlajn kasi popunite vaše podatke za dostavu. U najkraćem roku će neka od kurirskih službi vašu korpu isporučiti za vas.</p>
                        <div class="main-border-button">
                            <a href="index.php?page=proizvodi" rel="nofollow" >Pogledaj Ponudu</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="right-content">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="leather">
                                    <h3>Najbolji Kvalitet</h3>
                                    <span>Očuvanost proizvoda</span>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="first-image">
                                    <img src="assets/images/explore-image-01.jpg" alt="Prva Explore">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="second-image">
                                    <img src="assets/images/explore-image-02.jpg" alt="Druga Explore">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="types">
                                    <h3>Veliki izbor</h3>
                                    <span>Preko 2000 proizvoda</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
                        </div>
    </section>
    <!-- ***** Explore Area Ends ***** -->