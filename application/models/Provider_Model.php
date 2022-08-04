<?php

require_once(APPPATH . 'common/ProviderOptionType.php');
require_once(APPPATH . 'common/ProviderProductInformationType.php');

use App\Common\ProviderOptionType;
use App\Common\ProviderProductInformationType;

Class Provider_Model extends MY_Model {

    public $table = 'providers';

    public function getProviders()
    {
        $this->db->from('providers');
        $this->db->order_by('name');
        return $this->db->get()->result();
    }

    public function getProvider($name)
    {
        $this->db->from('providers');
        $this->db->where('name', $name);
        return $this->db->get()->row();
    }

    public function updateProvider($provider_id, $products)
    {
        // Flag deleted
        $this->db->set('deleted', 1);
        $this->db->update('provider_products');

        $this->db->from('provider_products');
        $this->db->where('provider_id', $provider_id);
        $data = $this->db->get()->result();
        $originals = [];
        foreach ($data as $item) {
            $originals[$item->provider_product_id] = $item;
        }

        $news = [];
        foreach ($products as $product) {
            if (array_key_exists($product->id, $originals)) {
                $originals[$product->id]->provider_id = $provider_id;
                $originals[$product->id]->provider_product_id = $product->id;
                $originals[$product->id]->sku = $product->sku;
                $originals[$product->id]->name = $product->name;
                $originals[$product->id]->category = $product->category;
                $originals[$product->id]->enabled = $product->enabled;
                $originals[$product->id]->deleted = 0;
            } else {
                $news[] = (object) [
                    'provider_id' => $provider_id,
                    'provider_product_id' => $product->id,
                    'sku' => $product->sku,
                    'name' => $product->name,
                    'category' => $product->category,
                    'enabled' => $product->enabled,
                ];
            }
        }

        $this->db->trans_start();
        if ($originals)
            $this->db->update_batch('provider_products', $originals, 'id');
        if ($news)
            $this->db->insert_batch('provider_products', $news);
        $this->db->where('deleted', 1);
        $this->db->delete('provider_products');
        $this->db->trans_complete();
    }

    public function getUpdatingProducts($provider_id)
    {
        $this->db->from('provider_products');
        $this->db->where('provider_id', $provider_id);
        $this->db->where('updating', 1);
        $products = $this->db->get()->result();
        if (count($products) == 0) {
            // Flag updating
            $this->db->set('updating', 1);
            $this->db->update('provider_products');

            $this->db->select('COUNT(*)');
            $this->db->from('provider_products');
            $count = $this->db->get()->row();
            if (reset($count) == 0)
                return [];

            return $this->getUpdatingProducts($provider_id);
        }
        return $products;
    }

    public function updateProductInfo($product, $productInfo)
    {
        $information_type = ProviderProductInformationType::Normal;
        if (!empty($productInfo) && !empty($productInfo[0])) {
            if (is_object($productInfo[0]) && $productInfo[0]->data != null) {
                $information_type = ProviderProductInformationType::Decal;
                $this->updateProductInfoDecal($product, $productInfo);
            } else if ($productInfo[0][0]->html_type != null) {
                $information_type = ProviderProductInformationType::RollLabel;
                $this->updateProductInfoRollLabel($product, $productInfo);
            } else if ($productInfo[0][0]->group != null) {
                $information_type = ProviderProductInformationType::Normal;
                $this->updateProductInfoNormal($product, $productInfo);
            }
        }

        /**
         * provider_products.information_type
         * Flag Updated
         */
        $this->db->set('information_type', $information_type);
        $this->db->set('updating', 0);
        $this->db->where('id', $product->id);
        $this->db->update('provider_products');
    }

    function updateProductInfoNormal($product, $productInfo)
    {
        /**
         * provider_options
         **/
        $this->db->from('provider_options');
        $this->db->where('provider_id', $product->provider_id);
        $data = $this->db->get()->result();
        $originals = [];
        foreach ($data as $item) {
            $originals[strtolower($item->name)] = $item;
        }

        $news = [];

        foreach ($productInfo[0] as $option) {
            if (!array_key_exists(strtolower($option->group), $originals)) {
                if (!array_key_exists(strtolower($option->group), $news)) {
                    $type = ProviderOptionType::Normal;
                    if (strcasecmp($option->group, 'size') == 0)
                        $type = ProviderOptionType::Size;
                    if (strcasecmp($option->group, 'qty') == 0 || strcasecmp($option->group, 'quantity') == 0)
                        $type = ProviderOptionType::Quantity;
                    $news[strtolower($option->group)] = (object) [
                        'provider_id' => $product->provider_id,
                        'name' => $option->group,
                        'label' => $option->group,
                        'type' => $type,
                    ];
                }
            }
        }

        $this->db->trans_start();
        // if ($originals)
        //     $this->db->update_batch('provider_products', $originals, 'id');
        if ($news)
            $this->db->insert_batch('provider_options', $news);
        $this->db->trans_complete();

        $this->db->from('provider_options');
        $this->db->where('provider_id', $product->provider_id);
        $data = $this->db->get()->result();
        $options = [];
        foreach ($data as $item) {
            $options[$item->name] = $item;
        }

        /**
         * provider_option_values
         */
        $this->db->from('provider_option_values');
        $this->db->join('provider_options', 'provider_options.id=provider_option_values.option_id');
        $this->db->where('provider_options.provider_id', $product->provider_id);
        $this->db->select('provider_option_values.*, provider_options.name');
        $data = $this->db->get()->result();
        $originals = [];
        foreach ($data as $item) {
            $originals[$item->option_id . '-' . $item->provider_option_value_id] = $item;
        }

        $news = [];

        foreach ($productInfo[0] as $option) {
            $option_id = $options[$option->group]->id;
            $key = $option_id . '-' . $option->id;
            if (!array_key_exists($key, $originals)) {
                if (!array_key_exists($key, $news)) {
                    $news[$key] = (object) [
                        'option_id' => $option_id,
                        'provider_option_value_id' => $option->id,
                        'value' => $option->name,
                    ];
                }
            }
        }

        $this->db->trans_start();
        if ($news)
            $this->db->insert_batch('provider_option_values', $news);
        $this->db->trans_complete();

        /**
         * provider_product_options
         **/
        // Flag deleted
        $this->db->set('deleted', 1);
        $this->db->where('provider_id', $product->provider_id);
        $this->db->where('provider_product_id', $product->provider_product_id);
        $this->db->update('provider_product_options');

        $this->db->from('provider_product_options');
        $this->db->where('provider_id', $product->provider_id);
        $this->db->where('provider_product_id', $product->provider_product_id);
        $data = $this->db->get()->result();
        $originals = [];
        $original_items = [];
        foreach ($data as $item) {
            if (!array_key_exists($item->option_id, $originals))
                $originals[$item->option_id] = [];
            $originals[$item->option_id][$item->provider_option_value_id] = $item;
            $original_items[] = $item;
        }

        $news = [];
        foreach ($productInfo[0] as $option) {
            $option_id = $options[$option->group]->id;
            if (array_key_exists($option_id, $originals) && array_key_exists($option->id, $originals[$option_id])) {
                $originals[$option_id][$option->id]->deleted = 0;
            } else {
                $news[] = (object) [
                    'provider_id' => $product->provider_id,
                    'provider_product_id' => $product->provider_product_id,
                    'option_id' => $option_id,
                    'provider_option_value_id' => $option->id,
                ];
            }
        }

        $this->db->trans_start();
        if ($original_items)
            $this->db->update_batch('provider_product_options', $original_items, 'id');
        if ($news)
            $this->db->insert_batch('provider_product_options', $news);
        $this->db->where('deleted', 1);
        $this->db->delete('provider_product_options');
        $this->db->trans_complete();
    }

    function updateProductInfoRollLabel($product, $productInfo)
    {
        /**
         * First array
         */

        // provider_options
        $this->db->from('provider_options');
        $this->db->where('provider_id', $product->provider_id);
        $data = $this->db->get()->result();
        $originals = [];
        foreach ($data as $item) {
            $originals[strtolower($item->name)] = $item;
        }

        $news = [];
        $updated = [];

        foreach ($productInfo[0] as $option) {
            if (!array_key_exists(strtolower($option->name), $originals)) {
                if (!array_key_exists(strtolower($option->name), $news)) {
                    $type = ProviderOptionType::Normal;
                    if (strcasecmp($option->name, 'size') == 0)
                        $type = ProviderOptionType::Size;
                    if (strcasecmp($option->name, 'qty') == 0 || strcasecmp($option->name, 'quantity') == 0)
                        $type = ProviderOptionType::Quantity;
                    if (strcasecmp($option->name, 'turnaround') == 0)
                        $type = ProviderOptionType::Turnaround;
                    $news[strtolower($option->name)] = (object) [
                        'provider_id' => $product->provider_id,
                        'provider_option_id' => $option->option_id,
                        'name' => $option->name,
                        'label' => $option->label,
                        'type' => $type,
                        'html_type' => $option->html_type,
                        'sort_order' => $option->opt_sort_order,
                    ];
                }
            } else {
                $updated[strtolower($option->name)] = (object) [
                    'id' => $originals[strtolower($option->name)]->id,
                    'provider_option_id' => $option->option_id,
                    'name' => $option->name,
                    'label' => $option->label,
                    'html_type' => $option->html_type,
                    'sort_order' => $option->opt_sort_order,
                ];
            }
        }

        $this->db->trans_start();
        if ($updated)
            $this->db->update_batch('provider_options', $updated, 'id');
        if ($news)
            $this->db->insert_batch('provider_options', $news);
        $this->db->trans_complete();

        $this->db->from('provider_options');
        $this->db->where('provider_id', $product->provider_id);
        $data = $this->db->get()->result();
        $options = [];
        foreach ($data as $item) {
            $options[$item->provider_option_id] = $item;
        }

        // provider_option_values
        $this->db->from('provider_option_values');
        $this->db->join('provider_options', 'provider_options.id=provider_option_values.option_id');
        $this->db->where('provider_options.provider_id', $product->provider_id);
        $this->db->select('provider_option_values.*, provider_options.name');
        $data = $this->db->get()->result();
        $originals = [];
        foreach ($data as $item) {
            $originals[$item->option_id . '-' . $item->provider_option_value_id] = $item;
        }

        $news = [];
        $updated = [];

        foreach ($productInfo[0] as $option) {
            if ($option->opt_val_id == null || $option->option_val == null)
                continue;
            $option_id = $options[$option->option_id]->id;
            $key = $option_id . '-' . $option->opt_val_id;
            if (!array_key_exists($key, $originals)) {
                if (!array_key_exists($key, $news)) {
                    $news[$key] = (object) [
                        'option_id' => $option_id,
                        'provider_option_value_id' => $option->opt_val_id,
                        'value' => $option->option_val,
                        'img_src' => $option->img_src,
                        'sort_order' => $option->opt_val_sort_order,
                        'extra_turnaround_days' => $option->extra_turnaround_days,
                    ];
                }
            } else {
                $updated[$key] = (object) [
                    'id' => $originals[$key]->id,
                    'img_src' => $option->img_src,
                    'sort_order' => $option->opt_val_sort_order,
                    'extra_turnaround_days' => $option->extra_turnaround_days,
            ];
            }
        }

        $this->db->trans_start();
        if ($updated)
            $this->db->update_batch('provider_option_values', $updated, 'id');
        if ($news)
            $this->db->insert_batch('provider_option_values', $news);
        $this->db->trans_complete();

        // provider_product_options
        // Flag deleted
        $this->db->set('deleted', 1);
        $this->db->where('provider_id', $product->provider_id);
        $this->db->where('provider_product_id', $product->provider_product_id);
        $this->db->update('provider_product_options');

        $this->db->from('provider_product_options');
        $this->db->where('provider_id', $product->provider_id);
        $this->db->where('provider_product_id', $product->provider_product_id);
        $data = $this->db->get()->result();
        $originals = [];
        $original_items = [];
        foreach ($data as $item) {
            if (!array_key_exists($item->option_id, $originals))
                $originals[$item->option_id] = [];
            $originals[$item->option_id][$item->provider_option_value_id] = $item;
            $original_items[] = $item;
        }

        $news = [];
        foreach ($productInfo[0] as $option) {
            $option_id = $options[$option->option_id]->id;
            if (array_key_exists($option_id, $originals) && array_key_exists($option->opt_val_id, $originals[$option_id])) {
                $originals[$option_id][$option->opt_val_id]->deleted = 0;
            } else {
                $news[] = (object) [
                    'provider_id' => $product->provider_id,
                    'provider_product_id' => $product->provider_product_id,
                    'option_id' => $option_id,
                    'provider_option_value_id' => $option->opt_val_id,
                ];
            }
        }

        $this->db->trans_start();
        if ($original_items)
            $this->db->update_batch('provider_product_options', $original_items, 'id');
        if ($news)
            $this->db->insert_batch('provider_product_options', $news);
        $this->db->where('deleted', 1);
        $this->db->delete('provider_product_options');
        $this->db->trans_complete();

        /**
         * Second array
         */
        if ($productInfo[1]) {
            $excludes = [];
            // foreach ($productInfo[1] as $optSet) {
            //     $optSet = (array)$optSet;
            //     $exclude = [];
            //     foreach ($optSet as $key => $value) {
            //         if ($key == 'size_id' || $key == 'qty') {
            //             $exclude[$key] = $value;
            //         } else if (str_starts_with($key, 'pricing_product_option_entity_id_')) {
            //             $index = substr($key, strlen('pricing_product_option_entity_id_'));
            //             $k = $value;
            //             $v = $optSet["pricing_product_option_value_entity_id_$index"];
            //             $exclude[$k] = $v;
            //         }
            //     }
            //     $excludes[] = $exclude;
            // }

            $this->db->where('provider_id', $product->provider_id);
            $this->db->where('provider_product_id', $product->provider_product_id);
            $this->db->delete('provider_product_option_excludes');

            $groupNo = 0;
            foreach ($productInfo[1] as $optSet) {
                $optSet = (array)$optSet;
                $exclude = [];
                foreach ($optSet as $key => $value) {
                    if ($key == 'size_id' || $key == 'qty') {
                        //$exclude[$key] = $value;
                    } else if (str_starts_with($key, 'pricing_product_option_entity_id_')) {
                        $index = substr($key, strlen('pricing_product_option_entity_id_'));
                        $k = $value;
                        $v = $optSet["pricing_product_option_value_entity_id_$index"];
                        if ($v) {
                            $excludes[] = [
                                'provider_id' => $product->provider_id,
                                'provider_product_id' => $product->provider_product_id,
                                'group_no' => $groupNo,
                                'provider_option_id' => $k,
                                'provider_option_value_id' => $v,
                            ];
                        }
                    }
                }
                $groupNo++;
            }
            if ($excludes)
                $this->db->insert_batch('provider_product_option_excludes', $excludes);
        }

        /**
         * Third array
         */
        if ($productInfo[2]) {
            $this->db->where('provider_id', $product->provider_id);
            $this->db->where('provider_product_id', $product->provider_product_id);
            $this->db->delete('provider_product_option_contents');
            foreach ($productInfo[2] as $item) {
                $contents[] = [
                    'provider_id' => $product->provider_id,
                    'provider_product_id' => $product->provider_product_id,
                    'provider_option_value_id' => $item->pricing_product_option_value_entity_id,
                    'content_type' => $item->content_type,
                    'content' => $item->content,
                ];
            }
            if ($contents) {
                $this->db->insert_batch('provider_product_option_contents', $contents);
            }
        }
    }

    function updateProductInfoDecal($product, $productInfo)
    {
    }

    public function getProducts($provider_id, $q, $take, $skip, &$data, &$total)
    {
        if (strlen($q) > 0)
            $this->db->like('provider_products.name', $q);
        $this->db->select('COUNT(*)');
        $this->db->from('provider_products');
        $this->db->where('provider_id', $provider_id);
        $this->db->where_not_in('provider_product_id', [14959, 14960, 14966]);
        $total = $this->db->get()->row();
        $total = reset($total);

        if (strlen($q) > 0)
            $this->db->like('provider_products.name', $q);
        $this->db->select('provider_products.*, products.name AS product_name, products.product_image');
        $this->db->from('provider_products');
        $this->db->join('products', 'products.id = provider_products.product_id', 'left');
        $this->db->where('provider_id', $provider_id);
        $this->db->where_not_in('provider_product_id', [14959, 14960, 14966]);
        $this->db->order_by('name');
        $take = $take > 0 ? $take : 0;
        $skip = $skip > 0 ? $skip : 0;
        if ($take > 0)
            $this->db->limit($take, $skip);
        else
            $this->db->offset($skip);
        $data = $this->db->get()->result();
    }

    public function getProduct($id)
    {
        $this->db->from('provider_products');
        $this->db->where('provider_products.id', $id);
        $this->db->join('products', 'products.id=provider_products.product_id', 'left');
        $this->db->select('provider_products.*, products.name AS product_name');
        return $this->db->get()->row();
    }

    public function getProductByProductId($provider_id, $product_id)
    {
        $this->db->from('provider_products');
        $this->db->where('provider_id', $provider_id);
        $this->db->where('product_id', $product_id);
        return $this->db->get()->row();
    }

    public function getProductByProviderProductId($provider_id, $provider_product_id)
    {
        $this->db->from('provider_products');
        $this->db->where('provider_id', $provider_id);
        $this->db->where('provider_product_id', $provider_product_id);
        return $this->db->get()->row();
    }

    public function bindProduct($id, $product_id)
    {
        $this->db->where('id', $id);
        $this->db->set('product_id', $product_id);
        $this->db->update('provider_products');
    }

    public function unbindProduct($id)
    {
        $this->db->where('id', $id);
        $this->db->set('product_id', 'NULL', false);
        $this->db->update('provider_products');
    }

    public function getOptions($provider_id, $q, $take, $skip, &$data, &$total)
    {
        if (strlen($q) > 0)
            $this->db->like('provider_options.name', $q);
        $this->db->select('COUNT(*)');
        $this->db->from('provider_options');
        $this->db->where('provider_id', $provider_id);
        $total = $this->db->get()->row();
        $total = reset($total);

        if (strlen($q) > 0)
            $this->db->like('provider_options.name', $q);
        $this->db->select('provider_options.*, product_attributes.name AS attribute_name, product_attributes.name_french AS attribute_name_french');
        $this->db->from('provider_options');
        $this->db->join('product_attributes', 'product_attributes.id = provider_options.attribute_id', 'left');
        $this->db->where('provider_id', $provider_id);
        $this->db->order_by('type, name');
        $take = $take > 0 ? $take : 0;
        $skip = $skip > 0 ? $skip : 0;
        if ($take > 0)
            $this->db->limit($take, $skip);
        else
            $this->db->offset($skip);
        $data = $this->db->get()->result();
    }

    public function updateOption($id, $type, $attribute_id)
    {
        $this->db->where('id', $id);
        $this->db->set('type', $type);
        $this->db->set('attribute_id', $attribute_id);
        $this->db->update('provider_options');
    }

    public function getProductOptions($provider_id, $provider_product_id, $take, $skip, &$data, &$total)
    {
        $this->db->select('COUNT(*)');
        $this->db->from('provider_product_options');
        $this->db->where('provider_id', $provider_id);
        $this->db->where('provider_product_id', $provider_product_id);
        $total = $this->db->get()->row();
        $total = reset($total);

        $this->db->select('provider_options.*, provider_option_values.provider_option_value_id, provider_option_values.value, provider_options.name, provider_options.type, product_attributes.name AS attribute_name');
        $this->db->from('provider_product_options');
        $this->db->join('provider_options', 'provider_options.id = provider_product_options.option_id', 'left');
        $this->db->join('provider_option_values', 'provider_option_values.option_id = provider_product_options.option_id AND provider_option_values.provider_option_value_id = provider_product_options.provider_option_value_id', 'left');
        $this->db->join('product_attributes', 'product_attributes.id = provider_options.attribute_id', 'left');
        $this->db->where('provider_product_options.provider_id', $provider_id);
        $this->db->where('provider_product_options.provider_product_id', $provider_product_id);
        $this->db->order_by('provider_options.type, provider_product_options.id, provider_product_options.provider_option_value_id');
        $take = $take > 0 ? $take : 0;
        $skip = $skip > 0 ? $skip : 0;
        if ($take > 0)
            $this->db->limit($take, $skip);
        else
            $this->db->offset($skip);
        $data = $this->db->get()->result();
    }

    public function getProductOptionValues($provider_id, $provider_product_id)
    {
        $this->db->select('provider_option_values.*, provider_options.type AS option_type');
        $this->db->from('provider_product_options');
        $this->db->join('provider_options', 'provider_options.id = provider_product_options.option_id');
        $this->db->join('provider_option_values', 'provider_option_values.option_id = provider_product_options.option_id AND provider_option_values.provider_option_value_id = provider_product_options.provider_option_value_id', 'left');
        $this->db->where('provider_product_options.provider_id', $provider_id);
        $this->db->where('provider_product_options.provider_product_id', $provider_product_id);
        $this->db->order_by('provider_options.sort_order, provider_options.type, provider_product_options.id, provider_product_options.provider_option_value_id');
        return $this->db->get()->result();
    }

    public function getProductOptionGroups($provider_id, $provider_product_id)
    {
        $this->db->select('provider_options.*, product_attributes.name AS attribute_name, product_attributes.name_french AS attribute_name_french');
        $this->db->from('provider_product_options');
        $this->db->join('provider_options', 'provider_options.id = provider_product_options.option_id');
        $this->db->join('product_attributes', 'product_attributes.id = provider_options.attribute_id', 'left');
        $this->db->where('provider_product_options.provider_id', $provider_id);
        $this->db->where('provider_product_options.provider_product_id', $provider_product_id);
        $this->db->group_by('provider_options.id');
        $this->db->order_by('provider_options.type, provider_product_options.id');
        return $this->db->get()->result();
    }

    public function getOptionsByValueIds($provider_id, $provider_product_id, $value_ids)
    {
        $this->db->select(
            'provider_options.*, provider_product_options.provider_option_value_id, provider_option_values.value,' .
            'product_attributes.name AS attribute_name, product_attributes.name_french AS attribute_name_french'
        );
        $this->db->from('provider_product_options');
        $this->db->join('provider_options', 'provider_options.id = provider_product_options.option_id');
        $this->db->join('provider_option_values', 'provider_option_values.option_id = provider_product_options.option_id AND provider_option_values.provider_option_value_id = provider_product_options.provider_option_value_id');
        $this->db->join('product_attributes', 'product_attributes.id=provider_options.attribute_id', 'left');
        $this->db->where('provider_product_options.provider_id', $provider_id);
        $this->db->where('provider_product_options.provider_product_id', $provider_product_id);
        $this->db->where_in('provider_product_options.provider_option_value_id', $value_ids);
        $this->db->order_by('provider_options.type');
        return $this->db->get()->result();
    }

    public function orderSave($order_id, $response)
    {
        $sina = config_item('sina');
        $shipping_extra_days = $sina['shipping_extra_days'];
        $data = [
            'order_id' => $order_id,
            'provider_order_id' => $response->orderId,
            'grandtotal' => $response->grandtotal,
            'message' => $response->message,
            'shipping_cost' => $response->shippingCost,
            'subtotal' => $response->subtotal,
            'tax' => $response->tax,
            'shipping_extra_days' => $shipping_extra_days,
        ];
        $this->db->insert('provider_orders', $data);
    }

    public function getOrderProductCount($order_id)
    {
        $this->db->from('product_order_items');
        $this->db->where('order_id', $order_id);
        $this->db->join('provider_products', 'provider_products.product_id = product_order_items.product_id');
        $this->db->select('COUNT(*) AS count');
        return $this->db->get()->row()->count;
    }

    public function getOrders($order_id)
    {
        $this->db->from('provider_orders');
        $this->db->where('order_id', $order_id);
        // $this->select('provider_order_id');
        return $this->db->get()->result();
    }
}
