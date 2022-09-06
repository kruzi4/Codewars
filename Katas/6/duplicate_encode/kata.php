<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;

include "../../../index.php";

$res = duplicate_encode('Success');
//dd($res);

/**
 * @link https://www.codewars.com/kata/54b42f9314d9229fd6000d9c/train/php
 *
 * @param $word
 * @return bool
 */
function duplicate_encode($word){
    $split = str_split(strtolower($word));
    $countValues = array_count_values($split);
    $res = array_map(static function ($el) use ($countValues) {
        return ($countValues[$el] > 1) ? ')' : '(';
    }, $split);

    return implode('', $res);
}

class MyTestCases extends TestCase
{
    public function testBasics() {
        $this->assertEquals('(((', duplicate_encode('din'));
        $this->assertEquals('()()()', duplicate_encode('recede'));
        $this->assertEquals(')())())', duplicate_encode('Success'), 'should ignore case');
        $this->assertEquals('))))))', duplicate_encode('iiiiii'), 'duplicate-only-string');
        $this->assertEquals(')))))(', duplicate_encode(' ( ( )'));
    }
}