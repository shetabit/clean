<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ExampleTest extends TestCase
{

    public $array = [];
    public function freeArray(){
        $this->array = [];
    }
    /**
     * @test
     */
    public function it_test_array_push(){
        array_push($this->array, 1);
        $this->assertCount(1,$this->array);
    }
    /**
     * @test
     */
    public function it_deny_user_to_set_order(){
        $order = new Order();
        $order->inventory = -1;
        $this->expectException(\Exception::class);
        $order->payable();
    }
}

Class Order {
    public $inventory = 10;
    public function payable(){
        if($this->inventory < 0){
            throw new \Exception('NOT GOOD');
        }
    }
}
