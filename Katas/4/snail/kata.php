<?php
declare(strict_types=1);

use PHPUnit\Framework\TestCase;

include "../../../index.php";

/**
 * @link https://www.codewars.com/kata/521c2db8ddc89b9b7a0000c1/train/php
 *
 * @param array $m
 * @return array
 */
function snail(array $m): array
{
    $result = [];
    if (empty(reset($m))) {
        return $result;
    }

    $max = count($m) - 1;

    $iterations = (int)round($max / 2);

    foreach (range(0, $iterations) as $iteration) {
        $min = $iteration;

        foreach (range($min, $max) as $i) {
            $result[$min . ' ' . $i] = $m[$min][$i];
        }

        foreach (range($min, $max) as $i) {
            $result[$i . ' ' . $max] = $m[$i][$max];
        }

        foreach (range($max, $min) as $i) {
            $result[$max . ' ' . $i] = $m[$max][$i];
        }

        foreach (range($max, $min) as $i) {
            $result[$i . ' ' . $min] = $m[$i][$min];
        }

        $max--;
    }

    return array_values($result);
}

$result = snail([
    [1, 2, 3, 1, 3, 2, 1, 7, 8, 9, 7, 6],
    [4, 5, 6, 4, 5, 3, 4, 7, 8, 9, 7, 6],
    [7, 8, 9, 7, 6, 5, 6, 2, 4, 5, 2, 9],
    [7, 8, 9, 7, 1, 7, 8, 7, 8, 9, 7, 1],
    [2, 4, 5, 2, 9, 9, 1, 7, 8, 9, 7, 6],
    [7, 8, 9, 7, 6, 2, 3, 4, 5, 6, 4, 5],
    [7, 8, 9, 7, 1, 7, 8, 7, 8, 9, 7, 1],
    [7, 8, 9, 7, 6, 4, 5, 1, 2, 3, 1, 3],
    [1, 2, 3, 1, 3, 2, 1, 7, 8, 9, 7, 6],
    [4, 5, 6, 4, 5, 3, 4, 7, 8, 9, 7, 6],
    [7, 8, 9, 7, 6, 5, 6, 2, 4, 5, 2, 9],
    [2, 4, 5, 2, 9, 9, 1, 7, 8, 9, 7, 6],
]);

dd($result);

class SnailTest extends TestCase {
    public function testDescriptionExamples() {
        $this->assertEquals([1, 2, 3, 6, 9, 8, 7, 4, 5], snail([
            [1, 2, 3],
            [4, 5, 6],
            [7, 8, 9]
        ]));
        $this->assertEquals([1, 2, 3, 4, 5, 6, 7, 8, 9], snail([
            [1, 2, 3],
            [8, 9, 4],
            [7, 6, 5]
        ]));
        $this->assertEquals([1, 2, 3, 1, 4, 7, 7, 9, 8, 7, 7, 4, 5, 6, 9, 8], snail([
            [1, 2, 3, 1],
            [4, 5, 6, 4],
            [7, 8, 9, 7],
            [7, 8, 9, 7]
        ]));
        $this->assertEquals([], snail([[]]), 'Your solution should also work properly for an empty matrix');
    }
}

