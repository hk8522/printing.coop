<?php

class Module_Model extends MY_Model
{
    public $table = 'modules';

    public function getModuleList()
    {
        $query = "SELECT `m`.`id` as `module_id`, `m`.`module_name`,
                `sm`.`id` as `sub_module_id`, `sm`.`sub_module_name`
            FROM `modules` AS `m` left join `sub_modules` AS `sm` ON `m`.`id`=`sm`.`module_id` AND `m`.`status`=1 AND `sm`.`status`=1
            ORDER BY `m`.`order`, `m`.`module_name`, `sm`.`module_id`, `sm`.`order`, `sm`.`sub_module_name`";
        $data = $this->db->query($query)->result_array();
        // pr($data);
        // exit(0);
        $modules = [];
        foreach ($data as $module) {
            if (!array_key_exists($module['module_id'], $modules)) {
                $modules[$module['module_id']] = [
                    'name' => $module['module_name'],
                    'items' => [],
                ];
            }

            if ($module['sub_module_id'] != null) {
                $modules[$module['module_id']]['items'][$module['sub_module_id']] = $module['sub_module_name'];
            }
        }
        return $modules;
    }

    public function getAdminModuleByAdminId($id = null)
    {
        $query = "SELECT *
            FROM `admin_modules` AS `m` left join `admin_sub_modules` AS `sm` ON `m`.`admin_id`=`sm`.`admin_id` AND `m`.`module_id`=`sm`.`module_id`
            WHERE `m`.`admin_id`='$id'";
        $data = $this->db->query($query)->result_array();
        // pr($data);
        // exit(0);
        $modules = [];
        foreach ($data as $module) {
            if (!array_key_exists($module['module_id'], $modules)) {
                $modules[$module['module_id']] = [
                    'data' => [
                        'admin_id' => $id,
                        'module_id' => $module['module_id'],
                    ],
                    'items' => [],
                ];
            }

            if ($module['sub_module_id'] != null) {
                $modules[$module['module_id']]['items'][$module['sub_module_id']] = [
                    'admin_id' => $id,
                    'module_id' => $module['module_id'],
                    'sub_module_id' => $module['sub_module_id'],
                ];
            }
        }
        return $modules;
    }

    public function getMainModuleByAdminId($id = null, $role = 'admin')
    {
        $module = array();
        if ($role != 'admin') {
            if (!empty($id)) {
                $this->db->select('*');
                $this->db->from('admin_modules');
                $this->db->where('admin_id', $id);
                $query = $this->db->get();
                $data = $query->result_array();
                foreach ($data as $key => $val) {
                    $module_id = $val['module_id'];
                    $module[] = $module_id;
                }
            }
        } else {
            $this->db->select('*');
            $this->db->from('module');
            $query = $this->db->get();
            $data = $query->result_array();
            foreach ($data as $key => $val) {
                $module_id = $val['id'];
                $module[] = $module_id;
            }
        }
        return $module;
    }

    public function getSubModuleByAdminId($id = null, $role = 'admin')
    {
        $submodule = array();
        if ($role != 'admin') {
            if (!empty($id)) {
                $this->db->select('*');
                $this->db->from('admin_sub_modules');
                $this->db->where('admin_id', $id);
                $query = $this->db->get();
                $data = $query->result_array();
                foreach ($data as $key => $val) {
                    $sub_module_id = $val['sub_module_id'];
                    $submodule[] = $sub_module_id;
                }
            }
        } else {
            $this->db->select('*');
            $this->db->from('sub_modules');
            $query = $this->db->get();
            $data = $query->result_array();
            foreach ($data as $key => $val) {
                $sub_module_id = $val['id'];
                $submodule[] = $sub_module_id;
            }
        }
        return $submodule;
    }

    public function getAllModuleList()
    {
        $query = "SELECT `m`.`id` as `module_id`, `m`.`module_name`, `m`.`order` as `module_order`, `m`.`url` as `module_url`, `m`.`status` as `module_status`, `m`.`class` as `module_class`,
                `sm`.`id` as `sub_module_id`, `sm`.`sub_module_name`, `sm`.`order` as `sub_module_order`, `sm`.`url` as `sub_module_url`, `sm`.`class` as `sub_module_class0`, `sm`.`action` AS `sub_module_action`, `sm`.`show_menu` AS `sub_module_show_menu`, `sm`.`status` AS `sub_module_status`, `sm`.`sub_module_class`
            FROM `modules` AS `m` left join `sub_modules` AS `sm` ON `m`.`id`=`sm`.`module_id` AND `m`.`status`=1 AND `sm`.`status`=1
            ORDER BY `m`.`order`, `m`.`module_name`, `sm`.`module_id`, `sm`.`order`, `sm`.`sub_module_name`";
        $data = $this->db->query($query)->result_array();
        // pr($data);
        // exit(0);
        $modules = [];
        foreach ($data as $module) {
            if (!array_key_exists($module['module_id'], $modules)) {
                $modules[$module['module_id']] = [
                    'module' => [
                        'id' => $module['module_id'],
                        'module_name' => $module['module_name'],
                        'order' => $module['module_order'],
                        'url' => $module['module_url'],
                        'status' => $module['module_status'],
                        'class' => $module['module_class'],
                    ],
                    'sub_modules' => [],
                ];
            }

            if ($module['sub_module_id'] != null) {
                $modules[$module['module_id']]['sub_modules'][$module['sub_module_id']] = [
                    'id' => $module['sub_module_id'],
                    'module_id' => $module['module_id'],
                    'sub_module_name' => $module['sub_module_name'],
                    'order' => $module['sub_module_order'],
                    'url' => $module['sub_module_url'],
                    'class' => $module['sub_module_class0'],
                    'action' => $module['sub_module_action'],
                    'show_menu' => $module['sub_module_show_menu'],
                    'status' => $module['sub_module_status'],
                    'sub_module_class' => $module['sub_module_class'],
                ];
            }
        }
        return $modules;
    }

    public function getSubModuleIdByUrl($url)
    {
        $id = 0;
        $url_data = explode("/", $url);
        $class = isset($url_data[0]) ? $url_data[0] : '';
        $action = isset($url_data[1]) ? $url_data[1] : 'index';
        $prem = isset($url_data[2]) ? $url_data[2] : '';
        #pr($url_data);
        if ($class) {
            $mainurl = $class . "/" . $action;
            if (!empty($prem)) {
                $mainurl = $mainurl . "/" . $prem;
            }
            $this->db->select('*');
            $this->db->from('sub_modules');
            $this->db->where('url', $mainurl);
            $this->db->where('status', '1');
            $query = $this->db->get();
            $row = $query->row();
            #echo $this->db->last_query();
            $id = isset($row->id) ? $row->id : '';
            #die();
        }
        return $id;
    }
}
