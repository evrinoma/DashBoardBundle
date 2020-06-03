<?php


namespace Evrinoma\DashBoardBundle\Tests;


use PHPUnit\Framework\TestCase;

class ExampleTest extends TestCase
{
    private function example($a)
    {
        $b = 3;
        return $a*$b;
    }

    public function testAdd()
    {
       $result = $this->example(2);
        $this->assertEquals(6, $result);

        $result = $this->example(3);
        $this->assertEquals(9, $result);
    }
}