# 数据库设计
> v1.0.0.20190622

---
####  图书馆 `library`
智慧云图书馆

字段名|数据类型|长度|可空|主键|注释
-----|-----|-----|-----|-----|-----|
id      |int    |11     |否     |是     |主键ID
title      |string    |128     |否     |-     |名称
mobile      |string    |32     |是     |-     |电话
address      |string    |128     |是     |-     |地址
pid      |int    |11     |否     |是     |父ID
user_id      |int    |11     |否     |-     |操作员ID
created_at       |int    |11     |否     |-     |创建时间
updated_at       |int    |11     |否     |-     |更新时间
status       |int    |11     |否     |-     |状态, 默认值1


---
####  图书馆管理员 `user`

字段名|数据类型|长度|可空|主键|注释
-----|-----|-----|-----|-----|-----|
id      |int    |11     |否     |是     |主键ID
user_name      |string    |64     |否     |-     |名称
mobile      |string    |32     |是     |-     |电话
auth_key      |string    |32     |-    |-     |-
access_token      |string    |32     |-     |-     |-
password_hash      |string    |64     |否     |-     |-
oauth_client      |string    |64     |是     |-     |-
oauth_client_user_id      |string    |64     |是     |-     |-
email      |string    |64     |是     |-     |邮箱
library_id      |int    |11     |否     |-     |图书馆ID
user_id      |int    |11     |否     |-     |操作员ID
created_at       |int    |11     |否     |-     |创建时间
updated_at       |int    |11     |否     |-     |更新时间
status       |int    |11     |否     |-     |状态, 默认值1

---
#### 读者 `reader`
> 记录读者信息

字段名|数据类型|长度|可空|主键|注释
-----|-----|-----|-----|-----|-----|
id      |int    |11     |否     |是     |主键ID
card_number      |string    |64     |否     |-     |卡号
card_status      |int    |11     |否     |-     |证件状态（默认正常0，挂失1）
reader_name      |string    |64     |否     |-     |姓名
validity      |int    |11     |否     |-     |有效期限
id_card      |string    |64     |否     |-     |身份证
reader_type_id      |int    |11     |否     |-     |读者类型
gender      |int    |11     |否     |-     |性别
deposit      |decimal    |2     |否     |-     |押金(元)
creditmoney      |decimal    |2     |否     |-     |欠费金额(元)
mobile      |string    |32     |是     |-     |电话
address      |string    |128     |是     |-     |地址
library_id      |int    |11     |否     |-     |图书馆ID
user_id      |int    |11     |否     |-     |操作员ID
created_at       |int    |11     |否     |-     |创建时间
updated_at       |int    |11     |否     |-     |更新时间
status       |int    |11     |否     |-     |状态, 默认值1


---
#### 借还书表 `borrow_return_books`
> 记录借还书信息

字段名|数据类型|长度|可空|主键|注释
-----|-----|-----|-----|-----|-----|
id      |int    |11     |否     |是     |主键ID
reader_id      |int    |11     |否     |-     |读者ID
card_number      |string    |64     |否     |-     |卡号
reader_name      |string    |64     |否     |-     |姓名
bar_code      |strind    |128     |否     |-     |条码号
operation      |int    |11     |否     |-     |借还书操作0还1借
library_id      |int    |11     |否     |-     |图书馆ID
user_id      |int    |11     |否     |-     |操作员ID
created_at       |int    |11     |否     |-     |创建时间
updated_at       |int    |11     |否     |-     |更新时间
status       |int    |11     |否     |-     |状态, 默认值1


---
#### 缴纳欠费 `payment_of_debt`
> 记录读者缴纳欠费信息

字段名|数据类型|长度|可空|主键|注释
-----|-----|-----|-----|-----|-----|
id      |int    |11     |否     |是     |主键ID
card_number      |string    |64     |否     |-     |卡号
reader_name      |string    |64     |否     |-     |姓名
violation_type_id      |int    |11     |否     |-     |违章类型
payment_status      |int    |11     |否     |-     |缴费状态（未缴0， 默认已缴1）
penalty      |decimal    |2     |否     |-     |罚金(元)
description      |string    |256     |是     |-     |描述
library_id      |int    |11     |否     |-     |图书馆ID
user_id      |int    |11     |否     |-     |操作员ID
created_at       |int    |11     |否     |-     |创建时间
updated_at       |int    |11     |否     |-     |更新时间
status       |int    |11     |否     |-     |状态, 默认值1


---
#### 图书  `book`
> 图书馆典藏图书信息

字段名|数据类型|长度|可空|主键|注释
-----|-----|-----|-----|-----|-----|
id      |int    |11     |否     |是     |主键ID
title      |string    |128     |否     |-     |题名
isbn      |string    |64     |否     |-     |ISBN
cover_img      |string    |256     |-     |-     |封面
description      |string    |1024     |-     |-     |简介
author      |string    |64     |否     |-     |作者
price      |decimal    |2     |-     |-     |价格(元)
class_number      |string    |64     |-     |-     |分类号
call_number       |string    |64     |-     |-     |索书号
book_copy_number       |int    |11     |否     |-     |复本数
publisher      |string    |64     |-     |-     |出版社
publication_place     |string    |64     |-     |-     |出版地
publish_date     |string    |64     |-     |-     |出版年月
series_title     |string    |64     |-     |-     |从书名
library_id      |int    |11     |否     |-     |图书馆ID
user_id      |int    |11     |否     |-     |操作员ID
created_at       |int    |11     |否     |-     |创建时间
updated_at       |int    |11     |否     |-     |更新时间
status       |int    |11     |否     |-     |状态, 默认值1



#### 图书副本 `book_copy`
> 图书副本信息

字段名|数据类型|长度|可空|主键|注释
-----|-----|-----|-----|-----|-----|
id      |int    |11     |否     |是     |主键ID
title      |string    |128     |否     |-     |题名
bar_code      |string    |128     |否     |-     |条码号(bar_code表中来)
bookseller_id      |int    |11     |否     |-     |书商
price1      |decimal    |2     |否     |-     |实洋(元)
price2      |decimal    |2     |否     |-     |码洋(元)
collection_place_id      |int    |11     |否     |-     |馆藏地
circulation_type_id      |int    |11     |否     |-     |流通类型
call_number_rules_id      |int    |11     |否     |-     |索书号(call_number_rules表 主键ID?)
library_id      |int    |11     |否     |-     |图书馆ID
user_id      |int    |11     |否     |-     |操作员ID
created_at       |int    |11     |否     |-     |创建时间
updated_at       |int    |11     |否     |-     |更新时间
status       |int    |11     |否     |-     |状态, 默认值1

---
#### 馆藏地点 `collection_place`

字段名|数据类型|长度|可空|主键|注释
-----|-----|-----|-----|-----|-----|
id      |int    |11     |否     |是     |主键ID
title      |string    |128     |否     |-     |名称
description      |string    |256     |是     |-     |说明
library_id      |int    |11     |否     |-     |图书馆ID
user_id      |int    |11     |否     |-     |操作员ID
created_at       |int    |11     |否     |-     |创建时间
updated_at       |int    |11     |否     |-     |更新时间
status       |int    |11     |否     |-     |状态, 默认值1


---
#### 书商 `bookseller`

字段名|数据类型|长度|可空|主键|注释
-----|-----|-----|-----|-----|-----|
id      |int    |11     |否     |是     |主键ID
title      |string    |128     |否     |-     |名称
address      |string    |128     |-     |-     |地址
contact      |string    |128     |-     |-     |联系人姓名
mobile      |string    |32     |-     |-     |电话
discount      |decimal    |2     |-    |-     |折扣，如0.85
library_id      |int    |11     |-     |-     |图书馆ID
user_id      |int    |11     |否     |-     |操作员ID
created_at       |int    |11     |否     |-     |创建时间
updated_at       |int    |11     |否     |-     |更新时间
status       |int    |11     |否     |-     |状态, 默认值1


---
#### 阅览室 `reading_room`

字段名|数据类型|长度|可空|主键|注释
-----|-----|-----|-----|-----|-----|
id      |int    |11     |否     |是     |主键ID
title      |string    |128     |否     |-     |名称
description      |string    |256     |是     |-     |说明
library_id      |int    |11     |否     |-     |图书馆ID
user_id      |int    |11     |否     |-     |操作员ID
created_at       |int    |11     |否     |-     |创建时间
updated_at       |int    |11     |否     |-     |更新时间
status       |int    |11     |否     |-     |状态, 默认值1

---
#### 违章类型 `violation_type`

字段名|数据类型|长度|可空|主键|注释
-----|-----|-----|-----|-----|-----|
id      |int    |11     |否     |是     |主键ID
title      |string    |128     |否     |-     |名称
description      |string    |256     |是     |-     |说明
library_id      |int    |11     |否     |-     |图书馆ID
user_id      |int    |11     |否     |-     |操作员ID
created_at       |int    |11     |否     |-     |创建时间
updated_at       |int    |11     |否     |-     |更新时间
status       |int    |11     |否     |-     |状态, 默认值1

---
#### 流通类型 `circulation_type`

字段名|数据类型|长度|可空|主键|注释
-----|-----|-----|-----|-----|-----|
id      |int    |11     |否     |是     |主键ID
title      |string    |128     |否     |-     |名称
description      |string    |256     |是     |-     |说明
library_id      |int    |11     |否     |-     |图书馆ID
user_id      |int    |11     |否     |-     |操作员ID
created_at       |int    |11     |否     |-     |创建时间
updated_at       |int    |11     |否     |-     |更新时间
status       |int    |11     |否     |-     |状态, 默认值1

---
#### 读者类型 `reader_type`

字段名|数据类型|长度|可空|主键|注释
-----|-----|-----|-----|-----|-----|
id      |int    |11     |否     |是     |主键ID
title      |string    |128     |否     |-     |名称
max_borrowing_number      |int    |11     |否     |-     |最大借阅量（本）
max_debt_limit      |int    |11     |否     |-     |最大欠费额度（元）
library_id      |int    |11     |否     |-     |图书馆ID
user_id      |int    |11     |否     |-     |操作员ID
created_at       |int    |11     |否     |-     |创建时间
updated_at       |int    |11     |否     |-     |更新时间
status       |int    |11     |否     |-     |状态, 默认值1

---
#### 借阅规则 `borrowing_rules`

字段名|数据类型|长度|可空|主键|注释
-----|-----|-----|-----|-----|-----|
id      |int    |11     |否     |是     |主键ID
title      |string    |128     |否     |-     |名称
general_loan_period      |int    |11     |否     |-     |一般借期(天)
extended_period_impunity      |int    |11     |否     |-     |超期免罚期限(天)
first_term_of_punishment      |int    |11     |否     |-     |首罚期限(天)
first_penalty_unit_price      |decimal    |2     |否     |-     |首罚单价(元)
other__unit_price      |decimal    |2     |否     |-     |其它单价(元)
reader_type_ids      |string    |128     |否     |-     |适用读者类型(json,reader_type->id)
circulation_type_ids      |string    |128     |否     |-     |适用流通类型(json,circulation_type->id)
library_id      |int    |11     |否     |-     |图书馆ID
user_id      |int    |11     |否     |-     |操作员ID
created_at       |int    |11     |否     |-     |创建时间
updated_at       |int    |11     |否     |-     |更新时间
status       |int    |11     |否     |-     |状态, 默认值1


---
#### 条码号 `bar_code`

字段名|数据类型|长度|可空|主键|注释
-----|-----|-----|-----|-----|-----|
id      |int    |11     |否     |是     |主键ID
title      |string    |128     |否     |-     |名称
prefix      |string    |64     |-     |-     |前缀
number_length      |int    |11     |否     |-     |数字长度
min_number      |int    |11     |否     |-     |数字最小值
max_number      |int    |11     |否     |-     |数字最大值
description      |string    |256     |-     |-     |说明
library_id      |int    |11     |否     |-     |图书馆ID
user_id      |int    |11     |否     |-     |操作员ID
created_at       |int    |11     |否     |-     |创建时间
updated_at       |int    |11     |否     |-     |更新时间
status       |int    |11     |否     |-     |状态, 默认值1


---
#### 索书号规则 `call_number_rules`
> collection_place_ids 为 collection_place表主键ID , 存json格式
> circulation_type_ids 为 circulation_type表主键ID, 存json格式

字段名|数据类型|长度|可空|主键|注释
-----|-----|-----|-----|-----|-----|
id      |int    |11     |否     |是     |主键ID
title      |string    |128     |否     |-     |规则名称
collection_place_ids      |string    |512     |否     |-     |馆藏地(,分割collection_place id)
circulation_type_ids      |string    |512     |否     |-     |流通类型(,分割circulation_type id)
library_id      |int    |11     |否     |-     |图书馆ID
user_id      |int    |11     |否     |-     |操作员ID
created_at       |int    |11     |否     |-     |创建时间
updated_at       |int    |11     |否     |-     |更新时间
status       |int    |11     |否     |-     |状态, 默认值1


---
### 统计信息
> 以下表记录统计信息，可后续进一步完善。

---
### 借阅排行榜
字段名|数据类型|长度|可空|主键|注释
-----|-----|-----|-----|-----|-----|
id      |int    |11     |否     |是     |主键ID

---
### 馆藏统计
字段名|数据类型|长度|可空|主键|注释
-----|-----|-----|-----|-----|-----|
id      |int    |11     |否     |是     |主键ID

---
### 流通统计
字段名|数据类型|长度|可空|主键|注释
-----|-----|-----|-----|-----|-----|
id      |int    |11     |否     |是     |主键ID
