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

 Date: 08/03/2023 16:57:06
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for permission_role
-- ----------------------------
DROP TABLE IF EXISTS `permission_role`;
CREATE TABLE `permission_role` (
  `role_id` bigint unsigned NOT NULL,
  `permission_id` bigint unsigned NOT NULL,
  KEY `role_id_fk_6464585` (`role_id`),
  KEY `permission_id_fk_6464585` (`permission_id`),
  CONSTRAINT `permission_id_fk_6464585` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  CONSTRAINT `role_id_fk_6464585` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- ----------------------------
-- Records of permission_role
-- ----------------------------
BEGIN;
INSERT INTO `permission_role` (`role_id`, `permission_id`) VALUES (1, 1);
INSERT INTO `permission_role` (`role_id`, `permission_id`) VALUES (1, 2);
INSERT INTO `permission_role` (`role_id`, `permission_id`) VALUES (1, 3);
INSERT INTO `permission_role` (`role_id`, `permission_id`) VALUES (1, 4);
INSERT INTO `permission_role` (`role_id`, `permission_id`) VALUES (1, 5);
INSERT INTO `permission_role` (`role_id`, `permission_id`) VALUES (1, 6);
INSERT INTO `permission_role` (`role_id`, `permission_id`) VALUES (1, 7);
INSERT INTO `permission_role` (`role_id`, `permission_id`) VALUES (1, 8);
INSERT INTO `permission_role` (`role_id`, `permission_id`) VALUES (1, 9);
INSERT INTO `permission_role` (`role_id`, `permission_id`) VALUES (1, 10);
INSERT INTO `permission_role` (`role_id`, `permission_id`) VALUES (1, 11);
INSERT INTO `permission_role` (`role_id`, `permission_id`) VALUES (1, 12);
INSERT INTO `permission_role` (`role_id`, `permission_id`) VALUES (1, 13);
INSERT INTO `permission_role` (`role_id`, `permission_id`) VALUES (1, 14);
INSERT INTO `permission_role` (`role_id`, `permission_id`) VALUES (1, 15);
INSERT INTO `permission_role` (`role_id`, `permission_id`) VALUES (1, 16);
INSERT INTO `permission_role` (`role_id`, `permission_id`) VALUES (1, 17);
INSERT INTO `permission_role` (`role_id`, `permission_id`) VALUES (1, 18);
INSERT INTO `permission_role` (`role_id`, `permission_id`) VALUES (1, 19);
INSERT INTO `permission_role` (`role_id`, `permission_id`) VALUES (2, 19);
INSERT INTO `permission_role` (`role_id`, `permission_id`) VALUES (2, 20);
INSERT INTO `permission_role` (`role_id`, `permission_id`) VALUES (2, 21);
INSERT INTO `permission_role` (`role_id`, `permission_id`) VALUES (3, 21);
INSERT INTO `permission_role` (`role_id`, `permission_id`) VALUES (3, 19);
INSERT INTO `permission_role` (`role_id`, `permission_id`) VALUES (3, 20);
INSERT INTO `permission_role` (`role_id`, `permission_id`) VALUES (1, 20);
INSERT INTO `permission_role` (`role_id`, `permission_id`) VALUES (2, 26);
INSERT INTO `permission_role` (`role_id`, `permission_id`) VALUES (4, 21);
INSERT INTO `permission_role` (`role_id`, `permission_id`) VALUES (4, 20);
INSERT INTO `permission_role` (`role_id`, `permission_id`) VALUES (4, 24);
INSERT INTO `permission_role` (`role_id`, `permission_id`) VALUES (4, 19);
INSERT INTO `permission_role` (`role_id`, `permission_id`) VALUES (4, 27);
INSERT INTO `permission_role` (`role_id`, `permission_id`) VALUES (4, 28);
INSERT INTO `permission_role` (`role_id`, `permission_id`) VALUES (4, 29);
INSERT INTO `permission_role` (`role_id`, `permission_id`) VALUES (4, 30);
INSERT INTO `permission_role` (`role_id`, `permission_id`) VALUES (4, 32);
INSERT INTO `permission_role` (`role_id`, `permission_id`) VALUES (4, 31);
INSERT INTO `permission_role` (`role_id`, `permission_id`) VALUES (4, 33);
INSERT INTO `permission_role` (`role_id`, `permission_id`) VALUES (4, 34);
INSERT INTO `permission_role` (`role_id`, `permission_id`) VALUES (4, 39);
INSERT INTO `permission_role` (`role_id`, `permission_id`) VALUES (4, 40);
INSERT INTO `permission_role` (`role_id`, `permission_id`) VALUES (4, 41);
INSERT INTO `permission_role` (`role_id`, `permission_id`) VALUES (4, 42);
INSERT INTO `permission_role` (`role_id`, `permission_id`) VALUES (2, 39);
INSERT INTO `permission_role` (`role_id`, `permission_id`) VALUES (2, 40);
INSERT INTO `permission_role` (`role_id`, `permission_id`) VALUES (2, 41);
INSERT INTO `permission_role` (`role_id`, `permission_id`) VALUES (2, 42);
INSERT INTO `permission_role` (`role_id`, `permission_id`) VALUES (3, 43);
INSERT INTO `permission_role` (`role_id`, `permission_id`) VALUES (3, 44);
INSERT INTO `permission_role` (`role_id`, `permission_id`) VALUES (3, 46);
INSERT INTO `permission_role` (`role_id`, `permission_id`) VALUES (1, 47);
INSERT INTO `permission_role` (`role_id`, `permission_id`) VALUES (1, 48);
INSERT INTO `permission_role` (`role_id`, `permission_id`) VALUES (1, 51);
INSERT INTO `permission_role` (`role_id`, `permission_id`) VALUES (1, 53);
INSERT INTO `permission_role` (`role_id`, `permission_id`) VALUES (1, 54);
INSERT INTO `permission_role` (`role_id`, `permission_id`) VALUES (1, 56);
INSERT INTO `permission_role` (`role_id`, `permission_id`) VALUES (1, 55);
INSERT INTO `permission_role` (`role_id`, `permission_id`) VALUES (1, 57);
INSERT INTO `permission_role` (`role_id`, `permission_id`) VALUES (1, 49);
INSERT INTO `permission_role` (`role_id`, `permission_id`) VALUES (1, 50);
INSERT INTO `permission_role` (`role_id`, `permission_id`) VALUES (1, 52);
INSERT INTO `permission_role` (`role_id`, `permission_id`) VALUES (3, 47);
INSERT INTO `permission_role` (`role_id`, `permission_id`) VALUES (3, 48);
INSERT INTO `permission_role` (`role_id`, `permission_id`) VALUES (3, 49);
INSERT INTO `permission_role` (`role_id`, `permission_id`) VALUES (3, 51);
INSERT INTO `permission_role` (`role_id`, `permission_id`) VALUES (3, 50);
INSERT INTO `permission_role` (`role_id`, `permission_id`) VALUES (3, 52);
INSERT INTO `permission_role` (`role_id`, `permission_id`) VALUES (3, 53);
INSERT INTO `permission_role` (`role_id`, `permission_id`) VALUES (3, 54);
INSERT INTO `permission_role` (`role_id`, `permission_id`) VALUES (3, 56);
INSERT INTO `permission_role` (`role_id`, `permission_id`) VALUES (3, 55);
INSERT INTO `permission_role` (`role_id`, `permission_id`) VALUES (3, 57);
INSERT INTO `permission_role` (`role_id`, `permission_id`) VALUES (1, 66);
INSERT INTO `permission_role` (`role_id`, `permission_id`) VALUES (1, 24);
INSERT INTO `permission_role` (`role_id`, `permission_id`) VALUES (1, 27);
INSERT INTO `permission_role` (`role_id`, `permission_id`) VALUES (1, 75);
INSERT INTO `permission_role` (`role_id`, `permission_id`) VALUES (1, 76);
INSERT INTO `permission_role` (`role_id`, `permission_id`) VALUES (1, 77);
INSERT INTO `permission_role` (`role_id`, `permission_id`) VALUES (1, 78);
INSERT INTO `permission_role` (`role_id`, `permission_id`) VALUES (1, 79);
INSERT INTO `permission_role` (`role_id`, `permission_id`) VALUES (1, 80);
INSERT INTO `permission_role` (`role_id`, `permission_id`) VALUES (1, 81);
INSERT INTO `permission_role` (`role_id`, `permission_id`) VALUES (1, 59);
INSERT INTO `permission_role` (`role_id`, `permission_id`) VALUES (1, 60);
INSERT INTO `permission_role` (`role_id`, `permission_id`) VALUES (1, 62);
INSERT INTO `permission_role` (`role_id`, `permission_id`) VALUES (1, 61);
INSERT INTO `permission_role` (`role_id`, `permission_id`) VALUES (1, 63);
INSERT INTO `permission_role` (`role_id`, `permission_id`) VALUES (1, 82);
INSERT INTO `permission_role` (`role_id`, `permission_id`) VALUES (1, 21);
INSERT INTO `permission_role` (`role_id`, `permission_id`) VALUES (4, 47);
INSERT INTO `permission_role` (`role_id`, `permission_id`) VALUES (4, 48);
INSERT INTO `permission_role` (`role_id`, `permission_id`) VALUES (4, 49);
INSERT INTO `permission_role` (`role_id`, `permission_id`) VALUES (4, 51);
INSERT INTO `permission_role` (`role_id`, `permission_id`) VALUES (4, 50);
INSERT INTO `permission_role` (`role_id`, `permission_id`) VALUES (4, 52);
INSERT INTO `permission_role` (`role_id`, `permission_id`) VALUES (4, 53);
INSERT INTO `permission_role` (`role_id`, `permission_id`) VALUES (4, 54);
INSERT INTO `permission_role` (`role_id`, `permission_id`) VALUES (4, 56);
INSERT INTO `permission_role` (`role_id`, `permission_id`) VALUES (4, 55);
INSERT INTO `permission_role` (`role_id`, `permission_id`) VALUES (4, 57);
INSERT INTO `permission_role` (`role_id`, `permission_id`) VALUES (2, 47);
INSERT INTO `permission_role` (`role_id`, `permission_id`) VALUES (2, 48);
INSERT INTO `permission_role` (`role_id`, `permission_id`) VALUES (2, 49);
INSERT INTO `permission_role` (`role_id`, `permission_id`) VALUES (2, 51);
INSERT INTO `permission_role` (`role_id`, `permission_id`) VALUES (2, 50);
INSERT INTO `permission_role` (`role_id`, `permission_id`) VALUES (2, 52);
INSERT INTO `permission_role` (`role_id`, `permission_id`) VALUES (2, 53);
INSERT INTO `permission_role` (`role_id`, `permission_id`) VALUES (2, 54);
INSERT INTO `permission_role` (`role_id`, `permission_id`) VALUES (2, 56);
INSERT INTO `permission_role` (`role_id`, `permission_id`) VALUES (2, 55);
INSERT INTO `permission_role` (`role_id`, `permission_id`) VALUES (2, 57);
INSERT INTO `permission_role` (`role_id`, `permission_id`) VALUES (1, 84);
INSERT INTO `permission_role` (`role_id`, `permission_id`) VALUES (1, 85);
INSERT INTO `permission_role` (`role_id`, `permission_id`) VALUES (1, 83);
INSERT INTO `permission_role` (`role_id`, `permission_id`) VALUES (1, 86);
INSERT INTO `permission_role` (`role_id`, `permission_id`) VALUES (4, 89);
INSERT INTO `permission_role` (`role_id`, `permission_id`) VALUES (2, 89);
INSERT INTO `permission_role` (`role_id`, `permission_id`) VALUES (4, 90);
INSERT INTO `permission_role` (`role_id`, `permission_id`) VALUES (2, 90);
INSERT INTO `permission_role` (`role_id`, `permission_id`) VALUES (1, 97);
INSERT INTO `permission_role` (`role_id`, `permission_id`) VALUES (1, 99);
INSERT INTO `permission_role` (`role_id`, `permission_id`) VALUES (1, 98);
INSERT INTO `permission_role` (`role_id`, `permission_id`) VALUES (1, 100);
INSERT INTO `permission_role` (`role_id`, `permission_id`) VALUES (2, 88);
INSERT INTO `permission_role` (`role_id`, `permission_id`) VALUES (2, 27);
INSERT INTO `permission_role` (`role_id`, `permission_id`) VALUES (2, 99);
INSERT INTO `permission_role` (`role_id`, `permission_id`) VALUES (1, 25);
INSERT INTO `permission_role` (`role_id`, `permission_id`) VALUES (1, 90);
INSERT INTO `permission_role` (`role_id`, `permission_id`) VALUES (1, 88);
INSERT INTO `permission_role` (`role_id`, `permission_id`) VALUES (1, 89);
INSERT INTO `permission_role` (`role_id`, `permission_id`) VALUES (1, 29);
INSERT INTO `permission_role` (`role_id`, `permission_id`) VALUES (1, 30);
INSERT INTO `permission_role` (`role_id`, `permission_id`) VALUES (1, 32);
INSERT INTO `permission_role` (`role_id`, `permission_id`) VALUES (1, 31);
INSERT INTO `permission_role` (`role_id`, `permission_id`) VALUES (1, 33);
INSERT INTO `permission_role` (`role_id`, `permission_id`) VALUES (1, 39);
INSERT INTO `permission_role` (`role_id`, `permission_id`) VALUES (1, 40);
INSERT INTO `permission_role` (`role_id`, `permission_id`) VALUES (1, 41);
INSERT INTO `permission_role` (`role_id`, `permission_id`) VALUES (1, 42);
INSERT INTO `permission_role` (`role_id`, `permission_id`) VALUES (1, 28);
INSERT INTO `permission_role` (`role_id`, `permission_id`) VALUES (1, 43);
INSERT INTO `permission_role` (`role_id`, `permission_id`) VALUES (1, 44);
INSERT INTO `permission_role` (`role_id`, `permission_id`) VALUES (1, 45);
INSERT INTO `permission_role` (`role_id`, `permission_id`) VALUES (1, 58);
INSERT INTO `permission_role` (`role_id`, `permission_id`) VALUES (1, 64);
INSERT INTO `permission_role` (`role_id`, `permission_id`) VALUES (1, 67);
INSERT INTO `permission_role` (`role_id`, `permission_id`) VALUES (1, 69);
INSERT INTO `permission_role` (`role_id`, `permission_id`) VALUES (1, 68);
INSERT INTO `permission_role` (`role_id`, `permission_id`) VALUES (1, 70);
INSERT INTO `permission_role` (`role_id`, `permission_id`) VALUES (1, 65);
INSERT INTO `permission_role` (`role_id`, `permission_id`) VALUES (1, 71);
INSERT INTO `permission_role` (`role_id`, `permission_id`) VALUES (1, 73);
INSERT INTO `permission_role` (`role_id`, `permission_id`) VALUES (1, 72);
INSERT INTO `permission_role` (`role_id`, `permission_id`) VALUES (1, 74);
INSERT INTO `permission_role` (`role_id`, `permission_id`) VALUES (1, 96);
INSERT INTO `permission_role` (`role_id`, `permission_id`) VALUES (1, 92);
INSERT INTO `permission_role` (`role_id`, `permission_id`) VALUES (1, 93);
INSERT INTO `permission_role` (`role_id`, `permission_id`) VALUES (1, 94);
INSERT INTO `permission_role` (`role_id`, `permission_id`) VALUES (1, 95);
INSERT INTO `permission_role` (`role_id`, `permission_id`) VALUES (1, 34);
INSERT INTO `permission_role` (`role_id`, `permission_id`) VALUES (1, 35);
INSERT INTO `permission_role` (`role_id`, `permission_id`) VALUES (1, 37);
INSERT INTO `permission_role` (`role_id`, `permission_id`) VALUES (1, 36);
INSERT INTO `permission_role` (`role_id`, `permission_id`) VALUES (1, 38);
INSERT INTO `permission_role` (`role_id`, `permission_id`) VALUES (2, 25);
INSERT INTO `permission_role` (`role_id`, `permission_id`) VALUES (2, 29);
INSERT INTO `permission_role` (`role_id`, `permission_id`) VALUES (2, 30);
INSERT INTO `permission_role` (`role_id`, `permission_id`) VALUES (2, 32);
INSERT INTO `permission_role` (`role_id`, `permission_id`) VALUES (2, 31);
INSERT INTO `permission_role` (`role_id`, `permission_id`) VALUES (2, 33);
INSERT INTO `permission_role` (`role_id`, `permission_id`) VALUES (1, 46);
INSERT INTO `permission_role` (`role_id`, `permission_id`) VALUES (3, 45);
INSERT INTO `permission_role` (`role_id`, `permission_id`) VALUES (3, 58);
INSERT INTO `permission_role` (`role_id`, `permission_id`) VALUES (3, 59);
INSERT INTO `permission_role` (`role_id`, `permission_id`) VALUES (3, 60);
INSERT INTO `permission_role` (`role_id`, `permission_id`) VALUES (3, 62);
INSERT INTO `permission_role` (`role_id`, `permission_id`) VALUES (3, 61);
INSERT INTO `permission_role` (`role_id`, `permission_id`) VALUES (3, 63);
INSERT INTO `permission_role` (`role_id`, `permission_id`) VALUES (3, 64);
INSERT INTO `permission_role` (`role_id`, `permission_id`) VALUES (3, 67);
INSERT INTO `permission_role` (`role_id`, `permission_id`) VALUES (3, 69);
INSERT INTO `permission_role` (`role_id`, `permission_id`) VALUES (3, 68);
INSERT INTO `permission_role` (`role_id`, `permission_id`) VALUES (3, 70);
INSERT INTO `permission_role` (`role_id`, `permission_id`) VALUES (3, 65);
INSERT INTO `permission_role` (`role_id`, `permission_id`) VALUES (3, 71);
INSERT INTO `permission_role` (`role_id`, `permission_id`) VALUES (3, 73);
INSERT INTO `permission_role` (`role_id`, `permission_id`) VALUES (3, 72);
INSERT INTO `permission_role` (`role_id`, `permission_id`) VALUES (3, 74);
INSERT INTO `permission_role` (`role_id`, `permission_id`) VALUES (4, 97);
INSERT INTO `permission_role` (`role_id`, `permission_id`) VALUES (4, 99);
INSERT INTO `permission_role` (`role_id`, `permission_id`) VALUES (4, 98);
INSERT INTO `permission_role` (`role_id`, `permission_id`) VALUES (4, 100);
INSERT INTO `permission_role` (`role_id`, `permission_id`) VALUES (2, 28);
INSERT INTO `permission_role` (`role_id`, `permission_id`) VALUES (2, 34);
INSERT INTO `permission_role` (`role_id`, `permission_id`) VALUES (4, 88);
INSERT INTO `permission_role` (`role_id`, `permission_id`) VALUES (4, 101);
INSERT INTO `permission_role` (`role_id`, `permission_id`) VALUES (2, 24);
INSERT INTO `permission_role` (`role_id`, `permission_id`) VALUES (4, 25);
INSERT INTO `permission_role` (`role_id`, `permission_id`) VALUES (4, 26);
INSERT INTO `permission_role` (`role_id`, `permission_id`) VALUES (1, 26);
INSERT INTO `permission_role` (`role_id`, `permission_id`) VALUES (1, 101);
INSERT INTO `permission_role` (`role_id`, `permission_id`) VALUES (2, 102);
INSERT INTO `permission_role` (`role_id`, `permission_id`) VALUES (2, 103);
INSERT INTO `permission_role` (`role_id`, `permission_id`) VALUES (2, 104);
INSERT INTO `permission_role` (`role_id`, `permission_id`) VALUES (2, 106);
INSERT INTO `permission_role` (`role_id`, `permission_id`) VALUES (2, 105);
INSERT INTO `permission_role` (`role_id`, `permission_id`) VALUES (2, 107);
INSERT INTO `permission_role` (`role_id`, `permission_id`) VALUES (4, 103);
INSERT INTO `permission_role` (`role_id`, `permission_id`) VALUES (4, 102);
INSERT INTO `permission_role` (`role_id`, `permission_id`) VALUES (4, 104);
INSERT INTO `permission_role` (`role_id`, `permission_id`) VALUES (4, 106);
INSERT INTO `permission_role` (`role_id`, `permission_id`) VALUES (4, 105);
INSERT INTO `permission_role` (`role_id`, `permission_id`) VALUES (4, 107);
INSERT INTO `permission_role` (`role_id`, `permission_id`) VALUES (1, 103);
INSERT INTO `permission_role` (`role_id`, `permission_id`) VALUES (1, 102);
INSERT INTO `permission_role` (`role_id`, `permission_id`) VALUES (1, 104);
INSERT INTO `permission_role` (`role_id`, `permission_id`) VALUES (1, 106);
INSERT INTO `permission_role` (`role_id`, `permission_id`) VALUES (1, 105);
INSERT INTO `permission_role` (`role_id`, `permission_id`) VALUES (1, 107);
COMMIT;

SET FOREIGN_KEY_CHECKS = 1;
