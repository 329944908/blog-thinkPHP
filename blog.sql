/*
Navicat MySQL Data Transfer

Source Server         : blog
Source Server Version : 50505
Source Host           : 127.0.0.1:3306
Source Database       : blog

Target Server Type    : MYSQL
Target Server Version : 50505
File Encoding         : 65001

Date: 2018-03-11 14:39:18
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for blog
-- ----------------------------
DROP TABLE IF EXISTS `blog`;
CREATE TABLE `blog` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(100) NOT NULL,
  `content` text,
  `image` varchar(255) DEFAULT '',
  `classify_id` int(11) NOT NULL DEFAULT '0',
  `status` int(11) NOT NULL DEFAULT '0',
  `createtime` datetime NOT NULL,
  `updatetime` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=42 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of blog
-- ----------------------------
INSERT INTO `blog` VALUES ('35', '1111', '11111111111111', 'blog/2017-11-05/59febf58aa87f.png', '5', '0', '2017-11-05 15:35:52', '0000-00-00 00:00:00');
INSERT INTO `blog` VALUES ('36', '1111', '11111111111111', 'blog/2017-11-05/59febf58ea290.png', '5', '1', '2017-11-05 15:35:52', '2017-11-07 21:20:46');
INSERT INTO `blog` VALUES ('37', '1111', '11111111111111', 'blog/2017-11-07/5a01b33725265.png', '9', '1', '2017-11-05 15:44:15', '2017-11-07 21:47:59');
INSERT INTO `blog` VALUES ('38', 'haha', 'hahaha', 'blog/2017-11-07/5a01b340e09d8.png', '3', '1', '2017-11-07 18:07:26', '2017-11-07 21:21:04');
INSERT INTO `blog` VALUES ('39', 'uaishfiosdh', 'hahaha', 'blog/2017-11-07/5a018618c6e7f.png', '3', '1', '2017-11-07 18:08:24', '2017-11-07 21:49:05');
INSERT INTO `blog` VALUES ('40', 'haha', 'hahaha', 'blog/2017-11-07/5a01876f137bb.png', '3', '1', '2017-11-07 18:14:07', '0000-00-00 00:00:00');
INSERT INTO `blog` VALUES ('41', 'java从入门到放弃', '哈哈哈哈哈哈哈哈哈啊 啊啊啊啊 啊啊啊 啊啊啊 啊啊啊啊啊 啊 ', 'blog/2017-11-10/5a052b662a3dd.png', '10', '1', '2017-11-10 12:30:30', '0000-00-00 00:00:00');

-- ----------------------------
-- Table structure for classify
-- ----------------------------
DROP TABLE IF EXISTS `classify`;
CREATE TABLE `classify` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `parent_id` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of classify
-- ----------------------------
INSERT INTO `classify` VALUES ('1', '慢生活', '0', '1');
INSERT INTO `classify` VALUES ('2', '网站建设', '0', '0');
INSERT INTO `classify` VALUES ('3', 'css', '2', '0');
INSERT INTO `classify` VALUES ('4', 'php', '2', '0');
INSERT INTO `classify` VALUES ('5', '日记', '1', '0');
INSERT INTO `classify` VALUES ('6', '欣赏', '1', '1');
INSERT INTO `classify` VALUES ('7', '啦啦啦啦', '0', '0');
INSERT INTO `classify` VALUES ('8', '啦1', '7', '0');
INSERT INTO `classify` VALUES ('9', 'html', '2', '1');
INSERT INTO `classify` VALUES ('10', 'java', '2', '1');

-- ----------------------------
-- Table structure for comment
-- ----------------------------
DROP TABLE IF EXISTS `comment`;
CREATE TABLE `comment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `blog_id` int(11) NOT NULL,
  `parent_id` int(11) NOT NULL DEFAULT '0',
  `content` text,
  `createtime` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of comment
-- ----------------------------
INSERT INTO `comment` VALUES ('36', '12', '41', '0', '啊啊啊', '2017-11-17 10:59:39');

-- ----------------------------
-- Table structure for user
-- ----------------------------
DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `image` varchar(255) DEFAULT '',
  `status` int(11) NOT NULL DEFAULT '1',
  `createtime` datetime NOT NULL,
  `updatetime` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of user
-- ----------------------------
INSERT INTO `user` VALUES ('10', 'aaa', '123@qq.com', '123', 'user/2017-11-10/5a0527c9b9e42.png', '1', '2017-11-10 12:15:05', null);
INSERT INTO `user` VALUES ('11', '闫宇轩', '1@qq.com', '1', 'user/2017-11-17/5a0e4b4744d95.png', '1', '2017-11-17 10:36:55', null);
INSERT INTO `user` VALUES ('12', '牛顿', '2@qq.com', '2', 'user/2017-11-17/5a0e4c0920c58.png', '1', '2017-11-17 10:40:09', null);

-- ----------------------------
-- Table structure for zan
-- ----------------------------
DROP TABLE IF EXISTS `zan`;
CREATE TABLE `zan` (
  `comment_id` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1',
  `user_id` int(11) NOT NULL,
  `blog_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of zan
-- ----------------------------
INSERT INTO `zan` VALUES ('33', '1', '10', '41');
INSERT INTO `zan` VALUES ('31', '1', '10', '40');
INSERT INTO `zan` VALUES ('32', '1', '10', '40');
INSERT INTO `zan` VALUES ('34', '1', '10', '39');
INSERT INTO `zan` VALUES ('33', '1', '12', '41');
INSERT INTO `zan` VALUES ('35', '1', '12', '41');
