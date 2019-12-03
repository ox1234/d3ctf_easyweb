/*
 Navicat Premium Data Transfer

 Source Server         : localhost
 Source Server Type    : MySQL
 Source Server Version : 50728
 Source Host           : localhost:3306
 Source Schema         : lctf

 Target Server Type    : MySQL
 Target Server Version : 50728
 File Encoding         : 65001

 Date: 22/10/2019 11:35:52
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

CREATE DATABASE lctf;
USE lctf;
-- ----------------------------
-- Table structure for ci_sessions
-- ----------------------------
DROP TABLE IF EXISTS `ci_sessions`;
CREATE TABLE `ci_sessions` (
  `id` varchar(128) NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `timestamp` int(10) unsigned NOT NULL DEFAULT '0',
  `data` blob NOT NULL,
  KEY `ci_sessions_timestamp` (`timestamp`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for userRender
-- ----------------------------
DROP TABLE IF EXISTS `userRender`;
CREATE TABLE `userRender` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `userView` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for userTable
-- ----------------------------
DROP TABLE IF EXISTS `userTable`;
CREATE TABLE `userTable` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `userId` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=48 DEFAULT CHARSET=utf8;

SET FOREIGN_KEY_CHECKS = 1;
