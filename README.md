
# php设计模式


## 单例模式
`single.php`


**特点**
- 业务上只需要一个实例
- 拥有私有构造函数，确保无法通过new实例它


**参考**

> [php设计模式之单例模式](http://blog.samoay.me/post/view/13)


## 适配器模式

`adapter.php`

**特点**

- 为对象提供统一的接口


**参考**

> [设计模式（五）适配器模式Adapter（结构型）](http://blog.csdn.net/hguisu/article/details/7527842)
> [PHP设计模式之适配器模式(Adapter)](http://blog.samoay.me/post/view/14)


## 工厂模式

`factory`

特点
- 使用工厂创建类对象，而不直接使用`new`
- 为创建一组相关或相互依赖的对象提供一个接口，而且无需指定它们的具体类

参考

> [PHP简单工厂、工厂模式和抽象工厂模式的比较](http://www.phpddt.com/php/php-factory.html)

##策略模式

`strategy`

特点

- 定义了算法族,分别封装起来,让它们之间可以相互替换
- 让算法的变化独立于使用算法的客户
