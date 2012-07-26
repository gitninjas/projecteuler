<?php 

// A palindromic number reads the same both ways. The largest palindrome made from the product of two 2-digit numbers is 9009 (91 * 99).
// Find the largest palindrome made from the product of two 3-digit numbers.

require_once(dirname(__FILE__) . '/../bootstrap.php');
ini_set('memory_limit', '-1');

$start = microtime(true);
$largestPalindrome = getLargestPalindrome(3);
$end = microtime(true);
$time = $end - $start;
echo "\nLargest Palindrome made from the product of two 3-digit numbers: $largestPalindrome\n";
echo "Time Taken: $time\n";


function getLargestPalindrome($numDigits)
{
    $maxNum = pow(10,$numDigits) - 1;
    $largestPalindrome = 0;
    for ($i=$maxNum; $i>pow(10,$numDigits-1); $i--) {
        // start with $i so that it will be always greater;
        for ($j=$i; $j>pow(10,$numDigits-1); $j--) {
            $product = $i * $j;
            if ($product < $largestPalindrome) {
                break;
            }
            if(isPalindrome($product) && $largestPalindrome < $product) {
                $largestPalindrome = $product;
            }
        }
    }
    return $largestPalindrome;
}

function isPalindrome($num)
{
    return ($num == strrev($num));
}