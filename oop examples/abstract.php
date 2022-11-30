<?php

abstract class Animal
{
    protected $name;
    
    abstract public function makeSound();

    public function jump()
    {
        //
    }
}

class Cat extends Animal
{
    public function makeSound()
    {
        echo "meow";
    }
}

class Dog extends Animal
{
    public function makeSound()
    {
        echo "gav gav";
    }
}

$cat = new Cat;
$dog = new Dog;

// Fatal
// Нельзя инстанцировать объект от абстрактного класса
// $animal = new Animal;



?>