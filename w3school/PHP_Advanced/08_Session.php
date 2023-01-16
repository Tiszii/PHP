<?php
// Start the session
session_start();
?>
<!DOCTYPE html>
<html>
    <body>

        <?php
        // Set session variables
        $_SESSION["favcolor"] = "green"; // to change a session variable, just overwrite it
        $_SESSION["favanimal"] = "cat";
        print_r($_SESSION);
        echo "<br>";
        echo "Session variables are set.";
        ?>
        <?php
        // remove all session variables
        session_unset();

        // destroy the session
        session_destroy();
        ?>
    </body>
</html>