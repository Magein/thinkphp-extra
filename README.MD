### 简介

thinkphp6系列的扩展文件

### 文件列表

Logic 常用的业务基类

Model 常用的模型基类

Migrate 创建数据库的工具类，使用了面向对象的模式

MsgContainer 消息容器

ApiException 异常捕获器

### 消息容器、异常捕获器

在logic的save方法中验证类抛出的是异常，会在ApiException中获取然后返回给前端

MsgContainer仅仅是记录类中的各种参数错误，然后返回

区别就是 消息容器不会终止代码继续往下执行，列如if else的逻辑中

使用了抛出异常的方式在不使用try catch捕获的情况下，会走到ApiException、最后交给thinkphp的内部处理方法

这种在某个业务中是不友好的，if else 的情况下 如果返回的是false（参数验证不通过）我要继续往下进行相关的业务

#### Resetful 请求

view目录下面是快速请求数据，设计思路是直通数据库

banner图、商品分类、配置信息、等等一般都是 表格，表单进行curd操作，这些数据不经常更新，但是有很重要

他是主要的业务逻辑组成部分,但是日常开发中需要写接口，写文档，写业务代码，很繁琐,

常规的curd操作可以通过view实现

1. 添加路由

```php
Route::rule('admin/view/:name/:action', 'admin.view/:name.:action');
```

2. 访问路径 localhost.xx.com/admin/view/user/lists?page_id=1&sex=1

访问admin目录下的view控制器

```php

use magein\thinkphp_extra\view\ViewController;

class View extends ViewController
{
    protected $middleware = [];
    
    // 指定安全参数文件的命令空间
    protected $namespace='view';
}
```

3. 设置请求的安全参数

在根目录的extend目录下创建view目录，然后新建一个文件，如user

 ```php
namespace view;

use app\components\system\system_user\SystemUser;
use magein\thinkphp_extra\view\DataSecurity;

class User extends DataSecurity
{
    // 使用的业务类 跟数据库直通的关系
    protected $logic = SystemUser::class;

    // 暴露给前端的数据
    protected $fields = [];

    //  查询字段以及表达式 默认是等于
    protected $query = [
        'id',
        'username',
    ];

    // 允许插入的数据,一般是新增，更新请通过put设置，如创建时间，订单编号，商品编号等等，一般新增后就不能修改了
    protected $post = [
        'username',
        'phone',
        'password',
        'confirm',
    ];

    // 允许更新的字段
    protected $put = [
        'sex',
    ];
}
```

 

