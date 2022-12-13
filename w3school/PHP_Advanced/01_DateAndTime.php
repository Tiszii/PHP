<?php
/*
  d - Represents the day of the month (01 to 31)
  m - Represents a month (01 to 12)
  Y - Represents a year (in four digits)
  l (lowercase 'L') - Represents the day of the week
 */
echo "Today is " . date("Y/m/d") . "<br>";
echo "Today is " . date("Y.m.d") . "<br>";
echo "Today is " . date("Y-m-d") . "<br>";
echo "Today is " . date("l");

echo "<br><br><br><br>";
?>

&copy; 2010-<?php echo date("Y"); ?>

<?php
/*
  H - 24-hour format of an hour (00 to 23)
  h - 12-hour format of an hour with leading zeros (01 to 12)
  i - Minutes with leading zeros (00 to 59)
  s - Seconds with leading zeros (00 to 59)
  a - Lowercase Ante meridiem and Post meridiem (am or pm)
 */
echo "<br><br><br><br>";
echo "The time is " . date("h:i:sa");

echo "<br><br><br><br>";
date_default_timezone_set("America/New_York");
echo "The time is " . date("h:i:sa");
date_default_timezone_set("Europe/Rome");

echo "<br><br><br><br>";
$d = mktime(11, 14, 54, 8, 12, 2014);
echo "Created date is " . date("Y-m-d", $d) . "&ensp;" . date("h:i:sa", $d);

echo "<br><br><br>";
$d = strtotime("10:30pm April 15 2014");
echo "Created date is " . date("Y-m-d", $d) . "&nbsp;" . date("h:i:sa", $d);
echo "<br><br><br>";
?>


<?php
$d = strtotime("tomorrow");
echo date("Y-m-d h:i:sa", $d) . "<br>";

$d = strtotime("next Saturday");
echo date("Y-m-d h:i:sa", $d) . "<br>";

$d = strtotime("+3 Months");
echo date("Y-m-d h:i:sa", $d) . "<br>";

echo "<br><br><br>";
$startdate = strtotime("Saturday");
$enddate = strtotime("+6 weeks", $startdate);

while ($startdate < $enddate) {
  echo date("M d", $startdate) . "<br>";
  $startdate = strtotime("+1 week", $startdate);
}

echo "<br><br><br>";
$d1=strtotime("July 04");
$d2=ceil(($d1-time())/60/60/24);
echo "There are " . $d2 ." days until 4th of July.";
?>


