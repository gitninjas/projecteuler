<?php 

/* 
 * Using names_problem21.txt (right click and 'Save Link/Target As...'), a 46K text file containing over five-thousand first names, begin by sorting it into alphabetical order.
 * Then working out the alphabetical value for each name, multiply this value by its alphabetical position in the list to obtain a name score.
 * 
 * For example, when the list is sorted into alphabetical order, COLIN, which is worth 3 + 15 + 12 + 9 + 14 = 53, is the 938th name in the list.
 * So, COLIN would obtain a score of 938  53 = 49714.
 * What is the total of all the name scores in the file?
 * 
 * */

require_once(dirname(__FILE__) . '/../bootstrap.php');
ini_set('memory_limit', '-1');


function parseFile($file)
{
    $fileContents = file_get_contents(dirname(__FILE__)."/docs/".$file);
    $fileContents = str_replace('"', '', $fileContents);
    return explode(',', $fileContents);
}

function getRankScores($words)
{
    $sortedWords = quickSort($words);
    foreach ($sortedWords as $key => $value) {
        $nameScores[$value] = ($key+1) * getNameScore($value);
    }
    return $nameScores;
}

function quickSort($inputWords)
{
    $count = count($inputWords);
    if ($count == 1 || $count == 0) {
        return $inputWords;
    } elseif ($count == 2) {
        return $inputWords[0] > $inputWords[1] ? array($inputWords[1], $inputWords[0]) : $inputWords;
    }
    $middle = ($count % 2 == 0)? ($count/2): ($count-1)/2;
    $pivot = $inputWords[$middle];
    unset($inputWords[$middle]);
    $left = array();
    $right = array();
    foreach ($inputWords as $key => $word) {
        if ($word >= $pivot) {
            $right[] = $word;
        } elseif ($word < $pivot) {
            $left[] = $word;
        }
    }
    return array_merge(quickSort($left), array($pivot), quickSort($right));
}

function getNameScore($word)
{
    global $charWeights;
    $nameScore = 0;
    $charArray = str_split($word, 1);
    foreach ($charArray as $chr) {
        $nameScore += $charWeights[$chr];
    }
    return $nameScore;
}

echo "\nThe total of all the name scores in the given file:\t";

$start = microtime(true);
$charWeights = array_combine(range("A", "Z"), range(1, 26));
$words = parseFile("problem21.txt");
$ans = array_sum(getRankScores($words));
$end = microtime(true);
$time = number_format($end - $start, 15);

echo "\nAns\t: $ans";
echo "\nTime\t: $time\n";
