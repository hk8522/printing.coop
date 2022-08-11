# printing.coop

# Provider

- modules
- sub_modules
  id	module_id	sub_module_name	order	url	class	action	show_menu	status	sub_module_class
  60	1	Sina	2	Products/Provider/sina	Products	provider	1	1	fas fa-circle
- admin_sub_modules
  15 1 60

- Database update for BOPP ROLL Label
  Run app/database/provider.sql
- Database update for Shipping Extra Days
  ALTER TABLE `provider_orders` ADD COLUMN `shipping_extra_days` INT UNSIGNED NULL AFTER `tax`;
- Database update for customized price rate
  ALTER TABLE `provider_products` ADD COLUMN `price_rate` DOUBLE DEFAULT 1.75 NULL AFTER `information_type`;
- Database Index
  ALTER TABLE `size_multiple_attributes` ADD INDEX `attribute` (`product_id`, `qty`, `size_id`, `attribute_id`, `attribute_item_id`), ADD INDEX `attribute_item` (`product_id`, `qty`, `size_id`, `attribute_item_id`);
  ALTER TABLE `product_attribute_item_datas` ADD INDEX `attribute` (`product_id`, `attribute_id`, `attribute_item_id`), ADD INDEX `attribute_item` (`product_id`, `attribute_item_id`);
  ALTER TABLE `product_quantity` DROP INDEX `product_id`, ADD KEY `qty` (`product_id`, `qty`);
  ALTER TABLE `product_size_new` DROP INDEX `product_id`, ADD KEY `size` (`product_id`, `qty`, `size_id`);

- Update Database Structure
  INSERT INTO attributes (`name`, `label`, `label_fr`) SELECT `name`, `name` AS `label`, `name_french` AS `label_fr` FROM 
  (SELECT TRIM(`name`) AS `name`, TRIM(`name_french`) AS `name_french` FROM `product_attributes`
   UNION ALL
   SELECT TRIM(`name`) AS `name`, TRIM(`name_french`) AS `name` FROM `product_multiple_attributes`) AS `t`
  GROUP BY `name`
  ORDER BY `name`;

  INSERT INTO `attribute_items` (`attribute_id`, `name`, `name_fr`)
  SELECT * FROM (
    SELECT `attributes`.`id` AS `attribute_id`, TRIM(`item_name`) AS `name`, TRIM(`item_name_french`) AS `name_french` FROM `product_attribute_items` INNER JOIN `product_attributes` ON `product_attributes`.`id`=`product_attribute_items`.`product_attribute_id` INNER JOIN `attributes` ON `attributes`.`name`=`product_attributes`.`name` GROUP BY `product_attribute_items`.`product_attribute_id`, `product_attribute_items`.`item_name`
    UNION ALL
    SELECT `attributes`.`id` AS `attribute_id`, TRIM(`item_name`) AS `name`, TRIM(`item_name_french`) AS `name_french` FROM `product_multiple_attribute_items` INNER JOIN `product_multiple_attributes` ON `product_multiple_attributes`.`id`=`product_multiple_attribute_items`.`product_attribute_id` INNER JOIN `attributes` ON `attributes`.`name`=`product_multiple_attributes`.`name` GROUP BY `product_multiple_attribute_items`.`product_attribute_id`, `product_multiple_attribute_items`.`item_name`
  ) `t`
  GROUP BY `attribute_id`, `name`;

  INSERT INTO `product_attribute_map` (`product_id`, `attribute_id`, `show_order`)
  SELECT `product_attribute_datas`.`product_id`, `attributes`.`id` AS `attribute_id`, `product_attribute_datas`.`show_order`
  FROM `product_attribute_datas` INNER JOIN `product_attributes` ON `product_attribute_datas`.`attribute_id`=`product_attributes`.`id`
    INNER JOIN `attributes` ON `attributes`.`name`=TRIM(`product_attributes`.`name`)
  GROUP BY `product_attribute_datas`.`product_id`, `attributes`.`id`;

  INSERT INTO `product_attribute_item_map` (`product_id`, `attribute_id`, `attribute_item_id`, `show_order`, `additional_fee`)
  SELECT `product_attribute_item_datas`.`product_id`, `attributes`.`id` AS `attribute_id`, `attribute_items`.`id` AS `attribute_item_id`, `product_attribute_item_datas`.`show_order`, `product_attribute_item_datas`.`extra_price` AS `additional_fee`
  FROM `product_attribute_item_datas`
    INNER JOIN `product_attributes` ON `product_attribute_item_datas`.`attribute_id`=`product_attributes`.`id`
    INNER JOIN `attributes` ON `attributes`.`name`=TRIM(`product_attributes`.`name`)
    INNER JOIN `product_attribute_items` ON `product_attribute_items`.`id`=`product_attribute_item_datas`.`attribute_item_id`
    INNER JOIN `attribute_items` ON `attribute_items`.`attribute_id`=`attributes`.`id` AND `attribute_items`.`name`=TRIM(`product_attribute_items`.`item_name`)
  GROUP BY `product_attribute_item_datas`.`product_id`, `attributes`.`id`, `attribute_items`.`id`;

- Products/Attributes
  ALTER TABLE `modules` CHANGE `class` `class` VARCHAR(250) CHARSET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT 'fa fab fa-product-hunt' NULL; 
  INSERT INTO `sub_modules` (`module_id`, `sub_module_name`, `order`, `url`, `class`, `action`) VALUES ('1', 'Attributes', '7', 'Products/AttributesMap', 'Products', 'AttributesMap');
  UPDATE `modules` SET `class`=CONCAT('fa ', `class`);
  UPDATE `modules` SET `class` = 'fa fas fa-users' WHERE `id` = '2';
  UPDATE `modules` SET `class` = 'fa fa-refresh' WHERE `id` = '3'; 
  UPDATE `sub_modules` SET `sub_module_class`=CONCAT('fa ', `sub_module_class`);
