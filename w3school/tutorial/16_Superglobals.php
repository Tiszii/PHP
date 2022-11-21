<?php
$x = 75;
$y = 25;
function addition() {
  $GLOBALS['z'] = $GLOBALS['x'] + $GLOBALS['y'];
}
addition();
echo $z;


//$_SERVER is a PHP super global variable which holds information about headers, paths, and script locations.
echo $_SERVER['PHP_SELF'];
echo "<br>";
echo $_SERVER['SERVER_NAME'];
echo "<br>";
echo $_SERVER['HTTP_HOST'];
echo "<br>";
echo $_SERVER['HTTP_REFERER'];
echo "<br>";
echo $_SERVER['HTTP_USER_AGENT'];
echo "<br>";
echo $_SERVER['SCRIPT_NAME'];
?>




<!DOCTYPE html>

<html>
<body>

<form method="post" action="<?php echo $_SERVER['PHP_SELF'];?>">
  Name: <input type="text" name="fname">
  <input type="submit">
</form>

<?php
//PHP $_REQUEST is a PHP super global variable which is used to collect data after submitting an HTML form.
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // collect value of input field
    $name = htmlspecialchars($_REQUEST['fname']);
    //$name = $_POST['fname'];
    echo $name;
}
//HP $_GET is a PHP super global variable which is used to collect form data after submitting an HTML form with method="get".
//echo "Study " . $_GET['subject'] . " at " . $_GET['web'];
?>

</body>
</html>




