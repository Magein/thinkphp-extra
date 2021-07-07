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