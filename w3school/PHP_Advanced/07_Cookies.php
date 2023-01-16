<?php
//setcookie(name, value, expire, path, domain, secure, httponly);
//Only the name parameter is required. All other parameters are optional.
?>
<!DOCTYPE html>
<?php
$cookie_name = "user";
$cookie_value = "John Doe";
setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/"); // 86400 = 1 day
?>
<html>
    <body>

        <?php
        if (!isset($_COOKIE[$cookie_name])) {
            echo "Cookie named '" . $cookie_name . "' is not set!";
        } else {
            echo "Cookie '" . $cookie_name . "' is set!<br>";
            echo "Value is: " . $_COOKIE[$cookie_name];
        }
        ?>

        <p><strong>Note:</strong> You might have to reload the page to see the value of the cookie.</p>

    </body>
</html>
<!--
//to modify a cookie, just set again the cookie using the setcookie() function
// set the expiration date to one hour ago to delete a cookie
setcookie("user", "", time() - 3600);


//check if cookies are enabled  
setcookie("test_cookie", "test", time() + 3600, '/');
if(count($_COOKIE) > 0) {
  echo "Cookies are enabled.";
} else {
  echo "Cookies are disabled.";
}


-->