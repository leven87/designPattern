<?php
/*
 * 原型模式示例
 */
error_reporting(E_ALL);
ini_set('display_errors','on');
    
/*
 * 抽象接口类
 * 包括深拷贝和浅拷贝方法，使得实现它的类都可以实现
 */
 interface Prototype{
     public function shadowCopy();//浅拷贝
     public function deepCopy();//深拷贝
}

/*
 * 需要引用的对象的类Person
 */
class Person{
   public $name; 
   public function __construct($name) {
       $this->name = $name;
   }
   public function getName(){
       return $this->name;
   }
}

/*
 *原型类 
 */
class Demo implements Prototype{
    private $person;
    public function __construct($person) {
        $this->person = $person;
    }
    public function setPerson($person){
        $this->person = $person;
    }
    public function getPerson(){
        return $this->person;
    }
    public function shadowCopy() {
        return clone $this;
    }
    public function deepCopy() {
        $serializeObj = serialize($this);
        $cloneObj = unserialize($serializeObj);
        return $cloneObj;
    }
    private  function __clone() {
        echo "come here when clone";
    }
}

$person = new Person("Mary");
$demoObj = new Demo($person);
$shadowCopyObj = $demoObj->shadowCopy();
$deepCopyObj = $demoObj->deepCopy();

//复制后，原型对象，深拷贝对象，浅拷贝对象中的引用对象值一致
var_dump($demoObj->getPerson()->getName()).PHP_EOL;//string(4) "Mary" 
var_dump($shadowCopyObj->getPerson()->getName()).PHP_EOL;//string(4) "Mary" 
var_dump($deepCopyObj->getPerson()->getName()).PHP_EOL;//string(4) "Mary" 

//更改原型对象的引用对象中的值后，原型对象和浅拷贝对象因为引用地址一样都改变，深拷贝对象不变
$person->name = "Jack";
var_dump($demoObj->getPerson()->getName()).PHP_EOL;//string(4) "Jack" 
var_dump($shadowCopyObj->getPerson()->getName()).PHP_EOL;//string(4) "Jack" 
var_dump($deepCopyObj->getPerson()->getName()).PHP_EOL;//string(4) "Mary"

//更换原型对象的引用对象后，原型对象再次改变，浅拷贝对象因为引用地址没有改变所以不变，深拷贝对象不受影响还是保持最开始的值
$person2 = new Person("Peter");
$demoObj->setPerson($person2);
var_dump($demoObj->getPerson()->getName()).PHP_EOL;//string(4) "Peter" 
var_dump($shadowCopyObj->getPerson()->getName()).PHP_EOL;//string(4) "Jack" 
var_dump($deepCopyObj->getPerson()->getName()).PHP_EOL;//string(4) "Mary"
    
?>