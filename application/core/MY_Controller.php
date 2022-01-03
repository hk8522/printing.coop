<?php defined('BASEPATH') OR exit('No direct script access allowed');
class MY_Controller extends CI_Controller
{
  protected  $data = array();
  public     $default_currency_id='';
  public     $DefaultcurrencyData='';
  public     $product_price_currency='';
  public     $product_price_currency_symbol='';
  public     $main_store_data='';
  public     $language_name='';
  public     $main_store_id='';
  public     $website_store_id='';

  function __construct()
  {
        parent::__construct();
        $this->load->library('session');
		$this->load->library('cart');
		$this->load->helper('cookie');
		$this->load->model('Store_Model');
		$StoreListData=$this->Store_Model->getStoreListData();
		$AllCurrencyList=$this->Store_Model->getCurrencyList();
		//pr($StoreListData,1);
		//pr($_SERVER,1);
		$HTTP_X_FORWARDED_PROTO=isset($_SERVER['HTTP_X_FORWARDED_PROTO']) ? $_SERVER['HTTP_X_FORWARDED_PROTO']:'http';
		$HTTP_HOST=$_SERVER['HTTP_HOST'];
        //$FILE_BASE_URL='https://'.$HTTP_HOST.'/';
		$FILE_BASE_URL=$HTTP_X_FORWARDED_PROTO.'://'.$HTTP_HOST.'/';
		$this->config->set_item('base_url',$FILE_BASE_URL);
        $MainStoreData=$StoreListData[1];
        foreach($StoreListData as $key=>$val){

			if($val['url']==$FILE_BASE_URL || $val['http_url']==$FILE_BASE_URL){

				$MainStoreData=$StoreListData[$key];
				break;
			}
		}
		//pr($MainStoreData,1);
		$this->data['MainStoreData']=$MainStoreData;
		$this->language_name=$MainStoreData['language_name'];

		$this->data['CurrencyList']=$MainStoreData['CurrencyList'];
		$this->main_store_data=$MainStoreData;
		$this->main_store_id=1;
		$this->website_store_id=1;
		if(!empty($MainStoreData)){

			$this->main_store_id=$MainStoreData['id'];
			$this->website_store_id=$MainStoreData['main_store_id'];

		}

		$StoreListData=$this->Store_Model->getStoreListData($this->website_store_id);
		#pr($StoreListData,1);
		$this->data['StoreListData']=$StoreListData;
		$this->data['main_store_id']=$this->main_store_id;
		$this->data['website_store_id']=$this->website_store_id;

		if(isset($_GET['currency_id']) && !empty($_GET['currency_id'])){

			$currency_id=$_GET['currency_id'];
			$cookie= array(
            'name'   => 'currency_id',
            'value'  => $currency_id,
            'expire' => 3600*24
            );
		    $this->input->set_cookie($cookie);
			$REDIRECT_URL=$_GET['REDIRECT_URL'];
			$this->cart->destroy();
			if(!empty($REDIRECT_URL)){

			  redirect($REDIRECT_URL, 'refresh');
			}else{

			   redirect('/', 'refresh');
			}
		}

		if(is_null(get_cookie('currency_id')) || empty(get_cookie('currency_id'))){

            $cookie= array(
            'name'   => 'currency_id',
            'value'  => $MainStoreData['default_currency_id'],
            'expire' => 3600*24
            );
		    $this->input->set_cookie($currency_id);


        }

		$default_currency_id = !empty(get_cookie('currency_id')) ? get_cookie('currency_id'):1;


		$DefaultcurrencyData = $AllCurrencyList[$default_currency_id];
		$this->data['DefaultcurrencyData']    = $DefaultcurrencyData;
		$this->data['default_currency_id']    = $default_currency_id;
		$this->data['product_price_currency'] = $DefaultcurrencyData['product_price_currency'];
		$this->data['product_price_currency_symbol'] = $DefaultcurrencyData['symbols'];




		$this->default_currency_id=$default_currency_id;
		$this->DefaultcurrencyData=$DefaultcurrencyData;
		$this->product_price_currency_symbol=$this->data['product_price_currency_symbol'];
		$this->product_price_currency=$this->data['product_price_currency'];

		$showCOVID19MSG=true;

		if(!empty(get_cookie('COVID19MSG'))){

			$showCOVID19MSG=false;
			/*$cookie= array(
            'name'   => 'currency_id',
            'value'  => $MainStoreData['default_currency_id'],
            'expire' => 3600*24
            );
		    $this->input->set_cookie($currency_id);*/

        }

		$this->data['showCOVID19MSG'] = $showCOVID19MSG;
	    $this->data['page_title'] = '';
		$this->data['meta_page_title'] = '';
		$this->data['meta_description_content'] = '';
		$this->data['meta_keywords_content'] = '';
	    $this->data['before_head'] = '';
	    $this->data['before_body'] ='';
	    $this->data['BASE_URL']= base_url();
		$this->data['language_name']=$this->language_name;
	    $this->data['BASE_URL_ADMIN']= base_url().'admin/';
	    $this->data['errors']     = $this->session->flashdata('errors');
	    $this->data['old_values'] = $this->session->flashdata('old_values');


    }

  protected function render($the_view = NULL, $template = 'master')
  {
    if($template == 'json' || $this->input->is_ajax_request())
    {
      /*header('Content-Type: application/json');
        echo json_encode($this->data);*/
    }
    else
    {
      $this->data['the_view_content'] = (is_null($the_view)) ? '' : $this->load->view($the_view,$this->data, TRUE);;
      $this->load->view('templates/'.$template.'_view', $this->data);
    }
  }

    public function getorderEmail($id,$heding="Order Confirmation",$body=null,$store_id=1){

		$this->load->model('Product_Model');
		$this->load->model('ProductOrder_Model');
		$this->load->model('Address_Model');
		$this->load->model('Store_Model');

		$orderData=$this->ProductOrder_Model->getProductOrderDataById($id);$OrderItemData=$this->ProductOrder_Model->getProductOrderItemDataById($id);

		$StoreData=$this->Store_Model->getStoreDataById($store_id);

		$stateData=$this->Address_Model->getStateById($orderData['billing_state']);
		$countryData=$this->Address_Model->getCountryById($orderData['billing_country']);
		$cityData=$this->Address_Model->getCityById($orderData['billing_city']);
		$salesTaxRatesProvinces_Data=$this->Address_Model->salesTaxRatesProvincesById($orderData['billing_state']);
		$CurrencyList=$this->Store_Model->getCurrencyList();
		$currency_id=$orderData['currency_id'];
		if(empty($currency_id)){

			$currency_id=1;
		}
        $OrderCurrencyData=$CurrencyList[$currency_id];
        $order_currency_currency_symbol=$OrderCurrencyData['symbols'];
		$data['page_title']='Order details';
		$data['orderData']=$orderData;
		$data['OrderItemData']=$OrderItemData;
		$data['cityData']=$cityData;
		$data['stateData']=$stateData;
		$data['countryData']=$countryData;
		$data['heding']=$heding;
		$data['body']=$body;
		$data['OrderCurrencyData']=$OrderCurrencyData;
		$data['order_currency_currency_symbol']=$order_currency_currency_symbol;
		$data['salesTaxRatesProvinces_Data']=$salesTaxRatesProvinces_Data;
		$data['StoreData']=$StoreData;

		if($StoreData['main_store_id']==5){

			if($StoreData['langue_id']==2){

				return $this->load->view('Emails/fr_ecoink_order',$data,true);
			}else{

				return $this->load->view('Emails/ecoink_order',$data,true);

			}

		}else{

			if($StoreData['langue_id']==2){

				return $this->load->view('Emails/fr_order',$data,true);
			}else{
				return $this->load->view('Emails/order',$data,true);

			}
		}
	}


	public function getorderEmailFrance($id,$heding="Order Confirmation",$body=null){

		$this->load->model('Product_Model');
		$this->load->model('ProductOrder_Model');
		$this->load->model('Address_Model');
		$this->load->model('Store_Model');

		$orderData=$this->ProductOrder_Model->getProductOrderDataById($id);$OrderItemData=$this->ProductOrder_Model->getProductOrderItemDataById($id);

		$stateData=$this->Address_Model->getStateById($orderData['billing_state']);
		$countryData=$this->Address_Model->getCountryById($orderData['billing_country']);
		$cityData=$this->Address_Model->getCityById($orderData['billing_city']);
		$salesTaxRatesProvinces_Data=$this->Address_Model->salesTaxRatesProvincesById($orderData['billing_state']);
		$CurrencyList=$this->Store_Model->getCurrencyList();
		$currency_id=$orderData['currency_id'];
		if(empty($currency_id)){
			$currency_id=1;
		}

        $OrderCurrencyData=$CurrencyList[$currency_id];
        $order_currency_currency_symbol=$OrderCurrencyData['symbols'];
		$data['page_title']='Order details';
		$data['orderData']=$orderData;
		$data['OrderItemData']=$OrderItemData;
		$data['cityData']=$cityData;
		$data['stateData']=$stateData;
		$data['countryData']=$countryData;
		$data['heding']=$heding;
		$data['body']=$body;
		$data['OrderCurrencyData']=$OrderCurrencyData;
		$data['order_currency_currency_symbol']=$order_currency_currency_symbol;
		$data['salesTaxRatesProvinces_Data']=$salesTaxRatesProvinces_Data;
	    return $this->load->view('Emails/fr_order',$data,true);

	}

	public function getOrderInvoicePdf($id,$store_id=1){

		if(empty($store_id)){
			$store_id=1;
		}

		$this->load->model('Product_Model');
		$this->load->model('ProductOrder_Model');
		$this->load->model('Address_Model');
		$this->load->model('Store_Model');

		$orderData=$this->ProductOrder_Model->getProductOrderDataById($id);
		$OrderItemData=$this->ProductOrder_Model->getProductOrderItemDataById($id);
		$StoreData=$this->Store_Model->getStoreDataById($store_id);

		//pr($orderData);
		$stateData=$this->Address_Model->getStateById($orderData['billing_state']);
		$countryData=$this->Address_Model->getCountryById($orderData['billing_country']);
		$cityData=$this->Address_Model->getCityById($orderData['billing_city']);
		$salesTaxRatesProvinces_Data=$this->Address_Model->salesTaxRatesProvincesById($orderData['billing_state']);
		$CurrencyList=$this->Store_Model->getCurrencyList();
		$currency_id=$orderData['currency_id'];
		if(empty($currency_id)){
			$currency_id=1;
		}
        $OrderCurrencyData=$CurrencyList[$currency_id];
        $order_currency_currency_symbol=$OrderCurrencyData['symbols'];
		$data['page_title']='Order details';
		$data['orderData']=$orderData;
		$data['OrderItemData']=$OrderItemData;
		$data['cityData']=$cityData;
		$data['stateData']=$stateData;
		$data['countryData']=$countryData;
		$data['heding']=$heding;
		$data['body']=$body;
		$data['OrderCurrencyData']=$OrderCurrencyData;
		$data['order_currency_currency_symbol']=$order_currency_currency_symbol;
		$data['salesTaxRatesProvinces_Data']=$salesTaxRatesProvinces_Data;
	    $data['StoreData']=$StoreData;

		if($StoreData['main_store_id']==5){

			if($StoreData['langue_id']==2){

				return $this->load->view('pdf/fr_ecoink_invoice-pdf',$data,true);
			}else{
				return $this->load->view('pdf/ecoink_invoice-pdf',$data,true);
			}

		}else{

			if($StoreData['langue_id']==2){

		        return $this->load->view('pdf/fr_invoice-pdf',$data,true);

			}else{
				return $this->load->view('pdf/invoice-pdf',$data,true);
			}

		}
	}

	public function getOrderPdf($id,$store_id=1){

		if(empty($store_id)){
			$store_id=1;
		}
		$this->load->model('Product_Model');
		$this->load->model('ProductOrder_Model');
		$this->load->model('Address_Model');
		$this->load->model('Store_Model');

		$orderData=$this->ProductOrder_Model->getProductOrderDataById($id);$OrderItemData=$this->ProductOrder_Model->getProductOrderItemDataById($id);
		$StoreData=$this->Store_Model->getStoreDataById($store_id);

		$stateData=$this->Address_Model->getStateById($orderData['billing_state']);
		$countryData=$this->Address_Model->getCountryById($orderData['billing_country']);
		$cityData=$this->Address_Model->getCityById($orderData['billing_city']);
		$salesTaxRatesProvinces_Data=$this->Address_Model->salesTaxRatesProvincesById($orderData['billing_state']);
		$CurrencyList=$this->Store_Model->getCurrencyList();
		$currency_id=$orderData['currency_id'];
		if(empty($currency_id)){
			$currency_id=1;
		}
        $OrderCurrencyData=$CurrencyList[$currency_id];
        $order_currency_currency_symbol=$OrderCurrencyData['symbols'];
		$data['page_title']='Order details';
		$data['orderData']=$orderData;
		$data['OrderItemData']=$OrderItemData;
		$data['cityData']=$cityData;
		$data['stateData']=$stateData;
		$data['countryData']=$countryData;
		$data['heding']=$heding;
		$data['body']=$body;
		$data['OrderCurrencyData']=$OrderCurrencyData;
		$data['order_currency_currency_symbol']=$order_currency_currency_symbol;
		$data['salesTaxRatesProvinces_Data']=$salesTaxRatesProvinces_Data;
		$data['StoreData']=$StoreData;
		#pr($StoreData,1);
		if($StoreData['main_store_id']==5){

			if($StoreData['langue_id']==2){
			   return $this->load->view('pdf/fr_ecoink_order-pdf',$data,true);
			}else{

				return $this->load->view('pdf/ecoink_order-pdf',$data,true);
			}

		}else{

			if($StoreData['langue_id']==2){

			   return $this->load->view('pdf/fr_order-pdf',$data,true);
			}else{
				return $this->load->view('pdf/order-pdf',$data,true);
			}
		}

	}


	public function getOrderInvoicePdfFrance($id){

		$this->load->model('Product_Model');
		$this->load->model('ProductOrder_Model');
		$this->load->model('Address_Model');
		$this->load->model('Store_Model');

		$orderData=$this->ProductOrder_Model->getProductOrderDataById($id);$OrderItemData=$this->ProductOrder_Model->getProductOrderItemDataById($id);
		$stateData=$this->Address_Model->getStateById($orderData['billing_state']);
		$countryData=$this->Address_Model->getCountryById($orderData['billing_country']);
		$cityData=$this->Address_Model->getCityById($orderData['billing_city']);
		$salesTaxRatesProvinces_Data=$this->Address_Model->salesTaxRatesProvincesById($orderData['billing_state']);
		$CurrencyList=$this->Store_Model->getCurrencyList();
		$currency_id=$orderData['currency_id'];
		if(empty($currency_id)){
			$currency_id=1;
		}
        $OrderCurrencyData=$CurrencyList[$currency_id];
        $order_currency_currency_symbol=$OrderCurrencyData['symbols'];
		$data['page_title']='Order details';
		$data['orderData']=$orderData;
		$data['OrderItemData']=$OrderItemData;
		$data['cityData']=$cityData;
		$data['stateData']=$stateData;
		$data['countryData']=$countryData;
		$data['heding']=$heding;
		$data['body']=$body;
		$data['OrderCurrencyData']=$OrderCurrencyData;
		$data['order_currency_currency_symbol']=$order_currency_currency_symbol;
		$data['salesTaxRatesProvinces_Data']=$salesTaxRatesProvinces_Data;
	    return $this->load->view('pdf/fr_invoice-pdf',$data,true);

	}

	public function getOrderPdfFrance($id){

		$this->load->model('Product_Model');
		$this->load->model('ProductOrder_Model');
		$this->load->model('Address_Model');
		$this->load->model('Store_Model');

		$orderData=$this->ProductOrder_Model->getProductOrderDataById($id);$OrderItemData=$this->ProductOrder_Model->getProductOrderItemDataById($id);
		$stateData=$this->Address_Model->getStateById($orderData['billing_state']);
		$countryData=$this->Address_Model->getCountryById($orderData['billing_country']);
		$cityData=$this->Address_Model->getCityById($orderData['billing_city']);
		$salesTaxRatesProvinces_Data=$this->Address_Model->salesTaxRatesProvincesById($orderData['billing_state']);
		$CurrencyList=$this->Store_Model->getCurrencyList();
		$currency_id=$orderData['currency_id'];
		if(empty($currency_id)){
			$currency_id=1;
		}
        $OrderCurrencyData=$CurrencyList[$currency_id];
        $order_currency_currency_symbol=$OrderCurrencyData['symbols'];
		$data['page_title']='Order details';
		$data['orderData']=$orderData;
		$data['OrderItemData']=$OrderItemData;
		$data['cityData']=$cityData;
		$data['stateData']=$stateData;
		$data['countryData']=$countryData;
		$data['heding']=$heding;
		$data['body']=$body;
		$data['OrderCurrencyData']=$OrderCurrencyData;
		$data['order_currency_currency_symbol']=$order_currency_currency_symbol;
		$data['salesTaxRatesProvinces_Data']=$salesTaxRatesProvinces_Data;
	    return $this->load->view('pdf/fr_order-pdf',$data,true);

	}

	function emailTemplate($subject,$body,$store_id=1){

		$this->load->model('Store_Model');
		if(empty($store_id)){
			$store_id=1;
		}

		$StoreData=$this->Store_Model->getStoreDataById($store_id);
		$data['subject']=$subject;
		$data['body']=$body;
		$data['StoreData']=$StoreData;
		if($StoreData['main_store_id']==5){

			if($StoreData['langue_id']==2){

				return $this->load->view('Emails/fr_ecoink_email',$data,true);

			}else{

				return $this->load->view('Emails/ecoink_email',$data,true);

			}

		}else{

			if($StoreData['langue_id']==2){

				return $this->load->view('Emails/fr_email',$data,true);

			}else{

				return $this->load->view('Emails/email',$data,true);

			}
		}


	}
}
class Admin_Controller extends MY_Controller
{

  public  $adminLoginId='';
  public  $adminLoginRole='';
  public  $action='';
  function __construct()
  {
    parent::__construct();
    //echo $this->emailTemplate('Test','goos',2); die('OK');
	if($this->main_store_id !='1'){

		 redirect('https://www.printing.coop/pcoopadmin');
	}
	$this->load->library('session');
	$loginUserData=$this->session->get_userdata();
	if(!isset($loginUserData['adminLoginId']) || $loginUserData['adminLoginId']=='')
    {
	  #redirect them to the login page
      redirect('pcoopadmin', 'refresh');
    }
	$this->load->model('Module_Model');
	$this->adminLoginId   = $loginUserData['adminLoginId'];
	$this->adminLoginRole = $loginUserData['adminLoginRole'];
	$this->data['loginUserData']=$loginUserData;
	$this->data['CLASS_NAME']=strtolower($this->router->fetch_class());
	$this->data['METHOD_NAME']=strtolower($this->router->fetch_method());
	$this->data['PARAMETER_NAME']=isset($this->router->uri->rsegments[3]) ? $this->router->uri->rsegments[3]:'';

	$this->data['ModuleList']     = $this->Module_Model->getAllModuleList();
	$this->data['AdminSubModule'] = $this->Module_Model->getSubModuleByAdminId($this->adminLoginId,$this->adminLoginRole);
	$this->data['AdminModule']    = $this->Module_Model->getMainModuleByAdminId($this->adminLoginId,$this->adminLoginRole);

	$url=$this->router->fetch_class()."/".$this->router->fetch_method();
	$action_url=$url."/".$this->router->uri->rsegments[3];
    $action=true;
	if($this->adminLoginRole !='admin' && $this->data['CLASS_NAME'] !='dashboards' && $url != 'Accounts/logout'){

		$sub_module_id=$this->Module_Model->getSubModuleIdByUrl($action_url);
		#pr($this->data['AdminSubModule'],1);

		/*if(!in_array($sub_module_id,$this->data['AdminSubModule']))
		{
	        $this->session->set_flashdata('url_error','You are not authorized to access this page');

			redirect('admin/Dashboards', 'refresh');
		}*/

	}

  }

  protected function render($the_view = NULL, $template = 'admin_master')
  {

    parent::render($the_view, $template);
  }
}

class Adminlogin_Controller extends MY_Controller
{

  function __construct()
  {
    parent::__construct();

	if($this->main_store_id !='1'){

		 redirect('https://www.printing.coop/pcoopadmin');
	}
	$this->load->library('session');
	$loginUserData=$this->session->get_userdata();
	if(isset($loginUserData['adminLoginId']) && $loginUserData['adminLoginId'] !='')
    {
      #redirect them to the Dashboards page
      redirect('admin/Dashboards', 'refresh');
    }
    $this->data['page_title'] = '';
  }

  protected function render($the_view = NULL, $template = 'admin_master_login')
  {

    parent::render($the_view, $template);
  }
}

class Public_Controller extends MY_Controller
{

    public  $loginId='';
	public	$loginName='';
	public	$loginFirstName='';
	public	$loginLastName='';
	public	$loginPic='';
	public	$loginMobile='';
	public	$loginEmail='';

  function __construct()
  {
    parent::__construct();

	    $this->load->library('session');
		$this->load->library('cart');
		$loginUser=$this->session->get_userdata();
        if($this->main_store_id =='3' || $this->main_store_id =='4'){

		    //redirect('https://www.imprimeur.coop/');

	    }
		if($this->main_store_id =='5'){

		    //redirect('https://www.printing.coop/');

	    }

	    if(isset($loginUser['loginId']) && !empty($loginUser['loginId']))
        {
           $this->loginId=$loginUser['loginId'];
		   $this->loginName=$loginUser['loginName'];
		   $this->loginFirstName=$loginUser['loginFirstName'];
		   $this->loginLastName=$loginUser['loginLastName'];
		   $this->loginPic=$loginUser['loginPic'];
		   $this->loginMobile=$loginUser['loginMobile'];
		   $this->loginEmail=$loginUser['loginEmail'];

        }

		$this->data['loginId']=$this->loginId;
		$this->data['loginName']=$this->loginName;
		$this->data['loginFirstName']=$this->loginFirstName;
		$this->data['loginLastName']=$this->loginLastName;
		$this->data['loginPic']=$this->loginPic;
		$this->data['loginMobile']=$this->loginMobile;
		$this->data['loginEmail']=$this->loginEmail;
		$this->load->model('Category_Model');
	    $this->load->model('Menu_Model');
	    $this->load->model('SubCategory_Model');
		$this->load->model('User_Model');
	    $this->load->model('Product_Model');
		$this->load->model('Page_Model');
		$this->load->model('Page_Category_Model');
        $this->load->model('Category_Model');
        $this->load->model('Configration_Model');

		if(in_array($this->main_store_id,array(5,6))){

			$this->data['categories']=$this->Category_Model->getCategoriesAndSubCategoriesForMainMenu($this->main_store_id);

			$this->data['footerCategory']=$this->Category_Model->getActiveCategoryListByFooterMenu($this->main_store_id);


		}else{

			$this->data['categories']    = $this->Category_Model->getCategoriesAndSubCategoriesForMainMenu();
			$this->data['footerCategory']=$this->Category_Model->getActiveCategoryListByFooterMenu();
		}
        $this->data['configrations'] = $this->Configration_Model->getConfigrations($this->website_store_id);
		#pr($this->data['configrations'],1);



  }
  protected function render($the_view = NULL, $template = 'master')
  {
    parent::render($the_view, $template);
  }
}
