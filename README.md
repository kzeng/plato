# 项目代号：柏拉图 PLATO

##  项目描述
智慧云图书馆： 能支撑智慧图书馆服务体系的图书馆管理与服务平台。  

![仪表盘](https://s2.ax1x.com/2019/07/23/eA8i4g.png)
![eA8kCQ.png](https://s2.ax1x.com/2019/07/23/eA8kCQ.png)
![eA8PUS.png](https://s2.ax1x.com/2019/07/23/eA8PUS.png)

## 平台优势
* 总分馆架构：不再是信息的孤岛，而是共享信息的平台。
* 友好的界面：通过简洁易用的平台界面，提高工作效率。
* 智能的平台：不仅仅是管理平台，更是智能的连接和服务平台。
* 服务大数据：拥有的不再是沉睡的数据，而是鲜活的知识金矿。
* 丰富的接口：灵活丰富强大的接口让一切皆有可能。

## 系统功能概述



### 总分馆架构
1. 总分馆架构为一个树形结构。
2. 根为`顶层总馆`，可以是一个`虚拟单元`，不涉及具体业务仅用于创建和管理它的直系分馆并制定统一规则。
3. 每个图书馆都可创建和管理它的直系分馆，对于它的分馆们(互为`兄弟馆`)，它是`中心馆`。
4. 可以是多层（大于两层的）结构。
5. 各馆有管理员账号，其管理员可创建多名不同角色用户，用于处理本馆不同业务。
   

### 系统管理
1. 管理馆藏地信息
2. 管理书商信息
3. 管理阅览室信息
4. 管理违章类型信息
5. 管理书籍的流通类型
6. 管理读者类型信息
7. 管理借阅规则

### DashBoard 仪表盘
1. 提供图书馆关键统计数据
2. 为管理员提供快捷的业务入口

### 流通管理
1. 管理本图书馆的读者信息、读者证件信息。
2. 对读者在本馆违章类型对应的违章记录进行处理。
3. 对读者违章或者借书超期产生的欠费进行处理。

### 馆藏信息
1. 馆藏图书及复本信息录入
2. 书目检索
3. 直接编目功能,可以根据ISBN或者书目ID进行查询。

### 流通借阅
1. 图书馆工作人员可以通过手动输入读者卡号或者读者直接刷卡，来识别读者信息。
2. 图书馆工作人员可以通过手动输入书籍条码号或者用扫码器扫描书籍条码号，来处理书籍的借阅或者归还。
3. 如果读者在还书时有欠费，读者可以选择当场缴费。
4. 在阅览室登到中，图书馆工作人员可以记录当天进入各个阅览室的读者。

---
### 统计分析
* 读者借书数量统计
* 书籍馆藏数量
* 书籍流通统计
* 借阅排行榜

### REST API
* 为移动端提供业务接口
* 为借还书设备提供业务接口
* 为第三方提供业务接口



---
## 开发文档
[安装指南](https://github.com/kzeng/plato/blob/master/docs/installation.md)

[软件结构](https://github.com/kzeng/plato/blob/master/docs/structure.md)

[数据库设计](https://github.com/kzeng/plato/blob/master/docs/database.md)


