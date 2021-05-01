/*
 Navicat Premium Data Transfer

 Source Server         : local
 Source Server Type    : MySQL
 Source Server Version : 100411
 Source Host           : localhost:3306
 Source Schema         : processo

 Target Server Type    : MySQL
 Target Server Version : 100411
 File Encoding         : 65001

 Date: 01/05/2021 00:28:37
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for admins
-- ----------------------------
DROP TABLE IF EXISTS `admins`;
CREATE TABLE `admins`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` datetime(0) NULL DEFAULT NULL,
  `updated_at` datetime(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of admins
-- ----------------------------
INSERT INTO `admins` VALUES (1, 'jonas', '118414337e80d55a255e5e27caab378c', 'jonasearth1@gmail.com', 'jonas', NULL, NULL);

-- ----------------------------
-- Table structure for moviments
-- ----------------------------
DROP TABLE IF EXISTS `moviments`;
CREATE TABLE `moviments`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idUser` int(11) NOT NULL,
  `movimentType` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `value` decimal(10, 2) NOT NULL,
  `created_at` datetime(0) NOT NULL,
  `updated_at` datetime(0) NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 10 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of moviments
-- ----------------------------
INSERT INTO `moviments` VALUES (2, 1, 'CREDIT', 22.84, '2021-04-30 14:00:50', '2021-04-30 14:00:50');
INSERT INTO `moviments` VALUES (3, 1, 'CREDIT', 22.84, '2021-04-30 14:00:51', '2021-04-30 14:00:51');
INSERT INTO `moviments` VALUES (4, 1, 'DEBIT', 22.84, '2021-04-30 14:01:00', '2021-04-30 14:01:00');
INSERT INTO `moviments` VALUES (6, 1, 'DEBIT', 22.84, '2021-04-30 14:01:16', '2021-04-30 14:01:16');
INSERT INTO `moviments` VALUES (7, 1, 'REFOUND', 22.84, '2021-04-30 18:44:48', '2021-04-30 18:44:48');
INSERT INTO `moviments` VALUES (8, 1, 'REFOUND', 22.84, '2021-04-30 18:44:50', '2021-04-30 18:44:50');
INSERT INTO `moviments` VALUES (9, 1, 'DEBIT', 1500.00, '2021-04-30 18:56:14', '2021-04-30 18:56:14');

-- ----------------------------
-- Table structure for users
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(80) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` datetime(0) NULL DEFAULT NULL,
  `updated_at` datetime(0) NULL DEFAULT NULL,
  `birthday` date NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `balance` decimal(10, 2) NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 23 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO `users` VALUES (1, 'jonas', '2021-02-17 21:19:50', '2021-04-30 18:33:25', '1997-08-11', 'jonasearthhasdasdasdj232323asdasdsd2@gmail.com', 1544.22);
INSERT INTO `users` VALUES (16, 'jonas', '2021-04-30 12:28:19', '2021-04-30 12:28:19', '1997-08-28', 'jonasearth23232323@gmail.com', 0.00);
INSERT INTO `users` VALUES (17, 'jonas', '2021-04-30 12:28:29', '2021-04-30 12:28:29', '1997-08-28', 'jonasearth2323232@gmail.com', 0.00);
INSERT INTO `users` VALUES (18, 'jonas', '2021-04-30 12:31:31', '2021-04-30 12:31:31', '0000-00-00', 'jonasearthhj2323232@gmail.com', 0.00);
INSERT INTO `users` VALUES (19, 'jonas', '2021-04-30 12:33:55', '2021-04-30 12:33:55', '0000-00-00', 'jonasearthhj232323asd2@gmail.com', 0.00);

SET FOREIGN_KEY_CHECKS = 1;
