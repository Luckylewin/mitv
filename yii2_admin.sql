/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50553
Source Host           : localhost:3306
Source Database       : mitv

Target Server Type    : MYSQL
Target Server Version : 50553
File Encoding         : 65001

Date: 2018-03-30 09:59:26
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for sys_activate_log
-- ----------------------------
DROP TABLE IF EXISTS `sys_activate_log`;
CREATE TABLE `sys_activate_log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `appname` varchar(50) NOT NULL,
  `uid` int(11) NOT NULL COMMENT '用户id',
  `created_time` int(11) NOT NULL COMMENT '激活时间',
  `expire_time` int(11) NOT NULL COMMENT '过期时间',
  `duration` int(11) NOT NULL COMMENT '天数',
  `is_charge` char(1) NOT NULL COMMENT '是否收费',
  `oid` int(11) NOT NULL COMMENT '操作用户id',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of sys_activate_log
-- ----------------------------
INSERT INTO `sys_activate_log` VALUES ('1', 'Mitv', '2', '1522318550', '1522923350', '7', '0', '2');

-- ----------------------------
-- Table structure for sys_app
-- ----------------------------
DROP TABLE IF EXISTS `sys_app`;
CREATE TABLE `sys_app` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL COMMENT '名称',
  `url` varchar(255) NOT NULL,
  `introduce` text NOT NULL COMMENT '介绍',
  `month_price` decimal(6,2) NOT NULL COMMENT '一个月价格',
  `season_price` decimal(6,2) NOT NULL COMMENT '三个月价格',
  `half_price` decimal(6,2) NOT NULL COMMENT '半年价格',
  `year_price` decimal(6,2) NOT NULL COMMENT '年价',
  `free_day` varchar(50) NOT NULL DEFAULT '' COMMENT '免费使用天数',
  `imgae` varchar(255) NOT NULL COMMENT '图片',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of sys_app
-- ----------------------------
INSERT INTO `sys_app` VALUES ('1', 'Mitv', '', '简单介绍', '20.00', '55.00', '150.00', '270.00', '7', 'user-dir/20180326/android.png');
INSERT INTO `sys_app` VALUES ('2', 'HotTV', '', 'HotTV', '10.00', '27.00', '55.00', '100.00', '7', 'user-dir/20180326/android.png');
INSERT INTO `sys_app` VALUES ('3', 'XTube', '', 'XTube', '10.00', '27.00', '55.00', '108.00', '14', 'user-dir/20180326/android.png');

-- ----------------------------
-- Table structure for sys_order
-- ----------------------------
DROP TABLE IF EXISTS `sys_order`;
CREATE TABLE `sys_order` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `mac` varchar(64) NOT NULL,
  `name` varchar(255) NOT NULL,
  `active_time` datetime NOT NULL COMMENT '激活时间',
  `expire_time` datetime NOT NULL COMMENT '过期时间',
  `type` char(2) NOT NULL,
  `total` decimal(6,2) NOT NULL,
  `app_name` varchar(255) NOT NULL COMMENT 'APK名称',
  `invoice_number` varchar(20) NOT NULL COMMENT '商户订单号',
  `is_pay` varchar(2) NOT NULL DEFAULT '0' COMMENT '是否已经支付',
  `created_at` datetime NOT NULL COMMENT '创建时间',
  `updated_at` datetime NOT NULL COMMENT '更新时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=36 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of sys_order
-- ----------------------------
INSERT INTO `sys_order` VALUES ('35', 'test', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '1', '20.00', 'Mitv', 'A329201041220077', '1', '2018-03-29 18:41:44', '2018-03-29 18:43:36');

-- ----------------------------
-- Table structure for yii2_admin
-- ----------------------------
DROP TABLE IF EXISTS `yii2_admin`;
CREATE TABLE `yii2_admin` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL COMMENT '用户名',
  `auth_key` varchar(32) NOT NULL,
  `password_hash` varchar(255) NOT NULL COMMENT '密码',
  `email` varchar(255) NOT NULL COMMENT '邮箱',
  `reg_ip` int(11) NOT NULL DEFAULT '0' COMMENT '创建或注册IP',
  `last_login_time` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '最后登录时间',
  `last_login_ip` int(11) NOT NULL DEFAULT '0' COMMENT '最后登录IP',
  `status` tinyint(4) NOT NULL DEFAULT '1' COMMENT '用户状态 1正常 0禁用',
  `created_at` int(11) NOT NULL COMMENT '创建或注册时间',
  `updated_at` int(11) NOT NULL COMMENT '更新时间',
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`),
  KEY `status` (`status`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of yii2_admin
-- ----------------------------
INSERT INTO `yii2_admin` VALUES ('1', 'admin', 'SbSY36BLw3V2lU-GB7ZAzCVJKDFx82IJ', '$2y$13$rNr3SKlEM7gz.aqvXy/fbuOK82d6bO7prBzMsq5sooe.e2Wu5HFGO', '876505905@qq.com', '2130706433', '1522375024', '2130706433', '1', '1482305564', '1522375104');

-- ----------------------------
-- Table structure for yii2_auth_assignment
-- ----------------------------
DROP TABLE IF EXISTS `yii2_auth_assignment`;
CREATE TABLE `yii2_auth_assignment` (
  `item_name` varchar(64) NOT NULL,
  `user_id` varchar(64) NOT NULL,
  `created_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`item_name`,`user_id`),
  CONSTRAINT `yii2_auth_assignment_ibfk_1` FOREIGN KEY (`item_name`) REFERENCES `yii2_auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of yii2_auth_assignment
-- ----------------------------
INSERT INTO `yii2_auth_assignment` VALUES ('超级管理员', '1', '1520270508');
INSERT INTO `yii2_auth_assignment` VALUES ('超级管理员', '9', '1519830838');

-- ----------------------------
-- Table structure for yii2_auth_item
-- ----------------------------
DROP TABLE IF EXISTS `yii2_auth_item`;
CREATE TABLE `yii2_auth_item` (
  `name` varchar(64) NOT NULL,
  `type` int(11) NOT NULL,
  `description` text,
  `rule_name` varchar(64) DEFAULT NULL,
  `data` text,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`name`),
  KEY `rule_name` (`rule_name`),
  KEY `type` (`type`),
  CONSTRAINT `yii2_auth_item_ibfk_1` FOREIGN KEY (`rule_name`) REFERENCES `yii2_auth_rule` (`name`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of yii2_auth_item
-- ----------------------------
INSERT INTO `yii2_auth_item` VALUES ('#', '2', '', '#', null, '1519808376', '1519810140');
INSERT INTO `yii2_auth_item` VALUES ('admin/auth', '2', '', 'admin/auth', null, '1484734191', '1520059861');
INSERT INTO `yii2_auth_item` VALUES ('admin/create', '2', '', 'admin/create', null, '1484734191', '1520059861');
INSERT INTO `yii2_auth_item` VALUES ('admin/delete', '2', '', 'admin/delete', null, '1484734191', '1520059861');
INSERT INTO `yii2_auth_item` VALUES ('admin/index', '2', '', 'admin/index', null, '1484734191', '1520059861');
INSERT INTO `yii2_auth_item` VALUES ('admin/update', '2', '', 'admin/update', null, '1484734191', '1520059861');
INSERT INTO `yii2_auth_item` VALUES ('backup/default/index', '2', '', 'backup/default/index', null, '1519808877', '1519811523');
INSERT INTO `yii2_auth_item` VALUES ('combo/create', '2', '', 'combo/create', null, '1519808877', '1520059861');
INSERT INTO `yii2_auth_item` VALUES ('combo/delete', '2', '', 'combo/delete', null, '1519808877', '1520059861');
INSERT INTO `yii2_auth_item` VALUES ('combo/index', '2', '', 'combo/index', null, '1517996186', '1520059861');
INSERT INTO `yii2_auth_item` VALUES ('combo/update', '2', '', 'combo/update', null, '1519808877', '1520059861');
INSERT INTO `yii2_auth_item` VALUES ('combo/view', '2', '', 'combo/view', null, '1519378925', '1520059861');
INSERT INTO `yii2_auth_item` VALUES ('config/attachment', '2', '', 'config/attachment', null, '1484734191', '1520059861');
INSERT INTO `yii2_auth_item` VALUES ('config/basic', '2', '', 'config/basic', null, '1484734191', '1520059861');
INSERT INTO `yii2_auth_item` VALUES ('config/send-mail', '2', '', 'config/send-mail', null, '1484734191', '1520059861');
INSERT INTO `yii2_auth_item` VALUES ('database/export', '2', '', 'database/export', null, '1484734305', '1520059861');
INSERT INTO `yii2_auth_item` VALUES ('excel-setting/update', '2', '', 'excel-setting/update', null, '1519451875', '1519451875');
INSERT INTO `yii2_auth_item` VALUES ('excel/import', '2', '', 'excel/import', null, '1519436284', '1520059861');
INSERT INTO `yii2_auth_item` VALUES ('excel/index', '2', '', 'excel/index', null, '1519436031', '1520059861');
INSERT INTO `yii2_auth_item` VALUES ('index/frame', '2', '', 'index/frame', null, '1518057962', '1521797910');
INSERT INTO `yii2_auth_item` VALUES ('index/index', '2', '', 'index/index', null, '1484734191', '1521797910');
INSERT INTO `yii2_auth_item` VALUES ('menu/create', '2', '', 'menu/create', null, '1484734191', '1520059861');
INSERT INTO `yii2_auth_item` VALUES ('menu/delete', '2', '', 'menu/delete', null, '1484734191', '1520059861');
INSERT INTO `yii2_auth_item` VALUES ('menu/index', '2', '', 'menu/index', null, '1484734191', '1520059861');
INSERT INTO `yii2_auth_item` VALUES ('menu/update', '2', '', 'menu/update', null, '1484734191', '1520059861');
INSERT INTO `yii2_auth_item` VALUES ('order/create', '2', '', 'order/create', null, '1518074401', '1520059861');
INSERT INTO `yii2_auth_item` VALUES ('order/delete', '2', '', 'order/delete', null, '1519450583', '1520059861');
INSERT INTO `yii2_auth_item` VALUES ('order/index', '2', '', 'order/index', null, '1517996186', '1520059861');
INSERT INTO `yii2_auth_item` VALUES ('order/update', '2', '', 'order/update', null, '1519450583', '1520059861');
INSERT INTO `yii2_auth_item` VALUES ('order/view', '2', '', 'order/view', null, '1519377930', '1520059861');
INSERT INTO `yii2_auth_item` VALUES ('product/delete', '2', '', 'product/delete', null, '1519808877', '1520059861');
INSERT INTO `yii2_auth_item` VALUES ('product/index', '2', '', 'product/index', null, '1517996186', '1520059861');
INSERT INTO `yii2_auth_item` VALUES ('product/update', '2', '', 'product/update', null, '1519808877', '1520059861');
INSERT INTO `yii2_auth_item` VALUES ('product/view', '2', '', 'product/view', null, '1519378499', '1520059861');
INSERT INTO `yii2_auth_item` VALUES ('role/auth', '2', '', 'role/auth', null, '1484734191', '1520059861');
INSERT INTO `yii2_auth_item` VALUES ('role/create', '2', '', 'role/create', null, '1484734191', '1520059861');
INSERT INTO `yii2_auth_item` VALUES ('role/delete', '2', '', 'role/delete', null, '1484734191', '1520059861');
INSERT INTO `yii2_auth_item` VALUES ('role/export-setting', '2', '', 'role/export-setting', null, '1519438814', '1519451875');
INSERT INTO `yii2_auth_item` VALUES ('role/index', '2', '', 'role/index', null, '1484734191', '1520059861');
INSERT INTO `yii2_auth_item` VALUES ('role/update', '2', '', 'role/update', null, '1484734191', '1520059861');
INSERT INTO `yii2_auth_item` VALUES ('servicer/create', '2', '', 'servicer/create', null, '1519810140', '1520059861');
INSERT INTO `yii2_auth_item` VALUES ('servicer/index', '2', '', 'servicer/index', null, '1517996187', '1520059861');
INSERT INTO `yii2_auth_item` VALUES ('servicer/view', '2', '', 'servicer/view', null, '1519884478', '1520059861');
INSERT INTO `yii2_auth_item` VALUES ('transator/delete', '2', '', 'transator/delete', null, '1519810140', '1520059861');
INSERT INTO `yii2_auth_item` VALUES ('transator/index', '2', '', 'transator/index', null, '1517996187', '1520059861');
INSERT INTO `yii2_auth_item` VALUES ('transator/update', '2', '', 'transator/update', null, '1519810140', '1520059861');
INSERT INTO `yii2_auth_item` VALUES ('transator/view', '2', '', 'transator/view', null, '1519884478', '1520059861');
INSERT INTO `yii2_auth_item` VALUES ('超级管理员', '1', '授权所有权限', null, null, '1484712662', '1519884549');

-- ----------------------------
-- Table structure for yii2_auth_item_child
-- ----------------------------
DROP TABLE IF EXISTS `yii2_auth_item_child`;
CREATE TABLE `yii2_auth_item_child` (
  `parent` varchar(64) NOT NULL,
  `child` varchar(64) NOT NULL,
  PRIMARY KEY (`parent`,`child`),
  KEY `child` (`child`),
  CONSTRAINT `yii2_auth_item_child_ibfk_1` FOREIGN KEY (`parent`) REFERENCES `yii2_auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `yii2_auth_item_child_ibfk_2` FOREIGN KEY (`child`) REFERENCES `yii2_auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of yii2_auth_item_child
-- ----------------------------
INSERT INTO `yii2_auth_item_child` VALUES ('超级管理员', 'admin/auth');
INSERT INTO `yii2_auth_item_child` VALUES ('超级管理员', 'admin/create');
INSERT INTO `yii2_auth_item_child` VALUES ('超级管理员', 'admin/delete');
INSERT INTO `yii2_auth_item_child` VALUES ('超级管理员', 'admin/index');
INSERT INTO `yii2_auth_item_child` VALUES ('超级管理员', 'admin/update');
INSERT INTO `yii2_auth_item_child` VALUES ('超级管理员', 'combo/create');
INSERT INTO `yii2_auth_item_child` VALUES ('超级管理员', 'combo/delete');
INSERT INTO `yii2_auth_item_child` VALUES ('超级管理员', 'combo/index');
INSERT INTO `yii2_auth_item_child` VALUES ('超级管理员', 'combo/update');
INSERT INTO `yii2_auth_item_child` VALUES ('超级管理员', 'combo/view');
INSERT INTO `yii2_auth_item_child` VALUES ('超级管理员', 'config/attachment');
INSERT INTO `yii2_auth_item_child` VALUES ('超级管理员', 'config/basic');
INSERT INTO `yii2_auth_item_child` VALUES ('超级管理员', 'config/send-mail');
INSERT INTO `yii2_auth_item_child` VALUES ('超级管理员', 'database/export');
INSERT INTO `yii2_auth_item_child` VALUES ('超级管理员', 'excel/import');
INSERT INTO `yii2_auth_item_child` VALUES ('超级管理员', 'excel/index');
INSERT INTO `yii2_auth_item_child` VALUES ('超级管理员', 'index/frame');
INSERT INTO `yii2_auth_item_child` VALUES ('超级管理员', 'index/index');
INSERT INTO `yii2_auth_item_child` VALUES ('超级管理员', 'menu/create');
INSERT INTO `yii2_auth_item_child` VALUES ('超级管理员', 'menu/delete');
INSERT INTO `yii2_auth_item_child` VALUES ('超级管理员', 'menu/index');
INSERT INTO `yii2_auth_item_child` VALUES ('超级管理员', 'menu/update');
INSERT INTO `yii2_auth_item_child` VALUES ('超级管理员', 'order/create');
INSERT INTO `yii2_auth_item_child` VALUES ('超级管理员', 'order/delete');
INSERT INTO `yii2_auth_item_child` VALUES ('超级管理员', 'order/index');
INSERT INTO `yii2_auth_item_child` VALUES ('超级管理员', 'order/update');
INSERT INTO `yii2_auth_item_child` VALUES ('超级管理员', 'order/view');
INSERT INTO `yii2_auth_item_child` VALUES ('超级管理员', 'product/delete');
INSERT INTO `yii2_auth_item_child` VALUES ('超级管理员', 'product/index');
INSERT INTO `yii2_auth_item_child` VALUES ('超级管理员', 'product/update');
INSERT INTO `yii2_auth_item_child` VALUES ('超级管理员', 'product/view');
INSERT INTO `yii2_auth_item_child` VALUES ('超级管理员', 'role/auth');
INSERT INTO `yii2_auth_item_child` VALUES ('超级管理员', 'role/create');
INSERT INTO `yii2_auth_item_child` VALUES ('超级管理员', 'role/delete');
INSERT INTO `yii2_auth_item_child` VALUES ('超级管理员', 'role/index');
INSERT INTO `yii2_auth_item_child` VALUES ('超级管理员', 'role/update');
INSERT INTO `yii2_auth_item_child` VALUES ('超级管理员', 'servicer/create');
INSERT INTO `yii2_auth_item_child` VALUES ('超级管理员', 'servicer/index');
INSERT INTO `yii2_auth_item_child` VALUES ('超级管理员', 'servicer/view');
INSERT INTO `yii2_auth_item_child` VALUES ('超级管理员', 'transator/delete');
INSERT INTO `yii2_auth_item_child` VALUES ('超级管理员', 'transator/index');
INSERT INTO `yii2_auth_item_child` VALUES ('超级管理员', 'transator/update');
INSERT INTO `yii2_auth_item_child` VALUES ('超级管理员', 'transator/view');

-- ----------------------------
-- Table structure for yii2_auth_rule
-- ----------------------------
DROP TABLE IF EXISTS `yii2_auth_rule`;
CREATE TABLE `yii2_auth_rule` (
  `name` varchar(64) NOT NULL,
  `data` text,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of yii2_auth_rule
-- ----------------------------
INSERT INTO `yii2_auth_rule` VALUES ('', 'O:23:\"backend\\models\\AuthRule\":4:{s:4:\"name\";s:0:\"\";s:30:\"\0backend\\models\\AuthRule\0_rule\";r:1;s:9:\"createdAt\";i:1484734191;s:9:\"updatedAt\";i:1518057980;}', '1484734191', '1518057980');
INSERT INTO `yii2_auth_rule` VALUES ('#', 'O:23:\"backend\\models\\AuthRule\":4:{s:4:\"name\";s:1:\"#\";s:30:\"\0backend\\models\\AuthRule\0_rule\";r:1;s:9:\"createdAt\";i:1519808376;s:9:\"updatedAt\";i:1519810140;}', '1519808376', '1519810140');
INSERT INTO `yii2_auth_rule` VALUES ('admin/auth', 'O:23:\"backend\\models\\AuthRule\":4:{s:4:\"name\";s:10:\"admin/auth\";s:30:\"\0backend\\models\\AuthRule\0_rule\";r:1;s:9:\"createdAt\";i:1484734191;s:9:\"updatedAt\";i:1520059861;}', '1484734191', '1520059861');
INSERT INTO `yii2_auth_rule` VALUES ('admin/create', 'O:23:\"backend\\models\\AuthRule\":4:{s:4:\"name\";s:12:\"admin/create\";s:30:\"\0backend\\models\\AuthRule\0_rule\";r:1;s:9:\"createdAt\";i:1484734191;s:9:\"updatedAt\";i:1520059861;}', '1484734191', '1520059861');
INSERT INTO `yii2_auth_rule` VALUES ('admin/delete', 'O:23:\"backend\\models\\AuthRule\":4:{s:4:\"name\";s:12:\"admin/delete\";s:30:\"\0backend\\models\\AuthRule\0_rule\";r:1;s:9:\"createdAt\";i:1484734191;s:9:\"updatedAt\";i:1520059861;}', '1484734191', '1520059861');
INSERT INTO `yii2_auth_rule` VALUES ('admin/index', 'O:23:\"backend\\models\\AuthRule\":4:{s:4:\"name\";s:11:\"admin/index\";s:30:\"\0backend\\models\\AuthRule\0_rule\";r:1;s:9:\"createdAt\";i:1484734191;s:9:\"updatedAt\";i:1520059861;}', '1484734191', '1520059861');
INSERT INTO `yii2_auth_rule` VALUES ('admin/update', 'O:23:\"backend\\models\\AuthRule\":4:{s:4:\"name\";s:12:\"admin/update\";s:30:\"\0backend\\models\\AuthRule\0_rule\";r:1;s:9:\"createdAt\";i:1484734191;s:9:\"updatedAt\";i:1520059861;}', '1484734191', '1520059861');
INSERT INTO `yii2_auth_rule` VALUES ('backup/default/index', 'O:23:\"backend\\models\\AuthRule\":4:{s:4:\"name\";s:20:\"backup/default/index\";s:30:\"\0backend\\models\\AuthRule\0_rule\";r:1;s:9:\"createdAt\";i:1519808877;s:9:\"updatedAt\";i:1519811523;}', '1519808877', '1519811523');
INSERT INTO `yii2_auth_rule` VALUES ('combo/create', 'O:23:\"backend\\models\\AuthRule\":4:{s:4:\"name\";s:12:\"combo/create\";s:30:\"\0backend\\models\\AuthRule\0_rule\";r:1;s:9:\"createdAt\";i:1519808877;s:9:\"updatedAt\";i:1520059861;}', '1519808877', '1520059861');
INSERT INTO `yii2_auth_rule` VALUES ('combo/delete', 'O:23:\"backend\\models\\AuthRule\":4:{s:4:\"name\";s:12:\"combo/delete\";s:30:\"\0backend\\models\\AuthRule\0_rule\";r:1;s:9:\"createdAt\";i:1519808877;s:9:\"updatedAt\";i:1520059861;}', '1519808877', '1520059861');
INSERT INTO `yii2_auth_rule` VALUES ('combo/index', 'O:23:\"backend\\models\\AuthRule\":4:{s:4:\"name\";s:11:\"combo/index\";s:30:\"\0backend\\models\\AuthRule\0_rule\";r:1;s:9:\"createdAt\";i:1517996186;s:9:\"updatedAt\";i:1520059861;}', '1517996186', '1520059861');
INSERT INTO `yii2_auth_rule` VALUES ('combo/update', 'O:23:\"backend\\models\\AuthRule\":4:{s:4:\"name\";s:12:\"combo/update\";s:30:\"\0backend\\models\\AuthRule\0_rule\";r:1;s:9:\"createdAt\";i:1519808877;s:9:\"updatedAt\";i:1520059861;}', '1519808877', '1520059861');
INSERT INTO `yii2_auth_rule` VALUES ('combo/view', 'O:23:\"backend\\models\\AuthRule\":4:{s:4:\"name\";s:10:\"combo/view\";s:30:\"\0backend\\models\\AuthRule\0_rule\";r:1;s:9:\"createdAt\";i:1519378925;s:9:\"updatedAt\";i:1520059861;}', '1519378925', '1520059861');
INSERT INTO `yii2_auth_rule` VALUES ('config/attachment', 'O:23:\"backend\\models\\AuthRule\":4:{s:4:\"name\";s:17:\"config/attachment\";s:30:\"\0backend\\models\\AuthRule\0_rule\";r:1;s:9:\"createdAt\";i:1484734191;s:9:\"updatedAt\";i:1520059861;}', '1484734191', '1520059861');
INSERT INTO `yii2_auth_rule` VALUES ('config/basic', 'O:23:\"backend\\models\\AuthRule\":4:{s:4:\"name\";s:12:\"config/basic\";s:30:\"\0backend\\models\\AuthRule\0_rule\";r:1;s:9:\"createdAt\";i:1484734191;s:9:\"updatedAt\";i:1520059861;}', '1484734191', '1520059861');
INSERT INTO `yii2_auth_rule` VALUES ('config/send-mail', 'O:23:\"backend\\models\\AuthRule\":4:{s:4:\"name\";s:16:\"config/send-mail\";s:30:\"\0backend\\models\\AuthRule\0_rule\";r:1;s:9:\"createdAt\";i:1484734191;s:9:\"updatedAt\";i:1520059861;}', '1484734191', '1520059861');
INSERT INTO `yii2_auth_rule` VALUES ('database/export', 'O:23:\"backend\\models\\AuthRule\":4:{s:4:\"name\";s:15:\"database/export\";s:30:\"\0backend\\models\\AuthRule\0_rule\";r:1;s:9:\"createdAt\";i:1484734305;s:9:\"updatedAt\";i:1520059861;}', '1484734305', '1520059861');
INSERT INTO `yii2_auth_rule` VALUES ('excel-setting/update', 'O:23:\"backend\\models\\AuthRule\":4:{s:4:\"name\";s:20:\"excel-setting/update\";s:30:\"\0backend\\models\\AuthRule\0_rule\";r:1;s:9:\"createdAt\";i:1519451875;s:9:\"updatedAt\";i:1519451875;}', '1519451875', '1519451875');
INSERT INTO `yii2_auth_rule` VALUES ('excel/import', 'O:23:\"backend\\models\\AuthRule\":4:{s:4:\"name\";s:12:\"excel/import\";s:30:\"\0backend\\models\\AuthRule\0_rule\";r:1;s:9:\"createdAt\";i:1519436284;s:9:\"updatedAt\";i:1520059861;}', '1519436284', '1520059861');
INSERT INTO `yii2_auth_rule` VALUES ('excel/index', 'O:23:\"backend\\models\\AuthRule\":4:{s:4:\"name\";s:11:\"excel/index\";s:30:\"\0backend\\models\\AuthRule\0_rule\";r:1;s:9:\"createdAt\";i:1519436031;s:9:\"updatedAt\";i:1520059861;}', '1519436031', '1520059861');
INSERT INTO `yii2_auth_rule` VALUES ('index/frame', 'O:23:\"backend\\models\\AuthRule\":4:{s:4:\"name\";s:11:\"index/frame\";s:30:\"\0backend\\models\\AuthRule\0_rule\";r:1;s:9:\"createdAt\";i:1518057962;s:9:\"updatedAt\";i:1521797910;}', '1518057962', '1521797910');
INSERT INTO `yii2_auth_rule` VALUES ('index/index', 'O:23:\"backend\\models\\AuthRule\":4:{s:4:\"name\";s:11:\"index/index\";s:30:\"\0backend\\models\\AuthRule\0_rule\";r:1;s:9:\"createdAt\";i:1484734191;s:9:\"updatedAt\";i:1521797910;}', '1484734191', '1521797910');
INSERT INTO `yii2_auth_rule` VALUES ('menu/create', 'O:23:\"backend\\models\\AuthRule\":4:{s:4:\"name\";s:11:\"menu/create\";s:30:\"\0backend\\models\\AuthRule\0_rule\";r:1;s:9:\"createdAt\";i:1484734191;s:9:\"updatedAt\";i:1520059861;}', '1484734191', '1520059861');
INSERT INTO `yii2_auth_rule` VALUES ('menu/delete', 'O:23:\"backend\\models\\AuthRule\":4:{s:4:\"name\";s:11:\"menu/delete\";s:30:\"\0backend\\models\\AuthRule\0_rule\";r:1;s:9:\"createdAt\";i:1484734191;s:9:\"updatedAt\";i:1520059861;}', '1484734191', '1520059861');
INSERT INTO `yii2_auth_rule` VALUES ('menu/index', 'O:23:\"backend\\models\\AuthRule\":4:{s:4:\"name\";s:10:\"menu/index\";s:30:\"\0backend\\models\\AuthRule\0_rule\";r:1;s:9:\"createdAt\";i:1484734191;s:9:\"updatedAt\";i:1520059861;}', '1484734191', '1520059861');
INSERT INTO `yii2_auth_rule` VALUES ('menu/update', 'O:23:\"backend\\models\\AuthRule\":4:{s:4:\"name\";s:11:\"menu/update\";s:30:\"\0backend\\models\\AuthRule\0_rule\";r:1;s:9:\"createdAt\";i:1484734191;s:9:\"updatedAt\";i:1520059861;}', '1484734191', '1520059861');
INSERT INTO `yii2_auth_rule` VALUES ('order/create', 'O:23:\"backend\\models\\AuthRule\":4:{s:4:\"name\";s:12:\"order/create\";s:30:\"\0backend\\models\\AuthRule\0_rule\";r:1;s:9:\"createdAt\";i:1518074401;s:9:\"updatedAt\";i:1520059861;}', '1518074401', '1520059861');
INSERT INTO `yii2_auth_rule` VALUES ('order/delete', 'O:23:\"backend\\models\\AuthRule\":4:{s:4:\"name\";s:12:\"order/delete\";s:30:\"\0backend\\models\\AuthRule\0_rule\";r:1;s:9:\"createdAt\";i:1519450583;s:9:\"updatedAt\";i:1520059861;}', '1519450583', '1520059861');
INSERT INTO `yii2_auth_rule` VALUES ('order/index', 'O:23:\"backend\\models\\AuthRule\":4:{s:4:\"name\";s:11:\"order/index\";s:30:\"\0backend\\models\\AuthRule\0_rule\";r:1;s:9:\"createdAt\";i:1517996186;s:9:\"updatedAt\";i:1520059861;}', '1517996186', '1520059861');
INSERT INTO `yii2_auth_rule` VALUES ('order/update', 'O:23:\"backend\\models\\AuthRule\":4:{s:4:\"name\";s:12:\"order/update\";s:30:\"\0backend\\models\\AuthRule\0_rule\";r:1;s:9:\"createdAt\";i:1519450583;s:9:\"updatedAt\";i:1520059861;}', '1519450583', '1520059861');
INSERT INTO `yii2_auth_rule` VALUES ('order/view', 'O:23:\"backend\\models\\AuthRule\":4:{s:4:\"name\";s:10:\"order/view\";s:30:\"\0backend\\models\\AuthRule\0_rule\";r:1;s:9:\"createdAt\";i:1519377930;s:9:\"updatedAt\";i:1520059861;}', '1519377930', '1520059861');
INSERT INTO `yii2_auth_rule` VALUES ('product/delete', 'O:23:\"backend\\models\\AuthRule\":4:{s:4:\"name\";s:14:\"product/delete\";s:30:\"\0backend\\models\\AuthRule\0_rule\";r:1;s:9:\"createdAt\";i:1519808877;s:9:\"updatedAt\";i:1520059861;}', '1519808877', '1520059861');
INSERT INTO `yii2_auth_rule` VALUES ('product/index', 'O:23:\"backend\\models\\AuthRule\":4:{s:4:\"name\";s:13:\"product/index\";s:30:\"\0backend\\models\\AuthRule\0_rule\";r:1;s:9:\"createdAt\";i:1517996186;s:9:\"updatedAt\";i:1520059861;}', '1517996186', '1520059861');
INSERT INTO `yii2_auth_rule` VALUES ('product/update', 'O:23:\"backend\\models\\AuthRule\":4:{s:4:\"name\";s:14:\"product/update\";s:30:\"\0backend\\models\\AuthRule\0_rule\";r:1;s:9:\"createdAt\";i:1519808877;s:9:\"updatedAt\";i:1520059861;}', '1519808877', '1520059861');
INSERT INTO `yii2_auth_rule` VALUES ('product/view', 'O:23:\"backend\\models\\AuthRule\":4:{s:4:\"name\";s:12:\"product/view\";s:30:\"\0backend\\models\\AuthRule\0_rule\";r:1;s:9:\"createdAt\";i:1519378499;s:9:\"updatedAt\";i:1520059861;}', '1519378499', '1520059861');
INSERT INTO `yii2_auth_rule` VALUES ('role/auth', 'O:23:\"backend\\models\\AuthRule\":4:{s:4:\"name\";s:9:\"role/auth\";s:30:\"\0backend\\models\\AuthRule\0_rule\";r:1;s:9:\"createdAt\";i:1484734191;s:9:\"updatedAt\";i:1520059861;}', '1484734191', '1520059861');
INSERT INTO `yii2_auth_rule` VALUES ('role/create', 'O:23:\"backend\\models\\AuthRule\":4:{s:4:\"name\";s:11:\"role/create\";s:30:\"\0backend\\models\\AuthRule\0_rule\";r:1;s:9:\"createdAt\";i:1484734191;s:9:\"updatedAt\";i:1520059861;}', '1484734191', '1520059861');
INSERT INTO `yii2_auth_rule` VALUES ('role/delete', 'O:23:\"backend\\models\\AuthRule\":4:{s:4:\"name\";s:11:\"role/delete\";s:30:\"\0backend\\models\\AuthRule\0_rule\";r:1;s:9:\"createdAt\";i:1484734191;s:9:\"updatedAt\";i:1520059861;}', '1484734191', '1520059861');
INSERT INTO `yii2_auth_rule` VALUES ('role/export-setting', 'O:23:\"backend\\models\\AuthRule\":4:{s:4:\"name\";s:19:\"role/export-setting\";s:30:\"\0backend\\models\\AuthRule\0_rule\";r:1;s:9:\"createdAt\";i:1519438814;s:9:\"updatedAt\";i:1519451875;}', '1519438814', '1519451875');
INSERT INTO `yii2_auth_rule` VALUES ('role/index', 'O:23:\"backend\\models\\AuthRule\":4:{s:4:\"name\";s:10:\"role/index\";s:30:\"\0backend\\models\\AuthRule\0_rule\";r:1;s:9:\"createdAt\";i:1484734191;s:9:\"updatedAt\";i:1520059861;}', '1484734191', '1520059861');
INSERT INTO `yii2_auth_rule` VALUES ('role/update', 'O:23:\"backend\\models\\AuthRule\":4:{s:4:\"name\";s:11:\"role/update\";s:30:\"\0backend\\models\\AuthRule\0_rule\";r:1;s:9:\"createdAt\";i:1484734191;s:9:\"updatedAt\";i:1520059861;}', '1484734191', '1520059861');
INSERT INTO `yii2_auth_rule` VALUES ('servicer/create', 'O:23:\"backend\\models\\AuthRule\":4:{s:4:\"name\";s:15:\"servicer/create\";s:30:\"\0backend\\models\\AuthRule\0_rule\";r:1;s:9:\"createdAt\";i:1519810140;s:9:\"updatedAt\";i:1520059861;}', '1519810140', '1520059861');
INSERT INTO `yii2_auth_rule` VALUES ('servicer/index', 'O:23:\"backend\\models\\AuthRule\":4:{s:4:\"name\";s:14:\"servicer/index\";s:30:\"\0backend\\models\\AuthRule\0_rule\";r:1;s:9:\"createdAt\";i:1517996187;s:9:\"updatedAt\";i:1520059861;}', '1517996187', '1520059861');
INSERT INTO `yii2_auth_rule` VALUES ('servicer/view', 'O:23:\"backend\\models\\AuthRule\":4:{s:4:\"name\";s:13:\"servicer/view\";s:30:\"\0backend\\models\\AuthRule\0_rule\";r:1;s:9:\"createdAt\";i:1519884478;s:9:\"updatedAt\";i:1520059861;}', '1519884478', '1520059861');
INSERT INTO `yii2_auth_rule` VALUES ('transator/delete', 'O:23:\"backend\\models\\AuthRule\":4:{s:4:\"name\";s:16:\"transator/delete\";s:30:\"\0backend\\models\\AuthRule\0_rule\";r:1;s:9:\"createdAt\";i:1519810140;s:9:\"updatedAt\";i:1520059861;}', '1519810140', '1520059861');
INSERT INTO `yii2_auth_rule` VALUES ('transator/index', 'O:23:\"backend\\models\\AuthRule\":4:{s:4:\"name\";s:15:\"transator/index\";s:30:\"\0backend\\models\\AuthRule\0_rule\";r:1;s:9:\"createdAt\";i:1517996187;s:9:\"updatedAt\";i:1520059861;}', '1517996187', '1520059861');
INSERT INTO `yii2_auth_rule` VALUES ('transator/update', 'O:23:\"backend\\models\\AuthRule\":4:{s:4:\"name\";s:16:\"transator/update\";s:30:\"\0backend\\models\\AuthRule\0_rule\";r:1;s:9:\"createdAt\";i:1519810140;s:9:\"updatedAt\";i:1520059861;}', '1519810140', '1520059861');
INSERT INTO `yii2_auth_rule` VALUES ('transator/view', 'O:23:\"backend\\models\\AuthRule\":4:{s:4:\"name\";s:14:\"transator/view\";s:30:\"\0backend\\models\\AuthRule\0_rule\";r:1;s:9:\"createdAt\";i:1519884478;s:9:\"updatedAt\";i:1520059861;}', '1519884478', '1520059861');

-- ----------------------------
-- Table structure for yii2_config
-- ----------------------------
DROP TABLE IF EXISTS `yii2_config`;
CREATE TABLE `yii2_config` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `keyid` varchar(20) NOT NULL DEFAULT '',
  `title` varchar(100) NOT NULL DEFAULT '',
  `data` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `keyid` (`keyid`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of yii2_config
-- ----------------------------
INSERT INTO `yii2_config` VALUES ('1', 'basic', '', '{\"sitename\":\"Yii2 CMS\",\"url\":\"http:\\/\\/www.test-yii2cms.com\",\"logo\":\"\\/statics\\/themes\\/admin\\/images\\/logo.png\",\"seo_keywords\":\"Yii2,CMS\",\"seo_description\":\"Yii2,CMS\",\"copyright\":\"@Yii2 CMS\",\"statcode\":\"\",\"close\":\"0\",\"close_reason\":\"\\u7ad9\\u70b9\\u5347\\u7ea7\\u4e2d, \\u8bf7\\u7a0d\\u540e\\u8bbf\\u95ee!\"}');
INSERT INTO `yii2_config` VALUES ('2', 'sendmail', '', '{\"mail_type\":\"0\",\"smtp_server\":\"smtp.qq.com\",\"smtp_port\":\"25\",\"auth\":\"1\",\"openssl\":\"1\",\"smtp_user\":\"771405950\",\"smtp_pwd\":\"qiaoBo1989122\",\"send_email\":\"771405950@qq.com\",\"nickname\":\"\\u8fb9\\u8d70\\u8fb9\\u4e54\",\"sign\":\"<hr \\/>\\r\\n\\u90ae\\u4ef6\\u7b7e\\u540d\\uff1a\\u6b22\\u8fce\\u8bbf\\u95ee <a href=\\\"http:\\/\\/www.test-yii2cms.com\\\" target=\\\"_blank\\\">Yii2 CMS<\\/a>\"}');
INSERT INTO `yii2_config` VALUES ('3', 'attachment', '', '{\"attachment_size\":\"2048\",\"attachment_suffix\":\"jpg|jpeg|gif|bmp|png\",\"watermark_enable\":\"1\",\"watermark_pos\":\"0\",\"watermark_text\":\"Yii2 CMS\"}');

-- ----------------------------
-- Table structure for yii2_menu
-- ----------------------------
DROP TABLE IF EXISTS `yii2_menu`;
CREATE TABLE `yii2_menu` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `pid` int(10) unsigned NOT NULL DEFAULT '0',
  `name` varchar(50) NOT NULL DEFAULT '',
  `url` varchar(60) NOT NULL DEFAULT '',
  `icon_style` varchar(50) NOT NULL DEFAULT '',
  `display` tinyint(3) unsigned NOT NULL DEFAULT '1',
  `sort` smallint(5) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=52 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of yii2_menu
-- ----------------------------
INSERT INTO `yii2_menu` VALUES ('1', '0', '我的面板', '#', 'fa-home', '0', '0');
INSERT INTO `yii2_menu` VALUES ('2', '0', '系统设置', 'config/basic', 'fa-cogs', '1', '99');
INSERT INTO `yii2_menu` VALUES ('3', '0', '管理员设置', 'admin/index', 'fa-user', '1', '98');
INSERT INTO `yii2_menu` VALUES ('6', '0', '数据库设置', 'database/export', 'fa-hdd-o', '1', '99');
INSERT INTO `yii2_menu` VALUES ('8', '1', '系统信息', '#', '', '1', '0');
INSERT INTO `yii2_menu` VALUES ('9', '2', '站点配置', 'config/basic', '', '0', '0');
INSERT INTO `yii2_menu` VALUES ('10', '2', '后台菜单管理', 'menu/index', '', '1', '0');
INSERT INTO `yii2_menu` VALUES ('11', '3', '管理员管理', 'admin/index', '', '1', '0');
INSERT INTO `yii2_menu` VALUES ('12', '3', '角色管理', 'role/index', '', '1', '0');
INSERT INTO `yii2_menu` VALUES ('16', '5', '用户管理', '', '', '0', '0');
INSERT INTO `yii2_menu` VALUES ('17', '6', '数据库管理', 'backup/default/index', '', '1', '0');
INSERT INTO `yii2_menu` VALUES ('20', '9', '基本配置', 'config/basic', '', '1', '0');
INSERT INTO `yii2_menu` VALUES ('21', '9', '邮箱配置', 'config/send-mail', '', '1', '0');
INSERT INTO `yii2_menu` VALUES ('22', '9', '附件配置', 'config/attachment', '', '1', '0');
INSERT INTO `yii2_menu` VALUES ('23', '10', '添加菜单', 'menu/create', '', '1', '0');
INSERT INTO `yii2_menu` VALUES ('24', '10', '更新', 'menu/update', '', '1', '0');
INSERT INTO `yii2_menu` VALUES ('25', '10', '删除', 'menu/delete', '', '1', '0');
INSERT INTO `yii2_menu` VALUES ('26', '11', '添加', 'admin/create', '', '1', '0');
INSERT INTO `yii2_menu` VALUES ('27', '11', '更新', 'admin/update', '', '1', '0');
INSERT INTO `yii2_menu` VALUES ('28', '11', '授权', 'admin/auth', '', '1', '0');
INSERT INTO `yii2_menu` VALUES ('29', '11', '删除', 'admin/delete', '', '1', '0');
INSERT INTO `yii2_menu` VALUES ('30', '12', '添加', 'role/create', '', '1', '0');
INSERT INTO `yii2_menu` VALUES ('31', '12', '更新', 'role/update', '', '1', '0');
INSERT INTO `yii2_menu` VALUES ('32', '12', '授权', 'role/auth', '', '1', '0');
INSERT INTO `yii2_menu` VALUES ('33', '12', '删除', 'role/delete', '', '1', '0');
INSERT INTO `yii2_menu` VALUES ('41', '40', '国家列表', 'country/index', 'fa-flag', '1', '1');
INSERT INTO `yii2_menu` VALUES ('48', '0', '系统信息', 'index/index', 'fa-home', '1', '0');
INSERT INTO `yii2_menu` VALUES ('49', '48', '系统信息', 'index/index', '', '1', '0');
INSERT INTO `yii2_menu` VALUES ('51', '48', '左侧菜单', 'index/frame', '', '0', '0');

-- ----------------------------
-- Table structure for yii2_migration
-- ----------------------------
DROP TABLE IF EXISTS `yii2_migration`;
CREATE TABLE `yii2_migration` (
  `version` varchar(180) NOT NULL,
  `apply_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of yii2_migration
-- ----------------------------
INSERT INTO `yii2_migration` VALUES ('m000000_000000_base', '1482231528');
INSERT INTO `yii2_migration` VALUES ('m130524_201442_init', '1482231534');

-- ----------------------------
-- Table structure for yii2_session
-- ----------------------------
DROP TABLE IF EXISTS `yii2_session`;
CREATE TABLE `yii2_session` (
  `id` char(40) NOT NULL,
  `expire` int(11) DEFAULT NULL,
  `data` blob,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of yii2_session
-- ----------------------------
INSERT INTO `yii2_session` VALUES ('59p2nnquc9bm1qm82ceuib5p77', '1520501391', 0x5F5F666C6173687C613A303A7B7D5F5F69647C733A313A2231223B);
INSERT INTO `yii2_session` VALUES ('b76grnk3j31ped7egbocec0e15', '1522131383', 0x5F5F666C6173687C613A303A7B7D5F5F72657475726E55726C7C733A31303A222F61646D696E2E706870223B5F5F69647C733A313A2231223B);
INSERT INTO `yii2_session` VALUES ('blib8tg1qtbvjou4ikv3rko104', '1522028406', 0x5F5F666C6173687C613A303A7B7D5F5F72657475726E55726C7C733A31303A222F61646D696E2E706870223B5F5F69647C733A313A2231223B);
INSERT INTO `yii2_session` VALUES ('gln4hif8n2la7mojr8ueeg5ob5', '1520565346', 0x5F5F666C6173687C613A303A7B7D5F5F69647C733A313A2231223B);
INSERT INTO `yii2_session` VALUES ('lu11t2h9aos5h6rp7uk1o415e1', '1522376567', 0x5F5F666C6173687C613A303A7B7D5F5F72657475726E55726C7C733A31303A222F61646D696E2E706870223B5F5F69647C733A313A2231223B);
INSERT INTO `yii2_session` VALUES ('nv06lmqqc55j7vlqercpfjiis2', '1521801285', 0x5F5F666C6173687C613A303A7B7D5F5F69647C733A313A2231223B);
INSERT INTO `yii2_session` VALUES ('p4ntted940apkaroi180vtn9m6', '1520561762', 0x5F5F666C6173687C613A303A7B7D5F5F69647C733A313A2231223B);
INSERT INTO `yii2_session` VALUES ('rhkp6k0j4emqut1e7nfn8dkm92', '1522057617', 0x5F5F666C6173687C613A303A7B7D5F5F69647C733A313A2231223B);
INSERT INTO `yii2_session` VALUES ('sf8dblb65kgake8vqubbe54vv7', '1521788995', 0x5F5F666C6173687C613A303A7B7D5F5F72657475726E55726C7C733A31303A222F61646D696E2E706870223B);
INSERT INTO `yii2_session` VALUES ('skolfm5ejltdn94i8onsug9so5', '1521602831', 0x5F5F666C6173687C613A303A7B7D5F5F72657475726E55726C7C733A31303A222F61646D696E2E706870223B5F5F69647C733A313A2231223B);
INSERT INTO `yii2_session` VALUES ('tobm2ogmb9dsjos5io99jioqo2', '1521516907', 0x5F5F666C6173687C613A303A7B7D5F5F72657475726E55726C7C733A31303A222F61646D696E2E706870223B5F5F69647C733A313A2231223B);
INSERT INTO `yii2_session` VALUES ('v6u83dndk0dh7kek77afqi5go2', '1521789121', 0x5F5F666C6173687C613A303A7B7D5F5F72657475726E55726C7C733A31303A222F61646D696E2E706870223B);

-- ----------------------------
-- Table structure for yii2_user
-- ----------------------------
DROP TABLE IF EXISTS `yii2_user`;
CREATE TABLE `yii2_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `auth_key` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `password_hash` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password_reset_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` smallint(6) NOT NULL DEFAULT '10',
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`),
  UNIQUE KEY `password_reset_token` (`password_reset_token`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of yii2_user
-- ----------------------------
INSERT INTO `yii2_user` VALUES ('2', 'test', '1xwm0gV1fjlR98lx8U4b_4_tapTqkB9V', '$2y$13$6VIgT4Nzm7B7KbkoXVoqwe4/EBQA0/BFp.kcFHu7kxXJlupRo3wea', 'ynaCkEV9-U63ZFJ5Srq-jSdxQuHAM4Gt_1522372800', 'test@qq.com', '10', '1522307200', '1522372800');
INSERT INTO `yii2_user` VALUES ('3', '876505905', 'Hb-OLs9Aw-La9gvfXefMrRUAKyyfVLGi', '$2y$13$thutBDehHEfGBYP6FF9X..mGFZPZjBDBuF.3obK2NoFO/SoNqxaDm', null, '876505905@qq.com', '10', '1522373864', '1522374696');
