<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;

include "../../../index.php";

$res = toCamelCase('the-Stealth-Warrior');
//dd($res);

/**
 * @link https://www.codewars.com/kata/517abf86da9663f1d2000003/train/php
 *
 * @param $str
 * @return string
 */
function toCamelCase($str): string
{
    $isUCFirst = ctype_upper(substr($str, 0, 1));
    $str = preg_replace_callback('/(([a-zA-Z]+))[-_]?/m', static function ($m) {
        return ucfirst($m[1]);
    }, $str);

    return $isUCFirst ? ucfirst($str) : lcfirst($str);
}


function alphabet_position(string $s) {
    $a = str_split(strtolower(preg_replace('/[^a-zA-Z]/', '', $s)));
    $alphabet = array_map(fn ($el) => ++$el, array_flip(range('a', 'z')));
    foreach ($a as $l) {
        $res .= $alphabet[$l] . ' ';
    }
    return rtrim($res);
}

$r = alphabet_position('The sunset sets at twelve o\' clock.');
dd($r);

class TestCases extends TestCase {
    public function testSampleCases() {
        $this->assertEquals("theStealthWarrior", toCamelCase("the_stealth_warrior"), "toCamelCase('the_stealth_warrior') did not return correct value");
        $this->assertEquals("theStealthWarrior", toCamelCase("the-Stealth-Warrior"), "toCamelCase('the-Stealth-Warrior') did not return correct value");
    }
}

