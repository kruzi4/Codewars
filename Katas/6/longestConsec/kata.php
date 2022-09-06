<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;

include "../../../index.php";

$res = longestConsec(["zone", "abigail", "theta", "form", "libe", "zas"], 2);
//dd($res);

/**
 * @link https://www.codewars.com/kata/56a5d994ac971f1ac500003e/train/php
 *
 * @param $strarr
 * @param $k
 * @return string
 */
function longestConsec($strarr, $k) {
    $n = count($strarr);
    if ($n === 0 || $k > $n || $k <= 0) {
        return '';
    }

    $summary = [];
    $iterations = $n -  $k;
    for ($i = 0; $i <= $iterations; $i++) {
        $slice = array_slice($strarr, $i, $k);
        $score = strlen(implode('', $slice));
        $summary[$i] = $score;
    }

    $indexMax = array_search(max($summary), $summary, true);
    return implode('', array_slice($strarr, $indexMax, $k));
}

class ConsecutiveTestCases extends TestCase
{
    private function revTest($actual, $expected) {
        $this->assertEquals($expected, $actual);
    }
    public function testBasics() {
        $this->revTest(longestConsec(["zone", "abigail", "theta", "form", "libe", "zas"], 2), "abigailtheta");
        $this->revTest(longestConsec(["ejjjjmmtthh", "zxxuueeg", "aanlljrrrxx", "dqqqaaabbb", "oocccffuucccjjjkkkjyyyeehh"], 1), "oocccffuucccjjjkkkjyyyeehh");
        $this->revTest(longestConsec([], 3), "");
    }
}