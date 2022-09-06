<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;

include "../../../index.php";

//$res = bouncingBall(9999999999999999999999999999999999999999.0, 0.9999996, 1.5);
//dd($res);

/**
 * @link https://www.codewars.com/kata/5544c7a5cb454edb3c000047/train/php
 *
 * @param $h
 * @param $bounce
 * @param $window
 * @return int
 */
function bouncingBall($h, $bounce, $window): int
{
    if ($window >= $h) {
        return -1;
    }

    $count = 0;

    if ($bounce > 0 && $bounce < 1) {
        while ($h > $window) {
            $h *= $bounce;
            $count += 2;
        }
    }
    return --$count;
}

class BouncingBallCases extends TestCase
{
    private function revTest($actual, $expected) {
        $this->assertEquals($expected, $actual);
    }
    public function testBasics() {
        $this->revTest(bouncingBall(3.0, 0.66, 1.5) , 3);
        $this->revTest(bouncingBall(30.0, 0.66, 1.5), 15);
        $this->revTest(bouncingBall(10, 0.6, 10), -1);
    }
}