

<html lang="en">
<head>
    <link rel="stylesheet" href="/style.css">
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Document</title>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css"
integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A=="
crossorigin=""/>
<script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"
integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA=="
crossorigin=""></script>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
</head>
<body>



<style>




#map { height: 100%; margin-top: -300px; }

.radios {
    display: grid;
    grid-template-columns:  1fr 1fr;
}

.monform {
    position: relative;
    z-index: 9999;
    padding: 50px;
    border: none !important;
}

.form {
    margin: auto;
    margin-bottom: 20px;
}
.main {
    display: grid;
    grid-template-columns: 1fr 1fr 1fr;
}


.leaflet-marker-icon img{
    display: none !important;
}

body {
    color: #167544;

    background: #d8f1db;
}

</style>


<?php 





?>

<div class="main">

<div id='text-reponse' class="card">
</div>
<div class="card"></div>
<div class="card"></div>

</div>



<form>
<div class="form" methode="GET" action="">
       
<div class="card shadow  monform">

<h1>REPAIR TAG</h1>
   
   <h2> Vous cherchez à réparer un appareil </h2>




<label class="form-label" for="">Quel objet avez vous besoin de réparer ?</label>

<select name="objet" id="selection">



</select>

<br>
<button id="button-form" type="submit"  class="btn btn-primary  m-2 ">Valider</button>
</form> 
<button id="button-form" type="submit"  class="btn btn-Warning m-2">demmander un devis </button>

</div>



</div>
</div>
<div id="param"><?php echo $_GET["p"];


?></div>



<div id="paramobjet"> <?php echo $_GET["objet"]; ?></div>

<div id="map"></div>


<script>

var activite = [];
$.ajax({
    url: 'https://repairtag.asso-bug.org/repairtag/activites.json',
    type: 'POST',
    
    success: function(response) {
        
        console.log(response)
        activite = response;
        
    }
    
});
var paramobjet = $("#paramobjet").html()
var tab = [];

let inputs = $("input");
$.ajax({
    url: 'https://repairtag.asso-bug.org/repairtag/data.json',
    type: 'POST',
    
    success: function(response) {
        
        console.log(response)
        tab = response;
        
    }
    
    
    
});



var param = $("#param").html()

function maping (param2 = "") {
    
    
    let selection = $("#selection");
    for (let z = 0; z < activite.length; z++) {
        selection.append('<option  class="options"  value='+  activite[z].Activités+'>'+activite[z].Activités+'</option')
    }
    
    var map = L.map('map').setView([48.117266, -1.6777926], 13);
    
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        // attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
    }).addTo(map);
    
    
    paramobjet = paramobjet.replaceAll(" ", "");
    for (let s = 0; s< tab.length; s++) {
        // console.log('param', param, 'obj', paramobjet);
        if(param || paramobjet) {
            if((tab[s].Type && tab[s].Type == param) || tab[s].Activités.includes(paramobjet)) {
                console.log('true', );
                L.marker([tab[s].latitude, tab[s].longitude]).addTo(map)
                .bindPopup(tab[s].Nom + "<br>" + tab[s].Activités+ "<br>" + tab[s].Contact) 

                .openPopup();   
                                
            }
            else {

            }
        }else {
            L.marker([tab[s].latitude, tab[s].longitude]).addTo(map)
            .bindPopup(tab[s].Nom)
            .openPopup();  
            
        }
        
        
        
        
        
        
        
        
        
        
        // L.marker([51.5, -0.05]).addTo(map)
        // .bindPopup('A pretty CSS3 popup.<br> Easily customizable.')
        // .openPopup();  
        
    }
}
window.onload =  function (){
    
    maping()
    
    
    
    
    
}







</script>




</body>





</html>