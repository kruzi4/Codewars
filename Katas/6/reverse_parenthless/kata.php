<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;

include "../../../index.php";

/**
 * @link https://www.codewars.com/kata/589ace5eeef39faf49000061/train/php
 *
 * @param string $s
 * @return string
 */
function reverseParentheses(string $s): string {
    $brackets = substr_count($s, '(');
    while ($brackets > 0) {
        preg_match('/\([\w]+\)/', $s, $match);
        $reversed = strrev(trim($match[0], "()"));
        $s = str_replace($match[0], $reversed, $s);
        $brackets--;
    }

    return $s;
}

//best practice
function reverseParentheses2($s)
{
    $pattern = "/\((\w+)\)/";
    return preg_match($pattern, $s) ? reverseParentheses(preg_replace_callback($pattern, static function ($m) {
        return strrev($m[1]);
    }, $s)) : $s;
}

class MyTestCases extends TestCase
{
    // test function names should start with "test"
    public function testThatSomethingShouldHappen() {
        $this->assertEquals("acbde", reverseParentheses("a(bc)de"));
        $this->assertEquals("apmnolkjihgfedcbq", reverseParentheses("a(bcdefghijkl(mno)p)q"));
        $this->assertEquals("coswared", reverseParentheses("co(de(war)s)"));
        $this->assertEquals("CodeegnlleahC", reverseParentheses("Code(Cha(lle)nge)"));

    }
}