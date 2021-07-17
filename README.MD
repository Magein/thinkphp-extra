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
//放在路由的最后一条，当找前面的控制器都找不到的时候，再去匹配
Route::rule('admin/:controller/:action', 'admin.view/:action');
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

4. localhost.xx.com/admin/view/user/lists?page_id=1 即可获得user表中的数据，搜索参数会根据use.php中的query过滤

 ```json
{
  "code": 0,
  "msg": "",
  "data": [
    {
      "id": 1,
      "username": "1233",
      "password": "455",
      "phone": "12321",
      "email": "1",
      "sex": 0,
      "status": 0,
      "create_time": 1
    },
    {
      "id": 2,
      "username": "2323",
      "password": "3232",
      "phone": "32",
      "email": "3232",
      "sex": 0,
      "status": 0,
      "create_time": 32
    },
    {
      "id": 3,
      "username": "12312321313",
      "password": "12312313",
      "phone": "15956946055",
      "email": "",
      "sex": 0,
      "status": 0,
      "create_time": 1626504091
    },
    {
      "id": 11,
      "username": "123123213131",
      "password": "12312313",
      "phone": "15956946054",
      "email": "1334@qq.com",
      "sex": 0,
      "status": 0,
      "create_time": 1626505332
    },
    {
      "id": 12,
      "username": "1231232131311",
      "password": "12312313",
      "phone": "15956946053",
      "email": "",
      "sex": 0,
      "status": 0,
      "create_time": 1626506485
    }
  ]
}
```

5. 声明的方法

| 名称 | 请求类型 | 描述 |  url  |
| :-----| ----: | :----: | :----: |
| get | get | 获取单条记录 需要传递id | admin/view/user/get?id=1 |
| lists | get | 设置page表示分页，获取15条数据，查询直接携带即可 | admin/view/user/lists?page=1|
| post | post | 新增数据 | admin/view/user/post  |
| put | put | 更新数据 | admin/view/user/put  |
| delete | delete | 删除数据 |   admin/view/user/delete?id=1  |
| recovery | patch | 恢复数据 |  admin/view/user/delete?id=1  |

6. 当一个类继承了ViewController就获取了resetful规范下的curd操作，当然你可以可以继承重写，只要满足进入__call的条件

