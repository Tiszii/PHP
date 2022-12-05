<!DOCTYPE HTML>
<html>
    <head>
        <meta charset="utf-8">
        <title>Somma</title>
    <h1>Pagina per la somma dei numeri</h1>
    <br>
    <br>
    <style>
        body{
            text-align: center;
        }
    </style>
</head>
<body>
    <?php
    $num1Err = $num2Err = "";
    $num1 = 0;
    $num2 = 0;

    
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        
        //controllo numero 2 
        $num2 = test_input($_POST["num2"]);
        if (!preg_match("/^\\d+$/", $num2)) {
            $num2Err = "Valore inserito non valido";
        }
        
        //controllo numero 1
        $num1 = test_input($_POST["num1"]);
        if (!preg_match("/^\\d+$/", $num1)) {
            $num1Err = "Valore inserito non valido";
        }
        
        
        /*
          if (empty($_POST["num1"])) {
          $num1Err = "Valore richiesto!";
          } else {
          $num1 = test_input($_POST["num1"]);
          if (!preg_match("/^\\d+$/", $num1)) {
          $num1Err = "Valore inserito non valido";
          }
          }
          
          if (empty($_POST["num2"])) {
          $num2Err = "Valore richiesto!";
          } else {
          $num2 = test_input($_POST["num2"]);
          if (!preg_match("/^\\d+$/", $num2)) {
          $num2Err = "Valore inserito non valido";
          }
          }
         * */
    }

    function somma() {
        global $num1;
        global $num2;
        global $num1Err;
        global $num2Err;
        if ($num1Err !== "" || $num2Err !== "") {
            return $num1Err . "\n" . $num2Err;
        }
        return $num1 + $num2;
    }

    function test_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
    ?>
    <form action="<?php htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST" name="formSus">
        <br>
        <input type="text" name="num1">
        <br>
        <br>
        <input type="text" name="num2">
        <br>
        <br>
        <input type="submit" name="submit" value="Calcola">
    </form>
    <div id="result">
        <?php
        if ($num1Err !== "" || $num2Err !== "") {
            ?>
            <p><?= somma() ?></p>
            <?php
        } elseif (somma() === 0) {
            
        } else {
            ?>
            <p>La somma è <?= somma() ?> e gli addendi sono <?= $num1 ?> e <?php
                echo $num2;
            }
            ?></p>      
    </div>
    <br>
</body>
</html>