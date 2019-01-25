<?php

$array = [];
$array[1] = "Greeting";
$array[2] = "Fairwell";

// print_r($array);

$nowJSON = json_encode($array);
echo $nowJSON;

echo "\n";