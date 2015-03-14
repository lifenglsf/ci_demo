安装说明
1.将代码上传到服务器
2.配置数据库
  修改application/config/database.php
$db['default']['hostname'] = '127.0.0.1';//这个为数据库地址
$db['default']['username'] = 'root';//这个为数据库用户名
$db['default']['password'] = 'root';//这个为数据库密码
$db['default']['database'] = 'demoapk';//这个为数据库的数据库名称
$db['default']['dbprefix'] = '';//这个为表前缀，如果有前缀则填写，如表名称为test_user，则前缀为test_
修改以上几个地方内容为实际内容


数据库sql文件为根目录下demoapk.sql,直接在数据库导入此文件就可以完成数据库的创建，表的创建
php需要开启curl，mysql扩展





下方为数据库sql

Source Server         : local
Source Server Version : 50620
Source Host           : localhost:3306
Source Database       : demoapk

Target Server Type    : MYSQL
Target Server Version : 50620
File Encoding         : 65001

Date: 2015-03-06 14:28:36
*/

SET NAMES utf8;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
--  Table structure for `user`
-- ----------------------------
DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(30) DEFAULT NULL COMMENT '姓名',
  `password` varchar(255) NOT NULL COMMENT '密码',
  `ctime` int(10) NOT NULL COMMENT '创建世界',
  `mobile` bigint(11) DEFAULT NULL COMMENT '手机号',
  `lat` varchar(50) DEFAULT '31.22' COMMENT '纬度',
  `lng` varchar(50) DEFAULT '121.48' COMMENT '经度',
  `uuid` varchar(32) DEFAULT NULL,
  `platform` varchar(16) DEFAULT NULL,
  `service_type` varchar(64) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;


/*
Navicat MySQL Data Transfer

Source Server         : local
Source Server Version : 50620
Source Host           : localhost:3306
Source Database       : demoapk

Target Server Type    : MYSQL
Target Server Version : 50620
File Encoding         : 65001

Date: 2015-03-06 14:28:19
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for content
-- ----------------------------
DROP TABLE IF EXISTS `content`;
CREATE TABLE `content` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(50) NOT NULL,
  `content` text NOT NULL,
  `ctime` int(10) DEFAULT NULL,
  `sell_price` decimal(10,2) DEFAULT '0.00',
  `buy_price` decimal(10,2) DEFAULT '0.00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
