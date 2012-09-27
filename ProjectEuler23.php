<?php 

/*
 * A perfect number is a number for which the sum of its proper divisors is exactly equal to the number.
* For example, the sum of the proper divisors of 28 would be 1 + 2 + 4 + 7 + 14 = 28, which means that 28 is a perfect number.
*
* A number n is called deficient if the sum of its proper divisors is less than n and it is called abundant if this sum exceeds n.
* As 12 is the smallest abundant number, 1 + 2 + 3 + 4 + 6 = 16, the smallest number that can be written as the sum of two abundant numbers is 24.
*
* By mathematical analysis, it can be shown that all integers greater than 28123 can be written as the sum of two abundant numbers.
* However, this upper limit cannot be reduced any further by analysis even though it is known that the greatest number that cannot be expressed as the sum of two abundant numbers is less than this limit.
*
* Find the sum of all the positive integers which cannot be written as the sum of two abundant numbers.
*
* 4179871
* */

require_once(dirname(__FILE__) . '/../bootstrap.php');
ini_set('memory_limit', '-1');


function getNumbersNotSumOfTwoAbandantNumbers()
{
    $abandantNumbers1 = $abandantNumbers2 = getAbundantNumbers(28123);
    $allNumbers = range(1, 28123);
    foreach ($abandantNumbers1 as $number1) {
        foreach ($abandantNumbers2 as $number2) {
            if ($number1+$number2 <= 28123) {
                unset($allNumbers[$number1+$number2-1]);
            }
        }
    }
    return $allNumbers;
}

function getAbundantNumbers($limit)
{
    $abandantNumbers = array();
    foreach (range(1, $limit) as $number) {
        if (isAbandant($number)) {
            $abandantNumbers[$number] = $number;
        }
    }
    return $abandantNumbers;
}

function isAbandant($number)
{
    $factors = getFactors($number);
    $properFactors = array_diff($factors, array($number));
    $sumProperFactors = array_sum($properFactors);
    return ($sumProperFactors > $number)? true : false;
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

echo "\nThe sum of all the positive integers which cannot be written as the sum of two abundant numbers:\n";

$start = microtime(true);
$ans = array_sum(getNumbersNotSumOfTwoAbandantNumbers());
$end = microtime(true);
$time = number_format($end - $start, 15);

echo "\nAns\t: $ans";
echo "\nTime\t: $time\n";
