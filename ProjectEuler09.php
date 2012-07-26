<?php 

// A Pythagorean triplet is a set of three natural numbers, a  b  c, for which, a^2 + b^2 = c^2
// For example, 3^2 + 4^2 = 9 + 16 = 25 = 5^2.
// There exists exactly one Pythagorean triplet for which a + b + c = 1000. Find the product abc.

require_once(dirname(__FILE__) . '/../bootstrap.php');
ini_set('memory_limit', '-1');

$start = microtime(true);
$ans = getPythagoreanTriplet(1000);
$end = microtime(true);
$time = number_format($end - $start, 15);

echo "\nPythagorean Triplet for 1000\t: $ans[0], $ans[1], $ans[2]";
$product = array_product($ans);
echo "\nPithagorean Triplet Product\t: $product";
echo "\nExecution time\t: $time\n";


function getPythagoreanTriplet($num)
{
    $found = false;
    $a = 1;
    $b = 1;
    for($i=1; !$found && $i<($num-2); $i++) {
        for ($j=1; !$found && $j<($num-2); $j++) {
            if (2*($num - $i)*($num - $j) == $num*$num) {
                $a = $i;
                $b = $j;
                $found = true;
            }
        }
    }
    return array($a, $b, $num - $a - $b);
}