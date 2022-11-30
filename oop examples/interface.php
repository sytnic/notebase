<?php
// Пример интерфейса
// https://www.youtube.com/watch?v=ZkFj-39HUFA&list=PLa9lO_Eq-vZVusZYUe3tcfZ3jgxZ21BTJ&index=8

interface EngineInterface
{
    public function on();
    public function off();
}

class Car
{
    private $color;
    private $year;
    private $manufacturer;
    private $engine;

    public function __construct($color, $year, $izgotovitel, EngineInterface $engine) 
    {
        $this->color = $color;
        $this->year  = $year;
        $this->manufacturer = $izgotovitel;
        $this->engine = $engine;
    }

    public function startEngine()
    {
        $this->engine->on();
    }
    
    public function stopEngine()
    {
        $this->engine->off();
    }

}


class Engine implements EngineInterface
{
    public function on()
    {
        //
    }

    public function off()
    {
        //
    }
}

class anotherEngine implements EngineInterface
{
    public function on()
    {
        //
    }

    public function off()
    {
        //
    }
}

$engine = new Engine;
$anotherEngine = new anotherEngine;

// $mycar = new Car('red', 2017, 'Mercedes', $engine);
$mycar = new Car('red', 2017, 'Mercedes', $anotherEngine);

var_dump($mycar);


?>