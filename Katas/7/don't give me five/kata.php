<?php
declare(strict_types=1);

use PHPUnit\Framework\TestCase;

include "../../../index.php";

//dd(dont_give_me_five(4, 17));

/**
 * @link https://www.codewars.com/kata/5813d19765d81c592200001a/train/php
 *
 * @param int $start
 * @param int $end
 * @return int
 */
function dont_give_me_five(int $start, int $end): int
{
    return count(array_filter(range($start, $end), static fn ($el) => !str_contains((string)$el, '5')));
}


class DontGiveMeFiveTest extends TestCase {
    public function testExamples() {
        $this->assertEquals(8, dont_give_me_five(1, 9));
        $this->assertEquals(12, dont_give_me_five(4, 17));
    }
}