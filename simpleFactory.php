<?php
/*
 * 简单工厂模式示例
 */
     class Cat{
        public $name;
        public $instruction = "I'm a cat.";
        
        public function getInstruction(){
            return $this->instruction;
        }
    }
    
     class Dog{
        public $name;
        public $instruction = "I'm a Dog.";
        
        public function getInstruction(){
            return $this->instruction;
        }
    }    
    class AnimalFactory{
        public static function create($type){
            return new $type();
        }
    }

$cat = AnimalFactory::create("Cat");
echo $cat->getInstruction();//输出I'm a cat.
?>