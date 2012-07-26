<?php 


// If we list all the natural numbers below 10 that are multiples of 3 or 5, we get 3, 5, 6 and 9. The sum of these multiples is 23.
// Find the sum of all the multiples of 3 or 5 below 1000.

require_once(dirname(__FILE__) . '/../bootstrap.php');
ini_set('memory_limit', '-1');

$sum = 0;
for ($i=1; $i < 1000; $i++) {
    if($i % 5 == 0 && $i % 3 == 0) {
        $sum += $i;
    } elseif ($i % 3 == 0) {
        $sum += $i;
    } elseif ($i % 5 == 0) {
        $sum += $i;
    }
}

echo "\nsum: $sum\n";