--
-- Dumping data for table `menu_panel`
--

/*
INSERT INTO `menu_panel` (`id`, `menu_id`, `menu_type`, `menu_name`, `route`, `parent_menu_id`, `icon_code`, `menu_order`, `status`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, 0, 'ROOT', 'ROOT', '#', 0, NULL, 0, 'active', 1, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(2, 1, 'MODU', 'Dashboard', 'dashboard', 1, 'fa fa-tachometer', 1, 'active', NULL, NULL, '2016-04-12 06:14:41', '2016-04-12 10:07:21'),
(3, 1, 'MODU', 'User', '#', 1, 'fa fa-user', 3, 'active', NULL, NULL, '2016-04-12 06:16:47', '2016-04-12 10:07:46'),
(4, 1, 'MENU', 'Permission Role', 'index-permission-role', 3, '111', 0, 'active', NULL, NULL, '2016-04-12 06:18:59', '2016-04-12 06:44:49'),
(5, 1, 'MODU', 'Department', 'department', 1, 'fa fa-align-center', 2, 'active', NULL, NULL, '2016-04-12 06:42:21', '2016-04-12 10:07:34'),
(6, 1, 'MENU', 'Profile', 'user-profile', 3, '11', 0, 'active', NULL, NULL, '2016-04-12 06:46:18', '2016-04-12 06:46:18'),
(6, 1, 'MENU', 'User List', 'user-list', 3, '11', 0, 'active', NULL, NULL, '2016-04-12 06:47:03', '2016-04-12 06:47:03'),
(7, 1, 'MENU', 'Role User', 'index-role-user', 3, '11', 0, 'active', NULL, NULL, '2016-04-12 06:47:53', '2016-04-12 06:47:53'),
(8, 1, 'MENU', 'User Activity', 'user-activity', 3, '11', 0, 'active', NULL, NULL, '2016-04-12 06:48:48', '2016-04-12 06:48:48'),
(9, 1, 'MENU', 'Menu Panel', 'menu-panel', 3, '11', 0, 'active', NULL, NULL, '2016-04-12 06:49:29', '2016-04-12 06:49:29');*/

/*INSERT INTO `menu_panel` (`id`, `menu_id`, `menu_type`, `menu_name`, `route`, `parent_menu_id`, `icon_code`, `menu_order`, `status`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, 0, 'ROOT', 'ROOT', '#', 0, NULL, 0, 'active', 1, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(2, 1, 'MODU', 'Dashboard', 'dashboard', 1, 'fa fa-tachometer', 1, 'active', NULL, NULL, '2016-04-12 00:14:41', '2016-04-12 04:07:21'),
(3, 1, 'MODU', 'User', '#', 1, 'fa fa-user', 7, 'active', NULL, NULL, '2016-04-12 00:16:47', '2016-06-15 01:04:18'),
(4, 1, 'MENU', 'Permission Role', 'index-permission-role', 3, '111', 3, 'active', NULL, NULL, '2016-04-12 00:18:59', '2016-06-15 01:09:59'),
(5, 1, 'MENU', 'Department', 'department', 3, 'fa fa-align-center', 6, 'active', NULL, NULL, '2016-04-12 00:42:21', '2016-06-15 01:07:43'),
(6, 1, 'MENU', 'User List', 'user-list', 3, '11', 1, 'active', NULL, NULL, '2016-04-12 00:47:03', '2016-06-15 01:10:35'),
(7, 1, 'MENU', 'Role User', 'index-role-user', 3, '11', 2, 'active', NULL, NULL, '2016-04-12 00:47:53', '2016-06-15 01:10:15'),
(8, 1, 'MENU', 'User Activity', 'user-activity', 3, '11', 4, 'active', NULL, NULL, '2016-04-12 00:48:48', '2016-06-15 01:09:41'),
(9, 1, 'MENU', 'Menu Panel', 'menu-panel', 3, '11', 5, 'active', NULL, NULL, '2016-04-12 00:49:29', '2016-06-15 01:09:23'),
(10, 1, 'MODU', 'Popping Email', 'admin/popping-email', 1, '1', 2, 'active', NULL, NULL, '2016-06-15 01:12:45', '2016-06-15 01:13:06'),
(11, 1, 'MODU', 'Imap', 'admin/imap', 1, '2', 3, 'active', NULL, NULL, '2016-06-15 01:13:56', '2016-06-15 01:13:56'),
(12, 1, 'MODU', 'Smtp', 'admin/smtp', 1, '3', 4, 'active', NULL, NULL, '2016-06-15 01:14:47', '2016-06-15 01:14:47'),
(13, 1, 'MODU', 'Schedule', 'admin/schedule', 1, '4', 5, 'active', NULL, NULL, '2016-06-15 01:15:40', '2016-06-15 01:15:40'),
(14, 1, 'MODU', 'Filter', 'admin/filter', 1, '5', 6, 'active', NULL, NULL, '2016-06-15 01:16:19', '2016-06-15 01:16:19'),
(15, 1, 'MODU', 'Settings', 'admin/central-settings', 1, '6', 8, 'active', NULL, NULL, '2016-06-15 01:17:06', '2016-06-15 01:17:06');*/

INSERT INTO `menu_panel` (`id`, `menu_id`, `menu_type`, `menu_name`, `route`, `parent_menu_id`, `icon_code`, `menu_order`, `status`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, 0, 'ROOT', 'ROOT', '#', 0, NULL, 0, 'active', 1, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(2, 1, 'MODU', 'Dashboard', 'dashboard', 1, 'fa fa-tachometer', 1, 'active', NULL, NULL, '2016-04-11 18:14:41', '2016-04-11 22:07:21'),
(3, 1, 'MODU', 'User', '#', 1, 'fa fa-user', 7, 'active', NULL, NULL, '2016-04-11 18:16:47', '2016-06-14 19:04:18'),
(4, 1, 'MENU', 'Permission Role', 'index-permission-role', 3, '111', 3, 'active', NULL, NULL, '2016-04-11 18:18:59', '2016-06-14 19:09:59'),
(5, 1, 'MENU', 'Department', 'department', 3, 'fa fa-align-center', 6, 'active', NULL, NULL, '2016-04-11 18:42:21', '2016-06-14 19:07:43'),
(6, 1, 'MENU', 'User List', 'user-list', 3, '11', 1, 'active', NULL, NULL, '2016-04-11 18:47:03', '2016-06-14 19:10:35'),
(7, 1, 'MENU', 'Role User', 'index-role-user', 3, '11', 2, 'active', NULL, NULL, '2016-04-11 18:47:53', '2016-06-14 19:10:15'),
(8, 1, 'MENU', 'User Activity', 'user-activity', 3, '11', 4, 'active', NULL, NULL, '2016-04-11 18:48:48', '2016-06-14 19:09:41'),
(9, 1, 'MENU', 'Menu Panel', 'menu-panel', 3, '11', 5, 'active', NULL, NULL, '2016-04-11 18:49:29', '2016-06-14 19:09:23'),
(10, 1, 'MODU', 'Popping Email', 'admin/popping-email', 1, '1', 2, 'active', NULL, NULL, '2016-06-14 19:12:45', '2016-06-14 19:13:06'),
(11, 1, 'MODU', 'Imap', 'admin/imap', 1, '2', 3, 'active', NULL, NULL, '2016-06-14 19:13:56', '2016-06-14 19:13:56'),
(12, 1, 'MODU', 'Smtp', 'admin/smtp', 1, '3', 4, 'active', NULL, NULL, '2016-06-14 19:14:47', '2016-06-14 19:14:47'),
(13, 1, 'MODU', 'Schedule', 'admin/schedule', 1, '4', 5, 'active', NULL, NULL, '2016-06-14 19:15:40', '2016-06-14 19:15:40'),
(14, 1, 'MODU', 'Filter', 'admin/filter', 1, '5', 6, 'active', NULL, NULL, '2016-06-14 19:16:19', '2016-06-14 19:16:19'),
(15, 1, 'MODU', 'Settings', 'admin/central-settings', 1, '6', 8, 'active', NULL, NULL, '2016-06-14 19:17:06', '2016-06-14 19:17:06'),
(16, 1, 'MODU', 'Lead', 'admin/lead', 1, '#', 3, 'active', NULL, NULL, '2016-06-20 03:51:16', '2016-06-20 03:51:16'),
(17, 1, 'MODU', 'Invoice', 'admin/invoice', 1, '#', 2, 'active', NULL, NULL, '2016-06-20 03:53:50', '2016-06-20 03:53:50');
