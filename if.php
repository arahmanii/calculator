<?php

// معنی ساده ایف میشه اگر :)

/*
 * در زبان برنامه‌نویسی PHP، کلمه کلیدی if برای اجرای دستورات مشروط به کار می‌رود.
 * به این معنی که اگر شرطی که درون پرانتز بعد از if نوشته شده است درست (true) باشد،
 * کد درون بلوک if اجرا می‌شود. اگر شرط نادرست (false) باشد، کد اجرا نمی‌شود.

 */
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