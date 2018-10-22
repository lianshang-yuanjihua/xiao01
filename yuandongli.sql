create database  if not exists `sanqi`;

use sanqi;

select * from sq_user;

drop table sq_user;

create table if not exists `sq_user`(
`id` int key auto_increment comment '主键',
`pid` int not null default 0 comment '直接推荐人',
`path` varchar(255) default '--' comment '推荐关系链',
`mobile` char(11) not null unique comment '用户手机号',
`password` varchar(255) not null comment '密码',
`paypwd` varchar(255) comment '支付密码',
`nickname` varchar(255) not null comment '昵称',
`sex` tinyint(1) default 1 comment '性别',
`cloudwh` double(15,3) not null default 0 comment '云仓余额',
`balance` double(15,3) not null default 0 comment '用户余额',
`total_income` double(15,3) not null default 0 comment '用户总收入',
`voucher` tinyint default 1 comment '代金券',
`usertype` tinyint(1) default 1 comment'账户类型',
`status`tinyint(1) default 1 comment'账户状态',
`createtime` int unsigned comment '用户创建时间'
)char set utf8 engine InnoDB comment '用户表';

insert into sq_user(`mobile`,`password`,`nickname`,`createtime`)values(12345678911,'e10adc3949ba59abbe56e057f20f883e','Door',unix_timestamp());
insert into sq_user(`mobile`,`password`,`nickname`,`createtime`,`usertype`)values(13345678901,'e10adc3949ba59abbe56e057f20f883e','NextDoor',unix_timestamp(),9);
insert into sq_user(`mobile`,`password`,`nickname`,`createtime`,`usertype`)values(14345678901,'e10adc3949ba59abbe56e057f20f883e','8Boy',unix_timestamp(),8);

insert into sq_user(`mobile`,`password`,`nickname`,`createtime`)values(15345678901,'e10adc3949ba59abbe56e057f20f883e','09Boy',unix_timestamp()),
(16345678901,'e10adc3949ba59abbe56e057f20f883e','10Boy',unix_timestamp()),
(17345678901,'e10adc3949ba59abbe56e057f20f883e','11Boy',unix_timestamp()),
(18345678901,'e10adc3949ba59abbe56e057f20f883e','12Boy',unix_timestamp()),
(19345678901,'e10adc3949ba59abbe56e057f20f883e','13Boy',unix_timestamp()),
(15445678901,'e10adc3949ba59abbe56e057f20f883e','14Boy',unix_timestamp()),
(15545678901,'e10adc3949ba59abbe56e057f20f883e','15Boy',unix_timestamp());

create table if not exists `sq_product` (
`id` int unsigned not null primary key auto_increment comment '主键',
`title` varchar(255) not null comment '产品名称',
`price` decimal(16,2) not null comment '价格',
`num` int(11) default 0 comment '库存数量',
`sellnum` int(11) default 0 comment '销售数量',
`content` text comment '产品描述简介',
`style` text comment '产品型号参数',
`status` tinyint(1) default 1 comment '产品状态'
) engine=innodb default charset utf8 comment="产品表";

insert into sq_product(title,price,num,content)values('源动力',670,500,'产品说明');

create table if not exists `sq_productimg`(
`id` int unsigned not null primary key auto_increment comment '主键',
`path` varchar(255) comment '图片路径及名称',
`productid` int(11) comment '对应产品主键ID'
) engine=innodb default charset utf8 comment="产品图片表";

create table if not exists `sq_cart` (
`id` int unsigned not null auto_increment comment '主键',
`productid` int comment '商品ID',
`userid` int comment '用户ID',
`buynum` int comment '商品数量',
`created` int comment '添加时间',
primary key id(`id`)
) engine=innodb default charset utf8 comment="购物车表";

create table `sq_address`(
`id` int key auto_increment,
`consignee` varchar(20),
`address` varchar(255),
`mobile` varchar(20),
`best_time` varchar(50),
`userid` int,
`status` tinyint(1) default 0
);

create table `sq_orders`(
`id` int key auto_increment,              
`addressid`  int,
`allmoney`  varchar(20),
`userid`  int,
`ip`  int unsigned,
`createtime`   int,
`status`  tinyint default 0
);


create table `sq_orderdetail`(
`id` int key auto_increment,
`productid`  int,
`endprice`  varchar(20),
`buynum`   int,
`money`   varchar(20),
`orderid` int
);

create table if not exists `sq_yclog`(
`id` int key auto_increment comment '主键',
`uid` int not null default 0 comment '用户ID',
`time` int not null default now() comment '日志生成时间',
`type` tinyint(1) not null comment '交易类型',
`amount` double(15,3) not null default 0 comment '交易金额',
`cloudwh` double(15,3) not null default 0 comment '云仓交易后余额',
`remarks` varchar(255) not null comment '交易备注'
)char set utf8 engine InnoDB comment '云仓交易日志表';

create table if not exists `sq_balancelog`(
`id` int key auto_increment comment '主键',
`uid` int not null default 0 comment '用户ID',
`time` int not null default now() comment '日志生成时间',
`type` tinyint(1) not null comment '交易类型',
`amount` double(15,3) not null default 0 comment '交易金额',
`balance` double(15,3) not null default 0 comment '交易后余额',
`remarks` varchar(255) not null comment '交易备注'
)char set utf8 engine InnoDB comment '余额交易日志表';



