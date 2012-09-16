<?php 

// Starting in the top left corner of a 22 grid, there are 6 routes (without backtracking) to the bottom right corner.

// How many routes are there through a 2020 grid?


require_once(dirname(__FILE__) . '/../bootstrap.php');
ini_set('memory_limit', '-1');

function getNumOfRoutes()
{
    global $matrix, $count;
    // $matrix = getMatrix(20, 20);
    for ($i=0; $i < count($matrix); $i++) {
        for ($j=0; $j<count($matrix[$i]); $j++) {
            $count += getCount($i, $j);
        }
    }
    $count = getCount(0,0);
    $adjPoints = getAdjucentPoints($matrix);
    Zend_Debug::dump($matrix); exit;
    // $adjacentPoints = getAdjucentPoints($matrix, 0,0);
    // Zend_Debug::dump($adjacentPoints); exit;
    $count = 0;
    // $maxNum = 0;
    for ($i=0; $i<=$rows; $i++) {
        for ($i=0; $i<=$rows; $i++) {
            if (existsPath($i, $j, $matrix)) {
                $count++;
            }
        }
    }
    return $maxNum;
}

function getMatrix($rows, $cols)
{
    global $matrix;
    $ctr = 1;
    for ($i=0; $i<=$rows; $i++) {
        for ($j=0; $j<=$cols; $j++) {
            $matrix[$i][$j] = $ctr++;
        }
    }
    return $matrix;
}

function getCount($row, $col)
{
    global $matrix, $count;
    if ($row == 20 && $col == 20) {
        $count++;
        return 1;
    } else {
        for ($i=0; $i<=$row; $i++) {
            for ($j=0; $i<=$col; $j++) {

                $adjPoints = getAdjucentPoints($i, $i);
            }
        }
    }
    
    
    foreach ($adjPoints as $key => $point) {
        ;
    }
    if (condition) {
        ;
    }
}

function getAdjucentPoints($i, $j)
{
    global $matrix;
    $adjPoints = array();
    
    // left
    if (isset($matrix[$i][$j-1])) {
        $adjPoints[] = array('row' => $i, 'col' => $j-1);
    }
    // right
    if (isset($matrix[$i][$j+1])) {
        $adjPoints[] = array('row' => $i, 'col' => $j+1);
    }
    // top
    if (isset($matrix[$i-1][$j])) {
        $adjPoints[] = array('row' => $i-1, 'col' => $j);
    }
    // bottom
    if (isset($matrix[$i+1][$j])) {
        $adjPoints[] = array('row' => $i+1, 'col' => $j);
    }
    return $adjPoints;
}


echo "\nThe starting number, under one million, which produces the longest chain:\n";

$matrix = array();
$count = 0;
$matrix = getMatrix(2, 2);
$start = microtime(true);
$ans = getNumOfRoutes();
$end = microtime(true);
$time = number_format($end - $start, 15);

echo "\nAns\t: $ans";
echo "\nTime\t: $time\n";
