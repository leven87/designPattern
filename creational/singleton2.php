<?php
/*
 * 单例模式示例(销毁实例版)
 */
error_reporting(E_ALL);
ini_set('display_errors','on');
    
    //
    class SingletonBike{
        private static $instance = null; //创建静态私有的变量保存该类对象
        private $ownerUser = "";//使用者姓名
        
        //构造函数私有化，防止直接创建对象
        private function __construct($ownerUser) {
             $this ->ownerUser = $ownerUser;
        }
        //构造函数私有化，防止直接创建对象
      
       //防止克隆对象
        private function __clone() {
        }
        //静态方法，创建实例
        public static function getInstance($ownerUser){
            if(!self::$instance instanceof self){//self指类，this代表实例，这里指代静态属性，使用self
                self::$instance = new self($ownerUser);
                return self::$instance;
            }else{
                return null;
            }
        }
        public function getOwnerUser(){
            return $this->ownerUser;
        }
        //静态方法,销毁实例
        public static function destroyInstance(&$instance){
            self::$instance = null;
            $instance = null;
        }
    }

    
    $singletonBike = SingletonBike::getInstance("Mary");
    echo $singletonBike->getOwnerUser()."<br/>";//Mary
    $singletonBike2 = SingletonBike::getInstance("Jack");
    var_dump($singletonBike2);//null
    echo "<br/>";
    SingletonBike::destroyInstance($singletonBike);
    $singletonBike2 = SingletonBike::getInstance("Jack");
    var_dump($singletonBike2);//object(SingletonBike)#1 (1) { ["ownerUser":"SingletonBike":private]=> string(4) "Jack" }
    echo "<br/>";
    var_dump($singletonBike);//为空
?>