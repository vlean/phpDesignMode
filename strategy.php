<?php
/**
 * 策略模式
 *
 * 定义了算法族,分别封装起来,让它们之间可以相互替换,
 * 此模式让算法的变化独立于使用算法的客户.
 */

/**
 * Duck类有Fly和Quack两种行为,Fly和Quack又分别有不同的实现方式
 */

/**
 * Fly接口
 * 定义一个fly方法
 * 所有Fly行为都实现了此接口
 */
interface FlyBehavior
{
    function fly();
}


class FlyWithWings implements FlyBehavior
{
    public function fly()
    {
        echo "翅膀飞~\n";
    }
}

class FlyNoWay implements FlyBehavior
{
    public function fly()
    {
        echo "不会飞~\n";
    }
}

/**
 * Quack接口
 * 定义一个quack方法
 * 所有Quack行为都实现了此接口
 */
interface QuackBehavior
{
    function quack();
}

class Quacks implements QuackBehavior
{
    public function quack()
    {
        echo "呱呱~\n";
    }
}

class Squeak implements QuackBehavior
{
    public function quack()
    {
        echo "吱吱~\n";
    }
}

class MuteQuack implements QuackBehavior
{
    public function quack()
    {
        echo "...\n";
    }
}


/**
 * Duck类
 */

abstract class Duck
{
    protected $flyBehavior="";
    protected  $quackBehavior="";
    protected $name ="";

    public function display()
    {
        echo $this->name;
    }

    public function peformFly()
    {
        $this->flyBehavior->fly();
    }

    public function peformQuack()
    {
        $this->quackBehavior->quack();
    }

    public function setFlyBehavior(FlyBehavior $flyBehavior)
    {
        $this->flyBehavior = $flyBehavior;
    }

    public function setQuackBehavior(QuackBehavior $quackBehavior)
    {
        $this->quackBehavior = $quackBehavior;
    }
}

/**
 * 具体产品
 */
class RubberDuck extends Duck
{
    public function __construct()
    {
        $this->flyBehavior = new FlyNoWay;
        $this->quackBehavior = new MuteQuack;
        $this->name = "橡皮鸭\n";
    }
}

class RedHeadDuck extends Duck
{
    public function __construct()
    {
        $this->flyBehavior = new FlyWithWings;
        $this->quackBehavior = new Quacks;
        $this->name = "红头鸭\n";
    }
}

class MallardDuck extends Duck
{
    public function __construct()
    {
        $this->flyBehavior = new FlyWithWings;
        $this->quackBehavior = new Squeak;
        $this->name = "绿头鸭\n";
    }
}



//---------------------------------------
//测试上面的代码
//---------------------------------------

$rubberDuck = new RubberDuck;
$redHeadDuck = new RedHeadDuck;
$mallardDuck = new MallardDuck;


//依次执行行为
$rubberDuck->display();
$rubberDuck->peformFly();
$rubberDuck->peformQuack();

//更改行为
$rubberDuck->setFlyBehavior(new FlyWithWings);
$rubberDuck->setQuackBehavior(new Quacks);

//执行更改后的行为
$rubberDuck->peformFly();
$rubberDuck->peformQuack();

