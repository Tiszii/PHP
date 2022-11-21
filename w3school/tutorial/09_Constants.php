<?php
//costants are global
define("GREETING", "Welcome to W3Schools.com!");        //case sensitive
define("GREETING", "Welcome to W3Schools.com!", true);  //case insensitive
echo greeting;

define("cars", [                                        //costant array
    "Alfa Romeo",
    "BMW",
    "Toyota"
]);
echo cars[0];
?>

