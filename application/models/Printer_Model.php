<?php

Class Printer_Model extends MY_Model {
    public $printers = [
            [
                'field' => 'name',
                'label' => 'name',
                'rules' => 'required|max_length[50]',
            ],
            [
                'field' => 'name_french',
                'label' => 'name french',
                'rules' => 'required|max_length[50]',
            ]
        ];
    public $printer_series = [
            [
                'field' => 'name',
                'label' => 'name',
                'rules' => 'required|max_length[50]',
            ],
            [
                'field' => 'name_french',
                'label' => 'name french',
                'rules' => 'required|max_length[50]',
            ],
            [
                'field' => 'printer_brand_id',
                'label' => 'Printer Brand',
                'rules' => 'required',
            ],

    ];
    public $printermodels  = [
            [
                'field' => 'name',
                'label' => 'name',
                'rules' => 'required|max_length[50]',
            ],
            [
                'field' => 'name_french',
                'label' => 'name french',
                'rules' => 'required|max_length[50]',
            ],
            [
                'field' => 'printer_brand_id',
                'label' => 'Printer Brand',
                'rules' => 'required',
            ],
    ];
    public function getPrinterBrandList(){
        $this->db->select('*');
        $this->db->from('printers');
        $query = $this->db->get();
        $data=$query->result_array();
        return $data;
    }
    public function getActicePrinterBrandsList(){
            $this->db->select('*');
            $this->db->from('printers');
            $this->db->where('status',1);
            $this->db->order_by('shortOrder','asc');
            $query = $this->db->get();
            $data=$query->result_array();
            return $data;
    }
    public function getPrinterSeriesList($printer_brand_id=null,$status=null){
        $this->db->select('printer_series.*,printers.name as brand_name');
        $this->db->from('printer_series');
        $this->db->join('printers', 'printers.id=printer_series.printer_brand_id', 'inner');
        if(!empty($printer_brand_id)){
            $this->db->where('printer_series.printer_brand_id', $printer_brand_id);
        }
        $query = $this->db->get();
        $data=$query->result_array();
        return $data;
    }

    public function getAcctivePrinterSeriesByBrandId($printer_brand_id=null){
        $this->db->select('*');
        $this->db->from('printer_series');
        $this->db->where('printer_brand_id', $printer_brand_id);
        $this->db->where('status',1);
        $this->db->order_by('name','asc');
        $query = $this->db->get();
        $data=$query->result_array();
        return $data;
    }

    public function getAcctiveModelByBrandId($printer_brand_id=null,$printer_series_id=null){
        $this->db->select('*');
        $this->db->from('printermodels');
        $this->db->where('printer_brand_id', $printer_brand_id);
        $this->db->where('printer_series_id', $printer_series_id);
        $this->db->where('status',1);
        $this->db->order_by('name','asc');
        $query = $this->db->get();
        $data=$query->result_array();
        return $data;
    }
    public function getPrinterSeriesListById($printer_brand_id=null){
        $this->db->select('printer_series.*,printers.name as brand_name');
        $this->db->from('printer_series');
        $this->db->join('printers', 'printers.id=printer_series.printer_brand_id', 'inner');
        $this->db->where('printer_series.printer_brand_id', $printer_brand_id);
        $query = $this->db->get();
        $data=$query->result_array();
        return $data;
    }
    public function getPrinterModelsList(){
        $this->db->select('printermodels.*,printers.name as brand_name');
        $this->db->from('printermodels');
        $this->db->join('printers', 'printers.id=printermodels.printer_brand_id', 'inner');
        $query = $this->db->get();
        $data=$query->result_array();
        return $data;
    }

    public function save($table,$data)
    {
            $id = isset($data['id']) ? $data['id']:'';
            if (!empty($id)) {
                $this->db->where('id', $id);
                $query = $this->db->update($table, $data);

                if ($query) {
                 return $id;
                }
                return 0;
            } else {
                $query = $this->db->insert($table, $data);
                if ($query) {
                   return $insert_id = $this->db->insert_id();
                }
                return 0;
            }
    }

    public function getDataById($table,$id)
    {
        $this->db->select('*');
        $this->db->from($table);
        $this->db->where(array('id'=>$id));
        return $this->db->get()->row_array();
    }
    public function deletePrinter($table,$id)
    {
            $this->db->where('id',$id);
            $query = $this->db->delete($table);
            if ($query) {
                 return 1;
            }
            return 0;
    }

    public function getDataByName($table,$name)
    {
        $this->db->select('*');
        $this->db->from($table);
        $this->db->where(array('name'=>$name));
        return $this->db->get()->row_array();
    }
}
?>
