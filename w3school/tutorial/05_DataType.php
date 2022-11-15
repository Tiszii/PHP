<?php

$x = 10.365;
var_dump($x);
echo "<br><br><br>";
$cars = array("Volvo", "BMW", "Toyota");
var_dump($cars);

echo "<br><br><br>";

class Car {

    public $color;
    public $model;

    public function __construct($color, $model) {
        $this->color = $color;
        $this->model = $model;
    }

    public function message() {
        return "My car is a " . $this->color . " " . $this->model . "!";
    }

}

$myCar = new Car("black", "Volvo");
echo $myCar->color;
echo "<br>";
$myCar = new Car("red", "Toyota");
echo $myCar->message();

echo "<br><br><br>";

$x = "Hello world!";
$x = null;
var_dump($x);
?>