# 安装


### 安装


1. 拉取项目代码
   * `git clone https://gitee.com/kzeng/plato.git website_dir`
    * `composer install`
  >如果composer速度慢，换源：

  > `composer config repo.packagist composer https://packagist.laravel-china.org`


***注意：***
1. 代码拉取后，初始化项目 
   * `cd website_gir`
   * `init` 
2. 数据库迁移命令执行顺序：
   * `yii migrate --migrationPath=@mdm/admin/migrations`  *RBAC建表*
   * `yii migrate --migrationPath=@yii/rbac/migrations` *RBAC建表*
   * `yii migrate --migrationPath=vendor/pendalf89/yii2-filemanager/migrations` *Yii2 文件管理器*
   * `yii migrate` 图书馆系统建表
   * `yii hello/import-books-info` *导入图书DEMO信息*

### 集成与配置


### 图书封面采集
采集命令会按照`book`中isbn 字段从亚马逊图书库中抓取图书封面地址，并存入`book.cover_img`字段。
* 启动ppython 服务
  `python common\ppython\python\php_python.py`

* 运行采集命令
  `yii hello/getimgs`
*注意：采集频度持续过高，会采集失败，待解决。*


#### 后台主题 AdminLTE
[官方文档](https://adminlte.io/)
[安装配置]( https://blog.csdn.net/qq_23943147/article/details/78538658 )

#### 权限管理RBAC
[安装配置]( https://www.kancloud.cn/curder/yii/247759 )


### 运行


