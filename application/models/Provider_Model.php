<?php

require_once(APPPATH . 'common/ProductAttributeType.php');

use App\Common\ProductAttributeType;

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
        /**
         * provider_attributes
         **/
        $this->db->from('provider_attributes');
        $this->db->where('provider_id', $product->provider_id);
        $data = $this->db->get()->result();
        $originals = [];
        foreach ($data as $item) {
            $originals[$item->name] = $item;
        }

        $news = [];
        foreach ($productInfo[0] as $attribute) {
            if (!array_key_exists($attribute->group, $originals)) {
                if (!array_key_exists($attribute->group, $news)) {
                    if ($attribute->group == null) {
                        echo PHP_EOL;
                        echo "$product->provider_product_id: [Failed]" . PHP_EOL;
                        break;
                    }

                    $type = ProductAttributeType::Normal;
                    if (strcasecmp($attribute->group, 'size') == 0)
                        $type = ProductAttributeType::Size;
                    if (strcasecmp($attribute->group, 'qty') == 0 || strcasecmp($attribute->group, 'quantity') == 0)
                        $type = ProductAttributeType::Quantity;
                    $news[$attribute->group] = (object) [
                        'provider_id' => $product->provider_id,
                        'name' => $attribute->group,
                        'type' => $type,
                    ];
                }
            }
        }

        $this->db->trans_start();
        // if ($originals)
        //     $this->db->update_batch('provider_products', $originals, 'id');
        if ($news)
            $this->db->insert_batch('provider_attributes', $news);
        $this->db->trans_complete();

        /**
         * provider_product_attributes
         **/
        $this->db->from('provider_attributes');
        $this->db->where('provider_id', $product->provider_id);
        $data = $this->db->get()->result();
        $attributes_id = [];
        $attributes_name = [];
        foreach ($data as $item) {
            $attributes_id[$item->id] = $item;
            $attributes_name[$item->name] = $item;
        }

        // Flag deleted
        $this->db->set('deleted', 1);
        $this->db->where('provider_id', $product->provider_id);
        $this->db->where('provider_product_id', $product->provider_product_id);
        $this->db->update('provider_product_attributes');

        $this->db->from('provider_product_attributes');
        $this->db->where('provider_id', $product->provider_id);
        $this->db->where('provider_product_id', $product->provider_product_id);
        $data = $this->db->get()->result();
        $originals = [];
        $original_items = [];
        foreach ($data as $item) {
            // $name = $attribute_id[$item->provider_attribute_id]->name;
            if (!array_key_exists($item->provider_attribute_id, $originals))
                $originals[$item->provider_attribute_id] = [];
            $originals[$item->provider_attribute_id][$item->value] = $item;
            $original_items[] = $item;
        }

        $news = [];
        foreach ($productInfo[0] as $attribute) {
            if ($attribute->group == null)
                break;

            $attribute_id = $attributes_name[$attribute->group]->id;
            if (array_key_exists($attribute_id, $originals) && array_key_exists($attribute->name, $originals[$attribute_id])) {
                $originals[$attribute_id][$attribute->name]->deleted = 0;
            } else {
                $news[] = (object) [
                    'provider_id' => $product->provider_id,
                    'provider_product_id' => $product->provider_product_id,
                    'provider_attribute_id' => $attribute_id,
                    'value_id' => $attribute->id,
                    'value' => $attribute->name,
                ];
            }
        }

        $this->db->trans_start();
        if ($original_items)
            $this->db->update_batch('provider_product_attributes', $original_items, 'id');
        if ($news)
            $this->db->insert_batch('provider_product_attributes', $news);
        $this->db->trans_complete();

        /**
         * Flag Updated
         */
        $this->db->set('updating', 0);
        $this->db->where('id', $product->id);
        $this->db->update('provider_products');
    }

    public function getProducts($provider_id, $q, $take, $skip, &$data, &$total)
    {
        if (strlen($q) > 0)
            $this->db->like('provider_products.name', $q);
        $this->db->select('COUNT(*)');
        $this->db->from('provider_products');
        $this->db->where('provider_id', $provider_id);
        $total = $this->db->get()->row();
        $total = reset($total);

        if (strlen($q) > 0)
            $this->db->like('provider_products.name', $q);
        $this->db->select('provider_products.*, products.name AS product_name, products.product_image');
        $this->db->from('provider_products');
        $this->db->join('products', 'products.id = provider_products.product_id', 'left');
        $this->db->where('provider_id', $provider_id);
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

    public function getAttributes($provider_id, $q, $take, $skip, &$data, &$total)
    {
        if (strlen($q) > 0)
            $this->db->like('provider_attributes.name', $q);
        $this->db->select('COUNT(*)');
        $this->db->from('provider_attributes');
        $this->db->where('provider_id', $provider_id);
        $total = $this->db->get()->row();
        $total = reset($total);

        if (strlen($q) > 0)
            $this->db->like('provider_attributes.name', $q);
        $this->db->select('provider_attributes.*, product_attributes.name AS attribute_name');
        $this->db->from('provider_attributes');
        $this->db->join('product_attributes', 'product_attributes.id = provider_attributes.attribute_id', 'left');
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

    public function updateAttribute($id, $type, $attribute_id)
    {
        $this->db->where('id', $id);
        $this->db->set('type', $type);
        $this->db->set('attribute_id', $attribute_id);
        $this->db->update('provider_attributes');
    }

    public function getProductAttributes($provider_id, $provider_product_id, $take, $skip, &$data, &$total)
    {
        $this->db->select('COUNT(*)');
        $this->db->from('provider_product_attributes');
        $this->db->where('provider_id', $provider_id);
        $this->db->where('provider_product_id', $provider_product_id);
        $total = $this->db->get()->row();
        $total = reset($total);

        $this->db->select('provider_product_attributes.*, provider_attributes.name, provider_attributes.type, product_attributes.name AS attribute_name');
        $this->db->from('provider_product_attributes');
        $this->db->join('provider_attributes', 'provider_attributes.id = provider_product_attributes.provider_attribute_id', 'left');
        $this->db->join('product_attributes', 'product_attributes.id = provider_attributes.attribute_id', 'left');
        $this->db->where('provider_product_attributes.provider_id', $provider_id);
        $this->db->where('provider_product_attributes.provider_product_id', $provider_product_id);
        $this->db->order_by('provider_attributes.type, provider_product_attributes.id, provider_product_attributes.value_id');
        $take = $take > 0 ? $take : 0;
        $skip = $skip > 0 ? $skip : 0;
        if ($take > 0)
            $this->db->limit($take, $skip);
        else
            $this->db->offset($skip);
        $data = $this->db->get()->result();
    }

    public function getProductAttributeValues($provider_id, $provider_product_id)
    {
        $this->db->select('provider_product_attributes.*');
        $this->db->from('provider_product_attributes');
        $this->db->join('provider_attributes', 'provider_attributes.id = provider_product_attributes.provider_attribute_id', 'left');
        $this->db->where('provider_product_attributes.provider_id', $provider_id);
        $this->db->where('provider_product_attributes.provider_product_id', $provider_product_id);
        $this->db->order_by('provider_attributes.type, provider_product_attributes.id, provider_product_attributes.value_id');
        return $this->db->get()->result();
    }

    public function getProductAttributeGroups($provider_id, $provider_product_id)
    {
        $this->db->select('provider_attributes.*, product_attributes.name AS attribute_name, product_attributes.name_french AS attribute_name_french');
        $this->db->from('provider_product_attributes');
        $this->db->join('provider_attributes', 'provider_attributes.id = provider_product_attributes.provider_attribute_id');
        $this->db->join('product_attributes', 'product_attributes.id = provider_attributes.attribute_id', 'left');
        $this->db->where('provider_product_attributes.provider_id', $provider_id);
        $this->db->where('provider_product_attributes.provider_product_id', $provider_product_id);
        $this->db->group_by('provider_attributes.id');
        $this->db->order_by('provider_attributes.type, provider_product_attributes.id');
        return $this->db->get()->result();
    }

    public function getAttributesByValueIds($provider_id, $provider_product_id, $value_ids)
    {
        $this->db->select(
            'provider_attributes.*, provider_product_attributes.value_id, provider_product_attributes.value'
        );
        $this->db->from('provider_product_attributes');
        $this->db->join('provider_attributes', 'provider_attributes.id = provider_product_attributes.provider_attribute_id');
        $this->db->where('provider_product_attributes.provider_id', $provider_id);
        $this->db->where('provider_product_attributes.provider_product_id', $provider_product_id);
        $this->db->where_in('provider_product_attributes.value_id', $value_ids);
        $this->db->order_by('provider_attributes.type');
        return $this->db->get()->result();
    }

    public function orderSave($order_id, $response)
    {
        $data = [
            'order_id' => $order_id,
            'provider_order_id' => $response->orderId,
            'grandtotal' => $response->grandtotal,
            'message' => $response->message,
            'shipping_cost' => $response->shippingCost,
            'subtotal' => $response->subtotal,
            'tax' => $response->tax,
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
        $this->select('provider_order_id');
        return $this->db->get()->result();
    }
}
