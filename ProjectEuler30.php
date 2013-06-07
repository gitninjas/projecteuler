<?php

/*
 * Surprisingly there are only three numbers that can be written as the sum of fourth powers of their digits:
 *
 * 1634 = 14 + 64 + 34 + 44
 * 8208 = 84 + 24 + 04 + 84
 * 9474 = 94 + 44 + 74 + 44
 *
 * As 1 = 14 is not a sum it is not included.
 *
 * The sum of these numbers is 1634 + 8208 + 9474 = 19316.
 *
 * Find the sum of all the numbers that can be written as the sum of fifth powers of their digits.
 */

require_once(dirname(__FILE__) . '/../bootstrap.php');
ini_set('memory_limit', '-1');

function getPowerSumNumbers($power)
{
  $n = 2;
	$powerSums = array();

	// since max sum of digits possible is far less than actual number higher than 1 million, we count until that only
	echo "\nNumbers\t: ";
	while ($n <= 1000000) {
		$digits = str_split($n);
		$sum = 0;
		foreach ($digits as $digit) {
			$sum += pow($digit, $power);
		}
		if ($sum == $n) {
			$powerSums[] = $n;
			echo "$n\t";
		}
		$n++;
	}
	return $powerSums;
}

echo "\nSum of all the numbers that can be written as the sum of fifth powers of their digits:\n";
$start = microtime(true);
$ans = array_sum(getPowerSumNumbers(5));
$end = microtime(true);
$time = number_format($end - $start, 15);

echo "\nAns\t: $ans";
echo "\nTime\t: $time\n";
