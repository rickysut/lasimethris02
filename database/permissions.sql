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

 Date: 08/03/2023 16:57:20
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for permissions
-- ----------------------------
DROP TABLE IF EXISTS `permissions`;
CREATE TABLE `permissions` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `perm_type` varchar(255) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `grp_title` varchar(255) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=108 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- ----------------------------
-- Records of permissions
-- ----------------------------
BEGIN;
INSERT INTO `permissions` (`id`, `title`, `perm_type`, `grp_title`, `created_at`, `updated_at`, `deleted_at`) VALUES (1, 'user_management_access', '5', 'User management', NULL, '2022-10-05 07:43:13', NULL);
INSERT INTO `permissions` (`id`, `title`, `perm_type`, `grp_title`, `created_at`, `updated_at`, `deleted_at`) VALUES (2, 'permission_create', '1', 'Permissions', NULL, '2022-10-05 07:47:01', NULL);
INSERT INTO `permissions` (`id`, `title`, `perm_type`, `grp_title`, `created_at`, `updated_at`, `deleted_at`) VALUES (3, 'permission_edit', '2', 'Permissions', NULL, '2022-10-05 07:46:35', NULL);
INSERT INTO `permissions` (`id`, `title`, `perm_type`, `grp_title`, `created_at`, `updated_at`, `deleted_at`) VALUES (4, 'permission_show', '3', 'Permissions', NULL, '2022-10-05 07:46:24', NULL);
INSERT INTO `permissions` (`id`, `title`, `perm_type`, `grp_title`, `created_at`, `updated_at`, `deleted_at`) VALUES (5, 'permission_delete', '4', 'Permissions', NULL, '2022-10-05 07:46:47', NULL);
INSERT INTO `permissions` (`id`, `title`, `perm_type`, `grp_title`, `created_at`, `updated_at`, `deleted_at`) VALUES (6, 'permission_access', '5', 'Permissions', NULL, '2022-10-05 07:47:13', NULL);
INSERT INTO `permissions` (`id`, `title`, `perm_type`, `grp_title`, `created_at`, `updated_at`, `deleted_at`) VALUES (7, 'role_create', '1', 'Roles', NULL, '2022-10-05 07:45:23', NULL);
INSERT INTO `permissions` (`id`, `title`, `perm_type`, `grp_title`, `created_at`, `updated_at`, `deleted_at`) VALUES (8, 'role_edit', '2', 'Roles', NULL, '2022-10-05 07:44:56', NULL);
INSERT INTO `permissions` (`id`, `title`, `perm_type`, `grp_title`, `created_at`, `updated_at`, `deleted_at`) VALUES (9, 'role_show', '3', 'Roles', NULL, '2022-10-05 07:44:46', NULL);
INSERT INTO `permissions` (`id`, `title`, `perm_type`, `grp_title`, `created_at`, `updated_at`, `deleted_at`) VALUES (10, 'role_delete', '4', 'Roles', NULL, '2022-10-05 07:45:05', NULL);
INSERT INTO `permissions` (`id`, `title`, `perm_type`, `grp_title`, `created_at`, `updated_at`, `deleted_at`) VALUES (11, 'role_access', '5', 'Roles', NULL, '2022-10-05 07:45:42', NULL);
INSERT INTO `permissions` (`id`, `title`, `perm_type`, `grp_title`, `created_at`, `updated_at`, `deleted_at`) VALUES (12, 'user_create', '1', 'Users', NULL, '2022-10-05 07:44:10', NULL);
INSERT INTO `permissions` (`id`, `title`, `perm_type`, `grp_title`, `created_at`, `updated_at`, `deleted_at`) VALUES (13, 'user_edit', '2', 'Users', NULL, '2022-10-05 07:43:41', NULL);
INSERT INTO `permissions` (`id`, `title`, `perm_type`, `grp_title`, `created_at`, `updated_at`, `deleted_at`) VALUES (14, 'user_show', '3', 'Users', NULL, '2022-10-05 07:43:04', NULL);
INSERT INTO `permissions` (`id`, `title`, `perm_type`, `grp_title`, `created_at`, `updated_at`, `deleted_at`) VALUES (15, 'user_delete', '4', 'Users', NULL, '2022-10-05 07:43:53', NULL);
INSERT INTO `permissions` (`id`, `title`, `perm_type`, `grp_title`, `created_at`, `updated_at`, `deleted_at`) VALUES (16, 'user_access', '5', 'Users', NULL, '2022-10-05 07:44:36', NULL);
INSERT INTO `permissions` (`id`, `title`, `perm_type`, `grp_title`, `created_at`, `updated_at`, `deleted_at`) VALUES (17, 'audit_log_show', '3', 'Audit Logs', NULL, '2022-10-05 07:47:23', NULL);
INSERT INTO `permissions` (`id`, `title`, `perm_type`, `grp_title`, `created_at`, `updated_at`, `deleted_at`) VALUES (18, 'audit_log_access', '5', 'Audit Logs', NULL, '2022-10-05 07:47:34', NULL);
INSERT INTO `permissions` (`id`, `title`, `perm_type`, `grp_title`, `created_at`, `updated_at`, `deleted_at`) VALUES (19, 'profile_password_edit', '2', 'Profile', NULL, '2022-10-05 07:46:09', NULL);
INSERT INTO `permissions` (`id`, `title`, `perm_type`, `grp_title`, `created_at`, `updated_at`, `deleted_at`) VALUES (20, 'dashboard_access', '5', 'Dashboard', '2022-10-05 08:18:49', '2022-10-13 15:32:35', NULL);
INSERT INTO `permissions` (`id`, `title`, `perm_type`, `grp_title`, `created_at`, `updated_at`, `deleted_at`) VALUES (21, 'landing_access', '5', 'Landing', '2022-10-05 15:03:17', '2022-10-13 15:32:49', NULL);
INSERT INTO `permissions` (`id`, `title`, `perm_type`, `grp_title`, `created_at`, `updated_at`, `deleted_at`) VALUES (22, 'dashboardv_access', '5', 'Dashboard Verifikator', '2022-10-07 06:52:04', '2022-10-13 15:34:10', '2022-10-13 15:34:10');
INSERT INTO `permissions` (`id`, `title`, `perm_type`, `grp_title`, `created_at`, `updated_at`, `deleted_at`) VALUES (23, 'dashboarda_access', '5', 'Dashboard Admin', '2022-10-07 06:52:32', '2022-10-13 15:34:17', '2022-10-13 15:34:17');
INSERT INTO `permissions` (`id`, `title`, `perm_type`, `grp_title`, `created_at`, `updated_at`, `deleted_at`) VALUES (24, 'user_task_access', '5', 'Proses RIPH', '2022-10-13 15:46:06', '2023-02-25 23:53:01', NULL);
INSERT INTO `permissions` (`id`, `title`, `perm_type`, `grp_title`, `created_at`, `updated_at`, `deleted_at`) VALUES (25, 'pull_access', '5', 'Tarik Data RIPH', '2022-10-13 16:16:43', '2023-02-25 23:50:47', NULL);
INSERT INTO `permissions` (`id`, `title`, `perm_type`, `grp_title`, `created_at`, `updated_at`, `deleted_at`) VALUES (26, 'commitment_access', '5', 'Daftar RIPH', '2022-10-13 16:17:05', '2023-02-26 00:21:56', NULL);
INSERT INTO `permissions` (`id`, `title`, `perm_type`, `grp_title`, `created_at`, `updated_at`, `deleted_at`) VALUES (27, 'kelompoktani_access', '5', 'Kelompok Tani', '2022-11-02 14:29:05', '2022-11-02 14:29:05', NULL);
INSERT INTO `permissions` (`id`, `title`, `perm_type`, `grp_title`, `created_at`, `updated_at`, `deleted_at`) VALUES (28, 'permohonan_access', '5', 'Permohonan', '2022-11-03 06:39:24', '2023-02-26 00:05:59', NULL);
INSERT INTO `permissions` (`id`, `title`, `perm_type`, `grp_title`, `created_at`, `updated_at`, `deleted_at`) VALUES (29, 'pengajuan_access', '5', 'Pengajuan', '2022-11-03 06:42:35', '2023-02-25 23:51:52', NULL);
INSERT INTO `permissions` (`id`, `title`, `perm_type`, `grp_title`, `created_at`, `updated_at`, `deleted_at`) VALUES (30, 'pengajuan_create', '1', 'Pengajuan', '2022-11-03 06:42:55', '2023-02-25 23:51:41', NULL);
INSERT INTO `permissions` (`id`, `title`, `perm_type`, `grp_title`, `created_at`, `updated_at`, `deleted_at`) VALUES (31, 'pengajuan_edit', '2', 'Pengajuan', '2022-11-03 06:47:01', '2023-02-25 23:51:32', NULL);
INSERT INTO `permissions` (`id`, `title`, `perm_type`, `grp_title`, `created_at`, `updated_at`, `deleted_at`) VALUES (32, 'pengajuan_show', '3', 'Pengajuan', '2022-11-03 06:47:19', '2023-02-25 23:51:20', NULL);
INSERT INTO `permissions` (`id`, `title`, `perm_type`, `grp_title`, `created_at`, `updated_at`, `deleted_at`) VALUES (33, 'pengajuan_delete', '4', 'Pengajuan', '2022-11-03 06:47:35', '2023-02-25 23:51:09', NULL);
INSERT INTO `permissions` (`id`, `title`, `perm_type`, `grp_title`, `created_at`, `updated_at`, `deleted_at`) VALUES (34, 'skl_access', '5', 'SKL Terbit', '2022-11-03 06:47:53', '2023-02-26 00:07:07', NULL);
INSERT INTO `permissions` (`id`, `title`, `perm_type`, `grp_title`, `created_at`, `updated_at`, `deleted_at`) VALUES (35, 'skl_create', '1', 'Daftar SKL', '2022-11-03 06:48:10', '2022-11-03 06:48:10', NULL);
INSERT INTO `permissions` (`id`, `title`, `perm_type`, `grp_title`, `created_at`, `updated_at`, `deleted_at`) VALUES (36, 'skl_edit', '2', 'Daftar SKL', '2022-11-03 06:48:24', '2022-11-03 06:48:24', NULL);
INSERT INTO `permissions` (`id`, `title`, `perm_type`, `grp_title`, `created_at`, `updated_at`, `deleted_at`) VALUES (37, 'skl_show', '3', 'Daftar SKL', '2022-11-03 06:48:40', '2022-11-03 06:48:40', NULL);
INSERT INTO `permissions` (`id`, `title`, `perm_type`, `grp_title`, `created_at`, `updated_at`, `deleted_at`) VALUES (38, 'skl_delete', '4', 'Daftar SKL', '2022-11-03 06:48:54', '2022-11-03 06:48:54', NULL);
INSERT INTO `permissions` (`id`, `title`, `perm_type`, `grp_title`, `created_at`, `updated_at`, `deleted_at`) VALUES (39, 'folder_access', '5', 'Pengelolaan Berkas', '2022-11-03 07:43:51', '2022-11-03 07:43:51', NULL);
INSERT INTO `permissions` (`id`, `title`, `perm_type`, `grp_title`, `created_at`, `updated_at`, `deleted_at`) VALUES (40, 'berkas_access', '5', 'Berkas Saya', '2022-11-03 07:44:05', '2022-11-03 07:44:05', NULL);
INSERT INTO `permissions` (`id`, `title`, `perm_type`, `grp_title`, `created_at`, `updated_at`, `deleted_at`) VALUES (41, 'galeri_access', '5', 'Galeri Saya', '2022-11-03 07:44:19', '2022-11-03 07:44:19', NULL);
INSERT INTO `permissions` (`id`, `title`, `perm_type`, `grp_title`, `created_at`, `updated_at`, `deleted_at`) VALUES (42, 'template_access', '5', 'Template Master', '2022-11-03 07:44:35', '2022-11-03 07:44:35', NULL);
INSERT INTO `permissions` (`id`, `title`, `perm_type`, `grp_title`, `created_at`, `updated_at`, `deleted_at`) VALUES (43, 'onfarm_access', '5', 'Onfarm', '2022-11-05 15:12:36', '2022-11-05 15:12:36', NULL);
INSERT INTO `permissions` (`id`, `title`, `perm_type`, `grp_title`, `created_at`, `updated_at`, `deleted_at`) VALUES (44, 'online_access', '5', 'Online', '2022-11-05 15:12:53', '2022-11-05 15:12:53', NULL);
INSERT INTO `permissions` (`id`, `title`, `perm_type`, `grp_title`, `created_at`, `updated_at`, `deleted_at`) VALUES (45, 'completed_access', '5', 'Completed', '2022-11-05 15:13:11', '2022-11-05 15:13:11', NULL);
INSERT INTO `permissions` (`id`, `title`, `perm_type`, `grp_title`, `created_at`, `updated_at`, `deleted_at`) VALUES (46, 'verificator_task_access', '5', 'Verificator task', '2022-11-24 15:44:34', '2022-11-24 15:44:34', NULL);
INSERT INTO `permissions` (`id`, `title`, `perm_type`, `grp_title`, `created_at`, `updated_at`, `deleted_at`) VALUES (47, 'feedmsg_access', '5', 'Feed & Messages', '2022-11-25 11:09:04', '2022-11-25 11:09:04', NULL);
INSERT INTO `permissions` (`id`, `title`, `perm_type`, `grp_title`, `created_at`, `updated_at`, `deleted_at`) VALUES (48, 'feeds_access', '5', 'Feeds', '2022-11-25 11:16:25', '2022-11-25 11:16:25', NULL);
INSERT INTO `permissions` (`id`, `title`, `perm_type`, `grp_title`, `created_at`, `updated_at`, `deleted_at`) VALUES (49, 'feeds_create', '1', 'Feeds', '2022-11-25 11:17:07', '2022-11-25 11:17:07', NULL);
INSERT INTO `permissions` (`id`, `title`, `perm_type`, `grp_title`, `created_at`, `updated_at`, `deleted_at`) VALUES (50, 'feeds_edit', '2', 'Feeds', '2022-11-25 11:17:26', '2022-11-25 11:17:26', NULL);
INSERT INTO `permissions` (`id`, `title`, `perm_type`, `grp_title`, `created_at`, `updated_at`, `deleted_at`) VALUES (51, 'feeds_show', '3', 'Feeds', '2022-11-25 11:17:47', '2022-11-25 11:17:47', NULL);
INSERT INTO `permissions` (`id`, `title`, `perm_type`, `grp_title`, `created_at`, `updated_at`, `deleted_at`) VALUES (52, 'feeds_delete', '4', 'Feeds', '2022-11-25 11:19:47', '2022-11-25 11:19:47', NULL);
INSERT INTO `permissions` (`id`, `title`, `perm_type`, `grp_title`, `created_at`, `updated_at`, `deleted_at`) VALUES (53, 'messenger_access', '5', 'Messenger', '2022-11-25 11:22:42', '2022-11-25 11:22:42', NULL);
INSERT INTO `permissions` (`id`, `title`, `perm_type`, `grp_title`, `created_at`, `updated_at`, `deleted_at`) VALUES (54, 'messenger_create', '1', 'Messenger', '2022-11-25 11:22:58', '2022-11-25 11:22:58', NULL);
INSERT INTO `permissions` (`id`, `title`, `perm_type`, `grp_title`, `created_at`, `updated_at`, `deleted_at`) VALUES (55, 'messenger_edit', '2', 'Messenger', '2022-11-25 11:23:13', '2022-11-25 11:23:13', NULL);
INSERT INTO `permissions` (`id`, `title`, `perm_type`, `grp_title`, `created_at`, `updated_at`, `deleted_at`) VALUES (56, 'messenger_show', '3', 'Messenger', '2022-11-25 11:23:27', '2022-11-25 11:23:27', NULL);
INSERT INTO `permissions` (`id`, `title`, `perm_type`, `grp_title`, `created_at`, `updated_at`, `deleted_at`) VALUES (57, 'messenger_delete', '4', 'Messenger', '2022-11-25 11:23:45', '2022-11-25 11:23:45', NULL);
INSERT INTO `permissions` (`id`, `title`, `perm_type`, `grp_title`, `created_at`, `updated_at`, `deleted_at`) VALUES (58, 'verification_skl_access', '5', 'Verificator SKL', '2022-11-26 16:44:37', '2022-11-26 16:44:37', NULL);
INSERT INTO `permissions` (`id`, `title`, `perm_type`, `grp_title`, `created_at`, `updated_at`, `deleted_at`) VALUES (59, 'list_skl_access', '5', 'SKL List', '2022-11-26 16:51:36', '2022-11-26 16:51:36', NULL);
INSERT INTO `permissions` (`id`, `title`, `perm_type`, `grp_title`, `created_at`, `updated_at`, `deleted_at`) VALUES (60, 'list_skl_create', '1', 'SKL List', '2022-11-26 16:51:57', '2022-11-26 16:51:57', NULL);
INSERT INTO `permissions` (`id`, `title`, `perm_type`, `grp_title`, `created_at`, `updated_at`, `deleted_at`) VALUES (61, 'list_skl_edit', '2', 'SKL List', '2022-11-26 16:52:15', '2022-11-26 16:52:15', NULL);
INSERT INTO `permissions` (`id`, `title`, `perm_type`, `grp_title`, `created_at`, `updated_at`, `deleted_at`) VALUES (62, 'list_skl_show', '3', 'SKL List', '2022-11-26 16:52:33', '2022-11-26 16:52:33', NULL);
INSERT INTO `permissions` (`id`, `title`, `perm_type`, `grp_title`, `created_at`, `updated_at`, `deleted_at`) VALUES (63, 'list_skl_delete', '4', 'SKL List', '2022-11-26 16:52:50', '2022-11-26 16:52:50', NULL);
INSERT INTO `permissions` (`id`, `title`, `perm_type`, `grp_title`, `created_at`, `updated_at`, `deleted_at`) VALUES (64, 'create_skl_access', '5', 'Create SKL', '2022-11-26 16:59:53', '2022-11-26 16:59:53', NULL);
INSERT INTO `permissions` (`id`, `title`, `perm_type`, `grp_title`, `created_at`, `updated_at`, `deleted_at`) VALUES (65, 'issued_skl_access', '5', 'Issued SKL', '2022-11-26 17:00:11', '2022-11-26 17:00:11', NULL);
INSERT INTO `permissions` (`id`, `title`, `perm_type`, `grp_title`, `created_at`, `updated_at`, `deleted_at`) VALUES (66, 'administrator_access', '5', 'Administrator', '2022-11-29 04:58:04', '2022-11-29 04:58:04', NULL);
INSERT INTO `permissions` (`id`, `title`, `perm_type`, `grp_title`, `created_at`, `updated_at`, `deleted_at`) VALUES (67, 'create_skl_create', '1', 'Create SKL', '2022-11-29 06:02:46', '2022-11-29 06:02:46', NULL);
INSERT INTO `permissions` (`id`, `title`, `perm_type`, `grp_title`, `created_at`, `updated_at`, `deleted_at`) VALUES (68, 'create_skl_edit', '2', 'Create SKL', '2022-11-29 06:23:47', '2022-11-29 06:23:47', NULL);
INSERT INTO `permissions` (`id`, `title`, `perm_type`, `grp_title`, `created_at`, `updated_at`, `deleted_at`) VALUES (69, 'create_skl_show', '3', 'Create SKL', '2022-11-29 06:24:09', '2022-11-29 06:24:09', NULL);
INSERT INTO `permissions` (`id`, `title`, `perm_type`, `grp_title`, `created_at`, `updated_at`, `deleted_at`) VALUES (70, 'create_skl_delete', '4', 'Create SKL', '2022-11-29 06:24:28', '2022-11-29 06:24:28', NULL);
INSERT INTO `permissions` (`id`, `title`, `perm_type`, `grp_title`, `created_at`, `updated_at`, `deleted_at`) VALUES (71, 'issued_skl_create', '1', 'Issued SKL', '2022-11-29 06:24:47', '2022-11-29 06:24:47', NULL);
INSERT INTO `permissions` (`id`, `title`, `perm_type`, `grp_title`, `created_at`, `updated_at`, `deleted_at`) VALUES (72, 'issued_skl_edit', '2', 'Issued SKL', '2022-11-29 06:25:04', '2022-11-29 06:25:04', NULL);
INSERT INTO `permissions` (`id`, `title`, `perm_type`, `grp_title`, `created_at`, `updated_at`, `deleted_at`) VALUES (73, 'issued_skl_show', '3', 'Issued SKL', '2022-11-29 06:25:24', '2022-11-29 06:25:24', NULL);
INSERT INTO `permissions` (`id`, `title`, `perm_type`, `grp_title`, `created_at`, `updated_at`, `deleted_at`) VALUES (74, 'issued_skl_delete', '4', 'Issued SKL', '2022-11-29 06:25:36', '2022-11-29 06:25:36', NULL);
INSERT INTO `permissions` (`id`, `title`, `perm_type`, `grp_title`, `created_at`, `updated_at`, `deleted_at`) VALUES (75, 'master_riph_access', '5', 'Master Data RIPH', '2022-11-29 06:51:52', '2022-11-29 06:53:58', NULL);
INSERT INTO `permissions` (`id`, `title`, `perm_type`, `grp_title`, `created_at`, `updated_at`, `deleted_at`) VALUES (76, 'data_report_access', '5', 'Data Report', '2022-12-05 07:36:16', '2022-12-05 07:36:16', NULL);
INSERT INTO `permissions` (`id`, `title`, `perm_type`, `grp_title`, `created_at`, `updated_at`, `deleted_at`) VALUES (77, 'master_template_access', '5', 'Master Template', '2022-12-05 07:43:40', '2022-12-05 07:43:40', NULL);
INSERT INTO `permissions` (`id`, `title`, `perm_type`, `grp_title`, `created_at`, `updated_at`, `deleted_at`) VALUES (78, 'commitment_list_access', '5', 'Commitment List', '2022-12-05 08:40:29', '2022-12-05 08:40:29', NULL);
INSERT INTO `permissions` (`id`, `title`, `perm_type`, `grp_title`, `created_at`, `updated_at`, `deleted_at`) VALUES (79, 'verification_report_access', '5', 'Verification Report', '2022-12-05 08:40:45', '2022-12-05 08:40:45', NULL);
INSERT INTO `permissions` (`id`, `title`, `perm_type`, `grp_title`, `created_at`, `updated_at`, `deleted_at`) VALUES (80, 'verif_onfarm_access', '5', 'Onfarm Report', '2022-12-05 16:04:53', '2022-12-05 16:04:53', NULL);
INSERT INTO `permissions` (`id`, `title`, `perm_type`, `grp_title`, `created_at`, `updated_at`, `deleted_at`) VALUES (81, 'verif_online_access', '5', 'Online Report', '2022-12-05 16:05:07', '2022-12-05 16:05:07', NULL);
INSERT INTO `permissions` (`id`, `title`, `perm_type`, `grp_title`, `created_at`, `updated_at`, `deleted_at`) VALUES (82, 'admin_SKL_access', '5', 'SKL', '2022-12-05 16:06:52', '2022-12-05 16:06:52', NULL);
INSERT INTO `permissions` (`id`, `title`, `perm_type`, `grp_title`, `created_at`, `updated_at`, `deleted_at`) VALUES (83, 'master_riph_edit', '2', 'Master Data RIPH', '2022-12-15 23:25:11', '2022-12-15 23:25:11', NULL);
INSERT INTO `permissions` (`id`, `title`, `perm_type`, `grp_title`, `created_at`, `updated_at`, `deleted_at`) VALUES (84, 'master_riph_create', '1', 'Master Data RIPH', '2022-12-15 23:25:29', '2022-12-15 23:25:29', NULL);
INSERT INTO `permissions` (`id`, `title`, `perm_type`, `grp_title`, `created_at`, `updated_at`, `deleted_at`) VALUES (85, 'master_riph_show', '3', 'Master Data RIPH', '2022-12-15 23:25:41', '2022-12-15 23:25:41', NULL);
INSERT INTO `permissions` (`id`, `title`, `perm_type`, `grp_title`, `created_at`, `updated_at`, `deleted_at`) VALUES (86, 'master_riph_delete', '4', 'Master Data RIPH', '2022-12-15 23:25:54', '2022-12-15 23:25:54', NULL);
INSERT INTO `permissions` (`id`, `title`, `perm_type`, `grp_title`, `created_at`, `updated_at`, `deleted_at`) VALUES (87, 'commitment_create', '1', 'Commitment', '2023-01-07 23:26:10', '2023-01-08 00:23:40', '2023-01-08 00:23:40');
INSERT INTO `permissions` (`id`, `title`, `perm_type`, `grp_title`, `created_at`, `updated_at`, `deleted_at`) VALUES (88, 'commitment_edit', '2', 'Daftar RIPH', '2023-01-07 23:26:25', '2023-02-25 23:48:48', NULL);
INSERT INTO `permissions` (`id`, `title`, `perm_type`, `grp_title`, `created_at`, `updated_at`, `deleted_at`) VALUES (89, 'commitment_delete', '4', 'Daftar RIPH', '2023-01-07 23:26:38', '2023-02-25 23:48:12', NULL);
INSERT INTO `permissions` (`id`, `title`, `perm_type`, `grp_title`, `created_at`, `updated_at`, `deleted_at`) VALUES (90, 'commitment_show', '3', 'Daftar RIPH', '2023-01-07 23:43:55', '2023-02-25 23:47:54', NULL);
INSERT INTO `permissions` (`id`, `title`, `perm_type`, `grp_title`, `created_at`, `updated_at`, `deleted_at`) VALUES (91, 'hello_edit', '2', 'Data Report', '2023-01-09 11:54:31', '2023-01-09 11:54:39', '2023-01-09 11:54:39');
INSERT INTO `permissions` (`id`, `title`, `perm_type`, `grp_title`, `created_at`, `updated_at`, `deleted_at`) VALUES (92, 'provinsi_access', '5', 'Provinsi', '2023-01-21 20:07:36', '2023-01-21 20:07:36', NULL);
INSERT INTO `permissions` (`id`, `title`, `perm_type`, `grp_title`, `created_at`, `updated_at`, `deleted_at`) VALUES (93, 'kabupaten_access', '5', 'Kabupaten', '2023-01-21 20:07:55', '2023-01-21 20:07:55', NULL);
INSERT INTO `permissions` (`id`, `title`, `perm_type`, `grp_title`, `created_at`, `updated_at`, `deleted_at`) VALUES (94, 'kecamatan_access', '5', 'Kecamatan', '2023-01-21 20:08:17', '2023-01-21 20:08:17', NULL);
INSERT INTO `permissions` (`id`, `title`, `perm_type`, `grp_title`, `created_at`, `updated_at`, `deleted_at`) VALUES (95, 'desa_access', '5', 'Desa', '2023-01-21 20:08:33', '2023-01-21 20:08:33', NULL);
INSERT INTO `permissions` (`id`, `title`, `perm_type`, `grp_title`, `created_at`, `updated_at`, `deleted_at`) VALUES (96, 'master_wilayah_access', '5', 'Master Wilayah', '2023-01-21 20:09:30', '2023-01-21 20:09:30', NULL);
INSERT INTO `permissions` (`id`, `title`, `perm_type`, `grp_title`, `created_at`, `updated_at`, `deleted_at`) VALUES (97, 'poktan_create', '1', 'Daftar Kelompok Tani', '2023-01-21 22:49:36', '2023-02-28 10:08:10', NULL);
INSERT INTO `permissions` (`id`, `title`, `perm_type`, `grp_title`, `created_at`, `updated_at`, `deleted_at`) VALUES (98, 'poktan_edit', '2', 'Daftar Kelompok Tani', '2023-01-21 22:49:51', '2023-02-28 10:09:12', NULL);
INSERT INTO `permissions` (`id`, `title`, `perm_type`, `grp_title`, `created_at`, `updated_at`, `deleted_at`) VALUES (99, 'poktan_show', '3', 'Daftar Kelompok Tani', '2023-01-21 22:50:07', '2023-02-28 10:08:47', NULL);
INSERT INTO `permissions` (`id`, `title`, `perm_type`, `grp_title`, `created_at`, `updated_at`, `deleted_at`) VALUES (100, 'poktan_delete', '4', 'Daftar Kelompok Tani', '2023-01-21 22:50:21', '2023-02-28 10:08:29', NULL);
INSERT INTO `permissions` (`id`, `title`, `perm_type`, `grp_title`, `created_at`, `updated_at`, `deleted_at`) VALUES (101, 'daftar_riph_create', '1', 'Daftar RIPH', '2023-02-26 00:19:49', '2023-02-26 00:19:49', NULL);
INSERT INTO `permissions` (`id`, `title`, `perm_type`, `grp_title`, `created_at`, `updated_at`, `deleted_at`) VALUES (102, 'pks_access', '5', 'Daftar PKS', '2023-02-28 10:06:12', '2023-02-28 10:06:12', NULL);
INSERT INTO `permissions` (`id`, `title`, `perm_type`, `grp_title`, `created_at`, `updated_at`, `deleted_at`) VALUES (103, 'poktan_access', '5', 'Daftar Kelompok Tani', '2023-02-28 10:07:39', '2023-02-28 10:07:39', NULL);
INSERT INTO `permissions` (`id`, `title`, `perm_type`, `grp_title`, `created_at`, `updated_at`, `deleted_at`) VALUES (104, 'pks_create', '1', 'Daftar PKS', '2023-02-28 10:09:42', '2023-02-28 10:09:42', NULL);
INSERT INTO `permissions` (`id`, `title`, `perm_type`, `grp_title`, `created_at`, `updated_at`, `deleted_at`) VALUES (105, 'pks_edit', '2', 'Daftar PKS', '2023-02-28 10:09:56', '2023-02-28 10:09:56', NULL);
INSERT INTO `permissions` (`id`, `title`, `perm_type`, `grp_title`, `created_at`, `updated_at`, `deleted_at`) VALUES (106, 'pks_show', '3', 'Daftar PKS', '2023-02-28 10:10:14', '2023-02-28 10:10:14', NULL);
INSERT INTO `permissions` (`id`, `title`, `perm_type`, `grp_title`, `created_at`, `updated_at`, `deleted_at`) VALUES (107, 'pks_delete', '4', 'Daftar PKS', '2023-02-28 10:10:29', '2023-02-28 10:10:29', NULL);
COMMIT;

SET FOREIGN_KEY_CHECKS = 1;
