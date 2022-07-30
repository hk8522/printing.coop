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
  UPDATE `product_order_items` SET `attribute_ids` = REPLACE(`attribute_ids`, 'provider_attribute_ids', 'provider_option_value_ids');
