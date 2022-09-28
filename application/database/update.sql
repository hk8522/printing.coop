/*
- modules
- sub_modules
  id	module_id	sub_module_name	order	url	class	action	show_menu	status	sub_module_class
  60	1	Sina	2	Products/Provider/sina	Products	provider	1	1	fas fa-circle
- admin_sub_modules
  15 1 60
*/

/* Database update for Shipping Extra Days */
  ALTER TABLE `provider_orders` ADD COLUMN `shipping_extra_days` INT UNSIGNED NULL AFTER `tax`;
/* Database update for customized price rate */
  ALTER TABLE `provider_products` ADD COLUMN `price_rate` DOUBLE DEFAULT 1.75 NULL AFTER `information_type`;
/* Database Index */
  ALTER TABLE `size_multiple_attributes` ADD INDEX `attribute` (`product_id`, `qty`, `size_id`, `attribute_id`, `attribute_item_id`), ADD INDEX `attribute_item` (`product_id`, `qty`, `size_id`, `attribute_item_id`);
  ALTER TABLE `product_attribute_item_datas` ADD INDEX `attribute` (`product_id`, `attribute_id`, `attribute_item_id`), ADD INDEX `attribute_item` (`product_id`, `attribute_item_id`);
  ALTER TABLE `product_quantity` DROP INDEX `product_id`, ADD KEY `qty` (`product_id`, `qty`);
  ALTER TABLE `product_size_new` DROP INDEX `product_id`, ADD KEY `size` (`product_id`, `qty`, `size_id`);

/* Update modules, sub_modules class */
  ALTER TABLE `modules` CHANGE `class` `class` VARCHAR(250) CHARSET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT 'fa fab fa-product-hunt' NULL;
  UPDATE `modules` SET `class`=CONCAT('fa ', `class`);
  UPDATE `modules` SET `class` = 'fa fas fa-users' WHERE `id` = '2';
  UPDATE `modules` SET `class` = 'fa fa-refresh' WHERE `id` = '3';
  ALTER TABLE `sub_modules` CHANGE `sub_module_class` `sub_module_class` VARCHAR(250) CHARSET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT 'fa fas fa-circle' NULL;
  UPDATE `sub_modules` SET `sub_module_class`=CONCAT('fa ', `sub_module_class`);

/* Products/Attributes */
  INSERT INTO `sub_modules` (`module_id`, `sub_module_name`, `order`, `url`, `class`, `action`) VALUES ('1', 'Attributes', '7', 'Products/AttributesMap', 'Products', 'AttributesMap');


/* Update Database Structure */
  TRUNCATE TABLE `attributes`;
  TRUNCATE TABLE `attribute_items`;
  TRUNCATE TABLE `product_attribute_map`;
  TRUNCATE TABLE `product_attribute_item_map`;

  INSERT INTO `attributes`(`id`,`name`,`label`,`label_fr`,`type`) VALUES
  (1,'qty','Quantity','Quantité',0),
  (2,'quantity','Quantity','Quantité',0),
  (3,'shape','Shape','Forme',1),
  (4,'size','Size','Taille',2),
  (5,'width','Width','Largeur',3),
  (6,'length','Length','Longueur',4),
  (7,'depth','Depth','Profondeur',5),
  (8,'diameter','Diameter','Diamètre',6),
  (9,'pages','Pages','Pages',7),
  (10,'sheets','Sheets','Des draps',8),
  (11,'color','Color','Couleur',9),
  (12,'stock','Stock','Stocker',10),
  (13,'rectoverso','RectoVerso','RectoVerso',11),
  (14,'finishing','Finishing','Finition',9000),
  (15,'yourtext','Your Text','Votre Texte',9099),
  (16,'turnaround','Turnaround','Tourner autour',9100);
  INSERT INTO `attribute_items` (`id`, `attribute_id`, `name`, `name_fr`) VALUES
  ('1', '11', 'black', 'noir'),
  ('2', '11', 'color', 'couleur'),
  ('3', '13', 'yes', 'oui'),
  ('4', '13', 'no', 'non');

  INSERT INTO `attributes` (`name`, `label`, `label_fr`) SELECT `t`.* FROM
    (SELECT TRIM(`name`) AS `name`, TRIM(`name`) AS `label`, TRIM(`name_french`) AS `label_fr` FROM `product_attributes`
    UNION ALL
    SELECT TRIM(`name`) AS `name`, TRIM(`name`) AS `label`, TRIM(`name_french`) AS `label_fr` FROM `product_multiple_attributes`
    UNION ALL
    SELECT `name`, `label`, `label_fr` FROM `attributes`) AS `t`
      LEFT JOIN `attributes` ON `attributes`.`name`=`t`.`name`
    WHERE `attributes`.`id` IS NULL
    GROUP BY `t`.`name`
    ORDER BY `t`.`name`;

  UPDATE `attributes` SET `type`=0 WHERE `name`='Qty';
  UPDATE `attributes` SET `type`=0 WHERE `name`='Quantity';
  UPDATE `attributes` SET `type`=1 WHERE `name`='Shape';
  UPDATE `attributes` SET `type`=2 WHERE `name`='Size';
  UPDATE `attributes` SET `type`=3 WHERE `name`='Width';
  UPDATE `attributes` SET `type`=4 WHERE `name`='Length';
  UPDATE `attributes` SET `type`=5 WHERE `name`='Diameter';
  UPDATE `attributes` SET `type`=6 WHERE `name`='Depth';
  UPDATE `attributes` SET `type`=7 WHERE `name`='Pages';
  UPDATE `attributes` SET `type`=8 WHERE `name`='Sheets';
  UPDATE `attributes` SET `type`=9 WHERE `name`='Color';
  UPDATE `attributes` SET `type`=10 WHERE `name`='Stock';
  UPDATE `attributes` SET `type`=11 WHERE `name`='RectoVerso';
  UPDATE `attributes` SET `type`=9000 WHERE `name`='Finishing';
  UPDATE `attributes` SET `type`=9100 WHERE `name`='Turnaround';

  INSERT INTO `attribute_items` (`attribute_id`, `name`, `name_fr`)
    SELECT * FROM (
      SELECT `attributes`.`id` AS `attribute_id`, TRIM(`item_name`) AS `name`, TRIM(`item_name_french`) AS `name_french`
        FROM `product_attribute_items` INNER JOIN `product_attributes` ON `product_attributes`.`id`=`product_attribute_items`.`product_attribute_id` INNER JOIN `attributes` ON `attributes`.`name`=`product_attributes`.`name` GROUP BY `product_attribute_items`.`product_attribute_id`, `product_attribute_items`.`item_name`
      UNION ALL
      SELECT `attributes`.`id` AS `attribute_id`, TRIM(`item_name`) AS `name`, TRIM(`item_name_french`) AS `name_french`
        FROM `product_multiple_attribute_items` INNER JOIN `product_multiple_attributes` ON `product_multiple_attributes`.`id`=`product_multiple_attribute_items`.`product_attribute_id` INNER JOIN `attributes` ON `attributes`.`name`=`product_multiple_attributes`.`name` GROUP BY `product_multiple_attribute_items`.`product_attribute_id`, `product_multiple_attribute_items`.`item_name`
      UNION ALL
      SELECT (SELECT `id` FROM `attributes` WHERE `name`='quantity') AS `attribute_id`, TRIM(`name`) AS `name`, TRIM(`name_french`) AS `name_fr`
        FROM `quantity` WHERE `name`>0 GROUP BY `name`
      UNION ALL
      SELECT (SELECT `id` FROM `attributes` WHERE `name`='size') AS `attribute_id`, TRIM(`size_name`) AS `name`, TRIM(`size_name_french`) AS `name_fr`
        FROM `sizes` GROUP BY `size_name`
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

  /* RectoVerso */
  INSERT INTO `product_attribute_map` (`product_id`, `attribute_id`)
    SELECT `id` AS `product_id`, (SELECT `id` FROM `attributes` WHERE `name`='rectoverso') AS `attribute_id`
      FROM `products` WHERE `recto_verso`!=0;
  INSERT INTO `product_attribute_item_map` (`product_id`, `attribute_id`, `attribute_item_id`, `additional_fee`)
    SELECT `id` AS `product_id`,
      (SELECT `id` FROM `attributes` WHERE `name`='rectoverso') AS `attribute_id`,
      (SELECT `id` FROM `attribute_items` WHERE `attribute_id`=(SELECT `attributes`.`id` FROM `attributes` WHERE `attributes`.`name`='rectoverso') AND `name`='no') AS `attribute_item_id`,
      0 AS `additional_fee`
      FROM `products` WHERE `recto_verso`!=0;
  INSERT INTO `product_attribute_item_map` (`product_id`, `attribute_id`, `attribute_item_id`, `additional_fee`)
    SELECT `id` AS `product_id`,
      (SELECT `id` FROM `attributes` WHERE `name`='rectoverso') AS `attribute_id`,
      (SELECT `id` FROM `attribute_items` WHERE `attribute_id`=(SELECT `attributes`.`id` FROM `attributes` WHERE `attributes`.`name`='rectoverso') AND `name`='yes') AS `attribute_item_id`,
      `recto_verso_price` AS `additional_fee`
      FROM `products` WHERE `recto_verso`!=0;

  /**
   * products
   */
  /* add_length_width */
  /* Width */
  INSERT INTO `product_attribute_map` (`product_id`, `attribute_id`, `use_items`, `value_min`, `value_max`, `additional_fee`)
    SELECT `id` AS `product_id`, (SELECT `id` FROM `attributes` WHERE `name`='width') AS `attribute_id`,
      IF(`length_width_pages_type`='input', 0, 1) AS `use_items`, `min_width` AS `value_min`, `max_width` AS `value_max`, `min_length_min_width_price` AS `additional_fee`
    FROM `products` WHERE `add_length_width`!=0;
  /* Length */
  INSERT INTO `product_attribute_map` (`product_id`, `attribute_id`, `use_items`, `value_min`, `value_max`, `additional_fee`)
    SELECT `id` AS `product_id`, (SELECT `id` FROM `attributes` WHERE `name`='length') AS `attribute_id`,
      IF(`length_width_pages_type`='input', 0, 1) AS `use_items`, `min_length` AS `value_min`, `max_length` AS `value_max`, 1 AS `additional_fee`
    FROM `products` WHERE `add_length_width`!=0;
  /* Color */
  INSERT INTO `product_attribute_map` (`product_id`, `attribute_id`)
    SELECT `id` AS `product_id`, (SELECT `id` FROM `attributes` WHERE `name`='color') AS `attribute_id`
    FROM `products` WHERE `add_length_width`!=0 AND `length_width_color_show`!=0;
  INSERT INTO `product_attribute_item_map` (`product_id`, `attribute_id`, `attribute_item_id`, `additional_fee`)
    SELECT `id` AS `product_id`,
      (SELECT `id` FROM `attributes` WHERE `name`='color') AS `attribute_id`,
      (SELECT `id` FROM `attribute_items` WHERE `attribute_id`=(SELECT `attributes`.`id` FROM `attributes` WHERE `attributes`.`name`='color') AND `name`='black') AS `attribute_item_id`,
      `length_width_unit_price_black` AS `additional_fee`
    FROM `products` WHERE `add_length_width`!=0 AND `length_width_color_show`!=0;
  INSERT INTO `product_attribute_item_map` (`product_id`, `attribute_id`, `attribute_item_id`, `additional_fee`)
    SELECT `id` AS `product_id`,
      (SELECT `id` FROM `attributes` WHERE `name`='color') AS `attribute_id`,
      (SELECT `id` FROM `attribute_items` WHERE `attribute_id`=(SELECT `attributes`.`id` FROM `attributes` WHERE `attributes`.`name`='color') AND `name`='color') AS `attribute_item_id`,
      `length_width_price_color` AS `additional_fee`
    FROM `products` WHERE `add_length_width`!=0 AND `length_width_color_show`!=0;
  /* Quantity */
  INSERT INTO `product_attribute_map` (`product_id`, `attribute_id`, `use_items`, `value_min`, `value_max`)
    SELECT `id` AS `product_id`, (SELECT `id` FROM `attributes` WHERE `name`='quantity') AS `attribute_id`,
      IF(`length_width_pages_type`='input', 0, 1) AS `use_items`, `length_width_min_quantity` AS `value_min`, `length_width_max_quantity` AS `value_max`
    FROM `products` WHERE `add_length_width`!=0 AND `length_width_quantity_show`!=0;

  /* page_add_length_width */
  /* Width */
  INSERT INTO `product_attribute_map` (`product_id`, `attribute_id`, `use_items`, `value_min`, `value_max`, `additional_fee`)
    SELECT `id` AS `product_id`, (SELECT `id` FROM `attributes` WHERE `name`='width') AS `attribute_id`,
      0 AS `use_items`, `page_min_width` AS `value_min`, `page_max_width` AS `value_max`, `page_min_length_min_width_price` AS `additional_fee`
    FROM `products` WHERE `page_add_length_width`!=0;
  /* Length */
  INSERT INTO `product_attribute_map` (`product_id`, `attribute_id`, `use_items`, `value_min`, `value_max`, `additional_fee`)
    SELECT `id` AS `product_id`, (SELECT `id` FROM `attributes` WHERE `name`='length') AS `attribute_id`,
      0 AS `use_items`, `page_min_length` AS `value_min`, `page_max_length` AS `value_max`, 1 AS `additional_fee`
    FROM `products` WHERE `page_add_length_width`!=0;
  /* Color */
  INSERT INTO `product_attribute_map` (`product_id`, `attribute_id`)
    SELECT `id` AS `product_id`, (SELECT `id` FROM `attributes` WHERE `name`='color') AS `attribute_id`
    FROM `products` WHERE `page_add_length_width`!=0 AND `page_length_width_color_show`!=0;
  INSERT INTO `product_attribute_item_map` (`product_id`, `attribute_id`, `attribute_item_id`, `additional_fee`)
    SELECT `id` AS `product_id`,
      (SELECT `id` FROM `attributes` WHERE `name`='color') AS `attribute_id`,
      (SELECT `id` FROM `attribute_items` WHERE `attribute_id`=(SELECT `attributes`.`id` FROM `attributes` WHERE `attributes`.`name`='color') AND `name`='black') AS `attribute_item_id`,
      `page_length_width_price_black` AS `additional_fee`
    FROM `products` WHERE `page_add_length_width`!=0 AND `page_length_width_color_show`!=0;
  INSERT INTO `product_attribute_item_map` (`product_id`, `attribute_id`, `attribute_item_id`, `additional_fee`)
    SELECT `id` AS `product_id`,
      (SELECT `id` FROM `attributes` WHERE `name`='color') AS `attribute_id`,
      (SELECT `id` FROM `attribute_items` WHERE `attribute_id`=(SELECT `attributes`.`id` FROM `attributes` WHERE `attributes`.`name`='color') AND `name`='color') AS `attribute_item_id`,
      `page_length_width_price_color` AS `additional_fee`
    FROM `products` WHERE `page_add_length_width`!=0 AND `page_length_width_color_show`!=0;
  /* Pages */
  INSERT INTO `product_attribute_map` (`product_id`, `attribute_id`, `use_items`)
    SELECT `id` AS `product_id`, (SELECT `id` FROM `attributes` WHERE `name`='pages') AS `attribute_id`,
      IF(`page_length_width_pages_type`='input', 0, 1) AS `use_items`
    FROM `products` WHERE `page_add_length_width`!=0 AND `page_length_width_pages_show`!=0;
  /* Sheets */
  INSERT INTO `product_attribute_map` (`product_id`, `attribute_id`, `use_items`)
    SELECT `id` AS `product_id`, (SELECT `id` FROM `attributes` WHERE `name`='sheets') AS `attribute_id`,
      IF(`page_length_width_sheets_type`='input', 0, 1) AS `use_items`
    FROM `products` WHERE `page_add_length_width`!=0 AND `page_length_width_sheets_show`!=0;
  /* Quantity */
  INSERT INTO `product_attribute_map` (`product_id`, `attribute_id`, `use_items`, `value_min`, `value_max`)
    SELECT `id` AS `product_id`, (SELECT `id` FROM `attributes` WHERE `name`='quantity') AS `attribute_id`,
      IF(`page_length_width_quantity_type`='input', 0, 1) AS `use_items`, `page_length_width_min_quantity` AS `value_min`, `page_length_width_max_quantity` AS `value_max`
    FROM `products` WHERE `page_add_length_width`!=0 AND `page_length_width_quantity_show`!=0;

  /* depth_add_length_width */
  /* Width */
  INSERT INTO `product_attribute_map` (`product_id`, `attribute_id`, `use_items`, `value_min`, `value_max`, `additional_fee`)
    SELECT `id` AS `product_id`, (SELECT `id` FROM `attributes` WHERE `name`='width') AS `attribute_id`,
      0 AS `use_items`, `depth_min_width` AS `value_min`, `depth_max_width` AS `value_max`, `depth_width_length_price` AS `additional_fee`
    FROM `products` WHERE `depth_add_length_width`!=0;
  /* Length */
  INSERT INTO `product_attribute_map` (`product_id`, `attribute_id`, `use_items`, `value_min`, `value_max`, `additional_fee`)
    SELECT `id` AS `product_id`, (SELECT `id` FROM `attributes` WHERE `name`='length') AS `attribute_id`,
      0 AS `use_items`, `depth_min_length` AS `value_min`, `depth_max_length` AS `value_max`, 1 AS `additional_fee`
    FROM `products` WHERE `depth_add_length_width`!=0;
  /* Depth */
  INSERT INTO `product_attribute_map` (`product_id`, `attribute_id`, `use_items`, `value_min`, `value_max`, `additional_fee`)
    SELECT `id` AS `product_id`, (SELECT `id` FROM `attributes` WHERE `name`='depth') AS `attribute_id`,
      0 AS `use_items`, `min_depth` AS `value_min`, `max_depth` AS `value_max`, 1 AS `additional_fee`
    FROM `products` WHERE `depth_add_length_width`!=0;
  /* Color */
  INSERT INTO `product_attribute_map` (`product_id`, `attribute_id`)
    SELECT `id` AS `product_id`, (SELECT `id` FROM `attributes` WHERE `name`='color') AS `attribute_id`
    FROM `products` WHERE `depth_add_length_width`!=0 AND `depth_color_show`!=0;
  INSERT INTO `product_attribute_item_map` (`product_id`, `attribute_id`, `attribute_item_id`, `additional_fee`)
    SELECT `id` AS `product_id`,
      (SELECT `id` FROM `attributes` WHERE `name`='color') AS `attribute_id`,
      (SELECT `id` FROM `attribute_items` WHERE `attribute_id`=(SELECT `attributes`.`id` FROM `attributes` WHERE `attributes`.`name`='color') AND `name`='black') AS `attribute_item_id`,
      `depth_unit_price_black` AS `additional_fee`
    FROM `products` WHERE `depth_add_length_width`!=0 AND `depth_color_show`!=0;
  INSERT INTO `product_attribute_item_map` (`product_id`, `attribute_id`, `attribute_item_id`, `additional_fee`)
    SELECT `id` AS `product_id`,
      (SELECT `id` FROM `attributes` WHERE `name`='color') AS `attribute_id`,
      (SELECT `id` FROM `attribute_items` WHERE `attribute_id`=(SELECT `attributes`.`id` FROM `attributes` WHERE `attributes`.`name`='color') AND `name`='color') AS `attribute_item_id`,
      `depth_price_color` AS `additional_fee`
    FROM `products` WHERE `depth_add_length_width`!=0 AND `depth_color_show`!=0;
  /* Quantity */
  INSERT INTO `product_attribute_map` (`product_id`, `attribute_id`, `use_items`, `value_min`, `value_max`)
    SELECT `id` AS `product_id`, (SELECT `id` FROM `attributes` WHERE `name`='quantity') AS `attribute_id`,
      IF(`depth_width_length_type`='input', 0, 1) AS `use_items`, `depth_min_quantity` AS `value_min`, `depth_max_quantity` AS `value_max`
    FROM `products` WHERE `depth_add_length_width`!=0 AND `depth_width_length_quantity_show`!=0;

  /* YourText */
  INSERT INTO `product_attribute_map` (`product_id`, `attribute_id`, `use_items`)
    SELECT `id` AS `product_id`, (SELECT `id` FROM `attributes` WHERE `name`='yourtext') AS `attribute_id`, 0 AS `use_items`
    FROM `products` WHERE `votre_text`!=0;

  /**
   * product_quantity
   */
  INSERT INTO `product_attribute_map` (`product_id`, `attribute_id`, `use_items`, `additional_fee`)
    SELECT `product_id`, (SELECT `id` FROM `attributes` WHERE `name`='quantity') AS `attribute_id`, 1 AS `use_items`, `price` AS `additional_fee`
    FROM `product_quantity` GROUP BY `product_id`;
  INSERT INTO `product_attribute_item_map` (`product_id`, `attribute_id`, `attribute_item_id`)
    SELECT `product_id`,
      (SELECT `id` FROM `attributes` WHERE `name`='quantity') AS `attribute_id`,
      (SELECT `id` FROM `attribute_items` WHERE `attribute_id`=(SELECT `attributes`.`id` FROM `attributes` WHERE `attributes`.`name`='quantity') AND `name`=`quantity`.`name`) AS `attribute_item_id`
    FROM `product_quantity` INNER JOIN `quantity` ON `quantity`.`id`=`product_quantity`.`qty`;

  /**
   * product_size_new
   */
  INSERT INTO `product_attribute_map` (`product_id`, `attribute_id`, `use_items`)
    SELECT `product_size_new`.`product_id`, (SELECT `id` FROM `attributes` WHERE `name`='size') AS `attribute_id`, 1 AS `use_items`
    FROM `product_size_new` GROUP BY `product_id`;
  INSERT INTO `product_attribute_item_map` (`product_id`, `attribute_id`, `attribute_item_id`, `additional_fee`)
    SELECT `product_size_new`.`product_id`,
      (SELECT `id` FROM `attributes` WHERE `name`='size') AS `attribute_id`,
      (SELECT `id` FROM `attribute_items` WHERE `attribute_id`=(SELECT `attributes`.`id` FROM `attributes` WHERE `attributes`.`name`='size') AND `name`=`sizes`.`size_name`) AS `attribute_item_id`,
      `extra_price` AS `additional_fee`
    FROM `product_size_new` INNER JOIN `sizes` ON `sizes`.`id`=`product_size_new`.`size_id`
    GROUP BY `product_id`, `size_id`;

  /**
   * size_multiple_attributes
   */
  INSERT INTO `product_attribute_map` (`product_id`, `attribute_id`, `use_items`)
    SELECT `size_multiple_attributes`.`product_id`, `attributes`.`id` AS `attribute_id`, 1 AS `use_items`
    FROM `size_multiple_attributes`
      INNER JOIN `product_multiple_attributes` ON `product_multiple_attributes`.`id`=`size_multiple_attributes`.`attribute_id`
      INNER JOIN `attributes` ON `attributes`.`name`=TRIM(`product_multiple_attributes`.`name`)
      GROUP BY `size_multiple_attributes`.`product_id`, `size_multiple_attributes`.`attribute_id`;
  INSERT INTO `product_attribute_item_map` (`product_id`, `attribute_id`, `attribute_item_id`, `additional_fee`)
    SELECT `size_multiple_attributes`.`product_id`, `attributes`.`id` AS `attribute_id`, `attribute_items`.`id` AS `attribute_item_id`, `size_multiple_attributes`.`extra_price` AS `additional_fee`
    FROM `size_multiple_attributes`
      INNER JOIN `product_multiple_attributes` ON `product_multiple_attributes`.`id`=`size_multiple_attributes`.`attribute_id`
      INNER JOIN `product_multiple_attribute_items` ON `product_multiple_attribute_items`.`id`=`size_multiple_attributes`.`attribute_item_id`
      INNER JOIN `attributes` ON `attributes`.`name`=TRIM(`product_multiple_attributes`.`name`)
      INNER JOIN `attribute_items` ON `attribute_items`.`attribute_id`=`attributes`.`id` AND `attribute_items`.`name`=TRIM(`product_multiple_attribute_items`.`item_name`)
      GROUP BY `size_multiple_attributes`.`product_id`, `size_multiple_attributes`.`attribute_id`, `size_multiple_attributes`.`attribute_item_id`;

  /* Update order */
  UPDATE `product_attribute_item_map`, `attribute_items`
    SET `product_attribute_item_map`.`show_order` = `attribute_items`.`name`
    WHERE `product_attribute_item_map`.`attribute_item_id` = `attribute_items`.`id`;

/* Database update for attribute_percentage */
  ALTER TABLE `db_printing_imprimeur`.`product_attribute_map` ADD COLUMN `use_percentage` TINYINT(4) UNSIGNED DEFAULT 0 NULL AFTER `use_items`;
  UPDATE `product_attribute_map`, `attributes` SET `product_attribute_map`.`use_percentage` = 1
    WHERE `product_attribute_map`.`attribute_id` = `attributes`.`id` AND (`attributes`.`name` = 'RectoVerso' OR `attributes`.`name` LIKE 'Binding%');

/* additional_fee precesion */
  ALTER TABLE `product_attribute_map` CHANGE `additional_fee` `additional_fee` DOUBLE NULL;
  ALTER TABLE `product_attribute_item_map` CHANGE `additional_fee` `additional_fee` DOUBLE NULL;

/* Provider database error */
  ALTER TABLE `provider_product_options` ADD COLUMN `value` VARCHAR(255) NOT NULL AFTER `provider_option_value_id`;
  ALTER TABLE `provider_option_values` DROP INDEX `option_value`, ADD KEY `option_value` (`option_id`, `provider_option_value_id`, `value`);

/* Product custom size */
  ALTER TABLE `products` ADD COLUMN `use_custom_size` INT UNSIGNED NOT NULL AFTER `shipping_box_weight`;
/* France to French */
  ALTER TABLE `categories` CHANGE `page_title_france` `page_title_french` VARCHAR(250) CHARSET utf8mb4 COLLATE utf8mb4_general_ci NULL, CHANGE `meta_description_content_france` `meta_description_content_french` VARCHAR(250) CHARSET utf8mb4 COLLATE utf8mb4_general_ci NULL, CHANGE `meta_keywords_content_france` `meta_keywords_content_french` VARCHAR(250) CHARSET utf8mb4 COLLATE utf8mb4_general_ci NULL;
  ALTER TABLE `pages` CHANGE `title_france` `title_french` VARCHAR(100) CHARSET utf8mb4 COLLATE utf8mb4_general_ci NULL, CHANGE `description_france` `description_french` LONGTEXT CHARSET utf8mb4 COLLATE utf8mb4_general_ci NULL, CHANGE `page_title_france` `page_title_french` VARCHAR(150) CHARSET utf8mb4 COLLATE utf8mb4_general_ci NULL, CHANGE `meta_description_content_france` `meta_description_content_french` VARCHAR(250) CHARSET utf8mb4 COLLATE utf8mb4_general_ci NULL, CHANGE `meta_keywords_content_france` `meta_keywords_content_french` VARCHAR(250) CHARSET utf8mb4 COLLATE utf8mb4_general_ci NULL;
  ALTER TABLE `sections` CHANGE `name_france` `name_french` VARCHAR(255) CHARSET utf8mb4 COLLATE utf8mb4_general_ci NULL, CHANGE `description_france` `description_french` VARCHAR(255) CHARSET utf8mb4 COLLATE utf8mb4_general_ci NULL, CHANGE `content_france` `content_french` LONGTEXT CHARSET utf8mb4 COLLATE utf8mb4_general_ci NULL;
