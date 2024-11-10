<?php


/*
 *
 if (condition) {
  // code to be executed if condition is true;
}

 */


if (5 > 3) {
    echo "Have a good day!";
}

echo '<br>';

$t = 14;

if ($t < 20) {
    echo "Have a bad day!";
}


echo '<br>';

if (true) {
    echo 'یک مقدار صحیح است';
}
echo '<br>';


if (!false) {
    echo 'یک مقدار اشتباه است';
}

echo '<br>';

if (true && true) {
    echo 'دو مقدار صحیح است.';
}


$name = 'akbar';
$family = 'rahmanii';

echo '<br>';

if ('akbar' == $name && $family == 'rahmani') {
    echo 'دو مقدار درست است';
}else{
    echo 'دو مقدار درست نیست.';
}