<?php 

// 2520 is the smallest number that can be divided by each of the numbers from 1 to 10 without any remainder.
// What is the smallest positive number that is evenly divisible by all of the numbers from 1 to 20?

require_once(dirname(__FILE__) . '/../bootstrap.php');
ini_set('memory_limit', '-1');

$start = microtime(true);
$lcm = getLCM(20);
$end = microtime(true);
$time = number_format($end - $start, 15);
echo "\nLCM of 1 to 20\t: $lcm";
echo "\nExecution time\t: $time\n";

function getLCM($range)
{
    $arr = range(1, $range);
    $maxOccurences = array();
    foreach ($arr as $num) {
        $primeFactors = getPrimeFactorCounts($num);
        foreach ($primeFactors as $factor => $occurance) {
            if (isset($maxOccurences[$factor])) {
                $maxOccurences[$factor] = ($maxOccurences[$factor] < $occurance)? $occurance : $maxOccurences[$factor];
            } else {
                $maxOccurences[$factor] = 1;
            }
        }
    }
    return getProduct($maxOccurences);
}

function getPrimeFactorCounts($num)
{
    $factors = array();
    for ($i = 2; $i<=$num; $i++) {
        if ($num % $i == 0 && isPrime($i)) {
            if (isset($factors[$i])) {
                $factors[$i]++;
            } else {
                $factors[$i] = 1;
            }
            $num /= $i;
            $i = 1;
        }
    }
    return $factors;
}

function isPrime($num)
{
    $prime = true;
    for($i=2; $i<$num; $i++) {
        if($num % $i == 0) {
            $prime = false;
            break;
        }
    }
    return $prime;
}

function getProduct($occurences = array())
{
    $product = 1;
    foreach ($occurences as $primeNum => $times) {
        $product *= pow($primeNum, $times);
    }
    return $product;
}