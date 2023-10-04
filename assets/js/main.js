    var url = window.location.href;    

    var brojpostrani = 16; //products.php

    window.onload= function(){


       // $("#textparagraf").html(localStorage.getItem('text'));
        //$("#exampleFormControlTextarea1textparagraf").val(localStorage.getItem('text'));
        //console.log("Povezano");

        //regularni
        let rgsifrap= /^[A-Z]{1}[a-z|A-Z|0-9|.!@#%&*_]{7,24}$/;

        let regadresa= /^[A-ZĆČŠŽĐ]{1}[a-zžčćšđ]{1,14}(\s[A-ZĆČŠŽĐ|a-zžčćšđ|0-9]{1,14})*$/;                                //LENGTH
        let regimeprez= /^[A-ZĆČŠŽĐ]{1}[a-zžčćšđ]{2,14}(\s[A-ZĆČŠŽĐ]{1}[a-zžčćšđ]{2,14})?$/;
        let regmejl= /^[a-z][\w\.\-]+\@[a-z0-9]{2,15}(\.[a-z]{2,4}){1,2}$/;

        let nazivkat= /^[A-ZĆČŠŽĐ|0123456789|-]{1}[a-zžčćšđ|0123456789|-]{0,15}(\s[A-ZĆČŠŽĐ|0123456789|-]{1}[a-zžčćšđ|0123456789|-]{0,15})*$/;                                 //LENGTH
       // let nazivkat= "/^[A-ZĆČŠŽĐ|0-9|-]{1}[a-zžčćšđ|0-9|-]{0,15}(\s[A-ZĆČŠŽĐ|0-9|-]{1}[a-zžčćšđ|0-9|-]{0,15})*$/";

        //var regmodel= /^[A-ZĆČŠŽĐ]{1}[a-zžčćšđ]{1,9}(\s[A-ZĆČŠŽĐ|a-zžčćšđ|0-9]{1,9})?$/; 

        if ((url.indexOf("index.php?page=registracija") != -1)){
            
            $("#registracija").submit( (event)=> {
                var ime= $("#ime").val();
                var prezime= $("#prezime").val();
                var mejl= $("#inputEmail3").val();
                var telefon= $("#telefon").val();
                var sifraprva=$("#inputPassword3first").val();
                var sifradruga=$("#inputPassword3second").val();
                var pol=$('input[name="pol"]:checked').val();
                var uslovi=$('input[name="uslovi"]:checked').val();
                var adresa=$("#adresa").val();   ///^[A-ZĆČŠŽĐ]{1}[a-zžčćšđ]{2,9}(\s[A-ZĆČŠŽĐ]{1}[a-zžčćšđ]{2,9})+$/;
                var grad=$("#gradovi").val();
                var postbr=$("#postbr").val();
                var mesto=$("#mesto").val();

                let brojgresaka=0;



                if(!regimeprez.test(ime)){
                    $("#greskaime").removeClass("d-none");
                    brojgresaka++;
                }
                else{
                    $("#greskaime").addClass("d-none");
                }

                if(!regimeprez.test(prezime)){
                    $("#greskaprezime").removeClass("d-none");
                    brojgresaka++;
                }
                else{
                    $("#greskaprezime").addClass("d-none");
                }

                if(!regmejl.test(mejl)){
                    $("#greskamejl").removeClass("d-none");
                    brojgresaka++;
                }
                else{
                    $("#greskamejl").addClass("d-none");
                }

                if(!regadresa.test(adresa) || adresa.length>70){
                    $("#greskaadresa").removeClass("d-none");
                    brojgresaka++;
                }
                else{
                    $("#greskaadresa").addClass("d-none");
                }

                if(grad==0){
                    $("#greskagrad").removeClass("d-none");
                    brojgresaka++;
                }
                else{
                    $("#greskagrad").addClass("d-none");
                }


                if(!rgsifrap.test(sifraprva)){
                    $("#greskasifra1").removeClass("d-none");
                    brojgresaka++;
                }
                else{
                    $("#greskasifra1").addClass("d-none");
                }
                if(sifradruga!=sifraprva){
                    $("#greskasifra2").removeClass("d-none");
                    brojgresaka++;
                }
                else {
                    $("#greskasifra2").addClass("d-none");
                }
                if(pol!=1 && pol!=2){
                    $("#greskapol").removeClass("d-none");
                    brojgresaka++;
                }
                else{
                    $("#greskapol").addClass("d-none");
                }

                if(uslovi !="slaze"){
                    brojgresaka++;
                    $("#greskauslovi").removeClass("d-none");
                }
                else{
                    $("#greskauslovi").addClass("d-none");
                }


                if(telefon.length != 10){
                    brojgresaka++;
                    $("#greskatelefon").removeClass("d-none");
                }
                else{
                    $("#greskatelefon").addClass("d-none");
                }

                if(postbr.length != 5){
                    brojgresaka++;
                    $("#greskapostbr").removeClass("d-none");
                }
                else{
                    $("#greskapostbr").addClass("d-none");
                }

                if(mesto.length < 3 || mesto.length>30){
                    brojgresaka++;
                    $("#greskamesto").removeClass("d-none");
                }
                else{
                    $("#greskamesto").addClass("d-none");
                }

                if(brojgresaka!=0){
                
                    event.preventDefault();

                }
            });

        }


        if ((url.indexOf("index.php?page=logovanje") != -1)){
                

                $("#forma-logovanje").submit((event) =>{
                    let brgresaka=0;

                    var mej=$("#mejlllog").val();
                    var sif=$("#sifralog").val();

                    if(!regmejl.test(mej)){
                        brgresaka++;
                        $("#greskamejlllog").removeClass("d-none");
                        
                    }
                    else{
                        $("#greskamejlllog").addClass("d-none");
                    }

                    if(!rgsifrap.test(sif)){
                        brgresaka++;
                        $("#greskasifralog").removeClass("d-none");
                  
                    }
                    else{
                        $("#greskasifralog").addClass("d-none");
                    }
                    
                    if(brgresaka!=0){
                        event.preventDefault();
                    }

                });
        }


        //Kategorije
        if ((url.indexOf("index.php?page=admin-kategorije") != -1)){
    

            $("#dodaj").click(()=> {

            var brgresaka=0;    

            var naziv=$("#naziv").val();
            var roditelj=$("#roditelj").val();
            var cek=$("input[name='autoSizingCheck']:checked").val();


            if(!nazivkat.test(naziv) || nazivkat.length >45 || (roditelj==0) || cek!='on'){
                $("#greska").removeClass("d-none");
                brgresaka++;
            }
            else{
                $("#greska").addClass("d-none");
            }


            if(brgresaka==0){        

                $.ajax({
                    dataType:"json",
                    method:"post",
                    url:"models/admin/addcategory.php",
                    data: {
                        naziv: naziv,
                        roditelj:roditelj
                    },
                    success:function(result) {
                        alert("Uspesno dodato");
                        IspisiSveKategorije(result);
                    },
                    error:function(xhr) {
                        console.log(xhr);
                    }

                
                }); 
            

            }

            });

            function IspisiSveKategorije(niz){

                var html="";
        
                
                for(let i=0; i< niz.length;i++){
        
                    html+=`
                <div class="d-flex justify-content-between py-2" >
                        <li class="font-weight-bold my-2 text-dark">${niz[i].name_category}</li>
                    <button class="obrisikat btn btn-danger" vrednost="${niz[i].id_category}">
                            Obrisi
                        </button>
                    </div>  `
                
                }
        
                $("#prikazPodKat").html(html);
            }


        ////
        $(document).on("click", ".obrisikat", function() {

            let id=$(this).attr("vrednost");


            $.ajax({
                dataType:"json",
                method:"post",
                url:"models/admin/deletecat.php",
                data: {
                    id: id,
                },
                success:function(result) {
                    alert("Uspesno obrisano");
                    IspisiSveKategorije(result);
                },
                error:function(xhr) {
                    console.log(xhr);
                }

            
            }); 
    

        });


    }





    //Brendovi

    if ((url.indexOf("index.php?page=admin-brendovi") != -1)){
    

        $("#dodaj").click(()=> {

        var brgresaka=0;    

        var naziv=$("#naziv").val();
        var cek=$("input[name='autoSizingCheck2']:checked").val();


        if(!nazivkat.test(naziv) || nazivkat.length >30 || cek!='on'){
            $("#greska").removeClass("d-none");
            brgresaka++;
        }
        else{
            $("#greska").addClass("d-none");
        }

        if(brgresaka==0){        

            $.ajax({
                dataType:"json",
                method:"post",
                url:"models/admin/addbrand.php",
                data: {
                    naziv: naziv,
                },
                success:function(result) {
                    alert("Uspesno dodato");
                    IspisiSveBrendove(result);
                },
                error:function(xhr) {
                    console.log(xhr);
                }

            
            }); 
        

        }

        });

        $(document).on("click", ".obrisibrend", function() {

            let id=$(this).attr("vrednost");

            $.ajax({
                dataType:"json",
                method:"post",
                url:"models/admin/deletebrand.php",
                data: {
                    id: id,
                },
                success:function(result) {
                    alert("Uspesno obrisano");
                    IspisiSveBrendove(result);
                },
                error:function(xhr) {
                    console.log(xhr);
                }
            }); 

        });


        function IspisiSveBrendove(niz){

            var html="";

            
            for(let i=0; i< niz.length;i++){

                html+=`
            <div class="d-flex justify-content-between py-2" >
                    <li class="font-weight-bold my-2 text-dark">${niz[i].name_brand}</li>
                <button class="obrisibrend btn btn-danger" vrednost="${niz[i].id_brand}">
                        Obrisi
                    </button>
                </div>  `
            
            }

            $("#prikazBrendova").html(html);
        }



    }


    //Korisnici

    if ((url.indexOf("index.php?page=admin-korisnici") != -1)){


        $(document).on("click", ".adminuser", function(){

            let id_user=$(this).attr("id_user");
            let id_role=$(this).attr("id_role");

            $.ajax({
                dataType:"json",
                method:"post",
                url:"models/admin/adminuser.php",
                data: {
                    id_user:id_user,
                    id_role:id_role
                },
                success:function(result) {
                    alert("Uspesno promenjena uloga")
                    IspisiSveKorisnike(result);
                },
                error:function(xhr) {
                    console.log(xhr);
                }

            
            }); 


        });


        $(document).on("click", ".obrisikor", function(){

            let id_user=$(this).attr("id_user");

            $.ajax({
                dataType:"json",
                method:"post",
                url:"models/admin/deluser.php",
                data: {
                    id_user:id_user,
                },
                success:function(result) {
                    alert("Uspesno Obrisan Korisnik")
                    IspisiSveKorisnike(result);
                },
                error:function(xhr) {
                    console.log(xhr);
                }

            
            }); 


        });



        function IspisiSveKorisnike(niz){

            let html="";

            for(let n of niz){


                html+=`<tr>
                <th>${n.id_user}</th>
                <th>${n.first_name} ${n.last_name}</th>
                <th>${n.mail}</th>
                <th>${n.name_teritory}</th>
                <th>${n.location}</th>
                <th>${n.adress}</th>
                <th>${n.zip_code}</th>
                <th>${n.mobile}</th>
                <th>${n.name_role}</th>
                <th>${n.registered_at}</th>`

                if (n.id_role==2){
                    html+=`<td> <button class='adminuser btn btn-dark' id_role='${n.id_role}' id_user='${n.id_user}'>Ukloni Admina</button> </td>`
                }
                else if (n.id_role==1){
                    html+=`<td> <button class='adminuser btn btn-dark' id_role='${n.id_role}'  id_user='${n.id_user}'>Dodeli Admina</button> </td>`
                }
                
            html+=`<td> <button  class='obrisikor btn btn-danger' id_role='${n.id_role}' id_user='${n.id_user}'>Obrisi Korisnika</button> </td>
        
                </tr>`

            }


            $("#ispisKorisnici").html(html)
        }

    }

    //Novi Proizvod

    if ((url.indexOf("index.php?page=admin-novi-proizvod") != -1)){

        $("#dodaj").submit(function Provera(event){
            var naziv=$("#exampleFormControlInput1").val();
            //var brend=$("#exampleFormControlSelect1").val();
            //var kategorija=$("#exampleFormControlSelect2").val();
            //var pol=$("#exampleFormControlSelect3").val();
            var cena=$("#exampleFormControlInput2").val();
            var opis=$("#exampleFormControlTextarea1").val();

            var brgresaka=0;

            if(!nazivkat.test(naziv)){
                brgresaka++;
            }
            if(cena < 0 ){
                brgresaka++;
            }
            if(opis.length <= 0 ){
                brgresaka++;
            }

            if(brgresaka!=0){
                $("#nistedodali").removeClass("d-none");
                event.preventDefault();
            }
            else{
                $("#nistedodali").addClass("d-none");
            }


        });


    }



    if (url.indexOf("index.php?page=izmena-proizvoda&id") != -1){
        
        $("#izmeni").submit(function Provera2(event){
            var naziv=$("#exampleFormControlInput1").val();
            //var brend=$("#exampleFormControlSelect1").val();
            //var kategorija=$("#exampleFormControlSelect2").val();
            //var pol=$("#exampleFormControlSelect3").val();
            var cena=$("#exampleFormControlInput2").val();
            var opis=$("#exampleFormControlTextarea1").val();
            //var dostupan=$("exampleFormControlSelect4").val();

            var brgresaka=0;

            if(!nazivkat.test(naziv)){
                brgresaka++;
            }
            if(cena < 0 ){
                brgresaka++;
            }
            if(opis.length <= 0 ){
                brgresaka++;
            }

            if(brgresaka!=0){
                $("#nistedodali").removeClass("d-none");
                event.preventDefault();
            }
            else{
                $("#nistedodali").addClass("d-none");
            }

        });

            
    }

    if (url.indexOf("index.php?page=dodatne-slike&id=") != -1){
        

        $("#dodatneslike").submit(function Provera3(event){

            var slika=$("#slikadodatna").val();

            //console.log(typeof(slika));

            if(slika==""){
                $("#nistedodali").removeClass("d-none");
                event.preventDefault();
            }
            else{
                $("#nistedodali").addClass("d-none");
            
            }

        });

            
    }

    if (url.indexOf("index.php?page=proizvodi") != -1){
        

        $("#filtriraj").on("click", function(){

            $("#filteri").addClass("d-none2");

        });


        $("#close").on("click", function(){

            $("#filteri").removeClass("d-none2");

        });


        $("#kategorija").on("change", function(){

            var id=$(this).val();

    
                $.ajax({
                    dataType:"json",
                    method:"post",
                    url:"models/global/podcatreturn.php",
                    data: {
                        id:id,
                    },
                    success:function(result) {
                        IspisiPodKategorije(result.podkat);
                        IspisiBrendove(result.brendovi);
                    },
                    error:function(xhr) {
                        console.log(xhr);
                    }

                
                });


        });

        function IspisiPodKategorije(niz){

            //console.log(niz);

            let html="";

            for(let n of niz){

                html+=
                `<div class="col-12">
                    <input type="checkbox" name='podkategorije' value="${n.id_category}"  />  ${n.name_category}      
                </div>`
            }

            $("#prikazpodkat").html(html);
            
        }



    function IspisiBrendove(niz){

        let html="";

        for(let n of niz){

            html+=
            `<div class="col-12">
                <input type="checkbox" class="podkat" name="brendovi" value="${n.id_brand}"  />  ${n.name_brand}      
            </div>`
        }


        $("#prikazbrendovi").html(html);

    }

        $("#cenamax").on("change", function(){
        
            let vrednost=$(this).val();
            
            $("#cenado").html(vrednost);

        });


    
    $(document).on("click", ".primenifilterepaginaciju", function(){
        

       var loading=`<div class="ma pt-5 mt-5">
                        <div class="pt-5 mt-5">
                            <div class="spinner-border" role="status"></div>
                        </div>
                    </div>`;

       $("#ispisproizvoda").html(loading);

        let keyword=$("#keyword").val();
        let podkategorije=[];
        let brendovi=[];
        let pol=$("input[name='pol']:checked").val();
        let cenamax=$("#cenamax").val();
        let sortcena=$("#sortcena").val();

        //console.log(cena);

        let paginacija=$(this).attr("vrednost");
        if(!paginacija) paginacija=0;

        //alert(paginacija);

        let regkeyword=/^[A-ZĆČŠŽĐ|a-zžčćšđ|0-9]{0,14}(\s[A-ZĆČŠŽĐ|a-zžčćšđ|0-9]{1,14})*$/;

        if(regkeyword.test(keyword)){

            $("input[name='podkategorije']").each(function() {
                if ($(this).is(':checked')) {
                var checked = ($(this).val());
                podkategorije.push(checked);
                }

            })


            $("input[name='brendovi']").each(function() {
                if ($(this).is(':checked')) {
                var checked = ($(this).val());
                brendovi.push(checked);  //brendovi.push($(this).val());
                }

            })

            
            $.ajax({
                dataType:"json",
                method:"post",
                url:"models/global/filteringproducts.php",
                data: {
                    keyword:keyword,
                    podkategorije:podkategorije,
                    brendovi:brendovi,
                    pol:pol,
                    cenamax:cenamax,
                    sortcena:sortcena,
                    paginacija:paginacija
                },
                success:function(result) {
                    IspisiProizvode(result.proizvodi);
                    //console.log(result.proizvodi);
                    StampajPaginaciju(result.brojfiltriranih);
                },
                error:function(xhr) {
                    console.log(xhr);
                }

            
            });
        
        }


    });


    function IspisiProizvode(niz){

        let html="";

        if(niz.length!=0) {
            for(let n of niz){

            html+=`<div class="proizvod-jedan">
            <div class="item">
                <div class="thumb">
                    <div class="hover-content">
                        <ul>
                            <li><a href="index.php?page=proizvod&id=${n.id_product}" rel="nofollow"><i class="fa fa-eye"></i></a></li>
                            <li><a class="dodajUkorpu" vrednost="${n.id_product}"><i class="fa fa-shopping-cart"></i></a></li>
                            <li><a class="dodajUFav" vrednost="${n.id_product}"><i class="fa fa-star"></i></a></li>
                        </ul>
                    </div>
                    <img src="${n.main_picture}" alt="${n.name_product}" class="slikaproizvoda">
                </div>
                <div class="down-content text-center pb-2">
                    <p class="imepr"> ${n.name_brand} ${n.name_product} </p>
                    <p class="cenalast">${n.latestprice} rsd</p>
                </div>
            </div>
            </div>`

            }
        }
        else{

        html+= `
            <div class="alert alert-primary ml-5 ">
                Trenutno nema proizvoda.
            </div>`
        }
        $("#ispisproizvoda").html(html);

    }

    function StampajPaginaciju(brojproizvoda){

        var strana=Math.ceil(brojproizvoda/brojpostrani);
        //alert(strana);

        let html="";

        html+=`<ul class="pagination">
                                <li class="page-item">
                                <a class="page-link primenifilterepaginaciju" vrednost="0" aria-label="Previous">
                                    <span aria-hidden="true">&laquo;</span>
                                </a>
                                </li>`
                
                                
                                    for(let i=0; i<strana; i++){


                                html+=`<a class="page-link primenifilterepaginaciju" vrednost="${i}"> 
                                    <li class="page-item">${i+1}</li>
                                </a>`

                                    }
                                


                                html+=`<a class="page-link primenifilterepaginaciju" vrednost="${strana -1}" aria-label="Next">
                                    <span aria-hidden="true">&raquo;</span>
                                </a>

                                </li>
                </ul>`

        $("#ispispaginacija").html(html);

    }

    }



    if (url.indexOf("index.php?page=proizvod&id=") != -1){
        
        
    var ocena=0;
    

        $(".oceni").on("click", function() {

            let vrednost= $(this).attr("id");

            //alert(vrednost);

            ocena=vrednost;
            
            $("#selektovanaOcena").html(ocena);


        });

        /*
        $(".oceni").on("focus", function() {      //nece fokus 
    
            let vrednost= $(this).attr("id");

            //alert(vrednost);
            
            for(let i=0;i<vrednost;i++){
                $("#1").addClass("bez");
            }

        });*/


    function IspisiKomentare(niz){

        var html="";

        if(niz.length!=0){

            for(let n of niz) {
            html+=`<div class="card-body p-4 ">

                <div class="d-flex flex-start">
                <img class="rounded-circle shadow-1-strong me-3 mr-4"
                    src="${n.small_picture}" alt="profilepic" width="60" height="60" />
                <div>
                    <h6 class="fw-bold mb-1">${n.first_name} ${n.last_name}</h6>
                    <div class="d-flex align-items-center mb-3">
                    <p class="mb-0">
                        ${n.reviewed_at}
                    </p>

                    </div>
                    <p class="mb-0">
                        ${n.comment}
                    </p>
                    <div class="pt-3">
                                Ocena: `
                            
                                
                                for(let i=0; i< n.id_mark; i++){

                                html+=` <i class="fa fa-star"></i>`
                                }
                            
                                html+=`
                                    </div>`

                                if(id_korisnika){
                                    if(id_korisnika==n.id_user){
                                    html+=`
                                    <button type="button" class="obrisikomentar btn btn-dark mt-4" productid='${n.id_product}' idcom="${n.id_review}" >
                                        Uklonite Recenziju</button> `
                                    }
                                }

                                html+=`</div>
                                </div>
                            </div>
                            <hr class="my-0" />`
            }
        }
        else{
            html+=`
                <div class="container my-5 py-4 pl-4 text-dark bg-light">
                    <h6 class="pb-3"> Trenutno nema komentara i ocena! Budite prvi ko će komentarisati ili oceniti ovaj proizvod. </h6>
                </div>`
        }
        
        $("#ispisirecenzije").html(html);



    }


        $("#review").on("click", function(){

            let proizvod= $(this).attr("idproizvod");
            let korisnik=$(this).attr("idkorisnik");
            let komentar=$("#textAreaExample").val();



            if(ocena!=0 && komentar.length>3 && komentar.length< 150 && !komentar.includes("<")){

                $("#greska").addClass("d-none");

                $.ajax({
                    dataType:"json",
                    method:"post",
                    url:"models/user/review.php",
                    data: {
                        proizvod:proizvod,
                        korisnik:korisnik,
                        komentar:komentar,
                        ocena:ocena
                    },
                    success:function(result) {
                        IspisiKomentare(result.rezencije);
                        //console.log(result);
                        alert("Postavljeno !");
                    },
                    error:function(xhr) {
                        console.log(xhr);
                    }

                });

            }
            else{
                $("#greska").removeClass("d-none");
            }


    });






    $(document).on("click", ".obrisikomentar", function(){

        var rewievid=$(this).attr('idcom');
        var productid=$(this).attr('productid');

        //alert(rewievid);


                $.ajax({
                    dataType:"json",
                    method:"post",
                    url:"models/user/delcomm.php",
                    data: {
                        rewievid:rewievid,
                        productid:productid
                    },
                    success:function(result) {
                        IspisiKomentare(result.rezencije);
                        //****************
                        // obnovi function scope-s id korisnika
                        //IdKorisnika(result.idkorisnika); 
                    },
                    error:function(xhr) {
                        console.log(xhr);
                    }

                });

    });

    /*
    var idKorisnika=0;

    function IdKorisnika(id){
        idKorisnika=id;
    }
    */




    //plus minus 

    /*
    $(".obaa").on("click", function(){

        var vrednost=$(this).val();
        var val=$("#ukupno").val();
        //alert(val);

 
        if(val<99){
            if(vrednost=='+'){
                $("#ukupno").val(parseInt(val) + 1);
            }
        }
        if(val>1){
            if(vrednost=='-'){
                $("#ukupno").val(parseInt(val)  - 1);
            }
        }

        var val=$("#ukupno").val();
        //alert(val);
        
        let cenajednog=$("#cenasakrivena").val();
        //alert(cenajednog);

        $("#prikazukupno").html(parseInt(cenajednog) * parseInt(val));
    });
*/
    

}


    if ( (url.indexOf("index.php?page=proizvodi") != -1  )  || (url.indexOf("index.php") != -1  ) || (url.indexOf("index.php?page=pocetna") != -1  ) || 
         (url.indexOf("index.php?page=proizvod&id") != -1  ) (url.indexOf("index.php?page=profil") != -1  ) )
    {
    
        

        $(document).on("click", ".dodajUFav", function(){

                if(id_korisnika){

                    let productfav=$(this).attr("vrednost");
                    let idkor=id_korisnika;

                    $.ajax({
                        dataType:"json",
                        method:"post",
                        url:"models/user/addtofavorite.php",
                        data: {
                            productfav:productfav,
                            idkor:idkor
                        },
                        success:function(result) {
                            alert(result);

                        },
                        error:function(xhr) {
                            console.log(xhr);
                        }
        
                    });
        

                }
                else{
                    alert("Morate da se ulogujete da biste dodali ovaj proizvod u omiljene. ");
                }

            })


        
            $(document).on("click", ".dodajUkorpu", function(){

                let productfav=$(this).attr("vrednost");
                let idkor=id_korisnika;
                //let vise=0;


                if(id_korisnika){

                    $.ajax({
                        dataType:"json",
                        method:"post",
                        url:"models/user/addtocart.php",
                        data: {
                            productfav:productfav,
                            idkor:idkor
                        },
                        success:function(result) {
                            alert(result.poruka);
                            OsveziKorpu(result.brojkorpa);

                        },
                        error:function(xhr) {
                            console.log(xhr);
                        }
        
                    });
        

                }
                else{
                    $.ajax({
                        dataType:"json",
                        method:"post",
                        url:"models/user/addtocartnotloged.php",
                        data: {
                            productfav:productfav,
                            idkor:idkor
                        },
                        success:function(result) {
                            alert(result.poruka);
                            OsveziKorpu(result.brojkorpa);

                        },
                        error:function(xhr) {
                            console.log(xhr);
                        }
        
                    });


                }

            })

        
    function OsveziKorpu(broj){

        if(broj){

            $("#brojKorpa").html(broj);
        }
        else{
            $("#brojKorpa").html(0);
        }
        



    }




    }


    if (url.indexOf("index.php?page=korpa") != -1){

        $(document).on("click", ".korpaquantity", function(){

            let vrednost=$(this).val();
            let idcartitem=$(this).attr("idcartitem");
            let id_cart=$(this).attr("id_cart");

            $.ajax({
                dataType:"json",
                method:"post",
                url:"models/user/plusminus.php",
                data: {
                    vrednost:vrednost,
                    idcartitem:idcartitem,
                    id_cart:id_cart

                },
                success:function(result) {
                    //console.log(result.korpaprikaz);
                    IspisiKorpu(result.korpaprikaz);
                    OsveziKorpu(result.brojukorpi);
                    UkupnaCena(result.ukupnacena);

                },
                error:function(xhr) {
                    console.log(xhr);
                }

            });

        });

        $(document).on("click", ".uklonired", function(){

            let idcartitem=$(this).attr("vrednost");
            let idcart=$(this).attr("idcart");

            $.ajax({
                dataType:"json",
                method:"post",
                url:"models/user/delrow.php",
                data: {
                    idcartitem:idcartitem,
                    idcart:idcart

                },
                success:function(result) {
                    //console.log(result.korpaprikaz);
                    IspisiKorpu(result.korpaprikaz);
                    OsveziKorpu(result.brojukorpi);
                    UkupnaCena(result.ukupnacena);

                },
                error:function(xhr) {
                    console.log(xhr);
                }

            });

        });




    function UkupnaCena(val){

        //alert(val);

        $("#ukupno").html(val +" rsd");

    }

    function  IspisiKorpu(niz){

        let html="";

        if(niz.length!=0){

        
        for(let s of niz){

            html+=`
                                <tr>
                                    <th><div> <img src="${s.main_picture}" width="90px" alt="${s.name_product}"  /> </div></th>
                                    <th><div class="pt-4">${s.name_brand} ${s.name_product}</div></th>

                                    <th>  
                                        <div class="pt-4">
                                            <input type="button" value="-" id_cart="${s.id_cart}" idcartitem="${s.id_cart_item}" class="minus korpaquantity">
                                                    &nbsp;&nbsp;   ${s.quantity}  &nbsp;&nbsp;
                                                <input type="button" value="+" id_cart="${s.id_cart}" idcartitem="${s.id_cart_item}"  class="plus korpaquantity">
                                        </div>
                                    </th>

                                    <th><div class="pt-4">${s.quantity * s.latestprice} rsd</div></th>
                                    <th scope="col"> <div class="pt-3">
                                        <button type="button" idcart="${s.id_cart}" vrednost="${s.id_cart_item}" class='uklonired btn btn-light'>
                                                Ukloni
                                            </button> </div>
                                    </th>
                    
                                </tr> `


            $("#ispisProizvodaKorpe").html(html);


        }
        }
        else{
            html=`<div class='bg-info py-3 px-3'>
            <h6> Trenutno nema proizvoda. </h6>
            </div>`;

        $("#plati").addClass("d-none");
        $("#ispisProizvodaKorpe").html("");
        $("#prazno").html(html);
        }



    }


}


    if (url.indexOf("index.php?page=kasa") != -1){

      

        $("#placanje").submit( (event)=> {


        var ime= $("#ime").val();
        var prezime= $("#prezime").val();
        var mejl= $("#inputEmail3").val();
        var telefon= $("#telefon").val();
        var adresa=$("#adresa").val();   ///^[A-ZĆČŠŽĐ]{1}[a-zžčćšđ]{2,9}(\s[A-ZĆČŠŽĐ]{1}[a-zžčćšđ]{2,9})+$/;
        var grad=$("#gradovi").val();
        var postbr=$("#postbr").val();
        var mesto=$("#mesto").val();


       
        let brojgresaka=0;



        if(!regimeprez.test(ime)){
            $("#greskaime").removeClass("d-none");
            brojgresaka++;
        }
        else{
            $("#greskaime").addClass("d-none");
        }

        if(!regimeprez.test(prezime)){
            $("#greskaprezime").removeClass("d-none");
            brojgresaka++;
        }
        else{
            $("#greskaprezime").addClass("d-none");
        }

        if(!regmejl.test(mejl)){
            $("#greskamejl").removeClass("d-none");
            brojgresaka++;
        }
        else{
            $("#greskamejl").addClass("d-none");
        }

        if(!regadresa.test(adresa) || adresa.length>70){
            $("#greskaadresa").removeClass("d-none");
            brojgresaka++;
        }
        else{
            $("#greskaadresa").addClass("d-none");
        }

        if(grad==0){
            $("#greskagrad").removeClass("d-none");
            brojgresaka++;
        }
        else{
            $("#greskagrad").addClass("d-none");
        }


        if(telefon.length != 10){
            brojgresaka++;
            $("#greskatelefon").removeClass("d-none");
        }
        else{
            $("#greskatelefon").addClass("d-none");
        }

        if(postbr.length != 5){
            brojgresaka++;
            $("#greskapostbr").removeClass("d-none");
        }
        else{
            $("#greskapostbr").addClass("d-none");
        }

        if(mesto.length < 3 || mesto.length>30){
            brojgresaka++;
            $("#greskamesto").removeClass("d-none");
        }
        else{
            $("#greskamesto").addClass("d-none");
        }

        if(brojgresaka!=0){
        
            event.preventDefault();

        }


    });


}

if (url.indexOf("index.php?page=profil") != -1){

    $("#profilnanova").submit(function Provera(event){

        var slika=$("#slikaprofilna").val();


        if(slika==""){
            $("#nistedodali").removeClass("d-none");
            event.preventDefault();
        }
        else{
            $("#nistedodali").addClass("d-none");
        
        }

    });


}

if (url.indexOf("index.php?page=admin") != -1){

    $(document).on("click", "#azuriraj", function(){

        let vrednost=$("#exampleFormControlTextarea1textparagraf").val();

        //alert(vrednost);

        $.ajax({
            dataType:"json",
            method:"post",
            url:"models/admin/updatetextpost.php",
            data: {
                vrednost:vrednost,

            },
            success:function(result) {
                alert(result);

            },
            error:function(xhr) {
                console.log(xhr);
            }

        });

    });


}




}


