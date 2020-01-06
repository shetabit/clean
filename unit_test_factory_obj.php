<?php

namespace Tests\Feature;

use App\Plane;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PlaneTest extends TestCase
{
    /**
     * @test
     */
    public function it_test_plane_is_ready_to_fly(){
        $plane = factory(Plane::class,10)->create();
//        dd($plane);
        $this->assertTrue($plane->isReady());
        $plane->repairing = false;
        $this->assertFalse($plane->isReady());
    }
}
