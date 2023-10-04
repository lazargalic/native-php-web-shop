<?php

if(!isset($_SESSION['admin'])){
    header("Location: index.php?page=pocetna");
    exit();
}

$sviKorisnici=DohvatiSveKorisnike();

?>
<section class="pb-5">    
            <div class="container">
                <div class="row">
                    <div class="col-12 text-center mt-5 pt-5">
                        <h2 id="vrh2" class="font-weight-bold mt-5 pb-5">Korisnici</h2>
                    </div>
                   
                </div>
                <div class="row">
                    <div class="col-12 my-4  text-center">
                        <h3 id="DodajKat">Svi korisnici</h3>
                    <p class="mt-2"><i>Ukoliko obrisete korisnika, obrisacete sve njegove porudzbine i komentare iz baze podataka. </i></p>
                    </div>
                </div>
                <a href="#skroler2" class="pb-5" >Skroler</a>
                <div class="row">
                <div class="col-12 za-tabelu">
                        <table  class="table table-striped">
                        <thead>
                            <tr>
                            <th scope="col">Id</th>
                            <th scope="col">Ime i Prezime</th>
                            <th scope="col">Mejl</th>
                            <th scope="col">Opstina/(Grad)</th>
                            <th scope="col">Mesto</th>
                            <th scope="col">Adresa</th>
                            <th scope="col">Zip</th>
                            <th scope="col">Telefon</th>
                            <th scope="col">Uloga</th>
                            <th scope="col">Registrovan</th>
                            <th scope="col"></th>
                            <th scope="col"></th>
                            <th scope="col"></th>
                            </tr>
                        </thead>
                        <tbody id="ispisKorisnici">
                            
                                <?php
                               
                                foreach($sviKorisnici as $s):
                                    echo "<tr>";
                                    echo "<th>$s->id_user</th>";
                                    echo "<th>$s->first_name $s->last_name</th>";
                                    echo "<th>$s->mail</th>";
                                    echo "<th>$s->name_teritory</th>";
                                    echo "<th>$s->location</th>";
                                    echo "<th>$s->adress</th>";
                                    echo "<th>$s->zip_code</th>";
                                    echo "<th>$s->mobile</th>";
                                    echo "<th>$s->name_role</th>";
                                    echo "<th>$s->registered_at</th>";
                                    if ($s->id_role==2){
                                        echo "<td> <button class='adminuser btn btn-dark' id_role='$s->id_role' id_user='$s->id_user'>Ukloni Admina</button> </td>";
                                    }
                                    else if ($s->id_role==1){
                                        echo "<td> <button class='adminuser btn btn-dark' id_role='$s->id_role' id_user='$s->id_user'>Dodeli Admina</button> </td>";
                                    }
                                    
                                    echo "<td> <button  class='obrisikor btn btn-danger' id_role='$s->id_role' id_user='$s->id_user'>Obrisi Korisnika</button> </td>";

                                    echo "</tr>";
                                   
                                endforeach;
                            
                                ?>
                        
                        </tbody>
                        </table>
                    </div>
                </div>


 <a href="#vrh2" id="skroler2" class="pt-5 pl-2">Nazad na vrh</a>


            </div>
    </section>