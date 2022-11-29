<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="shortcut icon" href="img/coding.png" type="image/x-icon">
        <title>Registration</title>
        <!-- Bulma Version 0.9.0-->
        <link rel="stylesheet" href="../bulma/css/bulma.min.css" />
        <link rel="stylesheet" href="../bulma/css/modal-fx.min.css" />
    </head>
    <body>
        <?php
        //define variables and set to empty values
        $nomeErr = $emailErr = $passwordErr = $cognomeErr = "";
        $nome = $email = $password = $cognome = $ConfirmPassword = "";

        if ($_SERVER["REQUEST_METHOD"] == "POST") {

            //validazione nome
            if (empty($_POST["nome"])) {
                $nomeErr = "Il nome è richiesto<br>";
            } else {
                $nome = test_input($_POST["nome"]);
                // controllo se il nome contiene solo lettere e spazi bianchi
                $nome_regrex = "/^[a-zA-Z-' ]*$/";
                if (!preg_match($nome_regrex, $nome)) {
                    $nomeErr = "Solo lettere e spazi bianchi sono ammessi <br>";
                    $nome = "";
                }
            }

            //Validazione cognome
            if (empty($_POST["cognome"])) {
                $cognomeErr = "Il cognome è richiesto<br>";
            } else {
                $cognome = test_input($_POST["cognome"]);
                // controllo se il nome contiene solo lettere e spazi bianchi
                $cognome_regrex = "/^[a-zA-Z-' ]*$/";
                if (!preg_match($cognome_regrex, $cognome)) {
                    $cognomeErr = "Solo lettere e spazi bianchi sono ammessi <br>";
                    $cognome = "";
                }
            }

            //Validazione email
            if (empty($_POST["email"])) {
                $emailErr = "L'email è richiesta<br>";
            } else {
                $email = test_input($_POST["email"]);
                //controllo se l'email è corretta
                $email_validation_regex = '/^\\S+@\\S+\\.\\S+$/';
                if (!preg_match($email_validation_regex, $email)) {
                    $emailErr = "Email fornita non valida <br>";
                    $email = "";
                }
            }

            //Validazione password
            if (empty($_POST["password"]) && empty($_POST["ConfirmPassword"])) {
                $passwordErr = "La password è richiesta<br>";
            } else {
                $password = test_input($_POST["password"]);
                $ConfirmPassword = test_input($_POST["ConfirmPassword"]);
                //Controllo della password se è scritta correttamente
                $password_regex = "/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{8,}$/";
                if (!preg_match($password_regex, $password)) {
                    $passwordErr = "Formato non valido, la password deve contenere almeno: <br>- Almeno 1 numero <br>- minimo 8 caretteri <br>- almeno 1 lettara maiuscola <br>- almeno 1 lettera minuscola <br>- almeno un carattere speciale <br>";
                    $password = "";
                    $ConfirmPassword = "";
                }
                if ($password != $ConfirmPassword) {
                    $passwordErr .= "<br>Le password non coincidono<br>";
                    $ConfirmPassword = "";
                }
            }
        }

        function test_input($data) {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }
        ?>
        <section class="hero is-info is-small">
            <div class="hero-body">
                <div class="container has-text-centered">
                    <br>
                    <p class="title is-1">
                        Pagina per la registrazione
                    </p>
                    <p class="subtitle">
                        Realizzato da Dalri Tiziano
                    </p>
                    <br>
                </div>
            </div>
        </section>
        <div class="box cta">
            <nav class="level">
                <div class="level-left">
                </div>
                <div class="level-item has-text-centered">
                    <div>
                        <p><?php
                            echo $nomeErr;
                            ?>
                            <br>
                            <?php
                            echo $cognomeErr;
                            ?>
                            <br>
                            <?php
                            echo $emailErr;
                            ?>
                            <br>
                            <?php
                            echo $passwordErr;
                            ?>
                        </p>
                    </div>
                </div>
                <div class="level-right has-text-centered">
                    <div>
                        <div class="buttons">

                        </div>
                    </div>
                </div>
            </nav>
        </div>
        <br>
        <section class="container">
            <p class="level-item" style="font-size:40px">Registrati</p>
            <br>
            <br>
            <div class="level-item">
                <form action="<?= htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" name="formRegistrazione" id="formRegistrazione">
                    <div class="field">
                        <div class="control">
                            <input class="input is-medium" type="text" placeholder="Nome" name="nome" id="fnome" value="<?= $nome ?>">
                        </div>
                    </div>
                    <br>
                    <div class="field">
                        <div class="control">
                            <input class="input is-medium" type="text" placeholder="Cognome" name="cognome" id="fcognome" value="<?= $cognome ?>">
                        </div>
                    </div>
                    <br>
                    <div class="field">
                        <div class="control">
                            <input class="input is-medium" type="text" placeholder="Email" id="email" name="email" value="<?= $email ?>">
                        </div>
                    </div>
                    <br>
                    <div class="field">
                        <div class="control">
                            <input class="input is-medium" type="password" placeholder="Password" name="password" id="password" value="<?= $password ?>">
                        </div>
                    </div>
                    <br>
                    <div class="field">
                        <div class="control">
                            <input class="input is-medium" type="password" placeholder="Conferma password" name="ConfirmPassword" id="Cpassword" value="<?= $ConfirmPassword ?>">
                        </div>
                    </div>
                    <br>
                    <div class="level-item">
                        <input class="button is-info" type="submit" value="Invia" name="btnA">
                    </div>
                    <br>
                    <br>
                </form>
        </section>
    </body>
</html>
