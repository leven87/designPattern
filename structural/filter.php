<?php
/*
 * 过滤器方法模式示例
 */

preg_match("/cli/i", php_sapi_name()) ? define('LINE_BREAK', PHP_EOL) : define('LINE_BREAK', "<br/>");

/*
 * 角色：待过滤数据类
 * 找工作者
 */
class JobSeeker
{
    private $_name;
    private $_age;
    private $_sex;
    private $_working_years;
    private $_skills;
    
    public function __construct($name,$age,$sex,$working_years,$skills) {
        $this->_name = $name;
        $this->_age = $age;
        $this->_sex = $sex;
        $this->_working_years = $working_years;
        $this->_skills = $skills;
    }

    public function getName(){
        return $this->_name;
    }    
    public function getAge(){
        return $this->_age;
    }
    public function getSex(){
        return $this->_sex;
    }
    public function getWorkingYears(){
        return $this->_working_years;
    }
    public function getSkills(){
        return $this->_skills;
    }    
}


/*
 *用来过滤的接口类 
 */
interface Criteria{
    public function meetCriteria( $job_seekers);
} 

/*
 * 角色：过滤器
 * 只需要男性的过滤类
 */

class CriteriaMale implements Criteria{
    public function meetCriteria( $job_seekers) {
        if(empty($job_seekers))
            return null;
        $job_seekers_criteria_male = array();
        foreach($job_seekers as $job_seeker){
            if($job_seeker->getSex() == "male")
                $job_seekers_criteria_male[] = $job_seeker;
        }
        return $job_seekers_criteria_male;
    }
}

/*
 * 角色：过滤器
 * 年龄区间的过滤器
 */
class CriteriaAge implements Criteria{
    private $_min = 18;
    private $_max;
    public function __construct($min,$max) {
        $this->_min = $min;
        $this->_max = $max;
    }
    public function meetCriteria( $job_seekers){
        $job_seekers_criteria_age = array();
        foreach($job_seekers as $job_seek){
            $age = $job_seek->getAge();
            if(is_int($age) && $age >= $this->_min && $age <= $this->_max){
                $job_seekers_criteria_age[] = $job_seek;
            }
        }
        return $job_seekers_criteria_age;
    }
}

/*
 * 角色：逻辑过滤器
 * AND过滤器
 */
class CriteriaAnd implements Criteria{
    private $_criteria;
    private $_another_criteria;
    
    public function __construct($criteria,$another_criteria) {
        $this->_criteria = $criteria;
        $this->_another_criteria = $another_criteria;
    }
    public function meetCriteria( $job_seekers) {
        $firstCriteriaPersons = $this->_criteria->meetCriteria($job_seekers);
        return $this->_another_criteria->meetCriteria($firstCriteriaPersons);
    }
}

/*
 * 打印筛选后人资料，与设计模式无关
 */
function printPerson($job_seekers){
    if(empty($job_seekers)){
        echo "".LINE_BREAK;return;
    }
    foreach($job_seekers as $job_seeker){
        printf("Person : [ Name : %s , Age : %s , Sex : %s , Working Years : %s , Skills : %s ]".LINE_BREAK,$job_seeker->getName(),$job_seeker->getAge(),$job_seeker->getSex(),$job_seeker->getWorkingYears(),$job_seeker->getSkills());
    }
    
}
/*
 * 角色：使用者
 * 实际中就是HR。。。
 */
$job_seekers = array();
$job_seekers[] = new JobSeeker("xiao wang", 31, "male", 8, "php");
$job_seekers[] = new JobSeeker("xiao li", 25, "male", 2, "java");
$job_seekers[] = new JobSeeker("xiao zhan", 26, "female", 3, "test");
$job_seekers[] = new JobSeeker("xiao huang", 28, "male", 4, "python");
$job_seekers[] = new JobSeeker("xiao huang", 22, "male", 0, "c");

$male = new CriteriaMale();
$age_under_30 = new CriteriaAge(18,30);
$male_and_age_under_30 = new CriteriaAnd($male,$age_under_30);

echo "Males:".LINE_BREAK;
printPerson($male->meetCriteria($job_seekers));
echo "Age Under 30:".LINE_BREAK;
printPerson($age_under_30->meetCriteria($job_seekers));
echo "Males And Age Under 30:".LINE_BREAK;
printPerson($male_and_age_under_30->meetCriteria($job_seekers));
/*
 Males:
Person : [ Name : xiao wang , Age : 31 , Sex : male , Working Years : 8 , Skills : php ]
Person : [ Name : xiao li , Age : 25 , Sex : male , Working Years : 2 , Skills : java ]
Person : [ Name : xiao huang , Age : 28 , Sex : male , Working Years : 4 , Skills : python ]
Person : [ Name : xiao huang , Age : 22 , Sex : male , Working Years : 0 , Skills : c ]
Age Under 30:
Person : [ Name : xiao li , Age : 25 , Sex : male , Working Years : 2 , Skills : java ]
Person : [ Name : xiao zhan , Age : 26 , Sex : female , Working Years : 3 , Skills : test ]
Person : [ Name : xiao huang , Age : 28 , Sex : male , Working Years : 4 , Skills : python ]
Person : [ Name : xiao huang , Age : 22 , Sex : male , Working Years : 0 , Skills : c ]
Males And Age Under 30:
Person : [ Name : xiao li , Age : 25 , Sex : male , Working Years : 2 , Skills : java ]
Person : [ Name : xiao huang , Age : 28 , Sex : male , Working Years : 4 , Skills : python ]
Person : [ Name : xiao huang , Age : 22 , Sex : male , Working Years : 0 , Skills : c ]
 */