<?php 

/* You are given the following information, but you may prefer to do some research for yourself.

1. 1 Jan 1900 was a Monday.
2. Thirty days has September,
   April, June and November.
   All the rest have thirty-one,
   Saving February alone,
   Which has twenty-eight, rain or shine.
   And on leap years, twenty-nine.
3. A leap year occurs on any year evenly divisible by 4, but not on a century unless it is divisible by 400.

How many Sundays fell on the first of the month during the twentieth century (1 Jan 1901 to 31 Dec 2000)?   */

require_once(dirname(__FILE__) . '/../bootstrap.php');
ini_set('memory_limit', '-1');

function getNumOfOccurances($day, $date, $startYear, $endYear)
{
    $months     = array(1 => 31, 2 => 28, 3 => 31, 4 => 30, 5 => 31, 6 => 30, 7 => 31, 8 => 31, 9 => 30, 10 => 31, 11 => 30, 12 => 31);
    $occurances = 0;
    $currYear   = 1900;
    $currMonth  = 1;
    $currDay    = 1;            // because we know 1 Jan 1900 was a Monday

    while ($currYear <= $endYear && $currMonth != 12) {
        foreach ($months as $month => $numDays) {
            $currMonth = $month;
            if ($month == 2 && isLeapYear($currYear)) {
                $numDays++;
            }
            for ($date = 1; $date <= $numDays; $date++) {
                if ($currDay == 7 && $date == 1 && $currYear >= $startYear) {
                    $occurances++;
                }
                $currDay = ($currDay == 7)? 1 : ($currDay+1);
            }
        }
        $currMonth = 1;
        $currYear++;
    }
    return $occurances;
}

function isLeapYear($year)
{
    return (($year % 4 == 0 && $year % 100 != 0) || $year % 400 == 0)? true: false;
}

echo "\nNumber of Sundays fell on the first of the month during the twentieth century (1 Jan 1901 to 31 Dec 2000):\t";

$start = microtime(true);
$ans = getNumOfOccurances("sunday", 1, 1901, 2000);
$end = microtime(true);
$time = number_format($end - $start, 15);

echo "\nAns\t: $ans";
echo "\nTime\t: $time\n";
