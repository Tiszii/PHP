<?php

// Check if the type of a variable is integer   
$x = 5985;
var_dump(is_int($x));

echo "<br><br> Check if the type of a variable is integer";

// Check again... 
$x = 59.85;
var_dump(is_int($x));

echo "<br><br> controlla se x è finita o infinita";    //controlla se x è finita o infinita

$x = 1.9e411;
var_dump($x);

echo "<br><br> arcos in radianti se non puo essere calcolato --> NaN";    //arcos in radianti se non puo essere calcolato --> NaN
$x = acos(8);   
var_dump($x);

echo "<br><br> Controlla se x è una variabile numerica ";    //controlla se x è una variabile numerica 
$x = 5985;
var_dump(is_numeric($x));

$x = "5985";
var_dump(is_numeric($x));

$x = "59.85" + 100;
var_dump(is_numeric($x));

$x = "Hello";
var_dump(is_numeric($x));

echo "<br><br> Cast float to int";
// Cast float to int
$x = 23465.768;
$int_cast = (int)$x;
echo $int_cast;

echo "<br><br> Cast string to int";

// Cast string to int
$x = "23465.768";
$int_cast = (int)$x;
echo $int_cast;
?>  
