<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Printers extends Admin_Controller
{
    public $class_name='';
    function __construct()
    {
        parent::__construct();
        $this->class_name='admin/'.ucfirst(strtolower($this->router->fetch_class())).'/';
        $this->data['class_name']= $this->class_name;
    }

    public function index($type='printers')
    {
        $this->load->model('Printer_Model');
        if($type=='printers'){
            $this->data['page_title'] = 'Printer Brands';
            $this->data['sub_page_title'] = 'Add New Printer Brand';
            $lists=$this->Printer_Model->getPrinterBrandList();
        }else if($type=='printer_series'){
            $this->data['page_title'] = 'Printer Series';
            $this->data['sub_page_title'] = 'Add New Printer Series';
            $lists=$this->Printer_Model->getPrinterSeriesList();
        }else if($type=='printermodels'){
            $this->data['page_title'] = 'Printer models';
            $this->data['sub_page_title'] = 'Add New Printer Model';
            $lists=$this->Printer_Model->getPrinterModelsList();
        }

        $this->data['sub_page_url'] = 'addEdit';
        $this->data['sub_page_url_active_inactive'] = 'activeInactive';
        $this->data['sub_page_delete_url'] = 'deletePrinter';

        $this->data['lists']=$lists;
        $this->data['type']=$type;
        $this->render($this->class_name.'index');
    }

    public function addEdit($id=null,$type='printers')
    {
        $this->load->helper('form');
        if($type=='printers'){
            $this->data['page_title'] = 'Add New Printer Brands';
            if(!empty($id)){
                $this->data['page_title'] = $page_title = 'Edit Printer Brands';
            }
        }else if($type=='printer_series'){
            $this->data['page_title'] = 'Add New Printer Series';

            if(!empty($id)){
                $this->data['page_title'] = $page_title = 'Edit Printer Series';
            }
        }else if($type=='printermodels'){
            $this->data['page_title'] = 'Add New Printer Model';
            if(!empty($id)){
                $this->data['page_title'] = $page_title = 'Edit Printer Model';
            }
        }

        $this->data['main_page_url'] = '';
        $this->load->model('Printer_Model');
        $postData=array();
        $postData=$this->Printer_Model->getDataById($type,$id);
        $this->data['PrinterBrandLists']=$this->Printer_Model->getPrinterBrandList();
        $PrinterSeriesLists=array();
        if($type=='printermodels'){
            $printer_brand_id=$postData['printer_brand_id'];
            $PrinterSeriesLists=$this->Printer_Model->getPrinterSeriesListById($printer_brand_id);
        }
        $this->data['PrinterSeriesLists']=$PrinterSeriesLists;
        if($this->input->post()){
            $this->load->library('form_validation');
            $set_rules=$this->Printer_Model->$type;
            $this->form_validation->set_rules($set_rules);
            $this->form_validation->set_error_delimiters('<div class="form_vl_error">', '</div>');
            $postData['name']=$this->input->post('name');
            $postData['name_french']=$this->input->post('name_french');
            $type=$this->input->post('type');

            if($type=='printers'){
                $this->data['page_title'] = $page_title='Add New Printer Brands';
                if(!empty($id)){
                    $this->data['page_title'] = $page_title = 'Edit Printer Brands';
                }
            }else if($type=='printer_series'){
                $this->data['page_title'] =$page_title= 'Add New Printer Series';

                if(!empty($id)){
                    $this->data['page_title'] = $page_title = 'Edit Printer Series';
                }
            }else if($type=='printermodels'){
                $this->data['page_title'] = $page_title='Add New Printer Model';
                if(!empty($id)){
                    $this->data['page_title'] = $page_title = 'Edit Printer Model';
                }
            }
            if($type=='printermodels' || $type=='printer_series'){
                $postData['printer_brand_id']=$this->input->post('printer_brand_id');
            }
            if($type=='printermodels'){
                $postData['printer_series_id']=$this->input->post('printer_series_id');
            }
            if($type=='printermodels'){
                $printer_brand_id=$postData['printer_brand_id'];
                $PrinterSeriesLists=$this->Printer_Model->getPrinterSeriesListById($printer_brand_id);
            }
            $this->data['PrinterSeriesLists']=$PrinterSeriesLists;
            #pr($postData,1);
            if($this->form_validation->run()===TRUE)
            {
                if(!empty($id)){
                   $postData['id']=$this->input->post('id');
                }

                if ($this->Printer_Model->save($type,$postData))
                {
                    $this->session->set_flashdata('message_success',$page_title.' Successfully.');
                    redirect('admin/Printers/index/'.$type);
                }
                else
                {
                    $this->session->set_flashdata('message_error',$page_title.' Unsuccessfully.');
                }
            }else{
                $this->session->set_flashdata('message_error','Missing information.');
            }
        }
        $this->data['postData']=$postData;
         $this->data['type']=$type;
        $this->render($this->class_name.'add_edit');
    }

    public function activeInactive($id=null,$status=null,$type=null)
    {
        if(!empty($id) && ($status==1 || $status==0)){
            $postData['id']=$id;
            $postData['status']=$status;
            $this->load->model('Printer_Model');

            if($type=='printers'){
                $page_title=$status==1 ? 'Printer Brands Active':'Printer Brands Inactive';
            }else if($type=='printer_series'){
                $page_title=$status==1 ? 'Printer Series Active':'Printer Series Inactive';
            }else if($type=='printermodels'){
                $page_title=$status==1 ? 'Printer Model Active':'Printer Model Inactive';
            }
            if ($this->Printer_Model->save($type,$postData))
            {
                $this->session->set_flashdata('message_success',$page_title.' Successfully.');
            }else{
                $this->session->set_flashdata('message_error',$page_title.' Unsuccessfully.');
            }
        }else{
            $this->session->set_flashdata('message_error','Missing information.');
        }

        redirect('admin/Printers/index/'.$type);
    }

    public function deletePrinter($id=null,$type)
    {
        if($type=='printers'){
            $page_title='Printer Brands Delete';
        }else if($type=='printer_series'){
            $page_title='Printer Series Delete';
        }else if($type=='printermodels'){
            $page_title='Printer Model Delete';
        }
        if(!empty($id)){
            $this->load->model('Printer_Model');
            if ($this->Printer_Model->deletePrinter($type,$id))
            {
                $this->session->set_flashdata('message_success',$page_title.' Successfully.');
            }
            else
            {
                $this->session->set_flashdata('message_error',$page_title.' Unsuccessfully.');
            }
        }else{
            $this->session->set_flashdata('message_error','Missing information.');
        }
        redirect('admin/Printers/index/'.$type);
    }

    function UploadModalcsv(){
        $this->load->model('Printer_Model');
        set_time_limit(0);
        $fileName = FILE_BASE_PATH.'csv/Edit3-new.csv';
        $file = fopen($fileName, "r");
        $i=0;
        while (($column = fgetcsv($file, 10000, ",")) !== FALSE) {
            if($i > 0){
                $name=trim($column['0']);
                $code=trim($column['1']);
                /*if($this->Printer_Model->getDataByName('printers',$name)==0){
                    $postData['name']=$name;
                    $postData['name_french']=$name;
                    $this->Printer_Model->save('printers',$postData);
                }*/

                $data=$this->Printer_Model->getDataByName('printers',$name);
                $Codedata=$this->Printer_Model->getDataByName('printer_series',$code);
                /*$postData['name']=$code;
                $postData['name_french']=$code;
                if(!empty($data) && !empty($code)){
                    $postData['printer_brand_id']=$data['id'];
                    $this->Printer_Model->save('printer_series',$postData);
                }*/

                if(!empty($data) && !empty($Codedata)){
                    $postData['printer_brand_id']=$data['id'];
                    $postData['printer_series_id']=$Codedata['id'];
                    for($i=2; $i<=15; $i++){
                        $model=trim($column[$i]);
                        if(!empty($model)){
                            $postData['name']=$model;
                            $postData['name_french']=$model;
                            //$this->Printer_Model->save('printermodels',$postData);
                        }
                    }
                }
            }

            $i++;
        }
    }
}
