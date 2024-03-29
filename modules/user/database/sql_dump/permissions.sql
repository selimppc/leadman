
--
-- Dumping data for table `permissions`
--

/*
INSERT INTO `permissions` (`id`, `title`, `route_url`, `description`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, 'index-permission-role', 'index-permission-role', 'index-permission-role', 1, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(2, 'index-permission', 'index-permission', 'index-permission', 1, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(3, 'route-in-permission', 'route-in-permission', 'route-in-permission', 1, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(4, 'welcome', 'welcome', NULL, 1, 0, '2016-03-03 09:23:56', '2016-03-03 09:23:56'),
(5, 'reset-password/{user_id}', 'reset-password/{user_id}', NULL, 1, 0, '2016-03-03 09:24:18', '2016-03-03 09:24:18'),
(6, 'update-new-password', 'update-new-password', NULL, 1, 0, '2016-03-03 09:24:18', '2016-03-03 09:24:18'),
(7, 'get-user-login', 'get-user-login', NULL, 1, 0, '2016-03-03 09:24:18', '2016-03-03 09:24:18'),
(8, 'post-user-login', 'post-user-login', NULL, 1, 0, '2016-03-03 09:24:18', '2016-03-03 09:24:18'),
(9, '/', '/', NULL, 1, 0, '2016-03-03 09:24:18', '2016-03-03 09:24:18'),
(10, 'dashboard', 'dashboard', NULL, 1, 0, '2016-03-03 09:24:18', '2016-03-03 09:24:18'),
(11, 'all_routes_uri', 'all_routes_uri', NULL, 1, 0, '2016-03-03 09:24:18', '2016-03-03 09:24:18'),
(12, 'store-permission', 'store-permission', NULL, 1, 0, '2016-03-03 09:24:18', '2016-03-03 09:24:18'),
(13, 'view-permission/{id}', 'view-permission/{id}', NULL, 1, 0, '2016-03-03 09:24:18', '2016-03-03 09:24:18'),
(14, 'edit-permission/{id}', 'edit-permission/{id}', NULL, 1, 0, '2016-03-03 09:24:18', '2016-03-03 09:24:18'),
(15, 'update-permission/{id}', 'update-permission/{id}', NULL, 1, 0, '2016-03-03 09:24:18', '2016-03-03 09:24:18'),
(16, 'delete-permission/{id}', 'delete-permission/{id}', NULL, 1, 0, '2016-03-03 09:24:18', '2016-03-03 09:24:18'),
(18, 'view-permission-role/{id}', 'view-permission-role/{id}', NULL, 1, 0, '2016-03-03 09:24:18', '2016-03-03 09:24:18'),
(19, 'edit-permission-role/{id}', 'edit-permission-role/{id}', NULL, 1, 0, '2016-03-03 09:24:18', '2016-03-03 09:24:18'),
(20, 'update-permission-role/{id}', 'update-permission-role/{id}', NULL, 1, 0, '2016-03-03 09:24:18', '2016-03-03 09:24:18'),
(21, 'delete-permission-role/{id}', 'delete-permission-role/{id}', NULL, 1, 0, '2016-03-03 09:24:18', '2016-03-03 09:24:18'),
(22, 'search-permission-role', 'search-permission-role', NULL, 1, 0, '2016-03-03 09:24:18', '2016-03-03 09:24:18'),
(23, 'user-activity', 'user-activity', NULL, 1, 0, '2016-03-03 09:24:18', '2016-03-03 09:24:18'),
(24, 'search-user-activity', 'search-user-activity', NULL, 1, 0, '2016-03-03 09:24:18', '2016-03-03 09:24:18'),
(25, 'user-list', 'user-list', NULL, 1, 0, '2016-03-03 09:24:18', '2016-03-03 09:24:18'),
(26, 'add-user', 'add-user', NULL, 1, 0, '2016-03-03 09:24:18', '2016-03-03 09:24:18'),
(27, 'search-user', 'search-user', NULL, 1, 0, '2016-03-03 09:24:18', '2016-03-03 09:24:18'),
(28, 'show-user/{id}', 'show-user/{id}', NULL, 1, 0, '2016-03-03 09:24:18', '2016-03-03 09:24:18'),
(29, 'edit-user/{id}', 'edit-user/{id}', NULL, 1, 0, '2016-03-03 09:24:18', '2016-03-03 09:24:18'),
(30, 'update-user/{id}', 'update-user/{id}', NULL, 1, 0, '2016-03-03 09:24:18', '2016-03-03 09:24:18'),
(31, 'delete-user/{id}', 'delete-user/{id}', NULL, 1, 0, '2016-03-03 09:24:18', '2016-03-03 09:24:18'),
(32, 'create-sign-up', 'create-sign-up', NULL, 1, 0, '2016-03-03 09:24:18', '2016-03-03 09:24:18'),
(33, 'forget-password-view', 'forget-password-view', NULL, 1, 0, '2016-03-03 09:24:18', '2016-03-03 09:24:18'),
(34, 'forget-password', 'forget-password', NULL, 1, 0, '2016-03-03 09:24:18', '2016-03-03 09:24:18'),
(35, 'password-reset-confirm/{reset_password_token}', 'password-reset-confirm/{reset_password_token}', NULL, 1, 0, '2016-03-03 09:24:18', '2016-03-03 09:24:18'),
(36, 'user-save-new-password', 'user-save-new-password', NULL, 1, 0, '2016-03-03 09:24:18', '2016-03-03 09:24:18'),
(37, 'signup', 'signup', NULL, 1, 0, '2016-03-03 09:24:18', '2016-03-03 09:24:18'),
(38, 'user-logout', 'user-logout', NULL, 1, 0, '2016-03-03 09:24:18', '2016-03-03 09:24:18'),
(39, 'role', 'role', NULL, 1, 0, '2016-03-03 09:24:18', '2016-03-03 09:24:18'),
(40, 'store-role', 'store-role', NULL, 1, 0, '2016-03-03 09:24:18', '2016-03-03 09:24:18'),
(41, 'view-role/{slug}', 'view-role/{slug}', NULL, 1, 0, '2016-03-03 09:24:18', '2016-03-03 09:24:18'),
(42, 'edit-role/{slug}', 'edit-role/{slug}', NULL, 1, 0, '2016-03-03 09:24:18', '2016-03-03 09:24:18'),
(43, 'update-role/{slug}', 'update-role/{slug}', NULL, 1, 0, '2016-03-03 09:24:18', '2016-03-03 09:24:18'),
(44, 'delete-role/{slug}', 'delete-role/{slug}', NULL, 1, 0, '2016-03-03 09:24:18', '2016-03-03 09:24:18'),
(45, 'index-role-user', 'index-role-user', NULL, 1, 0, '2016-03-03 09:24:18', '2016-03-03 09:24:18'),
(46, 'search-role-user', 'search-role-user', NULL, 1, 0, '2016-03-03 09:24:18', '2016-03-03 09:24:18'),
(47, 'store-role-user', 'store-role-user', NULL, 1, 0, '2016-03-03 09:24:18', '2016-03-03 09:24:18'),
(48, 'view-role-user/{id}', 'view-role-user/{id}', NULL, 1, 0, '2016-03-03 09:24:18', '2016-03-03 09:24:18'),
(49, 'edit-role-user/{id}', 'edit-role-user/{id}', NULL, 1, 0, '2016-03-03 09:24:18', '2016-03-03 09:24:18'),
(50, 'update-role-user/{id}', 'update-role-user/{id}', NULL, 1, 0, '2016-03-03 09:24:18', '2016-03-03 09:24:18'),
(51, 'delete-role-user/{id}', 'delete-role-user/{id}', NULL, 1, 0, '2016-03-03 09:24:18', '2016-03-03 09:24:18'),
(52, 'user-profile', 'user-profile', NULL, 1, 0, '2016-03-03 09:24:18', '2016-03-03 09:24:18'),
(53, 'user-info/{value}', 'user-info/{value}', NULL, 1, 0, '2016-03-03 09:24:18', '2016-03-03 09:24:18'),
(54, 'inactive-user-dashboard', 'inactive-user-dashboard', NULL, 1, 0, '2016-03-03 09:24:18', '2016-03-03 09:24:18'),
(55, 'store-user-profile', 'store-user-profile', NULL, 1, 0, '2016-03-03 09:24:18', '2016-03-03 09:24:18'),
(56, 'edit-user-profile/{id}', 'edit-user-profile/{id}', NULL, 1, 0, '2016-03-03 09:24:18', '2016-03-03 09:24:18'),
(57, 'update-user-profile/{id}', 'update-user-profile/{id}', NULL, 1, 0, '2016-03-03 09:24:18', '2016-03-03 09:24:18'),
(58, 'store-meta-data', 'store-meta-data', NULL, 1, 0, '2016-03-03 09:24:18', '2016-03-03 09:24:18'),
(59, 'edit-meta-data/{id}', 'edit-meta-data/{id}', NULL, 1, 0, '2016-03-03 09:24:18', '2016-03-03 09:24:18'),
(60, 'update-meta-data/{id}', 'update-meta-data/{id}', NULL, 1, 0, '2016-03-03 09:24:18', '2016-03-03 09:24:18'),
(61, 'change-password-view', 'change-password-view', NULL, 1, 0, '2016-03-03 09:24:18', '2016-03-03 09:24:18'),
(62, 'update-password', 'update-password', NULL, 1, 0, '2016-03-03 09:24:18', '2016-03-03 09:24:18'),
(63, 'store-profile-image', 'store-profile-image', NULL, 1, 0, '2016-03-03 09:24:18', '2016-03-03 09:24:18'),
(64, 'edit-profile-image/{user_image_id}', 'edit-profile-image/{user_image_id}', NULL, 1, 0, '2016-03-03 09:24:18', '2016-03-03 09:24:18'),
(65, 'update-profile-image/{user_image_id}', 'update-profile-image/{user_image_id}', NULL, 1, 0, '2016-03-03 09:24:18', '2016-03-03 09:24:18'),
(66, 'department', 'department', NULL, 1, 0, '2016-03-03 09:24:18', '2016-03-03 09:24:18'),
(67, 'add-department', 'add-department', NULL, 1, 0, '2016-03-03 09:24:18', '2016-03-03 09:24:18'),
(68, 'view-department/{id}', 'view-department/{id}', NULL, 1, 0, '2016-03-03 09:24:18', '2016-03-03 09:24:18'),
(69, 'delete-department/{id}', 'delete-department/{id}', NULL, 1, 0, '2016-03-03 09:24:18', '2016-03-03 09:24:18'),
(70, 'edit-department/{id}', 'edit-department/{id}', NULL, 1, 0, '2016-03-03 09:24:18', '2016-03-03 09:24:18'),
(71, 'update-department/{id}', 'update-department/{id}', NULL, 1, 0, '2016-03-03 09:24:18', '2016-03-03 09:24:18'),
(72, 'search-department', 'search-department', NULL, 1, 0, '2016-03-03 09:24:18', '2016-03-03 09:24:18'),
(73, 'form-elements', 'form-elements', NULL, 1, 0, '2016-03-03 09:24:18', '2016-03-03 09:24:18'),
(74, 'reg-sample', 'reg-sample', NULL, 1, 0, '2016-03-03 09:24:18', '2016-03-03 09:24:18'),
(75, 'admin', 'admin', NULL, 1, 0, '2016-03-03 09:24:18', '2016-03-03 09:24:18'),
(76, 'content-page', 'content-page', NULL, 1, 0, '2016-03-03 09:24:18', '2016-03-03 09:24:18'),
(77, 'validation-page', 'validation-page', NULL, 1, 0, '2016-03-03 09:24:18', '2016-03-03 09:24:18'),
(78, 'store-permission-role', 'store-permission-role', 'store-permission-role', 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00');
*/

/*INSERT INTO `permissions` (`id`, `title`, `route_url`, `description`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, 'index-permission-role', 'index-permission-role', 'index-permission-role', 1, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(2, 'index-permission', 'index-permission', 'index-permission', 1, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(3, 'route-in-permission', 'route-in-permission', 'route-in-permission', 1, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(4, 'welcome', 'welcome', NULL, 1, 0, '2016-03-02 21:23:56', '2016-03-02 21:23:56'),
(5, 'reset-password/{user_id}', 'reset-password/{user_id}', NULL, 1, 0, '2016-03-02 21:24:18', '2016-03-02 21:24:18'),
(6, 'update-new-password', 'update-new-password', NULL, 1, 0, '2016-03-02 21:24:18', '2016-03-02 21:24:18'),
(7, 'get-user-login', 'get-user-login', NULL, 1, 0, '2016-03-02 21:24:18', '2016-03-02 21:24:18'),
(8, 'post-user-login', 'post-user-login', NULL, 1, 0, '2016-03-02 21:24:18', '2016-03-02 21:24:18'),
(9, '/', '/', NULL, 1, 0, '2016-03-02 21:24:18', '2016-03-02 21:24:18'),
(10, 'dashboard', 'dashboard', NULL, 1, 0, '2016-03-02 21:24:18', '2016-03-02 21:24:18'),
(11, 'all_routes_uri', 'all_routes_uri', NULL, 1, 0, '2016-03-02 21:24:18', '2016-03-02 21:24:18'),
(12, 'store-permission', 'store-permission', NULL, 1, 0, '2016-03-02 21:24:18', '2016-03-02 21:24:18'),
(13, 'view-permission/{id}', 'view-permission/{id}', NULL, 1, 0, '2016-03-02 21:24:18', '2016-03-02 21:24:18'),
(14, 'edit-permission/{id}', 'edit-permission/{id}', NULL, 1, 0, '2016-03-02 21:24:18', '2016-03-02 21:24:18'),
(15, 'update-permission/{id}', 'update-permission/{id}', NULL, 1, 0, '2016-03-02 21:24:18', '2016-03-02 21:24:18'),
(16, 'delete-permission/{id}', 'delete-permission/{id}', NULL, 1, 0, '2016-03-02 21:24:18', '2016-03-02 21:24:18'),
(18, 'view-permission-role/{id}', 'view-permission-role/{id}', NULL, 1, 0, '2016-03-02 21:24:18', '2016-03-02 21:24:18'),
(19, 'edit-permission-role/{id}', 'edit-permission-role/{id}', NULL, 1, 0, '2016-03-02 21:24:18', '2016-03-02 21:24:18'),
(20, 'update-permission-role/{id}', 'update-permission-role/{id}', NULL, 1, 0, '2016-03-02 21:24:18', '2016-03-02 21:24:18'),
(21, 'delete-permission-role/{id}', 'delete-permission-role/{id}', NULL, 1, 0, '2016-03-02 21:24:18', '2016-03-02 21:24:18'),
(22, 'search-permission-role', 'search-permission-role', NULL, 1, 0, '2016-03-02 21:24:18', '2016-03-02 21:24:18'),
(23, 'user-activity', 'user-activity', NULL, 1, 0, '2016-03-02 21:24:18', '2016-03-02 21:24:18'),
(24, 'search-user-activity', 'search-user-activity', NULL, 1, 0, '2016-03-02 21:24:18', '2016-03-02 21:24:18'),
(25, 'user-list', 'user-list', NULL, 1, 0, '2016-03-02 21:24:18', '2016-03-02 21:24:18'),
(26, 'add-user', 'add-user', NULL, 1, 0, '2016-03-02 21:24:18', '2016-03-02 21:24:18'),
(27, 'search-user', 'search-user', NULL, 1, 0, '2016-03-02 21:24:18', '2016-03-02 21:24:18'),
(28, 'show-user/{id}', 'show-user/{id}', NULL, 1, 0, '2016-03-02 21:24:18', '2016-03-02 21:24:18'),
(29, 'edit-user/{id}', 'edit-user/{id}', NULL, 1, 0, '2016-03-02 21:24:18', '2016-03-02 21:24:18'),
(30, 'update-user/{id}', 'update-user/{id}', NULL, 1, 0, '2016-03-02 21:24:18', '2016-03-02 21:24:18'),
(31, 'delete-user/{id}', 'delete-user/{id}', NULL, 1, 0, '2016-03-02 21:24:18', '2016-03-02 21:24:18'),
(32, 'create-sign-up', 'create-sign-up', NULL, 1, 0, '2016-03-02 21:24:18', '2016-03-02 21:24:18'),
(33, 'forget-password-view', 'forget-password-view', NULL, 1, 0, '2016-03-02 21:24:18', '2016-03-02 21:24:18'),
(34, 'forget-password', 'forget-password', NULL, 1, 0, '2016-03-02 21:24:18', '2016-03-02 21:24:18'),
(35, 'password-reset-confirm/{reset_password_token}', 'password-reset-confirm/{reset_password_token}', NULL, 1, 0, '2016-03-02 21:24:18', '2016-03-02 21:24:18'),
(36, 'user-save-new-password', 'user-save-new-password', NULL, 1, 0, '2016-03-02 21:24:18', '2016-03-02 21:24:18'),
(37, 'signup', 'signup', NULL, 1, 0, '2016-03-02 21:24:18', '2016-03-02 21:24:18'),
(38, 'user-logout', 'user-logout', NULL, 1, 0, '2016-03-02 21:24:18', '2016-03-02 21:24:18'),
(39, 'role', 'role', NULL, 1, 0, '2016-03-02 21:24:18', '2016-03-02 21:24:18'),
(40, 'store-role', 'store-role', NULL, 1, 0, '2016-03-02 21:24:18', '2016-03-02 21:24:18'),
(41, 'view-role/{slug}', 'view-role/{slug}', NULL, 1, 0, '2016-03-02 21:24:18', '2016-03-02 21:24:18'),
(42, 'edit-role/{slug}', 'edit-role/{slug}', NULL, 1, 0, '2016-03-02 21:24:18', '2016-03-02 21:24:18'),
(43, 'update-role/{slug}', 'update-role/{slug}', NULL, 1, 0, '2016-03-02 21:24:18', '2016-03-02 21:24:18'),
(44, 'delete-role/{slug}', 'delete-role/{slug}', NULL, 1, 0, '2016-03-02 21:24:18', '2016-03-02 21:24:18'),
(45, 'index-role-user', 'index-role-user', NULL, 1, 0, '2016-03-02 21:24:18', '2016-03-02 21:24:18'),
(46, 'search-role-user', 'search-role-user', NULL, 1, 0, '2016-03-02 21:24:18', '2016-03-02 21:24:18'),
(47, 'store-role-user', 'store-role-user', NULL, 1, 0, '2016-03-02 21:24:18', '2016-03-02 21:24:18'),
(48, 'view-role-user/{id}', 'view-role-user/{id}', NULL, 1, 0, '2016-03-02 21:24:18', '2016-03-02 21:24:18'),
(49, 'edit-role-user/{id}', 'edit-role-user/{id}', NULL, 1, 0, '2016-03-02 21:24:18', '2016-03-02 21:24:18'),
(50, 'update-role-user/{id}', 'update-role-user/{id}', NULL, 1, 0, '2016-03-02 21:24:18', '2016-03-02 21:24:18'),
(51, 'delete-role-user/{id}', 'delete-role-user/{id}', NULL, 1, 0, '2016-03-02 21:24:18', '2016-03-02 21:24:18'),
(52, 'user-profile', 'user-profile', NULL, 1, 0, '2016-03-02 21:24:18', '2016-03-02 21:24:18'),
(53, 'user-info/{value}', 'user-info/{value}', NULL, 1, 0, '2016-03-02 21:24:18', '2016-03-02 21:24:18'),
(54, 'inactive-user-dashboard', 'inactive-user-dashboard', NULL, 1, 0, '2016-03-02 21:24:18', '2016-03-02 21:24:18'),
(55, 'store-user-profile', 'store-user-profile', NULL, 1, 0, '2016-03-02 21:24:18', '2016-03-02 21:24:18'),
(56, 'edit-user-profile/{id}', 'edit-user-profile/{id}', NULL, 1, 0, '2016-03-02 21:24:18', '2016-03-02 21:24:18'),
(57, 'update-user-profile/{id}', 'update-user-profile/{id}', NULL, 1, 0, '2016-03-02 21:24:18', '2016-03-02 21:24:18'),
(58, 'store-meta-data', 'store-meta-data', NULL, 1, 0, '2016-03-02 21:24:18', '2016-03-02 21:24:18'),
(59, 'edit-meta-data/{id}', 'edit-meta-data/{id}', NULL, 1, 0, '2016-03-02 21:24:18', '2016-03-02 21:24:18'),
(60, 'update-meta-data/{id}', 'update-meta-data/{id}', NULL, 1, 0, '2016-03-02 21:24:18', '2016-03-02 21:24:18'),
(61, 'change-password-view', 'change-password-view', NULL, 1, 0, '2016-03-02 21:24:18', '2016-03-02 21:24:18'),
(62, 'update-password', 'update-password', NULL, 1, 0, '2016-03-02 21:24:18', '2016-03-02 21:24:18'),
(63, 'store-profile-image', 'store-profile-image', NULL, 1, 0, '2016-03-02 21:24:18', '2016-03-02 21:24:18'),
(64, 'edit-profile-image/{user_image_id}', 'edit-profile-image/{user_image_id}', NULL, 1, 0, '2016-03-02 21:24:18', '2016-03-02 21:24:18'),
(65, 'update-profile-image/{user_image_id}', 'update-profile-image/{user_image_id}', NULL, 1, 0, '2016-03-02 21:24:18', '2016-03-02 21:24:18'),
(66, 'department', 'department', NULL, 1, 0, '2016-03-02 21:24:18', '2016-03-02 21:24:18'),
(67, 'add-department', 'add-department', NULL, 1, 0, '2016-03-02 21:24:18', '2016-03-02 21:24:18'),
(68, 'view-department/{id}', 'view-department/{id}', NULL, 1, 0, '2016-03-02 21:24:18', '2016-03-02 21:24:18'),
(69, 'delete-department/{id}', 'delete-department/{id}', NULL, 1, 0, '2016-03-02 21:24:18', '2016-03-02 21:24:18'),
(70, 'edit-department/{id}', 'edit-department/{id}', NULL, 1, 0, '2016-03-02 21:24:18', '2016-03-02 21:24:18'),
(71, 'update-department/{id}', 'update-department/{id}', NULL, 1, 0, '2016-03-02 21:24:18', '2016-03-02 21:24:18'),
(72, 'search-department', 'search-department', NULL, 1, 0, '2016-03-02 21:24:18', '2016-03-02 21:24:18'),
(73, 'form-elements', 'form-elements', NULL, 1, 0, '2016-03-02 21:24:18', '2016-03-02 21:24:18'),
(74, 'reg-sample', 'reg-sample', NULL, 1, 0, '2016-03-02 21:24:18', '2016-03-02 21:24:18'),
(75, 'admin', 'admin', NULL, 1, 0, '2016-03-02 21:24:18', '2016-03-02 21:24:18'),
(76, 'content-page', 'content-page', NULL, 1, 0, '2016-03-02 21:24:18', '2016-03-02 21:24:18'),
(77, 'validation-page', 'validation-page', NULL, 1, 0, '2016-03-02 21:24:18', '2016-03-02 21:24:18'),
(78, 'store-permission-role', 'store-permission-role', 'store-permission-role', 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(79, 'admin/central-settings', 'admin/central-settings', NULL, 1, 0, '2016-06-15 19:53:38', '2016-06-15 19:53:38'),
(80, 'admin/central-settings-show/{id}', 'admin/central-settings-show/{id}', NULL, 1, 0, '2016-06-15 19:53:38', '2016-06-15 19:53:38'),
(81, 'admin/central-settings-edit/{id}', 'admin/central-settings-edit/{id}', NULL, 1, 0, '2016-06-15 19:53:38', '2016-06-15 19:53:38'),
(82, 'callback', 'callback', NULL, 1, 0, '2016-06-15 19:53:38', '2016-06-15 19:53:38'),
(83, 'admin/imap', 'admin/imap', NULL, 1, 0, '2016-06-15 19:53:38', '2016-06-15 19:53:38'),
(84, 'admin/imap/edit/{id}', 'admin/imap/edit/{id}', NULL, 1, 0, '2016-06-15 19:53:38', '2016-06-15 19:53:38'),
(85, 'admin/imap/{id}', 'admin/imap/{id}', NULL, 1, 0, '2016-06-15 19:53:38', '2016-06-15 19:53:38'),
(86, 'delete/{id}', 'delete/{id}', NULL, 1, 0, '2016-06-15 19:53:38', '2016-06-15 19:53:38'),
(87, 'admin/smtp', 'admin/smtp', NULL, 1, 0, '2016-06-15 19:53:38', '2016-06-15 19:53:38'),
(88, 'admin/smtp/edit/{id}', 'admin/smtp/edit/{id}', NULL, 1, 0, '2016-06-15 19:53:38', '2016-06-15 19:53:38'),
(89, 'admin/smtp/{id}', 'admin/smtp/{id}', NULL, 1, 0, '2016-06-15 19:53:38', '2016-06-15 19:53:38'),
(90, 'admin/smtp/delete/{id}', 'admin/smtp/delete/{id}', NULL, 1, 0, '2016-06-15 19:53:38', '2016-06-15 19:53:38'),
(91, 'admin/popping-email', 'admin/popping-email', NULL, 1, 0, '2016-06-15 19:53:38', '2016-06-15 19:53:38'),
(92, 'admin/popping-email/search', 'admin/popping-email/search', NULL, 1, 0, '2016-06-15 19:53:38', '2016-06-15 19:53:38'),
(93, 'admin/popping-email/show/{id}', 'admin/popping-email/show/{id}', NULL, 1, 0, '2016-06-15 19:53:38', '2016-06-15 19:53:38'),
(94, 'admin/popping-email/edit/{id}', 'admin/popping-email/edit/{id}', NULL, 1, 0, '2016-06-15 19:53:39', '2016-06-15 19:53:39'),
(95, 'admin/popping-email/{id}', 'admin/popping-email/{id}', NULL, 1, 0, '2016-06-15 19:53:39', '2016-06-15 19:53:39'),
(96, 'admin/popping-email/delete/{id}', 'admin/popping-email/delete/{id}', NULL, 1, 0, '2016-06-15 19:53:39', '2016-06-15 19:53:39'),
(97, 'admin/filter', 'admin/filter', NULL, 1, 0, '2016-06-15 19:53:39', '2016-06-15 19:53:39'),
(98, 'admin/filter/edit/{id}', 'admin/filter/edit/{id}', NULL, 1, 0, '2016-06-15 19:53:39', '2016-06-15 19:53:39'),
(99, 'admin/filter/{id}', 'admin/filter/{id}', NULL, 1, 0, '2016-06-15 19:53:39', '2016-06-15 19:53:39'),
(100, 'admin/filter/delete/{id}', 'admin/filter/delete/{id}', NULL, 1, 0, '2016-06-15 19:53:39', '2016-06-15 19:53:39'),
(101, 'admin/schedule', 'admin/schedule', NULL, 1, 0, '2016-06-15 19:53:39', '2016-06-15 19:53:39'),
(102, 'admin.schedule', 'admin.schedule', NULL, 1, 0, '2016-06-15 19:53:39', '2016-06-15 19:53:39'),
(103, 'admin/schedule/edit/{id}', 'admin/schedule/edit/{id}', NULL, 1, 0, '2016-06-15 19:53:39', '2016-06-15 19:53:39'),
(104, 'admin/schedule/{id}', 'admin/schedule/{id}', NULL, 1, 0, '2016-06-15 19:53:39', '2016-06-15 19:53:39'),
(105, 'admin/schedule/delete/{id}', 'admin/schedule/delete/{id}', NULL, 1, 0, '2016-06-15 19:53:39', '2016-06-15 19:53:39'),
(106, 'admin/invoice', 'admin/invoice', NULL, 1, 0, '2016-06-15 19:53:39', '2016-06-15 19:53:39'),
(107, 'admin/invoice/view/{id}', 'admin/invoice/view/{id}', NULL, 1, 0, '2016-06-15 19:53:39', '2016-06-15 19:53:39'),
(108, 'admin/invoice/change_status/{id}', 'admin/invoice/change_status/{id}', NULL, 1, 0, '2016-06-15 19:53:39', '2016-06-15 19:53:39'),
(109, 'admin/invoice/delete/{id}', 'admin/invoice/delete/{id}', NULL, 1, 0, '2016-06-15 19:53:39', '2016-06-15 19:53:39'),
(110, 'admin/invoice/update_status/{id}', 'admin/invoice/update_status/{id}', NULL, 1, 0, '2016-06-15 19:53:39', '2016-06-15 19:53:39'),
(111, 'admin/lead', 'admin/lead', NULL, 1, 0, '2016-06-15 19:53:39', '2016-06-15 19:53:39'),
(112, 'homer', 'homer', NULL, 1, 0, '2016-06-15 19:53:39', '2016-06-15 19:53:39'),
(113, 'menu-panel', 'menu-panel', NULL, 1, 0, '2016-06-15 19:53:40', '2016-06-15 19:53:40'),
(114, 'store-menu-panel', 'store-menu-panel', NULL, 1, 0, '2016-06-15 19:53:40', '2016-06-15 19:53:40'),
(115, 'search-menu-panel', 'search-menu-panel', NULL, 1, 0, '2016-06-15 19:53:40', '2016-06-15 19:53:40'),
(116, 'view-menu-panel/{id}', 'view-menu-panel/{id}', NULL, 1, 0, '2016-06-15 19:53:40', '2016-06-15 19:53:40'),
(117, 'edit-menu-panel/{id}/{parent_menu_id}', 'edit-menu-panel/{id}/{parent_menu_id}', NULL, 1, 0, '2016-06-15 19:53:40', '2016-06-15 19:53:40'),
(118, 'update-menu-panel/{id}', 'update-menu-panel/{id}', NULL, 1, 0, '2016-06-15 19:53:40', '2016-06-15 19:53:40'),
(119, 'delete-menu-panel/{id}', 'delete-menu-panel/{id}', NULL, 1, 0, '2016-06-15 19:53:40', '2016-06-15 19:53:40'),
(120, 'menu-list', 'menu-list', NULL, 1, 0, '2016-06-15 19:53:40', '2016-06-15 19:53:40'),
(121, 'sidebar-menu', 'sidebar-menu', NULL, 1, 0, '2016-06-15 19:53:40', '2016-06-15 19:53:40'),
(122, 'view-currency', 'view-currency', NULL, 1, 0, '2016-06-15 19:53:40', '2016-06-15 19:53:40'),
(123, 'add-currency', 'add-currency', NULL, 1, 0, '2016-06-15 19:53:40', '2016-06-15 19:53:40'),
(124, 'edit-currency/{id}', 'edit-currency/{id}', NULL, 1, 0, '2016-06-15 19:53:40', '2016-06-15 19:53:40'),
(125, 'update-currency/{id}', 'update-currency/{id}', NULL, 1, 0, '2016-06-15 19:53:40', '2016-06-15 19:53:40'),
(126, 'delete-currency/{id}', 'delete-currency/{id}', NULL, 1, 0, '2016-06-15 19:53:40', '2016-06-15 19:53:40'),
(127, 'dashboard/user', 'dashboard/user', NULL, 1, 0, '2016-06-15 19:53:40', '2016-06-15 19:53:40'),
(128, 'admin/schedule_store', 'admin/schedule_store', NULL, 1, 0, '2016-06-19 01:53:56', '2016-06-19 01:53:56'),
(129, 'admin/imap_store', 'admin/imap_store', NULL, 1, 0, '2016-06-19 02:47:48', '2016-06-19 02:47:48'),
(130, 'admin/smtp_store', 'admin/smtp_store', NULL, 1, 0, '2016-06-19 02:47:48', '2016-06-19 02:47:48'),
(131, 'admin/popping-email-store', 'admin/popping-email-store', NULL, 1, 0, '2016-06-19 02:47:48', '2016-06-19 02:47:48'),
(132, 'admin/filter_store', 'admin/filter_store', NULL, 1, 0, '2016-06-19 02:47:48', '2016-06-19 02:47:48'),
(133, 'admin/imap/delete/{id}', 'admin/imap/delete/{id}', NULL, 3, 0, '2016-06-19 05:03:54', '2016-06-19 05:03:54');*/

INSERT INTO `permissions` (`id`, `title`, `route_url`, `description`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, 'index-permission-role', 'index-permission-role', 'index-permission-role', 1, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(2, 'index-permission', 'index-permission', 'index-permission', 1, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(3, 'route-in-permission', 'route-in-permission', 'route-in-permission', 1, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(4, 'welcome', 'welcome', NULL, 1, 0, '2016-03-02 15:23:56', '2016-03-02 15:23:56'),
(5, 'reset-password/{user_id}', 'reset-password/{user_id}', NULL, 1, 0, '2016-03-02 15:24:18', '2016-03-02 15:24:18'),
(6, 'update-new-password', 'update-new-password', NULL, 1, 0, '2016-03-02 15:24:18', '2016-03-02 15:24:18'),
(7, 'get-user-login', 'get-user-login', NULL, 1, 0, '2016-03-02 15:24:18', '2016-03-02 15:24:18'),
(8, 'post-user-login', 'post-user-login', NULL, 1, 0, '2016-03-02 15:24:18', '2016-03-02 15:24:18'),
(9, '/', '/', NULL, 1, 0, '2016-03-02 15:24:18', '2016-03-02 15:24:18'),
(10, 'dashboard', 'dashboard', NULL, 1, 0, '2016-03-02 15:24:18', '2016-03-02 15:24:18'),
(11, 'all_routes_uri', 'all_routes_uri', NULL, 1, 0, '2016-03-02 15:24:18', '2016-03-02 15:24:18'),
(12, 'store-permission', 'store-permission', NULL, 1, 0, '2016-03-02 15:24:18', '2016-03-02 15:24:18'),
(13, 'view-permission/{id}', 'view-permission/{id}', NULL, 1, 0, '2016-03-02 15:24:18', '2016-03-02 15:24:18'),
(14, 'edit-permission/{id}', 'edit-permission/{id}', NULL, 1, 0, '2016-03-02 15:24:18', '2016-03-02 15:24:18'),
(15, 'update-permission/{id}', 'update-permission/{id}', NULL, 1, 0, '2016-03-02 15:24:18', '2016-03-02 15:24:18'),
(16, 'delete-permission/{id}', 'delete-permission/{id}', NULL, 1, 0, '2016-03-02 15:24:18', '2016-03-02 15:24:18'),
(18, 'view-permission-role/{id}', 'view-permission-role/{id}', NULL, 1, 0, '2016-03-02 15:24:18', '2016-03-02 15:24:18'),
(19, 'edit-permission-role/{id}', 'edit-permission-role/{id}', NULL, 1, 0, '2016-03-02 15:24:18', '2016-03-02 15:24:18'),
(20, 'update-permission-role/{id}', 'update-permission-role/{id}', NULL, 1, 0, '2016-03-02 15:24:18', '2016-03-02 15:24:18'),
(21, 'delete-permission-role/{id}', 'delete-permission-role/{id}', NULL, 1, 0, '2016-03-02 15:24:18', '2016-03-02 15:24:18'),
(22, 'search-permission-role', 'search-permission-role', NULL, 1, 0, '2016-03-02 15:24:18', '2016-03-02 15:24:18'),
(23, 'user-activity', 'user-activity', NULL, 1, 0, '2016-03-02 15:24:18', '2016-03-02 15:24:18'),
(24, 'search-user-activity', 'search-user-activity', NULL, 1, 0, '2016-03-02 15:24:18', '2016-03-02 15:24:18'),
(25, 'user-list', 'user-list', NULL, 1, 0, '2016-03-02 15:24:18', '2016-03-02 15:24:18'),
(26, 'add-user', 'add-user', NULL, 1, 0, '2016-03-02 15:24:18', '2016-03-02 15:24:18'),
(27, 'search-user', 'search-user', NULL, 1, 0, '2016-03-02 15:24:18', '2016-03-02 15:24:18'),
(28, 'show-user/{id}', 'show-user/{id}', NULL, 1, 0, '2016-03-02 15:24:18', '2016-03-02 15:24:18'),
(29, 'edit-user/{id}', 'edit-user/{id}', NULL, 1, 0, '2016-03-02 15:24:18', '2016-03-02 15:24:18'),
(30, 'update-user/{id}', 'update-user/{id}', NULL, 1, 0, '2016-03-02 15:24:18', '2016-03-02 15:24:18'),
(31, 'delete-user/{id}', 'delete-user/{id}', NULL, 1, 0, '2016-03-02 15:24:18', '2016-03-02 15:24:18'),
(32, 'create-sign-up', 'create-sign-up', NULL, 1, 0, '2016-03-02 15:24:18', '2016-03-02 15:24:18'),
(33, 'forget-password-view', 'forget-password-view', NULL, 1, 0, '2016-03-02 15:24:18', '2016-03-02 15:24:18'),
(34, 'forget-password', 'forget-password', NULL, 1, 0, '2016-03-02 15:24:18', '2016-03-02 15:24:18'),
(35, 'password-reset-confirm/{reset_password_token}', 'password-reset-confirm/{reset_password_token}', NULL, 1, 0, '2016-03-02 15:24:18', '2016-03-02 15:24:18'),
(36, 'user-save-new-password', 'user-save-new-password', NULL, 1, 0, '2016-03-02 15:24:18', '2016-03-02 15:24:18'),
(37, 'signup', 'signup', NULL, 1, 0, '2016-03-02 15:24:18', '2016-03-02 15:24:18'),
(38, 'user-logout', 'user-logout', NULL, 1, 0, '2016-03-02 15:24:18', '2016-03-02 15:24:18'),
(39, 'role', 'role', NULL, 1, 0, '2016-03-02 15:24:18', '2016-03-02 15:24:18'),
(40, 'store-role', 'store-role', NULL, 1, 0, '2016-03-02 15:24:18', '2016-03-02 15:24:18'),
(41, 'view-role/{slug}', 'view-role/{slug}', NULL, 1, 0, '2016-03-02 15:24:18', '2016-03-02 15:24:18'),
(42, 'edit-role/{slug}', 'edit-role/{slug}', NULL, 1, 0, '2016-03-02 15:24:18', '2016-03-02 15:24:18'),
(43, 'update-role/{slug}', 'update-role/{slug}', NULL, 1, 0, '2016-03-02 15:24:18', '2016-03-02 15:24:18'),
(44, 'delete-role/{slug}', 'delete-role/{slug}', NULL, 1, 0, '2016-03-02 15:24:18', '2016-03-02 15:24:18'),
(45, 'index-role-user', 'index-role-user', NULL, 1, 0, '2016-03-02 15:24:18', '2016-03-02 15:24:18'),
(46, 'search-role-user', 'search-role-user', NULL, 1, 0, '2016-03-02 15:24:18', '2016-03-02 15:24:18'),
(47, 'store-role-user', 'store-role-user', NULL, 1, 0, '2016-03-02 15:24:18', '2016-03-02 15:24:18'),
(48, 'view-role-user/{id}', 'view-role-user/{id}', NULL, 1, 0, '2016-03-02 15:24:18', '2016-03-02 15:24:18'),
(49, 'edit-role-user/{id}', 'edit-role-user/{id}', NULL, 1, 0, '2016-03-02 15:24:18', '2016-03-02 15:24:18'),
(50, 'update-role-user/{id}', 'update-role-user/{id}', NULL, 1, 0, '2016-03-02 15:24:18', '2016-03-02 15:24:18'),
(51, 'delete-role-user/{id}', 'delete-role-user/{id}', NULL, 1, 0, '2016-03-02 15:24:18', '2016-03-02 15:24:18'),
(52, 'user-profile', 'user-profile', NULL, 1, 0, '2016-03-02 15:24:18', '2016-03-02 15:24:18'),
(53, 'user-info/{value}', 'user-info/{value}', NULL, 1, 0, '2016-03-02 15:24:18', '2016-03-02 15:24:18'),
(54, 'inactive-user-dashboard', 'inactive-user-dashboard', NULL, 1, 0, '2016-03-02 15:24:18', '2016-03-02 15:24:18'),
(55, 'store-user-profile', 'store-user-profile', NULL, 1, 0, '2016-03-02 15:24:18', '2016-03-02 15:24:18'),
(56, 'edit-user-profile/{id}', 'edit-user-profile/{id}', NULL, 1, 0, '2016-03-02 15:24:18', '2016-03-02 15:24:18'),
(57, 'update-user-profile/{id}', 'update-user-profile/{id}', NULL, 1, 0, '2016-03-02 15:24:18', '2016-03-02 15:24:18'),
(58, 'store-meta-data', 'store-meta-data', NULL, 1, 0, '2016-03-02 15:24:18', '2016-03-02 15:24:18'),
(59, 'edit-meta-data/{id}', 'edit-meta-data/{id}', NULL, 1, 0, '2016-03-02 15:24:18', '2016-03-02 15:24:18'),
(60, 'update-meta-data/{id}', 'update-meta-data/{id}', NULL, 1, 0, '2016-03-02 15:24:18', '2016-03-02 15:24:18'),
(61, 'change-password-view', 'change-password-view', NULL, 1, 0, '2016-03-02 15:24:18', '2016-03-02 15:24:18'),
(62, 'update-password', 'update-password', NULL, 1, 0, '2016-03-02 15:24:18', '2016-03-02 15:24:18'),
(63, 'store-profile-image', 'store-profile-image', NULL, 1, 0, '2016-03-02 15:24:18', '2016-03-02 15:24:18'),
(64, 'edit-profile-image/{user_image_id}', 'edit-profile-image/{user_image_id}', NULL, 1, 0, '2016-03-02 15:24:18', '2016-03-02 15:24:18'),
(65, 'update-profile-image/{user_image_id}', 'update-profile-image/{user_image_id}', NULL, 1, 0, '2016-03-02 15:24:18', '2016-03-02 15:24:18'),
(66, 'department', 'department', NULL, 1, 0, '2016-03-02 15:24:18', '2016-03-02 15:24:18'),
(67, 'add-department', 'add-department', NULL, 1, 0, '2016-03-02 15:24:18', '2016-03-02 15:24:18'),
(68, 'view-department/{id}', 'view-department/{id}', NULL, 1, 0, '2016-03-02 15:24:18', '2016-03-02 15:24:18'),
(69, 'delete-department/{id}', 'delete-department/{id}', NULL, 1, 0, '2016-03-02 15:24:18', '2016-03-02 15:24:18'),
(70, 'edit-department/{id}', 'edit-department/{id}', NULL, 1, 0, '2016-03-02 15:24:18', '2016-03-02 15:24:18'),
(71, 'update-department/{id}', 'update-department/{id}', NULL, 1, 0, '2016-03-02 15:24:18', '2016-03-02 15:24:18'),
(72, 'search-department', 'search-department', NULL, 1, 0, '2016-03-02 15:24:18', '2016-03-02 15:24:18'),
(73, 'form-elements', 'form-elements', NULL, 1, 0, '2016-03-02 15:24:18', '2016-03-02 15:24:18'),
(74, 'reg-sample', 'reg-sample', NULL, 1, 0, '2016-03-02 15:24:18', '2016-03-02 15:24:18'),
(75, 'admin', 'admin', NULL, 1, 0, '2016-03-02 15:24:18', '2016-03-02 15:24:18'),
(76, 'content-page', 'content-page', NULL, 1, 0, '2016-03-02 15:24:18', '2016-03-02 15:24:18'),
(77, 'validation-page', 'validation-page', NULL, 1, 0, '2016-03-02 15:24:18', '2016-03-02 15:24:18'),
(78, 'store-permission-role', 'store-permission-role', 'store-permission-role', 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(79, 'admin/central-settings', 'admin/central-settings', NULL, 1, 0, '2016-06-15 13:53:38', '2016-06-15 13:53:38'),
(80, 'admin/central-settings-show/{id}', 'admin/central-settings-show/{id}', NULL, 1, 0, '2016-06-15 13:53:38', '2016-06-15 13:53:38'),
(81, 'admin/central-settings-edit/{id}', 'admin/central-settings-edit/{id}', NULL, 1, 0, '2016-06-15 13:53:38', '2016-06-15 13:53:38'),
(82, 'callback', 'callback', NULL, 1, 0, '2016-06-15 13:53:38', '2016-06-15 13:53:38'),
(83, 'admin/imap', 'admin/imap', NULL, 1, 0, '2016-06-15 13:53:38', '2016-06-15 13:53:38'),
(84, 'admin/imap/edit/{id}', 'admin/imap/edit/{id}', NULL, 1, 0, '2016-06-15 13:53:38', '2016-06-15 13:53:38'),
(85, 'admin/imap/{id}', 'admin/imap/{id}', NULL, 1, 0, '2016-06-15 13:53:38', '2016-06-15 13:53:38'),
(86, 'delete/{id}', 'delete/{id}', NULL, 1, 0, '2016-06-15 13:53:38', '2016-06-15 13:53:38'),
(87, 'admin/smtp', 'admin/smtp', NULL, 1, 0, '2016-06-15 13:53:38', '2016-06-15 13:53:38'),
(88, 'admin/smtp/edit/{id}', 'admin/smtp/edit/{id}', NULL, 1, 0, '2016-06-15 13:53:38', '2016-06-15 13:53:38'),
(89, 'admin/smtp/{id}', 'admin/smtp/{id}', NULL, 1, 0, '2016-06-15 13:53:38', '2016-06-15 13:53:38'),
(90, 'admin/smtp/delete/{id}', 'admin/smtp/delete/{id}', NULL, 1, 0, '2016-06-15 13:53:38', '2016-06-15 13:53:38'),
(91, 'admin/popping-email', 'admin/popping-email', NULL, 1, 0, '2016-06-15 13:53:38', '2016-06-15 13:53:38'),
(92, 'admin/popping-email/search', 'admin/popping-email/search', NULL, 1, 0, '2016-06-15 13:53:38', '2016-06-15 13:53:38'),
(93, 'admin/popping-email/show/{id}', 'admin/popping-email/show/{id}', NULL, 1, 0, '2016-06-15 13:53:38', '2016-06-15 13:53:38'),
(94, 'admin/popping-email/edit/{id}', 'admin/popping-email/edit/{id}', NULL, 1, 0, '2016-06-15 13:53:39', '2016-06-15 13:53:39'),
(95, 'admin/popping-email/{id}', 'admin/popping-email/{id}', NULL, 1, 0, '2016-06-15 13:53:39', '2016-06-15 13:53:39'),
(96, 'admin/popping-email/delete/{id}', 'admin/popping-email/delete/{id}', NULL, 1, 0, '2016-06-15 13:53:39', '2016-06-15 13:53:39'),
(97, 'admin/filter', 'admin/filter', NULL, 1, 0, '2016-06-15 13:53:39', '2016-06-15 13:53:39'),
(98, 'admin/filter/edit/{id}', 'admin/filter/edit/{id}', NULL, 1, 0, '2016-06-15 13:53:39', '2016-06-15 13:53:39'),
(99, 'admin/filter/{id}', 'admin/filter/{id}', NULL, 1, 0, '2016-06-15 13:53:39', '2016-06-15 13:53:39'),
(100, 'admin/filter/delete/{id}', 'admin/filter/delete/{id}', NULL, 1, 0, '2016-06-15 13:53:39', '2016-06-15 13:53:39'),
(101, 'admin/schedule', 'admin/schedule', NULL, 1, 0, '2016-06-15 13:53:39', '2016-06-15 13:53:39'),
(102, 'admin.schedule', 'admin.schedule', NULL, 1, 0, '2016-06-15 13:53:39', '2016-06-15 13:53:39'),
(103, 'admin/schedule/edit/{id}', 'admin/schedule/edit/{id}', NULL, 1, 0, '2016-06-15 13:53:39', '2016-06-15 13:53:39'),
(104, 'admin/schedule/{id}', 'admin/schedule/{id}', NULL, 1, 0, '2016-06-15 13:53:39', '2016-06-15 13:53:39'),
(105, 'admin/schedule/delete/{id}', 'admin/schedule/delete/{id}', NULL, 1, 0, '2016-06-15 13:53:39', '2016-06-15 13:53:39'),
(106, 'admin/invoice', 'admin/invoice', NULL, 1, 0, '2016-06-15 13:53:39', '2016-06-15 13:53:39'),
(107, 'admin/invoice/view/{id}', 'admin/invoice/view/{id}', NULL, 1, 0, '2016-06-15 13:53:39', '2016-06-15 13:53:39'),
(108, 'admin/invoice/change_status/{id}', 'admin/invoice/change_status/{id}', NULL, 1, 0, '2016-06-15 13:53:39', '2016-06-15 13:53:39'),
(109, 'admin/invoice/delete/{id}', 'admin/invoice/delete/{id}', NULL, 1, 0, '2016-06-15 13:53:39', '2016-06-15 13:53:39'),
(110, 'admin/invoice/update_status/{id}', 'admin/invoice/update_status/{id}', NULL, 1, 0, '2016-06-15 13:53:39', '2016-06-15 13:53:39'),
(111, 'admin/lead', 'admin/lead', NULL, 1, 0, '2016-06-15 13:53:39', '2016-06-15 13:53:39'),
(112, 'homer', 'homer', NULL, 1, 0, '2016-06-15 13:53:39', '2016-06-15 13:53:39'),
(113, 'menu-panel', 'menu-panel', NULL, 1, 0, '2016-06-15 13:53:40', '2016-06-15 13:53:40'),
(114, 'store-menu-panel', 'store-menu-panel', NULL, 1, 0, '2016-06-15 13:53:40', '2016-06-15 13:53:40'),
(115, 'search-menu-panel', 'search-menu-panel', NULL, 1, 0, '2016-06-15 13:53:40', '2016-06-15 13:53:40'),
(116, 'view-menu-panel/{id}', 'view-menu-panel/{id}', NULL, 1, 0, '2016-06-15 13:53:40', '2016-06-15 13:53:40'),
(117, 'edit-menu-panel/{id}/{parent_menu_id}', 'edit-menu-panel/{id}/{parent_menu_id}', NULL, 1, 0, '2016-06-15 13:53:40', '2016-06-15 13:53:40'),
(118, 'update-menu-panel/{id}', 'update-menu-panel/{id}', NULL, 1, 0, '2016-06-15 13:53:40', '2016-06-15 13:53:40'),
(119, 'delete-menu-panel/{id}', 'delete-menu-panel/{id}', NULL, 1, 0, '2016-06-15 13:53:40', '2016-06-15 13:53:40'),
(120, 'menu-list', 'menu-list', NULL, 1, 0, '2016-06-15 13:53:40', '2016-06-15 13:53:40'),
(121, 'sidebar-menu', 'sidebar-menu', NULL, 1, 0, '2016-06-15 13:53:40', '2016-06-15 13:53:40'),
(122, 'view-currency', 'view-currency', NULL, 1, 0, '2016-06-15 13:53:40', '2016-06-15 13:53:40'),
(123, 'add-currency', 'add-currency', NULL, 1, 0, '2016-06-15 13:53:40', '2016-06-15 13:53:40'),
(124, 'edit-currency/{id}', 'edit-currency/{id}', NULL, 1, 0, '2016-06-15 13:53:40', '2016-06-15 13:53:40'),
(125, 'update-currency/{id}', 'update-currency/{id}', NULL, 1, 0, '2016-06-15 13:53:40', '2016-06-15 13:53:40'),
(126, 'delete-currency/{id}', 'delete-currency/{id}', NULL, 1, 0, '2016-06-15 13:53:40', '2016-06-15 13:53:40'),
(127, 'dashboard/user', 'dashboard/user', NULL, 1, 0, '2016-06-15 13:53:40', '2016-06-15 13:53:40'),
(128, 'admin/schedule_store', 'admin/schedule_store', NULL, 1, 0, '2016-06-18 19:53:56', '2016-06-18 19:53:56'),
(129, 'admin/imap_store', 'admin/imap_store', NULL, 1, 0, '2016-06-18 20:47:48', '2016-06-18 20:47:48'),
(130, 'admin/smtp_store', 'admin/smtp_store', NULL, 1, 0, '2016-06-18 20:47:48', '2016-06-18 20:47:48'),
(131, 'admin/popping-email-store', 'admin/popping-email-store', NULL, 1, 0, '2016-06-18 20:47:48', '2016-06-18 20:47:48'),
(132, 'admin/filter_store', 'admin/filter_store', NULL, 1, 0, '2016-06-18 20:47:48', '2016-06-18 20:47:48'),
(133, 'admin/imap/delete/{id}', 'admin/imap/delete/{id}', NULL, 3, 0, '2016-06-18 23:03:54', '2016-06-18 23:03:54'),
(134, 'admin/lead/{id}', 'admin/lead/{id}', NULL, 3, 0, '2016-06-20 00:47:08', '2016-06-20 00:47:08'),
(135, 'admin/invoice/{id}', 'admin/invoice/{id}', NULL, 3, 0, '2016-06-20 02:40:01', '2016-06-20 02:40:01'),
(136, 'home-test', 'home-test', NULL, 3, 0, '2016-06-20 03:36:47', '2016-06-20 03:36:47'),
(137, 'admin/popping-email/active-inactive/{id}', 'admin/popping-email/active-inactive/{id}', NULL, 3, 0, '2016-06-20 03:36:47', '2016-06-20 03:36:47'),
(138, 'admin/invoice/update_status/{status}/{id}', 'admin/invoice/update_status/{status}/{id}', NULL, 3, 0, '2016-06-21 03:24:47', '2016-06-21 03:24:47'),
(139, 'user-by-lead/{user_id}', 'user-by-lead/{user_id}', NULL, 3, 0, '2016-06-22 01:59:01', '2016-06-22 01:59:01'),
(140, 'lead-archive', 'lead-archive', NULL, 3, 0, '2016-06-23 03:13:54', '2016-06-23 03:13:54'),
(141, 'admin/lead-archive/{file_name?}', 'admin/lead-archive/{file_name?}', NULL, 3, 0, '2016-06-23 03:13:54', '2016-06-23 03:13:54'),
(142, 'dashboard', 'dashboard', NULL, 1, 0, '2016-03-02 15:24:18', '2016-03-02 15:24:18'),
(143, 'admin/invoice/user_invoices/{user_id}', 'admin/invoice/user_invoices/{user_id}', NULL, 1, 0, '2016-03-02 15:24:18', '2016-03-02 15:24:18'),;


