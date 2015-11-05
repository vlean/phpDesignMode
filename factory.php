<?php
/**
 * 工厂模式
 *
 * 定义一个用于创建对象的接口，让子类决定实例化哪一个类
 *
 * 主要角色：
 * 抽象产品(Product)角色：具体产品共用的类或对象
 * 具体产品(Concrete Product)角色：实现抽象产品中定义的接口，并且工厂模式所创建的
 *          每一对象都是具体产品对象的实例
 * 抽象工厂(Creator)角色：模式中任何创建工厂的类都要实现这个接口，它声明了工厂方
 *          法并返回一个Product类型对象
 * 具体工厂(Concrete Creator)角色：实例化工厂接口，具体工厂角色与业务逻辑相关，由
 *          程序直接调用以创建产品对象
 *
 * 根据抽象程度不同，分为简单工厂模式，工厂方法模式，抽象工厂模式
 */

/**
 * 简单工厂模式
 */
namespace tk\simpleFactory;

interface animal
{
    function say();
}

class dog implements animal
{
    public function say()
    {
        echo "汪\n";
    }
}

class cat implements animal
{
    public function say()
    {
        echo "喵\n";
    }
}

//工厂
class simpleFactory
{
    private static $instance;

    public static function getInstance()
    {
        if(is_null(self::$instance)){
            if(ANIMAL=='dog'){
                self::$instance = new dog();
            }elseif(ANIMAL=='cat'){
                self::$instance = new cat();
            }
        }
        return self::$instance;
    }
}


//--------------------------
//测试
//--------------------------

define("ANIMAL","dog");
$animal = simpleFactory::getInstance();
$animal->say();


/**
 * 工厂方法模式
 */

namespace tk\basicFactory;

interface animal
{
    function say();
}

class dog implements animal
{
    public function say()
    {
        echo "汪\n";
    }
}

class cat implements animal
{
    public function say()
    {
        echo "喵\n";
    }
}

//工厂
interface helloAnimal
{
    function hello();
}

class factoryAnimal1 implements helloAnimal
{
    private static $instance;
    public function hello()
    {
        if(is_null(self::$instance)){
            if(ANIMAL1=='dog')
                self::$instance = new dog();
        }
        return self::$instance;
    }
}

class factoryAnimal2 implements helloAnimal
{
     private static $instance;
     public function hello()
     {
         if(is_null(self::$instance)){
             if(ANIMAL2=='cat')
                 self::$instance = new cat();
         }
         return self::$instance;
     }
}


//----------------------------
//测试
//----------------------------
define("ANIMAL1","dog");
$animal = factoryAnimal1::hello();
$animal->say();

/**
 * 抽象工厂模式
 */
namespace tk\abstractFactory;

interface animal
{
    function say();
}

class dog implements animal
{
    public function say()
    {
         echo "汪\n";
    }
}

class cat implements animal
{
    public function say()
    {
         echo "喵\n";
    }
}



class whale implements animal
{
    public function say()
    {
        echo "噗\n";
    }
}

class fish implements animal
{
    public function say()
    {
        echo "呜\n";
    }
}
//工厂
interface helloAnimal
{
    function helloLandAnimal();
    function helloAquaticAnimal();
}

class helloAllAnimal implements helloAnimal
{
     public function helloLandAnimal()
     {
         if(LAND_ANIMAL =="dog")
             return new dog;
         elseif(LAND_ANIMAL=="cat")
             return new cat;
     }
     public function helloAquaticAnimal()
     {
         if(AQUATIC_ANIMAL=="whale")
             return new whale;
         elseif(AQUATIC_ANIMAL=="fish")
             return new fish;
     }
}


//-------------------------
//测试
//-------------------------

define("LAND_ANIMAL","cat");
define("AQUATIC_ANIMAL","fish");

$animal = new helloAllAnimal;
$landAnimal = $animal->helloLandAnimal();
$landAnimal->say();
$aquaticAnimal = $animal->helloAquaticAnimal();
$aquaticAnimal->say();



/**
 * 简单工厂：生产同一等级结构中的任意产品，对增加新的产品为力
 * 工厂模式：生产同一等级中的固定产品，支持增加任意产品
 * 抽象工厂：生产不同产品族中的任意产品，对增加新的产品无力，支持增加新的产品族
 */
