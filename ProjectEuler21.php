<?php 

/* 
 * Let d(n) be defined as the sum of proper divisors of n (numbers less than n which divide evenly into n).
 * If d(a) = b and d(b) = a, where a not equal to b, then a and b are an amicable pair and each of a and b are called amicable numbers.
 * For example, the proper divisors of 220 are 1, 2, 4, 5, 10, 11, 20, 22, 44, 55 and 110;
 * therefore d(220) = 284. The proper divisors of 284 are 1, 2, 4, 71 and 142; so d(284) = 220.
 * Evaluate the sum of all the amicable numbers under 10000.
 * */

require_once(dirname(__FILE__) . '/../bootstrap.php');
ini_set('memory_limit', '-1');

function getAmicableNumbersByRange($limit)
{
    $amicableNumbers = array();
    for ($i = 2; $i <= $limit; $i++) {
        if (isset($amicableNumbers[$i])) {
            continue;
        }
        $amicable = getAmicableNumber($i);
        if ($amicable != $i && $i == getAmicableNumber($amicable)) {
            $amicableNumbers[$i] = $amicable;
            $amicableNumbers[$amicable] = $i;
        }
    }
    return $amicableNumbers;
}

function getAmicableNumber($n)
{
    $factors = getFactors($n);
    $proper_divisors = array_diff($factors, array($n));
    $amicableNumber = array_sum($proper_divisors);
    return $amicableNumber;
}

function getFactors($n)
{
    $factors = array();
    for ($i=1; $i*$i <= $n; $i++) {
        if (($n % $i) == 0){
            $factors[] = $i;
            $factors[] = $n/$i;
        }
    }
    return array_unique($factors);
}

echo "\nSum of all the amicable numbers under 10000:\t";

$start = microtime(true);
$ans = array_sum(getAmicableNumbersByRange(10000));
$end = microtime(true);
$time = number_format($end - $start, 15);

echo "\nAns\t: $ans";
echo "\nTime\t: $time\n";
