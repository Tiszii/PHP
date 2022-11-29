<!DOCTYPE HTML>
<html>
    <head>
        <meta charset="utf-8">
        <title>Somma</title>
        <h1>Pagina per la somma dei numeri</h1>
        <br>
        <br>
    </head>
    <body>
        <?php
        $num1Err = $num2Err = "";
        $num1;
        $num2;

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if (empty($_POST["num1"])) {
                $num1Err = "Valore richiesto!";
            } else {
                $num1 = test_input($_POST["num1"]);
                if (!preg_match("a{0,}", $num1)) {
                    $num1Err = "Valore inserito non valido";
                }
            }

            if (empty($_POST["num2"])) {
                $num2Err = "Valore richiesto!";
            } else {
                $num2 = test_input($_POST["num2"]);
                if (!preg_match("a{0,}", $num2)) {
                    $num2Err = "Valore inserito non valido";
                }
            }
        }

        function somma() {
            global $num1;
            global $num2;
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
            <input type="number" name="num1">
            <br>
            <input type="number" name="num2">
            <br>
            <br>
            <input type="submit" name="submit" value="Calcola">
        </form>
        <div id="result">
            
                <?= somma() ?>
            
        </div>
        <br>
        <div id="number">
            <p><?php
                echo $num1;
                ?>
                <br>
                <?php
                echo $num2;
                ?>
                <br>
            </p>
        </div>
    </body>
</html>
