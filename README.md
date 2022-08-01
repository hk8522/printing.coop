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
