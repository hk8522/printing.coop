
<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class MyOrders extends Public_Controller
{
  public $class_name='';
  function __construct()
  {
    parent::__construct();
    $this->class_name=ucfirst(strtolower($this->router->fetch_class())).'/';
    $this->class_name='MyOrders/';

    if(empty($this->loginId)){
        redirect('Homes');
    }
  }

    public function index($id=null)
    {
        $this->load->model('ProductOrder_Model');
        $this->load->model('Address_Model');
        $this->load->model('Store_Model');
        $this->data['page_title']='Order History';
        if($this->language_name == 'French'){
            $this->data['page_title']="Historique des commandes";
        }
        $orderData=$this->ProductOrder_Model->getProductOrderList($this->loginId);
        $this->data['orderData']=$orderData;
        $this->render($this->class_name.'index');
    }

    public function view($id=null)
    {
        if(!empty($id)){
            $id=base64_decode($id);
        }

        //$this->getorderEmail($id);
        //echo $this->getOrderInvoicePdf($id);
        //die('OK');
        //`$this->getOrderPdf($id);

        $this->load->model('Product_Model');
        $this->load->model('ProductOrder_Model');
        $this->load->model('Address_Model');
        $this->load->model('Store_Model');

        $orderData=$this->ProductOrder_Model->getProductOrderDataById($id);
        $OrderItemData=$this->ProductOrder_Model->getProductOrderItemDataById($id);

        //pr($orderData,1);
        $stateData=$this->Address_Model->getStateById($orderData['billing_state']);
        $countryData=$this->Address_Model->getCountryById($orderData['billing_country']);
        $cityData=$this->Address_Model->getCityById($orderData['billing_city']);
        $salesTaxRatesProvinces_Data=$this->Address_Model->salesTaxRatesProvincesById($orderData['billing_state']);

        $this->data['page_title']='Order details';
        if($this->language_name == 'French'){
            $this->data['page_title']="Détails de la commande";
        }
        $this->data['orderData']=$orderData;
        $this->data['OrderItemData']=$OrderItemData;
        $this->data['cityData']=$cityData;
        $this->data['stateData']=$stateData;
        $this->data['countryData']=$countryData;
        $this->data['salesTaxRatesProvinces_Data']=$salesTaxRatesProvinces_Data;

        $this->render($this->class_name.'view');
    }

    public function deleteOrder($id=null)
    {
        $this->load->model('ProductOrder_Model');
        if(!empty($id)){
                $page_title='Order has been deleted';
                if($this->language_name == 'French'){
                    $page_title="La commande a été supprimée";
                }
                if ($this->ProductOrder_Model->deleteProductOrder(base64_decode($id)))
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
        redirect('MyOrders');
    }

    public function changeOrderStatus()
    {
        $id=$this->input->post('order_id');
        $status=$this->input->post('status');
        $MobileMsg=$this->input->post('mobileMsg');
        $json=array('status' => 0,'msg' => '');

        if(!empty($id) && !empty($status) && $status=='6'){
                $postData['id']=$id;
                $postData['status']=$status;
                $postData['order_comment']=$MobileMsg;

                $this->load->model('ProductOrder_Model');
                $this->load->model('Store_Model');

                if ($this->ProductOrder_Model->saveProductOrder($postData))
                {
                    $orderData=$this->ProductOrder_Model->getProductOrderDataById($id);
                    $orderItemData=$this->ProductOrder_Model->getProductOrderItemDataById($id);

                    $store_id=$orderData['store_id'];
                    $StoreData=$this->Store_Model->getStoreDataById($store_id);

                    $store_url    = $StoreData['url'];
                    $store_phone  = $StoreData['phone'];
                    $from_name    = $StoreData['name'];
                    $from_email   = $StoreData['from_email'];
                    $admin_email1 = $StoreData['admin_email1'];
                    $admin_email2 = $StoreData['admin_email2'];
                    $admin_email3 = $StoreData['admin_email3'];

                    $toEmail=$orderData['email'];
                    $name=$orderData['name'];
                    $order_id=$orderData['order_id'];
                    $langue_id=$StoreData['langue_id'];

                    if($status==6){
                    if($langue_id=='2'){
                        $subject='Ordre '.$order_id.' a été annulé.';
                        $body ='<div class="top-info" style="margin-top: 15px;text-align: left;">
                        <span style="font-size: 17px; letter-spacing: 0.5px; line-height: 28px; word-spacing: 0.5px;">
                            Salut administrateur,
                           <br>
                            Désolé de vous informer que nous avons annulé votre commande'.$order_id.' par '.$name.'<br>La raison indiquée ci-dessous <br>'.$MobileMsg.'
                        </span>
                        </div><br>';
                        $body_user ='<div class="top-info" style="margin-top: 15px;text-align: left;">
                        <span style="font-size: 17px; letter-spacing: 0.5px; line-height: 28px; word-spacing: 0.5px;">
                            Salut '.$name.',
                        <br>
                            Désolé de vous informer que vous avez annulé votre commande '.$order_id.' par '.$name.'<br>La raison indiquée ci-dessous <br>'.$MobileMsg.'
                        </span>
                        </div><br>';

                            $body_user=$this->getorderEmail($id,$subject,$body_user,$orderData['store_id']);
                            $body=$this->getorderEmail($id,$subject,$body,$orderData['store_id']);
                        }else{
                            $subject='Order '.$order_id.' has been cancelled.';
                            $body ='<div class="top-info" style="margin-top: 15px;text-align: left;">
                            <span style="font-size: 17px; letter-spacing: 0.5px; line-height: 28px; word-spacing: 0.5px;">
                                Hi admin,
                            <br>
                                Sorry to inform you that we have cancelled your order '.$order_id.' by '.$name.' <br>The reason Indicated below <br>'.$MobileMsg.'
                            </span>
                            </div><br>';

                            $body_user ='<div class="top-info" style="margin-top: 15px;text-align: left;">
                            <span style="font-size: 17px; letter-spacing: 0.5px; line-height: 28px; word-spacing: 0.5px;">
                                Hi '.$name.',
                            <br>
                                Sorry to inform you that you have cancelled your order '.$order_id.' The reason <br>Indicated below <br>'.$MobileMsg.'
                            </span>
                            </div><br>';

                            $body_user=$this->getorderEmail($id,$subject,$body_user,$orderData['store_id']);
                            $body=$this->getorderEmail($id,$subject,$body,$orderData['store_id']);
                        }

                        if($langue_id==2){
                        $invoice_file=$orderData['order_id'].'-fr-invoice.pdf';
                        $invoice_file=strtolower($invoice_file);
                        $invoicefilePath=FILE_BASE_PATH.'pdf/'.$invoice_file;

                        $order_file=$orderData['order_id'].'-fr-order.pdf';
                        $order_file=strtolower($order_file);
                        $orderfilePath=FILE_BASE_PATH.'pdf/'.$order_file;
                        }else{
                            $invoice_file=$orderData['order_id'].'-invoice.pdf';
                            $invoice_file=strtolower($invoice_file);
                            $invoicefilePath=FILE_BASE_PATH.'pdf/'.$invoice_file;

                            $order_file=$orderData['order_id'].'-order.pdf';
                            $order_file=strtolower($order_file);
                            $orderfilePath=FILE_BASE_PATH.'pdf/'.$order_file;
                        }

                        if(!file_exists ($invoicefilePath)) {
                            $this->getOrderInvoicePdf($id,$store_id);
                        }

                        if(!file_exists ($orderfilePath)) {
                            $this->getOrderPdf($id,$store_id);
                        }

                        $files[$invoice_file]=$invoicefilePath;
                        $files[$order_file]=$orderfilePath;

                        sendEmail($toEmail,$subject,$body_user,$from_email,$from_name,$files);

                        if(!empty($admin_email1)){
                            sendEmail($admin_email1,$subject,$body,$from_email,$from_name,$files);
                        }
                        if(!empty($admin_email2)){
                            sendEmail($admin_email2,$subject,$body,$from_email,$from_name,$files);
                        }
                        if(!empty($admin_email3)){
                            sendEmail($admin_email3,$subject,$body,$from_email,$from_name,$files);
                        }
                    }

                    $json['status']=1;
                    $json['msg']='Your order has been cancelled successfully.';
                }
                else
                {
                    $json['msg']='Your order has been cancelled unsuccessfully';
                }
        }else{
            $json['msg']='Your order has been cancelled unsuccessfully';
        }

        echo json_encode($json);
    }

    public function download($filePath = NULL,$name=null) {
        $this->load->helper('download');
        if ($filePath) {
            ///$file = FILE_UPLOAD_BASE_URL."cart-image\\" .$fileName;
            $file=urldecode($filePath);
            // check file exists
            if (file_exists ( $file )) {
             // get file content
                $data = file_get_contents ($file);

                //force download
                force_download (urldecode($name), $data);
                exit();
            }
        }
    }

    public function downloadOrderPdf($id=null,$type='invoice'){
        $this->load->model('ProductOrder_Model');
        $this->load->model('Store_Model');
        $orderData=$this->ProductOrder_Model->getProductOrderDataById($id);
        $store_id=$orderData['store_id'];
        $StoreData=$this->Store_Model->getStoreDataById($store_id);
        $store_url    = $StoreData['url'];
        $store_phone  = $StoreData['phone'];
        $from_name    = $StoreData['name'];
        $from_email   = $StoreData['from_email'];
        $admin_email1 = $StoreData['admin_email1'];
        $admin_email2 = $StoreData['admin_email2'];
        $admin_email3 = $StoreData['admin_email3'];
        $langue_id=$StoreData['langue_id'];

        if($langue_id=='2'){
            if($type=='order'){
                $file_name=$orderData['order_id']."-fr-order.pdf";
            }else{
                $file_name=$orderData['order_id']."-fr-invoice.pdf";
            }
            $name=$file_name=strtolower($file_name);
            $filePath=$location=FILE_BASE_PATH.'pdf/'.$file_name;
        }else{
            if($type=='order'){
                $file_name=$orderData['order_id']."-order.pdf";
            }else{
                $file_name=$orderData['order_id']."-invoice.pdf";
            }

            $name=$file_name=strtolower($file_name);
            $filePath=$location=FILE_BASE_PATH.'pdf/'.$file_name;
        }
        //echo  $filePath;   die('OK');
        $this->load->helper('download');
        if ($filePath) {
            ///$file = FILE_UPLOAD_BASE_URL."cart-image\\" .$fileName;
            //$file=urldecode($filePath);

            // check file exists
            $file=$filePath;
            if (file_exists ( $file )) {
             // get file content
                $data = file_get_contents ($file);
                //force download
                force_download(urldecode($name), $data);
                exit();
            }else{
                $this->getOrderInvoicePdf($id,$store_id);
                $this->getOrderPdf($id,$store_id);
                //get file content
                $data = file_get_contents($file);
                //force download
                force_download (urldecode($name), $data);
                exit();
            }
        }
    }
}
