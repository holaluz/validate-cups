<?php

use CupsValidate/Cups;

class CupsTest extends PHPUnit_Framework_TestCase {

    public function testCupsHasTrue()
    {
        $this->assertTrue(Cups::validate());
    }

}
