ALTER TABLE `users` CHANGE `role` `role` VARCHAR(10) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT 'customer';
ALTER TABLE `categories` CHANGE `menu_id` `menu_id` INT(11) NULL DEFAULT NULL;
ALTER TABLE `sub_categories` CHANGE `menu_id` `menu_id` INT(11) NULL DEFAULT NULL;
