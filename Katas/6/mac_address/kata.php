<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;

include "../../../index.php";

/**
 * @link https://www.codewars.com/kata/58ef89d42a9818c78200020a/train/php
 */
$pattern = "/
  ^(([0-9A-F]{2}-){7})[0-9A-F]{2}$ |
  ^(([0-9A-F]{2}:){5})[0-9A-F]{2}$ |
  ^(([0-9A-F]{2}-){5})[0-9A-F]{2}$ |
  ^(([0-9A-F]{4}\.){2})[0-9A-F]{4}$
/";
$flags = "xi";

class MyTestCases extends TestCase
{
    public function testTrue() {
        global $pattern;
        global $flags;
        $this->assertEquals(true, preg_match($pattern.$flags, "0A-53-70-87-10-4F"), "0A-53-70-87-10-4F");
        $this->assertEquals(true, preg_match($pattern.$flags, "00-53-70-87-10-4f-4E-4f"), "00-53-70-87-10-4f-4E-4f");
        $this->assertEquals(true, preg_match($pattern.$flags, "00:53:70:87:10:4f"), "00:53:70:87:10:4f");
        $this->assertEquals(true, preg_match($pattern.$flags, "0053.7087.104f"), "0053.7087.104f");
    }

    public function testFalse() {
        global $pattern;
        global $flags;
        $this->assertEquals(false, preg_match($pattern.$flags, "0A-53-70-87-10-4"), "0A-53-70-87-10-4");
        $this->assertEquals(false, preg_match($pattern.$flags, "00-53-70-87-10-4E-4F"), "00-53-70-87-10-4E-4F");
        $this->assertEquals(false, preg_match($pattern.$flags, "00:53:70:87:10"), "00:53:70:87:10");
        $this->assertEquals(false, preg_match($pattern.$flags, "0053.7087.104F.114D"), "0053.7087.104F.114D");
    }
}
