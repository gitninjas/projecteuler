<?php 

/*
 * A permutation is an ordered arrangement of objects.
* For example, 3124 is one possible permutation of the digits 1, 2, 3 and 4.
*
* If all of the permutations are listed numerically or alphabetically, we call it lexicographic order.
* The lexicographic permutations of 0, 1 and 2 are:  012   021   102   120   201   210
*
* What is the millionth lexicographic permutation of the digits 0, 1, 2, 3, 4, 5, 6, 7, 8 and 9?
*
* ans : 2783915460, time: 34.034949064254761 for PHP native sort, 121.720985889434814 for own function
*/

require_once(dirname(__FILE__) . '/../bootstrap.php');
ini_set('memory_limit', '-1');


function getLexicographicPermutations($digits)
{
    $permutations = permute($digits);
    $lexicographicPermutations = mergeSort($permutations, count($permutations));
    return $lexicographicPermutations;
}

function permute($str)
{
    if (strlen($str) < 2) {
        return array($str);
    }
    $permutations = array();
    $tail = substr($str, 1);
    foreach (permute($tail) as $permutation) {
        $length = strlen($permutation);
        for ($i = 0; $i <= $length; $i++) {
            $permutations[] = substr($permutation, 0, $i) . $str[0] . substr($permutation, $i);
        }
    }
    return $permutations;
}

function mergeSort($array, $count)
{
    if ($count == 1) {
        return $array;
    } elseif ($count == 2) {
        return ($array[0] > $array[1])? array($array[1], $array[0]) : $array;
    } else {
        $middle = intval($count/2);
        $left = array_splice($array, $middle);
        $right = $array;
        $leftSorted = mergeSort($left, count($left));
        $rightSorted = mergeSort($right, count($right));
        return merge($leftSorted, $rightSorted);
    }
}


function merge($left, $right)
{
    $return = array();
    $lc = count($left);
    $rc = count($right);
    for($i = 0, $j = 0; $i != $lc || $j != $rc; ) {
        if (isset($left[$i]) && isset($right[$j])) {
            if ($left[$i] > $right[$j]) {
                $return[] = $right[$j];
                $j++;
            } else {
                $return[] = $left[$i];
                $i++;
            }
        } elseif (isset($left[$i])) {
            $return[] = $left[$i];
            $i++;
        } elseif (isset($right[$j])) {
            $return[] = $right[$j];
            $j++;
        }
    }
    return $return;
}

echo "\nThe millionth lexicographic permutation of the digits 0, 1, 2, 3, 4, 5, 6, 7, 8 and 9:\n";
$start = microtime(true);
$permutations = getLexicographicPermutations("0123456789");
$ans = $permutations[999999]; // millionth permutation
$end = microtime(true);
$time = number_format($end - $start, 15);

echo "\nAns\t: $ans";
echo "\nTime\t: $time\n";
