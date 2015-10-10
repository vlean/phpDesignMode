<?php
/**
 * 单例模式
 *
 * 控制类型的唯一性
 * 拥有私有构造函数，确保无法通过new实例它
 *
 */


class Logger
{
    //私有静态变量存储产生的对象实例
    private static $instance;

    //业务变量，保存日志写入路径
    private $logDir;

    //无参构造方法，不允许被外部实例化
    private function __construct()
    {
        echo "new Logger instance \n";//实例化检测
        $logDir = sys_get_temp_dir() .DIRECTORY_SEPARATOR ."testSingleLogs";

        if(!is_dir($logDir)  || !file_exists($logDir))
        {
            @mkdir($logDir);
        }

        $this->logDir = $logDir;
    }

    //类唯一实例的全局访问点，用于判断并返回实例
    public static function getInstance()
    {
        if(is_null(self::$instance))
        {
            $class = __CLASS__;//获取本对象的类名
            self::$instance = new $class;
        }

        return self::$instance;
    }

    //重载__clone 方法，不允许对象实例被克隆
    public function __clone()
    {
        throw new Exception("Singleton class  can not  be cloned.");
    }

    //其他业务逻辑
    public function log($message,$level="debug")
    {
        $logFile = $this->logDir .DIRECTORY_SEPARATOR . "info.log";
        $msg =sprintf("[%s] %s \n",$level,$message);

        error_log($msg,3,$logFile);
    }
}
