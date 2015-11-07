<?php
/**
 * 注册器模式
 *
 * 存储各种类的实例,防止重复创建实例浪费资源
 *
 * 注册类包含一个静态数组变量,以键值数组方式存储被注册的实例,
 * 键值对应实例名,值对应实例.
 *
 * 可以和单例模式结合使用
 */

class Register
{
    private static $_objs =array();//静态数组

    /**
     * _set 注册实例到静态数组
     *
     * @param mixed $name 实例名称
     * @param mixed $obj 实例
     * @static
     * @access public
     * @return void
     */
    public static function _set($name,$obj)
    {
        if(!isset(self::$_objs[$name])){
            self::$_objs[$name]=$obj;
        }
        return true;
    }

    /**
     * _unset 删除实例从静态数组
     *
     * @param mixed $name 实例名称
     * @static
     * @access public
     * @return void
     */
    public static function _unset($name)
    {
        if(isset(self::$_objs[$name])){
            unset(self::$_objs[$name]);
        }
        return true;
    }

    /**
     * _get 获取指定注册实例
     *
     * @param mixed $name 实例名称
     * @static
     * @access public
     * @return void
     */
    public static function _get($name)
    {
        if(isset(self::$_objs[$name])){
            return self::$_objs[$name];
        }
        return false;
    }
}


//--------------------------------
//测试
//--------------------------------


class test
{
    public function say()
    {
        echo "in Register test";
    }
}


Register::_set('test',new test);
Register::_get("test")->say();
