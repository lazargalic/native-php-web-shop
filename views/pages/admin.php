<?php

if(!isset($_SESSION['admin'])){
    header("Location: index.php?page=pocetna");
    exit();
}

$kupovine=DohvatiSveKupovine();

$text=TextPostarine(1);
?>
<section class="pb-5">    
            <div class="container">
                <div class="row">
                    <div class="col-12 text-center mt-5 pt-5">
                        <h2 class="font-weight-bold mt-5 pb-5">Admin panel</h2>
                    </div>
                    <div class="col-12 mb-5 mt-2 pb-4">
                            
                        <div class="row d-flex sp-ar">
                            <ul>

                            <li><a class="font-weight-bold my-5 pl-5 text-info" href="index.php?page=admin-kategorije">- Kategorije (dodavanje/brisanje)</a></li>
                            <li><a class="font-weight-bold my-5 pl-5 text-info" href="index.php?page=admin-brendovi">- Brendovi (dodavanje/brisanje)</a></li>
                            <li><a class="font-weight-bold my-5 pl-5 text-info" href="index.php?page=admin-novi-proizvod">- Dodaj Proizvod</a></li>
                            <li><a class="font-weight-bold my-5 pl-5 text-info" href="index.php?page=admin-svi-proizvodi">- Svi proizvodi (izmena/dodatne slike/brisanje) </a></li>
                            <li><a class="font-weight-bold my-5 pl-5 text-info" href="index.php?page=admin-korisnici">- Svi korisnici</a></li>
                            <li><a class="font-weight-bold my-5 pl-5 text-info" href="#porudzbine">- Sve porudzbine</a></li>
                            <li><a class="font-weight-bold my-5 pl-5 text-info" href="#postarina">- Text Postarina</a></li>
                            <li><a class="font-weight-bold my-5 pl-5 text-info" href="#log">- Log fajlovi</a></li>


                            </ul>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div id="porudzbine" class="col-12 my-4 text-center">
                        <h3>Sve Porudzbine</h3>
                    </div>
                </div>
                
                <div class="row">
                <div class="col-12 za-tabelu">
                        <table  class="table table-striped">
                        <thead>
                            <tr>
                            <th scope="col">Id Kupovine</th>
                            <th scope="col">Id Korisnickih podataka</th>
                            <th scope="col">Kreirana u</th>
                            <th scope="col"></th>

                            </tr>
                        </thead>
                        <tbody id="ispisPorudzbinaa">
                            
                                <?php
                               
                                foreach($kupovine as $s):
                                    echo "<tr>";
                                    echo "<td>$s->id_payment</td>";
                                    echo "<td>$s->id_user_payment</td>";
                                    echo "<td>$s->created_at</td>";
                                    
                                    echo "<td> 
                                            <a href='index.php?page=admin-porudzbina&idpaym=$s->id_payment&iduspay=$s->id_user_payment'>
                                                <button  class='pogledaj btn btn-info' >Spakuj Porudzbinu</button> 
                                            </a>
                                        </td>";

                                    echo "</tr>";
                                   
                                endforeach;
                            
                                ?>
                        
                        </tbody>
                        </table>
                    </div>
                </div>

                <div class="row">
                    <div id="postarina" class="col-12 my-4 pt-5 text-center">
                        <h3>Text O Postarini</h3>
                    </div>
                </div>

                <div class="row">
                <div class="col-sm-12 col-md-6 py-5">
                    <div class="form-group">
                        <label for="exampleFormControlTextarea1">Tekst ispod placanja za Postarine</label>
                        <textarea class="form-control" id="exampleFormControlTextarea1textparagraf" rows="8"><?= $text->text?></textarea>
                    </div>
                    <button  id="azuriraj" class='btn btn-info' >Azuriraj</button>
                </div>
                </div>


                <div class="row">
                    <div id="log" class="col-12 my-5 pt-5 text-center">
                        <h3>Posete stranica poslednjih 24h u procentima</h3>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12 za-tabelu">
                     <?php

                        $fajl=fopen("assets/data/log.txt", "r+");

                        $fajlniz=file("assets/data/log.txt");

                            
                        $trenutnovreme=time();
                        //echo $trenutnovreme;
                        $prosla24=$trenutnovreme-(24*60*60);

                        $nizkorisnici=[];

                                
                        $pocetna=0;
                        $proizvodi=0;
                        $logovanje=0;
                        $registracija=0;
                        $onama=0;
                        $admin=0;
                        $mojprofil=0;

                        foreach($fajlniz as $f):
                            $red=explode("\t", $f);
                            
                            if($red[1]>$prosla24){
                            
                                if($red[2] !="unauthorized"){
                                    array_push($nizkorisnici, $red[2]);
                                }
    



                                if($red[0] !="unauthorized \n")
    
                                if($red[0]=="/Kuca%20Higijene%20Galic%201/index.php" || $red[0]=="/Kuca%20Higijene%20Galic%201/index.php?page=pocetna")  $pocetna++;
                                else if($red[0]=="/Kuca%20Higijene%20Galic%201/index.php?page=proizvodi") $proizvodi++;
                                else if($red[0]=="/Kuca%20Higijene%20Galic%201/index.php?page=logovanje") $logovanje++;
                                else if($red[0]=="/Kuca%20Higijene%20Galic%201/index.php?page=registracija") $registracija++;
                                else if($red[0]=="/Kuca%20Higijene%20Galic%201/index.php?page=o-nama") $onama++;
                                else if($red[0]=="/Kuca%20Higijene%20Galic%201/index.php?page=admin") $admin++;
                                else if($red[0]=="/Kuca%20Higijene%20Galic%201/index.php?page=profil") $mojprofil++;

                            }
                           

                        endforeach;

                        fclose($fajl);

                        $zbir=$pocetna+$proizvodi+$logovanje+$registracija+$onama+$admin+$mojprofil;
                        if($zbir!=0){
                            $koeficijent=100/$zbir;
                        }
                        else $koeficijent=0;

                        $procenatpocetna=number_format($koeficijent*$pocetna, 2);
                        $procenatproizvodi=number_format($koeficijent*$proizvodi, 2);
                        $procenatlogovanje=number_format($koeficijent*$logovanje, 2);
                        $procenatregistracija=number_format($koeficijent*$registracija, 2);
                        $procenatonama=number_format($koeficijent*$onama, 2);
                        $procenatadmin=number_format($koeficijent*$admin, 2);
                        $procenatmojprofil=number_format($koeficijent*$mojprofil, 2);

                        ?>
                        <table  class="table table-striped">
                        <thead>
                            <tr>
                            <th scope="col">Pocetna</th>
                            <th scope="col">Proizvodi</th>
                            <th scope="col">Logovanje</th>
                            <th scope="col">Registracija</th>
                            <th scope="col">O nama</th>
                            <th scope="col">Admin</th>
                            <th scope="col">Moj Profil</th>
                            </tr>
                        </thead>
                        <tbody id="ispisPorudzbinaa">
                            
                                <?php
                                    echo "<tr>";
                                    echo "<td>$procenatpocetna %</td>";
                                    echo "<td>$procenatproizvodi %</td>";
                                    echo "<td>$procenatlogovanje %</td>";
                                    echo "<td>$procenatregistracija %</td>";
                                    echo "<td>$procenatonama %</td>";
                                    echo "<td>$procenatadmin %</td>";
                                    echo "<td>$procenatmojprofil %</td>";
                                ?>
                        
                        </tbody>
                        </table>

                        <h6 class="mt-5">Broj Korisnika koji su se ulgovali poslednja 24h: 
                            <span class="ml-2">
                                <?php
                            $nizkorisnici=array_unique($nizkorisnici);
                            echo count($nizkorisnici);
                                ?> 
                            </span>
                        </h6>

                     
                    </div>
                </div>


            

    </section>