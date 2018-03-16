<?php
$city="Sucre";
$country="BO"; //Two digit country code
$url="http://api.openweathermap.org/data/2.5/weather?q=".$city.",".$country."&units=metric&cnt=7&lang=es&id=524901&APPID={APIKEY}";
$json=file_get_contents($url);
$data=json_decode($json,true);
//Get current Temperature in Celsius
echo $data['main']['temp']."<br>";
//Get weather condition
echo $data['weather'][0]['main']."<br>";
//Get cloud percentage
echo $data['clouds']['all']."<br>";
//Get wind speed
echo $data['wind']['speed']."<br>";
?>
https://www.bcb.gob.bo/librerias/indicadores/dolar/bolsin.php

http://api.openweathermap.org/data/2.5/weather?q=Sucre,bo&appid=d8b17900f6f22b07db5ee898d85257e5

http://www1.abi.bo/abi/noticias.php?nocache=0.638743808147475&i=1&j=398140