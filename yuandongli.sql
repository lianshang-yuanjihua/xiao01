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
`icon` varchar(255),
`sex` tinyint(1) default 1 comment '性别',
`cloudwh` double(15,3) not null default 0 comment '云仓余额',
`balance` double(15,3) not null default 0 comment '用户余额',
`total_income` double(15,3) not null default 0 comment '用户总收入',
`voucher` tinyint default 1 comment '代金券',
`usertype` tinyint(1) default 1 comment'账户类型',
`status`tinyint(1) default 1 comment'账户状态',
`createtime` int unsigned comment '用户创建时间'
)char set utf8 engine InnoDB comment '用户表';

insert into sq_user(`mobile`,`password`,`nickname`,`createtime`)values(12345678901,'e10adc3949ba59abbe56e057f20f883e','Door',unix_timestamp());
insert into sq_user(`mobile`,`password`,`nickname`,`createtime`,`usertype`)values(13345678901,'e10adc3949ba59abbe56e057f20f883e','NextDoor',unix_timestamp(),9);
insert into sq_user(`mobile`,`password`,`nickname`,`createtime`,`usertype`)values(14345678901,'e10adc3949ba59abbe56e057f20f883e','8Boy',unix_timestamp(),8);

insert into sq_user(`mobile`,`password`,`nickname`,`createtime`)values(15345678901,'e10adc3949ba59abbe56e057f20f883e','09Boy',unix_timestamp()),
(16345678901,'e10adc3949ba59abbe56e057f20f883e','10Boy',unix_timestamp()),
(17345678901,'e10adc3949ba59abbe56e057f20f883e','11Boy',unix_timestamp()),
(18345678901,'e10adc3949ba59abbe56e057f20f883e','12Boy',unix_timestamp()),
(19345678901,'e10adc3949ba59abbe56e057f20f883e','13Boy',unix_timestamp()),
(15445678901,'e10adc3949ba59abbe56e057f20f883e','14Boy',unix_timestamp()),
(15545678901,'e10adc3949ba59abbe56e057f20f883e','15Boy',unix_timestamp());

update sq_user set pid = 1 where id IN(4,5);
update sq_user set pid = 4 where id IN(6,7);
update sq_user set pid = 5 where id IN(8,9);

create table if not exists `sq_product` (
`id` int unsigned not null primary key auto_increment comment '主键',
`title` varchar(255) not null comment '产品名称',
`price` decimal(16,2) not null comment '价格',
`num` int(11) default 0 comment '库存数量',
`sellnum` int(11) default 0 comment '销售数量',
`content` text comment '产品描述简介',
`status` tinyint(1) default 1 comment '产品状态'
) engine=innodb default charset utf8 comment="产品表";

insert into sq_product(title,price,num,content)values('源动力',670,500,'产品说明');


select * from sq_productimg;

create table if not exists `sq_productimg`(
`id` int unsigned not null primary key auto_increment comment '主键',
`path` varchar(255) comment '图片路径及名称',
`type` tinyint default 0 comment '图片类型',
`productid` int(11) comment '对应产品主键ID'
) engine=innodb default charset utf8 comment="产品图片表";

create table if not exists `sq_cart` (
`id` int unsigned not null auto_increment comment '主键',
`productid` int comment '商品ID',
`userid` int comment '用户ID',
`buynum` int default 1 comment '产品数量',
`created` int comment '添加时间',
primary key id(`id`)
) engine=innodb default charset utf8 comment="购物车表";

insert into sq_cart (productid,userid,created)values(6,1,unix_timestamp());

drop table sq_address;
create table `sq_address`(
`id` int key auto_increment,
`consignee` varchar(20) comment'收货人',
`address` varchar(255) comment '收货地址',
`mobile` varchar(20) comment '手机号', 
`zipcode` int(6) comment '邮政编码',
`remark` varchar(50) comment '备注',
`userid` int comment '用户id'
)char set utf8 engine InnoDB comment '地址表';

insert into sq_address (consignee,address,mobile,remark,userid)values('Door','幻想乡新日暮里','12345678901','乖乖站好',1);


create table `sq_order`( 
`id` int key auto_increment,
`uid` int not null comment '用户id',
`addr_id` int comment '此订单送达地址id',
`endprice`  varchar(20) comment '最终价格',
`money`   varchar(20) comment '实付金额',
`status` tinyint(1) default 0 comment'订单状态：0：待付款，1：待发货，2：已发货，3：待确认收货，4：已完成'
)char set utf8 engine InnoDB comment '订单表';

create table `sq_orderproducts`(
`id` int primary key auto_increment,
`oid` int not null comment '订单id',
`proid` int not null comment '产品id',
`pronum` int not null comment '商品数量',
`proprice` decimal(16,2) not null comment '价格'
)char set utf8 engine InnoDB comment '订单商品表';

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

create table if not exists `sq_selllog`(
`id` int key auto_increment comment '主键',
`proid` int not null default 0 comment '产品ID',
`uid` int not null default 0 comment '用户ID',
`time` int not null default now() comment '日志生成时间',
`sellnum` double(15,3) not null default 0 comment '售出数量',
`storage` double(15,3) not null default 0 comment '售出后库存',
`remarks` varchar(255) comment '交易备注'
)char set utf8 engine InnoDB comment '商品售出日志表';


