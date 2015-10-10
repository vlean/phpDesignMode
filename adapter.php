<?php

/**
 * 适配者模式
 *
 * 1.提供框架或外部接口，某个底层功能有多个具体实现方式时，给外部提供统一接口
 * 2.已有成熟系统基础上，与其他项目合作，进行数据交互，底层数据基本一致，但在命名和结构上有差异时
 *
 * 被适配者（Adaptee）: Memcache对象、APC对象
 * 适配目标（Target）: CacheInterface
 * 适配器（Adapter）: ApcAdapter、MemcaceAdapter
 *
 */

//提供统一的缓存接口，即适配目标
interface CacheInterface
{
    public function set($key,$value,$expire=86400);
    public function get($key);
    public function delete($key);
    public function flush();
    //其他业务逻辑
}


//实现适配器
//实现Apc适配器
class ApcAdapter implements CacheInterface
{
    //加入运行时缓存，实现一次运行过程中多次读取缓存数据，不用调用底层服务，就能直接返回数据
    private $runningCache = array();

    public function set($key, $value, $expire=0)
    {
        $res= apc_store($key, $value,$expire);
        if($res)
            $this->runningCache[$key]= $value;
        return $res;
    }

    public function get($key)
    {
        if(isset($this->runningCache[$key]))
            return $this->runningCache[$key];
        return apc_fetch($key);
    }

    public function delete($key)
    {
        $res= apc_delete($key);
        if($res)
            unset($this->runningCache[$key])
        return $res;
    }

    public function flush()
    {
        $res= apc_clear_cache("user");
        if($res)
            $this->runningCache = array();
        return $res;
    }
}

//Memcache适配器实现
class MemcacheAdapter implements CacheInterface
{
    private $runningCache = array();
    private $memcache;//Memcache对象实例

    public function __construct()
    {
        $memcache = new Memcache;
        $memcache->connect("memcache_host",11211);
        $this->memcache = $memcache;
    }

    public function set($key,$value,$expire=0)
    {
        $res=$this->memcache->set($key,$value,$expire);
        if($res)
            $this->runningCache[$key]=$value;
        return $res;
    }

    public function get($key)
    {
        if(isset($this->runningCache[$key]))
            return $this->runningCache[$key];
        return $this->memcache->get($key);
    }

    public function delete($key)
    {
        $res = $this->memcache->delete($key);
        if($res)
            unset($this->runningCache[$key]);
        return $res;
    }

    public function flush()
    {
        $res = $this->memcache->flush();
        if($res)
            $this->runningCache=array();
        return $res;
    }
}


//工厂模式返回cache实例
class CacheFactory
{
    private static $instance;

    public static function getInstance()
    {
        if(is_null(self::$instance))
        {
            if(CACHE_TYPE =='APC')
                self::$instance = new ApcAdapter();
            elseif(CACHE_TYPE=='Memcache')
                self::$instance = new MemcacheAdapter();
        }
        return self::$instance;
    }
}


//实际调用
$cachekey= "data_123";
$cache = CacheFactory::getInstance();
$data = $cache->get($cachekey);
if($data===false)
{
    //其他操作
}



