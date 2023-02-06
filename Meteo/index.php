<!DOCTYPE html>

<html>
    <head>
        <title>Previsioni meteo</title>
        <meta charset="UTF-8">
        <style>
            body{
                text-align: center;
                align-content: center;
            }
        </style>
    </head>
    <body>
        <?php
        $luogo = "";
        $luogoErr = "";
        $verificato = false;
        if ($_SERVER["REQUEST_METHOD"] == "POST") {

            if (!empty($_POST["luogo"])) {
                $verificato = true;
                $luogo = test_input($_POST["luogo"]);
                $prev = "";
                $settimana = array();
                $seed = "";
                for ($i = 0; $i < strlen($luogo); $i++) {
                    $seed .= ord(substr($luogo, $i, 1));
                }
                //echo $seed;

                for ($i = 0; $i < 7; $i++) {
                    $previsione = substr($seed, $i, 1);
                    if ($previsione > 5) {
                        $settimana["$i"] = 0;
                    } else if ($previsione % 2 == 0) {
                        $settimana["$i"] = 1;
                    } else {
                        $settimana["$i"] = 2;
                    }
                }

                setcookie($luogo, count($_COOKIE), time() + (86400), "/");
            } else {
                $luogoErr = "Inserire una città!";
            }
        }

        function test_input($data) {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }
        ?>


        <?php if (!$verificato) { ?>
            <div  id="login">
                <h1>PREVISIONI METEO</h1>
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                    <input type="text"  placeholder="Inserisci città" name="luogo"  value="<?php echo $luogo; ?>" pattern="[A-Za-z]{1,20}" title="Inserire solo lettere!">
                    <span ><?php echo $luogoErr; ?></span>
                    <br><br>
                    <span class="temp">  
                        Recenti:
                        <?php
                        foreach ($_COOKIE as $cookie_name => $cookie_value) {
                            ?> <input type="submit"  name="luogo" value="<?php echo $cookie_name; ?>"> <?php
                        }
                        ?></span>
                    <br><br>
                    <input type="submit" value="CERCA">
                </form>
            </div>

        <?php } else {
            ?>
            <div  id="login">
                <?php $url = htmlspecialchars($_SERVER['HTTP_REFERER']) ?>
                <h1>PREVISIONI METEO</h1>
                <br>
                <br>
                <form>
                    <table align="center">
                        <tr>
                            <th colspan="14" style="font-size: 40px"><?php echo $luogo; ?></th>
                        </tr>   
                        <tr>
                            <?php for ($i = 0; $i < count($settimana); $i++) { ?>
                                <td>
                                    <?php
                                    switch ($i):
                                        case 0:
                                            echo "Lunedì";
                                            break;
                                        case 1:
                                            echo "Martedì";
                                            break;
                                        case 2:
                                            echo "Mercoledì";
                                            break;
                                        case 3:
                                            echo "Giovedì";
                                            break;
                                        case 4:
                                            echo "Venerdì";
                                            break;
                                        case 5:
                                            echo "Sabato";
                                            break;
                                        case 6:
                                            echo "Domenica";
                                            break;

                                    endswitch;
                                    ?>
                                </td>

                                <td>
                                    <?php
                                    switch ($settimana[$i]):
                                        case 0:
                                            ?>
                                            <img src="img/sole.png" width="200" height="200" alt="alt"/>
                                            <?php
                                            break;
                                        case 1:
                                            ?>
                                            <img src="img/pioggia.png" width="200" height="200 alt="alt"/>
                                            <?php
                                            break;
                                        case 2:
                                            ?>
                                            <img src="img/nuvole.png" width="200" height="200" alt="alt"/>
                                            <?php
                                            break;
                                    endswitch;
                                    ?> 
                                </td>
                            <?php } ?>
                    </table>
                </form>
                <br>
                <div 
                    style="font-size: 20px"><a href=> Back </a>

                </div>
            </div>
        <?php } ?>
    </body>
</html>