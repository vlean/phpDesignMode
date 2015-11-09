<?php
/**
 * 代理模式
 *
 */

class source
{
    public function showMsg($msg)
    {
        echo $msg;
    }
}




class proxy extends source
{
    private $instance;

    public function __construct()
    {
        $this->instance = new parent;
    }

    public function showMsg($msg)
    {
        self::before();
        $this->instance->showMsg($msg);
        self::after();
    }

    public function before()
    {
        echo "<pre>";
    }

    public function after()
    {
        echo "</pre>";
    }
}




//------------------------------
//测试
//-----------------------------

$px = new proxy;
$px->showMsg("test");
