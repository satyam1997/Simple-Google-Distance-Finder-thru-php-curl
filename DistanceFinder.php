<?php

/**
 * @author Abhay Kumar Verma
 * Lucknow
 */
error_reporting(0);

if (!empty(isset($_POST['find']))) {
    //source address field
    $address = $_POST['address'];
    //destination address field
    $addresses = $_POST['addresses'];
   //php client url method 
    $ch = curl_init();
    //google map Api url for source
    $url = 'http://maps.google.com/maps/api/geocode/json?address="' . $address . '"';
   //setting Curl options ucan also set these in array
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    
   //responce time of api 
    curl_setopt($ch, CURLOPT_TIMEOUT,8);
   
    //sometimes in XAMPP the responce will return empty this problem was cause by SSL certificate validation 
    //so close it
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    
    //executing curl 
    $output = curl_exec($ch);
    //closing curl 
    curl_close($ch);
    
    //reciving data in json form thru php json_decode method
    $json = json_decode($output);
    //google api resonce latitute
    $latitudeFrom = $json->results[0]->geometry->location->lat;
    //google api resonce longitude
    $longitudeFrom = $json->results[0]->geometry->location->lng;

    //curl setup for Destination point
    $ch2 = curl_init();
    
    $url2 = 'http://maps.google.com/maps/api/geocode/json?address="' . $addresses . '"';
    
    curl_setopt($ch2, CURLOPT_URL, $url2);
    curl_setopt($ch2, CURLOPT_RETURNTRANSFER, 1);
   
    $output2 = curl_exec($ch2);
    
    curl_close($ch2);
    $json2 = json_decode($output2);
    
    $latitudeTo = $json2->results[0]->geometry->location->lat;
    $longitudeTo = $json2->results[0]->geometry->location->lng;
    
    //formula for obtaining degree 
    $degrees = rad2deg(acos((sin(deg2rad($latitudeFrom)) * sin(deg2rad($latitudeTo))) + (cos(deg2rad($latitudeFrom)) * cos(deg2rad($latitudeTo)) * cos(deg2rad($longitudeFrom - $longitudeTo)))));
    
    $dist = $degrees * 111.13384;
    //$money=$dist * 10 ;
}
?>
