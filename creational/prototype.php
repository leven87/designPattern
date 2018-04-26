<?php
/*
 * 原型模式示例
 */
error_reporting(E_ALL);
ini_set('display_errors','on');
    
    //产品族Food
    interface IFood{
        public function getNum();        
    }
    //产品——FoodBone类
    class FoodBone implements IFood{
        private $num;
        public function __construct($num) {
            $this->num = $num;
        }
        public function getNum(){
            return $this->num;
        }        
    }
    //产品——FoodFish类
    class FoodFish implements IFood{
        private $num;
        public function __construct($num) {
            $this->num = $num;
        }
        public function getNum(){
            return $this->num;
        }        
    }      
    
    //产品族Pet
    interface IPet{
        public function getName();
    }
    //产品——Cat类
    class Cat implements IPet{
        private $name;
        public function __construct($name) {
            $this->name = $name;
        }
        public function getName(){
            return $this->name;
        }
    }
    //产品——dog类
    class Dog implements IPet{
        private $name;
        public function __construct($name) {
            $this->name = $name;
        }
        public function getName(){
            return $this->name;
        }       
    }
    
    //养宠物的接口
    interface  IKeepPetFactory{
        public function createPet($name);
        public function createFood($num);
    }
    //养猫的工厂类
    class KeepCatFactory implements IKeepPetFactory{
        public function createPet($name){
            return new Cat($name);
        }
        public function createFood($num) {
            return new FoodFish($num);
        }
    }
    //养狗的工厂类
    class KeepDogFactory implements IKeepPetFactory{
        public function createPet($name){
            return new Dog($name);
        }
        public function createFood($num) {
            return new FoodBone($num);
        }
    }    
    
    
    $keepDog = new KeepDogFactory();
    $dog = $keepDog->createPet("Tom");
    $dogFood = $keepDog->createFood(5);
    
    echo $dog->getName();//Tom
    echo "<br />";
    echo $dogFood->getNum();//5

?>