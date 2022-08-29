<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;

include "../../../index.php";

/**
 * @link https://www.codewars.com/kata/58062572a4647eb3f50002e5/train/php
 */
function getLargestProduct($grid): int
{
    $max = 0;

    foreach ($grid as $row) {
        getMaxRowProduct($row, $max);
    }
    foreach (getDiagonals($grid) as $row) {
        getMaxRowProduct($row, $max);
    }

    $grid = gridRotate($grid);
    foreach ($grid as $row) {
        getMaxRowProduct($row, $max);
    }
    foreach (getDiagonals($grid) as $row) {
        getMaxRowProduct($row, $max);
    }

    return $max;
}

function getDiagonals($grid): array
{
    $startCoordinates = getStartCoordinates($grid);

    $newGrid = [];
    foreach ($startCoordinates as $startCoordinate) {
        $arr = explode(' ', $startCoordinate);
        $arr = array_map('intval', $arr);
        $maxVal = max($arr);
        $minVal = min($arr);
        $row = [];
        foreach (range($minVal, $maxVal) as $num) {
            $x = $maxVal--;
            $y = $minVal++;
            $row[] = $grid[$x][$y];
        }
        $newGrid[] = $row;
    }
    return $newGrid;
}

function getStartCoordinates($grid): array
{
    $size = count($grid[0]);
    $variations = $size - 3;
    $maxIndex = $size - 1;
    for ($i = 0; $i < $variations; $i++) {
        $x = $maxIndex - $i;
        $y = 0;

        $startCoordinates[] = $x . ' ' . $y;
        $startCoordinates[] = $maxIndex . ' ' . $i;
    }
    return array_unique($startCoordinates ?? []);
}

function getMaxRowProduct($array, &$max)
{
    $variations = count($array) - 3;
    for ($i = 0; $i < $variations; $i++) {
        $arr = array_slice($array, $i, 4);
        $product = array_product($arr);
        if ($product > $max) {
            $max = $product;
        }
    }
}

function gridRotate($array): array
{
    $new_array = [];
    $count_x = count($array[0] ?? 0);
    for ($x = 0; $x < $count_x; $x++) {
        $new_array[] = array_column($array, $count_x - $x - 1);
    }

    return $new_array;
}

class MyTestCases extends TestCase
{
    function test1()
    {
        $this->assertEquals(getLargestProduct([
            [01, 01, 01, 01],
            [04, 04, 04, 04],
            [01, 01, 01, 01],
            [01, 01, 01, 01],
        ]), 256);
    }

    function test2()
    {
        $this->assertEquals(getLargestProduct([
            [01, 01, 01, 04],
            [01, 01, 01, 04],
            [01, 01, 01, 04],
            [01, 01, 01, 04],
        ]), 256);
    }

    function test3()
    {
        $this->assertEquals(getLargestProduct([
            [04, 01, 01, 01],
            [01, 04, 01, 01],
            [01, 01, 04, 01],
            [01, 01, 01, 04],
        ]), 256);
    }

    function test4()
    {
        $this->assertEquals(getLargestProduct([
            [01, 01, 01, 04],
            [01, 01, 04, 01],
            [01, 04, 01, 01],
            [04, 01, 01, 01],
        ]), 256);
    }
}
