<?php
////////////////////////////////////////////////////////////////////
// The prime factors of 13195 are 5, 7, 13 and 29.				  //
// What is the largest prime factor of the number 600851475143 ?  //
////////////////////////////////////////////////////////////////////

$start_time = microtime(true);
function isPrime($n) {
	if ($n % 2 == 0 && $n != 2) {
		return false;
	}
	for ($i = 3; $i * $i <= $n; $i += 2) {
		if ($n % $i == 0 && $n != $i) {
			return false;
		}
	}
	return true;
}

$product = 1;
for ($i = 3; $i <= 600851475143; $i += 2) {
	if (isPrime($i) && (fmod(600851475143, $i) == 0)) {
		$product *= $i;
		if ($product >= 600851475143) {
			break;
		}
	}
}

$end_time = microtime(true);
echo "Solution: {$i} ";
$total_time = $end_time - $start_time;
echo "Total Time: {$total_time}";

///////////////////////////////////////////////////
// Solution: 6857              				     //
// Total Time: 0.00892  (on my machine)			 //
///////////////////////////////////////////////////
