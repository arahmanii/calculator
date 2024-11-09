<?php

ini_set('display_errors', 0);
ini_set('display_startup_errors', 0);
error_reporting(0);

$input = $_GET['input'] ?? null;


$allowedModes = ['encode', 'decode'];
$mode = $_GET['mode'] ?? 'encode';
$debugMode = $_GET['debug'] ?? false;

if (!in_array($mode, $allowedModes, true)) {
    echo sprintf('حالت انتخابی %s شما مجاز نیست ', $mode);
}


function isBinary($input): bool
{
    $input = str_replace(' ', '', $input);
    return preg_match('/^[01]+$/', $input) === 1;
}

function do_dump(&$var, $var_name = NULL, $indent = NULL, $reference = NULL)
{
    global $debugMode;

    if (!$debugMode) {
        return;
    }
    $do_dump_indent = "<span style='color:#666666;'>|</span> &nbsp;&nbsp; ";
    $reference = $reference . $var_name;
    $keyvar = 'the_do_dump_recursion_protection_scheme';
    $keyname = 'referenced_object_name';

    // So this is always visible and always left justified and readable
    echo "<div style='text-align:left; background-color:white; font: 100% monospace; color:black;'>";

    if (is_array($var) && isset($var[$keyvar])) {
        $real_var = &$var[$keyvar];
        $real_name = &$var[$keyname];
        $type = ucfirst(gettype($real_var));
        echo "$indent$var_name <span style='color:#666666'>$type</span> = <span style='color:#e87800;'>&amp;$real_name</span><br>";
    } else {
        $var = array($keyvar => $var, $keyname => $reference);
        $avar = &$var[$keyvar];

        $type = ucfirst(gettype($avar));
        if ($type == "String") $type_color = "<span style='color:green'>";
        elseif ($type == "Integer") $type_color = "<span style='color:red'>";
        elseif ($type == "Double") {
            $type_color = "<span style='color:#0099c5'>";
            $type = "Float";
        } elseif ($type == "Boolean") $type_color = "<span style='color:#92008d'>";
        elseif ($type == "NULL") $type_color = "<span style='color:black'>";

        if (is_array($avar)) {
            $count = count($avar);
            echo "$indent" . ($var_name ? "$var_name => " : "") . "<span style='color:#666666'>$type ($count)</span><br>$indent(<br>";
            $keys = array_keys($avar);
            foreach ($keys as $name) {
                $value = &$avar[$name];
                do_dump($value, "['$name']", $indent . $do_dump_indent, $reference);
            }
            echo "$indent)<br>";
        } elseif (is_object($avar)) {
            echo "$indent$var_name <span style='color:#666666'>$type</span><br>$indent(<br>";
            foreach ($avar as $name => $value) do_dump($value, "$name", $indent . $do_dump_indent, $reference);
            echo "$indent)<br>";
        } elseif (is_int($avar)) echo "$indent$var_name = <span style='color:#666666'>$type(" . strlen($avar) . ")</span> $type_color" . htmlentities($avar) . "</span><br>";
        elseif (is_string($avar)) echo "$indent$var_name = <span style='color:#666666'>$type(" . strlen($avar) . ")</span> $type_color\"" . htmlentities($avar) . "\"</span><br>";
        elseif (is_float($avar)) echo "$indent$var_name = <span style='color:#666666'>$type(" . strlen($avar) . ")</span> $type_color" . htmlentities($avar) . "</span><br>";
        elseif (is_bool($avar)) echo "$indent$var_name = <span style='color:#666666'>$type(" . strlen($avar) . ")</span> $type_color" . ($avar == 1 ? "TRUE" : "FALSE") . "</span><br>";
        elseif (is_null($avar)) echo "$indent$var_name = <span style='color:#666666'>$type(" . strlen($avar) . ")</span> {$type_color}NULL</span><br>";
        else echo "$indent$var_name = <span style='color:#666666'>$type(" . strlen($avar) . ")</span> " . htmlentities($avar) . "<br>";

        $var = $var[$keyvar];
    }

    echo "</div>";
}

function strigToBinary($string)
{
    $characters = str_split($string);

    $binary = [];
    foreach ($characters as $character) {
        // https://www.rapidtables.com/convert/number/ascii-to-hex.html
        $asciiCode = unpack('H*', $character);
        $toBinary = base_convert($asciiCode[1], 16, 2);
        $binary[] = $toBinary;
        $var = ['ascii' => $asciiCode[1], 'binary' => $toBinary];
        do_dump($var, $character);
    }

    return implode(' ', $binary);
}

function binaryToString($input)
{
    try {
        $binaries = explode(' ', $input);


        $string = null;
        foreach ($binaries as $binary) {
            $string .= pack('H*', dechex(bindec($binary)));
        }

        return $string;
    } catch (Throwable $exception) {
        return null;
    }
}


if ($mode === 'decode') {
    if (isBinary($input)) {
        echo sprintf('Input : %s </br>  Output : %s', $input, binaryToString($input));
    } else {
        echo 'فرمت وارد شده به صورت باینری نمیباشد.';
    }
} else {
    echo sprintf('Input : %s </br> Output : %s', $input, strigToBinary($input));
}


echo '<br>';
echo '<br>';
echo '<br>';
echo '<br>';
echo '<form method="get" action="binary.php">
input : <input type="text" name="input">
mode : <input type="text" name="mode" value="encode">
<button type="submit">convert</button>
</form>';
