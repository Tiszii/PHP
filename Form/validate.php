<?php
// define variables and set to empty values
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
            $emailErr = "Formato non valido";
        }
    }

    //Validazione password
    if (empty($_POST["password"])) {
        $passwordErr = "La password è richiesta";
    } else {
        $password = test_input($_POST["password"]);
        //Controllo della password se è scritta correttamente
        if (!preg_match("^\S*(?=\S{8,})(?=\S*[a-z])(?=\S*[A-Z])(?=\S*[\d])\S*$", $password)) {
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