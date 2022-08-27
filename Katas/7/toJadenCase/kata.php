<?php
declare(strict_types=1);

use PHPUnit\Framework\TestCase;

include "../../../index.php";

/**
 * @link https://www.codewars.com/kata/5390bac347d09b7da40006f6/train/php
 *
 * @param string $string
 * @return string
 */
function toJadenCase(string $string): string
{
    $explode = explode(' ', $string);
    $explode = array_map(static function ($el) {return ucfirst($el);}, $explode);
    return implode(' ', $explode);
}

$str = "How can mirrors be real if our eyes aren't real";
//dd(toJadenCase($str));


class JadenTestCases extends TestCase
{
    public function testJadenCase() {
        $str = "How can mirrors be real if our eyes aren't real";
        $this->assertEquals("How Can Mirrors Be Real If Our Eyes Aren't Real", toJadenCase($str));
    }
}