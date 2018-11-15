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
`nickname` varchar(255) not null comment '昵称',
`icon` varchar(255) comment '头像',
`sex` tinyint(1) default 1 comment '性别',
`balance` double(15,3) not null default 0 comment '用户余额',
`cloud` double(15,3) not null default 0 comment '云仓余额',
`total_income` double(16,2) not null default 0 comment '用户总收入',
`voucher` int(3) default 500 comment '代金券',
`usertype` tinyint(1) default 1 comment'账户类型:0为普通会员,1为一级代理 2为二级代理 9为超级管理员,8为普通管理员',
`agent_price` decimal(16,2) not null default 70 comment '推荐基础奖励',
`reward` decimal(16,2) not null default 30 comment '代理推荐代理奖励',
`status`tinyint(1) default 1 comment'账户状态 1为正常 , 0为冻结',
`createtime` int unsigned comment '用户创建时间'
)char set utf8 engine InnoDB comment '用户表';

insert into sq_user(`mobile`,`password`,`nickname`,`createtime`,`usertype`)values('12345678901','e10adc3949ba59abbe56e057f20f883e','Door',unix_timestamp(),1);

insert into sq_user(`mobile`,`password`,`nickname`,`createtime`,`usertype`)values('22345678901','e10adc3949ba59abbe56e057f20f883e','NextDoor',unix_timestamp(),9);

drop table if exists sq_product;
create table if not exists `sq_product` (
`id` int unsigned not null primary key auto_increment comment '主键',
`title` varchar(255) not null comment '产品名称',
`price` decimal(16,2) not null comment '会员购买价格',
`suit` decimal(16,2) not null comment '会员套装购买价格',
`agent_1_price` decimal(16,2) not null comment '1级代理云仓优惠价',
`agent_2_price` decimal(16,2) not null comment '2级代理云仓优惠价',
`reward` decimal(16,2) not null default 30 comment '代理推荐代理奖励',
`content` text comment '产品描述简介',
`status` tinyint(1) default 1 comment '产品状态'
) engine=innodb default charset utf8 comment='产品表';

select * from sq_product;

drop table if exists sq_productimg;
create table if not exists `sq_productimg`(
`id` int unsigned not null primary key auto_increment comment '主键',
`path` varchar(255) comment '图片路径及名称',
`type` tinyint default 0 comment '图片类型',
`productid` int(11) comment '对应产品主键ID'
) engine=innodb default charset utf8 comment='产品图片表';

drop table if exists sq_cart;
create table if not exists `sq_cart` (
`id` int unsigned not null auto_increment comment '主键',
`productid` int comment '商品ID',
`userid` int comment '用户ID',
`num` int default 1 comment '商品数量',
`created` int comment '添加时间',
primary key id(`id`)
) engine=innodb default charset utf8 comment='购物车表';

insert into sq_cart (productid,userid,created)values(6,1,unix_timestamp());
select * from sq_cart;

drop table if exists sq_address;
create table `sq_address`(
`id` int key auto_increment,
`consignee` varchar(20) comment'收货人',
`address` varchar(255) comment '收货地址',
`mobile` varchar(20) comment '手机号', 
`zipcode` int(6) comment '邮政编码',
`remark` varchar(50) comment '详细地址',
`status` tinyint(1) default 0 comment '地址状态 0 为普通 1为默认',
`userid` int not null comment '用户id'
)char set utf8 engine InnoDB comment '地址表';

select * from sq_address;

insert into sq_address (consignee,address,mobile,remark,status,userid)values('Door','幻想乡新日暮里','12345678901','乖乖站好',1,1);

drop table sq_order;
create table `sq_order`( 
`id` int key auto_increment,
`uid` int not null comment '用户id',
`addr_id` int comment '此订单送达地址id',
`out_trade_on` varchar(255) not null comment'订单编号',
`endprice` varchar(20) comment '最终价格',
`voucher` tinyint(1) default 0 comment '代金券的使用,0为正常提成 1 为提成盒数-1',
`type` tinyint(1) default 0 comment '订单类型,0为普通购买,1 为创业代理,2 为都市代理',
`created` int default 0 comment '订单生成时间',
`transaction_id` char(32) comment '微信订单号',
`status` tinyint(1) default 0 comment'订单状态：0：待付款，1：待确认收货，2：已完成'
)char set utf8 engine InnoDB comment '订单表';

select * from sq_order;

drop table sq_orderproducts;
create table `sq_orderproducts`(
`id` int primary key auto_increment,
`oid` int not null comment '订单id',
`proid` int not null comment '产品id',	
`pronum` int not null comment '商品数量',
`proprice` decimal(16,2) not null comment '价格'
)char set utf8 engine InnoDB comment '订单商品表';

drop table if exists sq_yclog;
create table if not exists `sq_yclog`(
`id` int key auto_increment comment '主键',
`uid` int not null default 0 comment '用户ID',
`time` int not null comment '日志生成时间',
`type` tinyint(1) not null default 0 comment '交易类型',
`amount` int not null comment '交易金额',
`cloud` int not null comment '云仓交易后余额',
`remarks` varchar(255) not null comment '交易备注'
)char set utf8 engine InnoDB comment '云仓交易日志表';
drop table if exists sq_selllog;
drop table if exists sq_balancelog;
create table if not exists `sq_balancelog`(
`id` int key auto_increment comment '主键',
`uid` int not null default 0 comment '用户ID',
`time` int not null comment '日志生成时间',
`type` tinyint(1) not null comment '交易类型',
`amount` double(15,3) not null comment '交易金额',
`balance` double(15,3) not null comment '交易后余额',
`remarks` varchar(255) not null comment '交易备注'
)char set utf8 engine InnoDB comment '余额交易日志表';



