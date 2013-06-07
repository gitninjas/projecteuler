<?php

/*
 * Starting with the number 1 and moving to the right in a clockwise direction a 5 by 5 spiral is formed as follows:

21 22 23 24 25
20  7  8  9 10
19  6  1  2 11
18  5  4  3 12
17 16 15 14 13

* It can be verified that the sum of the numbers on the diagonals is 101.
* What is the sum of the numbers on the diagonals in a 1001 by 1001 spiral formed in the same way?
*
* ans  :
* time :  seconds
*
*/

require_once(dirname(__FILE__) . '/../bootstrap.php');
ini_set('memory_limit', '-1');

function getSpiralMertix($n)
{
    $matrix = array();
    $rowIdx = 0;
    $colIdx = $n-1;
    $maxRowCol = $n-1;
    $value = $n*$n;
    $direction = 'left';
    $diagSum = 0;

    while ($value != 0) {
      $matrix[$rowIdx][$colIdx] = $value;
    	if ($rowIdx == $colIdx || $rowIdx + $colIdx == $maxRowCol) {
    		$diagSum += $value;
    	}
    	list($rowIdxNext, $colIdxNext) = getCoords($rowIdx, $colIdx, $direction);
    	if (isset($matrix[$rowIdxNext][$colIdxNext]) || $rowIdxNext < 0 || $rowIdxNext > $maxRowCol || $colIdxNext < 0 || $colIdxNext > $maxRowCol) {
    		$direction = getNewDirection($direction);
    		list($rowIdxNext, $colIdxNext) = getCoords($rowIdx, $colIdx, $direction);
    	}
    	$rowIdx = $rowIdxNext;
    	$colIdx = $colIdxNext;
    	$value--;
    }
    return $diagSum;
}

function getCoords($r, $c, $type)
{
	if ($type == 'left') {
		$c--;
	} elseif ($type == 'right') {
		$c++;
	} elseif ($type == 'up') {
		$r--;
	} elseif ($type == 'down') {
		$r++;
	}
	return array($r, $c);
}

function getNewDirection($direction)
{
	$nextDir = array(
			'left'  => 'down',
			'down'  => 'right',
			'right' => 'up',
			'up' 	=> 'left');
	return $nextDir[$direction];
}

echo "\nSum of Numbers in Diagonal:\n";
$start = microtime(true);
$ans = getSpiralMertix(1001);
$end = microtime(true);
$time = number_format($end - $start, 15);

echo "\nAns\t: $ans";
echo "\nTime\t: $time\n";
