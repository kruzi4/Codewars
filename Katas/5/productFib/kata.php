<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;

include "../../../index.php";

//$res = productFib(4895);
//dd($res);

/**
 * @link https://www.codewars.com/kata/5541f58a944b85ce6d00006a/train/php
 *
 * @param $prod
 * @return array
 */
function productFib($prod) {
    $i = 0;
    for ($myProd = 0; $myProd < $prod; $i++) {
        $f1 = fibonachi($i);
        $f2 = fibonachi($i + 1);
        $myProd = $f1 * $f2;
    }

    return [$f1, $f2, $myProd === $prod];
}

function fibonachi($n): int
{
    if ($n <= 2) {
        return 1;
    }

    return fibonachi($n - 1) + fibonachi($n - 2);
}

class FibProductTestCases extends TestCase
{
    function _productFibHP($prod) {
        $a = 0; $b = 1;
        while ($a * $b < $prod) {
            $next = $a + $b;
            $a = $b;
            $b = $next;
        }
        return [$a, $b, $a * $b == $prod];
    }

    private function revTest($actual, $expected) {
        $this->assertEquals($expected, $actual);
    }
    public function testBasics() {
        $this->revTest(productFib(4895), [55, 89, true]);
        $this->revTest(productFib(5895), [89, 144, false]);
        $this->revTest(productFib(74049690), [6765, 10946, true]);
        $this->revTest(productFib(84049690), [10946, 17711, false]);
        $this->revTest(productFib(193864606), [10946, 17711, true]);
        $this->revTest(productFib(447577), [610, 987, false]);
        $this->revTest(productFib(602070), [610, 987, true]);
    }

    public function testRandom() {
        $someFibs = [55,89,144,233,377,610,987,1597,2584,4181,6765,
            10946,17711,28657,46368,75025,121393,196418,317811,514229,
            832040,1346269,2178309,3524578,5702887,9227465,14930352,
            24157817,39088169,63245986];

        for($i = 0; $i < 20; $i++) {
            $n = rand(0, 28);
            $f0 = $someFibs[$n];
            $f1 = $someFibs[$n+1];
            $p = $f0*$f1 + rand(0, 1);
            $sol = $this->_productFibHP($p);
            //print_r($sol);
            $ans = productFib($p);
            $this->revTest($ans, $sol);
        }
    }
}