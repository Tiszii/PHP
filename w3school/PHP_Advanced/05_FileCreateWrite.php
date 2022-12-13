<?php
    $myfile = fopen("webdictionary.html", "w") or die("Unable to open file!");
$txt = "John Doe\n";
fwrite($myfile, $txt);
$txt = "Jane Doe\n";
fwrite($myfile, $txt);
fclose($myfile);
//fopen()--> function used to open a file and if file does not exit it creates it
//fwrite() --> function used to write into a file
//if you open a file with "w" the date in the file will be erased
//if you open the file with "a" the existing data in that file will be remain there

?>

