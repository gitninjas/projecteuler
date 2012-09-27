<?php 

/*
 * n! means n (n 1) ... 3 2 1
* For example, 10! = 10 9 ... 3 2 1 = 3628800,
* and the sum of the digits in the number 10! is 3 + 6 + 2 + 8 + 8 + 0 + 0 = 27.
* Find the sum of the digits in the number 100!
*
* */

require_once(dirname(__FILE__) . '/../bootstrap.php');
ini_set('memory_limit', '-1');

function sumOfDigitsByFactorial2($n)
{
    $factorial = number_format(getFactorial($n), 0, '.', '');
    Zend_Debug::dump($factorial);
    return array_sum(str_split($factorial, 1));
}

function getFactorial($n)
{
    return (($n == 1)? 1: round($n * getFactorial($n-1)));
}

function sumOfDigitsByFactorial($n)
{
    // $abc = bcdiv(10, 2); exit;
    $factorial = 1;
    $zeros = 0;
    for ($i = 1; $i <= $n; $i++) {
        // $tmp = $factorial * $i;
        echo "\ntmp: $factorial";
        if ($factorial % 2 == 0 && $i % 5 == 0) {
            echo " * $i will have zeros";
            $factorial = $factorial / 2;
            $zeros++;
        } elseif ($factorial % 5 == 0 && $i % 2 == 0) {
            echo "\t * $i will have zeros";
            $factorial = $factorial/5;
            $zeros++;
        } else {
            $factorial = $factorial * $i;
        }
        // echo "\n$factorial";
    }
    echo "\nZeros: $zeros";
    Zend_Debug::dump($factorial);
    $factorial = number_format($factorial, 0, '.', '');
    Zend_Debug::dump($factorial);
    $sum = array_sum(str_split($factorial, 1));
    Zend_Debug::dump($sum);
}

echo "\nThe sum of the digits in the number 100!:\t";

$start = microtime(true);
$ans = sumOfDigitsByFactorial(100);
$end = microtime(true);
$time = number_format($end - $start, 15);

echo "\nAns\t: $ans";
echo "\nTime\t: $time\n";
