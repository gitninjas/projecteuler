<?php 

// The following iterative sequence is defined for the set of positive integers:
// n  n/2 (n is even)
// n  3n + 1 (n is odd)

// Using the rule above and starting with 13, we generate the following sequence:
// 13  40  20  10  5  16  8  4  2  1
// It can be seen that this sequence (starting at 13 and finishing at 1) contains 10 terms.
// Although it has not been proved yet (Collatz Problem), it is thought that all starting numbers finish at 1.

// Which starting number, under one million, produces the longest chain?

// NOTE: Once the chain starts the terms are allowed to go above one million.


require_once(dirname(__FILE__) . '/../bootstrap.php');
ini_set('memory_limit', '-1');

echo "\nThe starting number, under one million, which produces the longest chain:\n";

$chainCount = array();
$start = microtime(true);
$ans = getStartingNumber(1000000);
$end = microtime(true);
$time = number_format($end - $start, 15);

echo "\nAns\t: $ans";
echo "\nTime\t: $time\n";

// ans: 837799
// best_time_yet = 1.980355978012085

function getStartingNumber($max)
{
    $maxCount = 0;
    $maxNum = 0;
    for ($i=1; $i<$max; $i+=2) {
        $count = getSequenceCount($i);
        
        if ($maxCount < $count) {
            $maxNum = $i;
            $maxCount = $count;
        }
    }
    return $maxNum;
}

function getSequenceCount(&$start)
{
    global $chainCount;
    $end = $start;
    $count = 1;
    while ($end!=1) {
        $next = ($end % 2 == 0) ? ($end / 2) : (3*$end + 1);
        if (isset($chainCount[$next])) {
            $count = $count + $chainCount[$next];
            break;
        } else {
            $count++;
        }
        $end = $next;
    }
    $chainCount[$start] = $count;
    return $count;
}