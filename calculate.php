<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $num1 = isset($_POST['num1']) ? (float)$_POST['num1'] : 0;
    $num2 = isset($_POST['num2']) ? (float)$_POST['num2'] : 0;
    $operation = $_POST['operation'];
    $result = "Invalid Operation";

    switch ($operation) {
        case '+':
            $result = $num1 + $num2;
            break;
        case '-':
            $result = $num1 - $num2;
            break;
        case '*':
            $result = $num1 * $num2;
            break;
        case '/':
            $result = $num2 !== 0 ? $num1 / $num2 : "Cannot divide by zero";
            break;
    }

    echo $result;
} else {
    echo "No calculation performed.";
}
?>