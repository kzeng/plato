## 权限(RBAC)配置

### 介绍
RBAC
Role Based Access Control
基于角色的权限控制

* 权限控制基于路由
* 权限包含路由和子权限
* 角色包含路由、权限和子角色

* 可以给用户分配路由、权限和角色

* 菜单层级展示
* 父级菜单(有子级菜单)可以没有链接
* 子级菜单必须指定链接

### 操作步骤
权限结点建立
* 打开 http://plato.beesoft.ink/admin/route 添加所有需要做权限控制的路由
  * 左边是系统可用但没有接受权限控制的路由列表
  * 右边是接受权限控制的路由列表
* 打开 http://plato.beesoft.ink/admin/permission 操作权限
  * 权限可以包含路由和子权限
  * 在查看中指定子级
* 打开 http://plato.beesoft.ink/admin/role 操作角色
  * 角色可以包含路由、权限和子角色
  * 在查看中指定子级

权限分配
* 打开 http://plato.beesoft.ink/admin/assignment 分配权限
  * 可以给用户分配路由、权限和子角色
  * 在查看中指定权限

菜单建立
* 打开 http://plato.beesoft.ink/admin/menu 操作菜单
  * 菜单层级展示
  * 父级菜单(有子级菜单)可以没有链接
  * 子级菜单必须指定链接

### 菜单(路由)
* http://plato.beesoft.ink/admin/route 路由 汇总了系统所有路由，将其纳入到权限控制
* http://plato.beesoft.ink/admin/permission # 权限 可以包含路由和其它权限
* http://plato.beesoft.ink/admin/role # 角色 可以包含路由、权限、和子角色
* http://plato.beesoft.ink/admin/assignment # 用户权限分配 可以分配路由、权限和角色
* http://plato.beesoft.ink/admin/user # 用户管理
* http://plato.beesoft.ink/admin/menu # 菜单 层级的一套菜单
* http://plato.beesoft.ink/admin/rule # 规则

### 数据表
* auth_item 验证项 路由(type=2 name以"/"开始)&权限(type=2 name不以"/"开始)&角色(type=1)
* auth_item_child 验证项关系 auth_item层次关系 权限可以包含路由和子权限 角色可以包含路由、权限和子角色
* auth_assignment 权限分配 权限项和用户关系
* user 用户
* menu 菜单
* auth_rule 规则
