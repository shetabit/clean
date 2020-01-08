<?php

namespace Tests\Feature;

use App\User;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Str;
use Tests\TestCase;

class MockTest extends TestCase
{
        use DatabaseMigrations;
    /**
     * @test
     */
    public function testGenerateRandom()
    {
//        $today = new Today();
//        Carbon::setTestNow();
//        $this->assertEquals(Carbon::now(), $today->now());

        $token = new Token();
        Token::setHash('asadgafwd8235283tc');
        $this->assertEquals('asadgafwd8235283tc',$token->generate());
    }
    public function testStub(){
        $user = factory(User::class)->create();
        $email = $user->email;
        $user->fraud();
        $this->assertNotEquals($email, $user->email);
    }
    public function testFake(){
        $fb = $this->createMock(Facebook::class);
        $fb->method('authorize')->willReturn(['result' => 'OK']);
        $mem = new Member();
        $this->assertTrue($mem->exist($fb));
    }
    public function testMock(){
        $window = $this->createMock(Window::class);
        $window->expects($this->once())
            ->method('close')
            ->with('A');

        $door = $this->createMock(Door::class);
        $door->expects($this->once())
            ->method('close')
            ->with('A');

        $security = new SecurityA();
        $security->closeAll($door, $window);
    }
}
class Window{
    public function close($w){

    }
}
class Door{
    public function close($d){

    }
}
class SecurityA{
    public function closeAll(Door $door,Window $window){
        $door->close('A');
        $window->close('A');
    }
}

class Facebook{
    public function authorize(){

    }
}
class Member{
    public function exist(Facebook $fb){
        $result = $fb->authorize();
        if($result['result'] == 'OK') return true;
    }
}
class Token{
    static $token;
    public function generate()
    {
        if(static::$token) return static::$token;
        return Str::random(16);
    }
    public static function setHash($data)
    {
        static::$token = $data;
    }

}
class Today{
    public function now()
    {
        return Carbon::now();
    }
}
