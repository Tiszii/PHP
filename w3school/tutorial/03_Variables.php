<?php

$x = 5 /* + 15 */ + 5;                                                  //posso usare i commenti per escludere parti di codice
echo $x . " --> Somma di 5+5 con il 15 escluso<br>";


$txt = "Hello world!";
$x = 5;
$y = 10.5;
echo "Ciao mondo " . $txt . "!!!<br>";
echo "Ciao mondo $txt !!!<br>";
echo $x + $y . " --> Somma di 5 + 10.5<br> ";


$x = 5;                                                                 //variabile globale
function test() {
    $y = 10;                                                            //variabile locale
    static $z = 6;                                                      //variabile statica
    global $x;                                                          //per usare la variabile globale all'interno di una funzione 
    echo "Variabile y = $y, Variabile z = $z, Variabile x = $x<br><br><br>";
}

test();

$x = 5;
$y = 10;

function myTest() {
  $GLOBALS['y'] = $GLOBALS['x'] + $GLOBALS['y'];
}

myTest();
echo $y; // outputs 15
?>

