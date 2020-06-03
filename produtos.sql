/*
 Navicat Premium Data Transfer

 Source Server         : localhost
 Source Server Type    : MySQL
 Source Server Version : 100406
 Source Host           : localhost:3306
 Source Schema         : produtos

 Target Server Type    : MySQL
 Target Server Version : 100406
 File Encoding         : 65001

 Date: 02/06/2020 23:59:07
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for admin_users
-- ----------------------------
DROP TABLE IF EXISTS `admin_users`;
CREATE TABLE `admin_users`  (
  `uid` int(11) NOT NULL AUTO_INCREMENT,
  `date` int(10) UNSIGNED NULL DEFAULT NULL,
  `nome` varchar(200) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `login` varchar(200) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `pwd` char(40) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `email` varchar(200) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `status` int(11) NULL DEFAULT 1,
  `tipo` int(11) NULL DEFAULT 2 COMMENT '1 - admin - 2 - usuario',
  `conf` blob NULL,
  PRIMARY KEY (`uid`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 10 CHARACTER SET = utf8 COLLATE = utf8_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of admin_users
-- ----------------------------
INSERT INTO `admin_users` VALUES (1, 1407943729, 'Aprovador', 'admin', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'aprovador@teste', 1, 1, NULL);
INSERT INTO `admin_users` VALUES (9, NULL, 'Analista', NULL, '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'analista@teste', 1, 2, NULL);

-- ----------------------------
-- Table structure for produtos
-- ----------------------------
DROP TABLE IF EXISTS `produtos`;
CREATE TABLE `produtos`  (
  `sid` int(10) NOT NULL AUTO_INCREMENT,
  `imagem` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `status` varchar(10) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `nome` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  PRIMARY KEY (`sid`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of produtos
-- ----------------------------
INSERT INTO `produtos` VALUES (1, '/static/gabrieluploads/197c1_ba4fe9.png', 'pendente', 'PROD APROVADO');
INSERT INTO `produtos` VALUES (2, '/static/gabrieluploads/0601a_d3e9f5.jpg', 'reprovado', 'PROD RECUSADO');
INSERT INTO `produtos` VALUES (3, '/static/gabrieluploads/1721d_3af015.jpg', 'aprovado', 'PROD ANALISTA');

SET FOREIGN_KEY_CHECKS = 1;
