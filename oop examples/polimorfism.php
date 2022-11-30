<?php
// не дописал
abstract class Animal
{    
    abstract public function makeSound();    
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

?>