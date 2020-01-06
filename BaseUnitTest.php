<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;

class ExampleTest extends TestCase
{
    public $stringMaker;
    public function setUp(): void
    {
        parent::setUp(); // TODO: Change the autogenerated stub
        $this->stringMaker = new StringMaker();
    }
    /**
     * @test
     */
    public function it_test_sum_two_number(){
        $calc = new Calculate();
        $resp = $calc->sum(1,4);
        $this->assertEquals(5,$resp);
    }
    /**
     * @test
     * @dataProvider additionDataProvider
     */
    public function it_test_subtract_two_number($a, $b, $result){
        $calc = new Calculate();
        $resp = $calc->subtract($a,$b);
        $this->assertEquals($result,$resp);
    }
    public function additionDataProvider(){
        return [
            [1,2,1],
            [1,5,4],
            [1,5,4],
        ];
    }
    /**
     * @test
     */
    public function it_should_convert_number_to_string(){
        $resp = $this->stringMaker->process(123);
        $this->assertSame('123', $resp);

    }
    /**
     *
     */
    public function it_test_number_is_zero(){
        $resp = $this->stringMaker->process(0);
        $this->assertSame('Nothing', $resp);
    }
}
class StringMaker{
    public function process($number){
        return (string)$number;
    }
}
class Calculate{
    public function sum($arg1,$arg2){
        return $arg1 + $arg2;
    }
    public function subtract($arg1,$arg2){
        return $arg2 - $arg1;
    }
}