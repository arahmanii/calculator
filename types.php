<?php


$name = "akbar"; // رشته

$family = 'رحمانی'; // رشته

$age = 30; // عدد صحیح

$accountBalance = 2000.500; // اعشاری

$debt = -40000; // عدد صحیح

$myInformation = [
    'akbar', 'رحمانی', 30, 2000.500, -40000
]; // آرایه


$myInformationWhitKey = [
    'name' => 'akbar', 'family' => 'رحمانی', 'age' => 30, 'balance' => 2000.500, 'debt' => -40000
]; // آرایه به همراه کلید


// نمایش ها
var_dump($name);
var_dump($family);
var_dump($age);
var_dump($accountBalance);
var_dump($debt);
var_dump($myInformation);
var_dump($myInformationWhitKey);

// چاپ کردن
echo "<br>";
echo "php types";
echo "<br>";
echo 'end';

