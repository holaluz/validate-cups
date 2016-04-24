<?php

use CupsValidate\Cups;

class CupsTest extends PHPUnit_Framework_TestCase
{
    public function testHasNormalLength()
    {
        $cups1 = 'LL0000000000000000EE3X';
        $cups2 = 'LL0000000000000000EE';
        $cups3 = 'LL0000000000000000';
        $cups4 = '';

        $this->assertEquals(true, Cups::validate($cups1));
        $this->assertEquals(true, Cups::validate($cups2));
        $this->assertEquals(false, Cups::validate($cups3));
        $this->assertEquals(false, Cups::validate($cups4));
    }

    public function test2FirstNumbersAreUpperCaseLetters()
    {
        $cups1 = 'LL0000000000000000EE1X';
        $cups2 = 'll0000000000000000EE1X';
        $cups3 = '550000000000000000EE1X';

        $this->assertEquals(true, Cups::validate($cups1));
        $this->assertEquals(false, Cups::validate($cups2));
        $this->assertEquals(false, Cups::validate($cups3));
    }

    public function test16followSringAreNumbers()
    {
        $cups1 = 'LL0000000000000000EE1X';
        $cups2 = 'LLDDDDCCCCCCCCCCCCEE1X';

        $this->assertEquals(true, Cups::validate($cups1));
        $this->assertEquals(false, Cups::validate($cups2));
    }

    public function testControlNumbersAreStringUppercase()
    {
        $cups1 = 'LL0000000000000000EE0X';
        $cups2 = 'LL0000000000000000ee0X';
        $cups3 = 'LL0000000000000000450X';
        $cups4 = 'LL0000000000000000eE';
        $cups5 = 'LLDDDDCCCCCCCCCCCC';

        $this->assertEquals(true, Cups::validate($cups1));
        $this->assertEquals(false, Cups::validate($cups2));
        $this->assertEquals(false, Cups::validate($cups3));
        $this->assertEquals(false, Cups::validate($cups4));
        $this->assertEquals(false, Cups::validate($cups5));
    }

    public function testNCharIsADigit()
    {
        $cups1 = 'LL0000000000000000EE1X';
        $cups2 = 'LLDDDDCCCCCCCCCCCCEENX';

        $this->assertEquals(true, Cups::validate($cups1));
        $this->assertEquals(false, Cups::validate($cups2));
    }

    public function testTCharIsASpeficic()
    {
        //FPCX
        $cups1 = 'LL0000000000000000EE1F';
        $cups2 = 'LL0000000000000000EE1P';
        $cups3 = 'LL0000000000000000EE1C';
        $cups4 = 'LL0000000000000000EE1X';
        $cups5 = 'LLDDDDCCCCCCCCCCCCEENT';
        $cups6 = 'LLDDDDCCCCCCCCCCCCEEN5';
        $cups7 = 'LLDDDDCCCCCCCCCCCCEEN';

        $this->assertEquals(true, Cups::validate($cups1));
        $this->assertEquals(true, Cups::validate($cups2));
        $this->assertEquals(true, Cups::validate($cups3));
        $this->assertEquals(true, Cups::validate($cups4));
        $this->assertEquals(false, Cups::validate($cups5));
        $this->assertEquals(false, Cups::validate($cups6));
        $this->assertEquals(false, Cups::validate($cups7));
    }
}
