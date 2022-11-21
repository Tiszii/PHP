<?php
$cars = array("Volvo", "BMW", "Toyota");
echo "I like " . $cars[0] . ", " . $cars[1] . " and " . $cars[2] . ".";

echo count($cars);

for($x = 0; $x < count($cars); $x++) {
  echo $cars[$x];
  echo "<br>";
}

//associated arrays
$age = array("Peter"=>"35", "Ben"=>"37", "Joe"=>"43");
foreach($age as $x => $x_value) {
  echo "Key=" . $x . ", Value=" . $x_value;
  echo "<br>";
}

//multidimensional array
$cars = array (
  array("Volvo",22,18),
  array("BMW",15,13),
  array("Saab",5,2),
  array("Land Rover",17,15)
);
echo $cars[0][0].": In stock: ".$cars[0][1].", sold: ".$cars[0][2].".<br>";
echo $cars[1][0].": In stock: ".$cars[1][1].", sold: ".$cars[1][2].".<br>";
echo $cars[2][0].": In stock: ".$cars[2][1].", sold: ".$cars[2][2].".<br>";
echo $cars[3][0].": In stock: ".$cars[3][1].", sold: ".$cars[3][2].".<br>";


//sort
$cars = array("Volvo", "BMW", "Toyota");
sort($cars);        //ordine crescente
rsort($cars);       //ordine decrescente
for($x = 0; $x < count($cars); $x++) {
  echo $cars[$x];
  echo "<br>";
}

//associatives arrays --> ksort() ascendent sorted by key , asort() ascendent sorted by value
//krsort() sorted discendent by key , arsort() sorted discendent by value
?>
