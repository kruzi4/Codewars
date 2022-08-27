<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;

include "../../../index.php";

$res = digPow(46288, 3);
dd($res);

/**
 * @link https://www.codewars.com/kata/5552101f47fc5178b1000050/train/php
 *
 * @param $n
 * @param $p
 * @return bool
 */
function digPow($n, $p) {
    $digits = str_split((string)$n);
    $total = 0;
    foreach ($digits as $k => $digit) {
        $total += $digit ** ($p + $k);
    }

    $result = $total / $n;
    return is_int($result) ? $result : -1;
}

class PlayDigitTestCases extends TestCase
{
    private function revTest($actual, $expected) {
        $this->assertSame($expected, $actual);
    }
    public function testBasics() {
        $this->revTest(digPow(89, 1), 1);
        $this->revTest(digPow(92, 1), -1);
        $this->revTest(digPow(46288, 3), 51);
    }
}
