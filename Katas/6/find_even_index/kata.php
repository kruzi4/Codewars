<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;

include "../../../index.php";

$res = find_even_index([20,10,-80,10,10,15,35]);
//dd($res);

/**
 * @link https://www.codewars.com/kata/5679aa472b8f57fb8c000047/train/php
 *
 * @param $arr
 * @return string
 */
function find_even_index($arr) {
    $c = count($arr);
    for ($i = 0; $i < $c; $i++) {
        if (array_sum(array_slice($arr, 0, $i)) === array_sum(array_slice($arr, $i + 1, $c - 1))) {
            return $i;
        }
    }

    return -1;
}

class FindEvenIndexTest extends TestCase
{
    public function testIt() {
        $this->assertSame(3,find_even_index([1,2,3,4,3,2,1]));
        $this->assertSame(1,find_even_index([1,100,50,-51,1,1]));
        $this->assertSame(-1,find_even_index([1,2,3,4,5,6]));
        $this->assertSame(3,find_even_index([20,10,30,10,10,15,35]));
        $this->assertSame(0,find_even_index([20,10,-80,10,10,15,35]));
        $this->assertSame(6,find_even_index([10,-80,10,10,15,35,20]));
        $this->assertSame(-1,find_even_index(range(1,100)));
        $this->assertSame(0,find_even_index([0,0,0,0,0]),"Should pick the first index if more cases are valid");
        $this->assertSame(3,find_even_index([-1,-2,-3,-4,-3,-2,-1]));
        $this->assertSame(-1,find_even_index(range(-100,-1)));

    }
}

