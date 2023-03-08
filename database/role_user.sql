/*
 Navicat Premium Data Transfer

 Source Server         : local
 Source Server Type    : MySQL
 Source Server Version : 80031
 Source Host           : localhost:3306
 Source Schema         : simethris30

 Target Server Type    : MySQL
 Target Server Version : 80031
 File Encoding         : 65001

 Date: 08/03/2023 16:57:35
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for role_user
-- ----------------------------
DROP TABLE IF EXISTS `role_user`;
CREATE TABLE `role_user` (
  `user_id` bigint unsigned NOT NULL,
  `role_id` bigint unsigned NOT NULL,
  KEY `user_id_fk_6464594` (`user_id`),
  KEY `role_id_fk_6464594` (`role_id`),
  CONSTRAINT `role_id_fk_6464594` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE,
  CONSTRAINT `user_id_fk_6464594` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- ----------------------------
-- Records of role_user
-- ----------------------------
BEGIN;
INSERT INTO `role_user` (`user_id`, `role_id`) VALUES (1, 1);
INSERT INTO `role_user` (`user_id`, `role_id`) VALUES (2, 2);
INSERT INTO `role_user` (`user_id`, `role_id`) VALUES (3, 3);
INSERT INTO `role_user` (`user_id`, `role_id`) VALUES (4, 4);
INSERT INTO `role_user` (`user_id`, `role_id`) VALUES (15, 4);
INSERT INTO `role_user` (`user_id`, `role_id`) VALUES (23, 2);
INSERT INTO `role_user` (`user_id`, `role_id`) VALUES (44, 4);
INSERT INTO `role_user` (`user_id`, `role_id`) VALUES (45, 4);
INSERT INTO `role_user` (`user_id`, `role_id`) VALUES (21, 2);
INSERT INTO `role_user` (`user_id`, `role_id`) VALUES (51, 4);
INSERT INTO `role_user` (`user_id`, `role_id`) VALUES (53, 2);
INSERT INTO `role_user` (`user_id`, `role_id`) VALUES (54, 2);
COMMIT;

SET FOREIGN_KEY_CHECKS = 1;
