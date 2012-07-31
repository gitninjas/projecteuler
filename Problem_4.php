<?php
////////////////////////////////////////////////////////////////////
// A palindromic number reads the same both ways.                 //
// The largest palindrome made from the product of two 2-digit    //
// numbers is 9009 = 91*99.                                       //
// Find the largest palindrome made from the product of           //
// two 3-digit numbers. 										  //
////////////////////////////////////////////////////////////////////

$start_time = microtime();

function isPlaindrome($n) {
	$f = strlen($n) - 1;
	if (strlen($n) % 2 == 0) {
		for ($i = 0; $i < strlen($n) / 2; $i++) {
			if ($n[$i] == $n[$f - $i]) {
			} else {
				return 0;
			}
		}
		return 1;
	} else {
		return 0;
	}
}

$max = 100000;

for ($i = 100; $i <= 999; $i++) {
	for ($j = $i; $j <= 999; $j++) {
		$num = $i * $j;
		if (isPlaindrome(strval($num)) && $num > $max) {
			$max = $num;
		}
	}
}

$end_time = microtime();
echo "Solution: {$max} \n";
$total_time = $end_time - $start_time;
echo "Total Time: {$total_time}";

///////////////////////////////////////////////////
// Solution: 906609              	      	     //
// Total Time: 0.617299  (on my machine)		 //
///////////////////////////////////////////////////
