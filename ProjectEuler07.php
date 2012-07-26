<?php 

// By listing the first six prime numbers: 2, 3, 5, 7, 11, and 13, we can see that the 6th prime is 13.
// What is the 10001st prime number?

require_once(dirname(__FILE__) . '/../bootstrap.php');
ini_set('memory_limit', '-1');

$start = microtime(true);
$ans = getPrimeByPosition(10001);
$end = microtime(true);
$time = number_format($end - $start, 15);
echo "\n10001st Prime\t: $ans";
echo "\nExecution time\t: $time\n";


function getPrimeByPosition($position)
{
    $prime = 2;
    $count = 0;
    for($i = 2; $count < $position; $i++) {
        if (isPrime($i)) {
            $count++;
            $prime = $i;
        }
    }
    return $prime;
}

function isPrime($num)
{
    $prime = true;
    for ($i=2; $i<=sqrt($num); $i++) {
        if ($num % $i == 0) {
            $prime = false;
            break;
        }
    }
    return $prime;
}