<?php
/*
 * 桥接模式示例
 */
preg_match("/cli/i", php_sapi_name()) ? define('LINE_BREAK', PHP_EOL) : define('LINE_BREAK', "<br/>");

/*
 * 角色：行为接口
 * 穿衣打扮接口
 */
interface DressAPI{
    public function dressCloth();
}
/*
 * 角色；行为具体实现类
 * 穿西服
 */
class  DressWithSuit implements DressAPI{
    public function dressCloth(){
        echo "穿西服".LINE_BREAK;
    }
}
/*
 * 角色；行为具体实现类
 * 穿运动服
 */
class  DressWithSportsCloth implements DressAPI{
    public function dressCloth(){
        echo "穿运动服".LINE_BREAK;
    }
}

/*
 * 角色：抽象类
 * 人
 */
abstract  class Person{
    private  $_dressAPI;
    public function __construct(DressAPI $dressAPI) {
        $this->_dressAPI = $dressAPI;
    }
    public function getDressAPI(){
        return $this->_dressAPI;
    }
    public function setDressAPI(DressAPI $dressAPI){
        $this->_dressAPI = $dressAPI;
    }
    public abstract function Dress();
}

/*
 * 角色：抽象实现类
 * 白领
 */
class Officer extends Person{
    public function __construct(DressAPI $dressAPI) {
        parent::__construct($dressAPI);
        echo "我是一个白领".LINE_BREAK;
    }
    public function Dress(){
        $this->getDressAPI()->dressCloth();
    }    
}

/*
 * 角色：抽象实现类
 * 运动员
 */
class Athlete extends Person{
    public function __construct($dressAPI) {
        parent::__construct($dressAPI);
        echo "我是一个运动员".LINE_BREAK;
    }
    public function Dress(){
        $this->getDressAPI()->dressCloth();
    }    
}

/*
 * 角色：使用者
 */
$officer = new Officer(new DressWithSuit());//我是一个白领
$athlete = new Athlete(new DressWithSportsCloth());//我是一个运动员
$officer->Dress();//穿西服
$athlete->Dress();//穿运动服
$officer->setDressAPI(new DressWithSportsCloth());
$officer->Dress();//穿运动服