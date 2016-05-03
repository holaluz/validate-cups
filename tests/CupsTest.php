<?php

use CupsValidate\Cups;

/**
 * Cups validator test.
 *
 * @link https://es.wikipedia.org/wiki/C%C3%B3digo_Unificado_de_Punto_de_Suministro
 *
 * Pattern:
 * LL DDDD CCCC CCCC CCCC EE NT
 */
class CupsTest extends PHPUnit_Framework_TestCase
{
    public function testHasNormalLength()
    {
        $cups1 = 'ES0521528120303526VQ3X';
        $cups2 = 'ES0521528120303526VQ';
        $cups3 = 'ES0521528120303526';
        $cups4 = '';

        $this->assertEquals(true, Cups::validate($cups1));
        $this->assertEquals(true, Cups::validate($cups2));
        $this->assertEquals(false, Cups::validate($cups3));
        $this->assertEquals(false, Cups::validate($cups4));
    }

    public function test2FirstNumbersAreUpperCaseLetters()
    {
        $cups1 = 'ES0521528120303526VQ3X';
        $cups2 = 'll0521528120303526VQ3X';
        $cups3 = '550521528120303526VQ3X';

        $this->assertEquals(true, Cups::validate($cups1));
        $this->assertEquals(false, Cups::validate($cups2));
        $this->assertEquals(false, Cups::validate($cups3));
    }

    public function test16followSringAreNumbers()
    {
        $cups1 = 'ES0521528120303526VQ3X';
        $cups2 = 'ES0aD1528120303526VQ3X';

        $this->assertEquals(true, Cups::validate($cups1));
        $this->assertEquals(false, Cups::validate($cups2));
    }

    public function testControlNumbersAreStringUppercase()
    {
        $cups1 = 'ES0521528120303526VQ3X';
        $cups2 = 'ES0521528120303526vQ3X';
        $cups3 = 'ES05215281203035255Q3X';
        $cups4 = 'ES0521528120303526vw3X';
        $cups5 = 'ES0521528120303526';

        $this->assertEquals(true, Cups::validate($cups1));
        $this->assertEquals(false, Cups::validate($cups2));
        $this->assertEquals(false, Cups::validate($cups3));
        $this->assertEquals(false, Cups::validate($cups4));
        $this->assertEquals(false, Cups::validate($cups5));
    }

    public function testNCharIsADigit()
    {
        $cups1 = 'ES0521528120303526VQ3X';
        $cups2 = 'ES0521528120303526VQxX';

        $this->assertEquals(true, Cups::validate($cups1));
        $this->assertEquals(false, Cups::validate($cups2));
    }

    public function testTCharIsSpeficic()
    {
        //FPCX
        $cups1 = 'ES0521528120303526VQ3F';
        $cups2 = 'ES0521528120303526VQ3P';
        $cups3 = 'ES0521528120303526VQ3C';
        $cups4 = 'ES0521528120303526VQ3X';
        $cups5 = 'ES0521528120303526VQ3T';
        $cups6 = 'ES0521528120303526VQ35';
        $cups7 = 'ES0521528120303526VQ3';

        $this->assertEquals(true, Cups::validate($cups1));
        $this->assertEquals(true, Cups::validate($cups2));
        $this->assertEquals(true, Cups::validate($cups3));
        $this->assertEquals(true, Cups::validate($cups4));
        $this->assertEquals(false, Cups::validate($cups5));
        $this->assertEquals(false, Cups::validate($cups6));
        $this->assertEquals(false, Cups::validate($cups7));
    }

    public function testControlNumber()
    {
        $cups1 = 'ES0521528120303526VQ3F';
        $cups2 = 'ES0521528120303526XX3F';
        $cups3 = 'ES0521528120303526vQ3F';

        $this->assertEquals(true, Cups::validate($cups1));
        $this->assertEquals(false, Cups::validate($cups2));
        $this->assertEquals(false, Cups::validate($cups3));
    }
}
