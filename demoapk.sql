/*
 Navicat MySQL Data Transfer

 Source Server         : local
 Source Server Version : 50614
 Source Host           : localhost
 Source Database       : demoapk

 Target Server Version : 50614
 File Encoding         : utf-8

 Date: 03/14/2015 12:43:42 PM
*/
CREATE DATABASE IF NOT EXISTS demoapk DEFAULT CHARSET utf8 COLLATE utf8_general_ci;
use demoapk;
SET NAMES utf8;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
--  Table structure for `content`
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;


-- ----------------------------
--  Table structure for `order`
-- ----------------------------
DROP TABLE IF EXISTS `order`;
CREATE TABLE `order` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) DEFAULT NULL COMMENT '用户id',
  `cid` int(11) DEFAULT NULL COMMENT '需求id',
  `ctime` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='订单表';

SET FOREIGN_KEY_CHECKS = 1;
