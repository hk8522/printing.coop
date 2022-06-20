<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class SalesReports extends Admin_Controller
{
    public $class_name='';
    function __construct()
    {
        parent::__construct();
        $this->class_name='admin/'.ucfirst(strtolower($this->router->fetch_class())).'/';
        $this->data['class_name']= $this->class_name;
    }

    public function index()
    {
        $this->load->library("pagination");
        $this->load->model('SalesReport_Model');
        $this->data['page_title'] = 'Sales Reports';
        $this->data['sub_page_title'] = 'Import Sales Reports  CSV';
        $this->data['sub_page_url'] = 'addEdit';
        $this->data['sub_page_view_url'] = 'view';
        $this->data['sub_page_delete_url'] = 'delete';
        $this->data['sub_page_url_active_inactive'] = 'activeInactive';
        $StartDate=$EndDate=$CampaignName=$keywords='';
        $config = array();
        $config['full_tag_open'] 	= '<div class="pagging text-right"><nav><ul class="pagination">';
        $config['full_tag_close'] 	= '</ul></nav></div>';
        $config['num_tag_open'] 	= '<li class="page-item">';
        $config['num_tag_close'] 	= '</li>';
        $config['cur_tag_open'] 	= '<li class="page-item active"><span class="page-link">';
        $config['cur_tag_close'] 	= '<span class="sr-only">(current)</span></span></li>';
        $config['next_tag_open'] 	= '<li class="page-item">';
        $config['next_tagl_close'] 	= '<span aria-hidden="true">&raquo;</span></li>';
        $config['prev_tag_open'] 	= '<li class="page-item">';
        $config['prev_tagl_close'] 	= '</li>';
        $config['first_tag_open'] 	= '<li class="page-item">';
        $config['first_tagl_close'] = '</li>';
        $config['last_tag_open'] 	= '<li class="page-item">';
        $config['last_tagl_close'] 	= '</li>';
        $config['attributes'] = array('class' => 'page-link');
        $config["base_url"] = base_url() . "SalesReports/index";
        $config["total_rows"] = $this->SalesReport_Model->getCount();
        $config["per_page"] = 10;
        $config["uri_segment"] = 3;
        $this->pagination->initialize($config);
        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

        $this->data["links"] = $this->pagination->create_links();

        $lists=$this->SalesReport_Model->getList($config["per_page"],$page);
        $this->data['lists']=$lists;
        $this->data['StartDate']=$StartDate;
        $this->data['EndDate']=$EndDate;
        $this->data['CampaignName']=$CampaignName;
        $this->data['keywords']=$keywords;

        $this->render($this->class_name.'index');
    }

    public function search()
    {
        $this->load->model('SalesReport_Model');
        $this->data['page_title'] = 'Sales Reports';
        $this->data['sub_page_title'] = 'Import Sales Reports  CSV';
        $this->data['sub_page_url'] = 'addEdit';
        $this->data['sub_page_view_url'] = 'view';
        $this->data['sub_page_delete_url'] = 'delete';
        $this->data['sub_page_url_active_inactive'] = 'activeInactive';
        $StartDate=$EndDate=$CampaignName=$keywords='';
        $lists=array();
        if(isset($_GET['StartDate']) && !empty($_GET['StartDate']) && isset($_GET['EndDate']) && !empty($_GET['EndDate']) && isset($_GET['CampaignName']) && !empty($_GET['CampaignName']) && $_GET['StartDate'] <= $_GET['EndDate'] && isset($_GET['keywords']) && !empty($_GET['keywords'])){
            $StartDate=$_GET['StartDate'];
            $EndDate=$_GET['EndDate'];
            $CampaignName=$_GET['CampaignName'];
            $keywords=$_GET['keywords'];
            $lists=$this->SalesReport_Model->getSearchList($StartDate,$EndDate,$CampaignName,$keywords);
        }

        $this->data["links"] = '';
        $this->data['lists']=$lists;
        $this->data['StartDate']=$StartDate;
        $this->data['EndDate']=$EndDate;
        $this->data['CampaignName']=$CampaignName;
        $this->data['keywords']=$keywords;
        $this->render($this->class_name.'index');
    }
    public function addEdit($id=null)
    {
        set_time_limit(0);
        $this->load->model('SalesReport_Model');
        $this->load->helper('form');
        $this->data['page_title'] = $page_title = 'Import Sales Reports  CSV';
        if(!empty($id)){
           $this->data['page_title'] = $page_title = 'Import Sales Reports  CSV';
        }
        $this->data['main_page_url'] = '';
        $postData=array();
        $personalise=array();

        if($this->input->post()){
                $saveData=true;
                $onefilesCount = $_FILES['csv_file']['name'];
                //$mimes = array('application/vnd.ms-excel','text/plain','text/csv','text/tsv');
                $mimes = array('text/csv','application/vnd.ms-excel');
                if(empty($onefilesCount)){
                   $this->session->set_flashdata('message_error','Missing csv file');
                } elseif(!in_array($_FILES['csv_file']['type'],$mimes)) {
                     $this->session->set_flashdata('message_error','File type  allow only csv');
                } elseif($_FILES['csv_file']['size'] > 104857600){
                    $this->session->set_flashdata('message_error','File size  allow only 100mb');
                } else {
                    if(is_uploaded_file($_FILES['csv_file']['tmp_name'])){
                        // Load CSV reader library
                         // Open uploaded CSV file with read-only mode
                           $csvFile = fopen($_FILES['csv_file']['tmp_name'], 'r');

                         // Skip the first line
                          fgetcsv($csvFile);

                        // Parse data from CSV file line by line
                        $row=0;
                        while(($line = fgetcsv($csvFile)) !== FALSE){
                            // Get row data
                            $saveData=array(
                                'start_date'=>date('Y-m-d',strtotime($line[0])),
                                'end_date'=>date('Y-m-d',strtotime($line[1])),
                                'portfolio_name'=>$line[2],
                                'currency'=>$line[3],
                                'campaign_name'=>$line[4],
                                'ad_grou_name'=>$line[5],
                                'targeting'=>$line[6],
                                'match_type'=>$line[7],
                                'impressions'=>$line[8],
                                'clicks'=>$line[9],
                                'click_thru_rate'=>$line[10],
                                'cost_per_click'=>$line[11],
                                'spend'=>$line[12],
                                'total_advertising_cost_of_sales'=>$line[13],
                                'total_return_on_advertising_spend'=>$line[14],
                                '7_day_total_sales'=>$line[15],
                                '7_day_total_orders'=>$line[16],
                                '7_day_total_units'=>$line[17],
                                '7_day_conversion_rate'=>$line[18],
                                '7_day_advertised_sku_units'=>$line[19],
                                '7_day_other_sku_units'=>$line[20],
                                '7_day_advertised_sku_sales'=>$line[21],
                                '7_day_other_sku_sales'=>$line[22]

                            );

                            if($this->SalesReport_Model->save($saveData) >0){
                                $row++;
                            }
                        }

                        $this->session->set_flashdata('message_success',$row.' Row inserted successfully');
                        redirect('SalesReports');
                    }else{
                        $this->session->set_flashdata('message_error','Missing csv file');
                    }
                }
        }
        $this->render($this->class_name.'add_edit');
    }
    public function activeInactive($id=null,$status=null)
    {
        if(!empty($id) && ($status==1 || $status==0)){
                $postData['id']=$id;
                $postData['status']=$status;
                $page_title='Product Active';
                $this->load->model('Product_Model');
                if($status==0){
                    $page_title='Product Inactive';
                }
                if ($this->Product_Model->saveProduct($postData))
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
        redirect('admin/Products');
    }

    public function deleteProduct($id=null)
    {
        if(!empty($id)){
                $page_title='Product Delete';
                $this->load->model('Product_Model');
                $this->load->model('ProductImage_Model');
                $productImageData=$this->ProductImage_Model->getProductImageDataByProductId($id);
                if ($this->Product_Model->deleteProduct($id))
                {
                    $this->ProductImage_Model->deleteProductImageByProductId($id);

                    foreach($productImageData as $key=>$data){
                        $imageName=$data['image'];
                        if(file_exists(PRODUCT_IMAGE_SMALL_BASE_PATH.$imageName))
                        unlink(PRODUCT_IMAGE_SMALL_BASE_PATH.$imageName);
                        if(file_exists(PRODUCT_IMAGE_MEDIUM_BASE_PATH.$imageName))
                            unlink(PRODUCT_IMAGE_MEDIUM_BASE_PATH.$imageName);

                        if(file_exists(PRODUCT_IMAGE_LARGE_BASE_PATH.$imageName))
                            unlink(PRODUCT_IMAGE_LARGE_BASE_PATH.$imageName);

                        if(file_exists(PRODUCT_IMAGE_BASE_PATH.$imageName))
                            unlink(PRODUCT_IMAGE_BASE_PATH.$imageName);
                    }

                    $this->session->set_flashdata('message_success',$page_title.' Successfully.');
                }
                else
                {
                    $this->session->set_flashdata('message_error',$page_title.' Unsuccessfully.');
                }
        }else{
            $this->session->set_flashdata('message_error','Missing information.');
        }
        redirect('admin/Products');
    }
}
