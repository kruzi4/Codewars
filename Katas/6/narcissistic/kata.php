<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;

include "../../../index.php";

$res = narcissistic(7);
dd($res);

/**
 * @link https://www.codewars.com/kata/5287e858c6b5a9678200083c/train/php
 *
 * @param int $value
 * @return bool
 */
function narcissistic(int $value): bool {
    $digits = str_split((string)$value);
    array_walk($digits, static fn (&$el, $i, $p) => $el = $el ** $p, count($digits));
    return array_sum($digits) === $value;
}

class NarcissisticTest extends TestCase {
    public function testExamples() {
        $this->assertTrue(narcissistic(7), '7 is narcissistic');
        $this->assertTrue(narcissistic(371), '371 is narcissistic');
    }
}
