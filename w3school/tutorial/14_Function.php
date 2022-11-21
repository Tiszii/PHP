<?php
function familyName($fname, $year) {
  echo "$fname Refsnes. Born in $year <br>";
}
familyName("Hege", "1975");
familyName("Stale", "1978");
familyName("Kai Jim", "1983");


function addNumbers(int $a, int $b) {
  return $a + $b;
}
echo addNumbers(5, "5 days");   //ritorna 10 senza -->(declare(strict_types=1))


function addNumbersFloat(float $a, float $b) : float {
  return $a + $b;
}
echo addNumbers(1.2, 5.2);
?>