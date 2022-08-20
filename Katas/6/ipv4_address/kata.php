<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;

include "../../../index.php";

/**
 * @link https://www.codewars.com/kata/567fe8b50c201947bc000056
 *
 * @param $address
 * @return bool
 */
function ipv4_address($address): bool
{
    $address = str_replace("\n", "#", $address);
    $result = preg_match('/^((?&num)\.){3}(?<num>25[0-5]|2[0-4][0-9]|[1][0-9][0-9]|[1-9][0-9]|[0-9])$/D', $address);
    return (bool)$result;
}

class MyTestCases extends TestCase
{
    // test function names should start with "test"
    public function testBasics() {
        $this->assertEquals( False,ipv4_address(""));
        $this->assertEquals( True,ipv4_address("127.0.0.1"));
        $this->assertEquals( True,ipv4_address("0.0.0.0"));
        $this->assertEquals( True,ipv4_address("255.255.255.255"));
        $this->assertEquals( True,ipv4_address("10.20.30.40"));
        $this->assertEquals( False,ipv4_address("10.256.30.40"));
        $this->assertEquals( False,ipv4_address("10.20.030.40"));
        $this->assertEquals( False,ipv4_address("127.0.1"));
        $this->assertEquals( False,ipv4_address("127.0.0.0.1"));
        $this->assertEquals( False,ipv4_address("..255.255"));
        $this->assertEquals( False,ipv4_address("127.0.0.1\n"));
        $this->assertEquals( False,ipv4_address("\n127.0.0.1"));
        $this->assertEquals( False,ipv4_address(" 127.0.0.1"));
        $this->assertEquals( False,ipv4_address("127.0.0.1 "));
        $this->assertEquals( False,ipv4_address(" 127.0.0.1 "));
    }
}