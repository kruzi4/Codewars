<?php
declare(strict_types=1);

use PHPUnit\Framework\TestCase;

include "../../../index.php";

$expr = '(123.45*(678.90 / (-2.5+ 11.5)-(((80 -(19))) *33.25)) / 20) - (123.45*(678.90 / (-2.5+ 11.5)-(((80 -(19))) *33.25)) / 20) + (13 - 2)/ -(-11) ';
$result = calc($expr);
//dd($result);

/**
 * @link https://www.codewars.com/kata/52a78825cdfc2cfc87000005/train/php
 *
 * @param string $s
 * @return float
 */
function calc($s)
{
    $s = preg_replace_callback('/[+*\/]|\-[^\d]/', static function ($m) {return ' ' . $m[0] . ' ';}, $s);
    $s = preg_replace('/\s+/', ' ', $s);
    $s = str_replace('--', '+', $s);
    while(strpos($s, '(') !== false) {
        $s = preg_replace_callback('/\([\d\.+\-\/* ]+\)/', 'inner_calc', $s);
    }
    $s = str_replace('--', '', $s);
    return (float)inner_calc([$s]);
}

function inner_calc($matches)
{
    $s = $matches[0];
    $s = trim($s, '() ');
    $s = preg_replace_callback('/([^ -]\s)(-\d)/', static function ($m) {return $m[1] . '+ ' . $m[2];}, $s);
    $s = preg_replace_callback('/(\d)-(\d)/', static function ($m) {return $m[1] . ' - ' . $m[2];}, $s);

    $arr = explode(' ', $s);
    while ($arr[0] === '+' || $arr[0] === '') {
        unset($arr[0]);
        $arr = array_values($arr);
    }

    if (count($arr) === 1) {
        if (strpos($arr[0], '-') === false) {
            return (string)$arr[0];
        }

        $arr = explode(' ', $arr[0]);
    }

    foreach ($arr as $key => &$item) {
        list($kPrev, $kNext) = [$key - 1, $key + 1];
        if (!isset($arr[$kPrev], $arr[$kNext])) {
            continue;
        }
        list($prev, $next) = [$arr[$kPrev], $arr[$kNext]];

        switch ($item) {
            case '+':
                continue 2;
            case '-':
                continue 2;
            case '*':
                if ($next === '+') {
                    unset($arr[$kNext]);
                    $next = $arr[$key + 2];
                    $arr = array_values($arr);
                }

                $arr[$key] = $prev * $next;
                unset($arr[$kPrev], $arr[$kNext]);
                $arr = array_values($arr);
                continue 2;
            case '/':
                if ($next === '+') {
                    unset($arr[$kNext]);
                    $next = $arr[$key + 2];
                    $arr = array_values($arr);
                }

                if ($next ==  0) {
                    $arr[$key] = $prev;
                } else {
                    $arr[$key] = $prev / $next;
                }
                unset($arr[$kPrev], $arr[$kNext]);
                $arr = array_values($arr);
                continue 2;
            default:
                $item = (float)$item;
                continue 2;
        }
    }

    unset($item);

    foreach ($arr as $key => &$item) {
        list($kPrev, $kNext) = [$key - 1, $key + 1];
        if (!isset($arr[$kPrev], $arr[$kNext])) {
            continue;
        }
        list($prev, $next) = [$arr[$kPrev], $arr[$kNext]];
        if ($next === '+') {
            unset($arr[$kNext]);
            $next = $arr[$key + 2];
            $arr = array_values($arr);
        }

        switch ($item) {
            case '+':
                $arr[$key] = $prev + $next;
                unset($arr[$kPrev], $arr[$kNext]);
                $arr = array_values($arr);
                continue 2;
            case '-':
                $arr[$key] = $prev - $next;
                unset($arr[$kPrev], $arr[$kNext]);
                $arr = array_values($arr);
                continue 2;
            default:
                $item = (float)$item;
                continue 2;
        }
    }

    return (string)reset($arr);
}

//BONUS: THE SHORTEST ANSWERS FROM CODEWARS
function calcShort1(string $e): float {
    return (float) exec("php -r 'echo $e;'");
}

function calcShort2(string $expression): float {
    return create_function('', "return ($expression);" )();
}

class CalcTest extends TestCase
{
    protected function randomize(array $a): array
    {
        for ($i = 0; $i < 2 * count($a); $i++) list($a[$j], $a[$k]) = [$a[$k = array_rand($a)], $a[$j = array_rand($a)]];
        return $a;
    }

    public function testMinuses()
    {
        $this->assertSame(0.0, calc('1-1'));
        $this->assertSame(0.0, calc('1- 1'));
        $this->assertSame(0.0, calc('1 - 1'));
        $this->assertSame(2.0, calc('1- -1'));
        $this->assertSame(2.0, calc('1 - -1'));
        $this->assertSame(2.0, calc('1--1'));

        $this->assertSame(2.0, calc('6 + -(4)'));
        $this->assertSame(10.0, calc('6 + -( -4)'));
    }

    public function testShufled()
    {
        $this->assertSame(3.0, calc( '-1 + -(-(-(-4)))'));
        $this->assertSame(-12.0, calc('12*-1'));
        $this->assertSame(-12042.760875, calc('123.45*(678.90 / (-2.5+ 11.5)-(80 -19) *33.25) / 20 + 11'));
        $this->assertSame(1.0, calc('(123.45*(678.90 / (-2.5+ 11.5)-(((80 -(19))) *33.25)) / 20) - (123.45*(678.90 / (-2.5+ 11.5)-(((80 -(19))) *33.25)) / 20) + (13 - 2)/ -(-11) '));
        $this->assertSame(-492.0, calc('12* 123/(-5 + 2)'));
        $this->assertSame(11.0, calc('7 + (-12 / -3)'));
    }

    public function testShuffledExamples()
    {
        foreach ($this->randomize([
            ['1+1', 2.0],
            ['1 - 1', 0.0],
            ['1* 1', 1.0],
            ['1 /1', 1.0],
            ['-123', -123.0],
            ['123', 123.0],
            ['2 /2+3 * 4.75- -6', 21.25],
            ['12* 123', 1476.0],
            ['2 / (2 + 3) * 4.33 - -6', 7.732],
        ]) as $a) $this->assertSame($a[1], floatval(calc($a[0])));
    }
}