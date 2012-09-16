<?php 

/* http://projecteuler.net/problem=18

By starting at the top of the triangle below and moving to adjacent numbers on the row below, the maximum total from top to bottom is 23.

3
7 4
2 4 6
8 5 9 3

That is, 3 + 7 + 4 + 9 = 23.

Find the maximum total from top to bottom of the triangle below:
75
95 64
17 47 82
18 35 87 10
20 04 82 47 65
19 01 23 75 03 34
88 02 77 73 07 63 67
99 65 04 28 06 16 70 92
41 41 26 56 83 40 80 70 33
41 48 72 33 47 32 37 16 94 29
53 71 44 65 25 43 91 52 97 51 14
70 11 33 28 77 73 17 78 39 68 17 57
91 71 52 38 17 14 91 43 58 50 27 29 48
63 66 04 68 89 53 67 30 73 16 69 87 40 31
04 62 98 27 23 09 70 98 73 93 38 53 60 04 23

NOTE: As there are only 16384 routes, it is possible to solve this problem by trying every route.
However, Problem 67, is the same challenge with a triangle containing one-hundred rows;
it cannot be solved by brute force, and requires a clever 

*/

require_once(dirname(__FILE__) . '/../bootstrap.php');
ini_set('memory_limit', '-1');

echo "\nLetters needed to write all the numbers in words from 1 to 1000:\n";

$start = microtime(true);
$matrix = parseTree();
$maxSum = array();
$ans = getMaxTotal(0, 0);
$end = microtime(true);
$time = number_format($end - $start, 15);

echo "\nAns\t: $ans";
echo "\nTime\t: $time\n";

function getMaxTotal($row, $col)
{
    global $matrix, $maxSum;
    if ($row == (count($matrix)-1)) {
        $maxSum[$row][$col] = $matrix[$row][$col];
        return $maxSum[$row][$col];
    }
    if (!isset($maxSum[$row+1][$col])) {
        $maxSum[$row+1][$col] = getMaxTotal($row+1, $col);
    }
    if (!isset($maxSum[$row+1][$col+1])) {
        $maxSum[$row+1][$col+1] = getMaxTotal($row+1, $col+1);
    }
    return $matrix[$row][$col] + max($maxSum[$row+1][$col], $maxSum[$row+1][$col+1]);
    
}

function parseTree()
{
    $matrix = array();
    $given = "75
95 64
17 47 82
18 35 87 10
20 04 82 47 65
19 01 23 75 03 34
88 02 77 73 07 63 67
99 65 04 28 06 16 70 92
41 41 26 56 83 40 80 70 33
41 48 72 33 47 32 37 16 94 29
53 71 44 65 25 43 91 52 97 51 14
70 11 33 28 77 73 17 78 39 68 17 57
91 71 52 38 17 14 91 43 58 50 27 29 48
63 66 04 68 89 53 67 30 73 16 69 87 40 31
04 62 98 27 23 09 70 98 73 93 38 53 60 04 23";
/*     $given = "3
7 4
2 4 6
8 5 9 3"; */
    $strArr = explode("\n", $given);
    $matrixDegree = count($strArr);
    for($i=0; $i<$matrixDegree; $i++) {
        $row = explode(" ", $strArr[$i]);
        $numOfBlanks = ($matrixDegree - count($row)) / 2;
        $col = 0;
        for ($k=0; $k<count($row); $k++) {
            $matrix[$i][$col++] = (int)$row[$k];
        }
    }
    return $matrix;
}