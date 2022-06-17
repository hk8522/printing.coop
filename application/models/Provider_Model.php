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

    public function updateProvider($provider, $products)
    {
        // Flag deleted
        $this->db->set('deleted', 1);
        $this->db->update('provider_products');

        $this->db->from('provider_products');
        $this->db->where('provider_id', $provider->id);
        $data = $this->db->get()->result();
        $originals = [];
        foreach ($data as $item) {
            $originals[$item->provider_product_id] = $item;
        }

        $news = [];
        foreach ($products as $product) {
            if (array_key_exists($product->id, $originals)) {
                $originals[$product->id]->provider_id = $provider->id;
                $originals[$product->id]->provider_product_id = $product->id;
                $originals[$product->id]->sku = $product->sku;
                $originals[$product->id]->name = $product->name;
                $originals[$product->id]->category = $product->category;
                $originals[$product->id]->enabled = $product->enabled;
                $originals[$product->id]->deleted = 0;
            } else {
                $news[] = (object) [
                    'provider_id' => $provider->id,
                    'provider_product_id' => $product->id,
                    'sku' => $product->sku,
                    'name' => $product->name,
                    'category' => $product->category,
                    'enabled' => $product->enabled,
                ];
            }
        }

        if ($originals)
            $this->db->update_batch('provider_products', $originals, 'id');
        if ($news)
            $this->db->insert_batch('provider_products', $news);
    }

    public function getUpdatingProducts($provider)
    {
        $this->db->from('provider_products');
        $this->db->where('provider_id', $provider->id);
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

            return $this->getUpdatingProducts($provider);
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
                        echo "id: $product->provider_product_id Failed" . PHP_EOL;
                        echo PHP_EOL;
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

        // if ($originals)
        //     $this->db->update_batch('provider_products', $originals, 'id');
        if ($news)
            $this->db->insert_batch('provider_attributes', $news);

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
            $item->deleted = 0;
            $originals[$item->provider_attribute_id][$item->name] = $item;
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
                    'value' => $attribute->name,
                ];
            }
        }

        if ($original_items)
            $this->db->update_batch('provider_product_attributes', $original_items, 'id');
        if ($news)
            $this->db->insert_batch('provider_product_attributes', $news);

        /**
         * Flag Updated
         */
        $this->db->set('updating', 0);
        $this->db->where('id', $product->id);
        $this->db->update('provider_products');
    }

    public function getProducts($provider, $take, $skip, &$data, &$total)
    {
        $this->db->select('COUNT(*)');
        $this->db->from('provider_products');
        $this->db->where('provider_id', $provider->id);
        $total = reset($this->db->get()->row());

        $this->db->select('provider_products.*, products.name AS product_name, products.product_image');
        $this->db->from('provider_products');
        $this->db->join('products', 'products.id = provider_products.product_id', 'left');
        $this->db->where('provider_id', $provider->id);
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
        $this->db->where('id', $id);
        return $this->db->get()->row();
    }

    public function bindProduct($id, $product_id)
    {
        $this->db->where('id', $id);
        $this->db->set('product_id', $product_id);
        $this->db->update('provider_products');
    }

    public function getAttributes($provider, $take, $skip, &$data, &$total)
    {
        $this->db->select('COUNT(*)');
        $this->db->from('provider_attributes');
        $this->db->where('provider_id', $provider->id);
        $total = reset($this->db->get()->row());

        $this->db->select('provider_attributes.*, product_attributes.name AS attribute_name');
        $this->db->from('provider_attributes');
        $this->db->join('product_attributes', 'product_attributes.id = provider_attributes.attribute_id', 'left');
        $this->db->where('provider_id', $provider->id);
        $this->db->order_by('name');
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

    public function getProductAttributes($provider, $provider_product_id, $take, $skip, &$data, &$total)
    {
        $this->db->select('COUNT(*)');
        $this->db->from('provider_product_attributes');
        $this->db->where('provider_id', $provider->id);
        $this->db->where('provider_product_id', $provider_product_id);
        $total = reset($this->db->get()->row());

        $this->db->select('provider_product_attributes.*, provider_attributes.name, provider_attributes.type, product_attributes.name AS attribute_name');
        $this->db->from('provider_product_attributes');
        $this->db->join('provider_attributes', 'provider_attributes.id = provider_product_attributes.provider_attribute_id', 'left');
        $this->db->join('product_attributes', 'product_attributes.id = provider_attributes.attribute_id', 'left');
        $this->db->where('provider_product_attributes.provider_id', $provider->id);
        $this->db->where('provider_product_attributes.provider_product_id', $provider_product_id);
        $this->db->order_by('provider_product_attributes.id');
        $take = $take > 0 ? $take : 0;
        $skip = $skip > 0 ? $skip : 0;
        if ($take > 0)
            $this->db->limit($take, $skip);
        else
            $this->db->offset($skip);
        $data = $this->db->get()->result();
    }
}
