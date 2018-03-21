# honray-apilib
注释自动生成api文档模块

## 说明

根据TP5的资源路由restful风格，自动生成文档等功能；

 - restful风格处理请求
 > 每个接口对于一个控制器，method对应[method]Response方法响应
 
 - 文档生成
 > 简洁，优雅，不需要额外的文档工具;

 ## 相关依赖
 - [PHP5.4+]()
 - [ThinkPHP5.0.x](https://github.com/top-think/think) 基础框架
 - [Hadmin](https://git.oschina.net/liushoukun/hadmin.git) hAdmin是一个免费的后台管理模版,该模版基于bootstrap与jQuery制作，集成了众多常用插件，基本满足日常后台需要,修改时可根据自身需求;

 ## 目录结构


~~~
apilib
├─application           应用目录
│  ├─apilib             apilib目录
│  │  ├─Common.php      公共类库基础Rest
│  │  ├─BaseDoc.php     文档生成展示
│  │  ├─Behavior.php    行为类
│  │  └─ ...            

~~~

## 使用
#### 1. 导入数据库表oa_admin_doc
表为自关联结构，parent为上级ID。层级为两层。如下测试数据。
```
CREATE TABLE `oa_admin_doc` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '主键',
  `name` varchar(30) DEFAULT '' COMMENT '菜单名称',
  `parent` int(11) DEFAULT '0' COMMENT '上级ID',
  `module` varchar(30) DEFAULT '' COMMENT '模块',
  `controller` varchar(30) DEFAULT '' COMMENT '控制器',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='接口文档表';

LOCK TABLES `oa_admin_doc` WRITE;
/*!40000 ALTER TABLE `oa_admin_doc` DISABLE KEYS */;

INSERT INTO `oa_admin_doc` (`id`, `name`, `parent`, `module`, `controller`)
VALUES
    (1,'管理模块',0,'',''),
    (2,'用户接口',1,'admin','Users');
```

#### 2. 移动index.php文件到项目根目录，而非public
```
// 应用目录
define('APP_PATH', __DIR__.'/apps/');
// 加载框架引导文件
require './thinkphp/start.php';

```

#### 3. 配置config.php默认访问路径
```
// 默认模块名
'default_module'         => 'admin',
// 禁止访问模块
'deny_module_list'       => ['common'],
// 默认控制器名
'default_controller'     => 'doc',
// 默认操作名
'default_action'         => 'apiList',
// 默认验证器
'default_validate'       => '',
// 默认的空控制器名
'empty_controller'       => 'Error',
// 操作方法后缀
'action_suffix'          => '',
// 自动搜索控制器
'controller_auto_search' => false,
```

#### 4. 把对应的文件对应复制到框架下


#### 5. 控制器注释
1，控制器类头加上如下注释
```php
/**
 * @title 用户接口
 */
class User extends Common{}
```


|参数|必须|备注|作用|
|:---:|:---:|:---:|:---:|
|title|true|接口标题|显示列表名称|

- 具体接口文档

2.接口描述信息(注释填写)
 
 
```php
    /**
    * @title 新增用户
    * @url admin/users
    * @method post
    * @param string —name 用户名称
    * @param string —remark 备注
    * 
    * @return number code 200正确400错误
    * @return string error  错误信息
    * @return string data 返回信息
    */ 
    public function index(){}

```

|参数|必须|备注|作用|
|:---:|:---:|:---:|:---:|
|title|true|接口标题|显示列表名称|
|url|true|访问接口|显示链接地址|
|method|true|请求方法|get，post，put，delete|
|param|true|请求参数|显示参数|
|return|true|返回参数|返回参数|

![return](./public/doc/demo.png)
![return](./public/doc/demo2.png)
