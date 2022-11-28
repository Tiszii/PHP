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
        $nome = $email = $password = $cognome = "";

        if ($_SERVER["REQUEST_METHOD"] == "POST") {

            //validazione nome
            if (empty($_POST["nome"])) {
                $nomeErr = "Il nome è richiesto";
            } else {
                $nome = test_input($_POST["nome"]);
                // controllo se il nome contiene solo lettere e spazi bianchi
                if (!preg_match("/^[a-zA-Z-' ]*$/", $nome)) {
                    $nomeErr = "Solo lettere e spazi bianchi sono ammessi";
                }
            }

            //Validazione cognome
            if (empty($_POST["cognome"])) {
                $cognomeErr = "Il cognome è richiesto";
            } else {
                $cognome = test_input($_POST["cognome"]);
                // controllo se il nome contiene solo lettere e spazi bianchi
                if (!preg_match("/^[a-zA-Z-' ]*$/", $cognome)) {
                    $cognomeErr = "Solo lettere e spazi bianchi sono ammessi";
                }
            }

            //Validazione email
            if (empty($_POST["email"])) {
                $emailErr = "L'email è richiesta";
            } else {
                $email = test_input($_POST["email"]);
                //controllo se l'email è corretta
                if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    $emailErr = "Email fornita non valida";
                }
            }

            //Validazione password
            if (empty($_POST["password"])) {
                $passwordErr = "La password è richiesta";
            } else {
                $password = test_input($_POST["password"]);
                //Controllo della password se è scritta correttamente
                if (!preg_match("^\S*(?=\S{8,})(?=\S*[a-z])(?=\S*[A-Z])(?=\S*[\d])\S*$^", $password)) {
                    $password = "Formato non valido, la password deve contenere almeno: <br>- Almeno 1 numero <br>- minimo 8 caretteri <br>- almeno 1 lettara maiuscola <br>- almeno 1 lettera minuscola";
                }
            }

            if (empty($_POST["comment"])) {
                $comment = "";
            } else {
                $comment = test_input($_POST["comment"]);
            }

            if (empty($_POST["gender"])) {
                $genderErr = "Gender is required";
            } else {
                $gender = test_input($_POST["gender"]);
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
                            <br>
                            <?php
                                echo $nomeErr;
                            ?>
                            <br>
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
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" name="formRegistrazione" id="formRegistrazione">
                    <div class="field">
                        <div class="control">
                            <input class="input is-medium" type="text" placeholder="Nome" name="nome" id="fnome" pattern="[A-Za-z]{4,15}">
                        </div>
                    </div>
                    <br>
                    <div class="field">
                        <div class="control">
                            <input class="input is-medium" type="text" placeholder="Cognome" name="cognome" id="fcognome" pattern="[A-Za-z]{4,15}">
                        </div>
                    </div>
                    <br>
                    <div class="field">
                        <div class="control">
                            <!--<input class="input is-medium" type="email" placeholder="Email" name="email" id="femail" pattern="[a-z]*\.[a-z][a-z0-9]*@buonarroti.tn.it">-->
                            <input class="input is-medium" type="text" placeholder="Email" id="email" name="email" required=""> <!-- pattern="[a-z]*\.[a-z][a-z0-9]*"-->
                        </div>
                    </div>
                    <br>
                    <div class="field">
                        <div class="control">
                            <input class="input is-medium" type="password" placeholder="Password" name="password" id="password">    <!-- pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}"-->
                        </div>
                    </div>
                    <br>
                    <div class="field">
                        <div class="control">
                            <input class="input is-medium" type="password" placeholder="Conferma password" name="ConfirmPassword" id="Cpassword">
                        </div>
                    </div>
                    <br>
                    <div class="level-item">
                        <input class="button is-info" type="submit" value="Invia" name="btnA">
                    </div>
                </form>
        </section>
    </body>
</html>
