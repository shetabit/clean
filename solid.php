<?php

class Reporter{
    public $data = [100,200,300,400,500];
    public function report($price, Formatter $f){

        $arr = $this->greaterThan($price);
        return $f->parse($arr);
    }
    public function greaterThan($price){
        return array_filter($this->data, function ($item) use ($price){
            return $item > $price;
        });
    }
}
interface Formatter{
    public function parse($arr);
}
class JsonFormatter implements Formatter {
    public function parse($arr){
        return json_encode($arr);
    }
}
class ArrayFormatter implements Formatter {
    public function parse($arr){
        return $arr;
    }
}
$formatter = new JsonFormatter();
$reporter = new Reporter();
$reporter->report(200, $formatter);

class Order{
    public function process(ProductProcessing $product)
    {
       $this->state =  $product->perform();
    }
}

interface ProductProcessing{
    public function perform();
}
class NormalProductProcessing implements ProductProcessing {
    public $queue;

    public function perform()
    {
        $this->queue = true;
    }
}
class SpecificProductProcessing implements ProductProcessing {
    public $queue;

    public function perform()
    {
        $this->queue = false;
    }
}


abstract class FlyingBird{
    abstract function fly();
}
abstract class NonFlyingBird{
    abstract function drink();
}
class Eagle extends Bird{
    public function fly(){
        return 'Flying....';
    }
}
class Duck extends NonFlyingBird {
//    public function fly(){
//        throw new Exception('I am not able');
//    }
}

//interface Workable{
//    public function sleep();
//    public function wakeUp();
//}
interface sleep{
    public function sleeping();
}
interface waking{
    public function wakeUp();
}
class Human implements waking,sleep {
    public function sleep(){

    }
    public function wakeUp(){

    }
}
class Robot implements waking {
//    public function sleep(){
//
//    }
    public function wakeUp(){

    }
}


class FilterData{
    public $connection;
    public function __construct(Sqlite $mysqConn)
    {
        $this->connection = $mysqConn;
    }

    public function selecQuery($query){

        return $this->connection->select($query);
    }
}
