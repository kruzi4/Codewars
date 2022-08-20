<?php
declare(strict_types=1);

use PHPUnit\Framework\TestCase;

include "../../../index.php";

/**
 * @link https://www.codewars.com/kata/58b63cb2b7d86adb650000b7/train/php
 *
 * @param array $buses_colors
 * @param array $going_to_school
 * @return int
 */
function which_bus_to_take(array $buses_colors, array $going_to_school): int {
    foreach ($buses_colors as $index => $buses_color) {
        if ($going_to_school[$index] === false || $buses_color === 'blue') {
            continue;
        }

        return $index;
    }

    return count($buses_colors) - 1;
}

class WhichBusToTakeTest extends TestCase {
    public function testBasic() {
        $this->assertEquals(0, which_bus_to_take(["red","red","blue"], [true, true, true]));
        $this->assertEquals(3, which_bus_to_take(["blue","blue","blue","red","red"], [false, true, true, true, false]));
        $this->assertEquals(5, which_bus_to_take(["blue","red","red","red","blue","red","blue"], [true, false, false, false, true, true, false]));
        $this->assertEquals(3, which_bus_to_take(["red","red","red","blue"], [false, false, false, true]));
    }
}