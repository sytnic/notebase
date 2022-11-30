<?php

// трейт как бы экономит место в теле класса, 
// где он используется (use)
trait myGreetings
{
    public function sayHi()
    {
        echo "Hi"."<br>";
    }

    public function greet($person)
    {
        echo "Greetings ".$person."<br>";
        $this;
    // $this будет обращаться к соответствующему объекту 
    }
}

class Person
{
    // методы склонированы
    use myGreetings;

    // метод перезаписан
    public function sayHi()
    {
        echo "Hello"."<br>";
    }
}

$person = new Person;
$person->sayHi();
$person->greet("Friend");


?>