<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;

include "../../../index.php";

//$res = tribonacci([1,1,1],10);
//$res = tribonacci([1,1,1],1);
//dd($res);

/**
 * @link https://www.codewars.com/kata/556deca17c58da83c00002db/train/php
 *
 * @param $signature
 * @param $n
 * @return array
 */
function tribonacci($signature, $n): array
{
    if ($n <= 3) {
        return array_slice($signature, 0, $n);
    }

    foreach (range(0, $n - 4) as $i) {
        $signature[] = array_sum(array_slice($signature, $i, 3));
    }

    return $signature;
}


class MyTestCases extends TestCase {

    public function testBasics() {
        $this->assertEquals([1,1,1,3,5,9,17,31,57,105], tribonacci([1,1,1],10));
        $this->assertEquals([0,0,1,1,2,4,7,13,24,44], tribonacci([0,0,1],10));
        $this->assertEquals([0,1,1,2,4,7,13,24,44,81], tribonacci([0,1,1],10));
        $this->assertEquals([1,0,0,1,1,2,4,7,13,24], tribonacci([1,0,0],10));
        $this->assertEquals([0,0,0,0,0,0,0,0,0,0], tribonacci([0,0,0],10));
        $this->assertEquals([1,2,3,6,11,20,37,68,125,230], tribonacci([1,2,3],10));
        $this->assertEquals([3,2,1,6,9,16,31,56,103,190], tribonacci([3,2,1],10));
        $this->assertEquals([1], tribonacci([1,1,1],1));
        $this->assertEquals([], tribonacci([300,200,100],0));
        $this->assertEquals([0.5,0.5,0.5,1.5,2.5,4.5,8.5,15.5,28.5,52.5,96.5,177.5,326.5,600.5,1104.5,2031.5,3736.5,6872.5,12640.5,23249.5,42762.5,78652.5,144664.5,266079.5,489396.5,900140.5,1655616.5,3045153.5,5600910.5,10301680.5], tribonacci([0.5,0.5,0.5],30));
    }

}