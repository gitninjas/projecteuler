<?php 

// 2^15 = 32768 and the sum of its digits is 3 + 2 + 7 + 6 + 8 = 26.
// What is the sum of the digits of the number 2^1000?

require_once(dirname(__FILE__) . '/../bootstrap.php');
ini_set('memory_limit', '-1');

echo "\nsum of the digits of the number 2^1000:\n";

$start = microtime(true);
$ans = getSumOfDigitsByNumberAndExponent(2, 1000);
$end = microtime(true);
$time = number_format($end - $start, 15);

echo "\nAns\t: $ans";
echo "\nTime\t: $time\n";

function getSumOfDigitsByNumberAndExponent($base, $exp)
{
    return array_sum(str_split(number_format(pow($base, $exp), 0, '.', '')));
}