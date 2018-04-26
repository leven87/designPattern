<?php
/*
 * 工厂方法模式示例
 */

    /*
     * 工厂接口(抽象工厂） 
     */
    interface  IAnimal{
        public function create();
    }
    /*
     * 具体工厂(Concrete Creator)角色：猫工厂 
     */
    class CatFactory implements IAnimal{
        public function create(){
            return new Cat();
        }
    }
    
    /*
     * 具体工厂(Concrete Creator)角色：狗工厂 
     */
    class DogFactory implements IAnimal{
        public function create(){
            return new Dog();
        }
    }
    
    /** 
     * 抽象产品(Product)角色：动物特征 
     */
     abstract class AnimalFeatures   { 
          private  $name = ""; 
          
          public function __construct($name="") {
              $this->setName($name);
          }
          public function setName($name){
              $this->name = $name;
          }
          public function getName(){
              return $this->name;
          }
          public function getInstruction(){
              return "I'm an animal.";
          }
     }
    
    /** 
     * 具体产品(Concrete Product)角色：猫
     * 
     */      
     class Cat extends AnimalFeatures{
         public $price = 50;
          //@Override 
         public function getInstruction(){
             return "I'm a cat.";
         }
     }
    
    /** 
     * 具体产品(Concrete Product)角色：狗
     * 
     */      
     class Dog extends AnimalFeatures{
         public $price = 60;
          //@Override 
         public function getInstruction(){
             return "I'm a dog.";
         }
     }     
$catFactory = new CatFactory();
$cat = $catFactory->create();
echo $cat->getName();//输出空
echo "<br/>";
$cat->setName("Jimmy");
echo $cat->getName();//输出Jimmy
echo "<br/>";
echo $cat->getInstruction();//输出I'm a cat.

?>