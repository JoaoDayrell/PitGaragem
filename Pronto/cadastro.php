<?php include 'inc/header.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
  
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
 
    <title>PITstop</title>
 
    <style>
    /* some custom css */
    #gmap_canvas{
        width:100%;
        height:30em;
    }
    </style>
 
</head>
<body>
  
</body>
</html>
<br><br><br><br>
<div class="limiter">
<form action="" method="post">
    <div class="container-login100-form-btn">
    <input class="input100" type='text' name='address' placeholder='Digite um endereço: Ex: Nº rua, cidade'/>
    <button class="login100-form-btn" value='Buscar'> Buscar </button>
</div>
</form>
</div>

<?php 

// function to geocode address, it will return false if unable to geocode address
function geocode($address){
 
    // url encode the address
    $address = urlencode($address);
     
    // google map geocode api url
    $url = "https://maps.googleapis.com/maps/api/geocode/json?address={$address}&key=AIzaSyCISb55wBmdvH61hKREoXTTX4S64wrVL08";
 
    // get the json response
    $resp_json = file_get_contents($url);
     
    // decode the json
    $resp = json_decode($resp_json, true);
 
    // response status will be 'OK', if able to geocode given address 
    if($resp['status']=='OK'){
 
        // get the important data
        $lati = isset($resp['results'][0]['geometry']['location']['lat']) ? $resp['results'][0]['geometry']['location']['lat'] : "";
        $longi = isset($resp['results'][0]['geometry']['location']['lng']) ? $resp['results'][0]['geometry']['location']['lng'] : "";
        $formatted_address = isset($resp['results'][0]['formatted_address']) ? $resp['results'][0]['formatted_address'] : "";
         
        // verify if data is complete
        if($lati && $longi && $formatted_address){
         
            // put the data in the array
            $data_arr = array();            
             
            array_push(
                $data_arr, 
                    $lati, 
                    $longi, 
                    $formatted_address
                );
             
            return $data_arr;
             
        }else{
            return false;
        }
         
    }
 
    else{
        echo "<strong>ERROR: {$resp['status']}</strong>";
        return false;
    }
}

?>
<?php
if($_POST){
 
    // get latitude, longitude and formatted address
    $data_arr = geocode($_POST['address']);
 
    // if able to geocode the address
    if($data_arr){
         
        $latitude = $data_arr[0];
        $longitude = $data_arr[1];
        $formatted_address = $data_arr[2];
                     
    ?>
 <?php

$_SESSION['endereco'] = $formatted_address; 
$_SESSION['latitude'] = $latitude;
$_SESSION['longitude'] = $longitude; ?></label>




    <!-- google map will be shown here -->
    <div id="gmap_canvas">Carregando mapa...</div>
    <div id='map-label'>
    <form action="cadastrar.php" method="POST">
        <div class="container-login100-form-btn">
    <button class="login100-form-btn-enviar" value='Enviar'> Enviar </button>
    </div>
</form>
    </div></a>
    
 
    <!-- JavaScript to show google map -->
    <script type="text/javascript" src="https://maps.google.com/maps/api/js?key=AIzaSyCISb55wBmdvH61hKREoXTTX4S64wrVL08"></script>   
    <script type="text/javascript">
        function init_map() {







            var myOptions = {
                zoom: 14,
                center: new google.maps.LatLng(<?php echo $latitude; ?>, <?php echo $longitude; ?>),
                mapTypeId: google.maps.MapTypeId.ROADMAP
            };
            map = new google.maps.Map(document.getElementById("gmap_canvas"), myOptions);
            marker = new google.maps.Marker({
                map: map,
                position: new google.maps.LatLng(<?php echo $latitude; ?>, <?php echo $longitude; ?>)
            });
            infowindow = new google.maps.InfoWindow({
                content: "<?php echo $formatted_address; ?>"
            });
            google.maps.event.addListener(marker, "click", function () {
                infowindow.open(map, marker);
            });
            infowindow.open(map, marker);


            
        }
        
        google.maps.event.addDomListener(window, 'load', init_map);
    </script>
 
    <?php
 
    // se nao encontrar o local
    }else{
        echo "Não foi possível encontrar o local.";
    }
}

?>

