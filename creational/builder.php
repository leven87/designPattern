<?php
/*
 * 建造者方法模式示例
 */
error_reporting(E_ALL);
ini_set('display_errors','on');

    /*
     * 具体产品（一个包含宠物和宠物食物的产品）
     */
    class PetGroup{
        private $petType;
        private $food;
        private $foodNum = 0;
        
        public function addPet($petType){
            $this->petType = $petType;
        }
        public function addFood($food,$foodNum){
            $this->food = $food;
            $this->foodNum = $foodNum;
        }
        public function addFish($foodNum){//加鱼
            $this->food = "fish";
            $this->foodNum = $foodNum;
        }   
        public function addBone($foodNum){//加骨头
            $this->food = "bone";
            $this->foodNum = $foodNum;
        }
        public function getPetType(){
            return $this->petType;
        }
        public function getFood(){
            return $this->food;
        }        
    }
    
    /*
     * 抽象建造者
     */
    abstract class Builder{
        //实际的产品，这里的petGroup定义为一个包含宠物和宠物食物的产品
        private $petGroup;  
        //建造宠物
        abstract public function buildPet();
        //建造食物
        abstract public function buildFood($num);
        
        public function createPetGroup(){
            $this->petGroup = new PetGroup();
        }
        public  function getPetGroup(){
            return $this->petGroup;
        }
    }
    
    /*
     * 具体建造者(猫宠物组合)
     */
    class CatGroupBuilder extends Builder{
        
        public  function buildPet(){
            $this->getPetGroup()->addPet("cat");
        }
        public function buildFood($num){
            $this->getPetGroup()->addFish($num);
        }        
    } 
    
    /*
     * 具体建造者(狗宠物组合)
     */
    class DogGroupBuilder extends Builder{
        
        public  function buildPet(){
            $this->getPetGroup()->addPet("dog");
        }
        public  function buildFood($num){
            $this->getPetGroup()->addBone($num);
        }        
    }
    
    /*
     * 指挥者
     */
     class Director{
         private $builder;
         public function __construct($builder) {
             $this->builder = $builder;
         }
         public function getBuilder(){
             return $this->builder;
         }
         public function setBuilder($builder){
             $this->builder = $builder;
         }         
         public function getPetGroup(){
             $this->builder->createPetGroup();
             $this->builder->buildPet();
             $this->builder->buildFood(5);
             return $this->builder->getPetGroup();
         }
     }

     $catGroupBuilder = new CatGroupBuilder();
     $director = new Director($catGroupBuilder);
     $catGroup = $director->getPetGroup();
     echo $catGroup->getPetType()." ".$catGroup->getFood()."<br/>";//cat fish
     $dogGroupBuilder = new DogGroupBuilder();
     $director->setBuilder($dogGroupBuilder);
     $dogGroup = $director->getPetGroup();
     echo $dogGroup->getPetType()." ".$dogGroup->getFood()."<br/>";//dog bone

?>