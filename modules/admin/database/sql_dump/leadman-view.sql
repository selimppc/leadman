--
-- Stand-in structure for view `vu_no_filtered_email`
--
CREATE TABLE IF NOT EXISTS `vu_no_filtered_email` (
`user_id` int(10) unsigned
,`email` varchar(128)
,`no_of_lead` bigint(21)
);
-- --------------------------------------------------------

--
-- Stand-in structure for view `vu_no_of_email`
--
CREATE TABLE IF NOT EXISTS `vu_no_of_email` (
`user_id` int(10) unsigned
,`email` varchar(128)
,`no_of_lead` bigint(21)
);
-- --------------------------------------------------------

--
-- Stand-in structure for view `v_invoice_approved`
--
CREATE TABLE IF NOT EXISTS `v_invoice_approved` (
`id` int(10) unsigned
,`user_id` int(10) unsigned
,`ai` bigint(21)
);
-- --------------------------------------------------------

--
-- Stand-in structure for view `v_invoice_open`
--
CREATE TABLE IF NOT EXISTS `v_invoice_open` (
`id` int(10) unsigned
,`user_id` int(10) unsigned
,`oi` bigint(21)
);
-- --------------------------------------------------------

--
-- Stand-in structure for view `v_invoice_paid`
--
CREATE TABLE IF NOT EXISTS `v_invoice_paid` (
`id` int(10) unsigned
,`user_id` int(10) unsigned
,`PI` bigint(21)
);
-- --------------------------------------------------------

--
-- Stand-in structure for view `v_invoice_sum_cost_count`
--
CREATE TABLE IF NOT EXISTS `v_invoice_sum_cost_count` (
`id` int(10) unsigned
,`user_id` int(10) unsigned
,`tc` double(19,2)
,`noi` bigint(21)
);
-- --------------------------------------------------------

--
-- Stand-in structure for view `v_invoice_sum_cost_count_7days`
--
CREATE TABLE IF NOT EXISTS `v_invoice_sum_cost_count_7days` (
`id` int(10) unsigned
,`user_id` int(10) unsigned
,`tc` double(19,2)
,`noi` bigint(21)
);
-- --------------------------------------------------------

--
-- Stand-in structure for view `v_invoice_sum_cost_count_24hours`
--
CREATE TABLE IF NOT EXISTS `v_invoice_sum_cost_count_24hours` (
`id` int(10) unsigned
,`user_id` int(10) unsigned
,`tc` double(19,2)
,`noi` bigint(21)
);
-- --------------------------------------------------------

--
-- Stand-in structure for view `v_lead_count_7days`
--
CREATE TABLE IF NOT EXISTS `v_lead_count_7days` (
`id` int(10) unsigned
,`popping_email_id` int(10) unsigned
,`nol` bigint(21)
,`lc` double(19,2)
);
-- --------------------------------------------------------

--
-- Stand-in structure for view `v_lead_count_24hours`
--
CREATE TABLE IF NOT EXISTS `v_lead_count_24hours` (
`id` int(10) unsigned
,`popping_email_id` int(10) unsigned
,`nol` bigint(21)
,`lc` double(19,2)
);
-- --------------------------------------------------------

--
-- Stand-in structure for view `v_popping_email_count`
--
CREATE TABLE IF NOT EXISTS `v_popping_email_count` (
`id` int(10) unsigned
,`user_id` int(10) unsigned
,`nope` bigint(21)
);
-- --------------------------------------------------------

--
-- Stand-in structure for view `v_result_7_days`
--
CREATE TABLE IF NOT EXISTS `v_result_7_days` (
`user_id` int(10) unsigned
,`username` varchar(64)
,`no_of_popping_email` bigint(21)
,`no_of_lead` bigint(21)
,`no_of_invoice` bigint(21)
,`invoice_cost` double(19,2)
,`lead_cost` double(19,2)
);
-- --------------------------------------------------------

--
-- Stand-in structure for view `v_result_7_days_amount`
--
CREATE TABLE IF NOT EXISTS `v_result_7_days_amount` (
`total_cost` double(19,2)
);
-- --------------------------------------------------------

--
-- Stand-in structure for view `v_result_7_days_lead`
--
CREATE TABLE IF NOT EXISTS `v_result_7_days_lead` (
`total_lead` bigint(21)
);
-- --------------------------------------------------------

--
-- Stand-in structure for view `v_result_24`
--
CREATE TABLE IF NOT EXISTS `v_result_24` (
`user_id` int(10) unsigned
,`username` varchar(64)
,`no_of_popping_email` bigint(21)
,`no_of_lead` bigint(21)
,`no_of_invoice` bigint(21)
,`invoice_cost` double(19,2)
,`lead_cost` double(19,2)
);
-- --------------------------------------------------------

--
-- Stand-in structure for view `v_result_24_amount`
--
CREATE TABLE IF NOT EXISTS `v_result_24_amount` (
`total_cost` double(19,2)
);
-- --------------------------------------------------------

--
-- Stand-in structure for view `v_result_24_lead`
--
CREATE TABLE IF NOT EXISTS `v_result_24_lead` (
`total_lead` bigint(21)
);
-- --------------------------------------------------------

--
-- Stand-in structure for view `v_user_invoice_status`
--
CREATE TABLE IF NOT EXISTS `v_user_invoice_status` (
`user_id` int(10) unsigned
,`username` varchar(64)
,`open_invoice` bigint(21)
,`approved_invoice` bigint(21)
,`paid_invoice` bigint(21)
,`total_cost` double(19,2)
);
-- --------------------------------------------------------

--
-- Stand-in structure for view `v_user_leads`
--
CREATE TABLE IF NOT EXISTS `v_user_leads` (
`user_id` int(10) unsigned
,`username` varchar(64)
,`total_lead` bigint(21)
,`no_of_popping_email` bigint(21)
);
-- --------------------------------------------------------

--
-- Stand-in structure for view `v_user_lead_status_duplicate`
--
CREATE TABLE IF NOT EXISTS `v_user_lead_status_duplicate` (
`user_id` int(10) unsigned
,`username` varchar(64)
,`email` varchar(128)
,`duplicate_leads` bigint(21)
);
-- --------------------------------------------------------

--
-- Stand-in structure for view `v_user_lead_status_filtered`
--
CREATE TABLE IF NOT EXISTS `v_user_lead_status_filtered` (
`user_id` int(10) unsigned
,`username` varchar(64)
,`email` varchar(128)
,`filtered_leads` bigint(21)
);
-- --------------------------------------------------------

--
-- Structure for view `vu_no_filtered_email`
--
DROP TABLE IF EXISTS `vu_no_filtered_email`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vu_no_filtered_email` AS (select `popping_email`.`user_id` AS `user_id`,`popping_email`.`email` AS `email`,count(distinct `lead`.`id`) AS `no_of_lead` from (`popping_email` left join `lead` on((`lead`.`popping_email_id` = `popping_email`.`id`))) where ((`lead`.`status` = 'filtered') and (`popping_email`.`status` <> 'cancel')) group by `popping_email`.`id`);

-- --------------------------------------------------------

--
-- Structure for view `vu_no_of_email`
--
DROP TABLE IF EXISTS `vu_no_of_email`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vu_no_of_email` AS (select `popping_email`.`user_id` AS `user_id`,`popping_email`.`email` AS `email`,count(distinct `lead`.`id`) AS `no_of_lead` from (`popping_email` left join `lead` on((`lead`.`popping_email_id` = `popping_email`.`id`))) where (`popping_email`.`status` <> 'cancel') group by `popping_email`.`id`);

-- --------------------------------------------------------

--
-- Structure for view `v_invoice_approved`
--
DROP TABLE IF EXISTS `v_invoice_approved`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_invoice_approved` AS (select `invoice_head`.`id` AS `id`,`invoice_head`.`user_id` AS `user_id`,count(`invoice_head`.`id`) AS `ai` from `invoice_head` where ((`invoice_head`.`status` <> 'cancel') and (`invoice_head`.`status` = 'approved')) group by `invoice_head`.`user_id`);

-- --------------------------------------------------------

--
-- Structure for view `v_invoice_open`
--
DROP TABLE IF EXISTS `v_invoice_open`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_invoice_open` AS (select `invoice_head`.`id` AS `id`,`invoice_head`.`user_id` AS `user_id`,count(`invoice_head`.`id`) AS `oi` from `invoice_head` where ((`invoice_head`.`status` <> 'cancel') and (`invoice_head`.`status` = 'open')) group by `invoice_head`.`user_id`);

-- --------------------------------------------------------

--
-- Structure for view `v_invoice_paid`
--
DROP TABLE IF EXISTS `v_invoice_paid`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_invoice_paid` AS (select `invoice_head`.`id` AS `id`,`invoice_head`.`user_id` AS `user_id`,count(`invoice_head`.`id`) AS `PI` from `invoice_head` where ((`invoice_head`.`status` <> 'cancel') and (`invoice_head`.`status` = 'paid')) group by `invoice_head`.`user_id`);

-- --------------------------------------------------------

--
-- Structure for view `v_invoice_sum_cost_count`
--
DROP TABLE IF EXISTS `v_invoice_sum_cost_count`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_invoice_sum_cost_count` AS (select `invoice_head`.`id` AS `id`,`invoice_head`.`user_id` AS `user_id`,sum(`invoice_head`.`total_cost`) AS `tc`,count(`invoice_head`.`id`) AS `noi` from `invoice_head` where (`invoice_head`.`status` <> 'cancel') group by `invoice_head`.`user_id`);

-- --------------------------------------------------------

--
-- Structure for view `v_invoice_sum_cost_count_7days`
--
DROP TABLE IF EXISTS `v_invoice_sum_cost_count_7days`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_invoice_sum_cost_count_7days` AS (select `invoice_head`.`id` AS `id`,`invoice_head`.`user_id` AS `user_id`,sum(`invoice_head`.`total_cost`) AS `tc`,count(`invoice_head`.`id`) AS `noi` from `invoice_head` where ((`invoice_head`.`status` <> 'cancel') and (`invoice_head`.`created_at` > (now() - interval 7 day))) group by `invoice_head`.`user_id`);

-- --------------------------------------------------------

--
-- Structure for view `v_invoice_sum_cost_count_24hours`
--
DROP TABLE IF EXISTS `v_invoice_sum_cost_count_24hours`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_invoice_sum_cost_count_24hours` AS (select `invoice_head`.`id` AS `id`,`invoice_head`.`user_id` AS `user_id`,sum(`invoice_head`.`total_cost`) AS `tc`,count(`invoice_head`.`id`) AS `noi` from `invoice_head` where ((`invoice_head`.`status` <> 'cancel') and (`invoice_head`.`created_at` > (now() - interval 24 hour))) group by `invoice_head`.`user_id`);

-- --------------------------------------------------------

--
-- Structure for view `v_lead_count_7days`
--
DROP TABLE IF EXISTS `v_lead_count_7days`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_lead_count_7days` AS (select `lead`.`id` AS `id`,`lead`.`popping_email_id` AS `popping_email_id`,count(`lead`.`id`) AS `nol`,sum(`popping_email`.`price`) AS `lc` from ((`lead` join `popping_email` on((`popping_email`.`id` = `lead`.`popping_email_id`))) join `user` on((`user`.`id` = `popping_email`.`user_id`))) where ((`lead`.`status` <> 'close') and (`lead`.`status` <> 'filtered') and (`lead`.`created_at` > (now() - interval 7 day))) group by `user`.`id`);

-- --------------------------------------------------------

--
-- Structure for view `v_lead_count_24hours`
--
DROP TABLE IF EXISTS `v_lead_count_24hours`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_lead_count_24hours` AS (select `lead`.`id` AS `id`,`lead`.`popping_email_id` AS `popping_email_id`,count(`lead`.`id`) AS `nol`,sum(`popping_email`.`price`) AS `lc` from ((`lead` join `popping_email` on((`popping_email`.`id` = `lead`.`popping_email_id`))) join `user` on((`user`.`id` = `popping_email`.`user_id`))) where ((`lead`.`status` <> 'close') and (`lead`.`status` <> 'filtered') and (`lead`.`created_at` > (now() - interval 24 hour))) group by `user`.`id`);

-- --------------------------------------------------------

--
-- Structure for view `v_popping_email_count`
--
DROP TABLE IF EXISTS `v_popping_email_count`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_popping_email_count` AS (select `popping_email`.`id` AS `id`,`popping_email`.`user_id` AS `user_id`,count(`popping_email`.`id`) AS `nope` from `popping_email` where (`popping_email`.`status` <> 'cancel') group by `popping_email`.`user_id`);

-- --------------------------------------------------------

--
-- Structure for view `v_result_7_days`
--
DROP TABLE IF EXISTS `v_result_7_days`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_result_7_days` AS (select `user`.`id` AS `user_id`,`user`.`username` AS `username`,ifnull(`p`.`nope`,0) AS `no_of_popping_email`,ifnull(`l`.`nol`,0) AS `no_of_lead`,ifnull(`i`.`noi`,0) AS `no_of_invoice`,ifnull(`i`.`tc`,0) AS `invoice_cost`,ifnull(`l`.`lc`,0) AS `lead_cost` from (((`user` join `v_popping_email_count` `p` on((`p`.`user_id` = `user`.`id`))) left join `v_lead_count_7days` `l` on((`l`.`popping_email_id` = `p`.`id`))) left join `v_invoice_sum_cost_count_7days` `i` on((`i`.`user_id` = `p`.`user_id`))) group by `user`.`id`);

-- --------------------------------------------------------

--
-- Structure for view `v_result_7_days_amount`
--
DROP TABLE IF EXISTS `v_result_7_days_amount`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_result_7_days_amount` AS (select sum(`popping_email`.`price`) AS `total_cost` from (`lead` left join `popping_email` on((`lead`.`popping_email_id` = `popping_email`.`id`))) where (`lead`.`created_at` > (now() - interval 7 day)));

-- --------------------------------------------------------

--
-- Structure for view `v_result_7_days_lead`
--
DROP TABLE IF EXISTS `v_result_7_days_lead`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_result_7_days_lead` AS (select count(distinct `lead`.`id`) AS `total_lead` from `lead` where (`lead`.`created_at` > (now() - interval 7 day)));

-- --------------------------------------------------------

--
-- Structure for view `v_result_24`
--
DROP TABLE IF EXISTS `v_result_24`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_result_24` AS (select `user`.`id` AS `user_id`,`user`.`username` AS `username`,ifnull(`p`.`nope`,0) AS `no_of_popping_email`,ifnull(`l`.`nol`,0) AS `no_of_lead`,ifnull(`i`.`noi`,0) AS `no_of_invoice`,ifnull(`i`.`tc`,0) AS `invoice_cost`,ifnull(`l`.`lc`,0) AS `lead_cost` from (((`user` join `v_popping_email_count` `p` on((`p`.`user_id` = `user`.`id`))) left join `v_lead_count_24hours` `l` on((`l`.`popping_email_id` = `p`.`id`))) left join `v_invoice_sum_cost_count_24hours` `i` on((`i`.`user_id` = `p`.`user_id`))) group by `user`.`id`);

-- --------------------------------------------------------

--
-- Structure for view `v_result_24_amount`
--
DROP TABLE IF EXISTS `v_result_24_amount`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_result_24_amount` AS (select sum(`popping_email`.`price`) AS `total_cost` from (`lead` left join `popping_email` on((`lead`.`popping_email_id` = `popping_email`.`id`))) where (`lead`.`created_at` > (now() - interval 2 hour)));

-- --------------------------------------------------------

--
-- Structure for view `v_result_24_lead`
--
DROP TABLE IF EXISTS `v_result_24_lead`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_result_24_lead` AS (select count(distinct `lead`.`id`) AS `total_lead` from `lead` where (`lead`.`created_at` > (now() - interval 24 hour)));

-- --------------------------------------------------------

--
-- Structure for view `v_user_invoice_status`
--
DROP TABLE IF EXISTS `v_user_invoice_status`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_user_invoice_status` AS (select `user`.`id` AS `user_id`,`user`.`username` AS `username`,ifnull(`ih1`.`oi`,0) AS `open_invoice`,ifnull(`ih2`.`ai`,0) AS `approved_invoice`,ifnull(`ih3`.`PI`,0) AS `paid_invoice`,ifnull(`i`.`tc`,0) AS `total_cost` from (((((`user` join `v_popping_email_count` `p` on((`p`.`user_id` = `user`.`id`))) left join `v_invoice_open` `ih1` on((`user`.`id` = `ih1`.`user_id`))) left join `v_invoice_approved` `ih2` on((`user`.`id` = `ih2`.`user_id`))) left join `v_invoice_paid` `ih3` on((`user`.`id` = `ih3`.`user_id`))) left join `v_invoice_sum_cost_count` `i` on((`i`.`user_id` = `p`.`user_id`))) group by `user`.`id`);

-- --------------------------------------------------------

--
-- Structure for view `v_user_leads`
--
DROP TABLE IF EXISTS `v_user_leads`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_user_leads` AS (select `user`.`id` AS `user_id`,`user`.`username` AS `username`,count(distinct `lead`.`id`) AS `total_lead`,count(distinct `popping_email`.`id`) AS `no_of_popping_email` from ((`user` join `popping_email` on(((`popping_email`.`user_id` = `user`.`id`) and (`popping_email`.`status` <> 'cancel')))) left join `lead` on((`lead`.`popping_email_id` = `popping_email`.`id`))) group by `user`.`id`);

-- --------------------------------------------------------

--
-- Structure for view `v_user_lead_status_duplicate`
--
DROP TABLE IF EXISTS `v_user_lead_status_duplicate`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_user_lead_status_duplicate` AS (select `user`.`id` AS `user_id`,`user`.`username` AS `username`,`popping_email`.`email` AS `email`,count(distinct `lead`.`id`) AS `duplicate_leads` from ((`popping_email` join `user` on(((`popping_email`.`user_id` = `user`.`id`) and (`popping_email`.`status` <> 'cancel')))) left join `lead` on(((`lead`.`popping_email_id` = `popping_email`.`id`) and (`lead`.`count` > 1)))) group by `popping_email`.`id`);

-- --------------------------------------------------------

--
-- Structure for view `v_user_lead_status_filtered`
--
DROP TABLE IF EXISTS `v_user_lead_status_filtered`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_user_lead_status_filtered` AS (select `user`.`id` AS `user_id`,`user`.`username` AS `username`,`popping_email`.`email` AS `email`,count(distinct `lead`.`id`) AS `filtered_leads` from ((`popping_email` join `user` on(((`popping_email`.`user_id` = `user`.`id`) and (`popping_email`.`status` <> 'cancel')))) left join `lead` on(((`lead`.`popping_email_id` = `popping_email`.`id`) and (`lead`.`status` = 'filtered')))) group by `popping_email`.`id`);


