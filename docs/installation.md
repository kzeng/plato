# 安装


### 安装
1. 拉取项目代码
   `git clone https://gitee.com/kzeng/plato.git website_dir`

    `composer install`


***注意：***
代码拉取后，
1. `cd website_gir`
2. `./init` 初始化项目
3. 数据库迁移命令执行顺序：
   `./yii migrate --migrationPath=@mdm/admin/migrations` 
   `./yii migrate --migrationPath=@yii/rbac/migrations`
   `./yii migrate` 

### 集成与配置

#### 后台主题 AdminLTE
[官方文档](https://adminlte.io/)
[安装配置]( https://blog.csdn.net/qq_23943147/article/details/78538658 )

#### 权限管理RBAC
[安装配置]( https://www.kancloud.cn/curder/yii/247759 )


### 运行


