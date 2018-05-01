<?php
/*
 * 适配器方法模式示例
 */


/*
 * 角色：目标接口
 * 接口类——电源
 */
interface Source{
    public function output($EAVoltage);
}
/*
 * 角色；适配者类
 * 实现类——220V电源
 */
class Source220V implements Source{
    const VOLTAGE = "220V";
    public function output($EAVoltage){
        if($EAVoltage == self::VOLTAGE){
            return self::VOLTAGE;
        }else{
            return "";
        }
    }
    public function getVoltage(){
        return self::VOLTAGE;
    }
}

/*
 * 角色；适配者类
 * 实现类——5V电源
 */
class Source5V implements Source{
    const VOLTAGE = "5V";
    public function output($EAVoltage){
        if($EAVoltage == self::VOLTAGE){
           return self::VOLTAGE;
        }else{
            return false;
        }
    }
    public function getVoltage(){
        return self::VOLTAGE;
    }
}

/*
 * 接口类——适配器
 */
interface Adapter  {
    public function input(Source $source);
    public function output($EAVoltage);
}

/*
 * 角色；适配器（组合方式）
 * 实现类——220V转5V
 * 实现了适配器
 */
class Adapter220V implements Source{
    private $source;
    
    public function output($EAVoltage){
        if($EAVoltage == "220V"){
            $this->source = new Source220V();
            return $this->source->output("220V");
        }
        if($EAVoltage == "5V"){
            $this->source = new Source5V();
            return $this->source->output("5V");
        }
        return false;
    }
}

/*
 * 角色；使用类
 * 笔记本 
 */
class NoteBook {
    const VOLTAGE = "5V";
    /*
     * 开机
     */
    public function powerOn(){
        $source = new Adapter220V();
        if($source->output(self::VOLTAGE) == self::VOLTAGE){//采用output方法无需关注实现细节
            return true;
        }else{
            return false;
        } 
    }
}

$noteBook = new NoteBook;
var_dump($noteBook->powerOn());//bool(true)