<?php 

// The prime factors of 13195 are 5, 7, 13 and 29. What is the largest prime factor of the number 600851475143 ?

require_once(dirname(__FILE__) . '/../bootstrap.php');
ini_set('memory_limit', '-1');

$given = 600851475143.00;
$maxPrimeFactor = getMaxPrimeFactor($given);
echo "\nMax Prime factor of $given: $maxPrimeFactor\n";


function getMaxPrimeFactor($num)
{
    $factors = array();
    for ($i=2.00; $i<sqrt($num); $i++) {
        if ($num % $i == 0) {
            if (isPrime($i)) {
                $factors[] = $i;
            }
            if (isPrime($num / $i)) {
                $factors[] = $num / $i;
            }
        }
    }
    return max($factors);
}

function isPrime($num)
{
    $prime = true;
    for ($i=2.00; $i<sqrt($num); $i++) {
        if ($num % $i == 0) {
            $prime = false;
            break;
        }
    }
    return $prime;
}