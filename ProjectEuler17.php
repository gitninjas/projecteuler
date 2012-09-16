<?php 

// If the numbers 1 to 5 are written out in words: one, two, three, four, five, then there are 3 + 3 + 5 + 4 + 4 = 19 letters used in total.
// If all the numbers from 1 to 1000 (one thousand) inclusive were written out in words, how many letters would be used?

// NOTE: Do not count spaces or hyphens.
// For example, 342 (three hundred and forty-two) contains 23 letters and 115 (one hundred and fifteen) contains 20 letters.
// The use of "and" when writing out numbers is in compliance with British usage.

require_once(dirname(__FILE__) . '/../bootstrap.php');
ini_set('memory_limit', '-1');

echo "\nLetters needed to write all the numbers in words from 1 to 1000:\n";

$start = microtime(true);

$singles   = array(   1 => 3,  2 => 3,  3 => 5,  4 => 4,  5 => 4,  6 => 3,  7 => 5,  8 => 5,  9 => 4);
$tens      = array(  10 => 3, 20 => 6, 30 => 6, 40 => 5, 50 => 5, 60 => 5, 70 => 7, 80 => 6, 90 => 6);
$elevens   = array(  11 => 6, 12 => 6, 13 => 8, 14 => 8, 15 => 7, 16 => 7, 17 => 9, 18 => 8, 19 => 8);
$hundreds  = array( 100 => 7);
$thousands = array(1000 => 8);
$and       = 3;

// getLettersByNumber(634);
$ans = getNumLettersToWrite(1000);

$end = microtime(true);
$time = number_format($end - $start, 15);

echo "\nAns\t: $ans";
echo "\nTime\t: $time\n";

function getNumLettersToWrite($limit)
{
    $sum = 0;
    for ($i = 1000; $i > 0; $i--) {
        $sum += getLettersByNumber($i);
    }
    return $sum;
}

function getLettersByNumber($number)
{
    global $singles, $tens, $elevens, $hundreds, $thousands, $and;
    $sum = 0;
    if ($number >= 1000) {
        $thousandthDigit = (int)($number / 1000);
        $remainder       = $number - $thousandthDigit*1000;
        $sum             = $sum + $singles[$thousandthDigit] + $thousands[$thousandthDigit*1000] + getLettersByNumber($remainder);
    } elseif ($number >= 100) {
        $hundredthDigit  = (int)($number / 100);
        $remainder       = $number - $hundredthDigit*100;
        $sum             = $sum + $singles[$hundredthDigit] + $hundreds[100] + (!empty($remainder)? ($and + getLettersByNumber($remainder)) : 0);
    } elseif ($number >= 20) {
        $tenthDigit      = (int)($number / 10);
        $remainder       = $number - $tenthDigit*10;
        $sum             = $sum + $tens[$tenthDigit*10] + (!empty($remainder)? (getLettersByNumber($remainder)) : 0);
    } elseif ($number > 10) {
        $sum             = $sum + $elevens[$number];
    } elseif ($number == 10) {
        $sum =           $sum + $tens[$number];
    } elseif ($number > 0) {
        $sum             = $sum + $singles[$number];
    }
    return $sum;
}