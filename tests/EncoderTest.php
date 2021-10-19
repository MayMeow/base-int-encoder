<?php

namespace Maymeow\BaseIntEncoder\Tests;

use Maymeow\BaseIntEncoder\BaseIntEncoder;
use PHPUnit\Framework\TestCase;

class EncoderTest extends TestCase
{
    /** @test  */
    public function testEncodeDecode() : void
    {
        $encoder = new BaseIntEncoder();


        for ($i = 1; $i <= 100; $i++) {
            $id = rand(1, 99999999999999);

            $decodedId = $encoder->decode($encoder->encode($id));

            $this->assertEquals($id, (int)$decodedId);
        }
    }
}