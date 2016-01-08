/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50625
Source Host           : 127.0.0.1:3306
Source Database       : payroll

Target Server Type    : MYSQL
Target Server Version : 50625
File Encoding         : 65001

Date: 2015-12-04 15:25:29
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for jabatan
-- ----------------------------
DROP TABLE IF EXISTS `jabatan`;
CREATE TABLE `jabatan` (
  `id` varchar(36) NOT NULL DEFAULT '',
  `nama` varchar(25) DEFAULT NULL,
  `pokok` varchar(10) DEFAULT NULL,
  `tunjangan` varchar(10) DEFAULT NULL,
  `thr` varchar(10) DEFAULT NULL,
  `buat` datetime DEFAULT NULL,
  `ubah` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of jabatan
-- ----------------------------
INSERT INTO `jabatan` VALUES ('48db2ca3-9a20-11e5-b977-843497738d6e', 'Direktur', '150000', '1500000', '7000000', '2015-12-04 07:41:32', '2015-12-04 14:35:27');
INSERT INTO `jabatan` VALUES ('837e5248-9a23-11e5-b977-843497738d6e', 'Pegawai', '100000', '1000000', '3000000', '2015-12-04 08:08:21', '2015-12-04 14:43:09');
INSERT INTO `jabatan` VALUES ('ec88883d-9a20-11e5-b977-843497738d6e', 'Staff', '125000', '1250000', '4500000', '2015-12-04 07:49:49', '2015-12-04 14:43:46');

-- ----------------------------
-- Table structure for users
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(4) NOT NULL AUTO_INCREMENT,
  `username` varchar(15) NOT NULL,
  `password` varchar(32) NOT NULL,
  `level` varchar(10) NOT NULL,
  `jabatan` varchar(36) DEFAULT NULL,
  `nama` varchar(50) DEFAULT NULL,
  `alamat` varchar(255) DEFAULT NULL,
  `jk` varchar(1) DEFAULT NULL,
  `buat` datetime DEFAULT NULL,
  `ubah` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO `users` VALUES ('1', 'elya', '7fff34dae3e0516a76f363aff7c35fd6', 'Admin', 'ec88883d-9a20-11e5-b977-843497738d6e', 'Elya', 'Tangerang', 'P', '2015-12-04 06:20:55', '2015-12-04 14:38:02');
INSERT INTO `users` VALUES ('5', 'direktur', '4fbfd324f5ffcdff5dbf6f019b02eca8', 'Direktur', '48db2ca3-9a20-11e5-b977-843497738d6e', 'Direktur', 'Rumah Direktur', 'L', '2015-12-04 11:13:26', '2015-12-04 11:19:36');
