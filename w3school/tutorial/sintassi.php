<!DOCTYPE html>
<html>
    <head>
        <style>
            body{
                text-align: center;
            }
        </style>
    </head>
    <body>
        <h1>My first PHP page</h1>
        <?php
        echo "My first PHP script!<br><br>";

        echo "<br>-------------------------------------------------<br>"; //

        $txt = "(not really) php";
        echo "I love $txt! <br><br>";

        echo "<br>-------------------------------------------------<br>"; //

        $color = "red";
        echo "My car is " . $color . "<br>";
        echo "My house is " . $color . "<br>";
        echo "My boat is " . $color . "<br>";

        //commento su una linea
        #commento su una linea
        /*
          commento su più linee
         */

        echo "<br>-------------------------------------------------<br>";       //

        $x = 5 /* + 15 */ + 5;                                                  //posso usare i commenti per escludere parti di codice
        echo $x . " --> Somma di 5+5 con il 15 escluso<br>";

        echo "<br>-------------------------------------------------<br>";       //

        $txt = "Hello world!";
        $x = 5;
        $y = 10.5;
        echo "Ciao mondo " . $txt . "!!!<br>";
        echo "Ciao mondo $txt !!!<br>";
        echo $x + $y . " --> Somma di 5 + 10.5<br> ";

        echo "<br>-------------------------------------------------<br>";       //

        $x = 5;                                                                 //variabile globale

        function test() {
            $y = 10;                                                            //variabile locale
            static $z = 6;                                                      //variabile statica
            global $x;                                                          //per usare la variabile globale all'interno di una funzione 
            echo "Variabile y = $y, Variabile z = $z, Variabile x = $x<br>";
        }

        test();

        echo "<br>-------------------------------------------------<br>"; //

        echo "I'm about to learn PHP!<br>";
        print "This string was made with multiple parameters.";                 //The differences are small: echo has no return value while print has a return value of 1 so it can be used in expressions.
        ?>

    </body>
</html>

