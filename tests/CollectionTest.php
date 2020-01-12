<?php

use Addgod\Evaluator\Collection;
use Tests\TestCase;

class CollectionTest extends TestCase
{
    /**
     * @test
     */
    public function testSetOriginalValueMethod()
    {
        $stub = new Collection([
            'price' => 100,
        ]);

        $this->assertInstanceOf('\Addgod\Evaluator\Collection', $stub->setOriginalValue(100));
    }

    /**
     * @test
     */
    public function testSetCalculatedValueMethod()
    {
        $stub = new Collection([
            'price' => 100,
        ]);

        $this->assertInstanceOf('\Addgod\Evaluator\Collection', $stub->setCalculatedValue(200));
    }

    /**
     * @test
     */
    public function testGetOriginalMethod()
    {
        $stub = new Collection([
            'price' => 100,
        ]);
        $stub->setOriginalValue(100);

        $this->assertEquals(100, $stub->getOriginal());
    }

    /**
     * @test
     */
    public function testGetResultMethod()
    {
        $stub = new Collection([
            'price' => 100,
        ]);
        $stub->setCalculatedValue(200);

        $this->assertEquals(200, $stub->getResult());
    }
}
