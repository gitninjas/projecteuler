<?php 

// The sum of the squares of the first ten natural numbers is, 1^2 + 2^2 + ... + 10^2 = 385
// The square of the sum of the first ten natural numbers is, (1 + 2 + ... + 10)^2 = 552 = 3025
// Hence the difference between the sum of the squares of the first ten natural numbers and the square of the sum is 3025  385 = 2640.
// Find the difference between the sum of the squares of the first one hundred natural numbers and the square of the sum.

require_once(dirname(__FILE__) . '/../bootstrap.php');
ini_set('memory_limit', '-1');

echo "\nDiffenrence of square of sum and sum of squares of 1 to 100\n";
$start = microtime(true);
$diff_brute = getDifferenceByBruteforce(100);
$end = microtime(true);
$time = number_format($end - $start, 15);
echo "\nBruteforce Ans\t: $diff_brute";
echo "\nBruteforce time\t: $time\n";

$start = microtime(true);
$diff_formula = getDifferenceByFormula(100);
$end = microtime(true);
$time = number_format($end - $start, 15);
echo "\nBy Formula Ans\t: $diff_formula";
echo "\nBy Formula time\t: $time\n";

function getDifferenceByBruteforce($range)
{
    $sumOfSquares = array_sum(array_map("square", range(1, $range)));
    $squareOfSums = square(array_sum(range(1, $range)));
    return ($squareOfSums - $sumOfSquares);
}

function square($num)
{
    return ($num * $num);
}

function getDifferenceByFormula($range)
{
    $sum = (1/2)*$range*($range + 1);
    $sum_square = (1/6)*$range*($range+1)*(2*$range + 1);
    return (pow($sum,2) - $sum_square);
}