<?php

Class Wheel{
    public $tire;
    public $rim;
    public function __construct($rim,$tire)
    {
        $this->tire = $tire;
        $this->rim = $rim;
    }
    public function diameter(){
        return $this->rim + 2* $this->tire;
    }
}
Class Gear{

    private $cog;
    public $chainring;
    public $wheel;

    public function __construct($cog, $chainRing,Wheel $wheel)
    {
        $this->cog = $cog;
        $this->chainring = $chainRing;
        $this->wheel = $wheel;

    }

    public function ratio(){
        return ($this->chainring / $this->cog) * $this->wheel->diameter();
    }

}
$wheel = new Wheel(25, 4);
$gear = new Gear(52,11, $wheel);
$gear->ratio();
